@extends('layouts.master')

@section('content')
    <div class="col-lg-12 card">
        <div class="card-header mt-1">
            Data User
            <div class="float-end">
                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"
                    data-bs-target="#createModal">Tambah +</button>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formCreate">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Nama</label>
                                    <input type="text" placeholder="Inputkan nama" class="form-control" id="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Email</label>
                                    <input type="email" placeholder="Inputkan email" class="form-control" id="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="disableInput" class="form-label">Role</label>
                                    <input type="text" disabled class="form-control" value="Teacher" id="role">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="disableInput" class="form-label">Password</label>
                                    <input type="text" class="form-control" id="password">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    ajax: {
                        url: "{{ route('users') }}"
                    },
                    columns: [{
                            data: 'name',
                            name: "name",
                        },
                        {
                            data: 'email',
                            name: "email",
                        },
                        {
                            data: 'role',
                            name: "role",
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false,
                        },
                    ],
                    drawCallback: settings => {
                        renderedEvent()
                    }
                })
                const reloadDT = () => {
                    $('#dataTable').DataTable().ajax.reload();
                }

                const renderedEvent = () => {
                    $.each($('.btn-delete'), (i, deleteBtn) => {
                        $(deleteBtn).off('click')
                        $(deleteBtn).on('click', function() {
                            let {
                                deleteMessage,
                                deleteHref
                            } = $(this).data();

                            confirmation(deleteMessage, function() {
                                ajaxSetup()
                                $.ajax({
                                        url: deleteHref,
                                        method: 'GET',
                                        dataType: 'json'
                                    })
                                    .done(response => {
                                        let {
                                            message
                                        } = response
                                        successNotification('Berhasil', message)
                                        reloadDT();
                                    })
                                    .fail(error => {
                                        ajaxErrorHandling(error);
                                    })
                            })
                        })
                    })
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#submit').off('click').on('click', function(e) {
                    e.preventDefault();

                    const form = {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        role: $('#role').val(),
                        password: $('#password').val()
                    };

                    if (!form.name || !form.email || !form.role || !form.password) {
                        warningNotification('Peringatan', 'Form harap di isi')
                        return;
                    }

                    $.ajax({
                        url: `http://127.0.0.1:8000/api/auth/register`,
                        type: 'POST',
                        data: JSON.stringify(form),
                        contentType: 'application/json',
                        success: function(response) {
                            $('#createModal').modal('hide')
                            ajaxSuccessHandling(response)
                            $('#formCreate')[0].reset();
                            reloadDT()
                        },
                        error: function(error) {
                            ajaxErrorHandling(error)
                        }
                    });
                });
            });
        </script>
    @endsection
