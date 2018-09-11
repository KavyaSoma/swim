<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use session;

class HomeController extends Controller
{
    public function index(){
   $venues = DB::table('venue')
            ->selectRaw('*, venue.VenueId,venue.VenueName,venue.ShortName,venue.phone')
                  ->join('images', 'ReferenceId', '=', 'venue.VenueId')
                  ->where('venue.IsDeleted',['no'])
                  ->where('images.ImageRefType',['venue'])
                  ->where('images.IsDeleted',['N'])
                  ->orderBy('venue.VenueId')
                  ->paginate(8);
    $clubs = DB::table('clubs')
       ->selectRaw('*, clubs.ClubId,clubs.ClubName,clubs.ShortName,clubs.MobilePhone')
             ->join('images', 'ReferenceId', '=', 'clubs.ClubId')
             ->where('clubs.IsDeleted',['no'])
             ->where('images.ImageRefType',['club'])
             ->where('images.IsDeleted',['N'])
             ->orderBy('clubs.ClubId')
             ->paginate(8);
    $instructors = DB::table('users')
        ->selectRaw('*, users.UserId,users.UserName,users.Image,instructor.Experience,instructor.Specialization,instructor.Gender')
              ->join('instructor', 'InstructorId', '=', 'users.UserId')
              ->where('users.IsDeleted',['no'])
              ->where('users.UserType',['instructor'])
              ->where('users.IsUserAccepted',[1])
              ->orderBy('users.UserId')
              ->paginate(8);
   $events = DB::table('events')
       ->selectRaw('*, events.EventId,events.EventName,events.ShortName')
             ->join('eventschedules', 'eventschedules.EventId', '=', 'events.EventId')
             ->join('images','images.ReferenceId','=','events.EventId')
             ->where('eventschedules.isScheduled',['Y'])
             ->where('events.privacy',['public'])
             ->where('images.ImageRefType',['event'])
             ->where('events.IsDeleted',['No'])
             ->orderBy('events.CreatedDate')
             ->paginate(8);
    $pools = DB::table('venue')
             ->selectRaw('*,venue.VenueName,venue.ShortName,venue.VenueId,venue.Shower,venue.Gym,venue.Teachers,venue.ParaSwimmingFacilities,venue.LadiesOnlySwimming,venue.Toilets,venue.Diving,venue.PrivateHire,venue.VisitingGallery,venue.Parking,venue.SwimForKids,address.AddressLine2,address.AddressLine3')
             ->join('address','address.AddressId','=','venue.AddressId')
             ->paginate(8);
    $adds = DB::table('advertisements')
            ->selectRaw('advertisements.AdvertisementId,advertisements.AdvertisementType,advertisements.Subject,advertisements.Url,advertisements.Message,advertisements.Status,advertisements.PublishDate,advertisements.ExpireDate,images.ImagePath,images.ReferenceId')
            ->join('images','advertisements.AdvertisementId','=','images.ReferenceId')
            ->where('advertisements.AdvertisementType',['Advertisement'])
            ->where('advertisements.Status',['Accepted'])
            ->paginate(8);
   $news = DB::table('advertisements')
            ->selectRaw('advertisements.AdvertisementId,advertisements.AdvertisementType,advertisements.Subject,advertisements.Url,advertisements.Message,advertisements.Status,advertisements.PublishDate,advertisements.ExpireDate,images.ImagePath,images.ReferenceId')
            ->join('images','advertisements.AdvertisementId','=','images.ReferenceId')
            ->where('advertisements.AdvertisementType',['News'])
            ->where('advertisements.Status',['Accepted'])
            ->paginate(8);
            return view('home',['venues'=>$venues,'events'=>$events,'clubs'=>$clubs,'instructors'=>$instructors,'pools'=>$pools,'adds'=>$adds,'news'=>$news]);
            // return view('home',['venues'=>$venues,'events'=>$events,'clubs'=>$clubs,'instructors'=>$instructors,'pools'=>$pools]);
    }

    public function register(Request $request){
    	if($request->session()->has('user_id')) {
            return redirect('/');
        }
        else {
            return view('register');
        }
    }

