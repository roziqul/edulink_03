<!DOCTYPE html>
<html lang="en">

@include('student.partials.head')

<body>
    <div id="app">
        @include('sweetalert::alert')
        <div class="main-wrapper">

            @include('student.partials.navbar')

            @include('student.partials.sidebar')

            <div class="main-content" id="main-content">

                @yield('content')

            </div>

            @include('student.partials.footer')

        </div>
    </div>

    @include('student.partials.scripts')

</body>

</html>