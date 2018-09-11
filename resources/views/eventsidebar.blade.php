<div class="col-xs-12 col-sm-4">
<img class="img-responsive event_image" id="event_image" src="{{ url('public/images/event.jpg') }}" alt="event"/>
@if(count($eventsubscriptions)>0)
@if($eventsubscriptions[0]->Status == 'pending')
<center><a href="{{url('subscribed/'.$events[0]->ShortName)}}"><button class="btn btn-primary" style="margin-top: 20px">Subscribed</button></a>
@elseif($eventsubscriptions[0]->Status == 'rejected')
<a href="{{url('subscribed/'.$events[0]->ShortName)}}"><button class="btn btn-primary" style="margin-top: 20px">Rejected</button></a>
 @elseif($eventsubscriptions[0]->Status == 'accepted')
 <a href="{{url('subscribed/'.$events[0]->ShortName)}}"><button class="btn btn-primary" style="margin-top: 20px">Accepted</button></a></center>
@endif
@else
 <center><a href="{{url('subscribed/'.$events[0]->ShortName)}}"><button class="btn btn-primary" style="margin-top: 20px">Subscribe</button></a>
@endif
&nbsp;

@if(count($flag)>0)
 <div class="col-sm-3"><center><a href="{{url('event/'.$events[0]->ShortName)}}"><button class="btn btn-primary" style="margin-top: 20px"><i class = "fa fa-flag"></i> Flaged</button></a></div>
     @else
      <div class="col-sm-3"><center><a href="{{url('event/'.$events[0]->ShortName.'/flag')}}"><button class="btn btn-primary" style="margin-top: 20px"><i class = "fa fa-flag"></i> Flag</button></a></div>
          @endif
</div>

<script>
           
            console.log('{{ url('getimages/event/'.$events[0]->EventId) }}');
            $.ajax({
                url: '{{ url('getimages/event/'.$events[0]->EventId) }}',
                success: function(html) {
                  if(html=="no") {
                  } else {
                    console.log(html);

                      $('#évent_image').attr("src",html);
                  }
                },
                async:true
              });
</script>