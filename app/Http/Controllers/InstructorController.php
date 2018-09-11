<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use DB;
use Calendar;
use App\Event;
use Mail;

class InstructorController extends Controller
{
  public function instructordashboard(Request $request) {
    $user_id = $request->session()->get('user_id');
    $upcoming_events = DB::select('select events.*, eventschedules.* FROM events JOIN eventschedules on events.eventID = eventschedules.eventID and eventschedules.StartDateTime >= CURDATE()');
    $completed_events = DB::select('select events.*, eventschedules.* FROM events JOIN eventschedules on events.eventID = eventschedules.eventID and eventschedules.StartDateTime < CURDATE()');
    $instructor_schedule = DB::table('venue')
    ->selectRaw('*,classbookings.*')
    ->DISTINCT('venue.VenueName')
    ->JOIN('classbookings','classbookings.InstructorId','=','venue.VenueOwner')
    ->where('venue.VenueOwner','=',$user_id)
    ->where('classbookings.Status','=',0)
    ->paginate(10);
    $instructor_accept = DB::table('venue')
    ->selectRaw('*,classbookings.*')
    ->DISTINCT('venue.VenueName')
    ->JOIN('classbookings','classbookings.InstructorId','=','venue.VenueOwner')
    ->where('venue.VenueOwner','=',$user_id)
    ->where('classbookings.Status','=',1)
    ->paginate(10);
     $events = [];
        $futureevents = DB::select('select events.*, eventschedules.* FROM events JOIN eventschedules on events.eventID = eventschedules.eventID and eventschedules.StartDateTime > CURDATE()');
      
        if(count($futureevents)>0) {
            foreach ($futureevents as $value) {
                $events[] = Calendar::event(
                    $value->EventName,
                    true,
                    new \DateTime($value->StartDateTime),
                    new \DateTime($value->EndDateTime.' +1 day'),
                    null,
                    // Add color and link on event
                  [
                      'color' => '#028482',
                      'url' => 'venuedashboard',
                  ]
                );
            }
        }
         
 $pastevents = DB::select('select events.*, eventschedules.* FROM events JOIN eventschedules on events.eventID = eventschedules.eventID and eventschedules.StartDateTime < CURDATE()');
      
   if(count($pastevents)>0) {
            foreach ($pastevents as $value1) {
                $events[] = Calendar::event(
                    $value1->EventName,
                    true,
                    new \DateTime($value1->StartDateTime),
                    new \DateTime($value1->EndDateTime.' +1 day'),
                    null,
                    // Add color and link on event
                  [
                      'color' => '#FF0000',
                      'url' => 'venuedashboard',
                  ]
                );
            }
        }
        
     $presentevents = DB::select('select events.*, eventschedules.* FROM events JOIN eventschedules on events.eventID = eventschedules.eventID and eventschedules.StartDateTime = CURDATE()');

   if(count($presentevents)>0) {
            foreach ($presentevents as $value2) {
                $events[] = Calendar::event(
                    $value2->EventName,
                    true,
                    new \DateTime($value2->StartDateTime),
                    new \DateTime($value2->EndDateTime.' +1 day'),
                    null,
                    // Add color and link on event
                  [
                      'color' => '#336699',
                      'url' => 'venuedashboard',
                  ]
                );
            }
        }
        
        $calendar = Calendar::addEvents($events);
    return view('instructordashboard',compact('calendar'),['instructor_schedule'=>$instructor_schedule,'completed_events'=>$completed_events,'upcoming_events'=>$upcoming_events,'instructor_accept'=>$instructor_accept]);
  }

  public function acceptParticipant(Request $request){
    $participant = $request->participant;
    $venue_id = $request->venue_id;
    $user_id = $request->session()->get('user_id');
    $accept_participant = DB::update('update classbookings set Status=? where InstructorId=? and ParticipantId=? and VenueId=?',[1,$user_id,$participant,$venue_id]);
    if($accept_participant){
      $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Request Accepted Successfully');
      return redirect('instructordashboard');
    }
  }
  public function deleteParticipant(Request $request){
    $participant = $request->participant;
    $venue_id = $request->venue_id;
    $user_id = $request->session()->get('user_id');
     $accept_participant = DB::update('update classbookings set Status=? where InstructorId=? and ParticipantId=? and VenueId=?',[0,$user_id,$participant,$venue_id]);
    if($accept_participant){
      $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Request Rejected Successfully');
      return redirect('instructordashboard');
    }
  }
  public function instructors(Request $request) {
    $total_count = DB::select(' select count(u.UserId) as count from users u join instructor i on i.InstructorId=u.UserId where u.UserType=? and u.IsDeleted=? and u.IsUserAccepted=?',['instructor','no',1]);
    $instructors = DB::table('users')
        ->selectRaw('*, users.UserId,users.UserName,users.Image,instructor.Experience,instructor.Specialization,instructor.Gender')
              ->join('instructor', 'InstructorId', '=', 'users.UserId')
              ->where('users.IsDeleted',['no'])
              ->where('users.UserType',['instructor'])
              ->where('users.IsUserAccepted',[1])
              ->orderBy('users.UserId')
              ->paginate(12);
    return view('instructors',['instructors'=>$instructors,'total_count'=>$total_count[0]->count,'show_count'=>'yes']);
  }
  
