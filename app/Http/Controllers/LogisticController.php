<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ReusableCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\LogisticRegistered;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Logistic;
use App\State;
use App\Local_government;
use App\DeliveryRequest;
use App\Helpers\SmsHelper;
use Illuminate\Support\Facades\Mail;
use Closure;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class LogisticController extends Controller
{
    use ReusableCode;


    //start notifications
    public function success_notice_profile()
    {
       return $success_notification = array(
            'message' => 'Your profile has been updated!',
            'alert-type' => 'success'
        ); 
    }

    public function incomplete_profile_notification()
    {
       return $success_notification = array(
            'message' => 'Your profile is incomplete. Update your phone number and identification details!',
            'alert-type' => 'error'
        ); 
    }

    public function login_success()
    {
        return   $success_notification = array(
            'message' => 'You are successfully logged in!',
            'alert-type' => 'success'
        );
    }

    public function registration_success()
    {
        return   $success_notification = array(
            'message' => 'Your logistic account has been successfully created. Log in to continue!',
            'alert-type' => 'success'
        );
    }

    public function registration_error()
    {
        return   $success_notification = array(
            'message' => 'Your logistic account could not be created!',
            'alert-type' => 'error'
        );
    }

    public function transit_success()
    {
        return   $success_notification = array(
            'message' => 'Delivery status has been changed!',
            'alert-type' => 'success'
        );
    }

    //end notifications
    public function registerLogistics()
    {
        if(Auth::guard('logistic')->check()) {
            return redirect()->route('logistics_dashboard');
        }
        return view('auth.register_logistics');
    }

    public function createLogistics(Request $request)
    {

        $this->validate($request, [
            'first_name'            => ['required', 'string', 'max:255'],
            'last_name'             => ['required', 'string', 'max:255'],
            'company_name'          => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'                 => ['required', 'numeric'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'terms'                 => ['accepted'],

        ]);
        $number = mt_rand(3, 5);
        $data = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'slug' => Str::slug($request->company_name, '-').$number
        );

        Logistic::create($data);

        try {
            Mail::to($user->email)->send(new LogisticRegistered($name, $email, $origPassword));
            Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        } catch (\Exception $e) {
            $failedtosendmail = 'Failed to Mail!';
        }

        $guard = Auth::guard('logistic')->attempt(['email' => $request->email, 'password' => $request->password]);
        // if ($user->save()) {
        //     // Auth::login($user);
        //     if (Auth::guard('agent')->attempt(['email' => $returned_data[1], 'password' => $returned_data[2]])) {
        //         //Check login
        //         if (Auth::guard('agent')->check()) {
        //             $present_user = Auth::guard('agent')->user();

        //             $link = new Refererlink();
        //             $link->agent_id = $present_user->id;
        //             $link->agent_code = $present_user->agent_code;
        //             $link->save();
        //             //Add 200 naira to agent total amount
        //             // $present_user->refererAmount = $referer->refererAmount + 200;


        //             //if login pass,redirect to agent dashboard page
        //             return redirect()->intended('agent/dashboard');
        //         } else {
        //             session()->flash('fail', ' Credentials Incorect');
        //             return view('auth.agent_login');
        //         }
        //     }
        //     session()->flash('fail', ' Credentials Incorect');
        //     return view('auth.agent_login');
        // }
        if($guard)
            return redirect()->route('logistics_login')->with($this->registration_success());
        else 
            return redirect()->back()->with($this->registration_error());
    }

    public function loginView()
    {
        if(Auth::guard('logistic')->check()) {
            return redirect()->route('logistics_dashboard');
        }
        return view('auth.login_logistics');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'string', 'email', 'max:255', 'exists:logistics,email'],
            'password' => ['required', 'string', 'min:6']

        ]);
        Auth::guard('logistic')->attempt(['email' => $request->email, 'password' => $request->password]);

        if (Auth::guard('logistic')->check()) {
            //Check login

            //check if profile is complete
            if(Auth::guard('logistic')->user()->phone = '')
            {
                return redirect()->route('logistics_profile')->with($this->incomplete_profile_notification());
            }

            return redirect()->route('logistics_dashboard')->with($this->login_success());
        } else {
        // $success_notification = array(
        //     'message' => 'Incorrect credentials! Try again.',
        //     'alert-type' => 'error'
        // );
        session()->flash('fail', 'Incorrect username or password');

        return redirect()->route('logistics_login');

            //   $success_notification = array(
            //     'fail' => 'You are successfully logged in!',
            //     'alert-type' => 'success'
            // );
            // return Redirect::to(Session::get('url.intended'))->with($success_notification);
        }

    }

    
    public function dashboard()
    {
        //check if dispatch company is logged in 

        if(Auth::guard('logistic')->check())
        {
            //get the authenticated dispatch company
            $dispatch_company = Auth::guard('logistic')->user();
            
            // //check if credentials are incomplete
            // if($dispatch_company->phone == '' || $dispatch_company->identification_type == '' || $dispatch_company->identification_id == '' || $dispatch_company->bvn == '')
            // {
                
            //     //if either has been provided redirect dispatch company to profile page with error message
            //     return redirect()->route('logistics_profile')->with($this->incomplete_profile_notification());
            // }
            $incomplete = $this->check_if_profile_is_complete();
            if($incomplete)
            {
                return redirect()->route('logistics_profile')->with($this->incomplete_profile_notification());
            }


            if($dispatch_company->paid == NULL) {
                return redirect()->route('logistic.pay')->with($this->incomplete_profile_notification());
            }

            //if credentials are complete, get all of the company's requests
            $requests = Logistic::find($dispatch_company->id)->delivery_request;
            $requests_count = DeliveryRequest::where('logistic_id', $dispatch_company->id)->count();

            return view('logistics.dashboard', [
                'requests' => $requests,
                'requests_count' => $requests_count
            ]);

        }

    }

    public function logisticProfile()
    {
        $states = State::all();
        return view('logistics.profile.update_profile', [
            'states' => $states
        ]);
    }

    function get_file_name_from_path($path) {

        $path_parts = pathinfo($path);
        $file_name = $path_parts['filename'];
        $file_ext = $path_parts['extension'];

        return $file_name . '.' . $file_ext;

    }

    public function updateProfile(Request $request)
    {
        if(Auth::guard('logistic')->check())
        {
            $this->validate($request, [
            'identification_type' => 'required',
            'identification_number' => 'required',
            'bvn' => 'required',
            'phone' => 'required',
            'cac' => 'nullable',
            'cac_document' => 'nullable',
            'address' => 'required',
            'profile_image' => 'nullable',
            'type_of_bike' =>'nullable',
            'plate_number' => 'nullable',

            ]);

            // dd($request->profile_image);


            $get_user = Auth::guard('logistic')->user();
            // $image = $request->profile_image->store('uploads/logistics', 'public') ?? $get_user->profile_image;
            //check if there's an existing image

            // $imagename = Str::of($get_user->first_name)->slug('-').'-'.time().'.' . $request->profile_image;

            // if($request->hasFile('profile_image'))
            // {
               
            //     $image = $request->profile_image->move(public_path('uploads/users'), $imagename);
            // }

            if ( $request->hasFile('profile_image') ) {
              $image_name = Str::of($get_user->first_name)->slug('-').'-'.time().'.'.$request->profile_image->extension();
              $request->profile_image->move(public_path('uploads/users'),$image_name);
              $request->profile_image = $image_name;
            }


            if($request->hasFile('cac_document'))
            {
                $document = $request->cac_document->store('/public/documents');

                $get_user->cac_document = $this->get_file_name_from_path($document);
            }

           

            $data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'cac' => $request->cac,
                'cac_document' => $get_user->cac_document,
                'profile_image' => $image_name ?? $get_user->profile_image,
                'bvn' => $request->bvn,
                'identification_type' => $request->identification_type,
                'identification_id' => $request->identification_number,
                'type_of_bike' => $request->type_of_bike,
                'plate_number' => $request->plate_number
            );

            


            $get_user = Auth::guard('logistic')->user();

            DB::table('logistics')->where('id', '=', $get_user->id)->update($data);

            return redirect()->route('logistic.pay')->with($this->success_notice_profile());


        }
        
    }

    public function downloadDocument($slug)
    {
        $user = DB::table('logistics')->where('slug', '=', $slug)->get();
        
        if(!$user)
        {
            abort(404);
        }

        $path = 'public/documents/' . $user[0]->cac_document;
        $name = $user[0]->first_name . ' ' . $user[0]->last_name . ' cac-document';
        return Storage::download($path, $name);   
    }

    public function makePayment()
    {
        //check if user has made payment
        $user = Auth::guard('logistic')->user();
        if($user->paid == NULL || $user->paid == 0)
        {
          return view('logistics.payment');  
        }

        return redirect()->route('logistics_dashboard')->with($this->success_notice_profile());
        
    }

    public function confirmPayment(Request $request, $ref)
    {
        // $response = Http::withHeaders([
        //     'content-type' => 'application/json',
        // ])


        $get_user = Auth::guard('logistic')->user();
        DB::table('logistics')->where('id', '=', $get_user->id)->update(['payment_id' => $ref, 'paid' => 1, 'paid_amount' => 2000]);

        return response()->json('successful', 200);
    }

    public function updateId(Request $request)
    {
        if(Auth::guard('logistic')->check())
        {
            $this->validate($request, [
                'identification_type' => 'required',
                'identification_number' => 'required',
                'bvn' => 'required',
            ]);

            $data = array(
                'identification_type' => $request->identification_type,
                'identification_id' => $request->identification_number,
                'bvn' => $request->bvn,
            );

            $get_user = Auth::guard('logistic')->user();

            DB::table('logistics')->where('id', '=', $get_user->id)->update($data);

            return redirect()->back()->with($this->success_notice_profile());


        }
    }
    public function check_if_profile_is_complete()
    {

        //check if credentials are incomplete
        if(Auth::guard('logistic')->user()->phone == '' || Auth::guard('logistic')->user()->identification_type == '' || Auth::guard('logistic')->user()->identification_id == '' || Auth::guard('logistic')->user()->bvn == '' || Auth::guard('logistic')->user()->type_of_bike == ''|| Auth::guard('logistic')->user()->plate_number == '')
        {
            return true;
            
        }

        return false;
        // return view($view, $params);
        
    }

    public function delivered()
    {
        $delivered_requests = DeliveryRequest::where('logistic_id', Auth::guard('logistic')->user()->id)->where('is_delivered', 1)->where('in_transit', 0)->get();
        
        $incomplete = $this->check_if_profile_is_complete();

        if($incomplete)
        {
            return redirect()->route('logistics_profile')->with($this->incomplete_profile_notification());
        }
        
        
        return view('logistics.requests.delivered', [
            'requests' => $delivered_requests
        ]);
    }

    public function history()
    {
        $incomplete = $this->check_if_profile_is_complete();

        if($incomplete)
        {
            return redirect()->route('logistics_profile')->with($this->incomplete_profile_notification());
        }

        $all_requests = Logistic::find(Auth::guard('logistic')->user()->id)->delivery_requests;

        return view('logistics.requests.history', [
            'requests' => $all_requests
        ]);
    }

    public function incomingRequests()
    {
        $incomplete = $this->check_if_profile_is_complete();

        if($incomplete)
        {
            return redirect()->route('logistics_profile')->with($this->incomplete_profile_notification());
        }

        $incoming_requests = DeliveryRequest::where('logistic_id', Auth::guard('logistic')->user()->id)->where('is_delivered', 0)->where('in_transit', 0)->get();

        return view('logistics.requests.incoming', [
            'requests' =>$incoming_requests
        ]);
    }

    public function requestsInTransit()
    {
        $incomplete = $this->check_if_profile_is_complete();

        if($incomplete)
        {
            return redirect()->route('logistics_profile')->with($this->incomplete_profile_notification());
        }

        $in_transit_requests = DeliveryRequest::where('logistic_id', Auth::guard('logistic')->user()->id)->where('is_delivered', 0)->where('in_transit', 1)->get();

        return view('logistics.requests.transit', [
            'requests' => $in_transit_requests
        ]);
    }

    public function transitMode(Request $request, $id)
    {
        $delivery_request = DeliveryRequest::findOrFail($id);

        $delivery_request->in_transit = 1;

        $delivery_request->save();

        $provider = $delivery_request->user->name;
        $message = 'Your package with Transaction ID ' .$delivery_request->transaction_id.  ' from ' . $provider . ' has been processed. You will recieve your package soon!';
        $sender = 'EFContact';

        try {
          SmsHelper::send_sms($message, $delivery_request->customer_phone, $sender);
        } 
        catch (\Exception $e) {
        }

        return redirect()->back()->with($this->transit_success());
    }

    public function deliveredMode($id)
    {
        $delivery_request = DeliveryRequest::findOrFail($id);

        $delivery_request->in_transit = 0;
        $delivery_request->is_delivered = 1;

        $delivery_request->save();
        
        $provider = $delivery_request->user->name;

        $message = 'Your package from ' . $provider . ' has been successfully delivered!';
        $sender = 'EFContact';

        try {
          SmsHelper::send_sms($message, $delivery_request->customer_phone, $sender);
        } 
        catch (\Exception $e) {
        }

        return redirect()->back()->with($this->transit_success());
    }

    public function profileImage(Request $request)
    {
        if(Auth::guard('logistic')->check())
        {
            $this->validate($request, [
                'profile_image' => 'required|image'
            ]);

            // if ( $request->hasFile('profile_image') ) {
            //   $image_name = time().'.'.$request->profile_image->extension();
            //   $request->profile_image->move(public_path('uploads/logistics'),$image_name);
            //   $request->profile_image = $image_name;
            // }

            $image = $request->profile_image->store('uploads/logistics', 'public');


            $get_user = Auth::guard('logistic')->user();

            //check if there's an existing image
            if($request->hasFile('profile_image'))
            {
                Storage::disk('public')->delete($get_user->image);
                $image = $request->profile_image->store('uploads/logistics', 'public');
                // $path = public_path('uploads/logistics/').$get_user->profile_image;
                // if (file_exists($path)) {
                //     unlink($path);
                // }
            }

            // $image = $request->profile_image->public('uploads/logistics', 'public');
            DB::table('logistics')->where('id', '=', $get_user->id)->update(['profile_image' => $image ?? $get_user->profile_image]);

            return redirect()->back()->with($this->success_notice_profile());


        }
    }


}
