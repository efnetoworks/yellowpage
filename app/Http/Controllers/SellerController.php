<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Notification;
use App\State;
use Image;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

use Illuminate\Support\Str;
use App\ImageUpload;
// use App\Image;
// use Image as InterventionImage;
use App\Image as ModelImage;
use App\Mail\ServiceCreated;
use App\SubCategory;
use App\PaymentRequest;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{


    public function createService()
    {
        $category = Category::orderBy('name', 'asc')->get();
        $subcategory = SubCategory::orderBy('name', 'asc')->get();
        $states = State::all();
        return view ('seller.service.create', compact('category', 'states', 'subcategory') );
    }

   public function storeService(Request $request)
    {


    $data = $request->all();
       $this->validate($request,[
        // 'description' => 'required',
        // 'category_id' => 'required',
        // 'address' => 'required',
        // 'description' => 'required',
        // 'slug' => 'unique:services,slug',
        // //'city' => 'required',
        // 'name' => 'required',
        // 'state' => 'required',
        'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', //|max:2048
    ]);
       $image = $request->file('image');
       $random = Str::random(3);
       $slug = Str::of($request->name)->slug('-').''.$random;
       $service = new Service();
/*
   if ( $request->hasFile('files') ) {
                $names = array();

foreach($request->file('files') as $image)
    {

                $image_name = $image->getClientOriginalName();

        $image->move(public_path('images'),$image_name);
        array_push($names, $image_name);

        }
            $category->image = json_encode($names);
}
*/
$slug = Str::random(5);

                // Image set up
    // if ( $request->hasFile('thumbnail') ) {
    //    $names = array();
    // foreach($request->file('thumbnail') as $image)
    // {
    //     $thumbnailImage = Image::make($image);
    //     $thumbnailImage->resize(300,300);
    //     $thumbnailImage_name = $slug.'.'.time().'.'.$image->getClientOriginalExtension();
    //     $destinationPath = 'images/';
    //            /* $image_name = $image->getClientOriginalName();
    //            $image->move(public_path('images'),$image_name);*/
    //         //$thumbnailImage_name = $thumbnailImage->getClientOriginalName();
    //            $thumbnailImage->save($destinationPath . $thumbnailImage_name);
    //            array_push($names, $thumbnailImage_name);
    //        }
    //        $service->image = json_encode($names);
    // }



        $state_details = State::where('name', $data['state'])->first();


        $service->user_id = Auth::id();
        $service->category_id = $data['category_id'];
        $service->name = $data['name'];
        $service->description = $data['description'];
        // $service->experience = $data['experience'];
        $service->phone = $data['phone'];
        $service->min_price = $data['min_price'];
        $service->state = $data['state'];
        $service->latitude = $state_details->latitude;
        $service->longitude = $state_details->longitude;
        $service->city = $data['city'];
        $service->address = $data['address'];
        $service->max_price = $data['category_id'];

       if (isset($request->is_featured)) {
            $service->is_featured = $data['is_featured'];
       }

        $service->slug = $slug;
        // $service->video_link = $request->video_link;$data['category_id'];
        $service->save();

        if ($service->save()) {
            if ($request->hasFile('thumbnail')) {
                $image       = $request->file('thumbnail');
                $fileInfo = $image->getClientOriginalName();
                $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
                $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
                $file_name= $filename.'-'.time().'.'.$extension;

                //Fullsize
                $image->move(public_path('uploads/services/'),$file_name);

                $image_resize = Image::make(public_path('uploads/services/').$file_name);
                $image_resize->fit(300, 300);
                $image_resize->save(public_path('uploads/services/' .$file_name));

                $service->images()->create(['image_path' => $file_name]);
                $service->thumbnail = $service->images()->first()->image_path;
                $service->save();
            }
        }



        $latest_service = Service::where('user_id', Auth::id())->latest()->first();
        $latest_service_id = $latest_service->id;

        $service->sub_categories()->attach($request->sub_category);

        $service_owner = Auth::user();
        $service_owner->name = Auth::user()->name;
        $service_owner->email = Auth::user()->email;


        if ($service->save()) {
            $name =  $service->name;
            $category =  $service->category->name;
            $phone =  $service->phone;
            $state =  $service->state;
            $slug =  $service->slug;

            try{
                Mail::to($service_owner->email)->send(new ServiceCreated($name, $category, $phone, $state, $slug));
            }
            catch(\Exception $e){
                $failedtosendmail = 'Failed to Mail!.';
            }
        }

       $present_user = Auth::user();
        $user_hasUploadedService = $present_user->hasUploadedService;
        if ($user_hasUploadedService == 1) {
            $success_notification = array(
                'message' => 'Service created successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('seller.service.show.service', ['id' => $latest_service_id])->with($success_notification);

        }
        $present_user->hasUploadedService = 1;
        $user_referer_id = $present_user->idOfReferer;
        $present_user->save();

        $referer = User::where('id', $user_referer_id)->first();
        if ($referer) {
        $referer->refererAmount = $referer->refererAmount + 50;
        $referer->save();

        $success_notification = array(
            'message' => 'Task was successful!',
            'alert-type' => 'success'
        );
       //$this->saveReferLink();
        // return redirect()->route('seller/service/' . $latest_service_id);
        return redirect()->route('seller.service.show.service', ['id' => $latest_service_id])->with($success_notification);

        }

        return redirect()->route('seller.service.show.service', ['id' => $latest_service_id]);

   }




public function saveReferLink($refererlink){

  $link = new Refererlink();
           $link->user_id = Auth::id();
           $link->refererlink = $refererlink;
           $link->save();
}

   public function storeServiceUpdate(Request $request, $id)
   {

    $service = Service::findOrFail($id);

    $this->validate($request,[
        'description' => 'required',
        'address' => 'required',
        'description' => 'required',
        //'city' => 'required',
        'name' => 'required',
        'state' => 'required',
        'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
           $image = $request->file('image');
    $slug = Str::random(5);
                // Image set up
    if ( $request->hasFile('files') ) {
        $names = array();
        foreach($request->file('files') as $image)
        {
            $thumbnailImage = Image::make($image);
            $thumbnailImage->resize(300,300);
            $thumbnailImage_name = $slug.'.'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'images/';
               /* $image_name = $image->getClientOriginalName();
               $image->move(public_path('images'),$image_name);*/
            //$thumbnailImage_name = $thumbnailImage->getClientOriginalName();
               $thumbnailImage->save($destinationPath . $thumbnailImage_name);
               array_push($names, $thumbnailImage_name);
           }
           $service->image = json_encode($names);
       }
     /*  $image = $request->file('image');
    // Image set up
       if ( $request->hasFile('file') ) {
        $image_name = time().'.'.$request->file->extension();
        $request->file->move(public_path('images'),$image_name);
        $service->image = $image_name;
    }*/

    $service->user_id = Auth::id();
    $service->category_id = $request->category_id;
    $service->name = $request->name;
    $service->phone = $request->phone;
    $service->city = $request->city;
    $service->experience = $request->experience;
    $service->address = $request->address;
    $service->min_price = $request->min_price;
    $service->max_price = $request->max_price;
    $service->video_link = $request->video_link;
    $service->description = $request->description;
    $service->state = $request->state;

    $service->save();

    $success_notification = array(
        'message' => 'Service created successfully!',
        'alert-type' => 'success'
    );

    return $this->allService()->with($success_notification);

}


public function unreadMessage()
{
 $all_message = Message::where('service_user_id', Auth::id() );
 $unread_message =  $all_message->Where('status', 0)->orderBy('id', 'desc')->paginate(10);
 return view ('seller.message.unread', compact('unread_message') );
}

public function readMessage()
{
    $all_message = Message::where('service_user_id', Auth::id() );
    $read_message =  $all_message->Where('status', 1)->orderBy('id', 'desc')->paginate(10);
    return view ('seller.message.read', compact('read_message') );
}

public function allMessage()
{
    $all_message = Message::where('service_user_id', Auth::id() )->orderBy('id', 'desc')->paginate(10);
    return view ('seller.message.all', compact('all_message') );
}


public function destroyMessage($id)
{
    $message = Message::findOrFail($id);
    $message->delete();
    session()->flash('status', 'Task was successful!');
    return back();
}

public function viewMessage($slug)
{
    $message = Message::where('slug', $slug)->first();
    $message->status = 1;
    $message->save();
    return view ('seller.message.view_message', compact('message') );
}

public function replyMessage($slug)
{
    $message = Message::where('slug', $slug)->first();
    return view ('seller.message.reply_message', compact('message') );
}

public function allNotification()
{
    $all_notification = Notification::paginate(8);
    return view ('seller.notification.all_notification', compact('all_notification') );
}

public function activeService()
{
    $all_service = Service::where('user_id', Auth::id() );
    $active_service =  $all_service->Where('status', 1)->paginate(5);
    return view ('seller.service.active_service', compact('active_service') );
}

public function pendingService()
{
    $all_service = Service::where('user_id', Auth::id() );
    $pending_service =  $all_service->Where('status', 0)->paginate(5);
    return view ('seller.service.pending_service', compact('pending_service') );
}

public function allService()
{

    $all_services = Service::where('user_id', Auth::id() )->get();
         return view ('seller.service.all_service', compact('all_services') );
}

public function viewServiceUpdate($slug)
{
    $category = Category::all();
    $serviceDetail = Service::where('slug', $slug)->first();
    // $images_4_service = $serviceDetail->image;
    $images_4_service = ModelImage::where('imageable_id', $serviceDetail->id)->get();
    $service = Service::where('slug', $slug)->first();
    return view ('seller.service.update_service', compact('service', 'category', 'images_4_service') );
}

public function viewService($slug)
{
    $service = Service::where('slug', $slug)->first();
    $category = Category::where('id', $service->category_id )->first();
    return view ('seller.service.view_service', compact('service', 'category') );
}

public function storeReplyMessage(Request $request)
{
    $validatedData = $request->validate([
        'description' => 'required|max:255',
    ]);

    $slug = Str::random(3);

    $message = New Message();
    $message->subject = $request->subject;
    $message->description = $request->description;
    $message->service_id = $request->service_id;
    $message->service_user_id = $request->service_user_id;
    $message->buyer_name = Auth::user()->name;
    $message->buyer_email = Auth::user()->email;
    $message->buyer_id = $request->buyer_id;
    $message->reply = 'yes';
    $message->phone = $request->phone;
    $message->slug = $slug;
    $message->save();
    $success_notification = array(
        'message' => 'Reply saved!',
        'alert-type' => 'success'
    );
    return $this->allMessage()->with($success_notification);
}

public function viewNotification($slug)
{
    $notification = Notification::where('slug', $slug)->first();
    return view ('seller.notification.view_notification', compact('notification') );
}

public function viewProfile()
{
    return view ('seller.profile.update_profile');
}

public function destroy($id)
{
    $service = Service::findOrFail($id);
    $service->delete();
    session()->flash('status', 'Task was successful!');
    return back();
}




public function post_advert() {
    return view('seller.service.post_advert');
}

public function badgeNotice()
{

    $all_service = Service::where('user_id', Auth::id() )->get();
    $active_service =  $all_service->Where('badge_type', 0);
    $active_service_count = $active_service->count();
    return view ('seller.section.badge_notification', compact('active_service_count', 'all_service') );
}

    public function getSellerPage()
    {
        $user = auth()->user();
        return view('seller.withdrawal.make_withdrawal', [
            'user' => $user
        ]);
    }

    public function PaymentHistory()
    {
        $user = auth()->user();
        $user_id = $user->id;
        $payment_history = PaymentRequest::where('user_id', $user_id)->get();

        $total_balance = DB::table('payment_requests')->where('user_id', $user_id)->sum('amount_requested') + $user->refererAmount;
        $total_requested = DB::table('payment_requests')->where(['user_id' => $user_id, 'is_paid' => 1])->sum('amount_requested');
        $total_pending = DB::table('payment_requests')->where(['user_id' => $user_id, 'is_paid' => 0])->sum('amount_requested');
        $balance = $user->refererAmount;
        return view('seller.payment_history', [
            'payment_history' => $payment_history,
            'total_balance' => $total_balance,
            'total_requested' => $total_requested,
            'balance' => $balance,
            'total_pending' => $total_pending
        ]);
    }

}
