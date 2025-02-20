<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    {{-- <link rel="stylesheet" href="{{asset( 'css/bootstrap.min.css"' )}}"> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset( 'css/datatables.min.css' )}}">
    <link rel="stylesheet" href="{{asset( 'css/selectize.bootstrap5.min.css' )}}">
    <link rel="stylesheet" href="{{asset( 'css/select2.min.css' )}}">
    <link rel="stylesheet" href="{{asset( 'css/ckeditor5.css' )}}">

    <style>
        /* @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap'); */


        .content {
            font-family: "Outfit", sans-serif !important;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }


     .success-alert {
         padding: 15px;
         background-color: #d4edda;
         color: #155724;
         border: 1px solid #c3e6cb;
         border-radius: 4px;
         margin-top: 5px;
     }
     .danger-alert {
         padding: 15px;
         background-color: #f8d7da;
         color: #721c24;
         border: 1px solid #f5c6cb;
         border-radius: 4px;
         margin-top: 5px;
     }

        .dataTables_length label {
            display: flex;
            align-items: center;
        }

        .dataTables_length select {
            margin-right: 10px;
        }



    </style>

</head>
<body>
    <div class="container mt-4">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <h2>Student Management</h2>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    {{-- <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('students.index') }}">Students</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endauth
                    </ul> --}}
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="mt-4">
            @yield('content')

            @if (isset($message))
            <div class="success-alert">
                {{$message}}
            </div>

            @elseif (isset($error))
                <div class="danger-alert" >
                    {{ $error }}
                </div>
            @elseif ($errors->any())
                <div class="danger-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('message'))
                <div class="success-alert">
                    {{session('message')}}
                </div>

            @elseif(session('error'))
                <div class="danger-alert">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
    <script src="{{ asset( 'js/app.js' )}}"></script>

    <script src="{{ asset( 'js/jquery.min.js' )}}" ></script>
<script src="{{ asset( 'js/datatables.min.js' )}}" ></script>
<script src="{{ asset( 'js/selectize.min.js' )}}" ></script>
<script src="{{ asset( 'js/sweetalert2@11.js' )}}" ></script>
<script src="{{ asset('js/popper.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
{{-- <script src="{{ asset('js/ckeditor.js') }}"></script> --}}
<script src="{{ asset('js/index.global.js') }}"></script>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    @yield('scripts')

</body>
</html>
