@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
  <!-- Friends List code starts here -->
   <div class="container" id="main-code">
   <br/>    
<ol class="breadcrumb" style="background:#46A6EA;">
  
  <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ url('/socialnetwork') }}">Social Network</a></li>
  <li class="breadcrumb-item active">Friends</li>
  
</ol>        
   <section class="main" style="margin-top:20px">
     <div class="col-xs-12 col-sm-12">
      <ul class="nav nav-tabs preview_tabs">
      <li ><a href="{{url('friendlist')}}">All Users</a></li>
      <li class="active"><a href="{{url('/myfriend')}}">My Friends</a></li>
        </ul>
        <div class="tab-content tab_details">
         <div class="tab-pane fade in active" id="myfriends">
          <div class="panel panel-default magic-element isotope-item">
          <div class="panel-body">
           <div class="row">
            @if(count($friends)>0)
           @foreach($friends as $user)
           <div class="col-xs-12 col-md-2" style="border: 1px solid #eee;margin:5px;">
            @if($user->Image == "NA")    
            <img src="{{ url('public/images/profile.png') }}" class="img-rounded pull-left" alt="user" height="60px" width="60px"/>
            @else
            <img src="{{ $user->Image }}" class="img-rounded pull-left" alt="user" height="60px" width="60px"/>
            @endif
            <span style="margin:5px;">
            &nbsp;<b>{{ substr($user->UserName,0,10) }}</b><br/>
            &nbsp;<a href="{{url('addfriend/'.$user->UserId)}}"><button class="btn btn-xs btn-danger">Remove</button></a>
            </span>
            </div>
                  @endforeach
                </div>
               
                    <center><ul class="pagination">
               {{ $friends->links() }}
             </ul></center>
             @else
             <h4>Friends not Added</h4>
             @endif
           </div>
         </div>
       </div>
         </div>
         </div>            
</div>
</div>
</section>
</div>


<!--Friends List code ends here -->
@endsection