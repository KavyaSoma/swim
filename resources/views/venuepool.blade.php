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

               <li class="active"><a href="{{url('venuepool')}}" title="Pool Information">
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
                  <li><a href="" data-toggle="tab" title="Contact">
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
                   
                  <div class="tab-pane fade in active" id="venueinformation">
                    <form class="form-horizontal" style="background:#fff;" method="post" action="{{url('venuepool/'.$venue_id)}}" enctype="multipart/form-data">
                      {{csrf_field()}}
                      <div class="row">
                            <div class="form-group" id="field1">
                                  <label class="control-label col-xs-4 col-sm-offset-2 col-sm-2" for="txt">Pool Name:</label>
                                  <div class="col-xs-7 col-sm-6">
                                    <input type="text" class="form-control" id="pool-name" name="pool_name"required>
                                  </div>
                                  <br><br>
                                </div>

                      <div class="form-group">
                          <label class="control-label col-xs-4 col-sm-offset-2 col-sm-2" for="txt">Pool Width:</label>
                          <div class="col-xs-4 col-sm-4">
                            <input type="text" class="form-control" id="pool-width" name="pool_width" required>
                            <span class="pool-width-error" style="color: red;display: none;">Pool Width should contain Numeric Values</span>
                          </div>
                          <div class="col-xs-4 col-sm-2">
                            <select  class="form-control pool" id="width-dimensions" name="width_dimension">
                              <option value="mts">mts</option>
                              <option value="fts">fts</option>
                              <option value="yard">yard</option>
                            </select>
                          </div>
                          <br>
                        </div>
                        <div class="form-group">
                            <label class="control-label  col-xs-4 col-sm-offset-2 col-sm-2" for="txt">Pool Length:</label>
                            <div class="col-xs-4 col-sm-4">
                              <input type="text" class="form-control" id="pool-length" name="pool_length" required>
                              <span class="pool-length-error" style="color: red;display: none;">Pool Length should contain Numeric Values</span>
                            </div>
                            <div class="col-xs-4 col-sm-2">
                              <select  class="form-control length" id="height-dimensions" name="length_dimension">
                                <option value="mts">mts</option>
                              <option value="fts">fts</option>
                              <option value="yard">yard</option>
                              </select>
                            </div>

                          </div>
                          <div class="form-group">
                              <label class="control-label col-xs-4 col-sm-offset-2 col-sm-2" for="txt">Shallow End:</label>
                              <div class="col-xs-4 col-sm-4">
                                <input type="text" class="form-control" id="shallow-end" name="shallow_end" required>
                                <span class="shallow-end-error" style="color: red;display: none;">Shallow End should contain Numeric Values</span>
                              </div>
                              <div class="col-xs-4 col-sm-2">
                                <select  class="form-control shallow" id="sel" name="shallow_dimension">
                                  <option value="mts">mts</option>
                              <option value="fts">fts</option>
                              <option value="yard">yard</option>
                                </select>
                              </div>

                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-4 col-sm-offset-2 col-sm-2" for="txt">Deep End:</label>
                                <div class="col-xs-4 col-sm-4">
                                  <input type="text" class="form-control" id="deep-end" name="deep_end" required>
                                   <span class="deep-end-error" style="color: red;display: none;">Deep End should contain Numeric Values</span>
                                </div>
                                <div class="col-xs-4 col-sm-2">
                                  <select  class="form-control deep" id="sel" name="deep_dimension">
                                    <option value="mts">mts</option>
                              <option value="fts">fts</option>
                              <option value="yard">yard</option>
                                  </select>
                                </div>

                              </div>
                              <div class="form-group" id="field1">
                                  <label class="control-label col-xs-4 col-sm-offset-2 col-sm-2" for="txt">Pool Shape:</label>
                                  <div class="col-xs-7 col-sm-6">
                                    <select class="form-control shape" id="pool-shape" name="pool_shape" onchange="poolarea()" required>
                                      <option>select</option>
                                      <option value="Rectangular">Rectangular</option>
                                      <option value="Triangular">Triangular</option>
                                    </select>
                                  </div>
                                  <br><br>
                                </div>
                              <div class="form-group">
                                  <label class="control-label col-xs-4 col-sm-offset-2 col-sm-2" for="txt">Pool Area:</label>
                                  <div class="col-xs-6 col-sm-6">
                                    <input type="text" class="form-control" id="pool-area" name="pool_area" readonly>
                                  </div>
                                 
                                </div>
                                <div class="form-group">
                         <label class="control-label col-xs-4 col-sm-offset-2 col-sm-2" for="description" required>Description:</label>
                         <div class="col-xs-7 col-sm-6">
                           <textarea class="form-control" id="txt" name="description"></textarea>
                         </div>
                       </div>
                       <div class="form-group">
             <label class="control-label col-xs-4 col-sm-4" for="imgUpload">Image:</label>
               <div class="col-xs-8 col-sm-4">
                   <input class="form-control myful" id="imgUpload" name="imgUpload" accept="image/*" type="file"><span class="col-xs-8 btn btn-default mob-block desk-none tab-none" style="margin-top: 2%;"> <i class="fa fa-edit" style="color:#ff6600" title="Edit"> </i> Edit Image</span>
               </div>
                <div class="col-xs-1 col-sm-2">
                   <button class="btn btn-default mob-none fa fa-edit"> <i title="Edit"></i> Edit Image</button>
                    
               </div>
             </div>