    public function userRegistration(Request $request){
        /*
        User Registration
        @return to login view
        @condition: email,username->unique, password should be equal to confirm password
        */

  	    $this->validate($request,[
             'email' => 'required|unique:users|email|max:254',
             'username' => 'required|string|min:2|max:25|unique:users|regex:/^[a-zA-Z][a-zA-Z0-9]+(?:[ _.-][a-z0-9]+)*$/',
            'password' => 'required|string|min:8|max:15|regex:/^[a-zA-z0-9]*$/',
            'c_password' => 'required|string|min:8|max:15|regex:/^[a-zA-z0-9]*$/',
            'user_type' => 'required',
            'shortname' => 'required',
        ]);
        $name = $request->username;
        $email = $request->email;
        $password = $request->password;
        $c_password = $request->c_password;
        $user_type = $request->user_type;
        $shortname = $request->shortname;

          if($password == $c_password){
            $pass = md5($password);
            $token = rand();
                $id = DB::table('users')->insertGetId(array('UserName' => $name, 'Email' => $email, 'Password' => $pass, 'IsUserAccepted' => 0,'FirstName' => 'NA','MiddleName' => 'NA', 'LastName' =>'NA','Title' => 'NA','UserRandomId'=>0, 'UserType' => $user_type,'AddressId' => 0,'DayTimePhone' => 'NA', 'EveningPhone' => 'NA', 'IsDeleted' =>0, 'Image' => 'NA', 'Facebook' => 'NA', 'Twitter' => 'NA', 'Website' => 'NA', 'passreset' => 0, 'pm_count' => 0, 'Google_Id' => 'NA', 'Oauth_UId' => 'NA', 'ApprovalStatus' => $token, 'ShortName' =>$shortname));
                 if($id){
                    $activation_url = url("/activation/".$id.",".$token);
                    $data = array( 'email' => $email, 'name' => $name, 'user_type' =>$user_type, 'activation_url' => $activation_url );
                	Mail::send('emailtemplates.activation', $data, function($message) use($email,$name) {
               		$message->to($email, $name)->subject('Please Activate Your SwimmIQ Account');
                	$message->from('swimiqmail@gmail.com','SwimmIQ');
                	});
                    $request->session()->flash('message.level','info');
                    $request->session()->flash('message.content','Please Check Your Email For Activation Mail.');
                    return redirect('login');
                 }
                 else{
                    $request->session()->flash('message.level','danger');
                    $request->session()->flash('message.content','Unable to process request, Please try again...');
                    return redirect('login');
                 }
        }
        else{
            $request->session()->flash('message.level','danger');
            $request->session()->flash('message.content','Please Login to continue...');
            return redirect('register');
        }
    }

    public function userActivation(Request $request){
        /*
        User Activation
        @return to login view
        @condition: check id and approval status
        */
    	$pieces = explode(",",$request->id);
        if(count($pieces)>0) {
            $id = $pieces[0];
            $approval_status = $pieces[1];
            $activation = DB::select("select UserId,Email,UserName from users where UserId=? and ApprovalStatus=?",[$id,$approval_status]);
           if(count($activation)>0) {
           	    if(DB::table('users')->where('UserId',$id)->update(['UserRandomId'=>1])){
                     $email = $activation[0]->Email;
                    $name = $activation[0]->UserName;
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.content', 'Your Account Activated, Please Try Login.');
                    $data = array( 'email' => $email, 'name' => $name);
                    Mail::send('emailtemplates.activated', $data, function($message) use($email,$name) {
                        $message->to($email, $name)->subject('Your SwimmIQ Account Activated, Please Try Login');
                        $message->from('swimiqmail@gmail.com','SwimmIQ');
                    });
                    return redirect('login');
                }
                else {
                     $request->session()->flash('message.level', 'danger');
                    $request->session()->flash('message.content', 'Error Activating Account, Please Try Again.');
                    return redirect('login');
                }
            }
             else {
                 $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Either Your Account Already Activated or Error Activating Account, Please Try Again.');
                return redirect('login');
            }

        }
    }

    public function login(Request $request){
        if($request->session()->has('user_id')){
            return redirect('/');
        }
        else{
    	    return view('login');
        }
    }

