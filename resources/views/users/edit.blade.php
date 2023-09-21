@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' ' . auth()->user()->name,
        'description' => __(
            'This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{ __('Edit Profile') }}</h3>
                            </div>
                            <div class="col-auto">
                                <div class="dropdown show">
                                    <a class="btn btn-sm btn-secondary dropdown-toggle"
                                        href="#"
                                        role="button"
                                        id="dropdownMenuLink"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fas fa-user-cog"></i>
                                        {{ __('Action') }}
                                    </a>
                                    <div class="dropdown-menu"
                                        aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item"
                                            href="#">{{ __('Duplicate') }}</a>
                                        <a class="dropdown-item"
                                            href="#">{{ __('Archive') }}</a>
                                        <a class="dropdown-item"
                                            href="#">{{ __('Delete') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post"
                            action="{{ route('user.update', $user) }}"
                            autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>

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
                                @include('layouts.inputs.imageSelector', [
                                    'labelText' => __('Upload a profile picture'),
                                    'inputName' => 'photo',
                                    'thumbnailImage' => $user->person->profilePhoto(),
                                ])
                                <div class="col-md">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label text-wrap text-break"
                                            for="input-name">{{ __('Name') }}</label>
                                        <input type="text"
                                            name="name"
                                            id="input-name"
                                            class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Enter the user\'s name') }}"
                                            value="{{ $user->name }}"
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
                                        <label class="form-control-label text-wrap text-break"
                                            for="input-name">{{ __('Lastname') }}</label>
                                        <input type="text"
                                            name="lastname"
                                            id="input-lastname"
                                            class="form-control form-control-alternative{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Enter the user\'s last name.') }}"
                                            value="{{ $user->lastname }}"
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
                                <div class="col-md">
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-email">{{ __('Email') }}</label>
                                        <input type="email"
                                            name="email"
                                            id="input-email"
                                            class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Email') }}"
                                            value="{{ old('email', auth()->user()->email) }}"
                                            required>
                                    
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback"
                                                role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                        <form method="post"
                            action="{{ route('profile.password') }}"
                            autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

                            @if (session('password_status'))
                                <div class="alert alert-success alert-dismissible fade show"
                                    role="alert">
                                    {{ session('password_status') }}
                                    <button type="button"
                                        class="close"
                                        data-dismiss="alert"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"
                                        for="input-current-password">{{ __('Current Password') }}</label>
                                    <input type="password"
                                        name="old_password"
                                        id="input-current-password"
                                        class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Current Password') }}"
                                        value=""
                                        required>

                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback"
                                            role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"
                                        for="input-password">{{ __('New Password') }}</label>
                                    <input type="password"
                                        name="password"
                                        id="input-password"
                                        class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('New Password') }}"
                                        value=""
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
                                        for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                    <input type="password"
                                        name="password_confirmation"
                                        id="input-password-confirmation"
                                        class="form-control form-control-alternative"
                                        placeholder="{{ __('Confirm New Password') }}"
                                        value=""
                                        required>
                                </div>

                                <div class="text-center">
                                    <button type="submit"
                                        class="btn btn-success mt-4">{{ __('Change password') }}</button>
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
