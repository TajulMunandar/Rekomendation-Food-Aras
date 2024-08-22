<!DOCTYPE html>
<html lang="en">

<head>
    @include('../layouts/partial/head')
    <title>Dashboard
        @if (request()->path() !== 'dashboard')
            | {{ $title }}
        @endif
    </title>

    <style>
        .nav-item .nav-link {
            color: #45474B;
        }

        .nav-item .nav-link.active,
        .nav-item .nav-link:hover {
            color: !important #379777;
        }

        .nav-item .nav-icon {
            color: #45474B;
        }

        .nav-item .nav-link.active .nav-icon,
        .nav-item .nav-link:hover .nav-icon {
            color: !important #379777;
        }
    </style>
</head>

<body class="bg-light">
    <div id="db-wrapper">
        <!-- navbar vertical -->
        @include('../layouts/partial/sidebar')
        <!-- Page content -->
        <div id="page-content">
            @include('../layouts/partial/header')
            <!-- Container fluid -->
            <div class="pt-10 pb-21"
                style="background-image: radial-gradient( circle farthest-corner at 10% 20%, rgba(255, 200, 124, 1) 0%, rgba(252, 251, 121, 1) 90% );">
            </div>
            <div class="container-fluid mt-n22 px-6">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    @include('../layouts/partial/scripts')

    @stack('script')
    @yield('js')
</body>

</html>
