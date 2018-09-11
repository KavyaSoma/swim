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
      <li class="active"><a href="{{url('friendlist')}}" >All Users</a></li>
      <li><a href="{{url('myfriendlist')}}">My Friends</a></li>
        </ul>
        <div class="tab-content tab_details">
       <div class="tab-pane fade in active" id="allfriends">
       <div class="panel panel-default magic-element isotope-item">
          <div class="panel-body">

            <form method="post" action="{{url('friendlist')}}">
              {{csrf_field()}}
            <input type="text" class="form-control" name="search" placeholder="Search.."><br>
            <input type="submit" name="submit" style="display: none">
          </form>
            <div class="row">
               @if(count($allusers)>0)
              @foreach($allusers as $user)
              
            <div class="col-xs-12 col-md-2" style="border: 1px solid #eee;margin:5px;">
            @if($user->Image == "NA")    
            <img src="{{ url('public/images/profile.png') }}" class="img-rounded pull-left" height="60px" width="60px" alt="user" title="Add {{ $user->UserName }} to your friend list"/>
            @else
            <img src="{{ $user->Image }}" class="img-rounded pull-left" height="60px" width="60px" alt="user" title="Add {{ $user->UserName }} to your friend list"/>
            @endif
            <span style="margin:5px;">
            &nbsp;<b>{{ substr($user->UserName,0,10) }}</b><br/>
            &nbsp;<a href="{{url('addfriend/'.$user->UserId)}}"><button class="btn btn-xs btn-default" title="Add {{ $user->UserName }} to your friend list">+Add Friends</button></a>
            </span>
            </div>
              
                   @endforeach
                    </div>
                 
                 
                 
                   <center><ul class="pagination">
               {{ $allusers->links() }}
             </ul></center>
             @else
             <h4>No results Found</h4>
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