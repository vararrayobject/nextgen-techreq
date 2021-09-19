{{-- 
/**
 * ==================================================================================================
 * @author Yogesh Gholap
 * @email yagholap@gmail.com
 * @create date 2021-09-19
 * @modify date 2021-09-19
 * @desc [description]
 * ==================================================================================================
 */
--}}

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laravel</title>
    <meta name="description" content="">
    <noscript>
        <meta http-equiv="refresh" content="">
    </noscript>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery-ui.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/data-tables/datatables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
        rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />


    {{-- PLUGINS CSS STYLE --}}
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/styles.css')}}">
    <link href="{{asset('assets/plugins/nprogress/nprogress.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/toastr/toastr.min.css')}}" id="sleek-css" rel="stylesheet" />
    <link href="{{asset('assets/css/sweetalert2.min.css')}}" id="sleek-css" rel="stylesheet" />
    <link href="{{asset('assets/css/sleek.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/img/favicon.png')}}" rel="shortcut icon" />

    <script src="{{asset('assets/plugins/nprogress/nprogress.js')}}"></script>

</head>

<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
    @if(Route::current()->getName() != 'login' && Route::current()->getName() != 'register' &&
    Route::current()->getName() != 'password.request' && Route::current()->getName() != 'password.reset' &&
    Route::current()->getName() != 'verification.notice')
    @yield('sidebar',View::make('layouts.sidebar'))
    <div class="page-wrapper">
        <div class="content">
            @yield('header',View::make('layouts.header'))
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
    @else
    @yield('content')
    @endif

    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/data-tables/jquery.datatables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/data-tables/datatables.bootstrap4.min.js')}}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="{{asset('assets/plugins/slimscrollbar/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jekyll-search.min.js')}}"></script>
    <script src="{{asset('assets/plugins/charts/Chart.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill.js')}}"></script>
    <script src="{{asset('assets/plugins/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery('input[name="dateRange"]').daterangepicker({
                autoUpdateInput: false,
                singleDatePicker: true,
                locale: {
                    cancelLabel: 'Clear'
                }
            });
            jQuery('input[name="dateRange"]').on('apply.daterangepicker', function(ev, picker) {
                jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
            });
            jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function(ev, picker) {
                jQuery(this).val('');
            });
        });
    </script>
    <script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('assets/js/sleek.bundle.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script>
    @yield('scripts')
</body>

</html>