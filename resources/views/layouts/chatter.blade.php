<div class="card card-profile min-vh-300 overflow-auto" style="max-height: 800px;">
    <div class="card-body pt-3">
        <div class="row">
            <form id="attachment-form"
                name="attachment-form"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="text-left">
                    <div class="form-group">
                        <label for="input-message">Mensaje</label>
                        <div class="form-control mention overflow-auto"
                            id="input-message"
                            style="height: 150px;"
                            data-users="{{ $chatterUsers }}"
                            contenteditable="true">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit"
                        id="btn-send-message"
                        class="btn btn-sm btn-dark">Enviar</button>
                </div>
            </form>

        </div>
        <div class="card-header text-left border-0 pt-3 text-center">
            Registros - Mensajes
        </div>
        <div class="text-left"
            id="messages">
            @foreach ($chatters as $chatter)
                <div class="h6 mt-3">
                    <a href="#"
                        id="user{{ $chatter->user->id }}"
                        class="text-success userDetails"
                        data-bs-toggle="modal"
                        data-bs-target="#userDetailsModal">
                        <i class="far fa-user-circle"></i>
                        {{ $chatter->user->name . ' ' . $chatter->user->lastname }}
                    </a>
                </div>
                <div style="margin-top: -0.9rem;">
                    <i class="fas fa-clock text-dark"
                        style="font-size: 8pt;"></i>
                    <span style="font-size: 8pt;">{{ $chatter->sent_at }}</span>
                </div>
                <div class="text-dark">
                    <div id="message{{ $chatter->id }}"
                        class="message-content">
                        @php
                            $messageLines = explode('<br>', $chatter->message);
                        @endphp
                        @foreach ($messageLines as $line)
                            {{ $line }}<br>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


<div class="modal fade"
    id="userDetailsModal"
    tabindex="-1"
    aria-labelledby="userDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="userDetailsModalLabel">Detalles de usuario</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="{{ asset('img/team-1.jpg') }}"
                            alt="profile_image"
                            class="w-20 rounded-circle shadow-sm">
                    </div>
                    <div class="row pt-4">
                        <div class="col-md text-left">
                            <h6 class="text-dark"
                                id="userDetailsName">Nombre completo</h6>
                            <p>Admin Admin</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md text-left">
                            <h6 class="text-dark"
                                id="userDetailsName">Correo electrónico</h6>
                            admin@argon.com
                            <a href="mailto:admin@argon.com"><i class="far fa-envelope"></i></a>
                        </div>
                        <div class="col-md text-left">
                            <h6 class="text-dark"
                                id="userDetailsName">Teléfono</h6>
                            +5939999999
                            <a href="tel:5939999999"><i class="fas fa-phone"></i></a>
                            <a href="https://wa.me/5939999999"
                                target="_blank"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script src="{{ asset('argon/js/notifications.js') }}"></script>
    <script>
        let selectedUsers = [];

        const attachmentForm = document.getElementById('attachment-form');
        const users = JSON.parse($('#input-message').attr('data-users'));

        $('#input-message').atwho({
            at: "@",
            data: users,
            displayTpl: "<li data-value='@${id}'>${name} ${lastname}</li>",
            insertTpl: "<a id='@${id}' href='/profile/${id}'>@${name} ${lastname}</a>",
            searchKey: "name",
            searchKey: "lastname",
            callbacks: {
                beforeInsert: function(value, $li) {
                    if (selectedUsers.indexOf($li.data('value')) === -1) {
                        selectedUsers.push($li.data('value'));
                    }
                    return value;
                }
            }
        });

        attachmentForm.addEventListener('submit', function(event) {
            event.preventDefault();

            $('#input-message').text($('#input-message').text().trim());
            if ($('#input-message').text() === '') {
                sendNotification('error', 'Error', 'El mensaje no puede estar vacío.', 'slide');
                $('#input-message').focus();
                return;
            }

            if ($('#input-message').text() !== '') {
                $.ajax({
                    url: "{{ route('chatter.store') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        user_id: '{{ auth()->user()->id }}',
                        message: $('#input-message').text(),
                        class_name: '{{ $class_name }}',
                        class_record_id: '{{ $class_record_id }}',
                    },
                    async: false,
                    dataType: "json",
                    success: function(data) {
                        $('#input-message').text('');
                        $('#input-message').focus();
                        $('#messages').empty();
                        for (let i = 0; i < data.length; i++) {
                            $('#messages').append(
                                '<div class="h6 mt-4 text-success">' +
                                '<a href="#" id="user' + data[i].user.id +
                                '" class="text-success userDetails"' +
                                'data-bs-toggle="modal" data-bs-target="#userDetailsModal">' +
                                '<i class="far fa-user-circle"></i> ' + data[i].user.name +
                                ' ' +
                                data[i]
                                .user.lastname +
                                '</a> </div> <div style="margin-top: -0.9rem;"> <i class="fas fa-clock text-dark" style="font-size: 8pt;"></i> <span style="font-size: 8pt;">' +
                                data[i].sent_at + '</span></div><div>' +
                                data[i].message +
                                '</div>');
                        }

                        selectedUsers = [];
                    },
                    error: function(data) {
                        sendNotification('error', 'Error', data, 'slide');
                    }
                });
            }

        });
    </script>
@endpush
