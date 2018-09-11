<?php

namespace App\Http\Controllers;
use Calendar;
use App\Event;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

class VenueController extends Controller
{

	/*public function venuedashboard(Request $request) {
	    return view('venuedashboard');
	  }*/
	  public function venues(Request $request) {
        $total_count = DB::select(' select count(VenueId) as count from venue where IsDeleted="no"');
        $venues = DB::table('venue')
            ->selectRaw('*, venue.VenueId,venue.VenueName,venue.ShortName,venue.phone')
                  ->join('images', 'ReferenceId', '=', 'venue.VenueId')
                  ->where('venue.IsDeleted',['no'])
                  ->where('images.ImageRefType',['venue'])
                  ->where('images.IsDeleted',['N'])
                  ->orderBy('venue.VenueId')
                  ->paginate(12);
        return view('venues',['venues'=>$venues,'total_count'=>$total_count[0]->count,'show_count'=>'yes']);
      }
       
             public function myVenues(Request $request) {
   if($request->session()->has('user_id')){
   $userid = $request->session()->get('user_id');
   $venues = DB::table('venue')
       ->selectRaw('*, venue.VenueId,venue.VenueName,venue.ShortName,venue.phone')
             ->join('favourites', 'Attribute', '=', 'venue.VenueId')
                            ->join('images','ReferenceId','=','venue.VenueId')
                            ->where('images.ImageRefType',['venue'])
             ->where('favourites.Flag',['Yes'])
             ->where('favourites.FavouriteType',['venue'])
             ->where('favourites.UserId',[$userid])
             ->orderBy('venue.VenueId')
             ->paginate(12);
   return view('myvenues',['venues'=>$venues,'show_count'=>'yes']);
   } else {
         return redirect('venues');
     }
 }

	 public function searchVenues(Request $request) {
        $venue = $request->venue;
        $total_count = DB::select(' select count(VenueId) as count from venue where IsDeleted=?',['no']);
        $venues = DB::table('venue')
            ->selectRaw('*, venue.VenueId,venue.VenueName,venue.ShortName,venue.phone')
                  ->join('images', 'ReferenceId', '=', 'venue.VenueId')
                  ->where('venue.IsDeleted',['no'])
                  ->where('venue.VenueName','like','%'.strtolower($venue).'%')
                 ->where('images.ImageRefType',['venue'])
                  ->where('images.IsDeleted',['N'])
                  ->orderBy('venue.VenueId')
                  ->paginate(30);
        return view('venues',['venues'=>$venues,'total_count'=>$total_count[0]->count,'show_count'=>'no','search_term'=>$venue]);
      }
 public function venuebasicDetails(Request $request){
		   if($request->session()->has('user_id')){
		   	$userid = $request->session()->get('user_id');
		   	$venues = DB::select('select * from venue where ShortName = ?',[$request->shortname]);
			$venueid = $venues[0]->VenueId;
			$venueaddress= DB::select('select a.AddressId,a.AddressLine1,a.AddressLine2,a.AddressLine3,a.City,a.Country,a.County,a.PostCode from address a INNER JOIN venue v where v.VenueId=? and a.AddressId=v.AddressId',[$venueid]);
			$venue_status = DB::select('select * from bridgemembers where UserId = ? and BridgeType="venue" and ReferenceId=?',[$userid,$venueid]);
      $timings = DB::select('select Day,OpeningHours,ClosingHours from daysopen where TypeId=? and TableType="venue"',[$venueid]);
    $image = DB::select('select i.ImageId,i.ImagePath,i.ImageRefType from images i INNER JOIN venue v where v.VenueId=? and i.ImageRefType="venue" and i.ReferenceId=v.VenueId',[$venueid]);
			return view('viewvenuebasicdetails',['venues' => $venues,'address' => $venueaddress,'bridgemembers' => $venue_status,'image'=>$image,'timings'=>$timings]);
		   }
			else{
			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','Please login to continue...');
  			return view('login');	
			}
		
	}

public function viewvenuePool(Request $request){
    if($request->session()->has('user_id')){
        $userid = $request->session()->get('user_id');
      $venues = DB::select('select * from venue where ShortName = ?',[$request->shortname]);
      $venueid = $venues[0]->VenueId;
      $venuepool = DB::table('pools')
        ->selectRaw('pools.PoolName,Area,pools.Length,pools.SpecialRequirements')
        ->where('pools.VenueId',[$venueid])
        ->paginate(2);

    $venue_status = DB::select('select * from bridgemembers where UserId = ? and BridgeType="venue" and ReferenceId=?',[$userid,$venueid]);
    $image = DB::select('select i.ImageId,i.ImagePath,i.ImageRefType from images i INNER JOIN venue v where v.VenueId=? and i.ImageRefType="venue" and i.ReferenceId=v.VenueId',[$venueid]);
  $timings = DB::select('select Day,OpeningHours,ClosingHours from daysopen where TypeId=? and TableType="venue"',[$venueid]);
      $venueaddress= DB::select('select a.AddressId,a.AddressLine1,a.AddressLine2,a.AddressLine3,a.City,a.Country,a.County,a.PostCode,v.VenueName from address a INNER JOIN venue v where v.VenueId=? and a.AddressId=v.AddressId',[$venueid]);
      return view('viewvenuepool',['venues' => $venues,'pools' => $venuepool,'address'=>$venueaddress,'bridgemembers' => $venue_status,'image'=>$image,'timings'=>$timings]);

  }
  else{
      $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Please login to continue...');
        return view('login');
      }

  }

  public function viewvenueEvents(Request $request){
          if($request->session()->has('user_id')){
        $userid = $request->session()->get('user_id');
      $venues = DB::select('select * from venue where ShortName = ?',[$request->shortname]);
      $venueid = $venues[0]->VenueId;
      $venueaddress= DB::select('select a.AddressId,a.AddressLine1,a.AddressLine2,a.AddressLine3,a.City,a.Country,a.County,a.PostCode from address a INNER JOIN venue v where v.VenueId=? and a.AddressId=v.AddressId',[$venueid]);
      $venue_status = DB::select('select * from bridgemembers where UserId = ? and BridgeType="venue" and ReferenceId=?',[$userid,$venueid]);
      $image = DB::select('select i.ImageId,i.ImagePath,i.ImageRefType from images i INNER JOIN venue v where v.VenueId=? and i.ImageRefType="venue" and i.ReferenceId=v.VenueId',[$venueid]);
        $timings = DB::select('select Day,OpeningHours,ClosingHours from daysopen where TypeId=? and TableType="venue"',[$venueid]);
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
      return view('viewvenueevents',compact('calendar'),['venues' => $venues,'address' => $venueaddress,'upcomingevents'=>$futureevents,'completedevents'=>$pastevents,'bridgemembers' => $venue_status,'image'=>$image,'timings'=>$timings]);

  }
  else{
      $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Please login to continue...');
        return view('login');
      }

  }

  public function viewvenueAddress(Request $request){
     if($request->session()->has('user_id')){
        $userid = $request->session()->get('user_id');
      $venues = DB::select('select * from venue where ShortName = ?',[$request->shortname]);
      $venueid = $venues[0]->VenueId;
      $venueaddress= DB::select('select a.AddressId,a.AddressLine1,a.AddressLine2,a.AddressLine3,a.City,a.Country,a.County,a.PostCode from address a INNER JOIN venue v where v.VenueId=? and a.AddressId=v.AddressId',[$venueid]);
      $venue_status = DB::select('select * from bridgemembers where UserId = ? and BridgeType="venue" and ReferenceId=?',[$userid,$venueid]);
        $timings = DB::select('select Day,OpeningHours,ClosingHours from daysopen where TypeId=? and TableType="venue"',[$venueid]);
      $image = DB::select('select i.ImageId,i.ImagePath,i.ImageRefType from images i INNER JOIN venue v where v.VenueId=? and i.ImageRefType="venue" and i.ReferenceId=v.VenueId',[$venueid]);
  return view('viewvenueaddress',['venues' => $venues,'address' => $venueaddress,'bridgemembers' => $venue_status,'image'=>$image,'timings'=>$timings]);

  }
 else{
      $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Please login to continue...');
        return view('login');
      }

  }

  public function viewvenueContact(Request $request){
   if($request->session()->has('user_id')){
        $userid = $request->session()->get('user_id');
  $venues = DB::select('select VenueName,VenueId,ParaSwimmingFacilities,Parking,LadiesOnlySwimming,Shower,PrivateHire,Gym,Diving,Teachers,Toilets,VisitingGallery,LadiesOnlySwimTimes,Phone,Mobile,Website,Website2,Email,ShortName,Facebook,Twitter,GooglePlus from venue where ShortName = ?',[$request->shortname]);
  $venueid = $venues[0]->VenueId;
  $venue_status = DB::select('select * from bridgemembers where UserId = ? and BridgeType="venue" and ReferenceId=?',[$userid,$venueid]);
  $image = DB::select('select i.ImageId,i.ImagePath,i.ImageRefType from images i INNER JOIN venue v where v.VenueId=? and i.ImageRefType="venue" and i.ReferenceId=v.VenueId',[$venueid]);
    $timings = DB::select('select Day,OpeningHours,ClosingHours from daysopen where TypeId=? and TableType="venue"',[$venueid]);
$venueaddress= DB::select('select a.AddressId,a.AddressLine1,a.AddressLine2,a.AddressLine3,a.City,a.Country,a.County,a.PostCode from address a INNER JOIN venue v where v.VenueId=? and a.AddressId=v.AddressId',[$venueid]);
      return view('viewvenuecontact',['venues' => $venues,'address'=>$venueaddress,'bridgemembers' => $venue_status,'image'=>$image,'timings'=>$timings]);
   }
   else{
      $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Please Login to continue...');
        return view('login');
      }
    }

