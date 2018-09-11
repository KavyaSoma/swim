<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use Mail;

class AdminController extends Controller
{
  public function admindashboard(Request $request) {
     if($request->session()->has('user_id')){
         $userid = $request->session()->get('user_id');
     $search_term = '';
     if($request->has('search_term')) {
       $search_term = $request->search_term;
      $user_details = DB::table('users')
      ->selectRaw('*, users.UserId,UserName,users.UserType,users.Email')
      ->where('IsDeleted',[0])
      ->where('UserName','like','%'.strtolower($search_term).'%')
      ->paginate(5);
  $pendingadd_requests = DB::select('select advertisements.*, images.* FROM advertisements JOIN images on advertisements.AdvertisementId=images.ReferenceId and advertisements.AdvertisementType="Advertisement" and images.ImageRefType="Admin News" and advertisements.Status ="Pending"');
$pendingpost_requests = DB::select('select advertisements.*, images.* FROM advertisements JOIN images on advertisements.AdvertisementId=images.ReferenceId and advertisements.AdvertisementType="News" and images.ImageRefType="Admin News" and advertisements.Status="Pending"');
$accepted_requests = DB::select('select advertisements.*, images.* FROM advertisements JOIN images on advertisements.AdvertisementId=images.ReferenceId and images.ImageRefType="Admin News"  and advertisements.Status !="Pending"');
      return view('admindashboard',['users'=>$user_details,'search_term'=>$search_term,'adds'=>$pendingadd_requests,'posts'=>$pendingpost_requests,'accept'=>$accepted_requests]);
     } else {
      $user_details = DB::table('users')
      ->selectRaw('*, users.UserId,UserName,users.UserType,users.Email')
      ->where('IsDeleted',[0])
      ->where('UserName','like','%'.strtolower($search_term).'%')
      ->paginate(5);
      $pendingadd_requests = DB::select('select advertisements.*, images.* FROM advertisements JOIN images on advertisements.AdvertisementId=images.ReferenceId and advertisements.AdvertisementType="Advertisement" and images.ImageRefType="Admin News" and advertisements.Status
         ="Pending"');
      $pendingpost_requests = DB::select('select advertisements.*, images.* FROM advertisements JOIN images on advertisements.AdvertisementId=images.ReferenceId and advertisements.AdvertisementType="News" and images.ImageRefType="Admin News" and advertisements.Status="Pending"');
       $accepted_requests = DB::select('select advertisements.*, images.* FROM advertisements JOIN images on advertisements.AdvertisementId=images.ReferenceId and images.ImageRefType="Admin News"  and advertisements.Status !="Pending"');
      return view('admindashboard',['users'=>$user_details,'search_term'=>$search_term,'adds'=>$pendingadd_requests,'posts'=>$pendingpost_requests,'accept'=>$accepted_requests]);
     }
     
     } else {

     $request->session()->flash('message.level','danger');
     $request->session()->flash('message.content','please login to continue...');
     return view('login');
   }
}

public function acceptadds(Request $request){
    $userid = $request->session()->get('user_id');
     $pendingadd_requests = DB::select('select advertisements.*, images.* FROM advertisements JOIN images on advertisements.AdvertisementId=images.ReferenceId and advertisements.AdvertisementType="Advertisement" and advertisements.Status = "Pending"');
     if(count($pendingadd_requests)){
      $acceptadd = DB::update('update advertisements set Status = "Accepted" where AdvertisementId = ?',[$request->id]);
     $request->session()->flash('message.level','info');
     $request->session()->flash('message.content','Request Accepted succesfully...');
       return redirect('admindashboard');
     }
     }
     
  public function rejectadds(Request $request){
       $userid = $request->session()->get('user_id');
     $pendingadd_requests = DB::select('select advertisements.*, images.* FROM advertisements JOIN images on advertisements.AdvertisementId=images.ReferenceId and advertisements.AdvertisementType="Advertisement" and advertisements.Status = "Pending"');
     if(count($pendingadd_requests)){
      $rejectadd = DB::update('update advertisements set Status = "Rejected" where AdvertisementId = ?',[$request->id]);
     $request->session()->flash('message.level','danger');
     $request->session()->flash('message.content','Request Rejected succesfully...');
       return redirect('admindashboard');
     }
   }

   public function acceptNews(Request $request){
      $userid = $request->session()->get('user_id');
       $pendingpost_requests = DB::select('select advertisements.*, images.* FROM advertisements JOIN images on advertisements.AdvertisementId=images.ReferenceId and advertisements.AdvertisementType="News" and advertisements.Status="Pending"');
       if(count($pendingpost_requests)){
         $acceptadd = DB::update('update advertisements set Status = "Accepted" where AdvertisementId = ?',[$request->id]);
     $request->session()->flash('message.level','info');
     $request->session()->flash('message.content','Request Accepted succesfully...');
       return redirect('admindashboard');
       }
     }

     public function rejectNews(Request $request){
        $userid = $request->session()->get('user_id');
       $pendingpost_requests = DB::select('select advertisements.*, images.* FROM advertisements JOIN images on advertisements.AdvertisementId=images.ReferenceId and advertisements.AdvertisementType="News" and advertisements.Status="Pending"');
       if(count($pendingpost_requests)){
         $rejectadd = DB::update('update advertisements set Status = "rejected" where AdvertisementId = ?',[$request->id]);
     $request->session()->flash('message.level','info');
     $request->session()->flash('message.content','Request Rejected succesfully...');
       return redirect('admindashboard');
       }
     } 

  public function postNews(Request $request){
  	if($request->session()->has('user_id')){
  		$user_id = $request->session()->get('user_id');
  		$post_details = DB::table('advertisements')
      ->selectRaw('*,AdvertisementId,Subject,Url,PublishDate,ExpireDate,Message,Status,AdvertisementType')
      ->where('advertisements.UserId','=',[$user_id])
      ->orderBy('advertisements.AdvertisementId')
      ->paginate(10);
  		return view('postnews',['news'=>$post_details]);
  	}
  	else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Passwords didnot match. Please,Try again..');
        return redirect('register');
    }
  }
 public function saveNews(Request $request){
     $user_id = $request->session()->get('user_id');
   $news_id = $request->news_id;
     $subject = $request->subject;
     $publish_date = $request->publish_date;
     $expire_date = $request->expire_date;
     $post_type = $request->post_type;
     $description = $request->description;
     $link = $request->link;
     $image = $request->image;
     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $charactersLength = 20;
     $post_details = DB::select('select AdvertisementId,Subject,Url,PublishDate,ExpireDate,Message,Status,AdvertisementType from advertisements where UserId=?',[$user_id]);
   if($news_id){
      $update_news = DB::table('advertisements')->where('AdvertisementId',$news_id)->update(array('AdvertisementType'=>$post_type,'Subject'=>$subject,'Url'=>$link,'Message'=>$description,'PublishDate'=>$publish_date,'ExpireDate'=>$expire_date));
     if($update_news){
       $request->session()->flash('message.level','success');
       $request->session()->flash('message.content','News/Advertisement Updated Successfully..');
       return redirect('postnews');
     }
     else{
       $request->session()->flash('message.level','danger');
       $request->session()->flash('message.content','Failed to Update or No changes made to News/Advertisement');
       return redirect('postnews');
     }
   }
   else{
   $add_post = DB::table('advertisements')->insertGetId(array('AdvertisementType'=>$post_type,'UserId'=>$user_id,'Subject'=>$subject,'Url'=>$link,'Message'=>$description,'ApproverId'=>0,'Status'=>'Pending','PublishDate'=>$publish_date,'ExpireDate'=>$expire_date));

     if($add_post){
         if(Input::hasFile('image')){
           $file = Input::file('image');
           $randomString = '';
           for ($i = 0; $i < 20; $i++) {
               $randomString .= $characters[rand(0, $charactersLength - 1)];
           }
           $file->move('./public/images/admin', $randomString.".png");
           $image = url("public/images/admin/".$randomString.".png");
           $image_insert = DB::table('images')->insertGetId(array('ImagePath'=>$image,'ImageRefType'=>'Admin News','ReferenceId'=>$add_post));
       }
       else {
           $image = "NA";
       }
         $request->session()->flash('message.level','success');
       $request->session()->flash('message.content','News/Advertisement Created Successfully..');
         return redirect('postnews');
     }
     else{
         $request->session()->flash('message.level','danger');
       $request->session()->flash('message.content','News not Saved.Please Try Again.');
         return view('postnews',['news'=>$post_details]);
     }
  }
 }
  public function editNews(Request $request){
  	if($request->session()->get('user_id')){
  		$user_id = $request->session()->get('user_id');
  		$news_id = $request->id;
  		$post_details = DB::select('select AdvertisementId,Subject,Url,PublishDate,ExpireDate,Message,Status,AdvertisementType from advertisements where UserId=?',[$user_id]);
  		$news_details = DB::select('select a.AdvertisementId,a.Subject,a.Url,a.PublishDate,a.ExpireDate,a.Message,a.Status,a.AdvertisementType,i.ImagePath from advertisements a INNER JOIN images i where a.UserId=? and i.ImageRefType=? and i.ReferenceId=?',[$user_id,'Admin News',$news_id]);
  		return view('editnews',['news'=>$post_details,'details'=>$news_details]);
  	}
  	else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Passwords didnot match. Please,Try again..');
        return redirect('register');
    }
  }
  public function saveEditNews(Request $request){
  	$user_id = $request->session()->get('user_id');
  	$subject = $request->subject;
  	$publish_date = $request->publish_date;
  	$expire_date = $request->expire_date;
  	$post_type = $request->post_type;
  	$description = $request->description;
  	$link = $request->link;
  	$image = $request->image;
  	$news_id = $request->id;
  	$update_news = DB::table('advertisements')->where('AdvertisementId',$news_id)->update(['AdvertisementType'=>$post_type,'Subject'=>$subject,'Url'=>$link,'Message'=>$description]);
  	if($update_news){
  		$request->session()->flash('message.level','success');
        $request->session()->flash('message.content','News Details Updated Successfully');
        return redirect('postnews');
  	}
  }

  public function deleteNews(Request $request){
  	$id = $request->id;
  	$deletenews = DB::delete('delete from advertisements where AdvertisementId=?',[$id]);
  	$deleteimage = DB::delete('delete from images where ImageRefType=? and ReferenceId=?',['Admin News',$id]);
  }
  
  //Heat
  public function setHeat(Request $request){
    if($request->session()->has('user_id')){
      $event_id = $request->id;
      $subevents = DB::select('select SubEventId,SubEventName from subevents where EventId=?',[$event_id]);
      return view('heatsetup',['event_id'=>$event_id,'subevents'=>$subevents]);
    }
    else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Passwords didnot match. Please,Try again..');
        return redirect('login');
    }
  }
    public function heatSetup(Request $request){
    $user_id = $request->session()->get('user_id');
    $event_id = $request->id;
    $subevent = $request->subevents;
    $stage_no = $request->stage_no;
    $stage_name = $request->stage_name;
    $heat_generation = $request->heat_generation;
   
    $event_details = DB::select('select SubEventId,SwimStyle,Relay,MaxParticipants from subevents where SubEventId=?',[$subevent]);
    foreach($event_details as $event_detail){
    $insert_heat = DB::table('eventheats')->insertGetId(array('EventId'=>$event_id,'SubEventId'=>$event_detail->SubEventId,'HeatName'=>'NA','HeatStartDate'=>'0000-00-00','HeatEndDate'=>'0000-00-00','HeatTime'=>'00:00:00','StageNumber'=>$stage_no,'StageName'=>$stage_name,'MaxNoOfParticipants'=>$event_detail->MaxParticipants,'VenueId'=>0,'QualificationTime'=>0,'Relay'=>$event_detail->Relay,'SwimCourse'=>0,'SwimStyle'=>$event_detail->SwimStyle,'ChildHeatId'=>0,'VenueHeatSpecialInstructions'=>'NA','HeatNotes'=>'NA','CreatedBy'=>$user_id,'UpdatedBy'=>$user_id));
      $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Basic Heat details Added Sucessfully');
      return redirect('scheduleheat/'.$event_id.'/'.$event_detail->SubEventId.'/'.$insert_heat);
   
    }
  }
  public function schedule(Request $request){
    if($request->session()->has('user_id')){
      $event_id = $request->event_id;
      $heat_id = $request->heat_id;
      $subevent_id = $request->subevent_id;
      return view('scheduleheat',['event_id'=>$event_id,'heat_id'=>$heat_id,'subevent_id'=>$subevent_id]);
    }
    else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Passwords didnot match. Please,Try again..');
        return redirect('login');
    }
  }
  public function scheduleHeat(Request $request){
    $event_id = $request->event_id;
    $subevent_id = $request->subevent_id;
    $heat_id = $request->heat_id;
    $heat_name = $request->heat_name;
    $schedule_time = $request->schedule_time;
    $qualification = $request->qualification;
    $qualification_time = $request->qualification_time;
    $schedule_date = $request->schedule_date;
    $course = $request->course;
    $update_heat = DB::update('update eventheats set HeatName=?,HeatTime=?,QualificationTime=?,HeatStartDate=? where HeatId=?',[$heat_name,$schedule_time,$qualification[0],$schedule_date,$heat_id]);
    $request->session()->flash('message.level','success');
    $request->session()->flash('message.content','Heat Scheduled Sucessfully.Add Another Heat or <a href="'.url('manageparticpants/'.$event_id.'/'.$subevent_id.'/'.$heat_id).'"> Click here to Add Participants to Heat...</a>');
    return view('scheduleheat',['event_id'=>$event_id,'heat_id'=>$heat_id,'subevent_id'=>$subevent_id]);
    
  }
  public function manageParticpants(Request $request){
    if($request->session()->has('user_id')){
      $user_id = $request->session()->get('user_id');
      $event_id = $request->event_id;
      $subevent_id = $request->subevent_id;
      $heat_id = $request->heat_id;
      $participants = DB::select('SELECT DISTINCT participants.ParticipantId,participants.ParticipantName FROM participants INNER JOIN bridgeeventparticipants where participants.ParticipantId = bridgeeventparticipants.ParticipantId and bridgeeventparticipants.EventId=? ',[$event_id]);
      $mainheat = DB::select('select HeatName from eventheats where HeatId=? and EventId=?',[$heat_id,$event_id]);
      $heatname = $mainheat[0]->HeatName;
      $heats = DB::select('select HeatId,HeatName from eventheats where EventId=?',[$event_id]);
      $heat_participants = DB::select('select DISTINCT p.ParticipantId,p.ParticipantName from participants p INNER JOIN bridgeheatparticipants b where p.ParticipantId=b.ParticipantId and b.EventId=? and b.HeatId=?',[$event_id,$heat_id]);
      return view('manageparticipants',['participants'=>$participants,'heatname'=>$heatname,'heats'=>$heats,'event_id'=>$event_id,'heat_id'=>$heat_id,'heat_participants'=>$heat_participants,'subevent_id'=>$subevent_id]);
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
      for($i=0;$i<count($participant);$i++){
        $eventparticipants = DB::delete('delete from bridgeeventparticipants where EventId=? and ParticipantId=?',[$event_id,$participant[$i]]);
        $set_heatparticipants = DB::table('bridgeheatparticipants')->insertGetId(array('HeatId'=>$heat_id,'EventId'=>$event_id,'ParticipantId'=>$participant[$i],'CreatedBy'=>$user_id,'StageNo'=>0,'AssignStatus'=>0));
      }
      $request->session()->flash('message.level','success');
    $request->session()->flash('message.content','Participants Moved to heat');
    return redirect('manageparticpants/'.$event_id.'/'.$subevent_id.'/'.$heat_id);
    }
    elseif($heats_participants!=''){
      for($i=0;$i<count($heats_participants);$i++){
        $heatparticipants = DB::delete('delete from bridgeheatparticipants where ParticipantId=? and EventId=? and HeatId=?',[$heats_participants[$i],$event_id,$heat_id]);
        $set_eventparticipants = DB::table('bridgeeventparticipants')->insertGetId(array('EventId'=>$event_id,'ParticipantId'=>$heats_participants[$i],'GroupId'=>0,'CreatedBy'=>$user_id,'DeletedBy'=>0,'Invite'=>0,'ConfirmCode'=>0,'ApproverId'=>0,'Status'=>0));
      }
        $request->session()->flash('message.level','success');
    $request->session()->flash('message.content','Participants Removed from heat');
    return redirect('manageparticpants/'.$event_id.'/'.$subevent_id.'/'.$heat_id);
    }
    else{
      $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Changes saved Sucessfully');
    return redirect('resultentry/'.$event_id);
    }
  }

  public function oldHeatSchedule(Request $request){
    $event_id = $request->event_id;
    $heat_id = $request->heat_id;
    $subevent_id = $request->subevent_id;
    $schedules = DB::select('select HeatName,HeatStartDate,HeatTime,QualificationTime from eventheats where EventId=? and SubEventId=?',[$event_id,$subevent_id]);
    echo '<h5 class="add_venue"><a href="#"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button></a> Previous Entries</h5>';
                echo '<div class="row" style="border:1px solid #eee">';
                echo "<table class='table table-striped'>";
                echo "<tr><td>Heat Name</td><td>Heat StartDate</td><td>HeatTime</td><td>QualificationTime</td><td>Edit</td><td>Delete</td></tr>";
                foreach($schedules as $schedule) {
                    echo "<tr><td>".$schedule->HeatName."</td><td>".$schedule->HeatStartDate."</td><td>".$schedule->HeatTime."</td><td>".$schedule->QualificationTime."</td><td>Edit</td><td>Delete</td></tr>";
                }
                echo "</table>";
                echo '</div>';
  }

   public function semifinalsetup(Request $request){
    if($request->Session()->has('user_id')){
      $event_id = $request->event_id;
      $heat_id = $request->heat_id;
      $participants = DB::table('participants')
      ->DISTINCT('participants.ParticipantId')
      ->selectRaw('*,participants.ParticipantId,participants.ParticipantName,eventresults.Result,eventresults.HeatId,eventresults.EventResultId')
      ->JOIN('eventresults','eventresults.ParticipantId','=','participants.ParticipantId')
      ->where('eventresults.EventId','=',$event_id)
      ->ORDERBY('eventresults.Result')
      ->paginate(10);
      return view('semifinalsetup',['event_id'=>$event_id,'participants'=>$participants]);
    }
    else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Passwords didnot match. Please,Try again..');
        return redirect('login');
    }
  }
  public function saveSemifinalsetup(Request $request){
    $event_id = $request->event_id;
    $participants = $request->participants;
    $senifinal = $request->semifinal;
    $heat_id = $request->heat_id;
    for($i=0;$i<count($participants);$i++){
      $update_result = DB::update('update eventresults set SemiFinal=? where EventId=? and HeatId=? and ParticipantId=?',[$senifinal[$i],$event_id,$heat_id[$i],$participants[$i]]);
    }
    if($update_result){
      $request->session()->flash('message.level','success');
      $request->session()->flash('message.content','Participant Added to semifinals');
      return redirect('semifinalsetup/'.$event_id);
    }
    else{
      $request->session()->flash('message.level','danger');
      $request->session()->flash('message.content','Failed Adding Participants to semifinal.Please try again..');
      return redirect('semifinalsetup/'.$event_id);
    }
  }
  public function finalsetup(Request $request){
      if($request->Session()->has('user_id')){
      $event_id = $request->event_id;
      $participants = DB::table('users')
      ->selectRaw('*,users.UserId,users.UserName,eventresults.Result,eventresults.SemiFinal')
      ->JOIN('eventresults','eventresults.ParticipantId','=','users.UserId')
      ->where('eventresults.EventId','=',$event_id)
      ->where('eventresults.SemiFinal','!=',0)
      ->ORDERBY('eventresults.Result')
      ->DISTINCT('users.UserId')
      ->paginate(10);
      return view('finalsetup',['event_id'=>$event_id,'participants'=>$participants]);
    }
    else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Passwords didnot match. Please,Try again..');
        return redirect('login');
    }
  }
  public function savefinalresults(Request $request){
      $event_id = $request->event_id;
      $participants = $request->participants;
      $semifinal_id = $request->semifinal_id;
      $final = $request->final;
      for($i=0;$i<count($participants);$i++){
      $update_eventresults = DB::update('update eventresults set Status=? where EventId=? and SemiFinal=? and ParticipantId=?',[1,$event_id,$semifinal_id[$i],$participants[$i]]);
      if($update_eventresults){
        $request->session()->flash('message.level','success');
        $request->session()->flash('message.content','Participants moved to finals');
        return redirect('finalsetup/'.$event_id);
      }
      else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Failed moving participants to Final.Please,Try Again');
        return redirect('finalsetup/'.$event_id);

      }
      }
  }
  public function resultEntry(Request $request){
    if($request->session()->has('user_id')){
      $event_id = $request->event_id;
      $heat_participants = DB::select('select HeatId,HeatName from eventheats where EventId=?',[$event_id]);
      $participants=array();
        return view('resultentry',['heat_participants'=>$heat_participants,'event_id'=>$event_id,'participants'=>$participants]);
    }
    else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Passwords didnot match. Please,Try again..');
        return redirect('login');
    }
  }
  public function heatResult(Request $request){
    $event_id = $request->event_id;
    $heat_id = $request->heat_id;
    $heat_participants = DB::select('select HeatId,HeatName from eventheats where EventId=?',[$event_id]);
    $participants = DB::select('select DISTINCT users.UserName,users.UserId,users.Image from users JOIN bridgeheatparticipants ON users.UserId=bridgeheatparticipants.ParticipantId where bridgeheatparticipants.EventId=? and bridgeheatparticipants.HeatId=?',[$event_id,$heat_id]);
    return view('resultentry',['heat_participants'=>$heat_participants,'participants'=>$participants,'event_id'=>$event_id,'heat_id'=>$heat_id]);
  }
  public function saveResult(Request $request){
    $user_id = $request->session()->get('user_id');
    $event_id = $request->event_id;
    $heat_id = $request->heat_id;
    $time = $request->time;
    $result = $request->result;
    $userid = $request->userid;
    for($i=1;$i==count($time);$i++){
    $results = DB::table('eventresults')->insertGetId(array('EventId'=>$event_id,'ParticipantId'=>$userid[$i],'HeatId'=>$heat_id,'SemiFinal'=>0,'RecordedTime'=>$time[$i],'Result'=>$result[$i],'ParentResultId'=>0,'CreatedBy'=>$user_id,'UpdatedBy'=>$user_id));
    }
    $request->session()->flash('message.level','success');
    $request->session()->flash('message.content','Result Saved Sucessfully..');
    return redirect('resultentry/'.$event_id.'/'.$heat_id);
  }

    public function semifinal(Request $request){
      if($request->session()->has('user_id')){
      $event_id = $request->event_id;
       $semifinal = DB::select('select DISTINCT SemiFinal from eventresults where EventId=?',[$event_id]);
      $semi_particpants = array();
      return view('semifinal',['event_id'=>$event_id,'semifinals'=>$semifinal,'semi_particpants'=>$semi_particpants]);
      }
      else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Passwords didnot match. Please,Try again..');
        return redirect('login');
      }
    }
    public function semifinalParticipants(Request $request){
      $event_id = $request->event_id;
      $semifinal_id = $request->semifinal;
      $semifinal = DB::select('select DISTINCT SemiFinal from eventresults where EventId=?',[$event_id]);
      if($semifinal_id == 0){
         return view('semifinal',['event_id'=>$event_id,'semifinals'=>$semifinal,'semi_particpants'=>array(),'semifinal_id'=>$semifinal_id]);
      }
      else{
      $semi_particpants = DB::Select('select DISTINCT users.UserName,users.UserId,users.Image,eventresults.ParticipantId,eventresults.EventResultId from users JOIN eventresults ON users.UserId=eventresults.ParticipantId where eventresults.EventId=? and eventresults.SemiFinal=?',[$event_id,$semifinal_id]);
         return view('semifinal',['event_id'=>$event_id,'semifinals'=>$semifinal,'semi_particpants'=>$semi_particpants,'semifinal_id'=>$semifinal_id]);
      }
    }
    public function savesemifinalParticipants(Request $request){
      $event_id = $request->event_id;
      $semifinal_id =$request->semifinal;
      $time = $request->time;
      $result = $request->result;
      $participants = $request->participantid;
      for($i=0;$i<count($time);$i++){
        $update_results = DB::update('update eventresults set RecordedTime=?,Result=? where EventResultId=?',[$time[$i],$result[$i],$participants[$i]]);
      }
      $request->session()->flash('message.level','success');
        $request->session()->flash('message.content','Semifinal Result Saved Sucessfully..');
        return redirect('semifinal/'.$event_id.'/'.$semifinal_id);
     }
    public function finalstage(Request $request){
      if($request->session()->has('user_id')){
        $event_id = $request->event_id;
        $participants = DB::select('select DISTINCT users.UserName,users.UserId,users.Image,eventresults.ParticipantId,eventresults.EventResultId from users JOIN eventresults ON users.UserId=eventresults.ParticipantId where eventresults.EventId=? and eventresults.Status=?',[$event_id,1]);
        return view('final',['event_id'=>$event_id,'participants'=>$participants]);
      }
      else{
        $request->session()->flash('message.level','danger');
        $request->session()->flash('message.content','Passwords didnot match. Please,Try again..');
        return redirect('login');
      }
    }
    public function savefinalstage(Request $request){
      $event_id = $request->event_id;
      $semifinal_id = $request->semifinal;
      $eventresultid = $request->eventresultid;
      $time = $request->time;
      $result = $request->result;
      for($i=0;$i<count($time);$i++){
        $update_results = DB::update('update eventresults set RecordedTime=?,Result=? where ParticipantId=? and EventId=? and Status=?',[$time[$i],$result[$i],$eventresultid[$i],$event_id,1]);
        if($update_results){
          $request->session()->flash('message.level','success');
          $request->session()->flash('message.content','Final Result Saved Sucessfully..');
          return redirect('semifinal/'.$event_id.'/'.$semifinal_id);
        }
        else{
          $request->session()->flash('message.level','danger');
          $request->session()->flash('message.content','Final Result not updated.Please, Try again...');
          return redirect('semifinal/'.$event_id.'/'.$semifinal_id);
        }
      }
    }
    
    public function addUser(Request $request){
        $name = $request->username;
        $email = $request->email;
        $password = $request->password;
        $user_type = $request->user_type;
        $shortname = $request->shortname;
   $pass = md5($password);
            $token = rand();
                $id = DB::table('users')->insertGetId(array('UserName' => $name, 'Email' => $email, 'Password' => $pass, 'IsUserAccepted' => 0,'FirstName' => 'NA','MiddleName' => 'NA', 'LastName' =>'NA','Title' => 'NA','UserRandomId'=>0, 'UserType' => $user_type,'AddressId' => 0,'DayTimePhone' => 'NA', 'EveningPhone' => 'NA', 'IsDeleted' =>0, 'Image' => 'NA', 'Facebook' => 'NA', 'Twitter' => 'NA', 'Website' => 'NA', 'passreset' => 0, 'pm_count' => 0, 'Google_Id' => 'NA', 'Oauth_UId' => 'NA', 'ApprovalStatus' => $token, 'ShortName' =>$name));
                 if($id){
                    $activation_url = url("/activation/".$id.",".$token);
                    $data = array( 'email' => $email, 'name' => $name, 'user_type' =>$user_type, 'activation_url' => $activation_url, 'password' => $password );
                  Mail::send('emailtemplates.adduser', $data, function($message) use($email,$name) {
                  $message->to($email, $name)->subject('Please Activate Your SwimmIQ Account');
                  $message->from('swimiqmail@gmail.com','SwimmIQ');
                  });
                    $request->session()->flash('message.level','info');
                    $request->session()->flash('message.content','User added Successfully..');
                    return redirect('admindashboard');
                 }
                 else{
                    $request->session()->flash('message.level','danger');
                    $request->session()->flash('message.content','Unable to save your Data, Please Try Again.');
                    return redirect('admindashboard');
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
    
    public function editUser(Request $request){
   if($request->session()->has('user_id')){
    $userid = $request->session()->get('user_id');
    $id = $request->id;
    $users = DB::select('select * from users where UserId=?',[$id]);
     
    return view('edituser',['user'=>$users]);
   }
   else{
     $request->session()->flash('message.level','danger');
     $request->session()->flash('message.content','please login to continue...');
     return view('login');
   }
 }
 
 public function updateUser(Request $request){
     
        $userid = $request->session()->get('user_id');
        $id = $request->id;
        $firstname = $request->FirstName;
        $lastname = $request->LastName;
        $middlename = $request->MiddleName;
        $username = $request->UserName;
        $email = $request->Email;
        $daytimephone = $request->DayTimePhone;
        $facebook = $request->Facebook;
        $twitter = $request->Twitter;
        $website = $request->Website;
        $eveningphone = $request->EveningPhone;
       
  $users = DB::select('select * from users where UserId=?',[$id]);
        if(DB::update('UPDATE users SET FirstName=?,LastName=?,MiddleName=?,UserName=?,Email=?,DayTimePhone=?,Facebook=?,Twitter=?,Website=?,EveningPhone=? where UserId = ?',[$firstname,$lastname,$middlename,$username,$email,$daytimephone,$facebook,$twitter,$website,$eveningphone,$id])){
           
            $updated_details = DB::select('select * from users where UserId = ?',[$id]);
             $request->session()->flash('message.level', 'info');
          $request->session()->flash('message.level','info');
          $request->session()->flash('message.content','updated  details...');
         return redirect('edituser/'.$id);

        }
        else{
          $request->session()->flash('message.level','danger');
          $request->session()->flash('message.content','Unable to update your details...');
          return redirect('edituser/'.$id);
        }
       
    }

      public function deleteUser(Request $request){
           $userid = $request->session()->get('user_id');
           $id = $request->id;
       $users = DB::select('select * from users where UserId=? and IsDeleted=0',[$id]);
        $deleteuser = DB::update('update users set IsDeleted = 1 where UserId = ?',[$id]);
           if($deleteuser){
               $request->session()->flash('message.level', 'info');
               $request->session()->flash('message.content', 'User Deleted Sucessfully');
               return redirect('admindashboard');
           }
       }

}