  public function myInstructors(Request $request) {
      if($request->session()->has('user_id')){
      $userid = $request->session()->get('user_id');
      $instructors = DB::table('users')
        ->selectRaw('*, users.UserId,users.UserName,users.Image,instructor.Experience,instructor.Specialization,instructor.Gender')
              ->join('favourites', 'Attribute', '=', 'users.UserId')
              ->join('instructor', 'favourites.Attribute', '=', 'instructor.InstructorId')
              ->where('users.IsDeleted',['no'])
              ->where('users.IsUserAccepted',[1])
              ->where('favourites.Flag',['Yes'])
              ->where('favourites.FavouriteType',['instructor'])
              ->where('favourites.UserId',[$userid])
              ->orderBy('users.UserId')
              ->paginate(12);
    return view('myinstructors',['instructors'=>$instructors]);
      } else {
          return redirect('instructors');
      }
  }

  public function searchInstructors(Request $request) {
    $instructor = $request->instructor;
    $total_count = DB::select(' select count(u.UserId) as count from users u join instructor i on i.InstructorId=u.UserId where u.UserType=? and u.IsDeleted=? and u.IsUserAccepted=?',['instructor','no',1]);
    $instructors = DB::table('users')
        ->selectRaw('*, users.UserId,users.UserName,users.Image,instructor.Experience,instructor.Specialization,instructor.Gender')
              ->join('instructor', 'InstructorId', '=', 'users.UserId')
              ->where('users.IsDeleted',['no'])
              ->where('users.UserType',['instructor'])
              ->where('users.IsUserAccepted',[1])
              ->where('users.UserName','like','%'.strtolower($instructor).'%')
              ->orderBy('users.UserId')
              ->paginate(12);
    return view('instructors',['instructors'=>$instructors,'total_count'=>$total_count[0]->count,'show_count'=>'no','search_term'=>$instructor]);
  }

  public function ViewInstructor(Request $request){
  	if($request->session()->has('user_id')){
  		$userid = $request->session()->get('user_id');
  	 return view('addinstructor');
  	}
  	else{
  		$request->session()->flash('message.level','danger');
  		$request->session()->flash('message.content','please login to continue..');
  		return view('login');
  	}
  }
/*edit instructor details*/

public function EditInstructorBasic(Request $request){
    if($request->session()->has('user_id')){
      $userid = $request->session()->get('user_id');
      $users = DB::select('select FirstName,UserId,UserName,UserType,LastName,ShortName,Title,Image,MiddleName from users where UserId = ?',[$userid]);
      if(count($users)>0){
        $instructors = DB::select('select Experience from instructor where InstructorId =?',[$userid]);
       return view('editinstructorbasic',['users' => $users, 'instructors' => $instructors]);
      }
    }
    else{
     $request->session()->flash('message.level','info');
     $request->session()->flash('message.content','Pleae login to continue..');
     return view('login');
    }
  }

  public function UpdateInstructorBasic(Request $request){
    if($request->session()->has('user_id')){
      $userid = $request->session()->get('user_id');
      $firstname = $request->FirstName;
      $lastname = $request->LastName;
      $middlename = $request->MiddleName;
      $shortname = $request->ShortName;
      $title = $request->Title;
      $users = DB::select('select * from users where UserId = ?',[$userid]);
    
      if(DB::update('UPDATE users set FirstName = ?, LastName = ?, MiddleName = ?,ShortName = ?,Title = ? where UserId = ?',[$firstname,$lastname,$middlename,$shortname,$title,$userid])){

             $updated_details = DB::select('select FirstName,LastName,MiddleName,ShortName,Title from users where UserId = ?',[$userid]);
         $request->session()->flash('message.level','info');
           $request->session()->flash('message.content','updated details...');
          return redirect('editinstructorbasic/'.$userid);

      }
      else{
          $request->session()->flash('message.level','danger');
           $request->session()->flash('message.content','Unable to update your details...');
           return view('editinstructorbasic',['users' => $users]);
      }
    }
    else{
      return view('login');
    }
  }

  public function EditInstructorTimings(Request $request){
    if($request->session()->has('user_id')){
      $userid = $request->session()->get('user_id');
      $users = DB::select('select UserId,UserName,UserType,Image from users where UserId = ?',[$userid]);
      if(count($users)>0){
        $instructors = DB::Select('select Experience from instructor where InstructorId =?',[$userid]);
          return view('editinstructortimings',['users' => $users, 'instructors' => $instructors]);
      }
     }
    else{
     $request->session()->flash('message.level','info');
     $request->session()->flash('message.content','Pleae login to continue..');
     return view('login');
    }
  }