       public function JoinVenue(Request $request){
       if($request->session()->has('user_id')){
         $userid = $request->session()->get('user_id');
         $username = $request->session()->get('user_name');
         $date=date("Y-m-d");
         $venues = DB::select('select VenueName,venue.VenueOwner,VenueId,Description,ParaSwimmingFacilities,Parking,LadiesOnlySwimming,Shower,PrivateHire,Gym,Diving,Teachers,Toilets,VisitingGallery,LadiesOnlySwimTimes,Phone,Mobile,Website,Website2,Email,ShortName,Facebook,Twitter,GooglePlus from venue where ShortName = ?',[$request->shortname]);
         $venueid = $venues[0]->VenueId;
          $venueowner = $venues[0]->VenueOwner;
          $venuename = $venues[0]->VenueName;
         $venue_status = DB::select('select * from bridgemembers where UserId = ? and BridgeType="venue" and ReferenceId=?',[$userid,$venueid]);
         if(count($venue_status)>0){
           $request->session()->flash('message.level','danger');
           $request->session()->flash('message.content','Already you made a request');
           return redirect('venue/'.$request->shortname);
         }
         else{
            $joinvenue = DB::insert('insert into bridgemembers(BridgeType,ReferenceId,UserId,ApproveStatus,CreatedDate,IsDeleted,DeletedBy,DeletedDate) values(?,?,?,?,?,?,?,?)',['venue',$venueid,$userid,'pending',$date,'no',0,$date]);
            if($joinvenue){
             $request->session()->flash('message.level','info');
             $request->session()->flash('message.content','Request sent succesfully...');
          DB::insert("insert into notifications(ReceiverId,Notification,NotificationType,IsRead) values (?,?,?,?)",[$venueowner," You Have a new request from " .$username." for your venue ".$venuename.", <a href=".url('acceptuserrequest/'.$venueid)."  style='color: #3c763d'>Click Here</a> to accept it and ignore if you are not intrested.",1,0]);
           return redirect('venue/'.$request->shortname);
            }
         }
       }
       else{
         $request->session()->flash('message.level','danger');
         $request->session()->flash('message.content','please login to continue...');
         return view('login');
       }
     }
public function VenueDashboard(Request $request){
		if($request->session()->has('user_id') && $request->session()->get('user_type')=='venue' ){
			$userid = $request->session()->get('user_id');

			$pendingrequests = DB::select('select users.UserName,users.Image,users.UserType, bridgemembers.CreatedDate,bridgemembers.ReferenceId FROM users INNER JOIN bridgemembers ON users.UserId = bridgemembers.UserId WHERE bridgemembers.ApproveStatus = "pending" and bridgemembers.BridgeType = "venue"');
          
         

         $completedrequests = DB::select('select users.UserName,users.Image,users.UserType, bridgemembers.CreatedDate,bridgemembers.ReferenceId,bridgemembers.ApproveStatus FROM users INNER JOIN bridgemembers ON users.UserId = bridgemembers.UserId WHERE bridgemembers.BridgeType = "venue" and bridgemembers.ApproveStatus = "accepted" OR bridgemembers.ApproveStatus = "rejected"');
        // $venue_status = DB::select('select *  from bridgemembers where UserId = ?',[$userid]);   

         $myvenues = DB::select('select a.AddressId,a.AddressLine1,a.AddressLine2,a.AddressLine3,a.City,a.Country,a.County,a.PostCode,v.VenueName,v.Phone,v.ShortName from address a INNER JOIN venue v where v.VenueOwner=? and a.AddressId=v.AddressId',[$userid]);
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
        return view('venuedashboard',compact('calendar'),['pendingrequests' => $pendingrequests, 'completedrequests' => $completedrequests, 'venues'=>$myvenues]);
		
	}
	   else{
	   	$request->session()->flash('message.level','danger');
	   	$request->session()->flash('message.content','You have tried to view other users dashboard, Redirected to your dashboard page...');
	   	return redirect($request->session()->get('user_type').'dashboard');
	   }
	}

      public function acceptuserrequest(Request $request) {

    $userid = $request->session()->get('user_id');
  //  $username = $request->session()->get('user_name');
    $pendingrequests = DB::select('select users.UserId,users.UserName,users.Image,users.UserType, bridgemembers.CreatedDate,bridgemembers.ReferenceId,bridgemembers.ApproveStatus,venue.VenueId,venue.VenueOwner,venue.ShortName FROM users,venue INNER JOIN bridgemembers where users.UserId = bridgemembers.UserId and venue.VenueId=bridgemembers.ReferenceId and bridgemembers.ApproveStatus = "pending" and bridgemembers.BridgeType = "venue" and venue.VenueOwner=?',[$userid]);
    $receiverid = $pendingrequests[0]->UserId;
         $shortname = $pendingrequests[0]->ShortName;
$acceptuserrequest =  DB::table('bridgemembers')->where('ReferenceId',$request->id)->update(['ApproveStatus'=>'accepted']);
          if($acceptuserrequest){
            $request->session()->flash('message.level','info');
            $request->session()->flash('message.content','Request Accepted');
             DB::insert("insert into notifications(ReceiverId,Notification,NotificationType,IsRead) values (?,?,?,?)",[$receiverid," Your request has been accepted for your venue , <a href=".url('venue/'.$shortname)." style='color: #3c763d'>Click Here</a> to view venue details.",1,0]);
            return redirect('venuedashboard');
           }
}
public function rejectuserrequest(Request $request) {
     $user_id = $request->session()->get('user_id');
      $pendingrequests = DB::select('select users.UserId,users.UserName,users.Image,users.UserType, bridgemembers.CreatedDate,bridgemembers.ReferenceId,bridgemembers.ApproveStatus,venue.VenueId,venue.VenueOwner FROM users,venue INNER JOIN bridgemembers where users.UserId = bridgemembers.UserId and venue.VenueId=bridgemembers.ReferenceId and bridgemembers.ApproveStatus = "pending" and bridgemembers.BridgeType = "venue" and venue.VenueOwner=?',[$user_id]);
      $receiverid = $pendingrequests[0]->UserId;
   $rejectuserrequest =  DB::table('bridgemembers')->where('ReferenceId',$request->id)->update(['ApproveStatus'=>'rejected']);
           if($rejectuserrequest){
             $request->session()->flash('message.level','danger');
             $request->session()->flash('message.content','Request Rejected');
              DB::insert("insert into notifications(ReceiverId,Notification,NotificationType,IsRead) values (?,?,?,?)",[$receiverid," Your request has been accepted for your venue , <a href=".url('venue/'.$shortname)." style='color: #3c763d'>Click Here</a> to view venue details.",1,0]);
             return redirect('venuedashboard');
            }
         }
         
public function saveeditheat(Request $request){
    $user_id = $request->session()->get('user_id');
  $event_id = $request->event_id;
  $heat_id = $request->heat_id;
  $stage_no = $request->stage_no;
  $heat_generation = $request->heat_generation;
  $heat_name = $request->heat_name;
  $schedule_time = $request->schedule_time;
  $qualification = $request->qualification;
  $schedule_date = $request->schedule_date;
  $max_participants = $request->max_participants;
  $relay = $request->relay;
  $course = $request->course;
  $swim_style = $request->swim_style;
  $specialinstructions = $request->specialinstructions;
  $description = $request->descriptions;
  $update_heat = DB::update('update eventheats set HeatName=?,HeatStartDate=?,HeatTime=?,StageNumber=?,MaxNoOfParticipants=?,QualificationTime=?,Relay=?,SwimCourse=?,SwimStyle=?,VenueHeatSpecialInstructions=?,HeatNotes=? where HeatId=?',[$heat_name,$schedule_date,$schedule_time,$stage_no,$max_participants,$qualification,$relay,$course,$swim_style,$specialinstructions,$description,$heat_id]);
  if($update_heat){
    $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Heat Details updated Sucessfully');
      return redirect('editheat/'.$event_id.'/'.$heat_id);
  }
  else{
    $request->session()->flash('message.level','danger');
      $request->session()->flash('message.content','No Changes made to heats.Please try again...');
      return redirect('editheat/'.$event_id.'/'.$heat_id);
  }
  }
  
 public function manageHeatSetup(Request $request) {
    if($request->session()->has('user_id')) {
        $userid = $request->session()->get('user_id');
      //  $events = DB::select('select EventId,EventName from events where CreatedBy=?',[$userid]);
        $events = DB::table('events')
        ->selectRaw('EventId,EventName')
        ->where('CreatedBy',[$userid])
        ->paginate(12);
        return view('manageheatsetup',['events'=>$events]);
    } else {
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Please login to continue...');
        return redirect('login');
    }
 }
  
  public function heatSetup(Request $request){
  if($request->session()->has('user_id')){
      $userid = $request->session()->get('user_id');
      $event_id = $request->id;
       
      $venues = DB::select('select VenueId,VenueName from venue where VenueOwner=? and IsDeleted=?',[$userid,'no']);
  
      $events = DB::select('select e.EventId,e.EventName,s.Course,s.SwimStyle,s.Relay,s.MaxParticipants,s.SpecialInstructions from events e inner join subevents s on e.EventId=s.EventId'
              . ' where e.EventId=? and e.IsDeleted=? or e.IsDeleted=? ',[$event_id,'No','no']);
      
      $heat_info = DB::select('select max(StageNumber) as stage from eventheats where EventId=?',[$event_id]);
      $stage_level = 0;
      if($heat_info[0]->stage == 3) {
       $stage_level = 3;   
      } elseif($heat_info[0]->stage == 2) {
       $stage_level = 2;   
      } elseif($heat_info[0]->stage == 1) {
       $stage_level = 1;   
      } else {
       $stage_level = 0;   
      }
  return view('heatsetup',['event_id'=>$event_id,'venues'=>$venues,'events'=>$events, 'stage_level'=>$stage_level]);
  }
  else{
      $request->session()->flash('message.level','danger');
      $request->session()->flash('message.content','please login to continue...');
      return view('login');
  }
 }
 public function saveheatSetup(Request $request){
  $user_id = $request->session()->get('user_id');
  $event_id = $request->id;
  $heat_name = $request->heat_name;
  $start_date = $request->start_date;
  $end_date = $request->end_date;
  $heat_time = $request->heat_time;
  $venueid = $request->venue_id;
  $max_participants = $request->max_participants;
  $qualification_time = $request->qualification_time;
  $relay = $request->relay;
  $course = $request->course;
  $swim_style = $request->swim_style;
  $specialinstructions = $request->specialinstructions;
  $description = $request->descriptions;
  $stagennumber = $request->stagenumber;

   $venues = DB::select('select VenueId,VenueName from venue where VenueOwner=? and IsDeleted=?',[$user_id,'no']);
  
      $events = DB::select('select e.EventId,e.EventName,s.Course,s.SwimStyle,s.Relay,s.MaxParticipants,s.SpecialInstructions from events e inner join subevents s on e.EventId=s.EventId where e.EventId=? and e.IsDeleted=? ',[$event_id,'no']);
 $add_heat = DB::table('eventheats')->insertGetId(array('EventId'=>$event_id,'HeatName'=>$heat_name,'HeatStartDate'=>$start_date,'HeatTime'=>$heat_time,'StageNumber'=> $stagennumber ,'MaxNoOfParticipants'=>$max_participants,'VenueId'=>$venueid,'QualificationTime'=>$qualification_time,'Relay'=>$relay,'SwimCourse'=>$course,'SwimStyle'=>$swim_style,'ChildHeatId'=>0,'VenueHeatSpecialInstructions'=>$specialinstructions,'HeatNotes'=>$description,'CreatedBy'=>$user_id,'UpdatedBy'=>$user_id));
  if($add_heat){
    $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Added Heat details, Scrolldown to see heats options');
      return redirect('heatsetup/'.$event_id);
  }
  else{
    $request->session()->flash('message.level','danger');
      $request->session()->flash('message.content','Heat not added.Please try again..');
      return redirect('heatsetup');
  }
 }

