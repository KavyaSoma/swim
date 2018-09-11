@extends('layouts.main')
@section('content')
 <!-- group code starts here -->
 @if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
 <div class="container" id="main-code" style="margin-top:20px">
 <ol class="breadcrumb" style="background:#46A6EA;">
  <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ url('/socialnetwork') }}">Social Network</a></li>
  <li class="breadcrumb-item"><a href="{{ url('/groups') }}">Groups</a></li>
  <li class="breadcrumb-item">{{ $group_info[0]->GroupName }}</li>
  
 </ol> 
   <div class="panel panel-default magic-element isotope-item">
      <div class="panel-body-heading edituser_panel">
        <h4 class="pb-title" style="padding:10px"><a href="#">{{ $group_info[0]->GroupName }} <span class="badge" id="badge"> {{ $total_users[0]->count }}</span></a><span>
        @if($show == 'admin')
        <button class="btn btn-primary pull-right add-member" onclick="group('{{url('joingroup/'.$group_info[0]->GroupId.'/'.$user_id.'/'.$group_info[0]->UserId)}}')">Add Member</button>
        @else
        <button class="btn btn-primary pull-right add-member" onclick="group('{{url('joingroup/'.$group_info[0]->GroupId.'/'.$user_id.'/'.$group_info[0]->UserId)}}')">Join Group</button>
        @endif
        <!-- Modal -->
        <div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog modal_mobile">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-body" style="margin-top:10px">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-sm-4" for="txt" style="color:#333">Member Name:</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="txt">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-4" for="txt" style="color:#333">Upload Image:</label>
            <div class="col-sm-6">
              <input type="file" class="form-control" id="txt">
            </div>
          </div>
        </form>
        </div>
        <div class="modal-footer">
        <center><button class="btn btn-primary col-sm-offset-5 col-sm-3">Add Member</button></center>
        </div></div></div>
        </div>
        </div>
      </div>

      <div class="panel-body">
          @if( count($users) > 0 )
                
          <br/>
      <div class="row">
          
          @foreach ($users as $user)
          <div class="col-md-2">
                      <div class="panel panel-default member">
                        <div class="panel-body text-left">
                              <div class="row">
                                  <div class="col-md-12">
                                      <center>
                                          <a class="" href="#">
                                              @if($user->Image == 'NA')
                                              <img src="{{ url('public/images/profile.png') }}" class="img-circle member_img">
                                              @else
                                              <img src="{{ $user->Image }}" class="img-circle member_img">
                                              @endif
                                          </a>
                                      </center>
                                  </div>
                                  <div class="col-md-12">
                                    <h5 style="text-align:center" class="names"><b>{{ $user->UserName }}</b></h5>
                                  </div>
                                  <div class="col-md-12">
                                      <center><a href="{{ url('user/'.$user->ShortName) }}"><button class="btn btn-primary"><i class="fa fa-eye" style="color:"></i> View</button></a></center>
                                  </div>
                              </div>
                          </div>

                      </div>
                  </div>
                  
@endforeach
<center><ul class="pagination">
  {{$users->links()}}
</ul></center>
@else
<h4>No Members Yet</h4>
@endif
              </div>
              

</div>
</div>
</div>
</div>


<!--members List code ends here -->
@endsection