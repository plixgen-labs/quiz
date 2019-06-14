@extends('layouts.app')

@section('content')
<!-- Content Row -->
<div class="row">

  <!-- Question Form box -->
  <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ __('Add new Question') }}</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <form class="user" role="form" method="POST" action="{{ url('/add/question') }}" enctype="multipart/form-data">
          @csrf

          <div class="form-group{{ $errors->has('qtext') ? ' has-error' : '' }} row">
              <div class="col-md-12">
                  <input type="text" class="form-control form-control-user" name="qtext" id="qtext" placeholder="Question?" value="{{ old('qtext') }}">
                    @if ($errors->has('qtext'))
                      <span class="help-block">
                        <strong>{{ $errors->first('qtext') }}</strong>
                      </span>
                    @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('hint') ? ' has-error' : '' }} row">
              <div class="col-md-12">
                  <input id="hint" type="text" class="form-control form-control-user" name="hint" placeholder="Question Hint" value="{{ old('hint') }}">
                    @if ($errors->has('hint'))
                      <span class="help-block">
                        <strong>{{ $errors->first('hint') }}</strong>
                      </span>
                    @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('ans') ? ' has-error' : '' }} row">
            <div class="col-sm-10 mb-3 mb-sm-0" id="{{ $randomId['1'] }}">
              <input id="ans" type="text" class="form-control form-control-user" name="ans[]" placeholder="Answer" value="{{''}}">
                @if ($errors->has('ans'))
                  <span class="help-block">
                    <strong>{{ $errors->first('ans') }}</strong>
                  </span>
                @endif
            </div>
            <div class="col-sm-2">
              <button id="button{{ $randomId['1'] }}" onclick="duplicate('{{ $randomId['1'] }}')" type="button" class="btn btn-primary btn-circle btn-lg">
                <i class="fas fa-plus-circle"></i>
              </button>
            </div>
          </div>

          <div class="form-group{{ $errors->has('files') ? ' has-error' : '' }} row">
            <div class="col-sm-10 mb-3 mb-sm-0" id="{{ $randomId['0'] }}">
              <input id="files" type="file" accept="image/png, image/jpeg" class="form-control form-control-user" data-icon="false" placeholder="Images" name="files[]" value="{{''}}">
              @if ($errors->has('files'))
                <span class="help-block">
                    <strong>{{ $errors->first('files') }}</strong>
                </span>
              @endif
            </div>
            <div class="col-sm-2">
              <button id="button{{ $randomId['0'] }}" onclick="duplicate('{{ $randomId['0'] }}')" type="button" class="btn btn-primary btn-circle btn-lg">
                <i class="fas fa-plus-circle"></i>
              </button>
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
            <li><b>Question </b>: A small text to describe the question. it can be "How these two are related?"</li>
            <li><b>Question Hint </b>: Addition text which can help to find the answer</li>
            <li><b>Answer </b>: Actul answer, if there are more then one answer then use + sign to add multiple.</li>
            <li><b>Images </b>: Images, atleast 2 images are necessary, at max 6 images can be added, use + sign to add multiple images. The image should be atleast 200x200px</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Recently Added Questions</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        @foreach ($questionsList as $question)
          <a href="{{url('show/question/')}}{{'/'.$question->qid}}">{{ $question->text }}</a><br>
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
