<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('styles')
</head>
<body class="bg-light">
   <div class="container d-flex min-vh-100 align-item-center py-5">

       @yield('content')
   </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
    {{-- =============For working Bootstrap TOOLTIP==(it is used to create.blade.php at photo section)============ --}}
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
     {{-- =============For working Bootstrap TOOLTIP============== --}}
    @yield('scripts')
</body>
</html>