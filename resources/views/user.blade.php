@extends('layouts.master')

{{-- @push('css')
<link href="{{ asset('') }}vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="{{ asset('') }}vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
@endpush --}}
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- jQuery -->
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}
@section('content')

<div class="col-lg-12 card">
    <div class="card-header mt-1">
        Data User
        <div class="float-end">
            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createModal">Tambah +</button>
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

                        <div class="modal fade" id="createModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
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
                                                    <input type="text" disabled class="form-control" value="{{ Str::random(20) }}" id="password">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" id="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>


@endsection

@section('scripts')
<script>
    $(document).ready(function (){
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

            }
        })

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
                alert('Harap isi semua kolom!');
                return;
            }

            console.log(form);

            $.ajax({
                url: `http://127.0.0.1:8000/api/auth/register`,
                type: 'POST',
                data: JSON.stringify(form),
                contentType: 'application/json',
                success: function(response) {
                    alert('Pendaftaran berhasil!');
                    $('#form')[0].reset();
                    $('#dataTable').DataTable().ajax.reload();
                },
                error: function(error) {
                    console.log('Request gagal:', error);
                    alert(error.responseJSON.message || 'Terjadi kesalahan!');
                }
            });
        });
    });


</script>
@endsection
