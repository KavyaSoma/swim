@extends('layouts.main')
@section('content')
@if(session()->has('message.level'))
    <div class="alert alert-{{ session('message.level') }}" style="margin:13px;text-align: center;">
    {!! session('message.content') !!}
    </div>
    @endif
<!-- User Information code starts here -->
   <div class="container" id="main-code" style="margin-top:1%;background-color:#fff">
    <div class="col-sm-12">
   <div class="tab-content preview_details">
      <div id="accountsettings" class="tab-pane fade in active">
        @if(count($user)>0)
        <form class="form-horizontal"  style="background:#fff;padding:35px" action="{{url('edituser/'.$user[0]->UserId)}}" method="post">
          {{csrf_field()}}
          <div class="col xs-12 col-sm-6 col-md-6 col-lg-6">
            @if($user[0]->UserName == '')
                <div class="form-group">
                    <label class="control-label col-sm-4" for="txt">User Name:</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="txt" name="UserName" value="NA">
                      </div>
               </div>
               @else
                <div class="form-group">
                    <label class="control-label col-sm-4" for="txt">User Name:</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="txt" name="UserName" value="{{$user[0]->UserName}}">
                      </div>
               </div>
               @endif
            @if($user[0]->FirstName == '')
                <div class="form-group">
                <label class="control-label col-sm-4" for="txt">First Name:</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="txt" name="FirstName" value="NA">
                    </div>
                </div>
                @else
                 <div class="form-group">
                <label class="control-label col-sm-4" for="txt">First Name:</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="txt" name="FirstName" value="{{$user[0]->FirstName}}">
                    </div>
                </div>
                @endif
                @if($user[0]->MiddleName == '')
                <div class="form-group">
                <label class="control-label col-sm-4" for="txt">Middle Name:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="txt" name="MiddleName" value="MiddleName">
                  </div>
              </div>
              @else
              <div class="form-group">
                <label class="control-label col-sm-4" for="txt">Middle Name:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="txt" name="MiddleName" value="{{$user[0]->MiddleName}}">
                  </div>
              </div>
              @endif
              @if($user[0]->LastName == '')
                <div class="form-group">
                    <label class="control-label col-sm-4" for="txt">Last Name:</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="txt" name="LastName" value="NA">
                      </div>
               </div>
               @else
                <div class="form-group">
                    <label class="control-label col-sm-4" for="txt">Last Name:</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="txt" name="LastName" value="{{$user[0]->LastName}}">
                      </div>
               </div>
               @endif
              
               @if($user[0]->DayTimePhone == '')
               <div class="form-group">
                 <label class="control-label col-sm-4" for="txt">Mobile:</label>
                   <div class="col-sm-6">
                     <input type="text" class="form-control" id="txt" name="DayTimePhone" value="NA">
                   </div>
               </div>
               @else
               <div class="form-group">
                 <label class="control-label col-sm-4" for="txt">Mobile:</label>
                   <div class="col-sm-6">
                     <input type="text" class="form-control" id="txt" name="DayTimePhone" value="{{$user[0]->DayTimePhone}}">
                   </div>
               </div>
               @endif
               </div>
           <div class="col xs-12 col-sm-6 col-md-6 col-lg-6">
               @if($user[0]->EveningPhone == '')
                <div class="form-group">
                    <label class="control-label col-sm-4" for="txt">Landline:</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="txt" name="EveningPhone" value="NA">
                      </div>
                  </div>
                  @else
                  <div class="form-group">
                    <label class="control-label col-sm-4" for="txt">Landline:</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="txt" name="EveningPhone" value="{{$user[0]->EveningPhone}}">
                      </div>
                  </div>
                  @endif
                @if($user[0]->Email == '')  
            <div class="form-group">
                  <label class="control-label col-sm-4" for="txt">Email:</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="txt" name="Email" value="NA">
                    </div>
             </div>
             @else
                  <div class="form-group">
                  <label class="control-label col-sm-4" for="txt">Email:</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="txt" name="Email" value="{{$user[0]->Email}}">
                    </div>
             </div>
             @endif
                  @if($user[0]->Facebook == '')
              <div class="form-group">
                  <label class="control-label col-sm-4" for="txt">Facebook:</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="txt" name="Facebook" value="NA">
                    </div>
             </div>
             @else
                <div class="form-group">
                  <label class="control-label col-sm-4" for="txt">Facebook:</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="txt" name="Facebook" value="{{$user[0]->Facebook}}">
                    </div>
             </div>
             @endif
            @if($user[0]->Twitter == '')
            <div class="form-group">
                    <label class="control-label col-sm-4" for="txt">Twitter:</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="txt" name="Twitter" value="NA">
                      </div>
               </div>
               @else
               <div class="form-group">
                    <label class="control-label col-sm-4" for="txt">Twitter:</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="txt" name="Twitter" value="{{$user[0]->Twitter}}">
                      </div>
               </div>
               @endif
               @if($user[0]->Website == '')
               <div class="form-group">
                   <label class="control-label col-sm-4" for="txt">Website:</label>
                     <div class="col-sm-6">
                       <input type="text" class="form-control" id="txt" name="Website" value="NA">
                     </div>
              </div>
              @else
              <div class="form-group">
                   <label class="control-label col-sm-4" for="txt">Website:</label>
                     <div class="col-sm-6">
                       <input type="text" class="form-control" id="txt" name="Website" value="{{$user[0]->Website}}">
                     </div>
              </div>
              @endif
                <button type="submit" class="btn btn-primary">Save and Continue</button>
          </form>
          @endif
        </div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- user Information code ends here -->
@endsection