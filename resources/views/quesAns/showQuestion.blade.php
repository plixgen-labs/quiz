@extends('layouts.app')

@section('content')
<!-- Content Row -->
<div class="row">

  <!-- Question Form box -->
  <div class="col-xl-9 col-lg-8">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __($question[0]->text) }}</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        @foreach($images as $image)
            <img src="{{ url('/retrive/'.$image[0]->source) }}" height="400" width="600"><br>
        @endforeach

        <br>
        <form class="user" role="form" method="POST" action="{{ url('/add/answer/'.$question[0]->qid) }}" enctype="multipart/form-data">
          @csrf

          <div class="form-group{{ $errors->has('ans') ? ' has-error' : '' }} row">
              <div class="col-md-12">
                  <input type="text" class="form-control form-control-user" name="ans" id="ans" placeholder="Answer..." value="{{''}}">
                    @if ($errors->has('ans'))
                      <span class="help-block">
                        <strong>{{ $errors->first('ans') }}</strong>
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
                  {{ __('Submit') }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-4">
    <!-- Question Points -->
    <div class="col-xl-12 col-md-12 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Points To get</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">P {{ $point }}</div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <!-- Recent question div -->
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Recently Added Questions</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        @foreach ($questionsList as $question)
          <a href="show/question/{{$question->qid}}">{{ $question->text }}</a><br>
        @endforeach
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
