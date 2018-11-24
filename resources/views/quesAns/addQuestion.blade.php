@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add new Question') }}</div>

                <div class="card-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/add/question') }}" enctype="multipart/form-data">
                      @csrf

                        <div class="form-group{{ $errors->has('qtext') ? ' has-error' : '' }}">
                            <label for="qtext" class="col-md-4 control-label">Question Text</label>
                                <div class="col-md-6">
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
                              <div class="col-md-6">
                                  <input id="hint" type="text" class="form-control" name="hint" value="{{''}}">
                                  @if ($errors->has('hint'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hint') }}</strong>
                                    </span>
                                  @endif
                              </div>
                        </div>

                        <div class="form-group{{ $errors->has('ans') ? ' has-error' : '' }}">
                              <label for="ans" class="col-md-4 control-label">Correct Answer</label>
                              <div class="col-md-6">
                                  <input id="ans" type="text" class="form-control" name="ans" value="{{''}}">
                                  @if ($errors->has('ans'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ans') }}</strong>
                                    </span>
                                  @endif
                              </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
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
@endsection