   public function heatsemifinal(Request $request){
    if($request->session()->has('user_id')){
      $userid = $request->session()->get('user_id');
        $event_id = $request->id;
      $venues = DB::select('select VenueId,VenueName from venue where VenueOwner=? and IsDeleted=?',[$userid,'no']);
  
      $events = DB::select('select e.EventId,e.EventName,s.Course,s.SwimStyle,s.Relay,s.MaxParticipants,s.SpecialInstructions from events e inner join subevents s on e.EventId=s.EventId'
              . ' where e.EventId=? and e.IsDeleted=? ',[$event_id,'No']);
     
      $heat_info = DB::select('select max(StageNumber) as stage from eventheats where EventId=?',[$event_id]);
      $stage_level = 0;
      if($heat_info[0]->stage == 3) {
       $stage_level = 3;   
      } elseif($heat_info[0]->stage == 2) {
       $stage_level = 2;   
      } elseif($heat_info[0]->stage == 1) {
       $stage_level = 1;   
      } else {
       $stage_level = 0;   
      }

      return view('semiheatsetup',['event_id'=>$event_id,'venues'=>$venues,'events'=>$events, 'stage_level'=>$stage_level]);
    }
    else{
      $request->session()->flash('message.level','danger');
      $request->session()->flash('message.content','please login to continue...');
      return view('login');
    }

  }
 public function savesemifinal(Request $request){
  $user_id = $request->session()->get('user_id');
  $event_id = $request->id;
  $heat_name = $request->heat_name;
  $start_date = $request->start_date;
  $end_date = $request->end_date;
  $heat_time = $request->heat_time;
  $venueid = $request->venue_id;
  $max_participants = $request->max_participants;
  $qualification_time = $request->qualification_time;
  $relay = $request->relay;
  $course = $request->course;
  $swim_style = $request->swim_style;
  $specialinstructions = $request->specialinstructions;
  $description = $request->descriptions;
  $stagennumber = $request->stagenumber;
  $venues = DB::select('select VenueId,VenueName from venue where VenueOwner=? and IsDeleted=?',[$user_id,'no']);
  
      $events = DB::select('select e.EventId,e.EventName,s.Course,s.SwimStyle,s.Relay,s.MaxParticipants,s.SpecialInstructions from events e inner join subevents s on e.EventId=s.EventId'
              . ' where e.EventId=? and e.IsDeleted=? ',[$event_id,'No']);
      $semi_final = DB::table('eventheats')->insertGetId(array('EventId'=>$event_id,'HeatName'=>$heat_name,'HeatStartDate'=>$start_date,'HeatTime'=>$heat_time,'StageNumber'=> $stagennumber ,'MaxNoOfParticipants'=>$max_participants,'VenueId'=>$venueid,'QualificationTime'=>$qualification_time,'Relay'=>$relay,'SwimCourse'=>$course,'SwimStyle'=>$swim_style,'ChildHeatId'=>0,'VenueHeatSpecialInstructions'=>$specialinstructions,'HeatNotes'=>$description,'CreatedBy'=>$user_id,'UpdatedBy'=>$user_id));
      if($semi_final){
    $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Heat added Successfully <a href="'.url('finalheatsetup/'.$event_id).'"> Click here</a>  to Add finals.');
      return redirect('semiheatsetup/'.$event_id);
  }
  else{
    $request->session()->flash('message.level','danger');
      $request->session()->flash('message.content','Heat not added.Please try again..');
      return redirect('semiheatsetup');
  }
  }


    public function heatfinal(Request $request){
    if($request->session()->has('user_id')){
      $userid = $request->session()->get('user_id');
        $event_id = $request->id;
      $venues = DB::select('select VenueId,VenueName from venue where VenueOwner=? and IsDeleted=?',[$userid,'no']);
  
      $events = DB::select('select e.EventId,e.EventName,s.Course,s.SwimStyle,s.Relay,s.MaxParticipants,s.SpecialInstructions from events e inner join subevents s on e.EventId=s.EventId'
              . ' where e.EventId=? and e.IsDeleted=? ',[$event_id,'No']);

      return view('finalheatsetup',['event_id'=>$event_id,'venues'=>$venues,'events'=>$events]);
    }
    else{
      $request->session()->flash('message.level','danger');
      $request->session()->flash('message.content','please login to continue...');
      return view('login');
    }

  }


  public function savefinal(Request $request){
  $user_id = $request->session()->get('user_id');
  $event_id = $request->id;
  $heat_name = $request->heat_name;
  $start_date = $request->start_date;
  $end_date = $request->end_date;
  $heat_time = $request->heat_time;
  $venueid = $request->venue_id;
  $max_participants = $request->max_participants;
  $qualification_time = $request->qualification_time;
  $relay = $request->relay;
  $course = $request->course;
  $swim_style = $request->swim_style;
  $specialinstructions = $request->specialinstructions;
  $description = $request->descriptions;
  $stagennumber = $request->stagenumber;
  $venues = DB::select('select VenueId,VenueName from venue where VenueOwner=? and IsDeleted=?',[$user_id,'no']);
  
      $events = DB::select('select e.EventId,e.EventName,s.Course,s.SwimStyle,s.Relay,s.MaxParticipants,s.SpecialInstructions from events e inner join subevents s on e.EventId=s.EventId'
              . ' where e.EventId=? and e.IsDeleted=? ',[$event_id,'No']);
      $semi_final = DB::table('eventheats')->insertGetId(array('EventId'=>$event_id,'HeatName'=>$heat_name,'HeatStartDate'=>$start_date,'HeatTime'=>$heat_time,'StageNumber'=> $stagennumber ,'MaxNoOfParticipants'=>$max_participants,'VenueId'=>$venueid,'QualificationTime'=>$qualification_time,'Relay'=>$relay,'SwimCourse'=>$course,'SwimStyle'=>$swim_style,'ChildHeatId'=>0,'VenueHeatSpecialInstructions'=>$specialinstructions,'HeatNotes'=>$description,'CreatedBy'=>$user_id,'UpdatedBy'=>$user_id));
      if($semi_final){
    $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Heat added Successfully <a href="'.url('finalheatsetup/'.$event_id).'"> Click here</a>  to Add finals.');
      return redirect('finalheatsetup/'.$event_id);
  }
  else{
    $request->session()->flash('message.level','danger');
      $request->session()->flash('message.content','Heat not added.Please try again..');
      return redirect('finalheatsetup');
  }
  }

 public function manageParticpants(Request $request){
   if($request->session()->has('user_id')){
     $user_id = $request->session()->get('user_id');
     $event_id = $request->event_id;
     $subevent_id = $request->subevent_id;
     $heat_id = $request->heat_id;
     $participants = DB::select('SELECT DISTINCT participants.ParticipantId,participants.ParticipantName FROM participants INNER JOIN bridgeeventparticipants where participants.ParticipantId = bridgeeventparticipants.ParticipantId and bridgeeventparticipants.EventId=? and bridgeeventparticipants.Status=?',[$event_id,0]);
     $mainheat = DB::select('select HeatName from eventheats where HeatId=? and EventId=?',[$heat_id,$event_id]);
     $heatname = $mainheat[0]->HeatName;
     $heats = DB::select('select HeatId,HeatName from eventheats where EventId=? and StageNumber=?',[$event_id,1]);
     $heat_participants = DB::select('select DISTINCT p.ParticipantId,p.ParticipantName from participants p INNER JOIN bridgeheatparticipants b where p.ParticipantId=b.ParticipantId and b.EventId=? and b.HeatId=?',[$event_id,$heat_id]);
     return view('manage-heat-participants',['participants'=>$participants,'heatname'=>$heatname,'heats'=>$heats,'event_id'=>$event_id,'heat_id'=>$heat_id,'heat_participants'=>$heat_participants,'subevent_id'=>$subevent_id]);
   }
   else{
     $request->session()->flash('message.level','danger');
     $request->session()->flash('message.content','Passwords didnot match. Please,Try again..');
     return redirect('login');
   }
 }

 public function saveParticipants(Request $request){
   $user_id = $request->session()->get('user_id');
   $participant = $request->participants;
   $heats_participants = $request->heats_participants;
   $heats_id = $request->heats_id;
   $heat_id = $request->heat_id;
   $event_id = $request->event_id;
   $subevent_id = $request->subevent_id;
   if($participant!=''){
    $max_participants = DB::select('select MaxNoOfParticipants from eventheats where EventId=? and HeatId=?',[$event_id,$heat_id]);
    $max_participant = $max_participants[0]->MaxNoOfParticipants;
    $participants_added = DB::select('select ParticipantId from bridgeheatparticipants where EventId=? and HeatId=?',[$event_id,$heat_id]);
    if(count($participants_added)>=$max_participant){
      $request->session()->flash('message.level','info');
   $request->session()->flash('message.content','Max Participants limit exceeded');
   return redirect('manageparticipants/'.$event_id.'/'.$heat_id);
    }
    else{
    for($i=0;$i<count($participant);$i++){
       $eventparticipants = DB::update('update bridgeeventparticipants set Status=? where EventId=? and ParticipantId=?',[1,$event_id,$participant[$i]]);
       $set_heatparticipants = DB::table('bridgeheatparticipants')->insertGetId(array('HeatId'=>$heat_id,'EventId'=>$event_id,'ParticipantId'=>$participant[$i],'CreatedBy'=>$user_id,'StageNo'=>1,'AssignStatus'=>0));
     }
     $request->session()->flash('message.level','success');
   $request->session()->flash('message.content','Participants Moved to heat');
   return redirect('manageparticipants/'.$event_id.'/'.$heat_id);
    }
   }
   elseif($heats_participants!=''){
     for($i=0;$i<count($heats_participants);$i++){
       $heatparticipants = DB::delete('delete from bridgeheatparticipants where ParticipantId=? and EventId=? and HeatId=?',[$heats_participants[$i],$event_id,$heat_id]);
       $set_eventparticipants = DB::update('update bridgeeventparticipants set Status=? where EventId=? and ParticipantId=?',[0,$event_id,$heats_participants[$i]]);
     }
       $request->session()->flash('message.level','success');
   $request->session()->flash('message.content','Participants Removed from heat');
   return redirect('manageparticipants/'.$event_id.'/'.$heat_id);
   }
   else{
     $request->session()->flash('message.level','success');
     $request->session()->flash('message.content','Changes saved Sucessfully');
     return redirect('manageparticipants/'.$event_id.'/'.$heat_id);
   }
 }
 
