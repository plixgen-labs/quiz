@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add new Question') }}</div>

                <div class="card-body">
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                  @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/add/question') }}" enctype="multipart/form-data">
                      @csrf

                        <div class="form-group{{ $errors->has('qtext') ? ' has-error' : '' }}">
                            <label for="qtext" class="col-md-4 control-label">Question Text</label>
                                <div class="col-md-12">
                                    <input id="qtext" type="text" class="form-control" name="qtext" value="{{''}}">
                                        @if ($errors->has('qtext'))
                                          <span class="help-block">
                                            <strong>{{ $errors->first('qtext') }}</strong>
                                          </span>
                                        @endif
                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('hint') ? ' has-error' : '' }}">
                              <label for="hint" class="col-md-4 control-label">Question Hint</label>
                              <div class="col-md-12">
                                  <input id="hint" type="text" class="form-control" name="hint" value="{{''}}">
                                  @if ($errors->has('hint'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hint') }}</strong>
                                    </span>
                                  @endif
                              </div>
                        </div>
                        <div class="form-group{{ $errors->has('ans') ? ' has-error' : '' }}">
                              <label for="ans" class="col-md-12 control-label">Correct Answer</label>
                              <div class="col-md-10" id="{{ $randomId['1'] }}">
                                  <input id="ans" type="text" class="form-control" name="ans" value="{{''}}">
                                  @if ($errors->has('ans'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ans') }}</strong>
                                    </span>
                                  @endif
                                  <button id="button{{ $randomId['1'] }}" onclick="duplicate('{{ $randomId['1'] }}')" type="button" class="btn">
                                    <span style="font-size: 48px; color: Dodgerblue;">
                                        <i class="far fa-plus-square"></i>
                                    </span>
                                  </button>
                              </div>
                        </div>

                        <div class="form-group{{ $errors->has('files') ? ' has-error' : '' }}">
                              <label for="files" class="col-md-4 control-label">File</label>
                                <div class="col-md-4" id="{{ $randomId['0'] }}">
                                    <input id="files" type="file" class="form-control" name="files[]" value="{{''}}">
                                    @if ($errors->has('files'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('files') }}</strong>
                                      </span>
                                    @endif
                                    <button id="button{{ $randomId['0'] }}" onclick="duplicate('{{ $randomId['0'] }}')" type="button" class="btn">
                                      <span style="font-size: 48px; color: Dodgerblue;">
                                          <i class="far fa-plus-square"></i>
                                      </span>
                                    </button>
                                </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-5">
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Save') }}
                              </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
    var st = '#button' + divId;
    $(st).attr('hidden','true');
    // $(st).each(function(){$(this).val('');});
}

</script>
@endsection
