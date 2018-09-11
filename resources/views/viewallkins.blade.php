@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margi-left:13px;">
    {!! session('message.content') !!}
    </div>
    @endif
    <!-- view kin code starts here -->
   @include('usermenu')
        <hr>
  <h5 style="background-color:#46A6EA;color:#fff;padding:5px">View Kins</h5>
  <div class="container-fluid" style="border:1px solid #d4d4d4;padding:15px;">
<div class="row">
  @foreach($participants as $participant)
  <div class="col-md-3 col-xs-6 col-sm-4 book-now-img">
      <a href="#">
                    <div class="book-img-thumb">
                      @if($participant->Image == "NA")
                       <img src="{{url('images/swim8.jpg')}}"/>
                       @else
                         <img src="images/swim8.jpg"/>
                         @endif
                   <div class="swim-curve">
                       <div class="swim-curve-img">
                       </div>
                       <div class="swim-rate swim-rate-orange">
                        <span>5</span>
                       </div>
                       <div class="swim-name">
                           <span class="m-name">{{$participant->ParticipantName}}</span>

                       </div>
                       <div class="swim-lang">
                           <span>Location</span>
                       </div>
                   <div class="swim-det">
                       <div class="swim-genre">
                            <ul class="list-inline">
                               <li>Detail</li>
                               <li>Detail</li>
                               <li>Detail</li>
                           </ul>
                       </div>

                    </div>
                </div>
          <a href="{{url('editkin/'.$participant->ParticipantId)}}" class="btn btn-primary edit_button col-xs-12 col-sm-6">
                <i class="fa fa-edit"></i> Edit

               </span>
           </a>

           <a href="{{url('kininformationpage/'.$participant->ParticipantId)}}" class=" btn btn-primary delete_button col-xs-12 col-sm-6">
                  <i class="fa fa-eye"></i>  View

                </span>
            </a>
       </div>
   </div>
   @endforeach
   
   
   </div>
   @if(count($participants)>0)
   <div class="text-center">
     <ul class="pagination">
 {{ $participants->links() }}
</ul>
</div>
</div>
  @endif
</div>
</div>
</div>
  <!-- view kin code ends here -->
@endsection