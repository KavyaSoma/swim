@extends('layouts.main')
@section('content')
<div class="row1">
@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger }}">
        {{ $error }}
        </div>
    @endforeach
@endif
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}">
    {!! session('message.content') !!}
    </div>
@endif
  <!-- kin code starts here -->
    <div class="container">
        <h5 class="add_venue"><a href="#"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button></a> Add Kin</h5>
  <div class="row" style="border:1px solid #eee">
      <div class="board">
        <div class="board-inner">
          <center><ul class="nav nav-tabs nav_info" id="myTab">
              <div class="liner"></div>
                <li class="active">
                  <a href="{{url('addkin')}}" class="tab-one" title="Kin Basic Details">
                    <span class="round-tabs">
                      <i class="fa fa-info"></i>
                    </span>
                   </a>
                 </li>
                   <li>
                      <a href="#" class="tab-one" title="Emergency Contact">
                        <span class="round-tabs">
                          <i class="fa fa-phone"></i>
                        </span>
                     </a>
                    </li>
              </ul></center>
          </div>
          <div class="tab-content tab_details">
              <div class="tab-pane fade in active" id="kin_basicdetails">
                    <form class="form-horizontal" method="post" action="{{ url('addkin') }}" style="background:#fff;padding:35px" enctype="multipart/form-data">
                      {{csrf_field()}}
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label class="control-label col-sm-4" for="txt">Kin Name:</label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" id="kinname" name="ParticipantName" required>
                         <span id="error" style="color: red;"></span>

                          </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-4" for="txt">Relation with User:</label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" id="kinrelation" name="Relationship" required>
                            <span id="relation-error" style="color: red;"></span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-4" for="dte">Date of birth:</label>
                            <div class="col-sm-4">
                              <input type="date" class="form-control" id="dte"  onblur="getAge()" name="DateofBirth">
                                 <span id="error-age" style="color: red;"></span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-4" for="txt">Gender:</label>
                            <div class="col-sm-4">
                              <label class="radio-inline"><input type="radio" name="Gender" value="male" required>Male</label>
                              <label class="radio-inline"><input type="radio" name="Gender" value="female" required>Female</label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-4" for="txt">Height:</label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" id="height" name="Height" required>
                            <span id="height-error" style="color: red;"></span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-4" for="txt">Weight(kgs):</label>
                            <div class="col-sm-4">
                              <input type="text" class="form-control" id="width" name="Weight" required>
                            <span id="width-error" style="color: red;"></span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-4" for="txt">Is Disabled:</label>
                          <div class="col-sm-4">
                          <label class="radio-inline"><input type="radio" id="yes" name="IsDisabled" value="yes">Yes</label>
                          <label class="radio-inline"><input type="radio" id="no" name="IsDisabled" value="no">No</label>
                          </div>
                          </div>

                          <div class="form-group" id="divdescription" style="display: none;">
                              <label class="control-label col-sm-4"  for="txt">Disability Description:</label>
                              <div class="col-sm-4">
                       <textarea class="form-control" id="description" name="DisabilityDescription"></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-4" for="txt">Special Requirements:</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" id="txt" name="SpecialRequirements">
                              </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="txt">Notes:</label>
                                <div class="col-sm-4">
                                  <textarea class="form-control" id="txt" name="Notes"></textarea>
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="control-label col-sm-4" for="file">Image:</label>
                                <div class="col-sm-4">
                                  <input type="file" class="form-control" id="imgUpload" name="imgUpload"  accept="image/*" required>
                                </div>
                               </div>
                              <center>
                                  <button type="reset" class="btn btn-primary">Cancel</button>
                                   <button type="submit" class="btn btn-primary" id="submitkin">Save and Continue</button>
                              </div>
                            </form>
                          </div>
              </div>
          </div>
        </div>
      </div>
      <!-- kin code ends here -->
      <script type="text/javascript">


$(function() {
  $("input[name='IsDisabled']").click(function() {
    if ($("#yes").is(":checked")) {
      $("#divdescription").show();
    } else {
      $("#divdescription").hide();
    }
  });
});


function getAge() {
var dateString = document.getElementById("dte").value;
if(dateString !="")
{
   var today = new Date();
   var birthDate = new Date(dateString);
   var age = today.getFullYear() - birthDate.getFullYear();
   var m = today.getMonth() - birthDate.getMonth();
   var da = today.getDate() - birthDate.getDate();
   if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
       age--;
   }
   if(m<0){
       m +=12;
   }
   if(da<0){
       da +=30;
   }
   
 if(age < 18 || age > 100)
{
  
$("#error-age").html("Age is Restricted.");
$("#submitkin").attr('disabled', 'disabled');

} else {
$('#submitkin').removeAttr('disabled');
$("#error-age").html("");

}
} else {
alert("please provide your date of birth");
}
}
$("#kinname").ready(function(){
var $regexname=/^([a-zA-Z_ ]{5,30})$/;
  $("#kinname").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $("#submitkin").attr('disabled', 'disabled');
      $('#error').html("Kin Name should contain 5-30 characters");
    }else{
      $('#submitkin').removeAttr('disabled');
      $('#error').html("");
    }
  });
});
$("#kinrelation").ready(function(){
var $regexname=/^([a-zA-Z_ ]{5,30})$/;
  $("#kinrelation").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $("#submitkin").attr('disabled', 'disabled');
      $('#relation-error').html("Relationship with Kin field is required");
    }else{
      $('#submitkin').removeAttr('disabled');
      $('#relation-error').html("");
    }
  });
});
$("#kinrelation").ready(function(){
var $regexname=/^([a-zA-Z_ ]{5,30})$/;
  $("#kinrelation").on('keypress keydown keyup',function(){
    if(!$(this).val().match($regexname)){
      $("#submitkin").attr('disabled', 'disabled');
      $('#relation-error').html("Relationship with Kin field is required");
    }else{
      $('#submitkin').removeAttr('disabled');
      $('#relation-error').html("");
    }
  });
});

</script>
      @endsection