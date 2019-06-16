@extends('layouts.app')

@section('content')
<!-- Content Row -->
<div class="row">

  <!-- Question Form box -->
  <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Profile Details') }}</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <form class="user" role="form" method="POST" action="{{ url('/profile') }}" enctype="multipart/form-data">
          @csrf

          <div class="form-group{{ $errors->has('uname') ? ' has-error' : '' }} row">
              <div class="col-md-12">
                  <input type="text" class="form-control form-control-user" name="uname" id="name" placeholder="Name" value="{{ $user->name }}">
                    @if ($errors->has('uname'))
                      <span class="help-block">
                        <strong>{{ $errors->first('uname') }}</strong>
                      </span>
                    @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
              <div class="col-md-12">
                  <input id="email" type="email" class="form-control form-control-user" name="email" placeholder="Email Id" value="{{ $user->email }}">
                    @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }} row">
              <div class="col-md-12">
                  <input id="dob" type="date" class="form-control form-control-user" name="dob" placeholder="Date of Birth" value="{{ $user->dob }}">
                    @if ($errors->has('dob'))
                      <span class="help-block">
                        <strong>{{ $errors->first('dob') }}</strong>
                      </span>
                    @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }} row">
              <div class="col-md-12">Gender :
                  <input id="gender" type="radio" class="form-control-user" name="gender" value="Male"
                  @if($user->gender == "Male")
                    checked="checked"
                  @endif
                  > Male
                  <input id="gender" type="radio" class="form-control-user" name="gender" value="Female"
                  @if($user->gender == "Female")
                    checked="checked"
                  @endif
                  > Female
                  <input id="gender" type="radio" class="form-control-user" name="gender" value="Other"
                  @if($user->gender == "Other")
                    checked="checked"
                  @endif
                  > Other
                    @if ($errors->has('hint'))
                      <span class="help-block">
                        <strong>{{ $errors->first('hint') }}</strong>
                      </span>
                    @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }} row">
              <div class="col-md-12">
                  <input id="phone" type="text" class="form-control form-control-user" name="phone" placeholder="Phone Number with country code" value="{{ $user->phone }}">
                    @if ($errors->has('phone'))
                      <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                      </span>
                    @endif
              </div>
          </div>

          <div class="form-group row">
            <div class="col-md-6">
              <button type="reset" class="btn btn-secondary btn-user btn-block">
                  {{ __('Reset') }}
              </button>
            </div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-primary btn-user btn-block">
                  {{ __('Save') }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Recent questions Div -->
  <div class="col-xl-4 col-lg-5">
    <!-- Instructions Div -->
    <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Instructions</h6>
      </a>
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapseCardExample">
        <div class="card-body">
          <ul>
            <li><b>Name </b>: Your Full Name, It will be displayed in Leadersboard, and profile.</li>
            <li><b>Email </b>: Working email address, We will reach out to you with new updated and important announcements.</li>
            <li><b>Date of Birth </b>: Optional, As of now we will just keep it for record.</li>
            <li><b>Gender </b>: Optional, As of now we will just keep it for record.</li>
            <li><b>Phone Number </b>: Optional, As of now we will just keep it for record.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- <script src="{{ asset('js/dropzone.js') }}"></script> -->
<script>
function duplicate(divId) {
    // document.getElementById('button'+divId).onclick = duplicate(divId);
    var randomId = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
    var original = document.getElementById(divId);
    var clone = original.cloneNode(true); // "deep" clone
    clone.id = randomId; // there can only be one element with an ID
    original.after(clone);
    var st = '#'+ randomId +' input:text';
    $(st).each(function(){$(this).val('');});
    var st = '#'+ randomId +' input';
    $(st).each(function(){$(this).val('');});
    var st = '#button' + randomId;
    $(st).attr('onClick','duplicate(\''+randomId+'\')');
    // var st = '#button' + divId;
    // $(st).attr('hidden','true');
    // $(st).each(function(){$(this).val('');});
}

</script>
@endsection