    public function checkLogin(Request $request){
        /*
        Login
        @return Home view
        @condition: Email and password has to match
        */
    	$this->validate($request,[
            'email' => 'required|email|max:255',
            'password' => 'required'
            ]);
    	$email = $request->email;
    	$password = md5($request->password);
    	$check_login = DB::select('select UserId,UserName,Email,UserRandomId,UserType,Image from users where Email=? and Password=?',[$email,$password]);
    	if(count($check_login)>0){
    		if($check_login[0]->UserRandomId == 1){
    			foreach($check_login as $login){
    				$request->session()->put('user_id',$login->UserId);
    				$request->session()->put('user_name',$login->UserName);
    				$request->session()->put('user_email',$login->Email);
            $request->session()->put('user_type',$login->UserType);
            $request->session()->put('user_image',$login->Image);
            if($request->session()->has('loginredirection')) {
                    return redirect($request->session()->get('loginredirection'));
                }
                else {
            if($login->UserType == "user") {
              return redirect('/userdashboard');
            } else if($login->UserType == "instructor") {
              return redirect('/instructordashboard');
            } else if($login->UserType == "club") {
              return redirect('/clubdashboard');
            } else if($login->UserType == "venue") {
              return redirect('/venuedashboard');
            } else if($login->UserType == "admin") {
              return redirect('/admindashboard');
            } else {
          			$request->session()->flash('message.level','info');
          			$request->session()->flash('message.content','Please Activate your SwimmIQ account via the Activation Link sent to your Email');
          			return redirect('/login');
          		}
                        }
            }
    				} else {
              $request->session()->flash('message.level','info');
              $request->session()->flash('message.content','Please Activate your SwimmIQ account via the Activation Link sent to your Email');
              return redirect('/login');
            }
    		}
    		else{
    		$request->session()->flash('message.level','danger');
    		$request->session()->flash('message.content','Email or Password didnot match,Please Try Again');
    		return redirect('login');
    	}
    }

    public function forgot(Request $request){
        if($request->session()->has('user_id')){
            return redirect('/');
        }
        else{
        return view('forgotpassword');
        }
    }

