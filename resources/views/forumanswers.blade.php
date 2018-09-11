@extends('layouts.main')
@section('content')
 <!-- forum question code starts here -->
 <div class="container" id="main-code">
   <section class="main" style="margin-top:20px">
      <div class="row" id="dashboard-mob">
        <div class="col-xs-12 col-sm-8">
                         <div class="panel panel-default magic-element isotope-item">
                                   <div class="panel-body-heading edituser_panel">
                                       <h4 class="pb-title" style="padding:5px">Forum Question</h4>
                                     </div>
                                     <div class="row" style="margin:0">
                                       <div class="col-lg-11">
                                         <div class="ui-block">
                                           <article class="hentry post">
                                             <div class="m-link">
           <a href="#"  target="_blank" style="color:#46A6EA;">
            @foreach($questions as $question)
             <h4>
            {{$question->Question}}</h4></a>
            @endforeach
         </div><hr>
         @foreach($answers as $answer)
         <div class="post__author author vcard inline-items">
           @if($question->Image == "NA")
            <img src="{{ url('public/images/profile.png')}}" class="img-circle" height="40px" width="40px"/>
            @else
            <img src="{{ url('public/'.$question->Image)}}" class="img-circle" height="40px" width="40px"/>
            @endif
           <small class="author-date">
             <a class="h6 post__author-name fn" href="#">User</a> |
             <small class="post__date">
               <time class="published" datetime="2004-07-24T18:18" style="font-size:12px">
                 {{ $question-> DateTime}}
               </time>
             </small>
           </small>
<div class="more">
  <a href="#">
  <span class="glyphicon glyphicon-option-vertical"></span>
  </a>
 </div>
</div>
<p>{!! $answer->Answer !!}
  </p>
  
</article><hr>
@endforeach
  </tr>
  <tr></tr>
  </tbody>
  </table>
  </div>
  </div>
</div>
<h3 style="margin:0">Post Answer</h3><br><br>
<div class="row">

                              <form method="post" class="form-horizontal" action="{{url('forumanswers/'.$question_id)}}" method="post">
                                {{csrf_field()}}
                                  <div style="margin:0 5px 0 25px;">
                                      <div class="form-group">

                                          
                                            <textarea class="form-control" rows="10" name="message" placeholder="Your Answer Here" id="seditor" style="width:90%;" required>
                                              <!--<textarea name="message" data-provide="markdown" rows="10" data-width="600" class="form-control md-input" required="" style="width: 600px; resize: none;">-->
                                                
                                              </textarea>
                                          
                                      </div>
                                      <div class="form-action">
                                          <button class="btn btn-primary">Submit</button>
                                        </div>
                                                                          </div>
                                  <!--// <meta http-equiv="refresh" content="10;url=forum_answers.php" />-->

                              </form>

                          </div><br>
</div>
</div>
<div class="col-sm-4">
<div class="panel panel-default magic-element isotope-item">
          <div class="panel-body-heading edituser_panel">
            <h4 style="padding:5px">Categories</h4>
          </div>
            <div class="table table-responsive">
            <table class="table table-striped">
              <tbody>
                @foreach($topics as $topic)
                  <tr>
                    <td>
<a href="{{ url('forum/'.strtolower($topic->Topic)) }}" style="color:#46A6EA;">
<h5>{{$topic->Topic}}</h5></a>
</td></tr>

@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>

</div>
</div>
</section>
</section>
  </section>
</div>
</div>
</div>
</section>
</div>
@endsection