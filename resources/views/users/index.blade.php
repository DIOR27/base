@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Users management'),
        'description' => __(
            'This is the users management page. You can see all the users and edit or delete them.'),
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Users') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.create') }}"
                                    class="btn btn-sm btn-primary">{{ __('Add') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                    </div>

                    <div class="table-responsive p-4">
                        <table class="table align-items-center table-flush"
                            id="datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Profile picture') }}</th>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Email') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <span class="avatar avatar-md rounded-circle">
                                                <img class="avatar border-gray"
                                                    src="{{ $user->person->profilePhoto() }}"
                                                    alt="{{ $user->person->photo }}">
                                            </span>
                                        </td>
                                        <td>{!! $user->name . ' ' . $user->lastname !!}</td>
                                        <td>
                                            <a href="mailto:{!! $user->email !!}">{!! $user->email !!}</a>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light"
                                                    href="#"
                                                    role="button"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item"
                                                        href="{{ route('user.edit', $user) }}"><i class="fas fa-pencil-alt text-primary"></i> {{ __('Edit') }}</a>
                                                    <form action="{{ route('user.destroy', $user) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a class="dropdown-item"
                                                            onclick="deleteDialog()"><i class="fas fa-trash text-danger"></i> {{ __('Delete') }}</a>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end"
                            aria-label="...">
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script>
        const languageMap = {
            'es-ES': 'Spanish.json',
        };

        const languageURL =
            `//cdn.datatables.net/plug-ins/1.10.21/i18n/${languageMap['{{ auth()->user()->language }}'] || 'English.json'}`;

        $('#datatable').DataTable({
            language: {
                "url": languageURL
            },
            columnDefs: [{
                "orderable": false,
                "targets": $('th').length - 1,
            }, ],
            stateSave: true,
            deferRender: true,
            orderClasses: false,
        });
    </script>
@endpush
