@extends('layouts.app')

@section('content')
<!-- Content Row -->
<div class="row">

  <!-- Area Chart -->
  <div class="col-xl-9 col-lg-8">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        You are logged in!
      </div>
    </div>
  </div>

  <!-- Pie Chart -->
  <div class="col-xl-3 col-lg-4">
    <div class="col-xl-12 col-md-12 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Points</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">P 215</div>
          </div>
        </div>
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
          <a href="show/question/{{$question->qid}}">{{ $question->text }}</a><br>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
