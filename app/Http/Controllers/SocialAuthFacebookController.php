<?php

// SocialAuthFacebookController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Socialite;
use DB;
use Mail;

class SocialAuthFacebookController extends Controller
{
  /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    public function facebooklogin()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function facebookcallback(Request $request)
    {
       $user = Socialite::driver('facebook')->user();
       $name = $user->name;
       $email = $user->email;
       $image = $user->avatar;
       $user_type = 'user';
       $shortname='';
       $pass = md5('Welcome123');
       if( $email=="") {
        return view('getfacebookemail',['name'=>$name,'image'=>$image]);
       }
       else{
       $users = DB::select ("select UserId,UserName,Email,Image from users where Email=?",[$email]);
       if(count($users)>0) {
        $request->session()->put('user_id', $users[0]->UserId);
        $request->session()->put('user_name', $users[0]->UserName);
        $request->session()->put('user_email', $users[0]->Email);
        $request->session()->put('user_image', $image);
       }
       else {
                $pieces = explode('@',$email);
                $shortname = $pieces[0];
                $id = DB::table('users')->insertGetId(array('UserName' => $name, 'Email' => $email, 'Password' => $pass, 'IsUserAccepted' => 1,'FirstName' => $name,'MiddleName' => 'NA', 'LastName' =>'NA','Title' => 'NA','UserRandomId'=>0, 'UserType' => $user_type,'AddressId' => 0,'DayTimePhone' => 'NA', 'EveningPhone' => 'NA', 'IsDeleted' =>0, 'Image' => $image, 'Facebook' => 'NA', 'Twitter' => 'NA', 'Website' => 'NA', 'passreset' => 0, 'pm_count' => 0, 'Google_Id' => 'NA', 'Oauth_UId' => 'NA', 'ApprovalStatus' => '', 'ShortName' =>$shortname));
                $request->session()->put('user_id', $id);
                $request->session()->put('user_name', $name);
                $request->session()->put('user_email', $email);
                $request->session()->put('user_image', $image);
                $data = array();
                Mail::send('emailtemplates.sociallogin', $data, function($message) use($email,$name) {
                        $message->to($email, $name)->subject('Welcome To SwimmIQ');
                        $message->from('swimmiqmail@gmail.com','SwimmIQ');
                });
        }
        if($request->session()->has('loginredirection')) {
            return redirect($request->session()->get('loginredirection'));
        }
        else {
            return redirect('/userdashboard');
        }
       }
    }
}
