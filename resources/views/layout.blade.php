<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Main style sheet -->
        <link rel="stylesheet" href="{{ mix('/css/style.css') }}">
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('article.index') }}">App</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        {{--<li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>--}}
                    </ul>
                </div>
            </div>
        </nav>

        <section id="main">
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-2">
                        <div class="list-group">
                            <a href="{{ route('article.index') }}" class="list-group-item list-group-item-action {{ (request()->is('/*')) ? 'active' : '' }}">List Articles</a>
                            <a href="{{ route('article.import') }}" class="list-group-item list-group-item-action {{ (request()->is('/import')) ? 'active' : '' }}">Import Articles</a>
                            <a href="{{ route('api.article.export') }}" class="list-group-item list-group-item-action" target="_blank">Export Articles</a>
                        </div>
                    </div>
                    <div class="col-10">
                        @yield('content')
                    </div>

                </div>
            </div>
        </section>
        
        <!-- Javascript -->
        <script src="{{ mix('/js/script.js') }}"></script>
    </body>
</html>