    public function emailCheck(Request $request){
        /*
        Email check for forgot password
        @Send Email and return forgotpassword view
        @condition: email has to match with database email
        */
       $this->validate($request,[
            'email' => 'required|email|max:255',
        ]);
        $email = $request->email;
        $check_email = DB::select('select UserId,UserName from users where Email=? and UserRandomId=?',[$email,1]);
        if(count($check_email)>0){
           $id = $check_email[0]->UserId;
           $token = rand();
           DB::table('users')->where('UserId',$id)->update(['ApprovalStatus'=>$token]);
            $activation_url = url("/changepassword/".$id.",".$token);
            $data = array('activation_url' => $activation_url);
            Mail::send('emailtemplates.forgotpassword',$data,function($message) use($email){
                $message->to($email,'')->subject('Please Reset your SWIMMIQ password');
                $message->from('swimmiqmail@gmail.com','SWIMMIQ');
            });
            $request->session()->flash('message.level','info');
            $request->session()->flash('message.content','Please Check your Email to reset your password');
            return redirect('forgotpassword');
           }
           else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Please check your Email, Either the email not available in our database or Activation pending for the Email...');
                return redirect('forgotpassword');
           }
    }

    public function changePassword(Request $request){
        /*
        Changepassword
        @return changepassword view
        @condition: id and token have to match with database
        */
        if($request->session()->has('user_id')){
            return redirect('/');
        }
        else{
            $pieces = explode(",",$request->id);
            $id = $pieces[0];
            $token = $pieces[1];
            $activation = DB::select('select UserId,UserName from users where UserId=? and ApprovalStatus=?',[$id,$token]);
            if(count($activation)>0){
                return view('changepassword',['id'=>$id,'token'=>$token]);
            }
            else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Invalid Change Password Request ');
                return redirect('forgotpassword');
            }
        }
    }

    public function updatePassword(Request $request){
        /*
        Update Password
        @return login view
        @condition: password and confirm password has to match.
        */
        if($request->session()->has('user_id')){
            return redirect('/');
        }
        else{
        $this->validate($request,[
            'pass' => 'required|string',
            'c_password' => 'required|string',
            'id' =>'required',
            'token' => 'required'
        ]);
        $password = $request->pass;
        $c_password = $request->c_password;
        $id = $request->id;
        $token = $request->token;
           if($password == $c_password){
              $pass = md5($password);
              if(DB::update('update users set Password=?,ApprovalStatus=? where UserId=? and ApprovalStatus=?',[$pass,0,$id,$token])){
                $request->session()->flash('message.level', 'info');
                $request->session()->flash('message.content', 'Your Password Changed, Please Login Now.');
                return redirect('login');
              }
              else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Unable to change your Password, Please Try Again.');
                return redirect('login');
              }
           }
           else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Passwords are Different, Please Try Again.');
                return view('changepassword',['id' => $id,'token'=>$token]);
           }
        }
    }

    public function logout(Request $request){
    	$request->session()->flush();

        return redirect('/');
    }
    
    public function About(Request $request){
    return view('about');
   }  
   public function howitWorks(Request $request){
    return view('howitworks');
   }
   public function contact(Request $request){
    return view('contactus');
   }
   public function contactUs(Request $request){
   $name = $request->name;
   $email = $request->email;
   $subject = $request->subject;
   $message = $request->message;
  $data = array('email'=>$email,'name'=>$name,'subject'=>$subject,'content'=>$message);
   Mail::send('emailtemplates.contact', $data, function($mesage) use($email,$name) {
            $mesage->to($email, $name)->subject('Message Sent successfully');
             $mesage->from('chandragirimounika210@gmail.com','SwimmIQ');
           });
         $request->session()->flash('message.level','info');
         $request->session()->flash('message.content','Thankyou for contacting us.Your message is very precious for us.');
           Mail::send('emailtemplates.contactus', $data, function($msg) use($email,$name,$subject,$message) {
             $msg->to('chandragirimounika210@gmail.com', 'SwimmIQ')->subject('New Message');
            $msg->from('chandragirimounika210@gmail.com','SwimmIQ');
           });
   return view('contactus');
  }

   public function Questions(Request $request){
    return view('frequentquestions');
   }
   public function TermsandConditions(Request $request){
    return view('terms_and_conditions');
   }
   public function privacyPolicy(Request $request){
    return view('privacy_policy');
   }
   public function News(Request $request){
    return view('news');
   }
   public function Disclaimer(Request $request){
    return view('disclaimer');
   }
   
   public function search(Request $request){
    
       $userid = $request->session()->get('user_id');
       $search_term='';
       if($request->has('search_term')) {
        $search_term = $request->search_term;
       }

       if($search_term == '') { 
     $venues = DB::table('venue')
         ->selectRaw('*, venue.VenueId,venue.VenueName,venue.ShortName,venue.phone')
              ->join('images', 'ReferenceId', '=', 'venue.VenueId')
               ->where('venue.IsDeleted',['no'])
               ->where('images.ImageRefType',['venue'])
             ->where('images.IsDeleted',['N'])
               ->orderBy('venue.VenueId')
               ->paginate(4);

   $clubs = DB::table('clubs')
       ->selectRaw('*, clubs.ClubId,clubs.ClubName,clubs.ShortName,clubs.MobilePhone')
             ->join('images', 'ReferenceId', '=', 'clubs.ClubId')
             ->where('clubs.IsDeleted',['no'])
             ->where('images.ImageRefType',['club'])
            ->where('images.IsDeleted',['N'])
             ->orderBy('clubs.ClubId')
             ->paginate(4);
    $instructors = DB::table('users')
        ->selectRaw('*, users.UserId,users.UserName,users.Image,instructor.Experience,instructor.Specialization,instructor.Gender')
              ->join('instructor', 'InstructorId', '=', 'users.UserId')
              ->where('users.IsDeleted',['no'])
              ->where('users.UserType',['instructor'])
              ->where('users.IsUserAccepted',[1])
              ->orderBy('users.UserId')
              ->paginate(4);
   $events = DB::table('events')
       ->selectRaw('*, events.EventId,events.EventName,events.ShortName')
             ->join('eventschedules', 'eventschedules.EventId', '=', 'events.EventId')
             ->join('images','images.ReferenceId','=','events.EventId')
             ->where('eventschedules.isScheduled',['Y'])
             ->where('events.privacy',['public'])
             ->where('images.ImageRefType',['event'])
             ->where('events.IsDeleted',['No'])
             ->orderBy('events.CreatedDate')
             ->paginate(4);
   $users = DB::table('users')
        ->selectRaw('*, users.*')
              ->where('users.IsDeleted',['no'])
              ->where('users.UserType',['user'])
              ->where('users.IsUserAccepted',[1])
              ->orderBy('users.UserId')
              ->paginate(4);
               return view('searchall',['venues'=>$venues,'events'=>$events,'clubs'=>$clubs,'instructors'=>$instructors,'users'=>$users,'search_term'=>$search_term,'search_type'=>'all']);
    
            } 
            else {
            $venues = DB::table('venue')
         ->selectRaw('*, venue.VenueId,venue.VenueName,venue.ShortName,venue.phone')
               ->join('images', 'ReferenceId', '=', 'venue.VenueId')
               ->where('venue.IsDeleted',['no'])
               ->where('venue.VenueName','like','%'.$search_term.'%')
               ->where('images.ImageRefType',['venue'])
               ->where('images.IsDeleted',['N'])
               ->orderBy('venue.VenueId')
               ->paginate(4);
               
 $clubs = DB::table('clubs')
       ->selectRaw('*, clubs.ClubId,clubs.ClubName,clubs.ShortName,clubs.MobilePhone')
             ->join('images', 'ReferenceId', '=', 'clubs.ClubId')
             ->where('clubs.IsDeleted',['no'])
             ->where('clubs.ClubName','like','%'.$search_term.'%')
             ->where('images.ImageRefType',['club'])
             ->where('images.IsDeleted',['N'])
             ->orderBy('clubs.ClubId')
             ->paginate(4);
    $instructors = DB::table('users')
        ->selectRaw('*, users.UserId,users.UserName,users.Image,instructor.Experience,instructor.Specialization,instructor.Gender')
              ->join('instructor', 'InstructorId', '=', 'users.UserId')
              ->where('users.IsDeleted',['no'])
              ->where('users.UserType',['instructor'])
              ->where('users.IsUserAccepted',[1])
              ->where('users.UserName','like'.$search_term.'%')
              ->orderBy('users.UserId')
              ->paginate(4);
    $events = DB::table('events')
           ->selectRaw('*, events.EventId,events.EventName,events.ShortName')
               ->join('eventschedules', 'eventschedules.EventId', '=', 'events.EventId')
               ->join('images','images.ReferenceId','=','events.EventId')
               ->where('eventschedules.isScheduled',['Y'])
               ->where('events.privacy',['public'])
               ->where('images.ImageRefType',['event'])
               ->where('events.IsDeleted',['No'])
               ->where('events.EventName','like'.$search_term.'%')
               ->orderBy('events.CreatedDate')
               ->paginate(4);
   $users = DB::table('users')
        ->selectRaw('*, users.*')
              ->where('users.IsDeleted',['no'])
              ->where('users.UserType',['user'])
              ->where('users.IsUserAccepted',[1])
              ->where('users.UserName','like','%'.$search_term.'%')
              ->orderBy('users.UserId')
              ->paginate(4);

      return view('searchall',['venues'=>$venues,'events'=>$events,'clubs'=>$clubs,'instructors'=>$instructors,'users'=>$users,'search_term'=>$search_term,'search_type'=>'all']);
    
    
            }

   
    }

    public function searchEvents(Request $request){
    $userid = $request->session()->get('user_id');
     $search_term='';
       if($request->has('search_term')) {
        $search_term = $request->search_term;
       }
       if($search_term == ''){
        $events = DB::table('events')
            ->selectRaw('*, events.EventId,events.EventName,events.ShortName')
                  ->join('eventschedules', 'eventschedules.EventId', '=', 'events.EventId')
                  ->join('images','images.ReferenceId','=','events.EventId')
                  ->where('eventschedules.isScheduled',['Y'])
                  ->where('events.privacy',['public'])
                  ->where('images.ImageRefType',['event'])
                  ->where('events.IsDeleted',['No'])
                  ->orderBy('events.CreatedDate')
                  ->paginate(8);
              return view('searchevents',['events'=>$events,'search_term'=>$search_term,'search_type'=>'events']);
       }
      else{
          $events = DB::table('events')
           ->selectRaw('*, events.EventId,events.EventName,events.ShortName')
                 ->join('eventschedules', 'eventschedules.EventId', '=', 'events.EventId')
                 ->join('images','images.ReferenceId','=','events.EventId')
                 ->where('eventschedules.isScheduled',['Y'])
                 ->where('events.privacy',['public'])
                 ->where('images.ImageRefType',['event'])
                 ->where('events.EventName','like'.$search_term.'%')
                 ->where('events.IsDeleted',['No'])
                 ->orderBy('events.CreatedDate')
                 ->paginate(8);
              return view('searchevents',['events'=>$events,'search_term'=>$search_term,'search_type'=>'events']);
      }
      
    }

    public function searchClubs(Request $request){

        $userid = $request->session()->get('user_id');
       $search_term = '';
       if($request->has('search_term')){
        $search_term = $request->search_term;
       }
       if($search_term == ''){
      $clubs = DB::table('clubs')
       ->selectRaw('*, clubs.ClubId,clubs.ClubName,clubs.ShortName,clubs.MobilePhone')
             ->join('images', 'ReferenceId', '=', 'clubs.ClubId')
             ->where('clubs.IsDeleted',['no'])
             ->where('images.ImageRefType',['club'])
             ->where('images.IsDeleted',['N'])
             ->orderBy('clubs.ClubId')
             ->paginate(8);
                 return view('searchclubs',['clubs'=>$clubs,'search_term'=>$search_term,'search_type'=>'clubs']);
       }
       else{
            $clubs = DB::table('clubs')
       ->selectRaw('*, clubs.ClubId,clubs.ClubName,clubs.ShortName,clubs.MobilePhone')
             ->join('images', 'ReferenceId', '=', 'clubs.ClubId')
             ->where('clubs.IsDeleted',['no'])
             ->where('clubs.ClubName','like','%'.$search_term.'%')
             ->where('images.ImageRefType',['club'])
             ->where('images.IsDeleted',['N'])
             ->orderBy('clubs.ClubId')
             ->paginate(8);
                 return view('searchclubs',['clubs'=>$clubs,'search_term'=>$search_term,'search_type'=>'clubs']);
       }
 
 
    }

    public function searchVenues(Request $request){
   
        $userid = $request->session()->get('user_id');
        $search_term = '';
        if($request->has('search_term')){
          $search_term = $request->search_term;
        }
        if($search_term == ''){
         $venues = DB::table('venue')
         ->selectRaw('*, venue.VenueId,venue.VenueName,venue.ShortName,venue.phone')
               ->join('images', 'ReferenceId', '=', 'venue.VenueId')
               ->where('venue.IsDeleted',['no'])
               ->where('images.ImageRefType',['venue'])
               ->where('images.IsDeleted',['N'])
               ->orderBy('venue.VenueId')
               ->paginate(8);
            return view('searchvenues',['venues'=>$venues,'search_term'=>$search_term,'search_type'=>'venues']); 
        }
        else{
            $venues = DB::table('venue')
         ->selectRaw('*, venue.VenueId,venue.VenueName,venue.ShortName,venue.phone')
               ->join('images', 'ReferenceId', '=', 'venue.VenueId')
               ->where('venue.IsDeleted',['no'])
               ->where('venue.VenueName','like','%'.$search_term.'%')
               ->where('images.ImageRefType',['venue'])
               ->where('images.IsDeleted',['N'])
               ->orderBy('venue.VenueId')
               ->paginate(8);
            return view('searchvenues',['venues'=>$venues,'search_term'=>$search_term,'search_type'=>'venues']);
        }
        
    
    }

    public function serachInstructors(Request $request){
     
        $userid = $request->session()->get('user_id');
        $search_term = '';
        if($request->has('search_term')){
          $search_term = $request->search_term;
        }
        if($search_term == '')
        {
          $instructors = DB::table('users')
        ->selectRaw('*, users.UserId,users.UserName,users.Image,instructor.Experience,instructor.Specialization,instructor.Gender')
              ->join('instructor', 'InstructorId', '=', 'users.UserId')
              ->where('users.IsDeleted',['no'])
              ->where('users.UserType',['instructor'])
              ->where('users.IsUserAccepted',[1])
              ->orderBy('users.UserId')
              ->paginate(8);
              return view('searchinstructors',['instructors'=>$instructors,'search_term' => $search_term,'search_type'=>'instrucors']);
        }
         else{
          $instructors = DB::table('users')
        ->selectRaw('*, users.UserId,users.UserName,users.Image,instructor.Experience,instructor.Specialization,instructor.Gender')
              ->join('instructor', 'InstructorId', '=', 'users.UserId')
              ->where('users.IsDeleted',['no'])
              ->where('users.UserType',['instructor'])
              ->where('users.IsUserAccepted',[1])
              ->where('users.UserName','like','%'.$search_term.'%')
              ->orderBy('users.UserId')
              ->paginate(8);
              return view('searchinstructors',['instructors'=>$instructors,'search_term' => $search_term,'search_type'=>'instructors']);
         } 
          
     
    }

    public function searchUsers(Request $request){
    
        $userid = $request->session()->get('user_id');
        $search_term = '';
        if($request->has('search_term')){
          $search_term = $request->search_term;
        }
        if($search_term == ''){
              $users = DB::table('users')
                ->selectRaw('*, users.*')
              ->where('users.IsDeleted',['no'])
              ->where('users.UserType',['user'])
              ->where('users.IsUserAccepted',[1])
              ->orderBy('users.UserId')
              ->paginate(8);
             return view('searchusers',['users'=>$users,'search_term' => $search_term,'search_type'=>'users','search_type'=>'users']);
        }
        else{
           $users = DB::table('users')
                ->selectRaw('*, users.*')
              ->where('users.IsDeleted',['no'])
              ->where('users.UserType',['user'])
              ->where('users.IsUserAccepted',[1])
              ->where('users.UserName','like','%'.$search_term.'%')
              ->orderBy('users.UserId')
              ->paginate(8);
             return view('searchusers',['users'=>$users,'search_term' => $search_term,'search_type'=>'users','search_type'=>'users']);
        }    
    }
    
    public function checkFacebookEmail(Request $request) {
      $name = $request->name;
      $email = $request->email;
      echo $email;
      $image = $request->image;
      $users = DB::select ("select id,name,email,user_image from users where email=?",[$email]);
      if(count($users)>0) {
       $request->session()->put('user_id', $users[0]->id);
       $request->session()->put('user_name', $users[0]->name);
       $request->session()->put('user_email', $users[0]->email);
       $request->session()->put('user_image', $image);
      }
      else {
           $id = DB::table('users')->insertGetId(array('name' => $name, 'email' => $email, 'password' => md5('Welcome123'), 'activation_token' => rand(1,10), 'is_active' => 1, 'is_activated' => 1,'user_image' => $image, 'last_login_ip' => 'NA'));
           $request->session()->put('user_id', $id);
       $request->session()->put('user_name', $name);
       $request->session()->put('user_email', $email);
       $request->session()->put('user_image', $image);
       }
       $data = array(  );
               Mail::send('emailtemplates.sociallogin', $data, function($message) use($email,$name) {
                       $message->to($email, $name)->subject('Welcome To SwimmIQ');
                       $message->from('swimiqmail@gmail.com','SwimmIQ');
               });
       if($request->session()->has('loginredirection')) {
                   return redirect($request->session()->get('loginredirection'));
               }
               else {
                   return redirect('/');
               }
    }
    public function duplicatemail(Request $request){
     $email = $request->email;
     $check_mail = DB::select('select Email from users where Email=?',[$email]);
     if(count($check_mail)>0){
       echo "error";
     }
     else{
       echo "success";
     }
   }

   

}
