@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margi-left:13px;">
    {!! session('message.content') !!}
    </div>
    @endif
    <div class="container">
  
        <div class="container">
        <h5 class="add_instructor"><a href="#"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button></a> Add Instructor</h5>
        <div class="row" style="border:1px solid #eee">
          <div class="board">
          <div class="board-inner instructor_tabs">
              <center><ul class="nav nav-tabs nav_info" id="myTab">
                  <div class="liner"></div>
                    <li>
                      <a href="#" class="tab-one" title="Basic Details">
                        <span class="round-tabs">
                          <i class="fa fa-info"></i>
                        </span>
                       </a>
                     </li>
                     <li>
                       <a href="#" title="Timings">
                          <span class="round-tabs">
                            <i class="fa fa-clock-o"></i>
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
                         <a href="#" title="Experience">
                            <span class="round-tabs">
                              <i class="fa fa-globe"></i>
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
                      </ul></center>
                        </div>
                      
         <div class="tab-pane fade in active" id="instrutor_experience">
  <form class="form-horizontal" method="post" action="{{url('instructorexperience/'.$id)}}" style="background:#fff;">
        {{csrf_field()}}

      <div class="col-sm-12">
        <input type="hidden" name="InstructorId" value="{{$id}}">
          <div class="form-group">
          
<label class="control-label col-sm-4" for="txt">Qualification:</label>
<div class="col-sm-6">
  <input type="text" class="form-control" id="txt" name="Qualification" required>
</div>
</div>
<div class="form-group">
<label class="control-label col-sm-4" for="txt">Specialization:</label>
<div class="col-sm-6">
  <input type="text" class="form-control" id="txt" name="Specialization"  required>
</div>
</div>
<div class="form-group">
  <label class="control-label col-sm-4" for="txt">Experience:</label>
  <div class="col-sm-6">
    <input type="number" class="form-control" id="txt" name="Experience"  required>
  </div>
  </div>
   <div class="form-group">
      <label class="control-label col-sm-4" for="txt">Gender:</label>
    <div class="col-sm-4">
    <label class="radio-inline"><input type="radio" name="Gender" value="Male">Male</label>
  <label class="radio-inline"><input type="radio" name="Gender" value="Female">Female</label>
  </div>
  </div>
   <div class="form-group">
     <label class="control-label col-sm-4" for="txt">Description:</label>
      <div class="col-sm-6">
        <textarea type="text" class="form-control" id="txt" name="Description" required></textarea>
      </div>
    </div>
    
  <center>
     <a href="{{url('instructoraddress/'.$id)}}" class="btn btn-primary">Back</a>
  <button type="submit" class="btn btn-primary">Save</button>

     
  </div>
  </form>
 
  </div>
</center>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection