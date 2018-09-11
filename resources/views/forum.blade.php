@extends('layouts.main')
@section('content')
 <!-- social Communication code starts here -->
<div class="container" id="main-code">
<br/>    
<ol class="breadcrumb" style="background:#46A6EA;">
   @if($category== '') 
  <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ url('/socialnetwork') }}">Social Network</a></li>
  <li class="breadcrumb-item active">Forum</li>
  @else
  <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ url('/socialnetwork') }}">Social Network</a></li>
  <li class="breadcrumb-item active"><a href="{{ url('/forum') }}">Forum</a></li>
  <li class="breadcrumb-item active">{{ $category }}</li>
  @endif
</ol>
  <section class="main" style="margin-top:20px">
    <section class="tab-content">
      <section class="tab-pane active fade in active">
        <div class="row" id="dashboard-mob">
          <div class="panel-body">
  <div class="col-xs-12 col-sm-12">
      <div class="panel panel-default magic-element isotope-item">
                <div class="panel-body-heading edituser_panel">
                    <h4 class="pb-title" style="padding:5px">Forum <span class="badge" id="badge"> {{ $allquestions[0]->count }}</span></a></h4>
                    <div class="form-group">
                    <div class="col-sm-3">
                        
                      <select class="form-control" id="rselect">
                        <option>Select Topic</option>
                         @foreach($topics as $topic)
                        <option @if( $category == strtolower($topic->Topic)) selected @endif>{{ strtolower($topic->Topic) }}</option>
                        @endforeach
                      </select>
                      
                    </div>
                      </div>
                      <div class="form-group">
    <div class="col-sm-3">
        <form method="post" action="{{ url('forum') }}">    
            {{ csrf_field() }}
    <input type="search" name="search" class="form-control" placeholder="Search.." style="margin-top:-5px"></input>
        </form>
  </div>
    <div class="col-sm-3">                      
    <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal1">Ask Forum</button>   
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal1" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h5 style="color:#fff;background-color:#46A6EA;padding:5px;margin-top:30px">Ask Forum</h5>
<div class="modal-body">
<form class="form-horizontal" method="post" action="{{ url('forumquestion') }}">
  {{ csrf_field() }}  
  <div class="form-group">
    <label class="control-label col-sm-4" for="txt" style="color:#333">Topic:</label>
    <div class="col-sm-6">
      <select class="form-control" name="topic">
                         @foreach($topics as $topic)
                        <option @if( $category == strtolower($topic->Topic)) selected @endif value="{{ strtolower($topic->Topic) }}">{{ strtolower($topic->Topic) }}</option>
                        @endforeach
                      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="txt"  style="color:#333">Question:</label>
    <div class="col-sm-6">
      <textarea type="text" rows="15" class="form-control" id="txt" name="question" required></textarea>
    </div>
  </div>
</div>
<div class="modal-footer">
    <center><button class="btn btn-primary col-sm-offset-6 col-sm-2" type="submit">Post</button></center>
</div></form></div></div></div>
</div>
</div><br>
<div class="panel-body">
    <div class="table table-responsive table-container">
       @if(count($questions)>0)
      <table class="table table-striped table-bordered table-hover" id="sample_3">
        <thead>
          <tr>
            <th> Questions</th>
            <th> Topic</th>
            <th> Replies</th>
            <th> Views </th>
          </tr>
        </thead>
        <tbody>
         
          @foreach($questions as $question)
          <tr>
          <td id="mns">
            <h5>
              <a id="mrs" href="{{url('forumanswers/'.$question->QuestionId)}}">
                {{$question->Question}} </a>
            </h5>
            <span id="mash">
    	    @if($question->Image == "NA")
            <img src="{{ url('public/images/profile.png')}}" class="img-circle" height="40px" width="40px"/>
            @else
            <img src="{{ url('public/'.$question->Image)}}" class="img-circle" height="40px" width="40px"/>
            @endif
                
    					<i class="fa fa-calendar" style="color:#ff6600;font-size:18px"></i> <b style="color: #000;font-weight:normal; font-size:12px;"> {{$question->DateTime}}</b>
    				</span></td>
            <td>
              {{$question->Topic}}
            </td>
            <td> &nbsp;<span id="count_{{ $question->QuestionId }}">..</span>                                                                </td>
      <td>
      <i class="fa fa-eye" style="color:#46A6EA;font-size:18px"></i>
        {{$question->View}}
      </td>
      </tr>
      @endforeach
      </tbody>
</table>
              </div>
              <center><ul class="pagination">
                {{$questions->links()}}
              </ul></center>
              @else
              <h4>No Questions to Display</h4>
              @endif
</div>
</div>
</div>


    <!-- Modal -->
    <div class="modal fade" id="myModal4" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" style="height:500px">
    <div class="modal-header">
  <div class="col-xs-12 col-sm-12" id="add_member">
      <div class="panel panel-default magic-element isotope-item">
                <div class="panel-body-heading edituser_panel">
                    <h4 class="pb-title" style="padding:12px">Group Name(0 members)
<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal5" style="border:1px solid #fff;margin-top:-10px" id="add_btn">Add Members</button></h4>
  <!-- Modal -->
  <div class="modal fade" id="myModal5" role="dialog">
  <div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>

  <div class="modal-body">
  <form class="form-horizontal">
    <div class="form-group">
      <label class="control-label col-sm-4" for="txt" style="color:#333">Group Name:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="txt">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-4" for="txt" style="color:#333">Member Name:</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="txt">
      </div>
    </div>
  </form>
  </div>
  <div class="modal-footer">
  <center><button class="btn btn-primary col-sm-offset-5 col-sm-4">Update Group</button></center>
  </div></div></div>
  </div>
  </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
  <br>
  <div class="panel-body">
  <div class="table table-responsive table-container">
  </div>
  </div>
  </div>
    </div>
  </section>
  </section>
  </section>
</div>
 <!-- social Communication code ends here -->
 <script>
 $('#rselect').on('change', function() {
  //window.location('{{ url('forum/')}}'+this.value);
  //alert(this.value);
  window.location.href = '{{ url('forum')}}/'+this.value; 
});
 @foreach ($questions as $question)
console.log('{{ url('answerscount/'.$question->QuestionId) }}');
                               $.ajax({
                                   url: '{{ url('answerscount/'.$question->QuestionId) }}',
                                   success: function(html) {
                                   console.log(html);    
                                   $("#count_{{ $question->QuestionId }}").html(html);
                                      
                                   },
                                   async:true
                                 });
              @endforeach   
 </script>
 @endsection