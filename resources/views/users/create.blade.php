@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Gestión de usuarios'),
        'description' => __('En este apartado podrá realizar la gestión de usuarios del sistema.'),
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Crear perfil') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post"
                            action="{{ route('user.store') }}"
                            autocomplete="off">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('Información del usuario') }}</h6>
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show"
                                    role="alert">
                                    {{ session('status') }}
                                    <button type="button"
                                        class="close"
                                        data-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-md">
                                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                for="input-name">{{ __('Nombre') }}</label>
                                            <input type="text"
                                                name="name"
                                                id="input-name"
                                                class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Ingrese el nombre del usuario.') }}"
                                                value="Diego"
                                                required
                                                autofocus>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback"
                                                    role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group{{ $errors->has('lastname') ? ' has-danger' : '' }}">
                                            <label class="form-control-label"
                                                for="input-name">{{ __('Apellido') }}</label>
                                            <input type="text"
                                                name="lastname"
                                                id="input-lastname"
                                                class="form-control form-control-alternative{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Ingrese el nombre del usuario.') }}"
                                                value="González"
                                                required
                                                autofocus>

                                            @if ($errors->has('lastname'))
                                                <span class="invalid-feedback"
                                                    role="alert">
                                                    <strong>{{ $errors->first('lastname') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"
                                        for="input-email">{{ __('Correo electrónico') }}</label>
                                    <input type="email"
                                        name="email"
                                        id="input-email"
                                        class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Ingrese la dirección de correo electrónico') }}"
                                        value="diego@mail.com"
                                        required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback"
                                            role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"
                                        for="input-password">{{ __('Contraseña') }}</label>
                                    <input type="password"
                                        name="password"
                                        id="input-password"
                                        class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Ingrese una contraseña') }}"
                                        value="123456"
                                        required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback"
                                            role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="input-password-confirmation">{{ __('Confirmar contraseña') }}</label>
                                    <input type="password"
                                        name="password_confirmation"
                                        id="input-password-confirmation"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Introduzca nuevamente la contraseña') }}"
                                        value="123456"
                                        required>
                                </div>
                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                @include('layouts.chatter')
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection