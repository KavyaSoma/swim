<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use Mail;
use Excel;

class UserController extends Controller
{
    public function getFavourites(Request $request) {
      $type = $request->type;
      $id = $request->id;
      $uid = $request->uid;

      $total_favourites = DB::select('select count(FavouriteId) as count from favourites where UserId=? and FavouriteType=? and Attribute=? and Flag=?',[$uid,$type,$id,'Yes']);

      $is_user_favourite = DB::select('select FavouriteId from favourites where UserId=? and FavouriteType=? and Attribute=? and Flag=?',[$uid,$type,$id,'Yes']);

      if(count($is_user_favourite) > 0) {
        echo "yes,".$total_favourites[0]->count;
      } else {
        echo "no,".$total_favourites[0]->count;
      }
    }

    public function manageFavourites(Request $request) {
      $type = $request->type;
      $id = $request->id;
      $uid = $request->uid;

      $is_user_favourite = DB::select('select FavouriteId,Flag from favourites where UserId=? and FavouriteType=? and Attribute=?',[$uid,$type,$id]);

      if(count($is_user_favourite) > 0) {
        if($is_user_favourite[0]->Flag == "Yes") {
            DB::update('update favourites set Flag=? where UserId=? and FavouriteType=? and Attribute=?',['No',$uid,$type,$id]);
            echo 'no';
        } else {
           DB::update('update favourites set Flag=? where UserId=? and FavouriteType=? and Attribute=?',['Yes',$uid,$type,$id]);
           echo 'yes';
        }
      } else {
        DB::insert('insert into favourites(Flag,UserId,FavouriteType,Attribute) values (?,?,?,?)',['Yes',$uid,$type,$id]);
        echo "yes";
      }
      if($type == "venue") {
                $total_favourites = DB::select('select count(FavouriteId) as count from favourites where UserId=? and FavouriteType=? and Attribute=? and Flag=?',[$uid,$type,$id,'Yes']);
                DB::update('update address set favCount=? where AddressId=?',[$total_favourites[0]->count,$id]);
            }
    }

    public function getImages(Request $request) {
      $type = $request->type;
      $id = $request->id;
      $uid = $request->uid;

      $image = DB::select('select ImagePath from images where ImageRefType=? and ReferenceId=? and IsDeleted=?',[$type,$id,'N']);

      if(count($image) > 0) {
        if(file_exists(url('public/images/'.$image[0]->ImagePath))) {
            echo url('public/images/'.$image[0]->ImagePath);
        } else {
            echo url("public/images/".$type.".jpg");
        }
      } else {
            echo url("public/images/".$type.".jpg");
      }
    }
    
