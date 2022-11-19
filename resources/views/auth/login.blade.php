{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

<div class="card-body">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>
@endsection --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{asset('bootstrap4/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('inicio/css/style.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/fontawesome.min.css')}}">
    <link href="https://tresplazas.com/web/img/big_punto_de_venta.png" rel="shortcut icon">
    <title>Inicio de sesión</title>
</head>

<body>
    <img class="wave" src="{{asset('inicio/img/wave.png')}}">
    <div class="container">
        <div class="img">
            <img src="{{asset('inicio/img/Tablet-login-cuate.svg')}}">
        </div>
        <div class="login-content">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <img src="{{asset('inicio/img/avatar.png')}}">
                <h2 class="title">BIENVENIDO</h2>
                @if (session('mensaje'))
                <div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
                    <small>{{ session('mensaje') }}</small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="mb-3">

                    @error('usuario')
                    <div class="alert alert-danger alert-dismissible fade show mb-1" role="alert">
                        <small>{{ $errors->first('usuario') }}</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror

                    
                    @error('password')
                    <div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
                        <small>{{ $errors->first('password') }}</small>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror

                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Usuario</h5>
                        <input id="usuario" type="text" class="input @error('usuario') is-invalid
                        @enderror" name="usuario" title="ingrese su nombre de usuario" autocomplete="usuario"
                            value="{{ old('usuario') }}">


                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" id="input" class="input @error('password') is-invalid @enderror"
                            name="password" title="ingrese su clave para ingresar" autocomplete="current-password">


                    </div>
                </div>
                <div class="view">
                    <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
                </div>


                <!-- <div class="text-center">
                    <a class="font-italic isai5" href="{{route('recuperar.index')}}">Olvidé mi contraseña</a>
                </div> -->
                <input name="btningresar" class="btn" title="click para ingresar" type="submit" value="INICIAR SESION" style="background-color:#5DB476">

            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('inicio/js/main.js')}}"></script>
    <script type="text/javascript" src="{{asset('inicio/js/main2.js')}}"></script>
    <script type="text/javascript" src="{{asset('bootstrap4/js/jquery.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('bootstrap4/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('bootstrap4/js/bootstrap.bundle.js')}}"></script>

</body>

</html>