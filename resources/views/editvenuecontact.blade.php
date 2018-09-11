@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin-left:13px;text-align:center ">
    {!! session('message.content') !!}
    </div>
    @endif

    <div class="container">
  <h5 class="add_venue"><a href="#"><button class="btn btn-primary" style="background-color:#fff;color:#46A6EA"><i class="fa fa-plus"></i></button></a> Add Venue</h5>
      <div class="row" style="border:1px solid #eee">
             <div class="board">
                 <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                 <div class="board-inner  iconlist">
                 <ul class="nav nav-tabs nav_info" id="myTab">
                 <div class="liner"></div>
                  <li>
                  <a href="" class="tab-one" title="Venue Summary">
                   <span class="round-tabs">
                           <i class="fa fa-list"></i>
                   </span>
               </a></li>

               <li><a href="" title="Pool Information">
                  <span class="round-tabs">
                      <i class="fa fa-info"></i>
                  </span>
        </a>
              </li>
               <li><a href="" data-toggle="tab" title="Address">
                  <span class="round-tabs">
                       <i class="fa fa-map-marker"></i>
                  </span> </a>
                  </li>
                  
                  <li class="active"><a href="{{url('venueaddress/'.$venue_id)}}" data-toggle="tab" title="Contact">
                  <span class="round-tabs">
                       <i class="fa fa-phone"></i>
                  </span> </a>
                  </li>

                  <li><a href="" title="Open hours & Facilities">
                      <span class="round-tabs">
                           <i class="fa fa-clock-o"></i>
                      </span>
                  </a></li>
                  <li><a href="" title="Web site & Social Links">
                      <span class="round-tabs">
                           <i class="fa fa-share-alt"></i>
                      </span>
                  </a></li>

                  <li><a href="" data-toggle="tab" title="Confirm Venue">
                      <span class="round-tabs">
                           <i class="fa fa-check"></i>
                      </span> </a>
                  </li>

                  </ul></div>
                   <div class="tab-pane fade in active" id="venuecontact">
                    @foreach($contacts as $contact)
                     <form class="form-horizontal" style="background:#fff;" method="post" action="{{ url('edit-venuecontact/'.$venue_id.'/'.$contact->ContactId) }}">
                        {{csrf_field()}}
                                <div class="row">
                                      <div class="form-group">
                                           <label class="control-label col-xs-4 col-sm-offset-2 col-sm-2" for="txt">Contact Name:</label>
                                        <div class="col-xs-7 col-sm-6">
                                        <input type="text" class="form-control" id="venuecontact" name="contact_name" value="{{$contact->FirstName}}"  required>
                                        <span class="contact-error" style="color: red;display: none;">Contact Name should contain 3-25 Characters.</span>
                                       </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label  col-xs-4 col-sm-offset-2 col-sm-2" for="email">Mobile:</label>
                                      <div class="col-xs-7 col-sm-6">
                                        <input type="text" class="form-control" id="venue-mobile" name="mobile" value="{{$contact->Phone}}" required>
                                        <span class="mobile-error" style="color: red;display: none;">Mobile number should contain 10 digits.</span>
                                      </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label  col-xs-4 col-sm-offset-2 col-sm-2" for="email">Email:</label>
                                      <div class="col-xs-7 col-sm-6">
                                          <input type="email" class="form-control" id="email" name="email" value="{{$contact->Email}}" required>
                                      </div>
                                      </div>
                                      @endforeach
                                       <!-- <button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add Another Contact</button><br>-->
                              <center>
                              <button class="btn btn-primary mybtn">Save</button>
                              
                            </center>
                               </form>  <hr>
                               <form class="form-horizontal" style="background:#fff;" method="post" action="{{ url('edit-venuecontact/'.$venue_id.'/'.$contact->ContactId) }}">
                        {{csrf_field()}}
                                <div class="row">
                                      <div class="form-group">
                                           <label class="control-label col-xs-4 col-sm-offset-2 col-sm-2" for="txt">Contact Name:</label>
                                        <div class="col-xs-7 col-sm-6">
                                        <input type="text" class="form-control" id="venuecontact" name="new_contact"  required>
                                        <span class="contact-error" style="color: red;display: none;">Contact Name should contain 3-25 Characters.</span>
                                       </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label  col-xs-4 col-sm-offset-2 col-sm-2" for="email">Mobile:</label>
                                      <div class="col-xs-7 col-sm-6">
                                        <input type="text" class="form-control" id="venue-mobile" name="new_mobile" required>
                                        <span class="mobile-error" style="color: red;display: none;">Mobile number should contain 10 digits.</span>
                                      </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="control-label  col-xs-4 col-sm-offset-2 col-sm-2" for="email">Email:</label>
                                      <div class="col-xs-7 col-sm-6">
                                          <input type="email" class="form-control" id="venue-email" name="new_email" required>
                                      </div>
                                      </div>
                                     
                                       <!-- <button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add Another Contact</button><br>-->
                              <center>
                                <button class="btn btn-primary mybtn" type="reset">Back</button>
                              <button class="btn btn-primary mybtn">Save</button>
                              
                            </center>
                               </form>
                                 </div>
                           </div>
                         </div>
                       </div>
                       </div>
   <div id="old_events">
                
                </div>
                     </div>
                 
  <script>
$(document).ready(function() {
console.log('{{ url('getoldvenues/address/'.$venue_id) }}');
$.ajax({
    url: '{{ url('getoldvenues/address/'.$venue_id) }}',
    success: function(html) {
      if(html=="no") {
      } else {
        console.log(html);
        //$('#old_events').attr("src",html);
        $('#old_events').html(html);
      }
    },
    async:true
  });
              });
$(document).ready(function() {
   
  
  var options = {
    data:[
      {"FirstName": "FirstName",
       "Phone":"Phone",
       "Email":"Email"}
    ],
  url: function(phrase) {
    return "{{ url('contactvenue/contact') }}/"+phrase;
  },
  getValue: "FirstName",
   list: {
    onSelectItemEvent: function() {
      var value = $("#venuecontact").getSelectedItemData().Phone;
      var email = $("#venuecontact").getSelectedItemData().Email;
      
      $("#venue-mobile").val(value).trigger("change");
      $("#venue-email").val(email).trigger("change");
     }
  }
  };
  $("#venuecontact").easyAutocomplete(options); 
});
</script> 
                                 @endsection