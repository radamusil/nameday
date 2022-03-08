<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>Svátky</title>
</head>
<body>
    <header class="d-flex w-100 justify-content-between">
        <a href="/" class="ml-1 mt-2 mb-2"><img class="icon" src="{{ asset('favicon.ico') }}" alt=""></a>
        <form class="m-2 d-flex mt-2" method ="GET" action="{{ route('search')}}" >
            <div class="position-relative">
                <input id="name" type="text" placeholder="Vyhledat jméno" name="search" autocomplete="off">
                <button class="btn-submit position-absolute border-0 bg-white top-1.5 end-1" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                  </svg>
                </button>
            </div>
            <div id="match-list" class="position-absolute bg-white"></div>
        </form>
    </header>
    @yield('content')
</body>
</html>