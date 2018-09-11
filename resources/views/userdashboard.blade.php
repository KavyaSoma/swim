@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
 <!-- Dashboard code starts here -->
<div class="container" id="main-code">
  <section class="main" style="margin-top:20px">
  <div class="col-xs-12 col-sm-6">
                            <!-- /panel -->
                            <div class="panel panel-default magic-element isotope-item widgets">
                                  <div class="panel-body-heading" style="background: #46A6EA;margin-top:-20px;color:#fff">
                                      <h4 class="pb-title" style="padding:5px">Rank Count</h4>
                                  </div>
                                  <div id="chart-bar" class="chart" style="position: relative;">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="graph">
                                    <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.0</desc>
                                    <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                    <text x="43.5" y="231.97236815331252" text-anchor="end" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal">
                                    <tspan dy="4.167680653312516" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Swim Type 1</tspan>
                                  </text>
                                  <path fill="none" stroke="#aaaaaa" d="M56,231.97236815331252H411" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                  <text x="43.5" y="180.22927611498437" text-anchor="end" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal">
                                    <tspan dy="4.158963614984373" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Swim Type 2</tspan>
                                  </text>
                                  <path fill="none" stroke="#aaaaaa" d="M56,180.22927611498437H411" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                  <text x="43.5" y="128.48618407665626" text-anchor="end" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal">
                                    <tspan dy="4.165871576656258" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Swim Type 3</tspan>
                                  </text>
                                  <path fill="none" stroke="#aaaaaa" d="M56,128.48618407665626H411" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                  <text x="43.5" y="76.74309203832811" text-anchor="end" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal">
                                    <tspan dy="4.157154538328115" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Swim Type 4</tspan>
                                  </text>
                                  <path fill="none" stroke="#aaaaaa" d="M56,76.74309203832811H411" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                  <text x="43.5" y="25" text-anchor="end" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"> Swim Type 5</tspan>
                                  </text>
                                  <path fill="none" stroke="#aaaaaa" d="M56,25H411" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                  <text x="381.4166666666667" y="244.47236815331252" text-anchor="middle" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(0.8192,-0.5736,0.5736,0.8192,-91.2789,282.7666)">
                                    <tspan dy="4.167680653312516" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">result 1</tspan>
                                  </text>
                                  <text x="322.25" y="244.47236815331252" text-anchor="middle" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(0.8192,-0.5736,0.5736,0.8192,-105.6583,251.4081)">
                                    <tspan dy="4.167680653312516" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">result 2</tspan>
                                  </text>
                                  <text x="263.08333333333337" y="244.47236815331252" text-anchor="middle" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(0.8192,-0.5736,0.5736,0.8192,-112.6783,214.8964)">
                                    <tspan dy="4.167680653312516" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">result 3</tspan>
                                  </text>
                                  <text x="203.91666666666666" y="244.47236815331252" text-anchor="middle" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(0.8192,-0.5736,0.5736,0.8192,-130.7517,186.119)">
                                    <tspan dy="4.167680653312516" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">result 4</tspan>
                                  </text>
                                  <text x="144.75" y="244.47236815331252" text-anchor="middle" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(0.8192,-0.5736,0.5736,0.8192,-137.7589,149.5983)">
                                    <tspan dy="4.167680653312516" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">result 5</tspan>
                                  </text>
                                  <text x="85.58333333333333" y="244.47236815331252" text-anchor="middle" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(0.8192,-0.5736,0.5736,0.8192,-140.683,110.2187)">
                                    <tspan dy="4.167680653312516" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">result 6</tspan>
                                  </text>
                                  <rect x="63.395833333333336" y="217.89824711888727" width="44.375" height="14.074121034425247" r="0" rx="0" ry="0" fill="#ff6600" stroke="#000" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                                  <rect x="122.56249999999999" y="217.7947609348106" width="44.375" height="14.177607218501919" r="0" rx="0" ry="0" fill="#ff6600" stroke="#000" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                                  <rect x="181.72916666666666" y="203.51366753223203" width="44.375" height="28.45870062108048" r="0" rx="0" ry="0" fill="#ff6600" stroke="#000" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                                  <rect x="240.89583333333334" y="192.64761820418315" width="44.375" height="39.32474994912937" r="0" rx="0" ry="0" fill="#ff6600" stroke="#000" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                                  <rect x="300.06249999999994" y="164.18891758310266" width="44.375" height="67.78345057020985" r="0" rx="0" ry="0" fill="#ff6600" stroke="#000" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                                  <rect x="359.22916666666663" y="69.39557296888555" width="44.375" height="162.57679518442697" r="0" rx="0" ry="0" fill="#ff6600" stroke="#000" stroke-width="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></rect>
                                </svg>
                                <div class="morris-hover morris-default-style" style="left: 151.91666666666666px; top: 122px; display: none;"><div class="morris-hover-row-label">iPhone 3GS</div><div class="morris-hover-point" style="color: #ff6600">
                               }
Geekbench:
275
</div></div></div>
</div></div>
<div class="col-xs-12 col-sm-6">
                          <!-- /panel -->
                          <div class="panel panel-default magic-element isotope-item widgets">
                                <div class="panel-body-heading" style="background: #46A6EA;margin-top:-20px;color:#fff">
                                    <h4 class="pb-title" style="padding:5px">Subscribed Events</h4>
                                </div>
                          <div class="panel-body">
                            <div class="table table-responsive" id="user_scroll">
                              @if(count($subscribedevents)>0)
                              <table class="table table-striped">
    <thead>
      <tr>
        <th>Event Name</th>
        <th>Schedule</th>
        <th>View</th>
      </tr>
    </thead>
    @foreach($subscribedevents as $events)
    <tbody>
      <tr>
        <td>{{$events->EventName}}</td>
        <td>{{$events->StartDateTime}}</td>
        <td><a href="{{url('event/'.$events->ShortName)}}"><button class="btn btn-primary view_btn">View</button></a></td>
      </tr>
    </tbody>
    @endforeach
  </table>
  @else
  <h4>No Data Available</h4>
 @endif