   public function EditInstructorAddress(Request $request){
    if($request->session()->has('user_id')){
      $userid = $request->session()->get('user_id');
   
      $users = DB::select('select UserId,UserName,UserType,Image from users where UserId = ?',[$userid]);
      if(count($users)>0){
      $address = DB::select('select AddressId,AddressLine1,AddressLine2,County,Country,City,PostCode from address where addressid = ?',[$request->id]);
      $instructors = DB::select('select Experience from instructor where InstructorId =?',[$userid]);
       return view('editinstructoraddress',['users' => $users,'Address' => $address, 'instructors' => $instructors]); 
      }
    }
    else{
     $request->session()->flash('message.level','info');
     $request->session()->flash('message.content','Pleae login to continue..');
     return view('login');
    }
   }

   public function EditInstructorExperience(Request $request){
    if($request->session()->has('user_id')){
      $userid = $request->session()->get('user_id');
      $id = $request->id;
      $users = DB::select('select UserId,UserName,Image,UserType from users where UserId = ?',[$userid]);
      if(count($users)){
        $instructors = DB::select('select Qualification,Specialization,Experience,Gender,Description from instructor where InstructorId = ?',[$userid]);
        return view('editinstructorexperience',['users' => $users, 'id' => $id, 'instructors' => $instructors]);
      }
      
    }
    else{
     $request->session()->flash('message.level','info');
     $request->session()->flash('message.content','Pleae login to continue..');
     return view('login'); 
    }
   }

    public function UpdateInstructorExperience(Request $request){
     if($request->session()->has('user_id')){
      $userid = $request->session()->get('user_id');
      $qualification = $request->Qualification;
      $specialization = $request->Specialization;
      $experience = $request->Experience;
      $gender = $request->Gender;
      $description = $request->Description;
      $instructors = DB::select('select * from instructor where InstructorId = ?',[$userid]);
    
      if(DB::update('UPDATE instructor set Qualification = ?, Specialization = ?, Experience = ?,Gender = ?,Description = ? where InstructorId = ?',[$qualification,$specialization,$experience,$gender,$description,$userid])){
     $updated_details = DB::select('select Qualification,Specialization,Experience,Gender,Description from instructor where InstructorId = ?',[$userid]);
         $request->session()->flash('message.level','info');
           $request->session()->flash('message.content','updated details...');
          return redirect('editinstructorexperience/'.$userid);

      }
      else{
          $request->session()->flash('message.level','danger');
           $request->session()->flash('message.content','Unable to update your details...');
           return view('editinstructorexperience',['users' => $users]);
      }
    }
    else{
      return view('login');
    }
  }

    public function EditInstructorContact(Request $request){
      if($request->session()->has('user_id')){
        $userid = $request->session()->get('user_id');
        $id = $request->id;
        $users =DB::select('select UserId, UserName,Image,UserType,Email,DayTimePhone,EveningPhone,ShortName from users where UserId = ?',[$userid]);
        if(count($users)>0){
          $instructors = DB::select('select Experience from instructor where InstructorId = ?',[$userid]);
         return view('editinstructorcontact',['users' => $users, 'id' =>$id, 'instructors' => $instructors]);
        }
      }
      else{
         $request->session()->flash('message.level','info');
       $request->session()->flash('message.content','Pleae login to continue..');
       return view('login'); 
      }
    }