 public function semifinalParticipants(Request $request){
    $event_id = $request->event_id;
    $heat_id = $request->heat_id;
    $level_id = $request->level_id;
    if($level_id == 2){
    $semifinals = DB::select('select DISTINCT HeatId,HeatName from eventheats where HeatId=?',[$heat_id]);
    $semifinalname = $semifinals[0]->HeatName;
     $semifinal_heats = DB::select('select DISTINCT HeatId,HeatName from eventheats where EventId=? and StageNumber=?',[$event_id,2]);
    $participants = DB::select('select DISTINCT p.ParticipantId,p.ParticipantName from participants p JOIN bridgeeventparticipants b on b.EventId=? and b.Status=? and b.ParticipantId=p.ParticipantId JOIN eventresults e on e.EventId=? and e.Result=? and e.ParticipantId=p.ParticipantId',[$event_id,1,$event_id,'semifinal']);
    $semifinal_participants = DB::select('select DISTINCT p.ParticipantId,p.ParticipantName from participants p JOIN bridgeheatparticipants b on b.EventId=? and b.HeatId=? and b.StageNo=? and b.AssignStatus=? and b.ParticipantId=p.ParticipantId JOIN bridgeeventparticipants be on b.ParticipantId=be.ParticipantId',[$event_id,$heat_id,2,1]);
    return view('semifinalparticipants',['event_id'=>$event_id,'heat_id'=>$heat_id,'level_id'=>$level_id,'semifinal_participants'=>$semifinal_participants,'semifinals'=>$semifinals,'semifinalname'=>$semifinalname,'participants'=>$participants,'semifinal_heats'=>$semifinal_heats]);
    }
    else{
      $semifinals = DB::select('select DISTINCT HeatId,HeatName from eventheats where HeatId=?',[$heat_id]);
      $semifinalname = $semifinals[0]->HeatName;
      $semifinal_heats = DB::select('select DISTINCT HeatId,HeatName from eventheats where EventId=? and StageNumber=?',[$event_id,3]);
      $participants = DB::select('select DISTINCT p.ParticipantId,p.ParticipantName from participants p JOIN bridgeeventparticipants b on b.EventId=? and b.Status=? and b.ParticipantId=p.ParticipantId JOIN eventresults e on e.EventId=? and e.Result=? and e.ParticipantId=p.ParticipantId',[$event_id,2,$event_id,'final']);
      $semifinal_participants = DB::select('select DISTINCT p.ParticipantId,p.ParticipantName from participants p JOIN bridgeheatparticipants b on b.HeatId=? and b.EventId=? and b.StageNo=? and b.AssignStatus=? and b.ParticipantId=p.ParticipantId JOIN bridgeeventparticipants be on b.ParticipantId=be.ParticipantId',[$heat_id,$event_id,3,2]);
      return view('semifinalparticipants',['event_id'=>$event_id,'heat_id'=>$heat_id,'level_id'=>$level_id,'semifinal_participants'=>$semifinal_participants,'semifinals'=>$semifinals,'semifinalname'=>$semifinalname,'participants'=>$participants,'semifinal_heats'=>$semifinal_heats]);
    }
  }

  public function savesemifinalParticipants(Request $request){
    $participants = $request->participants;
    $heats_participants = $request->heats_participants;
    $heats_id = $request->heats_id;
    $event_id = $request->event_id;
    $level_id = $request->level_id;
    $heat_id = $request->heat_id;
    if($level_id == 2){
    if($participants!=''){
       $max_participants = DB::select('select MaxNoOfParticipants from eventheats where EventId=? and HeatId=?',[$event_id,$heat_id]);
    $max_participant = $max_participants[0]->MaxNoOfParticipants;
    $participants_added = DB::select('select ParticipantId from bridgeheatparticipants where EventId=? and HeatId=?',[$event_id,$heat_id]);
    if(count($participants_added)>=$max_participant){
      $request->session()->flash('message.level','info');
   $request->session()->flash('message.content','Max Participants limit exceeded');
   return redirect('manageparticipants/'.$event_id.'/'.$heat_id);
    }
    else{
      for($i=0;$i<count($participants);$i++){
      $update_participants = DB::update('update bridgeheatparticipants set HeatId=?,StageNo=?,AssignStatus=? where ParticipantId=? and EventId=?',[$heat_id,2,1,$participants[$i],$event_id]);
      $update_eventparticipants = DB::update('update bridgeeventparticipants set Status=? where EventId=? and ParticipantId=?',[2,$event_id,$participants[$i]]);
      }
      $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Participants moved to semifinal');
      return redirect('manageparticipants/'.$event_id.'/'.$heats_id.'/'.$level_id);
    }
    }
    elseif($heats_participants!=''){
      for($i=0;$i<count($heats_participants);$i++){
        $update_participants = DB::update('update bridgeheatparticipants set StageNo=?,AssignStatus=? where ParticipantId=? and EventId=?',[1,0,$heats_participants[$i],$event_id]);
        $update_eventparticipants = DB::update('update bridgeeventparticipants set Status=? where EventId=? and ParticipantId=?',[1,$event_id,$heats_participants[$i]]);
      }
      $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Participants moved to semifinal');
      return redirect('manageparticipants/'.$event_id.'/'.$heat_id.'/'.$level_id);
    }
    else{
      $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Changes saved Sucessfully');
      return redirect('manageparticipants/'.$event_id.'/'.$heat_id.'/'.$level_id);
    }
    }
    else{
      if($participants!=''){
         $max_participants = DB::select('select MaxNoOfParticipants from eventheats where EventId=? and HeatId=?',[$event_id,$heat_id]);
    $max_participant = $max_participants[0]->MaxNoOfParticipants;
    $participants_added = DB::select('select ParticipantId from bridgeheatparticipants where EventId=? and HeatId=?',[$event_id,$heat_id]);
    if(count($participants_added)>=$max_participant){
      $request->session()->flash('message.level','info');
   $request->session()->flash('message.content','Max Participants limit exceeded');
   return redirect('manageparticipants/'.$event_id.'/'.$heat_id);
    }
    else{
      for($i=0;$i<count($participants);$i++){
      $update_participants = DB::update('update bridgeheatparticipants set HeatId=?,StageNo=?,AssignStatus=? where ParticipantId=? and EventId=?',[$heat_id,3,2,$participants[$i],$event_id]);
      $update_eventparticipants = DB::update('update bridgeeventparticipants set Status=? where EventId=? and ParticipantId=?',[3,$event_id,$participants[$i]]);
      }
      $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Participants moved to semifinal');
      return redirect('manageparticipants/'.$event_id.'/'.$heats_id.'/'.$level_id);
    }
    }
    elseif($heats_participants!=''){
      for($i=0;$i<count($heats_participants);$i++){
        $update_participants = DB::update('update bridgeheatparticipants set StageNo=?,AssignStatus=? where ParticipantId=? and EventId=?',[2,1,$heats_participants[$i],$event_id]);
         $update_eventparticipants = DB::update('update bridgeeventparticipants set Status=? where EventId=? and ParticipantId=?',[2,$event_id,$heats_participants[$i]]);
      }
      $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Participants moved to semifinal');
      return redirect('manageparticipants/'.$event_id.'/'.$heat_id.'/'.$level_id);
    }
    else{
      $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Changes saved Sucessfully');
      return redirect('manageparticipants/'.$event_id.'/'.$heat_id.'/'.$level_id);
    }
    }
  }

  
 public function oldHeatSchedule(Request $request){
    $event_id = $request->event_id;
 
    $schedules = DB::select('select HeatId,HeatName,HeatStartDate,HeatTime,QualificationTime from eventheats where EventId=? and IsDeleted = "No" and StageNumber = 1',[$event_id]);
    $heat_id = $schedules[0]->HeatId;
    if( count($schedules)>0 ) {
    echo '<h5 class="add_venue"><a href="#"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button></a> Previous Entries</h5>';
                echo '<div class="row" style="border:1px solid #eee">';
                echo "<table class='table table-striped'>";
                echo "<tr><th>Heat Name</th><th>Heat StartDate</th><th>Edit</th><th>Delete</th><th>Add Participants<th>Result Entry</th><th>View Results</th></tr>";
                foreach($schedules as $schedule) {
                    echo "<tr><td>".$schedule->HeatName."</td><td>".$schedule->HeatStartDate."</td><td><a href=".url('/editheat/'.$event_id.'/'.$schedule->HeatId)." style='color:black;'>Edit</a></td><td><a href=".url('/deleteheat/'.$event_id.'/'.$schedule->HeatId)." style='color:black;'>Delete</a></td><td><a href=".url('/manageparticipants/'.$event_id.'/'.$schedule->HeatId)." style='color:black;'>Add Participants</a><a href=".url('/participantsexcel/'.$event_id.'/'.$schedule->HeatId.'/1')."><img src='".url('public/images/excel.png')."' width='20' height='20'></a></td>";
                 $heatparticipants = DB::select('select * from bridgeheatparticipants where EventId=? and HeatId=?',[$event_id,$heat_id]);
                  if(count($heatparticipants)>0){
                    echo "<td><a href=".url('/resultentry/'.$event_id.'/'.$schedule->HeatId.'/1')." style='color:black;'>Result entry</td>"; 
               }
                  else{
                   echo "<td><a href='' style='color:black;'>------</td>";
                  }
                  $heatresults = DB::select('select * from eventresults where EventId =? and HeatId = ?',[$event_id,$heat_id]);
                  if(count($heatresults)>0){
                   echo "<td><a href=".url('/heatresult/'.$event_id.'/'.$schedule->HeatId.'/1')." style='color:black;'>View Result</td></tr>";
                  }
                  else{
                  echo "<td><a href='' style='color:black;'>-------</td></tr>";
                  }
                }
                echo "</table>";
                echo '</div>';
    }
  }

    public function oldSemiSchedule(Request $request){
   $event_id = $request->event_id;
   $heat_id = $request->heat_id;
   $schedules = DB::select('select HeatId,HeatName,HeatStartDate,HeatTime,QualificationTime from eventheats where EventId=? and IsDeleted = "No" and StageNumber = 2',[$event_id]);
   if( count($schedules)>0 ) {
   echo '<h5 class="add_venue"><a href="#"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button></a> Previous Entries</h5>';
               echo '<div class="row" style="border:1px solid #eee">';
               echo "<table class='table table-striped'>";
               echo "<tr><th>Heat Name</th><th>Heat StartDate</th><th>Edit</th><th>Delete</th><th>Manage Participants</th><th>Result Entry</th><th>View Result</th></tr>";
               foreach($schedules as $schedule) {
                   echo "<tr><td>".$schedule->HeatName."</td><td>".$schedule->HeatStartDate."</td><td><a href=".url('/editheat/'.$event_id.'/'.$schedule->HeatId)." style='color:black;'>Edit</a></td><td><a href=".url('/deleteheat/'.$event_id.'/'.$schedule->HeatId)." style='color:black;'>Delete</a></td><td><a href=".url('/manageparticipants/'.$event_id.'/'.$schedule->HeatId)." style='color:black;'>Manage Participants</a><a href=".url('/participantsexcel/'.$event_id.'/'.$schedule->HeatId.'/1')."><img src='".url('public/images/excel.png')."' width='20' height='20'></a></td>";
                 $heatparticipants = DB::select('select * from bridgeheatparticipants where EventId=? and HeatId=? and StageNo = 2',[$event_id,$heat_id]);
                 if(count($heatparticipants)>0){
                   echo "<td><a href=".url('/resultentry/'.$event_id.'/'.$schedule->HeatId.'/1')." style='color:black;'>Result entry</td>";
                 }
                 else{
                  echo "<td><a href='' style='color:black;'>------</td>";
                 }
               $heatresults = DB::select('select * from bridgeheatparticipants where EventId =? and HeatId = ?',[$event_id,$heat_id]);
                 if(count($heatresults)>0){
                  echo "<td><a href=".url('/heatresults/'.$event_id.'/'.$schedule->HeatId.'/1')." style='color:black;'>View Result</td></tr>";
                 }
                 else{
                 echo "<td><a href='' style='color:black;'>-------</td></tr>";
                 }
               }
               echo "</table>";
               echo '</div>';
   }
 }

