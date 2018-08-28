<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stock Online') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script> -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      $.noConflict();
      jQuery(document).ready(function ($) {
          $("#po_date").datepicker({dateFormat: "yy-mm-dd"});
          $("#alocation_date").datepicker({dateFormat: "yy-mm-dd"});
          $("#begin_work").datepicker({dateFormat: "yy-mm-dd"});
          $("#status_date").datepicker({dateFormat: "yy-mm-dd"});
          $('#opener').on("click", function(){
            $("#myModal").css('display', 'block');
          });
          $('#close').on("click", function(){
            $("#myModal").css('display', 'none');
          });
          $('#closes').on("click", function(){
            $("#myModal").css('display', 'none');
          });
      });
    </script>

    <script>
      window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
      ]) !!};
    </script>
    <!-- <script src="https://use.fontawesome.com/9712be8772.js"></script>   -->

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Stock Online') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <!-- <li><a href="{{ route('register') }}">Register</a></li> -->
                        @else
                          @role('Admin') {{-- Laravel-permission blade helper --}}
                          <li {{ (Request::is("positions") ? 'class=active' : '') }} ><a href="{{route('positions.index')}}">Positions</a></li>
                          <li {{ (Request::is("loactions") ? 'class=active' : '') }} ><a href="{{route('locations.index')}}">Locations</a></li>
                          <li {{ (Request::is("vendors") ? 'class=active' : '') }} ><a href="{{route('vendors.index')}}">Vendors</a></li>

                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Units <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                              <li {{ (Request::is("unitModels") ? 'class=active' : '') }} ><a href="{{route('unitModels.index')}}">Unit Models</a></li>
                              <li {{ (Request::is("units") ? 'class=active' : '') }} ><a href="{{route('units.index')}}">Units</a></li>
                              <li {{ (Request::is("colors") ? 'class=active' : '') }} ><a href="{{route('colors.index')}}">Colors</a></li>
                            </ul>
                          </li>

                          <li {{ (Request::is("leasing") ? 'class=active' : '') }} ><a href="{{route('leasings.index')}}">Leasings</a></li>

                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Employees <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li {{ (Request::is("employee") ? 'class=active' : '') }} ><a href="{{route('employees.index')}}">Employees</a></li>
                                <li {{ (Request::is("marketingGroups") ? 'class=active' : '') }} ><a href="{{route('marketingGroups.index')}}">Marketing Group</a></li>
                            </ul>
                          </li>

                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Stocks <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('stocks.index')}}"><i class="fa fa-btn fa-unlock"></i>Stock</a></li>
                                <li><a href="{{route('stocks.dos')}}"><i class="fa fa-btn fa-unlock"></i>DO</a></li>
                            </ul>
                          </li>

                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Sales <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('salesperformance')}}"><i class="fa fa-btn fa-unlock"></i>Sales Performance</a></li>
                                <li><a href="{{url('salespermodel')}}"><i class="fa fa-btn fa-unlock"></i>Sales Per Model</a></li>
                                <li><a href="{{url('salespercolor')}}"><i class="fa fa-btn fa-unlock"></i>Sales Per Color</a></li>
                                <li><a href="{{url('salesperleasing')}}"><i class="fa fa-btn fa-unlock"></i>Sales Per Leasing</a></li>
                            </ul>
                          </li>
                          @endrole

                          @role('Editor')
                          <li {{ (Request::is("positions") ? 'class=active' : '') }} ><a href="{{route('positions.index')}}">Positions</a></li>
                          <li {{ (Request::is("loactions") ? 'class=active' : '') }} ><a href="{{route('locations.index')}}">Locations</a></li>
                          <li {{ (Request::is("vendors") ? 'class=active' : '') }} ><a href="{{route('vendors.index')}}">Vendors</a></li>

                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Units <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                              <li {{ (Request::is("unitModels") ? 'class=active' : '') }} ><a href="{{route('unitModels.index')}}">Unit Models</a></li>
                              <li {{ (Request::is("units") ? 'class=active' : '') }} ><a href="{{route('units.index')}}">Units</a></li>
                              <li {{ (Request::is("colors") ? 'class=active' : '') }} ><a href="{{route('colors.index')}}">Colors</a></li>
                            </ul>
                          </li>

                          <li {{ (Request::is("leasing") ? 'class=active' : '') }} ><a href="{{route('leasings.index')}}">Leasings</a></li>

                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Employees <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li {{ (Request::is("employee") ? 'class=active' : '') }} ><a href="{{route('employees.index')}}">Employees</a></li>
                                <li {{ (Request::is("marketingGroups") ? 'class=active' : '') }} ><a href="{{route('marketingGroups.index')}}">Marketing Group</a></li>
                            </ul>
                          </li>

                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Stocks <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('stocks.index')}}"><i class="fa fa-btn fa-unlock"></i>Stock</a></li>
                                <li><a href="{{route('stocks.dos')}}"><i class="fa fa-btn fa-unlock"></i>DO</a></li>
                            </ul>
                          </li>

                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Sales <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('salesperformance')}}"><i class="fa fa-btn fa-unlock"></i>Sales Performance</a></li>
                                <li><a href="{{url('salespermodel')}}"><i class="fa fa-btn fa-unlock"></i>Sales Per Model</a></li>
                                <li><a href="{{url('salespercolor')}}"><i class="fa fa-btn fa-unlock"></i>Sales Per Color</a></li>
                                <li><a href="{{url('salesperleasing')}}"><i class="fa fa-btn fa-unlock"></i>Sales Per Leasing</a></li>
                            </ul>
                          </li>
                          @endrole {{-- End Editor Role --}}

                          @role('Director')
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Sales <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('salesperformance')}}"><i class="fa fa-btn fa-unlock"></i>Sales Performance</a></li>
                                <li><a href="{{url('salespermodel')}}"><i class="fa fa-btn fa-unlock"></i>Sales Per Model</a></li>
                                <li><a href="{{url('salespercolor')}}"><i class="fa fa-btn fa-unlock"></i>Sales Per Color</a></li>
                                <li><a href="{{url('salesperleasing')}}"><i class="fa fa-btn fa-unlock"></i>Sales Per Leasing</a></li>
                            </ul>
                          </li>
                          @endrole {{-- End Director Role --}}

                          @role('Branch Manager')
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Sales <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('salesperformance')}}"><i class="fa fa-btn fa-unlock"></i>Sales Performance</a></li>
                                <li><a href="{{url('salespermodel')}}"><i class="fa fa-btn fa-unlock"></i>Sales Per Model</a></li>
                                <li><a href="{{url('salespercolor')}}"><i class="fa fa-btn fa-unlock"></i>Sales Per Color</a></li>
                                <li><a href="{{url('salesperleasing')}}"><i class="fa fa-btn fa-unlock"></i>Sales Per Leasing</a></li>
                            </ul>
                          </li>
                          @endrole {{-- End Branch Manager Role --}}

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                      @role('Admin') {{-- Laravel-permission blade helper --}}
                                        <a href="#"><i class="fa fa-btn fa-unlock"></i>Admin</a>

                                      <a href="{{ route ('users.index')}}"><i class="fa fa-btn fa-unlock"></i>Users</a>
                                        @endrole
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @if(Session::has('flash_message'))
            <div class="container">
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include ('errors.list') {{-- Including error file --}}
            </div>
        </div>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