    public function mailbox(Request $request){
    	if($request->session()->has('user_id')){
    		$user_email = $request->session()->get('user_email');
    		$incoming_messages = DB::select('select DISTINCT m.Sender,m.MessageId,m.Subject,m.Message,m.date,m.Status,u.UserType,u.UserId from messages m INNER JOIN users u where m.Receiver=? and u.Email=m.Sender and m.isArchived=? ORDER BY MessageId DESC',[$user_email,"no"]);
    		return view('inbox',['incoming'=>$incoming_messages]);
    	}
    	else{
    		
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','please login to continue..');
  			return view('login');
  		}
    }
    public function sendMsg(Request $request){
    	if($request->session()->get('user_id')){
    	//	$check_mail = DB::select('SELECT UserName,Email FROM users WHERE UserName LIKE 'B%';')
    		return view('sendmessage',['show_values'=>'yes']);
    	}
    	else{
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','please login to continue..');
  			return view('login');
  		}
    }      
    public function sendMail(Request $request){
        $user_email = $request->session()->get('user_email');  
    	$to_mail = $request->to_mail;
    	$subject = $request->subject;
    	$message = $request->message;
    	$attachment = $request->attachment;
    	//echo $attachment;
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = 20;
    	$incoming_messages = DB::select('select m.MessageId,m.Sender,m.Subject,m.Message,m.date,u.UserType from messages m INNER JOIN users u where m.Receiver=? and u.Email=? ORDER BY MessageId DESC',[$user_email,$user_email]);
    	$send_mail = DB::table('messages')->InsertGetId(array('Receiver'=>$to_mail,'Sender'=>$user_email,'Subject'=>$subject,'Message'=>$message,'IsReceived'=>'no','RepliedTo'=>0,'isArchived'=>'no','Status'=>0));
    	if($send_mail){
    		if(Input::hasFile('attachment')){
            $file = Input::file('attachment');
            $randomString = '';
            for ($i = 0; $i < 20; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $file->move('./public/images/messages', $randomString);
            $image = url("public/images/messages/".$randomString);
            $image_insert = DB::table('images')->insertGetId(array('ImagePath'=>$image,'ImageRefType'=>'Message','ReferenceId'=>$send_mail));
        }
        else {
            $image = "NA";
        }
        	$request->session()->flash('message.level','success');
  			  $request->session()->flash('message.content','Message Send Sucessfully..');
        	return redirect('sentmessage');
    	}
    	else{
    		$request->session()->flash('message.level','info');
  			$request->session()->flash('message.content','Message not Send.Please, Try again..');
  			return view('mail',['incoming'=>$incoming_messages]);
    	}
    }
    public function sentMessage(Request $request){
    	if($request->session()->has('user_id')){
    		$user_email = $request->session()->get('user_email');
    		$outgoing_messages = DB::select('select m.MessageId,m.Receiver,m.Subject,m.Message,m.date,u.UserType,u.UserId from messages m INNER JOIN users u where m.Sender=? and m.isArchived=? and  u.Email=m.Receiver ORDER BY MessageId DESC',[$user_email,'no']);
    		if(count($outgoing_messages) > 0) {
                return view('sentmessage',['outgoing'=>$outgoing_messages]);
                }
                else{
    	        $request->session()->flash('message.level','info');
  		$request->session()->flash('message.content','No messages in Sent Folder, Redirected to Inbox ');
  		return redirect('inbox');
    		}    
    	}
    	else{
    		
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','please login to continue..');
  			return view('login');
  		}
    }
    public function archiveMessage(Request $request){
    	if($request->session()->get('user_id')){
    		$user_email = $request->session()->get('user_email');
    		$user_id = $request->session()->get('user_id');
    		$archive_messages = DB::select('select m.MessageId,m.Sender,m.Receiver,m.Subject,m.Message,m.date,u.UserType,u.UserId from messages m INNER JOIN users u where m.Receiver=? and m.isArchived=? and u.Email=m.Receiver ORDER BY MessageId DESC',[$user_email,'yes']);
    		if(count($archive_messages)>0){
    		$sender = $archive_messages[0]->Sender;
    		$receiver = $archive_messages[0]->Receiver;
    		$sender_details = DB::select('select UserId from users where Email=?',[$sender]);
    		$sender_id = $sender_details[0]->UserId;
    		$receiver_details = DB::select('select UserId from users where Email=?',[$receiver]);
    		$receiver_id = $receiver_details[0]->UserId;
    		return view('archievemessage',['archive_messages'=>$archive_messages,'sender_id'=>$sender_id,'receiver_id'=>$receiver_id,'user_id'=>$user_id,'user_email'=>$user_email]);
    		}
    		else{
    			$request->session()->flash('message.level','info');
  				$request->session()->flash('message.content','No messages are archived, Redirected to Inbox ');
  				return redirect('inbox');
    		}
    	}
    	else{
    		
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','please login to continue..');
  			return view('login');
  		}
    }

    public function viewmessage(Request $request){
    	if($request->session()->has('user_id')){
    		$user_email = $request->session()->get('user_email');
    		$pieces = explode(',',$request->id);
    		$sender_id = $pieces[0];
    		$message_id = $pieces[1];
    		$sender_mail = DB::select('select Email from users where UserId=?',[$sender_id]);
    		if(count($sender_mail)>0){
    		$sender = $sender_mail[0]->Email;
    		$messages = DB::select('select MessageId,Sender,Receiver,Subject,Message,date,isArchived from messages where MessageId=?',[$message_id]);
        $subject = $messages[0]->Subject;
    		$reply_messages = DB::select('select MessageId,Sender,Receiver,Subject,Message,date ,isArchived from messages where RepliedTo=?',[$message_id]);

    		if(count($messages)>0){
    		$update_status = DB::update('update messages set Status=? where (Sender=? and Receiver=?) or (Receiver=? and Sender=?)',[1,$sender,$user_email,$sender,$user_email]);
    		$archive = $messages[0]->isArchived;
    		$msgcount = count($messages);
    		$outgoing_messages = DB::select('select MessageId,Receiver,Subject,Message,date from messages where Sender=?',[$user_email]);
    		return view('viewmessage',['messages'=>$messages,'outgoing'=>$outgoing_messages,'sender_id'=>$sender_id,'message_id'=>$message_id,'archive'=>$archive,'sender'=>$sender,'msgcount'=>$msgcount,'user_email'=>$user_email,'replymessage'=>$reply_messages,'subject'=>$subject]);
    		}
    		else{
    			$request->session()->flash('message.level','danger');
  				$request->session()->flash('message.content','Conversation not started with the user..');
    			return redirect('inbox');
    		}
    		}
    	}
    	else{
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','please login to continue..');
  			return view('login');
  		}
    }
    public function sendReply(Request $request){
    	$url_id = $request->id;
    	$pieces = explode(',',$request->id);
    	$sender_id = $pieces[0];
    	$message_id = $pieces[1];
    	$user_email = $request->session()->get('user_email');
    	$subject = $request->subject;
    	$message = $request->message;
    	$to_mail = $request->to_mail;
    	$attachment = $request->attachment;
    	
    	$send_reply = DB::table('messages')->InsertGetId(array('Receiver'=>$to_mail,'Sender'=>$user_email,'Subject'=>$subject,'Message'=>$message,'IsReceived'=>'no','RepliedTo'=>$message_id,'isArchived'=>'no','Status'=>0));
    	if($send_reply){
    		$request->session()->flash('message.level','success');
  			$request->session()->flash('message.content','Message Send Sucessfully..');
        	return redirect('replymessage/'.$url_id);
    	}
    	else{
    		$request->session()->flash('message.level','info');
  			$request->session()->flash('message.content','Message not Send.Please, Try again..');
  			return redirect('replymessage/'.$url_id);
    	}
    }

    public function archive(Request $request){
    	if($request->session()->has('user_id')){
    		$user_id = $request->session()->get('user_id');
    		$pieces = explode(',',$request->id);
    		$sender_id = $pieces[0];
    		$message_id = $pieces[1];
    		$check_archive = DB::select('select isArchived,Sender,Receiver from messages where MessageId=?',[$message_id]);
    		if(count($check_archive)>0){
    		$archive_info = $check_archive[0]->isArchived;
    		$sender = $check_archive[0]->Sender;
    		$receiver = $check_archive[0]->Receiver;
    		if($archive_info == "no"){ 
    		$archieve_msg = DB::update('update messages set isArchived=? where (Sender=? and Receiver=?) or (Sender=? and Receiver=?)',['yes',$sender,$receiver,$receiver,$sender]);
    		if($archieve_msg){
    		$request->session()->flash('message.level','success');
  			$request->session()->flash('message.content','Conversation has been archived');
        	}
        	}
        	else{
        	$archive_msg = DB::update('update messages set isArchived=? where (Sender=? and Receiver=?) or (Sender=? and Receiver=?)',['no',$sender,$receiver,$receiver,$sender]);
        	if($archive_msg){
    		$request->session()->flash('message.level','success');
  			$request->session()->flash('message.content','Conversation has been removed from archived');
        	
        	}
        	}
        	}
        	else{
        		$request->session()->flash('message.level','danger');
  				$request->session()->flash('message.content','Message doesnot Exist..');
        	}
    	}
    	else{
    		
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','please login to continue..');
  			return view('login');
  		}
    }
    public function deleteMessage(Request $request){
    	if($request->session()->has('user_id')){
    		$message_id = $request->id;
    		$delete_message = DB::delete('delete from messages where MessageId=?',[$message_id]);
    		$request->session()->flash('message.level','info');
  			$request->session()->flash('message.content','Message deleted Successfully.');
        return redirect('inbox');
    	}
    	else{
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','please login to continue..');
  			return view('login');
  		}
    }


 public function ViewKinForm(Request $request){
       if($request->session()->has('user_id') && $request->session()->get('user_type')=="user") {
      $userid = $request->session()->get('user_id');
        return view('addkin');
      }
      else{
                  $request->session()->put('loginredirection', '/addkin');
        $request->session()->flash('message.level', 'info');
        $request->session()->flash('message.content', 'Please Login as User to Add Kin');
        return redirect('/');
      }
   
    }

    public function SaveKindetail(Request $request){
    	$relationship = $request->Relationship;
      $participantname = $request->ParticipantName;
    	$dob = $request->DateofBirth;
    	$height = $request->Height;
    	$weight = $request->Weight;
      $gender = $request->input('Gender');
    	$isdisabled = $request->input('IsDisabled');
    	$relationtouser = $request->session()->get('user_id');
    	$disabilitydescription = $request->DisabilityDescription;
    	$specialrequirements = $request->SpecialRequirements;
    	$notes = $request->Notes;

      $lastinsertedid = DB::table('participants')->insertGetId(array('RelatedToUserId' => $relationtouser, 'Relationship' => $relationship, 'ParticipantName' => $participantname, 'DateofBirth' => $dob, 'Height' => $height, 'Weight' => $weight, 'Gender' => $gender, 'IsDisabled' => $isdisabled, 'DisabilityDescription' => 'no', 'SpecialRequirements' => 'NA', 'Notes' => 'NA','EmergencyContactName' =>'NA', 'EmergencyContactNumber' =>'NA','EmergencyContactNumber' =>'NA','EmergencyContactAddress' => 'NA','Image' => 'NA'));

      if($lastinsertedid){
         if(Input::hasFile('imgUpload')){
            $file = Input::file('imgUpload');
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = 20;
            $randomString = '';
            for ($i = 0; $i < 20; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $file->move('./public/images', $randomString.".png");
            $bimage = url("public/images/".$randomString.".png");          
            }
            else {
            $bimage = "NA";
            } 
            echo $bimage;
            $participant_image = DB::update('update participants set Image=? where ParticipantId=?',[$bimage,$lastinsertedid]);   
            
        $request->session()->flash('message.level','info');
         $request->session()->flash('message.content','Kin details added, Please update contact details...');
           return redirect('kincontact/'.$lastinsertedid);
          }
        else{
         $request->session()->flash('message.level','danger');
         $request->session()->flash('message.content','Unable to save your kin details...');
         return redirect('addkin');
        }
       }
     
       public function kincontact(Request $request){
      if($request->session()->has('user_id') && $request->session()->get('user_type')=="user") {
         $participant_id = $request->id;
         if(count(DB::select('select EmergencyContactName,EmergencyContactNumber,EmergencyContactAddress from participants where ParticipantId=?',[$participant_id]))>0){
        $request->session()->flash('message.level','info');
         $request->session()->flash('message.content','Kin Contact details already added.Edit details if required.');
         return redirect('editkincontact/'.$participant_id);
       }
       else{
         return view('kincontact',['participant_id'=>$participant_id]);
       }
       }
       else{
         $request->session()->flash('message.level','info');
         $request->session()->flash('message.content','Login as User to AddKin');
         return redirect('/');
       }
   }
    public function savekincontact(Request $request){
     $user_email = $request->session()->get('user_email');
     $participant_id = $request->id;
     if(count(DB::select('select EmergencyContactName,EmergencyContactNumber,EmergencyContactAddress from participants where ParticipantId=?',[$participant_id]))>0){
        $request->session()->flash('message.level','info');
         $request->session()->flash('message.content','Kin Contact details already added.Edit details if required.');
         return redirect('editkincontact/'.$participant_id);
     }
     $EmergencyContactName = $request->EmergencyContactName;
     $EmergencyContactNumber = $request->EmergencyContactNumber;
     $EmergencyContactAddress = $request->EmergencyContactAddress;
     $participant_address = DB::update('update participants set EmergencyContactName=?,EmergencyContactNumber=?,EmergencyContactAddress=? where ParticipantId=?',[$EmergencyContactName,$EmergencyContactNumber,$EmergencyContactAddress,$participant_id]);
     if($participant_address){
         $request->session()->flash('message.level','success');
         $request->session()->flash('message.content','Kin Contact Details inserted Sucessfully');
         return redirect('addkin');
     }
   }
    public function ViewKins(Request $request){
        if($request->session()->has('user_id')){
            $userid = $request->session()->get('user_id');
         $users = DB::select('select UserName,Image,UserType from users where UserId = ?',[$userid]);
        $participants = DB::table('participants')
        ->selectRaw('*, participants.ParticipantId,ParticipantName,participants.Relationship,participants.Image')
        ->where('participants.RelatedToUserId',[$userid])
        ->paginate(8);
        if(count($participants)>0) {
            return view('viewallkins',['users' => $users, 'participants' => $participants]);
        }
         
         else{
            $request->session()->flash('message.level','danger');
            $request->session()->flash('message.content','you dont have any kins to display');
            return redirect('addkin');
         }  
       }
        else{
            $request->session()->flash('message.level','danger');
            $request->session()->flash('message.content','please login to continue...');
            return redirect('login');
        }
     }

     
     public function EditKinDetails(Request $request){
       if($request->session()->has('user_id')){
           $userid = $request->session()->get('user_id');

        // $kininformation = DB::select('select * from participants where RelatedToUserId = ?',[$userid]);
         $participants = DB::select('select ParticipantId,ParticipantName,Relationship,DateofBirth,Gender,Height,Weight,IsDisabled,DisabilityDescription,SpecialRequirements,Notes from participants where ParticipantId= ?',[$request->id]);
         if(count($participants)>0){
            return view('editkin',['participants' => $participants,'participant_id'=>$request->id]);
         }

       }
       else{
           $request->session()->flash('message.level','danger');
           $request->session()->flash('message.content','please login to continue...');
           return view('login');
       }
    }

     public function UpdateKinDetails(Request $request){
        if($request->session()->has('user_id')){
         $userid = $request->session()->get('user_id');
         $participantname = $request->ParticipantName;
         $relationship = $request->Relationship;
         $dob = $request->DateOfBirth;
         $gender = $request->Gender;
         $height = $request->Height;
         $weight = $request->Weight;
         $isdisabled = $request->IsDisabled;
         $disabilitydescription = $request->DisabilityDescription;
         $specialrequirements = $request->SpecialRequirements;
         $notes = $request->Notes;
         $participants = DB::select('select * from participants where ParticipantId = ?',[$request->id]);
         if(DB::update('UPDATE participants SET ParticipantName=?,Relationship=?,DateOfBirth=?,Gender=?,Height=?,Weight=?,IsDisabled=?,DisabilityDescription=?,SpecialRequirements=?,Notes=? where ParticipantId =?',[$participantname,$relationship,$dob,$gender,$height,$weight,$isdisabled,$disabilitydescription,$specialrequirements,$notes,$request->id])){
            
             $updated_details = DB::select('select ParticipantName,Relationship,DateofBirth,Gender,Height,Weight,IsDisabled,DisabilityDescription,SpecialRequirements,Notes from participants where ParticipantId = ?',[$request->id]);

           $request->session()->flash('message.level','info');
           $request->session()->flash('message.content','updated kin details...');
          return redirect('editkin/'.$request->id);

         }
         else{
           $request->session()->flash('message.level','danger');
           $request->session()->flash('message.content','Unable to update your details...');
           return view('editkin',['participants' => $participants]);
         }
        }
        else{
            return view('login');
        }
     }

    public function EditKinContact(Request $request){
      if($request->session()->has('user_id') && $request->session()->get('user_type')=="user") {
           $userid = $request->session()->get('user_id');
           $participant_id = $request->id;
           //$kininformation = DB::Select('select * from participants where RelatedToUserId = ?',[$userid]);
           $participants = DB::Select('select ParticipantId,EmergencyContactName,EmergencyContactNumber,EmergencyContactAddress from participants where ParticipantId = ?',[$request->id]);
           return view('editkincontact',['participants' => $participants,'participant_id'=>$participant_id]);
       }
       else{
           $request->session()->flash('message.level','info');
           $request->session()->flash('message.content','Please Login as User to Add/Edit Kin');
           return redirect('/');
       }
    }
     public function saveEditKitContact(Request $request){
     $user_email = $request->session()->get('user_email');
     $participant_id = $request->id;
     $EmergencyContactName = $request->EmergencyContactName;
     $EmergencyContactNumber = $request->EmergencyContactNumber;
     $EmergencyContactAddress = $request->EmergencyContactAddress;
     $participant_address = DB::update('update participants set EmergencyContactName=?,EmergencyContactNumber=?,EmergencyContactAddress=? where ParticipantId=?',[$EmergencyContactName,$EmergencyContactNumber,$EmergencyContactAddress,$participant_id]);
     if($participant_address){
         $request->session()->flash('message.level','success');
         $request->session()->flash('message.content','Kin Contact Details inserted Sucessfully');
         return redirect('editkincontact/'.$participant_id);
     }
     else{
       $request->session()->flash('message.level','info');
         $request->session()->flash('message.content','No Changes made to kin contacts');
         return redirect('editkincontact/'.$participant_id);
     }
    }
     
     public function emailSuggestions(Request $request){
     $q = $request->id;
     $to_mail = DB::select('select Email from users where Email like "%'.$q.'%"');
     if(count($to_mail)>0) {
       echo json_encode($to_mail);
     }
    }
  
    public function kininformation(Request $request){
        if($request->session()->has('user_id')){
            $userid = $request->session()->get('user_id');
            $participants = DB::Select('select ParticipantId,ParticipantName,Image,Relationship,DateofBirth,Gender,Height,Weight,IsDisabled,DisabilityDescription,SpecialRequirements,Notes,EmergencyContactName,EmergencyContactNumber,EmergencyContactAddress from participants where ParticipantId = ?',[$request->id]);
            return view('kininformationpage',['participants' => $participants]);
        }
        else{
            $request->session()->flash('message.level','danger');
            $request->session()->flash('message.content','Please login to continue...');
            return view('login');
        }
    }  

   public function userInformation(Request $request){
   if($request->session()->has('user_id')){
       $userid = $request->session()->get('user_id');
       $users = DB::select('select * from users where ShortName = ?',[$request->shortname]);
       if( count($users) > 0 ) {
       $attributeid = $users[0]->UserId;
       $address = DB::select('select a.AddressId,a.AddressLine1,a.AddressLine2,a.AddressLine3,a.City,a.Country,a.County,a.PostCode from address a INNER JOIN users u where u.ShortName=? and a.AddressId=u.AddressId',[$request->shortname]);
        $favourite = DB::select('select * from favourites where UserId = ? and Attribute = ?',[$userid,$attributeid]);
     $subscribedevents = DB::select('select events.EventId,events.EventName,events.ShortName,eventsubscriptions.Status from events INNER JOIN eventsubscriptions where eventsubscriptions.UserId=? and eventsubscriptions.EventId=events.EventId and eventsubscriptions.Status = "accepted"',[$attributeid]);
     $friend = DB::select('select distinct u.UserName,f.RequestReceiverID,u.UserId,u.Image,u.ShortName from users u INNER JOIN friendrequests f where f.RequestReceiverID=u.UserId and f.RequestorID=?',[$userid]);
       return view('userinformation',['users' => $users,'friends'=>$friend,'address' => $address,'favourites' => $favourite,'events' => $subscribedevents]);
       } else {
       $request->session()->flash('message.level','danger');
       $request->session()->flash('message.content','User unavailable, we have redirected you to your profile page...');
       return redirect('profile');
       }

     }

   else{
       $request->session()->flash('message.level','danger');
       $request->session()->flash('message.content','Please login to continue...');
       return view('login');
   }
}

   public function followUser(Request $request){
       if($request->session()->has('user_id')){
           $userid = $request->session()->get('user_id');
          $users = DB::select('select * from users where ShortName = ?',[$request->shortname]);
               $attributeid = $users[0]->UserId;
               $date=date("Y-m-d");
          $favourite = DB::select('select * from favourites where UserId = ? and Attribute = ?',[$userid,$attributeid]);
          if(count($favourite)>0){
          return redirect('user/'.$request->shortname);
        }
        else{
           $addfavourite = DB::insert('insert into favourites(UserId,FavouriteType,Attribute,CreatedDate,Flag) values (?,?,?,?,?)',[$userid,'user',$attributeid,$date,'no']);
         return redirect('user/'.$request->shortname);
        }
       }
    }
    
      public function unfollowUser(Request $request){
     if($request->session()->has('user_id')){
       $userid = $request->session()->get('user_id');
       $users = DB::select('select * from users where ShortName = ?',[$request->shortname]);
               $attributeid = $users[0]->UserId;
               $date=date("Y-m-d");
      $favourite = DB::select('select * from favourites where UserId = ? and Attribute = ?',[$userid,$attributeid]);  
      if(count($favourite)>0){
      $unfollowUser = DB::delete('Delete from favourites where UserId = ? and Attribute=?',[$userid,$attributeid]);
          return redirect('user/'.$request->shortname);
        }
       
     }
    }

    public function message(Request $request){
        if($request->session()->has('user_id')){
            $userid = $request->session()->get('user_id');
            return view('mailbox');
        }
        else{
            $request->session()->flash('message.level','danger');
            $request->session()->flash('message.content','please login to continue...');
            return view('login');
        }
    }
    public function UserDashboard(Request $request){
       if($request->session()->has('user_id')){
           $userid = $request->session()->get('user_id');
           $subscribedevents = DB::select('select events.EventId,events.EventName,events.ShortName,eventschedules.StartDateTime from events inner join eventschedules on events.EventId=eventschedules.EventId inner join eventsubscriptions on eventsubscriptions.EventId = events.EventId where eventsubscriptions.UserId= ? and eventsubscriptions.Status = "accepted"',[$userid]);
       $userkin = DB::select('select participants.*,eventheats.*,bridgeheatparticipants.*,eventresults.* from participants,eventheats,bridgeheatparticipants,eventresults where participants.ParticipantId=bridgeheatparticipants.ParticipantId and bridgeheatparticipants.ParticipantId=eventresults.ParticipantId and eventheats.IsDeleted = "No" and participants.RelatedToUserId =?',[$userid]);

         
           return view('userdashboard',['subscribedevents'=>$subscribedevents,'participants' => $userkin]);
       }
       $request->session()->flash('message.level','danger');
       $request->session()->flash('message.content','plesae login to continue...');
       return view('login');
   }
   public function userProfile(Request $request){
       if($request->session()->has('user_id')){
           $userid = $request->session()->get('user_id');
           $user_details = DB::select('select * from users where UserId = ?',[$userid]);
         $address = DB::select('select a.AddressId,a.AddressLine1,a.AddressLine2,a.AddressLine3,a.City,a.Country,a.County,a.PostCode,u.* from address a INNER JOIN users u where u.UserId=? and a.AddressId=u.AddressId',[$userid]);

           return view('profile',['users'=>$user_details,'address'=>$address]);
       }
       else{
           $request->session()->flash('message.level','danger');
           $request->session()->flash('message.content','please login to continue...');
           return view('login');
       }
   }

   public function editProfile(Request $request){
     if($request->session()->has('user_id')){
       $userid = $request->session()->get('user_id');
       $user_details = DB::select('select * from users where UserId = ?',[$userid]);
         $address = DB::select('select a.AddressId,a.AddressLine1,a.AddressLine2,a.AddressLine3,a.City,a.Country,a.County,a.PostCode,u.* from address a INNER JOIN users u where u.UserId=? and a.AddressId=u.AddressId',[$userid]);

       return view('editprofile',['users'=>$user_details,'address'=>$address]);
     }
     else{
        $request->session()->flash('message.level','danger');
     $request->session()->flash('message.content','please login to continue...');
     return view('login');
     }

   }


  public function updateProfile(Request $request){
   $userid = $request->session()->get('user_id');
    $username = $request->UserName;
      $lastname = $request->LastName;
      $middlename = $request->MiddleName;
      $daytimephone = $request->DayTimePhone;
      $eveningphone = $request->EveningPhone;
      $facebook = $request->Facebook;
     $addressid =$request->AddressId;
    //  echo $addressid;
      $address = $request->AddressLine1;
      $city = $request->City;
      $postcode = $request->PostCode;
      $country = $request->Country;
      $twitter = $request->Twitter;
      $website = $request->Website;
      $date=date("Y-m-d");
     $user_details = DB::select('select * from users where UserId = ?',[$userid]);
     if(Input::hasFile('profileImage')){
          $file = Input::file('profileImage');
          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = 20;
          $randomString = '';
          for ($i = 0; $i < 20; $i++) {
              $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
          $file->move('./public/images', $randomString.".png");
          $bimage = url("public/images/".$randomString.".png");
          $update_image = DB::update('update users set Image=? where UserId=?',[$bimage,$userid]);
          }
          else {
          $bimage = "NA";
          }

      $addressid = $user_details[0]->AddressId;
      if($addressid  == 0){
     $addressid = DB::table('address')->insertGetId(array('AddressLine1' => $address,'AddressLine2' => 'NA','AddressLine3' => 'NA', 'City' => $city, 'Country' => $country,'Council' =>'NA', 'PostCode'=>$postcode,'Latitude' =>0, 'Longitude' =>0, 'CreatedDate' => $date, 'UpdatedDate' => $date));
     if($addressid){
       $update = DB::update('update users set AddressId = ? where UserId=?',[$addressid,$userid]);
    $request->session()->flash('message.level','info');
       $request->session()->flash('message.content','update address..');
       return redirect('editprofile');
     }
      }
      else{
        $updated_details = DB::update('UPDATE users SET UserName=?,LastName=?,MiddleName=?,DayTimePhone=?,EveningPhone=?,Facebook=?,AddressId=?,Twitter=?,Website=? where UserId = ?',[$username,$lastname,$middlename,$daytimephone,$eveningphone,$facebook,$addressid,$twitter,$website,$userid]);
        $update_address = DB::update('update address set AddressLine1=?,City=?,PostCode=?,Country=? where AddressId = ?',[$address,$city,$postcode,$country,$addressid]);
$request->session()->flash('message.level','info');
       $request->session()->flash('message.content','Profile Details updated Successfully');
       return redirect('editprofile');
      }
    }

   

    public function kinDetails(Request $request){
     if($request->session()->has('user_id')){
       $userid = $request->session()->get('user_id');
       $kin_details = DB::table('participants')
         ->selectRaw('*, participants.ParticipantId,participants.ParticipantName')
       
         ->where('participants.RelatedToUserId',[$userid])
       
         ->paginate(6);
        $user_details = DB::select('select * from users where UserId = ?',[$userid]);
       return view('kindetails',['kins'=>$kin_details,'users'=>$user_details]);
     }
     else{
        $request->session()->flash('message.level','danger');
     $request->session()->flash('message.content','please login to continue...');
     return view('login');
     }
   }
    
   public function resultEntry(Request $request){
    if($request->session()->has('user_id')){
      $event_id = $request->event_id;
      $heat_id = $request->heat_id;
      $level_id = $request->level_id;
      if($level_id == 1){
      $heat_participants = DB::select('select HeatId,HeatName from eventheats where EventId=? and HeatId=? and StageNumber=?',[$event_id,$heat_id,$level_id]);
      $participants= DB::table('participants')
    ->select('bridgeheatparticipants.EventId','participants.ParticipantId','participants.ParticipantName','bridgeheatparticipants.HeatId','participants.Image')
    ->join('bridgeheatparticipants','participants.ParticipantId','=','bridgeheatparticipants.ParticipantId')
    ->where('bridgeheatparticipants.StageNo','=',$level_id)
    ->where('bridgeheatparticipants.EventId','=',$event_id)
    ->where('bridgeheatparticipants.HeatId','=',$heat_id)          
    ->get()->toArray();
         return view('resultentry',['heat_participants'=>$heat_participants,'event_id'=>$event_id,'heat_id'=>$heat_id,'participants'=>$participants,'level_id'=>$level_id]);
      }
      elseif($level_id == 2){
        $heat_participants = DB::select('select HeatId,HeatName from eventheats where EventId=? and HeatId=? and StageNumber=?',[$event_id,$heat_id,$level_id]);
        $participants= DB::table('participants')
    ->select('bridgeheatparticipants.EventId','participants.ParticipantId','participants.ParticipantName','bridgeheatparticipants.HeatId','participants.Image')
    ->join('bridgeheatparticipants','participants.ParticipantId','=','bridgeheatparticipants.ParticipantId')
    ->where('bridgeheatparticipants.StageNo','=',$level_id)
    ->where('bridgeheatparticipants.EventId','=',$event_id)
    ->where('bridgeheatparticipants.HeatId','=',$heat_id)
    ->where('bridgeheatparticipants.AssignStatus','=',1)          
    ->get()->toArray();
       return view('resultentry',['heat_participants'=>$heat_participants,'event_id'=>$event_id,'heat_id'=>$heat_id,'participants'=>$participants,'level_id'=>$level_id]);
      }
      else{
      $heat_participants = DB::select('select HeatId,HeatName from eventheats where EventId=? and HeatId=? and StageNumber=?',[$event_id,$heat_id,$level_id]);
        $participants= DB::table('participants')
    ->select('bridgeheatparticipants.EventId','participants.ParticipantId','participants.ParticipantName','bridgeheatparticipants.HeatId','participants.Image')
    ->join('bridgeheatparticipants','participants.ParticipantId','=','bridgeheatparticipants.ParticipantId')
    ->where('bridgeheatparticipants.StageNo','=',$level_id)
    ->where('bridgeheatparticipants.EventId','=',$event_id)
    ->where('bridgeheatparticipants.HeatId','=',$heat_id)
    ->where('bridgeheatparticipants.AssignStatus','=',2)          
    ->get()->toArray();
       return view('resultentry',['heat_participants'=>$heat_participants,'event_id'=>$event_id,'heat_id'=>$heat_id,'participants'=>$participants,'level_id'=>$level_id]);
      }
    }
    else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Please,Try again..');
        return redirect('login');
    }
  }

  public function saveresultEntry(Request $request){
    $user_id = $request->session()->get('user_id');
    $userid = $request->userid;
    $time = $request->time;
    $result = $request->result;
    $event_id = $request->event_id;
    $heat_id = $request->heat_id;
    $level_id = $request->stage;
    for($i=0;$i<count($userid);$i++){
    $heat_results = DB::insert('insert into eventresults(EventId,ParticipantId,HeatId,RecordedTime,Result,ParentResultId,CreatedBy,UpdatedBy,Status) values(?,?,?,?,?,?,?,?,?)',[$event_id,$userid[$i],$heat_id,$time[$i],$result[$i],0,$user_id,$user_id,0]);
   
    }
    if($heat_results){
      $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Heat Result Added Sucessfully');
      return redirect('heatresults/'.$event_id.'/'.$heat_id.'/'.$level_id);
    }
    else{
      $request->session()->flash('message.level','danger');
      $request->session()->flash('message.content','Failed to add Results.Please try again');
      return redirect('resultentry/'.$event_id.'/'.$heat_id.'/'.$level_id);
    }
  }
  
  public function heatresult(Request $request){
    $event_id = $request->event_id;
    $heat_id = $request->heat_id;
    $level_id = $request->level_id;
    if($level_id == 1){
    $results = DB::select('select distinct p.ParticipantName,e.RecordedTime,e.Result from eventresults e join participants p on p.ParticipantId=e.ParticipantId and e.EventId=? and e.HeatId=? and e.Result=?',[$event_id,$heat_id,'semifinal']);
    return view('heatresult',['event_id'=>$event_id,'results'=>$results,'level_id'=>$level_id]);
    }
    elseif($level_id == 2){
      $results = DB::select('select distinct p.ParticipantName,e.RecordedTime,e.Result from eventresults e join participants p on p.ParticipantId=e.ParticipantId and e.EventId=? and e.HeatId=? and e.Result=?',[$event_id,$heat_id,'final']);
    return view('heatresult',['event_id'=>$event_id,'results'=>$results,'level_id'=>$level_id]);
    }
    else{
      $results = DB::select('select distinct p.ParticipantName,e.RecordedTime,e.Result,e.ParticipantId from eventresults e join participants p on p.ParticipantId=e.ParticipantId and e.EventId=? and e.HeatId=? and e.Result=?',[$event_id,$heat_id,'qualified']);
      foreach($results as $result){
       $bridge_event_participants = DB::update('update bridgeeventparticipants set Status=? where EventId=? and ParticipantId=?',[4,$event_id,$result->ParticipantId]);
      $bridge_heat_participants = DB::update('update bridgeheatparticipants set StageNo=?,AssignStatus=? where HeatId=? and EventId=? and ParticipantId=?',[4,3,$heat_id,$event_id,$result->ParticipantId]);
      }
    return view('heatresult',['event_id'=>$event_id,'results'=>$results,'level_id'=>$level_id]);
    }
  }
  
  public function changeEmail(Request $request){
     if($request->session()->has('user_id')){
       $userid = $request->session()->get('user_id');
       $user_details = DB::select('select * from users where UserId = ?',[$userid]);
       return view('changeemail',['users'=>$user_details]);
     }
     else{
       $request->session()->flash('message.level','danger');
       $request->session()->flash('message.content','please login to continue...');
       return view('login');
     }
   }

   public function updateEmail(Request $request){
     $userid = $request->session()->get('user_id');
     $name = $request->session()->get('user_name');
     $mail = $request->session()->get('user_email');
     $newemail = $request->newemail;
      $activation_token = rand();
        $user_details = DB::select('select * from users where UserId=?',[$userid]);
    if(count(DB::select('select UserName from users where Email=?',[$newemail]))>0){
      $request->session()->flash('message.level', 'danger');
      $request->session()->flash('message.content', 'Email exist in database,Try another email');
         return view('changeemail',['users'=>$user_details]);
    }
    else{
       $changeemail = DB::update('UPDATE users SET Email=?, UserRandomId=?  where UserId = ?',[$newemail,$activation_token,$userid]);
       if($changeemail){
        $activation_url = url("/emailactivation/".$userid);
                   $data = array( 'email' => $newemail, 'name' => $name, 'user_type' =>'instructor', 'activation_url' => $activation_url );
                 Mail::send('emailtemplates.changeemail', $data, function($message) use($newemail,$name) {
                 $message->to($newemail, $name)->subject('Please Activate Your New Email For SwimmIQ');
                 $message->from('swimiqmail@gmail.com','SwimmIQ');
               });
                $request->session()->flash('message.level','info');
                   $request->session()->flash('message.content','Please check your mail to activate new mail for SwimmIQ');
                   return redirect('changeemail');
       
       }
    }

   }

    public function mailActivation(Request $request){
          $id = $request->id;
           $userid = $request->session()->get('user_id');
           $change_activation = DB::update('update users set UserRandomId=? where UserId=?',[1,$id]);
          return redirect('/');
         }
         
    public function excel() {

    // Execute the query used to retrieve the data. In this example
    // we're joining hypothetical users and payments tables, retrieving
    // the payments table's primary key, the user's first and last name, 
    // the user's e-mail address, the amount paid, and the payment
    // timestamp.
    $users = DB::table('users')
    ->select('UserId','UserName','ShortName')->get()->toArray();    
    //$users = DB::select('select UserId,UserName,ShortName from users');

    // Initialize the array which will be passed into the Excel
    // generator.
    $userssArray = []; 

    // Define the Excel spreadsheet headers
    $usersArray[] = ['UserId', 'UserName','ShortName','column 1','column 2'];

    // Convert each member of the returned collection into an array,
    // and append it to the payments array.
    foreach ($users as $user) {
        $usersArray[] = $user;
    }
    $users = json_decode( json_encode($users), true);
    // Generate and return the spreadsheet
    Excel::create('users', function($excel) use ($users) {

        // Set the spreadsheet title, creator, and description
        $excel->setTitle('Users');
        $excel->setCreator('Laravel')->setCompany('SwimmIQ, asdf');
        $excel->setDescription('users list');

        // Build the spreadsheet, passing in the payments array
        $excel->sheet('sheet1', function($sheet) use($users) {
            $sheet->fromArray($users);
        });

    })->download('xlsx');
}     

public function participantsExcel(Request $request) {

    if($request->session()->has('user_id')){
        
    $eventid = $request->event_id;
    $heatid = $request->heat_id;
    $stageid = $request->stage_id;
        
    $users = DB::table('participants')
    ->select('bridgeheatparticipants.EventId','participants.ParticipantId','participants.ParticipantName','bridgeheatparticipants.HeatId')
    ->join('bridgeheatparticipants','participants.ParticipantId','=','bridgeheatparticipants.ParticipantId')
    ->where('bridgeheatparticipants.StageNo','=',1)        
    ->get()->toArray();    
    //$users = DB::select('select UserId,UserName,ShortName from users');

    // Initialize the array which will be passed into the Excel
    // generator.
    $userssArray = []; 

    // Define the Excel spreadsheet headers
    $usersArray[] = ['EventId','ParticipantId','Participant Name','HeatId','TrachRecord','Result'];

    // Convert each member of the returned collection into an array,
    // and append it to the payments array.
    foreach ($users as $user) {
        $usersArray[] = $user;
    }
    $usersArray = json_decode( json_encode($usersArray), true);
    // Generate and return the spreadsheet
    Excel::create('resultentry', function($excel) use ($usersArray) {

        // Set the spreadsheet title, creator, and description
        $excel->setTitle('Users');
        $excel->setCreator('Laravel')->setCompany('SwimmIQ, Results Entry');
        $excel->setDescription('List of participants of a Heat');

        // Build the spreadsheet, passing in the payments array
        $excel->sheet('sheet1', function($sheet) use($usersArray) {
            $sheet->fromArray($usersArray);
        });

    })->download('xlsx');
    }
}

public function uploadExcel(Request $request) {
    /*if(Input::hasFile('excelfile')){
            $file = Input::file('excelfile');*/
    $event_id = $request->event_id;
            $heat_id = $request->heat_id;
            $level_id = $request->stage;
            $user_id = $request->session()->get('user_id');
    if($request->hasFile('excelfile')){
            $path = $request->file('excelfile')->getRealPath();
            $data = \Excel::load($path)->get();
            if($data->count()){
              $participants = DB::select('select ParticipantId FROM bridgeheatparticipants where EventId=? and HeatId=?',[$event_id,$heat_id]);
              if(count($data)-1 == count($participants)){
                for($i=1;$i<count($data);$i++) {
                  for($j=0;$j<count($participants);$j++){
                 if(($data[$i][0] == $event_id) && ($data[$i][1] == $participants[$j]->ParticipantId) && ($data[$i][3] == $heat_id)){
                   $excel_data = DB::insert('insert into eventresults(EventId,ParticipantId,HeatId,RecordedTime,Result,ParentResultId,CreatedBy,UpdatedBy) values(?,?,?,?,?,?,?,?)',[ $data[$i][0],$data[$i][1],$data[$i][3],$data[$i][4],$data[$i][5],0,$user_id,$user_id]);
                  }
                 }
                }
                if($excel_data){
                    $request->session()->flash('message.level','success');
                    $request->session()->flash('message.content','Heat Result Added Sucessfully');
                   return redirect('heatresults/'.$event_id.'/'.$heat_id.'/'.$level_id);
                  }
                  else{
                    $request->session()->flash('message.level','danger');
                    $request->session()->flash('message.content','Event,Participant and Heat details not matched.Please check your excel file and upload');
                  return redirect('resultentry/'.$event_id.'/'.$heat_id.'/'.$level_id);
                  }

                  }
                  else{
                    $request->session()->flash('message.level','danger');
                    $request->session()->flash('message.content','Excel File doesnot match.Please upload Correct file');
                    return redirect('resultentry/'.$event_id.'/'.$heat_id.'/'.$level_id);
                  }
            } else {
                echo "count problem";
            }
            
    } else {
        echo "no file";
    }
}

public function listAlerts(Request $request){
 if($request->session()->has('user_id')){
   $userid = $request->session()->get('user_id');
    $notifications = DB::table('notifications')
    ->selectRaw('*,notifications.NotificationId,notifications.ReceiverId,notifications.Notification,notifications.NotificationType')
           ->where('notifications.ReceiverId',[$userid])
           ->where('notifications.IsRead',[0])
           ->orderBy('notifications.CreatedDate')
           ->paginate(10);

          return view('notifications',['notifications'=>$notifications]);
         }
 
 else{
   $request->session()->flash('message.level','danger');
   $request->sessio()->flash('message.content','please login to continue...');
   return redirect('login');
 }
}

public function autocompletecontact(Request $request){
     $q = $request->key;
     $contact_details = DB::select('select EmergencyContactName,EmergencyContactNumber,EmergencyContactAddress from participants where EmergencyContactName like "%'.$q.'%"');
     if(count($contact_details)>0){
       echo json_encode($contact_details);
     }
   }
    
    public function changePassword(Request $request){
     $this->validate($request,[
     'newpassword' => 'required|min:8|max:10',
      'cpassword' => 'required|min:8|max:10',
     ]);
     $userid = $request->session()->get('user_id');
    $currentpassword = md5($request->currentpassword);
    $newpassword = $request->newpassword;
    $cpassword = $request->cpassword;
    $user_details = DB::select('select UserId,UserName,Email,Password from users where UserId = ?',[$userid]);
    $present_password = $user_details[0]->Password;
    $email = $user_details[0]->Email;
    $name = $user_details[0]->UserName;
 
    if($currentpassword == $present_password){
      if($newpassword == $cpassword){
        $pass = md5($newpassword);
        if(DB::update('update users set password=? where UserId=?',[$pass,$userid])){
          $activation_url = url("/changepassword/".$userid);
          $data = array( 'activation_url' => $activation_url );
          Mail::send('emailtemplates.passwordchange', $data, function($message) use($email) {
           $message->to($email, '')->subject('Your Password has been changed.');
        $message->from('swimiqmail@gmail.com','SwimmIQ');
        });
        }

        else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Unable to update password,Please try again');
        return redirect('changeemail');
        }
      }
      else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','New Password and Confirm Password field didnot match,Please Try again');
     
      }
    $request->session()->flush();
    $request->session()->flash('message.level', 'info');
    $request->session()->flash('message.content', 'Your password has been changed,Please Try Login.');
    return redirect('login');
       return redirect('changeemail');
    }
    else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Current Password didnot match,Please Try again..');
        return redirect('changeemail');
    }

  }

}
