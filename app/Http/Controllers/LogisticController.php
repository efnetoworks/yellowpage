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
            'name'                  => ['required', 'string', 'max:255'],
            'company_name'          => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'                 => ['required', 'numeric'],
            'password'              => ['required', 'string', 'min:6'],
            'terms'                 => ['accepted'],

        ]);
        $number = mt_rand(3, 5);
        $data = array(
            'name' => $request->name,
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
            
            //check if credentials are incomplete
            if($dispatch_company->phone == '' || $dispatch_company->identification_type == '' || $dispatch_company->identification_id == '' || $dispatch_company->bvn == '')
            {
                
                //if either has been provided redirect dispatch company to profile page with error message
                return redirect()->route('logistics_profile')->with($this->incomplete_profile_notification());
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

    public function updateProfile(Request $request)
    {
        if(Auth::guard('logistic')->check())
        {
            $this->validate($request, [
            'phone' => 'required'
            ]);

            $data = array(
                'name' => $request->name,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'phone' => $request->phone
            );

            $get_user = Auth::guard('logistic')->user();

            DB::table('logistics')->where('id', '=', $get_user->id)->update($data);

            return redirect()->back()->with($this->success_notice_profile());


        }
        
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
        if(Auth::guard('logistic')->user()->phone == '' || Auth::guard('logistic')->user()->identification_type == '' || Auth::guard('logistic')->user()->identification_id == '' || Auth::guard('logistic')->user()->bvn == '')
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
