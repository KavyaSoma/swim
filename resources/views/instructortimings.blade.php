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
                     <li  class="active">
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
                       <li>
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
                      
           <div class="tab-pane fade in active" id="instructor_timings">
          
  <form class="form-horizontal  col-sm-offset-2 col-sm-10" method="post" action="{{url('instructortimings/'.$id)}}" style="background:#fff;">
    {{csrf_field()}}
     <div class="row">
    
  <div class="col-sm-2">
    <label class="checkbox-inline"> 
    <input type="checkbox" name="monday[]" value="monday">Monday
        
        </label>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label class="control-label col-sm-3" for="tme">From:</label>
          <div class="col-sm-2">
            <div class="input-group">
                <input type="time" class="form-control" id="tme" name="monday[]">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
            </div>
          </div>
          </div>
        </div>
<div class="col-sm-4">
          <div class="form-group">
          <label class="control-label col-sm-3" for="tme">To:</label>
          <div class="col-sm-2">
            <div class="input-group">
                <input type="time" class="form-control" id="tme" name="monday[]">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
            </div>
          </div>
          </div>
</div>
</div>
<div class="row">
<div class="col-sm-2">
<label class="checkbox-inline">
     <input type="checkbox" name="tuesday[]" value="tuesday">Tuesday
   </label>
 </div>
 <div class="col-sm-4">
   <div class="form-group">
     <label class="control-label col-sm-3" for="tme">From:</label>
     <div class="col-sm-2">
       <div class="input-group">
           <input type="time" class="form-control" id="tme" name="tuesday[]">
           <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
       </div>
     </div>
     </div>
   </div>
<div class="col-sm-4">
     <div class="form-group">
     <label class="control-label col-sm-3" for="tme">To:</label>
     <div class="col-sm-2">
       <div class="input-group">
           <input type="time" class="form-control" id="tme" name="tuesday[]">
           <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
       </div>
     </div>
     </div>
</div>

</div>
<div class="row">
<div class="col-sm-2">
<label class="checkbox-inline">
     <input type="checkbox" name="wednesday[]" value="wednesday">Wednesday
   </label>
 </div>
 <div class="col-sm-4">
   <div class="form-group">
     <label class="control-label col-sm-3" for="tme">From:</label>
     <div class="col-sm-2">
       <div class="input-group">
           <input type="time" class="form-control" id="tme" name="wednesday[]">
           <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
       </div>
     </div>
     </div>
   </div>
<div class="col-sm-4">
     <div class="form-group">
     <label class="control-label col-sm-3" for="tme">To:</label>
     <div class="col-sm-2">
       <div class="input-group">
           <input type="time" class="form-control" id="tme" name="wednesday[]">
           <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
       </div>
     </div>
     </div>
</div>

</div>
<div class="row">
<div class="col-sm-2">
<label class="checkbox-inline">
     <input type="checkbox" name="thursday[]" value="thursday">Thursday
   </label>
 </div>
 <div class="col-sm-4">
   <div class="form-group">
     <label class="control-label col-sm-3" for="tme">From:</label>
     <div class="col-sm-2">
       <div class="input-group">
           <input type="time" class="form-control" id="tme" name="thursday[]">
           <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
       </div>
     </div>
     </div>
   </div>
<div class="col-sm-4">
     <div class="form-group">
     <label class="control-label col-sm-3" for="tme">To:</label>
     <div class="col-sm-2">
       <div class="input-group">
           <input type="time" class="form-control" id="tme" name="thursday[]">
           <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
       </div>
     </div>
     </div>
</div>

</div>
<div class="row">
<div class="col-sm-2">
<label class="checkbox-inline">
     <input type="checkbox" name="friday[]" value="friday">Friday
   </label>
 </div>
 <div class="col-sm-4">
   <div class="form-group">
     <label class="control-label col-sm-3" for="tme">From:</label>
     <div class="col-sm-2">
       <div class="input-group">
           <input type="time" class="form-control" id="tme" name="friday[]">
           <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
       </div>
     </div>
     </div>
   </div>
<div class="col-sm-4">
     <div class="form-group">
     <label class="control-label col-sm-3" for="tme">To:</label>
     <div class="col-sm-2">
       <div class="input-group">
           <input type="time" class="form-control" id="tme" name="friday[]">
           <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
       </div>
     </div>
     </div>
</div>

</div>
<div class="row">
<div class="col-sm-2">
<label class="checkbox-inline">
     <input type="checkbox" name="saturday[]" value="saturday">Saturday
   </label>
 </div>
 <div class="col-sm-4">
   <div class="form-group">
     <label class="control-label col-sm-3" for="tme">From:</label>
     <div class="col-sm-2">
       <div class="input-group">
           <input type="time" class="form-control" id="tme" name="saturday[]">
           <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
       </div>
     </div>
     </div>
   </div>
<div class="col-sm-4">
     <div class="form-group">
     <label class="control-label col-sm-3" for="tme">To:</label>
     <div class="col-sm-2">
       <div class="input-group">
           <input type="time" class="form-control" id="tme" name="saturday[]">
           <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
       </div>
     </div>
     </div>
</div>

</div>
<div class="row">
<div class="col-sm-2">
<label class="checkbox-inline">
     <input type="checkbox" name="sunday[]" value="sunday">Sunday
   </label>
 </div>
 <div class="col-sm-4">
   <div class="form-group">
     <label class="control-label col-sm-3" for="tme">From:</label>
     <div class="col-sm-2">
       <div class="input-group">
           <input type="time" class="form-control" id="tme" name="sunday[]">
           <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
       </div>
     </div>
     </div>
   </div>
<div class="col-sm-4">
     <div class="form-group">
     <label class="control-label col-sm-3" for="tme">To:</label>
     <div class="col-sm-2">
       <div class="input-group">
           <input type="time" class="form-control" id="tme" name="sunday[]">
           <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
       </div>
     </div>
     </div>
</div>

</div>
  <center>

   
       <button type="submit" class="btn btn-primary"><a href="{{url('instructortimings/'.$id)}}">Save</a></button>
    
  

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