@extends('main')
@section('content')
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Sąskaitų apžvalga</span>
        <h3 class="page-title">Mano sąskaitos</h3>
    </div>
</div>
<!-- Sąskaitų balansai viršuje -->
<div class="row">
    @foreach($accounts as $account)
    <div class="col-lg col-md-6 col-sm-6 mb-4">
        <div class="stats-small stats-small--1 card card-small">
            <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                    <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">{{$account->label}}</span>
                        <h6 class="stats-small__value count my-3">{{$account->amount}}</h6>
                    </div>
                    <div class="stats-small__data">
                        <span class="stats-small__percentage stats-small__percentage--increase">4.7%</span>
                    </div>
                </div>
                <canvas height="120" class="blog-overview-stats-small-1"></canvas>
            </div>
        </div>
    </div>
    @endforeach
    <div class="col-lg col-md-6 col-sm-6 mb-4">
        <div class="stats-small stats-small--1 card card-small">
            <div class="card-body p-0 d-flex">
                <div class="d-flex flex-column m-auto">
                    <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Pagrindinė</span>
                        <h6 class="stats-small__value count my-3">400</h6>
                    </div>
                    <div class="stats-small__data">
                        <span class="stats-small__percentage stats-small__percentage--increase">12.4%</span>
                    </div>
                </div>
                <canvas height="120" class="blog-overview-stats-small-2"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- Statistika -->
<div class="row">
    <!-- Linijinė diagrama -->
    <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
        <div class="card card-small">
            <div class="card-header border-bottom">
                <h6 class="m-0">Likučiai sąskaitose</h6>
            </div>
            <div class="card-body pt-0">
                <div class="row border-bottom py-2 bg-light">
                    <div class="col-12 col-sm-6">
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
                    <div class="col-12 col-sm-6 d-flex mb-2 mb-sm-0">
                        <button type="button" class="btn btn-sm btn-white ml-auto mr-auto ml-sm-auto mr-sm-0 mt-3 mt-sm-0">Sąskaitų išrašai &rarr;</button>
                    </div>
                </div>
                <canvas height="130" style="max-width: 100% !important;" class="blog-overview-users"></canvas>
            </div>
        </div>
    </div>
    <!-- End Linijinė diagrama -->
    <!-- Apskritiminė diagrama -->
    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="card card-small h-100">
            <div class="card-header border-bottom">
                <h6 class="m-0">Išlaidos sąskaitose</h6>
            </div>
            <div class="card-body d-flex py-0">
                <canvas height="220" class="blog-users-by-device m-auto"></canvas>
            </div>
            <div class="card-footer border-top">
                <div class="row">
                    <div class="col">
                        <select class="custom-select custom-select-sm" style="max-width: 130px;">
                            <option selected>Paskutinę savaitę</option>
                            <option value="1">Šiandien</option>
                            <option value="2">Paskutinį mėnesį</option>
                            <option value="3">Paskutinius metus</option>
                        </select>
                    </div>
                    <div class="col text-right view-report">
                        <a href="#">Sąskaitų išrašai &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Apskritiminė diagrama -->
</div>
<!-- Sąskaitos lentelėje -->
<div class="row">
    <div class="col">
        <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                    <h6 class="m-0">Sąskaitos</h6>
            </div>
            <div class="card-body p-0 pb-3 text-center">
                <table class="table mb-0">
                    <thead class="bg-light">
                            <tr>
                                <th scope="col" class="border-0">Nr.</th>
                                <th scope="col" class="border-0">Pavadinimas</th>
                                <th scope="col" class="border-0">Balansas</th>
                            </tr>
                    </thead>
                    <tbody>
                        @foreach($accounts as $account)
                            <tr>
                                <td>{{$account->iban}}</td>
                                <td>{{$account->label}}</td>
                                <td>{{$account->amount}}</td>
                            </tr>
                        @endforeach
                            <tr>
                                <td>LT777214500874102320</td>
                                <td>Pagrindinė</td>
                                <td>400</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Sąskaitos lentelėje -->
@endsection