 public function oldFinalSchedule(Request $request){
    $event_id = $request->event_id;
    $heat_id = $request->heat_id;
    $schedules = DB::select('select HeatId,HeatName,HeatStartDate,HeatTime,QualificationTime from eventheats where EventId=? and IsDeleted = "No" and StageNumber = 3',[$event_id]);
    if( count($schedules)>0 ) {
    echo '<h5 class="add_venue"><a href="#"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button></a> Previous Entries</h5>';
                echo '<div class="row" style="border:1px solid #eee">';
                echo "<table class='table table-striped'>";
                echo "<tr><th>Heat Name</th><th>Heat StartDate</th><th>Edit</th><th>Delete</th><th>Manage Participants</th><th>Result Entry</th><th>View Result</th></tr>";
                foreach($schedules as $schedule) {
                    echo "<tr><td>".$schedule->HeatName."</td><td>".$schedule->HeatStartDate."</td><td><a href=".url('/editheat/'.$event_id.'/'.$schedule->HeatId)." style='color:black;'>Edit</a></td><td><a href=".url('/deleteheat/'.$event_id.'/'.$schedule->HeatId)." style='color:black;'>Delete</a></td><td><a href=".url('/manageparticipants/'.$event_id.'/'.$schedule->HeatId)." style='color:black;'>Manage Participants</a><a href=".url('/participantsexcel/'.$event_id.'/'.$schedule->HeatId.'/1')."><img src='".url('public/images/excel.png')."' width='20' height='20'></a></td>";
                     $heatparticipants = DB::select('select * from bridgeheatparticipants where EventId=? and HeatId=? and StageNo = 3',[$event_id,$heat_id]);
                  if(count($heatparticipants)>0){
                    echo "<td><a href=".url('/resultentry/'.$event_id.'/'.$schedule->HeatId.'/1')." style='color:black;'>Result entry</td>"; 
                  }
                  else{
                   echo "<td><a href='' style='color:black;'>------</td>";
                  }
                $heatresults = DB::select('select * from bridgeheatparticipants where EventId =? and HeatId = ?',[$event_id,$heat_id]);
                  if(count($heatresults)>0){
                   echo "<td><a href=".url('/heatresult/'.$event_id.'/'.$schedule->HeatId.'/1')." style='color:black;'>View Result</td></tr>";
                  }
                  else{
                  echo "<td><a href='' style='color:black;'>-------</td></tr>";
                  }
                }
            
                echo "</table>";
                echo '</div>';
    }
  }

  public function editheat(Request $request){
    if($request->session()->get('user_id')){
      $event_id = $request->event_id;
      $heat_id = $request->heat_id;
      $heat_details = DB::select('select * from eventheats where HeatId=? and EventId=?',[$heat_id,$event_id]);
      return view('editheat',['event_id'=>$event_id,'heat_id'=>$heat_id,'heat_details'=>$heat_details]);
    }
    else{
      $request->session()->flash('message.level','danger');
      $request->session()->flash('message.content','Passwords didnot match. Please,Try again..');
      return redirect('login');
    }
  }

