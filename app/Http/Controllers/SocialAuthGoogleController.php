<?php

// SocialAuthGoogleController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Socialite;
use DB;
use Google_Client;
use Google_Service_People;
use Mail;

class SocialAuthGoogleController extends Controller
{
  /**
   * Create a redirect method to google api.
   *
   * @return void
   */
    public function googlelogin()
    {
        return Socialite::driver('google')
        ->scopes(['openid', 'profile', 'email', Google_Service_People::CONTACTS_READONLY])
        ->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function googlecallback(Request $request)
    {
       $user = Socialite::driver('google')->user();
       $name = $user->name;
       $email = $user->email;
       $image = $user->avatar;
       if( $email=="") {
        $request->session()->flash('message.level', 'danger');
        $request->session()->flash('message.content', 'Unable To Retrive Your Email From Google Account, Please Try Again.');
        return redirect('login');
       }
       else{
       $users = DB::select ("select UserId,UserName,Email,Image from users where Email=?",[$email]);
       if(count($users)>0) {
        $request->session()->put('user_id', $users[0]->id);
        $request->session()->put('user_name', $users[0]->name);
        $request->session()->put('user_email', $users[0]->email);
        $request->session()->put('user_image', $image);
       }
        else {
             $id = DB::table('users')->insertGetId(array('UserName' => $name, 'Email' => $email, 'Password' => md5('Welcome123'), 'IsUserAccepted' => 1,'FirstName' => 'NA','MiddleName' => 'NA', 'LastName' =>'NA','Title' => 'NA','UserRandomId'=>'NA', 'UserType' => 'NA','AddressId' => 0,'DayTimePhone' => 'NA', 'EveningPhone' => 'NA', 'IsDeleted' =>0, 'Image' => $image, 'Facebook' => 'NA', 'Twitter' => 'NA', 'Website' => 'NA', 'passreset' => 0, 'pm_count' => 0, 'Google_Id' => 'NA', 'Oauth_UId' => 'NA', 'ApprovalStatus' => 'NA', 'ShortName' =>'NA'));
            $request->session()->put('user_id', $id);
        $request->session()->put('user_name', $name);
        $request->session()->put('user_email', $email);
        $request->session()->put('user_image', $image);
        $data = array();
                Mail::send('emailtemplates.sociallogin', $data, function($message) use($email,$name) {
                        $message->to($email, $name)->subject('Welcome To Swimmiq');
                        $message->from('swimmiqmail@gmail.com','SwimmIQ');
                });
        }
                if($request->session()->has('loginredirection')) {
                    return redirect($request->session()->get('loginredirection'));
                }
                else {
                    return redirect('/');
                }
       }
    }
}
