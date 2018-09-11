@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
<!-- club-profile starts here -->

 <div class="container" id="main-code">
           <br/>
        <h5 style="background-color:#46A6EA;color:#fff;"><a href="{{url('addclub')}}"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button></a> Add Club</h5>

<div class="row" style="border:1px solid #eee">
  <div class="board">
    <div class="board-inner">
      <center><ul class="nav nav-tabs nav_info" id="myTab">
          <div class="liner"></div>
           <li>
              <a href="#" title="Basic Details">
                <span class="round-tabs">
                  <i class="fa fa-info"></i>
                </span>
               </a>
             </li>
               <li>
                 <a href="#" title="Address">
                    <span class="round-tabs">
                      <i class="fa fa-map-marker"></i>
                   </span>
                </a>
               </li>
                <li class="active">
                  <a href="#" title="Contact">
                    <span class="round-tabs">
                      <i class="fa fa-phone"></i>
                    </span>
                 </a>
                </li>
                 <li>
                   <a href="#" title="Social Links">
                      <span class="round-tabs">
                        <i class="fa fa-globe"></i>
                     </span>
                    </a>
                  </li>
                </ul></center>
                </div>
<div class="tab-content tab_details">
<div class="tab-pane fade in active" id="contact">
  <form class="form-horizontal" style="background:#fff;padding:35px" method="post" action="{{url('clubcontact/'.$clubid)}}">
    {{csrf_field()}}
      <div class="col-sm-12">
          <div class="form-group">
              <label class="control-label col-sm-4" for="txt">Mobile Number:</label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" id="club-mobile" name="mobile" placeholder="Eg:9876543210" pattern="([0-9]){10}" required>
                  <span class="mobile-error" style="color:red;display: none">Mobile Number should contain 10 digits</span>
            </div>
          </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="email">Email:</label>
                  <div class="col-sm-6">
                      <input type="email" class="form-control" id="email" name="email" required>
                  </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="txt">Web:</label>
                <div class="col-sm-6"> 
                  <input type="url" class="form-control" id="txt" name="web" placeholder="www.example.com" required>
                </div>
           </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="txt">Short Name:</label>
                  <div class="col-sm-6">
                      <input type="text" class="form-control" id="shortname" name="short_name" value="{{$shortname}}" readonly>
                   </div>
            </div>
            <center>
               <a href="{{url('/edit-clubaddress/'.$clubid)}}" class="btn btn-primary">Back</a>
                 <button class="btn btn-primary">Save and Continue</button>
                  <br><br>
            </div>
          </form>
        </div>
</div>
</div>
</div>
</div>

@endsection