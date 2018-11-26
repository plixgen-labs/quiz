@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Question') }}</div>

                <div class="card-body">
                  {{ $question[0]->text }}
                  <br>
                  {{ $question[0]->hint }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
