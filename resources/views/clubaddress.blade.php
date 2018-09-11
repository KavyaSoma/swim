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
               <li class="active">
                 <a href="#" title="Address">
                    <span class="round-tabs">
                      <i class="fa fa-map-marker"></i>
                   </span>
                </a>
               </li>
                <li>
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
<div class="tab-pane fade in active" id="address">
    <form class="form-horizontal" style="background:#fff;padding:35px" method="post" action="{{url('clubaddress/'.$club_id)}}">
      {{csrf_field()}}
        <div class="col-sm-12">
            <div class="form-group">
              <label class="control-label col-sm-4" for="txt">Address:</label>
            <div class="col-sm-6">
             <textarea class="form-control" id="txt" name="club_address" required>{{ old('club_address')}}</textarea>
           </div>
           </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="txt">City:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="club-city" name="city" value="{{old('city')}}" pattern="([A-zÀ-ž\s]){3,25}" required>
                    <span class="error" style="color:red;display:none;">City Should contain only 3-25 characters</span>
                  </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="txt">Post code:</label>
                  <div class="col-sm-6">
                      <input type="text" class="form-control" id="post-code" name="post_code" value="{{old('post_code')}}" pattern="([0-9]){4,9}" placeholder="Eg:67543" required>
                      <span class="post-error" style="color:red;display:none;">Invalid Post Code(Only digits accepted)</span>
                  </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="txt">Town:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="club-town" name="town" value="{{old('town')}}" pattern="([A-zÀ-ž\s]){3,25}" required>
                    <span class="town-error" style="color:red;display:none;">Town Should contain only 3-25 characters</span>
                  </div>
           </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="txt">Country:</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="club-country" name="country" value="{{old('country')}}" pattern="([A-zÀ-ž\s]){3,25}" required>
                      <span class="country-error" style="color:red;display:none;">Town Should contain only 3-25 characters</span>
                    </div>
            </div>
            <center>
               <a href="{{url('/editclub/'.$club_id)}}" class="btn btn-primary">Back</a>
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