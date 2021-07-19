@extends('main')
@section('content')
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        <span class="text-uppercase page-subtitle">Naujas pavedimas</span>
        <h3 class="page-title">Naujas pavedimas</h3>
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
                                <div class="form-group col-md-6">
                                    <label for="feInputAddress">Gavėjas</label>
                                    <input type="text" name="name" class="form-control" id="feInputAddress" placeholder="">
                                    <button type="submit" class="mb-2 btn btn-sm btn-outline-primary mr-1"><a href="/transfer-my-account">Į savo sąskaitą</a></button>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputZip">Gavėjo sąskaita</label>
                                    <input type="text" name="to" class="form-control" id="inputZip">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="feInputState">Mokėtojo sąskaita</label>
                                    <select id="feInputState" name="from" class="form-control">
                                        <option selected>Pasirinkite savo sąskaitą</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputZip">Suma</label>
                                    <input type="text" name="amount" class="form-control" id="inputZip">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="feDescription">Pasirtis</label>
                                    <textarea class="form-control" name="purpose" rows="5"></textarea>
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