     public function viewinstructorBasic(Request $request){
 if($request->session()->has('user_id')){
        $userid = $request->session()->get('user_id');
           $instructors = DB::select('select UserId,FirstName,MiddleName,LastName,UserName,ShortName,Image,UserType,Description,Experience,DayTimePhone,EveningPhone,Email from users inner join instructor where ShortName = ? and instructor.InstructorId=users.UserId',[$request->shortname]);
         $instructorid = $instructors[0]->UserId;
         $shortname = $instructors[0]->ShortName;
          $favourite = DB::select('select * from favourites where UserId = ? and Attribute = ?',[$userid,$instructorid]);
        $events = [];
        $instructoraddress = DB::select('select a.AddressId,a.AddressLine1,a.AddressLine2,a.AddressLine3,a.City,a.Country,a.County,a.PostCode from address a INNER JOIN users u where u.UserId=? and a.AddressId=u.AddressId',[$instructorid]);
        $futureevents = DB::select('select events.*, eventschedules.* FROM events JOIN eventschedules on events.eventID = eventschedules.eventID and eventschedules.StartDateTime > CURDATE()');
      
        if(count($futureevents)>0) {
            foreach ($futureevents as $value) {
                $events[] = Calendar::event(
                    $value->EventName,
                    true,
                    new \DateTime($value->StartDateTime),
                    new \DateTime($value->EndDateTime.' +1 day'),
                    null,
                    // Add color and link on event
                  [
                      'color' => '#028482',
                      'url' => 'venuedashboard',
                  ]
                );
            }
        }
         
 $pastevents = DB::select('select events.*, eventschedules.* FROM events JOIN eventschedules on events.eventID = eventschedules.eventID and eventschedules.StartDateTime < CURDATE()');
      
   if(count($pastevents)>0) {
            foreach ($pastevents as $value1) {
                $events[] = Calendar::event(
                    $value1->EventName,
                    true,
                    new \DateTime($value1->StartDateTime),
                    new \DateTime($value1->EndDateTime.' +1 day'),
                    null,
                    // Add color and link on event
                  [
                      'color' => '#FF0000',
                      'url' => 'venuedashboard',
                  ]
                );
            }
        }
        
     $presentevents = DB::select('select events.*, eventschedules.* FROM events JOIN eventschedules on events.eventID = eventschedules.eventID and eventschedules.StartDateTime = CURDATE()');

   if(count($presentevents)>0) {
            foreach ($presentevents as $value2) {
                $events[] = Calendar::event(
                    $value2->EventName,
                    true,
                    new \DateTime($value2->StartDateTime),
                    new \DateTime($value2->EndDateTime.' +1 day'),
                    null,
                    // Add color and link on event
                  [
                      'color' => '#336699',
                      'url' => 'venuedashboard',
                  ]
                );
            }
        }
        
        $calendar = Calendar::addEvents($events);
         return view('viewinstructorevents',compact('calendar'),['instructors' => $instructors,'favourites'=>$favourite,'instructoraddress'=>$instructoraddress,'shortname'=>$shortname,'instructorid'=>$instructorid]); 
        } 
      
      else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Please login to continue...');
        return view('login');
      } 
     }
     public function savebookInstructor(Request $request){
      $user_id = $request->session()->get('user_id');
      $shortname = $request->shortname;
      $instructorid = $request->instructorid;
      $name = $request->name;
      $venue = $request->venue;
      $location = $request->location;
      $start_date = $request->start_date;
      $end_date = $request->end_date;
      $prefered_class = $request->prefered_class;
      $venue_details = DB::select('select VenueId from venue where VenueName=?',[$venue]);
      if(count($venue_details)>0){
      $venue_id = $venue_details[0]->VenueId;
      $book_instructor = DB::table('classbookings')->insertGetId(array('InstructorId'=>$instructorid,'ParticipantId'=>$user_id,'StartDate'=>$start_date,'EndDate'=>$end_date,'Preference'=>$prefered_class,'VenueId'=>$venue_id,'Status'=>0));
      $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Instructor booked successfully');
      return redirect('instructor/'.$shortname);
      }
      else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Venue doesnot exist');
        return redirect('instructor/'.$shortname);
      }
     }

     public function bookinstructor(Request $request){
       if($request->session()->has('user_id')){
        $userid = $request->session()->get('user_id');
         $instructors = DB::select('select UserId,FirstName,MiddleName,LastName,UserName,ShortName,Image,UserType,Description,Experience from users inner join instructor where ShortName = ? and instructor.InstructorId=users.UserId',[$request->shortname]);
        $instructorid = $instructors[0]->UserId;
          $favourite = DB::select('select * from favourites where UserId = ? and Attribute = ?',[$userid,$instructorid]);
          $events = [];
        $futureevents = DB::select('select events.*, eventschedules.* FROM events JOIN eventschedules on events.eventID = eventschedules.eventID and eventschedules.StartDateTime > CURDATE()');
      
        if(count($futureevents)>0) {
            foreach ($futureevents as $value) {
                $events[] = Calendar::event(
                    $value->EventName,
                    true,
                    new \DateTime($value->StartDateTime),
                    new \DateTime($value->EndDateTime.' +1 day'),
                    null,
                    // Add color and link on event
                  [
                      'color' => '#028482',
                      'url' => 'venuedashboard',
                  ]
                );
            }
        }
         
 $pastevents = DB::select('select events.*, eventschedules.* FROM events JOIN eventschedules on events.eventID = eventschedules.eventID and eventschedules.StartDateTime < CURDATE()');
      
   if(count($pastevents)>0) {
            foreach ($pastevents as $value1) {
                $events[] = Calendar::event(
                    $value1->EventName,
                    true,
                    new \DateTime($value1->StartDateTime),
                    new \DateTime($value1->EndDateTime.' +1 day'),
                    null,
                    // Add color and link on event
                  [
                      'color' => '#FF0000',
                      'url' => 'venuedashboard',
                  ]
                );
            }
        }
        
     $presentevents = DB::select('select events.*, eventschedules.* FROM events JOIN eventschedules on events.eventID = eventschedules.eventID and eventschedules.StartDateTime = CURDATE()');

   if(count($presentevents)>0) {
            foreach ($presentevents as $value2) {
                $events[] = Calendar::event(
                    $value2->EventName,
                    true,
                    new \DateTime($value2->StartDateTime),
                    new \DateTime($value2->EndDateTime.' +1 day'),
                    null,
                    // Add color and link on event
                  [
                      'color' => '#336699',
                      'url' => 'venuedashboard',
                  ]
                );
            }
        }
        
        $calendar = Calendar::addEvents($events);
         return view('bookinstructor',compact('calendar'),['instructors' => $instructors,'favourites'=>$favourite,'instructorid'=>$instructorid]); 
        } 
      
      else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Please login to continue...');
        return view('login');
      } 
     }
     

  public function followInstructor(Request $request){
       if($request->session()->has('user_id')){
           $userid = $request->session()->get('user_id');
         $instructors = DB::select('select * from users where ShortName = ?',[$request->shortname]);
           $instructorid = $instructors[0]->UserId;
             $date=date("Y-m-d");
          $favourite = DB::select('select * from favourites where UserId = ? and Attribute = ?',[$userid,$instructorid]);
         if(count($favourite)>0){
           return redirect('instructor/'.$request->shortname);
        }
        else{
           $addfavourite = DB::insert('insert into favourites(UserId,FavouriteType,Attribute,CreatedDate,Flag) values (?,?,?,?,?)',[$userid,'user',$instructorid,$date,'no']);
           if($addfavourite){
               return redirect('instructor/'.$request->shortname);
           }
        }
       }
    }
    
    public function unfollowInstructor(Request $request){
     if($request->session()->has('user_id')){
       $userid = $request->session()->get('user_id');
       $instructors = DB::select('select * from users where ShortName = ?',[$request->shortname]);
       $attributeid = $instructors[0]->UserId;
      $date=date("Y-m-d");
      $favourite = DB::select('select * from favourites where UserId = ? and Attribute = ?',[$userid,$attributeid]);  
      if(count($favourite)>0){
      $unfollowUser = DB::delete('Delete from favourites where UserId = ? and Attribute=?',[$userid,$attributeid]);
          return redirect('instructor/'.$request->shortname);
        }
       
     }
    }

     public function viewinstructorEvents(Request $request){
      if($request->session()->has('user_id')){
        $userid = $request->session()->get('user_id');
           $instructors = DB::select('select UserId,FirstName,MiddleName,LastName,UserName,ShortName,Image,UserType,Description,Experience from users inner join instructor where ShortName = ? and instructor.InstructorId=users.UserId',[$request->shortname]);
         $instructorid = $instructors[0]->UserId;
          $favourite = DB::select('select * from favourites where UserId = ? and Attribute = ?',[$userid,$instructorid]);
        $events = [];
        $instructoraddress = DB::select('select a.AddressId,a.AddressLine1,a.AddressLine2,a.AddressLine3,a.City,a.Country,a.County,a.PostCode from address a INNER JOIN users u where u.UserId=? and a.AddressId=u.AddressId',[$instructorid]);
        $futureevents = DB::select('select events.*, eventschedules.* FROM events JOIN eventschedules on events.eventID = eventschedules.eventID and eventschedules.StartDateTime > CURDATE()');
      
        if(count($futureevents)>0) {
            foreach ($futureevents as $value) {
                $events[] = Calendar::event(
                    $value->EventName,
                    true,
                    new \DateTime($value->StartDateTime),
                    new \DateTime($value->EndDateTime.' +1 day'),
                    null,
                    // Add color and link on event
                  [
                      'color' => '#028482',
                      'url' => 'venuedashboard',
                  ]
                );
            }
        }
         
 $pastevents = DB::select('select events.*, eventschedules.* FROM events JOIN eventschedules on events.eventID = eventschedules.eventID and eventschedules.StartDateTime < CURDATE()');
      
   if(count($pastevents)>0) {
            foreach ($pastevents as $value1) {
                $events[] = Calendar::event(
                    $value1->EventName,
                    true,
                    new \DateTime($value1->StartDateTime),
                    new \DateTime($value1->EndDateTime.' +1 day'),
                    null,
                    // Add color and link on event
                  [
                      'color' => '#FF0000',
                      'url' => 'venuedashboard',
                  ]
                );
            }
        }
        
     $presentevents = DB::select('select events.*, eventschedules.* FROM events JOIN eventschedules on events.eventID = eventschedules.eventID and eventschedules.StartDateTime = CURDATE()');

   if(count($presentevents)>0) {
            foreach ($presentevents as $value2) {
                $events[] = Calendar::event(
                    $value2->EventName,
                    true,
                    new \DateTime($value2->StartDateTime),
                    new \DateTime($value2->EndDateTime.' +1 day'),
                    null,
                    // Add color and link on event
                  [
                      'color' => '#336699',
                      'url' => 'venuedashboard',
                  ]
                );
            }
        }
        
        $calendar = Calendar::addEvents($events);
         return view('viewinstructorevents',compact('calendar'),['instructors' => $instructors,'favourites'=>$favourite,'instructoraddress'=>$instructoraddress]); 
        } 
      
      else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Please login to continue...');
        return view('login');
      } 
    }
   
    public function viewinstructorAddress(Request $request){
      if($request->session()->has('user_id')){
        $userid = $request->session()->get('user_id');
        $instructors = DB::select('select UserId,FirstName,MiddleName,LastName,UserName,ShortName,Image,UserType,Description,Experience from users inner join instructor where ShortName = ? and instructor.InstructorId=users.UserId',[$request->shortname]);
         $instructorid = $instructors[0]->UserId;
                   $favourite = DB::select('select * from favourites where UserId = ? and Attribute = ?',[$userid,$instructorid]);
 
         $instructoraddress = DB::select('select a.AddressId,a.AddressLine1,a.AddressLine2,a.AddressLine3,a.City,a.Country,a.County,a.PostCode from address a INNER JOIN users u where u.UserId=? and a.AddressId=u.AddressId',[$instructorid]);
         return view('viewinstructoraddress',['instructors' => $instructors,'instructoraddress'=>$instructoraddress,'favourites'=>$favourite]); 
        } 
      
      else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Please login to continue...');
        return view('login');
      } 
    }

    public function viewinstructorQualification(Request $request){
      if($request->session()->has('user_id')){
        $userid = $request->session()->get('user_id');
      $instructors = DB::select('select UserId,FirstName,MiddleName,LastName,UserName,ShortName,Image,UserType,Description,Experience from users inner join instructor where ShortName = ? and instructor.InstructorId=users.UserId',[$request->shortname]);
         $instructorid = $instructors[0]->UserId;
                   $favourite = DB::select('select * from favourites where UserId = ? and Attribute = ?',[$userid,$instructorid]);
 $instructor_decsription = DB::select('select Description,Experience from instructor where InstructorId=?',[$instructorid]);
          $instructorqualification = DB::select('select Qualification,Specialization,Experience,Gender,Description from instructor where InstructorId = ?',[$instructorid]);
         return view('viewinstructorqualification',['instructors' => $instructors,'instructorqualification'=>$instructorqualification,'favourites'=>$favourite]); 
        } 
      
      else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Please login to continue...');
        return view('login');
      } 
    }

    public function viewinstructorContact(Request $request){
      if($request->session()->has('user_id')){
        $userid = $request->session()->get('user_id');
     $instructors = DB::select('select *,Description,Experience from users inner join instructor where ShortName = ? and instructor.InstructorId=users.UserId',[$request->shortname]);
         $instructorid = $instructors[0]->UserId;
          $favourite = DB::select('select * from favourites where UserId = ? and Attribute = ?',[$userid,$instructorid]);
         $instructor_decsription = DB::select('select Description,Experience from instructor where InstructorId=?',[$instructorid]);
         return view('viewinstructorcontact',['instructors' => $instructors,'favourites'=>$favourite]); 
        } 
      
      else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Please login to continue...');
        return view('login');
      } 
    }
    
    public function AddInstructor(Request $request){
    if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
      $userid = $request->session()->get('user_id');

        return view('addinstructor');
    }
      else{
         $request->session()->put('loginredirection', '/addinstructor');

        $request->session()->flash('message.level','info');
      $request->session()->flash('message.content','Pleasae Login as Venue Admin to AddInstructor');
      return redirect('/');
      }
    }

  public function InsertInstructorBasic(Request $request){
   $this->validate($request,[
        'FirstName' => 'required|string|min:4|max:20',
        'MiddleName' => 'required|string|min:4|max:20',
        'LastName' => 'required|string|min:4|max:20',
        'Title' => 'required',           
       ]);
   $firstname = $request->FirstName;
        $middlename = $request->MiddleName;
      $lastname = $request->LastName;
      $title = $request->Title;
      $userid = $request->id;
      $date=date("Y-m-d");
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
       $userrandomid = 20;
      $random = '';
      for ($i = 0; $i < 20; $i++) {
          $random .= $characters[rand(0, $userrandomid - 1)];
      }
      $shortname = $firstname.'_'.$random;
     $instructordetails = DB::table('users')->insertGetId(array('UserName' => $firstname, 'Email' => $shortname.'@dummy.com', 'Password' => 'NA','IsUserAccepted' => 0, 'UserRandomId' => $random, 'UserType' => 'instructor','Addressid' => 1, 'DayTimePhone' => 'NA', 'EveningPhone' => 'NA', 'IsDeleted' => 0, 'Image' => 'NA', 'Facebook' => 'NA', 'Twitter' => 'NA', 'Website' => 'NA', 'passreset' => 0, 'pm_count' => 0, 'Google_Id' => 'NA', 'Oauth_UId' => 'NA', 'ApprovalStatus' => 'NA', 'ShortName' => $shortname, 'LastLoginDate' => $date, 'FirstName' => $firstname, 'MiddleName' => $middlename, 'LastName' => $lastname, 'Title' => $title));
     if($instructordetails){
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
            DB::update('update users set Image=? where UserId=?',[$bimage,$instructordetails]);       
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Instructor Basic details added sucessfully...');
            return redirect('instructortimings/'.$instructordetails);
     } else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Unable to save your details please try again...');
        return view('addinstructor');
    }
    }

  public function InstructorTimings(Request $request){
    if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
    $userid = $request->session()->get('user_id');
    $id = $request->id;
   
      $users = DB::select('select * from users where UserId=?',[$id]);
      return view('instructortimings',['users' => $users, 'id' => $id]);
    }
    else{
      $request->session()->flash('message.level','info');
      $request->session()->flash('message.content','Pleasae Login as Venue Admin to AddInstructor');
      return redirect('/');
    }
  
  }

