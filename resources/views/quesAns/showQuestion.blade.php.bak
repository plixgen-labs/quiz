@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Question') }}</div>

                <div class="card-body">
                  {!! Session::has('msg') ? Session::get("msg") : '' !!}
                  <br>
                  {{ $question[0]->text }}
                  <br>
                  {{ $question[0]->hint }}
                  <br>
                  @foreach($images as $image)
                      <img src="{{ url('/retrive/'.$image[0]->source) }}" height="400" width="600"><br>
                  @endforeach
                  <br>
                  <form class="form-horizontal" role="form" method="POST" action="{{ url('/add/answer/'.$question[0]->qid) }}" enctype="multipart/form-data">
                    @csrf
                      <div class="form-group{{ $errors->has('ans') ? ' has-error' : '' }}">
                          <label for="qtext" class="col-md-4 control-label">Answer</label>
                              <div class="col-md-12">
                                  <input id="ans" type="text" class="form-control" name="ans" value="{{''}}">
                                      @if ($errors->has('ans'))
                                        <span class="help-block">
                                          <strong>{{ $errors->first('ans') }}</strong>
                                        </span>
                                      @endif
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
@endsection
