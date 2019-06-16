@extends('layouts.app')

@section('content')
<!-- Content Row -->
<div class="row">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <!-- Area Chart -->
  <div class="col-xl-9 col-lg-8">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Leaderboard</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="table-responsive">
          <table id="leaderboard" class="table table-borderless">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Points</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1 ?>
              @foreach ($usersList as $udata)
              <tr
              @if($user->id == $udata->id)
                class="table-info"
              @endif
              >
                <td>{{ $i++ }}</td>
                <td><img class="img-profile rounded-circle" src="{{ $udata->avatar }}" style="max-height: 40px; max-width: 40px;"> {{ $udata->name }}</td>
                <td style="vertical-align: middle;">{{ $udata->points }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
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
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Current Points</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">P {{ $user->points }}</div>
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
          <a href="{{url('show/question/')}}{{'/'.$question->qid}}">{{ $question->text }}</a><br>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
