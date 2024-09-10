<!DOCTYPE html>
<html lang="en">

@include('admin.partials.head')

<body>
    <div id="app">
        @include('sweetalert::alert')
        <div class="main-wrapper">

            @include('admin.partials.navbar')

            @include('admin.partials.sidebar')

            <div class="main-content" id="main-content">

                @yield('content')

            </div>

            @include('admin.partials.footer')

        </div>
    </div>

    @include('admin.partials.scripts')

</body>

</html>