@include('layouts.header')

@include('layouts.includes.navbar')
@include('layouts.includes.sidebar')

<main id="main" class="main">
    @yield('content')
</main>

@include('layouts.footer')