</div>
</div>
</div>
</div>
<div class="col-xs-12 col-sm-6">
<div class="panel panel-default magic-element isotope-item widgets">
          <div class="panel-body-heading" style="background: #46A6EA;margin-top:-20px;color:#fff">
              <h4 class="pb-title"style="padding:5px">Winning Level</h4>
          </div>
          <div id="chart-line" class="chart" style="position: relative;"><svg height="300" version="1.1" width="436" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative; left: -0.40625px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><text x="43.5" y="260.984375" text-anchor="end" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><path fill="none" stroke="#aaaaaa" d="M56,260.984375H411" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="43.5" y="201.98828125" text-anchor="end" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.16015625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">1,000</tspan></text><path fill="none" stroke="#aaaaaa" d="M56,201.98828125H411" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="43.5" y="142.9921875" text-anchor="end" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.15625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2,000</tspan></text><path fill="none" stroke="#aaaaaa" d="M56,142.9921875H411" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="43.5" y="83.99609375" text-anchor="end" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.16015625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">3,000</tspan></text><path fill="none" stroke="#aaaaaa" d="M56,83.99609375H411" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="43.5" y="25" text-anchor="end" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">4,000</tspan></text><path fill="none" stroke="#aaaaaa" d="M56,25H411" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="369.9276572947876" y="273.484375" text-anchor="middle" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7.0078)"><tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011</tspan></text><text x="308.22405206452515" y="273.484375" text-anchor="middle" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7.0078)"><tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010</tspan></text><text x="246.5204468342626" y="273.484375" text-anchor="middle" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7.0078)"><tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2009</tspan></text><text x="184.6477906307665" y="273.484375" text-anchor="middle" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7.0078)"><tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2008</tspan></text><text x="122.94418540050398" y="273.484375" text-anchor="middle" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7.0078)"><tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2007</tspan></text><text x="61.24058017024147" y="273.484375" text-anchor="middle" font="10px "Arial"" stroke="none" fill="#34495e" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7.0078)"><tspan dy="4.1640625" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2006</tspan></text><path fill="none" stroke="#3498db" d="M56,66.94622265625C71.42590130756562,67.5951796875,102.27770392269689,69.07745654296875,117.70360523026251,69.54205078125C133.12950653782815,70.00664501953125,163.9813091529594,70.00017845043178,179.40721046052502,70.6629765625C194.87537451139906,71.32759055980678,225.81170261314708,74.44554622039587,241.2798666640211,74.85169921875001C256.70576797158674,75.25674250945838,287.557570586718,74.57884228515626,302.98347189428364,73.90776171875001C318.40937320184923,73.23668115234376,349.26117581698054,70.6425548377404,364.68707712454614,69.48305468750002C368.49072402230206,69.1971505408654,376.09801781781385,68.8921345737563,379.9016647155698,68.12614453124999C383.78807615230465,67.34348711281879,391.56089902577435,64.30591695524845,395.4473104625092,63.288464843750006C399.3354828468819,62.27055172087345,407.11182761562736,60.810628906249995,411.00000000000006,59.98468359374999" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><circle cx="179.40721046052502" cy="70.6629765625" r="4" fill="#3498db" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="241.2798666640211" cy="74.85169921875001" r="4" fill="#3498db" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="302.98347189428364" cy="73.90776171875001" r="4" fill="#3498db" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="364.68707712454614" cy="69.48305468750002" r="4" fill="#3498db" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="379.9016647155698" cy="68.12614453124999" r="4" fill="#3498db" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="395.4473104625092" cy="63.288464843750006" r="4" fill="#3498db" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="411.00000000000006" cy="59.98468359374999" r="4" fill="#3498db" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle></svg><div class="morris-hover morris-default-style" style="left: 189.2798666640211px; top: 84px; display: none;"><div class="morris-hover-row-label">2008 Q4</div><div class="morris-hover-point" style="color: #3498db">
           Licensed:
           3,155
         </div><div class="morris-hover-point" style="color: #95a5a6">
           Off the road:
           681
         </div></div></div>
</div>
  </div>
  <div class="col-xs-12 col-sm-6">
                          <!-- /panel -->
                          <div class="panel panel-default magic-element isotope-item widgets">
                                <div class="panel-body-heading" style="background: #46A6EA;margin-top:-20px;color:#fff">
                                    <h4 class="pb-title" style="padding:5px">Best Lap Details</h4>
                                </div>
                          <div class="panel-body">
                          

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">

      <p><div class="table table-responsive" id="user_scroll">
        @if(count($participants)>0)
        <table class="table table-striped">
        <thead>
          <tr>
            <th>Kin Name</th>
            <th>Relationship</th>
            <th>Heat Name</th>
            <th>Best Lap Details</th>
          </tr>
        </thead>
        @foreach($participants as $participant)
        <tbody>
          <tr>
            <td><a href="{{url('kininformation/'.$participant->ParticipantId)}}" style="color: black">{{$participant->ParticipantName}}</a></td>
            <td>{{$participant->Relationship}}</td>
            <td>{{$participant->HeatName}}</td>
            <td>{{$participant->Result}}</td>
          </tr>
        </tbody>
        @endforeach
      </table>
      @else
      <h4>No Data Available</h4>
     @endif
    </div>
       
  </p>
    
 
</div>
</div>
  </div>
</div>
</div>
<!-- /panel -->
</div>
<!-- Dash board code ends here -->
  @endsection