<div class="col-xs-offset-4 col-sm-offset-4 col-xs-4 col-sm-4 col-offset-sm-4 col-xs-offset-4 mypic mob-none">

                <img src="http://localhost/nswimmiq/public/images/taylor.png" alt="img" class="img-thumbnail" style="height: 132px;" width="100%">
             </div> 
                                           </div><br>
                     
                      <div class="col-xs-offset-2 col-xs-10 col-sm-offset-6 col-sm-6">
                    <button class="btn btn-primary mybtn" type="reset">Back</button>
                             <button class="btn btn-primary add-pool mybtn">Save</button>
                             

                             </div>

                        </form>
                                </div>
                                </div>
                              </div>
  <div id="old_events">
                
                </div>
                            </div>
  <script>
$(document).ready(function() {
console.log('{{ url('getoldvenues/poolinfo/'.$venue_id) }}');
$.ajax({
    url: '{{ url('getoldvenues/poolinfo/'.$venue_id) }}',
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
 
function poolarea() {
  var poolwidth = $("#pool-width").val();
 var poollength = $("#pool-length").val();
 var shallowend = $("#shallow-end").val();
 var deepend = $("#deep-end").val();
 var selectedPool = $(".pool option:selected ").val();
 var selectedlength = $(".length option:selected ").val();
 var selectedshallow = $(".shallow option:selected ").val();
 var selecteddeep = $(".deep option:selected").val();
 var shape = $(".shape option:selected").val();
if(selectedPool!="fts" && selectedPool!="mts"){
  var pool = poolwidth*3;
}
else if(selectedPool!="fts" && selectedPool!="yards"){
  var pool = poolwidth*3.28;
}
else{
  var pool = poolwidth;
}
if(selectedlength!="fts" && selectedlength!="mts"){
  var length = poollength*3;
}
else if(selectedlength!="fts" && selectedlength!="mts"){
  var length = poollength*3.28;
}
else{
  var length = poollength;
}
if(selectedshallow!="fts" && selectedshallow!="mts"){
  var shallow = shallowend*3;
}
else if(selectedshallow!="fts" && selectedshallow!="mts"){
  var shallow = shallowend*3.28;
}
else{
  var shallow = shallowend;
}
if(selecteddeep!="fts" && selecteddeep!="mts"){
  var deep = deepend*3;
}
else if(selecteddeep!="fts" && selecteddeep!="mts"){
  var deep = deepend*3.28;
}
else{
  var deep = deepend;
}
if(shape == "Rectangular"){
    var area = pool*length;
    console.log(area);
    document.getElementById('pool-area').value = area+' '+'fts';
 }
 if(shape == "Triangular"){
  var area = (pool*length)/2;
  console.log(area);
  document.getElementById('pool-area').value = area+' '+'fts';
 }
}

</script>                        

 @endsection