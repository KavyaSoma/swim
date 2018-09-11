<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SocialController extends Controller
{
    public function index(Request $request) {
      if($request->session()->has('user_id')){
        $user_id = $request->session()->get('user_id');
        $friends =DB::select('select distinct u.UserName,f.RequestReceiverID,u.UserId,u.Image,u.ShortName from users u INNER JOIN friendrequests f where f.RequestReceiverID=u.UserId and f.RequestorID=? LIMIT 4',[$user_id]);
        $questions = DB::select('select DISTINCT q.Question,q.QuestionId,q.Topic,q.View,q.DateTime,u.UserName,u.Image from questions q JOIN users u ON q.UserId=u.UserId');
        $topics = DB::Select('select DISTINCT Topic from questions');
        $all_groups = DB::select('select count(GroupId) as count from groups');
        $groups = DB::table('groups')
        ->selectRaw('*,GroupId,GroupName,UserId')
        ->orderby('GroupId','DESC')        
        ->paginate(4);
        return view('socialnetwork',['friends'=>$friends,'questions'=>$questions,'topics'=>$topics,'groups'=>$groups, 'groups_count'=>$all_groups]);
        }
        else{
          $request->session()->flash('message.level','danger');
          $request->session()->flash('message.content','please login to continue..');
          return view('login');
        }
    }
    public function answersCount(Request $request) {
    $question_id = $request->question_id;
    $answers = DB::select('select count(QuestionId) as count from answers where QuestionId=?',[$question_id]);
    if( count($answers)>0 ) {
        echo '<i class="fa fa-comments" style="color:#46A6EA;font-size:18px"> </i> '.$answers[0]->count;
    } else {
        echo '<i class="fa fa-comments" style="color:#46A6EA;font-size:18px"> </i> 0';
    }
    }
    public function addFriend(Request $request){
        $user_id = $request->session()->get('user_id');
      $name = $request->name;
      $category = $request->category;
      $topic = $request->topic;
      $message = $request->message;
        $group_name = $request->group_name;
        $group_id = $request->group_id;
        $member_name = $request->member_name;
      if($category!='' && $topic!='' && $message!=''){
        $askforum = DB::insert('insert into questions(Category,Topic,Question,DateTime,View,UserId,TargetType,TargetId) values(?,?,?,?,?,?,?,?)',[$category,$topic,$question,$date,0,$userid,'NA',0]);
        if($askforum){
          $request->session()->flash('message.level','info');
          $request->session()->flash('message.content','Question saved successfully');
          return redirect('socialnetwork');
        }
      else{
          $request->session()->flash('message.level','danger');
          $request->session()->flash('message.content','Failed to post your question');
          return redirect('socialnetwork');
      }
      }
        elseif($group_name!=''){
            $add_group = DB::table('groups')->insertGetId(array('UserId'=>$user_id,'GroupName'=>$group_name));
            if($add_group){
            $request->session()->flash('message.level','success');
            $request->session()->flash('message.content','Group Added Successfully');
            return redirect('socialnetwork');
            }
            else{
            $request->session()->flash('message.level','danger');
            $request->session()->flash('message.content','Group not Added.Please,Try again');
            return redirect('socialnetwork');    
            }
        }
        elseif($member_name!=''){
            $member_info = DB::select('select UserId from users where UserName=? or Email=?',[$member_name,$member_name]);
            if($member_info){
            $member_id = $member_info[0]->UserId;
             $add_member = DB::table('bridgegroupmembers')->insertGetId(array('UserId'=>$user_id,'FriendId'=>$member_id,'GroupId'=>$group_id));
            if($add_member){
            $request->session()->flash('message.level','success');
            $request->session()->flash('message.content','Member Added to Group Successfully');
            return redirect('socialnetwork'); 
            }
            else{
            $request->session()->flash('message.level','danger');
            $request->session()->flash('message.content','Failed Adding member to group.Please,Try again');
            return redirect('socialnetwork');    
            }
            }
            else{
            $request->session()->flash('message.level','info');
            $request->session()->flash('message.content','User Does not Exist');
            return redirect('socialnetwork');    
            }
        }
      else{
      $sender_id = $request->session()->get('user_id');
      $search = DB::select('select UserId,UserName,Email from users where UserName=? or Email=?',[$name,$name]);
      if(count($search)>0){
        $receiver_id = $search[0]->UserId;
        $check_request = DB::select('select ApprovalStatus from friendrequests where RequestorID=? and RequestReceiverID=?',[$sender_id,$receiver_id]);
        if(count($check_request)>0){
          $request->session()->flash('message.level','info');
              $request->session()->flash('message.content','Friend Request already sent waiting for response..');
              return redirect('socialnetwork');
        }
        else{
        $send_request = DB::table('friendrequests')->insertGetId(array('RequestorID'=>$sender_id,'RequestReceiverID'=>$receiver_id,'ApprovalStatus'=>'P'));
        $addfriends = DB::table('friends')->insertGetId(array('FriendId'=>$receiver_id,'UserId'=>$sender_id,'FriendRequestId'=>$send_request,'Status'=>'P'));
        $request->session()->flash('message.level','success');
            $request->session()->flash('message.content','Friend Request has been sent...');
            return redirect('socialnetwork');
            }
      }
      else{
        $request->session()->flash('message.level','danger');
            $request->session()->flash('message.content','User Doesnot Exist...');
            return redirect('socialnetwork');
      }
      }
    }
    public function newFriend(Request $request){
    	$id = $request->id;
    	$user_id = $request->session()->get('user_id');
    	$check_request = DB::select('select ApprovalStatus from friendrequests where RequestorID=? and RequestReceiverID=?',[$user_id,$id]);
    	if(count($check_request)>0){
    		$request_id = DB::select('select FriendRequestsID from friendrequests where RequestReceiverID=? and RequestorID=?',[$id,$user_id]);
    		$remove_request = DB::delete('delete from friendrequests where RequestReceiverID=? and RequestorID=?',[$id,$user_id]);
    		$remove_friend = DB::delete('delete from friends where FriendId=?',[$request_id[0]->FriendRequestsID]);
                $request->session()->flash('message.level','danger');
                $request->session()->flash('message.content','User removed from your friends list');
                return redirect('myfriendlist');
    	}
    	else{
    		$send_request = DB::table('friendrequests')->insertGetId(array('RequestorID'=>$user_id,'RequestReceiverID'=>$id,'ApprovalStatus'=>'P'));
    		$friends = DB::table('friends')->insertGetId(array('FriendId'=>$id,'UserId'=>$user_id,'FriendRequestId'=>$send_request,'Status'=>'P'));
                $request->session()->flash('message.level','success');
                $request->session()->flash('message.content','User added to your friends list');
                return redirect('friendlist');
    	}
    }

    public function friendList(Request $request){
    	if($request->session()->has('user_id')){
    	  $user_id = $request->session()->get('user_id');
    	  $allusers = DB::table('users')
    	  ->selectRaw('*,users.UserId,users.UserName,users.Image,users.ShortName')
          ->where('users.UserId','!=',[$user_id])
          ->where('users.UserType','=','user')         
          ->orderBy('users.UserId')
    	  ->paginate(30);
    	  if(count($allusers)>0){
    	  	return view('friendlist',['allusers'=>$allusers]);
    	  }
    	  else{
    	  	$allusers = array();
    	  	$myfriends = array();
    	  	return view('friendlist',['allusers'=>$allusers]);
    	  }
    	  
    	}
    	else{
          $request->session()->flash('message.level','danger');
          $request->session()->flash('message.content','please login to continue..');
          return view('login');
      	}
    }
    public function myFriend(Request $request){
    	if($request->session()->has('user_id')){
    		$user_id = $request->session()->get('user_id');
    		$myfriends = DB::table('users')
    	  ->selectRaw('*,users.UserId,users.UserName,users.Image,users.ShortName')
    	  ->JOIN('friendrequests','users.UserId','=','friendrequests.RequestReceiverID')
          ->where('friendrequests.RequestorID','=',$user_id)
    	  ->orderBy('users.UserId')
    	  ->paginate(30);
    	  if(count($myfriends)>0){
    	  	return view('myfriendlist',['friends'=>$myfriends]);
    	  }
    	  else{
    	  	 $request->session()->flash('message.level','info');
          $request->session()->flash('message.content','You have not added any friends yet, Please add friends...');
          return redirect('friendlist');
    	  }
    	}
    	else{
    	  $request->session()->flash('message.level','danger');
          $request->session()->flash('message.content','please login to continue..');
          return view('login');
    	}
    }
    public function searchfriend(Request $request){
    	$search = $request->search;
    	$allusers = DB::table('users')
    	->selectRaw('*,users.UserId,users.UserName')
    	->where('users.UserName','like','%'.$search.'%')
    	->orderBy('users.UserId')
    	->paginate(30);
    	return view('friendlist',['allusers'=>$allusers]);
    }

    public function answers(Request $request){
    	if($request->session()->has('user_id')){
    		$question_id = $request->id;
    		$question = DB::select('select q.Topic,q.Question,q.DateTime,q.UserId,q.View,u.UserName,u.Image FROM questions q JOIN users u ON q.UserId=u.UserId WHERE q.QuestionId=?',[$question_id]);
    		$view_count = $question[0]->View;
    		$view = $view_count+1;
    		$answers = DB::select('select Answer from answers where QuestionId=?',[$question_id]);
    		//$recent_questions = DB::select('select Question from questions where max(View)');
    		//var_dump($recent_questions);
    		$topics = DB::select('select DISTINCT Topic from questions');
    		$update_viewcount = DB::update('update questions SET View=? where QuestionId=?',[$view,$question_id]);
    		return view('forumanswers',['questions'=>$question,'question_id'=>$question_id,'answers'=>$answers,'topics'=>$topics]);
    	}
    	else{
    	  $request->session()->flash('message.level','danger');
          $request->session()->flash('message.content','please login to continue..');
          return view('login');
    	}
    }
    public function forumanswer(Request $request){
    	$question_id = $request->id;
    	$message = $request->message;
    	$user_id = $request->session()->get('user_id');
    	$insert_answer = DB::table('answers')->insertGetId(array('QuestionId'=>$question_id,'UserId'=>$user_id,'Answer'=>$message));
    	if($insert_answer){
    	  $request->session()->flash('message.level','success');
          $request->session()->flash('message.content','Answer posted Successfully...');
          return redirect('forumanswers/'.$question_id);
    	}
    	else{
    	  $request->session()->flash('message.level','failed');
          $request->session()->flash('message.content','Failed to post answer,Please Try again.');
          return redirect('forumanswers/'.$question_id);
    	}
    }
    public function forum(Request $request){
        $search = "";
        if($request->has('search')) {
            $search = $request->search;
        }
    	$topics = DB::Select('select DISTINCT Topic from questions');
    	if($search == "") {
    	$questions = DB::table('questions')
    	->selectRaw('*,Question,Topic,View,DateTime,Image')
        ->join('users','users.UserId','=','questions.UserId')        
    	->orderBy('questions.QuestionId')
    	->paginate(10);
        $allquestions = DB::select('select count(Question) as count from questions');
        } else {
        $questions = DB::table('questions')
    	->selectRaw('*,Question,Topic,View,DateTime,Image')
        ->join('users','users.UserId','=','questions.UserId')  
        ->where('Question','like','%'.strtolower($search).'%')        
    	->orderBy('questions.QuestionId')
    	->paginate(10);   
        $allquestions = DB::select("select count(Question) as count from questions where Question like '%".strtolower($search)."%'");
        }
    	return view('forum',['questions'=>$questions,'allquestions'=>$allquestions,'topics'=>$topics,'category'=>'']);
    }
    public function categoryForum(Request $request){
        $search = "";
        if($request->has('search')) {
            $search = $request->search;
        }
        $category = $request->category;
    	$topics = DB::Select('select DISTINCT Topic from questions');
    	if($search == "") {
    	$questions = DB::table('questions')
    	->selectRaw('*,Question,Topic,View,DateTime,Image')
        ->join('users','users.UserId','=','questions.UserId')  
        ->where('Topic','like','%'.strtolower($category).'%')        
    	->orderBy('questions.QuestionId')
    	->paginate(10);
        $allquestions = DB::select("select count(Question) as count from questions where Topic like '%".strtolower($category)."%'");
        } else {
        $questions = DB::table('questions')
    	->selectRaw('*,Question,Topic,View,DateTime,Image')
        ->join('users','users.UserId','=','questions.UserId')  
        ->where('Question','like','%'.strtolower($search).'%')        
    	->where('Topic','like','%'.strtolower($category).'%')
        ->orderBy('questions.QuestionId')
    	->paginate(10);   
        $allquestions = DB::select("select count(Question) as count from questions where Question like '%".strtolower($search)."%' and Topic like '%".strtolower($category)."%'");
        }
    	return view('forum',['questions'=>$questions,'allquestions'=>$allquestions,'topics'=>$topics,'category'=>$category]);
    }
    public function questions(Request $request){
    	$search = $request->search;
    	$topics = DB::Select('select DISTINCT Topic from questions');
    	$allquestions = DB::select('select Question from questions');
    	$search_question = DB::select('select Question,View,Topic,QuestionId from questions where Question=?',[$search]);
    	return view('questions',['questions'=>$search_question,'topics'=>$topics]);
    }
    
    public function saveForumQuestion (Request $request) {
        if($request->session()->has('user_id')){
        $topic = strtolower($request->topic);
    	$question = $request->question;
    	$user_id = $request->session()->get('user_id');
        DB::insert('insert into questions(Topic,Question,View,UserId,TargetType,TargetId) values(?,?,?,?,?,?)',[$topic,$question,0,$user_id,'',0]);
        return redirect('forum');        
        } else {
          $request->session()->flash('message.level','danger');
          $request->session()->flash('message.content','please login to continue..');
          return view('login');  
        }
    }
    
    public function groups(Request $request){
        if($request->session()->has('user_id')){
        $search_term='';
        if($request->has('search_term')) {
            $search_term = $request->search_term;
        }
        $user_id = $request->session()->get('user_id');
        $all_groups = DB::select('select count(GroupId) as count from groups where IsDeleted="N"');
        if($search_term == '') {
            $groups = DB::table('groups')
        ->selectRaw('*,GroupId,GroupName,UserId')
        ->where('IsDeleted',['N'])         
        ->orderby('GroupId','DESC')         
        ->paginate(20);
        } else {
          $groups = DB::table('groups')
        ->selectRaw('*,GroupId,GroupName,UserId')
        ->where('IsDeleted',['N']) 
        ->where('GroupName','like','%'.$search_term.'%')           
        ->orderby('GroupId','DESC')         
        ->paginate(20);  
        }
        
        return view('groups',['groups'=>$groups,'user_id'=>$user_id,'search_term'=>$search_term]);
        }
        else{
           $request->session()->flash('message.level','danger');
          $request->session()->flash('message.content','please login to continue..');
          return view('login'); 
        }
    }
    
    public function group(Request $request){
        if($request->session()->has('user_id')){
        $userid = $request->session()->get('user_id');
        $show = '';
        $groupid = $request->groupid;
        $search_term = '';
        if($request->has('search_term')) {
            $search_term = $request->search_term;
        }
        $is_group_admin = DB::select('select UserId from groups where GroupId=? and UserId=?',[$groupid,$userid]);
        if( count($is_group_admin) > 0 ) {
            $show = 'admin';
        } else {
        $is_group_admin = DB::select('select Id from bridgegroupmembers where GroupId=? and FriendId=?',[$groupid,$userid]);
        if( count($is_group_admin) > 0 ) {
            $show = '';
        } else {
            $show = 'user';
        }
        }
        
        $all_group_members = DB::select('select count(UserId) as count from bridgegroupmembers where GroupId=?',[$groupid]);
        $group_info = DB::select('select GroupId,GroupName,UserId from groups where GroupId=?',[$groupid]);
        if(count($group_info) == 0) {
          $request->session()->flash('message.level','danger');
          $request->session()->flash('message.content','The Group you tried to view does not exist, redirected to all groups page.....');
          return redirect('groups');
        }
        if($search_term == '') {
        $users = DB::table('users')
        ->selectRaw('*,users.UserId,UserName,Image,ShortName,groups.GroupName')
        ->join('bridgegroupmembers','FriendId','=','users.UserId')
        ->join('groups','groups.GroupId','=','bridgegroupmembers.GroupId')        
        ->where('bridgegroupmembers.GroupId',$groupid)     
        ->orderby('bridgegroupmembers.GroupId','DESC')         
        ->paginate(12);
        return view('group',['users'=>$users,'user_id'=>$request->session()->get('user_id'),'total_users'=>$all_group_members,'search_term'=>$search_term,'group_info'=>$group_info,'show'=>$show]);    
        } else {
          $users = DB::table('users')
        ->selectRaw('*,users.UserId,UserName,Image,ShortName,GroupName')
        ->join('bridgegroupmembers','FriendId','=','users.UserId')
        ->join('groups','groups.GroupId','=','bridgegroupmembers.GroupId')        
        ->where('bridgegroupmembers.GroupId',$groupid)    
        ->where('users.UserName','like','%'.strtolower($search_term).'%')           
        ->orderby('bridgegroupmembers.GroupId','DESC')         
        ->paginate(12);
        return view('group',['users'=>$users,'user_id'=>$request->session()->get('user_id'),'total_users'=>$all_group_members,'search_term'=>$search_term,'group_name'=>$group_name[0]->GroupName]);  
        }
        }
        else{
          $request->session()->flash('message.level','danger');
          $request->session()->flash('message.content','please login to continue..');
          return view('login'); 
        }
    }
    
    public function getGroupsImages (Request $request) {
        $groupid = $request->groupid;
        $gimages = DB::select('select u.Image from users u join bridgegroupmembers b ON u.UserId=b.FriendId where b.GroupId='.$groupid);
        if( count($gimages) == 0 ) {
           echo url('public/images/profile.png').",".url('public/images/profile.png'); 
        } elseif( count($gimages)< 2 ) {
           if (file_exists($gimages[0]->Image)) {
            echo url('public/images/profile.png').",".url($gimages[0]->Image);
           } else {
            echo url('public/images/profile.png').",".url('public/images/profile.png');   
           } 
            
        } else {
           if (file_exists($gimages[0]->Image) && file_exists($gimages[1]->Image)) {
            echo url($gimages[0]->Image).",".url($gimages[1]->Image);
           } else {
            echo url('public/images/profile.png').",".url('public/images/profile.png');   
           }  
        }
    }
 
    public function postGroup(Request $request){
        $user_id = $request->session()->get('user_id');
        $group_name = $request->group_name;
        $search = $request->search;
        if($group_name!=''){
        $add_group = DB::table('groups')->insertGetId(array('UserId'=>$user_id,'GroupName'=>$group_name));
        if($add_group){
          $request->session()->flash('message.level','success');
          $request->session()->flash('message.content','Group Added Successfully');
          return redirect('groups');
        }
        }
        else{
            $search_groups = DB::select('select GroupId from groups where GroupName=?',[$search]);
            /*foreach($search_groups as $search_group){
                $groupmembers = DB::select('select b.UserId,b.FriendId,g.GroupName,g.GroupId from bridgegroupmembers b JOIN groups g ON b.UserId=g.UserId where b.UserId=? and b.GroupId=?',[$user_id,$search_group->GroupId]);

            }*/
            $request->session()->flash('message.level','success');
          $request->session()->flash('message.content','Group Added Successfully');
          return redirect('groups');
        }
    }
    public function joingroup(Request $request){
        if($request->session()->has('user_id')){
            $user_id = $request->session()->get('user_id');
            $url_id = $request->user_id;
            $group_id = $request->group_id;
            $admin_id = $request->admin;
            if($user_id == $url_id){
               $check_duplicate_entry = DB::select('select UserId from bridgegroupmembers where UserId=? and FriendId=? and GroupId=?',[$admin_id,$user_id,$group_id]);
               if ( count($check_duplicate_entry) == 0) {
                $add_member = DB::table('bridgegroupmembers')->insertGetId(array('UserId'=>$admin_id,'FriendId'=>$user_id,'GroupId'=>$group_id));
                if($add_member){
                $request->session()->flash('message.level','success');
                $request->session()->flash('message.content','Member Added Sucessfully to Group');
                return redirect('group/'.$group_id);
                }
                else{
                $request->session()->flash('message.level','danger');
                $request->session()->flash('message.content','Failed Adding member to group');
                return redirect('group/'.$group_id);   
                }
              } else {
                $request->session()->flash('message.level','danger');
                $request->session()->flash('message.content','You already joined the group...');
                return redirect('group/'.$group_id);  
              }
            }
            else{
                $request->session()->flash('message.level','danger');
                $request->session()->flash('message.content','Unable to process request...');
                return redirect('group/'.$group_id);
            }
        }
        else{
           $request->session()->flash('message.level','danger');
           $request->session()->flash('message.content','please login to continue..');
           return view('login'); 
        }
    }
}