  public function deleteHeat(Request $request){
    $userid = $request->session()->get('user_id');
  	 $event_id = $request->event_id;
      $heat_id = $request->heat_id;
       $heat_details = DB::select('select * from eventheats where HeatId=? and EventId=?',[$heat_id,$event_id]);
         $delete_heat = DB::update('update eventheats set IsDeleted = "Yes" where HeatId = ? and EventId=?',[$heat_id,$event_id]);
            if($delete_heat){
                $request->session()->flash('message.level', 'info');
                $request->session()->flash('message.content', 'Heat Details Deleted Sucessfully');
                return redirect('heatsetup/'.$event_id);
            }
        }	
    public function AddVenue(Request $request){
		if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
			$userid = $request->session()->get('user_id');
			 return view('addvenue');
      
		}
		else{
                        $request->session()->put('loginredirection', '/addvenue');
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','Login As Venue Admin to Add Venue');
  			return redirect('/');
  		}
	}
	public function information(Request $request) {
		return view('venueinformation');
	}
	public function saveVenue(Request $request){
		$venue_name = $request->venue_name;
		$description = $request->description;
		$shortname = $request->short_name;
		$file_image = $request->venue_file;
		$venue_id = $request->id;
		$user_id = $request->session()->get('user_id');
		$basic_venue = DB::table('venue')->insertGetId(array('VenueName' => $venue_name,'Description' => $description,'AddressId' => 0,'Phone' => 'NA', 'Phone2' => 'NA','Mobile'=>'NA','Email' => 'NA', 'Website' => 'NA', 'Website2' => 'NA', 'Facebook' => 'NA','Twitter' => 'NA', 'GooglePlus' => 'NA','Others'=>'NA','Shower'=>'NA','Gym'=>'NA','Teachers'=>'NA','ParaSwimmingFacilities'=>'NA','LadiesOnlySwimming'=>'NA','LadiesOnlySwimTimes'=>'NA', 'Toilets' => 'NA','Diving'=>'NA','PrivateHire'=>'NA','VisitingGallery'=>'NA','Parking'=>'NA','SwimForKids'=>'NA','VenueOwner'=>$user_id,'ShortName'=>$shortname));
		if($basic_venue){
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
            $venue_image = DB::table('images')->insertGetId(array('ImagePath'=>$bimage,'ImageRefType'=>'Venue','ReferenceId'=>$basic_venue));        
             		$request->session()->flash('message.level', 'success');
            		$request->session()->flash('message.content', 'Basic Venu Details Added Sucessfully...');
            		return redirect('venuepool/'.$basic_venue);

		}
		else{
			$request->session()->flash('message.level', 'failed');
            $request->session()->flash('message.content', 'Venue not added.Please, Try again..');
            return view('addvenue');
		}
	}

	public function VenuePool(Request $request){
		if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
			$userid = $request->session()->get('user_id');
			$venue_id = $request->id;
			return view('venuepool',['venue_id'=>$venue_id]);
		}
		else{
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','Login As Venue Admin to Add Venue');
  			return redirect('/');
  		}

	}
	public function saveVenuePool(Request $request){
    $pool_name = $request->pool_name;
    $pool_width = $request->pool_width;
    $width_dimension = $request->width_dimension;
    $pool_length = $request->pool_length;
    $length_dimension = $request->length_dimension;
    $shallow_end = $request->shallow_end;
    $shallow_dimension = $request->shallow_dimension;
    $deep_end = $request->deep_end;
    $deep_dimension = $request->deep_dimension;
    $pool_area = $request->pool_area;
    $area_dimension = $request->area_dimension;
    $description = $request->description;

    $width = $pool_width." ".$width_dimension;
    $length = $pool_length." ".$length_dimension;
    $shallow = $shallow_end." ".$shallow_dimension;
    $deep = $deep_end." ".$deep_dimension;
    $area = $pool_area." ".$area_dimension;
    $venue_id = $request->id;
    $pool_details = DB::table('pools')->insertGetId(array('PoolName'=>$pool_name, 'VenueId'=>$venue_id,'Length'=>$length,'Width'=>$width,'MinimumDepth'=>$deep,'MaximumDepth'=>$shallow,'Area'=>$area,'SpecialRequirements'=>$description));
    if($pool_details){
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
            $images = DB::insert('insert into images (ImagePath,ImageRefType,ReferenceId) values(?,?,?)',[$bimage,'Venue Pool',$pool_details]);    
            }
            else {
            $bimage = "NA";
            }
      $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Pool Information Added [Scroll down to see previous entries], You can add another pool or <a href="'.url('venueaddress/'.$venue_id).'">clickhere to continue</a>...');
            return redirect('venuepool/'.$venue_id);
    }
    else{
      $request->session()->flash('message.level', 'failed');
            $request->session()->flash('message.content', 'Venue Pool Information not added.Please, Try again..');
            return view('addvenue');
    }
  }

  public function VenueAddress(Request $request){
    if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
      $userid = $request->session()->get('user_id');
      $venue_id = $request->id;
       
        return view('venueaddress',['venue_id'=>$venue_id]);
       
    }
    else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Login As Venue Admin to Add Venue');
        return redirect('/');
      }
  }
        public function saveVenueAddress(Request $request){
    $address = $request->address;
    $city = $request->city;
    $post_code = $request->post_code;
    $town = $request->town;
    $country = $request->country;
    $venue_id = $request->id;
    $user_id = $request->session()->get('user_id');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?address='.$post_code.'&sensor=false&key=AIzaSyDRnlh876O-brSi9sYLbnDvqiIxgVsR7x8');
    $result = curl_exec($ch);
    curl_close($ch);

    $obj = json_decode($result,true);
    $location = $obj['results'][0]['address_components'][0]['long_name'];
    $lat = $obj['results'][0]['geometry']['location']['lat'];
    $lng = $obj['results'][0]['geometry']['location']['lng'];
    $venue_address = DB::table('address')->insertGetId(array('AddressLine1'=>$address,'AddressLine2'=>'NA','AddressLine3'=>'NA','City'=>$city,'Country'=>$country,'County'=>$town,'Council'=>'NA','PostCode'=>$post_code,'Latitude'=>$lat,'Longitude'=>$lng));
    if($venue_address){
      $update_venue = DB::update('update venue set AddressId=? where VenueId=?',[$venue_address,$venue_id]);
        $request->session()->flash('message.level', 'success');
              $request->session()->flash('message.content', 'Venue Address Added Sucessfully');
              return redirect('venuecontact/'.$venue_id);
             
    }
         else {
                  $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Unable to save details..');
        return redirect('venueaddress/'.$venue_id);  
                }
  }
    public function VenueContact(Request $request){
    if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
      $userid = $request->session()->get('user_id');
      $venue_id = $request->id;
       
        return view('venuecontact',['venue_id'=>$venue_id]);
       
    }
    else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Login As Venue Admin to Add Venue');
        return redirect('/');
      }
  }
  public function saveVenueContact(Request $request){
    echo "string";
    $contact = $request->contact;
    $mobile = $request->mobile;
    $email = $request->email;
    $venue_id = $request->id;
    $user_id = $request->session()->get('user_id');
      $venue_contact = DB::table('contacts')->insertGetId(array('FirstName'=>$contact,'Email'=>$email,'Phone'=>$mobile));
      if($venue_contact){
        $bridge_venuecontact = DB::table('bridgevenuecontact')->insertGetId(array('VenueId'=>$venue_id,'ContactId'=>$venue_contact,'CreatedBy'=>$user_id));
        $request->session()->flash('message.level', 'success');
              $request->session()->flash('message.content', 'Venue Address Added [scroll down to view previous entries], You can add another address or <a href="'.url('venuetimings/'.$venue_id).'">clickhere to continue</a>...');
              return redirect('venuecontact/'.$venue_id);
      }
      else {
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Unable to save details..');
        return redirect('venuecontact/'.$venue_id);  
      }
  }

  public function VenueTimings(Request $request){
  if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
      $userid = $request->session()->get('user_id');
      $venue_id = $request->id;
            if(count(DB::select('select DaysOpenId from daysopen where TableType=? and TypeId=?',['venue',$venue_id]))>0) {
                return redirect('venuesociallinks/'.$venue_id); 
            } else {
              return view('venuetimings',['venue_id'=>$venue_id]);  
                  
            }
                }
    else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Login As Venue Admin to Add Venue');
        return redirect('/');
      }

  }
  public function saveVenueTimings(Request $request){
    $day_one = $request->day_one;
    $day_two = $request->day_two;
    $day_three = $request->day_three;
    $day_four = $request->day_four;
    $day_five = $request->day_five;
    $day_six = $request->day_six;
    $day_seven = $request->day_seven;
    $para_swimming = $request->para_swimming;
    $showers = $request->shower;
    $gyms = $request->gym;
    $ladies = $request->ladies;
    $parking = $request->parking;
    $instructors = $request->instructor;
    $diving = $request->diving;
    $swim_kids = $request->swim_kids;
    $visit_gallery = $request->visit_gallery;
    $toilets = $request->toilet;
    $privatehire = $request->privatehire;
    $venue_id = $request->id;
    if($para_swimming=="yes"){$para_swimm = "yes";} else{$para_swimm = "no";}
    if($showers=="yes"){$shower = "yes";} else{$shower = "no";}
    if($gyms=="yes"){$gym = "yes";} else{$gym = "no";}  
    if($ladies=="yes"){$lady = "yes";} else{$lady = "no";}
    if($parking=="yes"){$park = "yes";} else{$park = "no";} 
    if($instructors=="yes"){$instructor = "yes";} else{$instructor = "no";} 
    if($diving=="yes"){$dive = "yes";} else{$dive = "no";}  
    if($swim_kids=="yes"){$swim_kid = "yes";} else{$swim_kid = "no";}
    if($visit_gallery=="yes"){$gallery = "yes";} else{$gallery = "no";} 
    if($toilets=="yes"){$toilet = "yes";} else{$toilet = "no";}
    if($privatehire=="yes"){$hire = "yes";} else{$hire = "no";}
    $venue_facilities = DB::table('venue')->where('VenueId',$venue_id)->update(['ParaSwimmingFacilities'=>$para_swimm,'Shower'=>$shower,'Gym'=>$gym,'LadiesOnlySwimming'=>$lady,'Parking'=>$park,'Teachers'=>$instructor,'Diving'=>$dive,'SwimForKids'=>$swim_kid,'VisitingGallery'=>$gallery,'Toilets'=>$toilet,'PrivateHire'=>$hire]);
    if(count($day_one)==3){
      $insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'venue','TypeId'=>$venue_id,'Day'=>$day_one[0],'Open/Closed'=>'Open','OpeningHours'=>$day_one[1],'ClosingHours'=>$day_one[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
    }
    if(count($day_two)==3){
      $insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'venue','TypeId'=>$venue_id,'Day'=>$day_two[0],'Open/Closed'=>'Open','OpeningHours'=>$day_two[1],'ClosingHours'=>$day_two[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
    }     
      if(count($day_three)==3){
      $insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'venue','TypeId'=>$venue_id,'Day'=>$day_three[0],'Open/Closed'=>'Open','OpeningHours'=>$day_three[1],'ClosingHours'=>$day_three[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
    }
    if(count($day_four)==3){
      $insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'venue','TypeId'=>$venue_id,'Day'=>$day_four[0],'Open/Closed'=>'Open','OpeningHours'=>$day_four[1],'ClosingHours'=>$day_four[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
    }
    if(count($day_five)==3){
      $insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'venue','TypeId'=>$venue_id,'Day'=>$day_five[0],'Open/Closed'=>'Open','OpeningHours'=>$day_five[1],'ClosingHours'=>$day_five[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
    }
    if(count($day_six)==3){
      $insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'venue','TypeId'=>$venue_id,'Day'=>$day_six[0],'Open/Closed'=>'Open','OpeningHours'=>$day_six[1],'ClosingHours'=>$day_six[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
    }
    if(count($day_seven)==3){
      $insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'venue','TypeId'=>$venue_id,'Day'=>$day_seven[0],'Open/Closed'=>'Open','OpeningHours'=>$day_seven[1],'ClosingHours'=>$day_seven[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
      
    }
      $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Venue Facilities Added Successfully');
      return redirect('venuesociallinks/'.$venue_id);
  }

	public function VenueSocialLinks(Request $request){
		if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
			$userid = $request->session()->get('user_id');
			$venue_id = $request->id;
				return view('venuesociallinks',['venue_id'=>$venue_id]);
		}
		else{
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','Login As Venue Admin to Add Venue');
  			return redirect('/');
  		}
	}
	public function saveVenueLinks(Request $request){
		$facebook = $request->facebook;
		$twitter = $request->twitter;
		$google = $request->google;
		$others = $request->others;
		$link1 = $request->link1;
		$link2 = $request->link2;
		$venue_id = $request->id;
		$update_venue = DB::table('venue')->where('VenueId',$venue_id)->update(['Facebook'=>$facebook,'Twitter'=>$twitter,'GooglePlus'=>$google,'Others'=>$others,'Website'=>$link1,'Website2'=>$link2]);
		if($update_venue){
			$venue_details = DB::select('select * from venue where VenueId=?',[$venue_id]);
			if($venue_details){
				$pool_details = DB::select('select PoolName,Length,Width,MinimumDepth,MaximumDepth,Area from pools where VenueId=?',[$venue_id]);
				$request->session()->flash('message.level', 'success');
            	$request->session()->flash('message.content', 'Venue Address Added Successfully...');
            	return redirect('confirmvenue/'.$venue_id);
            }
		}
		else{
				$request->session()->flash('message.level', 'danger');
            	$request->session()->flash('message.content', 'Venue Social Links not Added.Please, Try again.');
            	return view('venuesociallinks',['venue_id'=>$venue_id]);
		}
	}

	public function ConfirmVenue(Request $request){
	   if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
      $userid = $request->session()->get('user_id');
      $venue_id = $request->id;
			$pool_details = DB::select('select PoolName,Length,Width,MinimumDepth,MaximumDepth,Area,SpecialRequirements from pools where VenueId=?',[$venue_id]);
			$venue_address = DB::select('select a.AddressId,a.AddressLine1,a.City,a.Country,a.County,a.PostCode from address a INNER JOIN venue v where v.VenueId=? and a.AddressId=v.AddressId',[$venue_id]);
			$venue_contact = DB::select('select b.VenueId,b.ContactId,c.ContactId,c.FirstName,c.Email,c.Phone from contacts c INNER JOIN bridgevenuecontact b where c.ContactId=b.ContactId and b.VenueId=?',[$venue_id]);
			$timings = DB::select('select Day,OpeningHours,ClosingHours from daysopen where TypeId=? and TableType="venue"',[$venue_id]);
      $venue_facilities = DB::select('select * from venue where VenueId=?',[$venue_id]);
			$request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Venue Information Added Successfully...');
    return view('confirmvenue',['venue_id'=>$venue_id,'pool_details'=>$pool_details,'venue_address'=>$venue_address,'venue_contact'=>$venue_contact,'timings'=>$timings,'facilities'=>$venue_facilities]);
         }
    else{
      $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Login As Venue Admin to Add Venue');
        return redirect('/');
    }
     
	}
	public function saveConfirmVenue(Request $request){
                $userid = $request->session()->get('user_id');
		$venue_id = $request->id;
                $venue = DB::select('select VenueName from venue where VenueId = ?',[$venue_id]);
                $venue_name = $venue[0]->VenueName;
		$pool_details = DB::select('select PoolName,Length,Width,MinimumDepth,MaximumDepth,Area,SpecialRequirements from pools where VenueId=?',[$venue_id]);
		$venue_address = DB::select('select a.AddressId,a.AddressLine1,a.City,a.Country,a.County,a.PostCode from address a INNER JOIN venue v where v.VenueId=? and a.AddressId=v.AddressId',[$venue_id]);
		$venue_contact = DB::select('select b.VenueId,b.ContactId,c.ContactId,c.FirstName,c.Email,c.Phone from contacts c INNER JOIN bridgevenuecontact b where c.ContactId=b.ContactId and b.VenueId=?',[$venue_id]);
		$timings = DB::select('select Day,OpeningHours,ClosingHours from daysopen where TypeId=? and TableType="venue"',[$venue_id]);
                $venue_details = DB::Select('select VenueName from venue where VenueId=?',[$venue_id]);
                $venue_name = $venue_details[0]->VenueName;
      $favourite_venue =  DB::insert('insert into favourites(Flag,UserId,FavouriteType,Attribute) values (?,?,?,?)',['Yes',$userid,'venue',$venue_id]);
       $total_favourites = DB::select('select count(FavouriteId) as count from favourites where UserId=? and FavouriteType=? and Attribute=? and Flag=?',[$userid,'venue',$venue_id,'Yes']);
       DB::update('update address set favCount=? where AddressId=?',[$total_favourites[0]->count,$venue_address[0]->AddressId]);
                DB::insert("insert into notifications(ReceiverId,Notification,NotificationType,IsRead) values (?,?,?,?)",[$userid,$venue_name." Created Successfully, <a href=".url('/editvenue/'.$venue_id)." style='color: #3c763d'>Click Here</a> to edit your venue and ignore if you are not intrested.",1,0]);
		$request->session()->flash('message.level','success');
  		$request->session()->flash('message.content','Venue Information Added Successfully...');
                
		return redirect('confirmvenue/'.$venue_id);
                    }

public function editVenue(Request $request){
		if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
			$userid = $request->session()->get('user_id');
			$venue_id = $request->id;
			$venue_details = DB::select('select VenueId,VenueName,Description,ShortName from venue where VenueId=?',[$venue_id]);
			if($venue_details){
				return view('editvenue',['venue_details'=>$venue_details,'venue_id'=>$venue_id]);
			}
			else{
                          $request->session()->put('loginredirection', '/addvenue');
                            $request->session()->flash('message.level','danger');
  				$request->session()->flash('message.content','Venue doesnot exist. Please, Add Venue details');
  				return view('addvenue');
			}
		}
		else{
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','Login As Venue Admin to Add Venue');
  			return redirect('/');
  		}
	}
	public function saveEditVenue(Request $request){
		$venue_name = $request->venue_name;
		$description = $request->description;
		$shortname = $request->short_name;
		$file_image = $request->venue_file;
		$venue_id = $request->id;
		 $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = 20;
        $image_details = DB::select('select ImageId from images where ImageRefType=? and ReferenceId=?',['Venue',$venue_id]);
		$venue_details = DB::select('select VenueId,VenueName,Description,ShortName from venue where VenueId=?',[$venue_id]);
		$update_venue = DB::table('venue')->where('VenueId',$venue_id)->update(['VenueName'=>$venue_name,'Description'=>$description,'ShortName'=>$shortname]);
		if(Input::hasFile('image')){
            $file = Input::file('image');
            $randomString = '';
            for ($i = 0; $i < 20; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $file->move('./public/images', $randomString.".png");
            $image = url("public/images/".$randomString.".png");
            $image_insert = DB::update('update images set ImagePath=? where ImageId=?',[$image,$image_details[0]->ImageId]);
            if($image_insert){
            	$request->session()->flash('message.level','success');
  			$request->session()->flash('message.content','Basic Venue Details Updates Successfully');
  			return redirect('editvenue/'.$venue_id);
            }
        }
        else {
            $image = "NA";
        }
		if($update_venue){
			$request->session()->flash('message.level','success');
  			$request->session()->flash('message.content','Basic Venue Details Updates Successfully');
  			return redirect('editvenue/'.$venue_id);
		}
		else{
			$request->session()->flash('message.level','info');
  			$request->session()->flash('message.content','No changes made to Basic Venue Details');
  			return view('editvenue',['venue_details'=>$venue_details,'venue_id'=>$venue_id]);
		}
	}
        
        public function checkPool(Request $request) {
            if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
			$userid = $request->session()->get('user_id');
			$venue_id = $request->id;
			$pool_details = DB::select('select PoolId,PoolName,Length,Width,MinimumDepth,MaximumDepth,Area,SpecialRequirements from pools where VenueId=?',[$venue_id]);
			if(count($pool_details)>0){
			return redirect('edit-venuepool/'.$venue_id.'/'.$pool_details[0]->PoolId);
			}
			else{
				$request->session()->flash('message.level','danger');
  				$request->session()->flash('message.content','Pool doesnot exist. Please add poolinformation');
  				return redirect('venuepool/'.$venue_id);
			}
			}
		else{
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','Login As Venue Admin to Add Venue');
  			return redirect('/');
  		}
        }

	public function editPool(Request $request){
if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
			$userid = $request->session()->get('user_id');
			$poolid = $request->id;
            $venue_id = $request->venue_id;
			$pool_details = DB::select('select PoolName,Length,Width,MinimumDepth,MaximumDepth,Area,SpecialRequirements from pools where PoolId=? and VenueId=?',[$poolid,$venue_id]);
			if($pool_details){
			return view('editvenuepool',['venue_id'=>$venue_id,'poolid'=>$poolid,'pool_details'=>$pool_details]);
			}
			else{
				$request->session()->flash('message.level','danger');
  				$request->session()->flash('message.content','Pool doesnot exist. Please add Venue');
  				return view('addvenue');
			}
		}
		else{
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','Login As Venue Admin to Add Venue');
  			return redirect('/');
  		}
	}
	public function saveEditPool(Request $request){
		$pool_name = $request->pool_name;
		$description = $request->description;
		$width =$request->pool_width;
		$length = $request->pool_length;
		$shallow =  $request->shallow_end;
		$deep = $request->deep_end;
		$area = $request->pool_area;
		$venue_id = $request->venue_id;
        $poolid = $request->id;
		$pool_details = DB::select('select PoolName,Length,Width,MinimumDepth,MaximumDepth,Area,SpecialRequirements from pools where VenueId=?',[$venue_id]);
		$update_pool = DB::table('pools')->where(['PoolId'=>$poolid,'VenueId'=>$venue_id])->update(['PoolName'=>$pool_name,'Length'=>$length,'Width'=>$width,'MinimumDepth'=>$shallow,'MaximumDepth'=>$deep,'Area'=>$area,'SpecialRequirements'=>$description]);
		if($update_pool){
			$request->session()->flash('message.level','success');
  			$request->session()->flash('message.content','Basic Venue Details Updates Successfully');
  			return redirect('edit-venuepool/'.$venue_id.'/'.$poolid);
		}
		else{
			$request->session()->flash('message.level','info');
  			$request->session()->flash('message.content','No changes made to Venue Pool Details');
  			return redirect('edit-venuepool/'.$venue_id.'/'.$poolid);
		}
	}

	 public function checkAddress(Request $request) {
            if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
			$userid = $request->session()->get('user_id');
			$venue_id = $request->venue_id;
			$venue_contact = DB::select('select * FROM contacts join bridgevenuecontact on contacts.ContactId=bridgevenuecontact.ContactId and bridgevenuecontact.VenueId=?',[$venue_id]);
			if(count($venue_contact)>0){
			return redirect('edit-venueaddress/'.$venue_id.'/'.$venue_contact[0]->ContactId);
			}
			else{
				$request->session()->flash('message.level','danger');
  				$request->session()->flash('message.content','Please add Address information');
  				return redirect('venueaddress/'.$venue_id);
			}
			}
		else{
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','Login As Venue Admin to Add Venue');
  			return redirect('/');
  		}
        }
        
	public function editVenueAddress(Request $request){
    if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
      $userid = $request->session()->get('user_id');
      $venue_id = $request->venue_id;
      $venue_address = DB::select('select a.AddressId,a.AddressLine1,a.City,a.Country,a.County,a.PostCode,v.Phone,v.Mobile,v.Email from address a INNER JOIN venue v ON a.AddressId=v.AddressId where v.VenueId=?',[$venue_id]);
      return view('editvenueaddress',['venue_id'=>$venue_id,'addressid'=>$venue_address[0]->AddressId,'venue_address'=>$venue_address]);
    }
    else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Login As Venue Admin to Add Venue');
        return redirect('/');
      }
  }
  public function saveEditAddress(Request $request){
    $user_id = $request->session()->get('user_id');
    $address = $request->address;
    $city = $request->city;
    $post_code = $request->post_code;
    $town = $request->town;
    $country = $request->country;
    $address_id = $request->address_id;
    $venue_id = $request->venue_id;
     $update_venue_address = DB::table('address')->where('AddressId',$address_id)->update(['AddressLine1'=>$address,'City'=>$city,'PostCode'=>$post_code,'County'=>$town,'Country'=>$country]);
      if($update_venue_address){
        $request->session()->flash('message.level','success');
          $request->session()->flash('message.content','Venue Address Updated Sucessfully');
          return redirect('edit-venueaddress/'.$venue_id);
      }
      else{
        $request->session()->flash('message.level','info');
        $request->session()->flash('message.content','No changes made.Please Try again');
        return redirect('edit-venueaddress/'.$venue_id);
      }

  }

  public function editVenueContact(Request $request){
    if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
      $userid = $request->session()->get('user_id');
      $venue_id = $request->venue_id;
            $contact_id = $request->id;
      $contacts = DB::select("select * FROM contacts where ContactId=?",[$contact_id]);
      return view('editvenuecontact',['venue_id'=>$venue_id,'contacts'=>$contacts,'contact_id'=>$contact_id]);
    }
    else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Login As Venue Admin to Add Venue');
        return redirect('/');
      }
  }
  public function saveEditContact(Request $request){
    $user_id = $request->session()->get('user_id');
    $contact_id = $request->id;
    $contact_name = $request->contact_name;
    $mobile = $request->mobile;
    $email = $request->email;
    $venue_id = $request->venue_id;
    $address_id = $request->address_id;
    $new_contact = $request->new_contact;
    $new_mobile = $request->new_mobile;
    $new_email = $request->new_email;
    if($new_contact!=''){
      $venue_contact = DB::table('contacts')->insertGetId(array('FirstName'=>$new_contact,'Email'=>$new_email,'Phone'=>$new_mobile));
      $bridge_venuecontact = DB::table('bridgevenuecontact')->insertGetId(array('VenueId'=>$venue_id,'ContactId'=>$venue_contact,'CreatedBy'=>$user_id));
      $request->session()->flash('message.level','success');
        $request->session()->flash('message.content','Contact Details Added Successfully');
        return redirect('edit-venuecontact/'.$venue_id.'/'.$contact_id);
    }
    else{
    $update_contacts = DB::table('contacts')->where('ContactId',$contact_id)->update(['FirstName'=>$contact_name,'Phone'=>$mobile,'Email'=>$email]);
      if($update_contacts){
        $request->session()->flash('message.level','success');
          $request->session()->flash('message.content','Venue Address Updated Sucessfully');
          return redirect('edit-venuecontact/'.$venue_id.'/'.$contact_id);
      }
      else{
        $request->session()->flash('message.level','info');
        $request->session()->flash('message.content','No changes made.Please Try again');
        return redirect('edit-venuecontact/'.$venue_id.'/'.$contact_id);
      }
    }

  }

	public function editVenueTiming(Request $request){
		if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
			$userid = $request->session()->get('user_id');
			$venue_id = $request->id;
			$venue_facility = DB::select('select ParaSwimmingFacilities,Shower,Gym,LadiesOnlySwimming,Parking,Teachers,Diving,SwimForKids,VisitingGallery,Toilets,PrivateHire from venue where VenueId=?',[$venue_id]);
			$request->session()->flash('message.level','info');
  			$request->session()->flash('message.content','Venue Timings already Added. Update changes if required');
			return view('editvenuetimings',['venue_id'=>$venue_id,'venue_facility'=>$venue_facility]);
		}
		else{
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','Login As Venue Admin to Add Venue');
  			return redirect('/');
  		}
	}
	public function saveEditTiming(Request $request){
		$day_one = $request->day_one;
		$day_two = $request->day_two;
 		$day_three = $request->day_three;
 		$day_four = $request->day_four;
		$day_five = $request->day_five;
 		$day_six = $request->day_six;
 		$day_seven = $request->day_seven;
		$para_swimming = $request->para_swimming;
		$showers = $request->shower;
		$gyms = $request->gym;
		$ladies = $request->ladies;
		$parking = $request->parking;
		$instructors = $request->instructor;
		$diving = $request->diving;
		$swim_kids = $request->swim_kids;
		$visit_gallery = $request->visit_gallery;
		$toilets = $request->toilet;
		$privatehire = $request->privatehire;
		$venue_id = $request->id;

		$venue_facility = DB::select('select ParaSwimmingFacilities,Shower,Gym,LadiesOnlySwimming,Parking,Teachers,Diving,SwimForKids,VisitingGallery,Toilets,PrivateHire from venue where VenueId=?',[$venue_id]);
		if($para_swimming=="on"){$para_swimm = "yes";} else{$para_swimm = "no";}
 		if($showers=="on"){$shower = "yes";} else{$shower = "no";}
 		if($gyms=="on"){$gym = "yes";} else{$gym = "no";}
 		if($ladies=="on"){$lady = "yes";} else{$lady = "no";}
 		if($parking=="on"){$park = "yes";} else{$park = "no";}
 		if($instructors=="on"){$instructor = "yes";} else{$instructor = "no";}
 		if($diving=="on"){$dive = "yes";} else{$dive = "no";}
 		if($swim_kids=="on"){$swim_kid = "yes";} else{$swim_kid = "no";}
 		if($visit_gallery=="on"){$gallery = "yes";} else{$gallery = "no";}
 		if($toilets=="on"){$toilet = "yes";} else{$toilet = "no";}
 		if($privatehire=="on"){$hire = "yes";} else{$hire = "no";}
 		if(count($day_one)==3){
 			$remove_oldtimings = DB::delete('delete from daysopen where TableType=? and TypeId=? and Day=?',['venue',$venue_id,'Monday']);
 			$insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'venue','TypeId'=>$venue_id,'Day'=>$day_one[0],'Open/Closed'=>'Open','OpeningHours'=>$day_one[1],'ClosingHours'=>$day_one[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
 		}
 		if(count($day_two)==3){
 			$remove_oldtimings = DB::delete('delete from daysopen where TableType=? and TypeId=? and Day=?',['venue',$venue_id,'Tuesday']);
 			$insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'venue','TypeId'=>$venue_id,'Day'=>$day_two[0],'Open/Closed'=>'Open','OpeningHours'=>$day_two[1],'ClosingHours'=>$day_two[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
 		} 		
 	    if(count($day_three)==3){
 	    	$remove_oldtimings = DB::delete('delete from daysopen where TableType=? and TypeId=? and Day=?',['venue',$venue_id,'Wednesday']);
 			$insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'venue','TypeId'=>$venue_id,'Day'=>$day_three[0],'Open/Closed'=>'Open','OpeningHours'=>$day_three[1],'ClosingHours'=>$day_three[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
 		}
 		if(count($day_four)==3){
 			$remove_oldtimings = DB::delete('delete from daysopen where TableType=? and TypeId=? and Day=?',['venue',$venue_id,'Thursday']);
 			$insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'venue','TypeId'=>$venue_id,'Day'=>$day_four[0],'Open/Closed'=>'Open','OpeningHours'=>$day_four[1],'ClosingHours'=>$day_four[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
 		}
 		if(count($day_five)==3){
 			$remove_oldtimings = DB::delete('delete from daysopen where TableType=? and TypeId=? and Day=?',['venue',$venue_id,'Friday']);
 			$insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'venue','TypeId'=>$venue_id,'Day'=>$day_five[0],'Open/Closed'=>'Open','OpeningHours'=>$day_five[1],'ClosingHours'=>$day_five[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
 		}
 		if(count($day_six)==3){
 			$remove_oldtimings = DB::delete('delete from daysopen where TableType=? and TypeId=? and Day=?',['venue',$venue_id,'Saturday']);
 			$insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'venue','TypeId'=>$venue_id,'Day'=>$day_six[0],'Open/Closed'=>'Open','OpeningHours'=>$day_six[1],'ClosingHours'=>$day_six[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
 		}
 		if(count($day_seven)==3){
 			$remove_oldtimings = DB::delete('delete from daysopen where TableType=? and TypeId=? and Day=?',['venue',$venue_id,'Sunday']);
 			$insert_days = DB::table('daysopen')->insertGetId(array('TableType'=>'venue','TypeId'=>$venue_id,'Day'=>$day_seven[0],'Open/Closed'=>'Open','OpeningHours'=>$day_seven[1],'ClosingHours'=>$day_seven[2],'LunchHours'=>'NA','ReasonForClosure'=>'NA'));
 			
 		}
 		$venue_facilities = DB::table('venue')->where('VenueId',$venue_id)->update(['ParaSwimmingFacilities'=>$para_swimm,'Shower'=>$shower,'Gym'=>$gym,'LadiesOnlySwimming'=>$lady,'Parking'=>$park,'Teachers'=>$instructor,'Diving'=>$dive,'SwimForKids'=>$swim_kid,'VisitingGallery'=>$gallery,'Toilets'=>$toilet,'PrivateHire'=>$hire]);
		if($venue_facilities || $insert_days){
			$request->session()->flash('message.level','info');
  			$request->session()->flash('message.content','Venue Timings updated Successfully');
			return view('editvenuetimings',['venue_id'=>$venue_id,'venue_facility'=>$venue_facility]);
		}
		else{
			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','No changes made to venue Timings');
  			return view('editvenuetimings',['venue_id'=>$venue_id,'venue_facility'=>$venue_facility]);
		}
	}

	public function editSocialLinks(Request $request){
		if($request->session()->has('user_id') && $request->session()->get('user_type')=="venue"){
			$userid = $request->session()->get('user_id');
			$venue_id = $request->id;
			$check_links = DB::select('select Facebook,Twitter,GooglePlus,Others,Website,Website2 from venue where VenueId=?',[$venue_id]);
				$request->session()->flash('message.level','info');
  				$request->session()->flash('message.content','Social Links already Added.Update changes if Required..');
				return view('editvenuesociallinks',['venue_id'=>$venue_id,'check_links'=>$check_links]);
		}
		else{
  			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','Login As Venue Admin to Add Venue');
  			return redirect('/');
  		}
	}
	public function saveEditLinks(Request $request){
		$facebook = $request->facebook;
		$twitter = $request->twitter;
		$google = $request->google;
		$others = $request->others;
		$link1 = $request->link1;
		$link2 = $request->link2;
		$venue_id = $request->id;
		$update_links = DB::table('venue')->where('VenueId',$venue_id)->update(['Facebook'=>$facebook,'Twitter'=>$twitter,'GooglePlus'=>$google,'Others'=>$others,'Website'=>$link1,'Website2'=>$link2]);
		$check_links = DB::select('select Facebook,Twitter,GooglePlus,Others,Website,Website2 from venue where VenueId=?',[$venue_id]);
		if($update_links){
			$request->session()->flash('message.level','success');
  			$request->session()->flash('message.content','Venue Social Links Updates Successfully');
  			return view('editvenuesociallinks',['venue_id'=>$venue_id,'check_links'=>$check_links]);
		}
		else{
			$request->session()->flash('message.level','danger');
  			$request->session()->flash('message.content','No Changes made to Venue Social Links');
  			return view('editvenuesociallinks',['venue_id'=>$venue_id,'check_links'=>$check_links]);
		}
	}
        
        public function getOldEntries(Request $request) {
        $type = $request->type;
        $id = $request->id;
        
        if($type == "poolinfo") {
            $pools = DB::select("select PoolId,PoolName from pools where VenueId=?",[$id]);
            if(count($pools) > 0) {
                echo '<h5 class="add_venue"><a href="#"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button></a> Previous Entries</h5>';
                echo '<div class="row" style="border:1px solid #eee">';
                echo "<table class='table table-striped'>";
                echo "<tr><td>PoolName</td><td>Edit</td><td>Delete</td></tr>";
                foreach($pools as $pool) {
                    echo "<tr><td>".$pool->PoolName."</td><td><a href=".url('/edit-venuepool/'.$id.'/'.$pool->PoolId)." style='color:black'>Edit</a></td><td><a href=".url('/deletepool/'.$id.'/'.$pool->PoolId)." style='color:black'> Delete</a></td></tr>";
                }
                echo "</table>";
                echo '</div>';
            } else {
                echo "no";
            }
        }
        if($type == "address") {
            $contacts = DB::select("select contacts.ContactId,contacts.Phone,contacts.FirstName,contacts.Email FROM contacts join bridgevenuecontact on contacts.ContactId=bridgevenuecontact.ContactId and bridgevenuecontact.VenueId=?",[$id]);
            if(count($contacts) > 0) {
                echo '<h5 class="add_venue"><a href="#"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button></a> Previous Entries</h5>';
                echo '<div class="row" style="border:1px solid #eee">';
                echo "<table class='table table-striped'>";
                echo "<tr><td>Contact Name</td><td>Mobile</td><td>Email</td><td>Edit</td><td>Delete</td></tr>";
                foreach($contacts as $contact) {
                    echo "<tr><td>".$contact->FirstName."</td><td>".$contact->Phone."</td><td>".$contact->Email."</td><td><a href=".url('/edit-venueaddress/'.$id.'/'.$contact->ContactId)." style='color:black'>Edit</a></td><td><a href=".url('/delete-venuecontact/'.$id.'/'.$contact->ContactId)." style='color:black'>Delete</a></td></tr>";
                }
                echo "</table>";
                echo '</div>';
            } else {
                echo "no";
            }
        }
        if($type == "timings"){
        	$timings = DB::select('select * from daysopen where TypeId=?',[$id]);
        	if(count($timings)>0) {
        		echo '<h5 class="add_venue"><a href="#"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button></a> Previous Entries</h5>';
                echo '<div class="row" style="border:1px solid #eee">';
                echo "<table class='table table-striped'>";
                echo "<tr><td>Day</td><td>OpeningHours</td><td>ClosingHours</td></tr>";
                foreach($timings as $timing) {
                    echo "<tr><td>".$timing->Day."</td><td>".$timing->OpeningHours."</td><td>".$timing->ClosingHours."</td></tr>";
                }
                echo "</table>";
                echo '</div>';
        	}
        }
    }

    public function deleteContact(Request $request){
    	$venue_id = $request->venue_id;
    	$contact_id = $request->contact_id;
    	$remove_bridge = DB::delete('delete from bridgevenuecontact where VenueId=? and ContactId=?',[$venue_id,$contact_id]);
    	$remove_contact = DB::delete('delete from contacts where ContactId=?',[$contact_id]);
    	$request->session()->flash('message.level','success');
  		$request->session()->flash('message.content','Venue Contact Deleted Successfully');
    	return redirect('venueaddress/'.$venue_id);
    }
    public function deletepool(Request $request){
    	$venue_id = $request->venue_id;
    	$pool_id = $request->pool_id;
    	$remove_pool = DB::delete('delete from pools where PoolId=?',[$pool_id]);
    	$request->session()->flash('message.level','success');
  		$request->session()->flash('message.content','Pool Deleted Successfully');
    	return redirect('venuepool/'.$venue_id);
    }    
    
     public function manageVenues(Request $request){
   if($request->session()->has('user_id')){
     $userid = $request->session()->get('user_id');
      $venue_info = DB::table('venue')
       ->selectRaw('venue.VenueId,venue.VenueName,venue.Description,venue.Phone,venue.Phone2,venue.Website,venue.Email')
       ->where('venue.VenueOwner',[$userid])
       ->where('venue.IsDeleted',['no'])
         ->orderBy('venue.VenueId')
       ->paginate(4);
     return view('managevenues',['venues'=>$venue_info]);
   }
   else{
     $request->session()->flash('message.level','danger');
     $request->session()->flash('message.content','please login to continue...');
     return view('login');
   }
 }
 public function deleteVenue(Request $request){
       if($request->session()->has('user_id')){
           $user_id = $request->session()->get('user_id');
           $venue_id = $request->id;
           $venue = DB::select('select AddressId from venue where VenueId=?',[$venue_id]);
           $address_id = $venue[0]->AddressId;
            $remove_venue = DB::update('update venue set IsDeleted="yes" where VenueId=?',[$venue_id]);
           if($remove_venue){
               $request->session()->flash('message.level', 'info');
               $request->session()->flash('message.content', 'venue Deleted Sucessfully');
               return redirect('managevenues');
           }
       }
       else{
           $request->session()->flash('message.level', 'danger');
           $request->session()->flash('message.content', 'Please Login to continue....');
           return view('login');
       }
   }
   
   public function autocomplete(Request $request){
      $type = $request->type;
      if($type == "contact"){
      $contact = $request->contact;
      $tags = DB::select('select FirstName,Phone,Email from contacts where FirstName like "%'.$contact.'%"');
      if(count($tags)>0) {
        echo json_encode($tags);
      }
      }else{
        $address = $request->contact;
        $address_information = DB::select('select AddressLine1,City,County,Country,PostCode from address where AddressLine1 like "%'.$address.'%"');
        if(count($address_information)>0){
           echo json_encode($address_information);
        }
      }
  }
  
  public function venueshortname(Request $request){
    $shortname = $request->shortname;
       if(count(DB::select('select VenueId from venue where ShortName=?',[$shortname]))>0){
           echo "error";
       }
       else{
           echo "success";
       }
 }
 
}
