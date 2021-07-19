<!doctype html>
<html class="no-js h-100" lang="en">
    @include('_partials/head')
    <body class="h-100">
        <div class="container-fluid">
            <div class="row">
                @include('_partials/sidebar')
                <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
                    <div class="main-navbar sticky-top bg-white">
                        @include('_partials/navbar')
                    </div>
                    <div class="main-content-container container-fluid px-4">
                        @yield('content')
                    </div>
                    <!-- Footer galima įterpti -->
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
        <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
        <script src="{{URL::asset('scripts/extras.1.1.0.min.js')}}"></script>
        <script src="{{URL::asset('scripts/shards-dashboards.1.1.0.min.js')}}"></script>
        <script src="{{URL::asset('scripts/app/app-blog-overview.1.1.0.js')}}"></script>
    </body>
</html>