public function InsertInstructorTimings(Request $request){
 $monday = $request->monday;
 $tuesday = $request->tuesday;
 $wednesday = $request->wednesday;
 $thursday = $request->thursday;
 $friday = $request->friday;
 $saturday = $request->saturday;
 $sunday = $request->sunday;
 $id = $request->id;
 $user_id = $request->session()->get('user_id');
 
 $date=date("Y-m-d");
 $venue_details = DB::select('select VenueId from venue where VenueOwner=?',[$user_id]);
 $venue_id = $venue_details[0]->VenueId;
 if(count($monday)==3){
    $insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'instructor','TypeId'=>$venue_id,'Day'=>$monday[0],'Open/Closed'=>'Open','OpeningHours'=>$monday[1],'ClosingHours'=>$monday[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
  }
  if(count($tuesday)==3){
    $insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'instructor','TypeId'=>$venue_id,'Day'=>$tuesday[0],'Open/Closed'=>'Open','OpeningHours'=>$tuesday[1],'ClosingHours'=>$tuesday[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
  }    
    if(count($wednesday)==3){
    $insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'instructor','TypeId'=>$venue_id,'Day'=>$wednesday[0],'Open/Closed'=>'Open','OpeningHours'=>$wednesday[1],'ClosingHours'=>$wednesday[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
  }
  if(count($thursday)==3){
    $insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'instructor','TypeId'=>$venue_id,'Day'=>$thursday[0],'Open/Closed'=>'Open','OpeningHours'=>$thursday[1],'ClosingHours'=>$thursday[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
  }
  if(count($friday)==3){
    $insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'instructor','TypeId'=>$venue_id,'Day'=>$friday[0],'Open/Closed'=>'Open','OpeningHours'=>$friday[1],'ClosingHours'=>$friday[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
  }
  if(count($saturday)==3){
    $insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'instructor','TypeId'=>$venue_id,'Day'=>$saturday[0],'Open/Closed'=>'Open','OpeningHours'=>$saturday[1],'ClosingHours'=>$saturday[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
  }
  if(count($sunday)==3){
    $insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'instructor','TypeId'=>$venue_id,'Day'=>$sunday[0],'Open/Closed'=>'Open','OpeningHours'=>$sunday[1],'ClosingHours'=>$sunday[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
   
  }
  $request->session()->flash('message.level','info');
  $request->session()->flash('message.content','Instructor Timings Inserted Successfully');
 return redirect('instructoraddress/'.$id);
}

  public function InstructorAddress(Request $request){
    if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
    $userid = $request->session()->get('user_id');
    $id = $request->id;
    
    $users = DB::select('select * from users where UserId = ?',[$id]);
    return view('instructoraddress',['users' => $users,'id' => $id]);
    }
    else{
      $request->session()->flash('message.level','info');
      $request->session()->flash('message.content','Pleasae Login as Venue Admin to AddInstructor');
      return redirect('/');
    }
  
}

  

  public function InsertInstructorAddress(Request $request){
    
       $this->validate($request,[
        'AddressLine1' => 'required',
        'AddressLine2' => 'required',
        'City' => 'required',
        'Country' => 'required',
        'County' => 'required',
        'PostCode' => 'required|numeric',
       ]);
       $addressid = $request->AddressId;     
      $address1 = $request->AddressLine1;
      $address2 = $request->AddressLine2;
      $city = $request->City;
      $country = $request->Country;
      $town = $request->County;
      $postcode = $request->PostCode;
      $date=date("Y-m-d");
      $id = $request->id;
      $insertaddressdetails = DB::table('address')->insertGetId(array('AddressId' => $addressid,'AddressLine1' => $address1, 'AddressLine2' => $address2, 'AddressLine3' => 'NA', 'Council' => 'NA', 'Latitude' => 0, 'CreatedDate' => $date, 'UpdatedDate' => $date, 'Longitude' => 0, 'City' => $city, 'Country' => $country, 'County' => $town, 'PostCode' => $postcode));
      if($insertaddressdetails){
    $updateuser = DB::table('users')->where('UserId',$id)->update(['AddressId'=>$insertaddressdetails]);
        $users = DB::select('select * from users where UserId = ?',[$id]);
        $address = DB::select('select AddressId from address where AddressId=?',[$insertaddressdetails]);
        
         $request->session()->flash('message.level','info');
         $request->session()->flash('message.content','Address details are saved successfully..');
           return redirect('instructorexperience/'.$id);
          }
        else{
         $request->session()->flash('message.level','danger');
         $request->session()->flash('message.content','Unable to save your  details...');
          return redirect('instructoraddress');
        }
       }
    

  
  public function InstructorExperience(Request $request){
     
    if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
    $userid = $request->session()->get('user_id');
    $id = $request->id;
    $users = DB::select('select * from users where UserId = ?',[$id]);
    return view('instructorexperience',['users' => $users, 'id' => $id]);
    }
    else{
      $request->session()->flash('message.level','info');
      $request->session()->flash('message.content','Pleasae Login as Venue Admin to AddInstructor');
      return redirect('/');
    }
   
  }

 public function InsertInstructorExperience(Request $request){
 
      $id =$request->id;
        $qualification = $request->Qualification;
      $experience = $request->Experience;
      $specialization = $request->Specialization;
      $weight = $request->Weight;
        $gender = $request->input('Gender');
      $description = $request->Description;
      $addressid = $request->AddressId;
      
$instructorexperience =  DB::table('instructor')->insertGetId(array('InstructorId' => $id, 'Qualification' => $qualification, 'Experience' => $experience, 'Specialization' => $specialization, 'PreviousPositions' => 'NA', 'Facebook' => 'NA', 'Twitter' => 'NA', 'Google+' => 'NA', 'Gender' => $gender, 'Description' => $description));
     if($instructorexperience){
     
      $request->session()->flash('message.level','info');
      $request->session()->flash('message.content','Details are saved successfully...');
      return redirect('instructorcontact/'.$id);
     }
     else{
      $request->session()->flash('message.level','info');
      $request->session()->flash('message.content','Details are saved successfully...');
      return redirect('instructorcontact/'.$id);
     }
   }

  public function InstructorContact(Request $request){
    if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
      $userid = $request->session()->get('user_id');
     $id = $request->id;
     $addressid =$request->AddressId;
      $users = DB::select('select * from users where UserId = ?',[$id]);
      return view('instructorcontact',['users' => $users, 'id' => $id]);
    }
    else{
      $request->session()->flash('message.level','info');
      $request->session()->flash('message.content','Pleasae Login as Venue Admin to AddInstructor');
      return redirect('/');
    }
  }

  public function UpdateInstructorContact(Request $request){
        
         $email = $request->Email;
         $phone1 = $request->DayTimePhone;
         $phone2 = $request->EveningPhone;
         $shortname = $request->ShortName;
         $name = $request->UserName;
         $email = $request->Email;
         $users = DB::select('select * from users where UserId = ?',[$request->id]);
         $updatedetails = DB::update('UPDATE users SET Email=?,DayTimePhone=?,EveningPhone=?,ShortName=? where UserId = ?',[$email,$phone1,$phone2,$shortname,$request->id]);
         if($updatedetails){
                  $isaccepted = 1;
                    $activation_url = url("/setpassword/".$request->id);
                    $data = array( 'email' => $email, 'name' => $name, 'user_type' =>'instructor', 'activation_url' => $activation_url );
                  Mail::send('emailtemplates.instructoractivation', $data, function($message) use($email,$name) {
                  $message->to($email, $name)->subject('Please Activate Your SwimmIQ Account');
                  $message->from('swimiqmail@gmail.com','SwimmIQ');
                  });
            $favourite_instuctor =  DB::insert('insert into favourites(Flag,UserId,FavouriteType,Attribute) values (?,?,?,?)',['Yes',$userid,'instructor',$request->id]);
                    $request->session()->flash('message.level','info');
                    $request->session()->flash('message.content','Mail sent to the instructor.');
                    return redirect('instructorcontact/'.$request->id);
             
             /*$updated_details = DB::select('select Email,DayTimePhone,EveningPhone,ShortName from users where UserId = ?',[$request->id]);
       

           $request->session()->flash('message.level','info');
           $request->session()->flash('message.content','updated user details...');
          return redirect('instructorcontact/'.$request->id);*/
        }
        else{
          $request->session()->flash('message.level','danger');
          $request->session()->flash('message.content','Unable to send your request,Please try again');
          return redirect('instructorcontact/'.$request->id);
        }
        
     }

     public function setPassword(Request $request){
      
        if($request->session()->has('user_id')){
            return redirect('/');
        }
        else{
         
           $id = $request->id;
            $activation = DB::select('select UserId,UserName from users where UserId=?',[$id]);
            if(count($activation)>0){
                return view('setpassword',['id'=>$id]);
            }
            else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Passwords are different');
                return redirect('setpassword');
            }
        }
    }

    public function confirmPassword(Request $request){
     
        if($request->session()->has('user_id')){
            return redirect('/');
        }
        else{
      
        $password = $request->pass;
        $c_password = $request->c_password;
        $id = $request->id;
        echo $password;
           if($password == $c_password){
              $pass = md5($password);
              if(DB::update('update users set Password=?,ApprovalStatus=?,UserRandomId=? where UserId=?',[$pass,0,1,$id])){
                $request->session()->flash('message.level', 'info');
                $request->session()->flash('message.content', 'Your Password have been set, Please Login Now.');
                return redirect('login');
              }
              else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Unable to set your Password, Please Try Again.');
                return redirect('setpassword');
              }
           }
           else{
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'Passwords are Different, Please Try Again.');
                return view('setpassword',['id' => $id]);
           }
        }
    }
    
    public function autocompleteaddress(Request $request){
      $address = $request->address;
      $address_information = DB::select('select AddressLine1,AddressLine2,City,County,Country,PostCode from address where AddressLine1 like "%'.$address.'%"');
      if(count($address_information)>0){
         echo json_encode($address_information);
      }
    }


}
