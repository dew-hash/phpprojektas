@extends('main')
@section('content')
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Sąskaitų išrašai</span>
        <h3 class="page-title">Pasirinkite sąskaitą ir laikotarpį</h3>
    </div>
</div>
    <form action="/records" method="post">
    {{csrf_field()}}
    <div class="form-group col-md-4">
        <select id="inputState" class="form-control" name="account">
            <option selected>Pasirinkite...</option>
            <option>pagrindinė</option>
            <option>kita</option>
        </select>
    </div>
    <div class="form-group col-md-2">
        <div id="blog-overview-date-range" class="input-daterange input-group input-group-sm my-auto ml-auto mr-auto ml-sm-auto mr-sm-0" style="max-width: 350px;">
            <input type="text" class="input-sm form-control" name="start" placeholder="Pradžia" id="blog-overview-date-range-1">
            <input type="text" class="input-sm form-control" name="end" placeholder="Pabaiga" id="blog-overview-date-range-2">
            <span class="input-group-append">
                <span class="input-group-text">
                    <i class="material-icons"></i>
                </span>
            </span>
        </div>
    </div>
    <div class="form-group col-md-4">
        <button type="submit" class="btn btn-accent">Rodyti</button>
    </div>
    </form>
</div>
@endsection