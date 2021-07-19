@extends('main')
@section('content')
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Naujas pavedimas</span>
        <h3 class="page-title">Pavedimas į savo sąskaitą</h3>
    </div>
</div>
<div class="col-lg-8">
    <div class="card card-small mb-4">
        <div class="card-header border-bottom">
            <h6 class="m-0">Pavedimo informacija</h6>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                        @include('_partials/errors')
                        <form action="/save-transfer" method="post">
                            {{csrf_field()}}
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="feInputState">Į sąskaitą</label>
                                    <select id="feInputState" class="form-control">
                                        <option selected>Pasirinkite sąskaitą</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="feInputState">Iš sąskaitos</label>
                                    <select id="feInputState" class="form-control">
                                        <option selected>Pasirinkite sąskaitą</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputZip">Suma</label>
                                    <input type="text" class="form-control" id="inputZip">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="feDescription">Pasirtis</label>
                                    <textarea class="form-control" name="feDescription" rows="5"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-accent">Pervesti pinigus</button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection
