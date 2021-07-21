@extends('main')
@section('content')
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Sąskaitų išrašai</span>
        <h3 class="page-title">Sąskaitos nr</h3>
    </div>
</div>
<!-- Table of records -->
<div class="row">
  <div class="col">
    <div class="card card-small mb-4">
      <div class="card-header border-bottom">
        <h6 class="m-0">Pavedimai</h6>
      </div>
      <div class="card-body p-0 pb-3 text-center">
        <table class="table mb-0">
          <thead class="bg-light">
            <tr>
              <th scope="col" class="border-0">Siuntėjas</th>
              <th scope="col" class="border-0">Siuntėjo sąskaita</th>
              <th scope="col" class="border-0">Gavėjas</th>
              <th scope="col" class="border-0">Gavėjo sąskaita</th>
              <th scope="col" class="border-0">Suma</th>
              <th scope="col" class="border-0"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              @foreach($tranfersWithNames as $transfer)
                <td>{{$transfer->from_name}}</td>
                <td>{{$transfer->from}}</td>
                <td>{{$transfer->to_name}}</td>
                <td>{{$transfer->to}}</td>
                <td>{{$transfer->amount}}</td>
                <td><a href="/cancel/{{$transfer->id}}">Atšaukti</a></td>
              @endforeach
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Pager -->
    <div>
      {{$tranfersWithNames->links}}
    </div>
  </div>
</div>
<!-- Table of Records -->
@endsection
