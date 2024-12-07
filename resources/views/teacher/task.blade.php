@extends('layouts.master')

@section('content')

<div class="col-lg-12 card">
    <div class="card-header mt-1">
        Data kategori Materi
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
                        <th>course</th>
                        <th>task</th>
                        <th>created_at</th>
                        <th>action</th>
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
                                <label for="basicInput" class="form-label">Nama Tugas</label>
                                <input type="text" placeholder="Inputkan nama tugas" class="form-control" id="task">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Nama Kelas</label>
                                    <select class="js-example-basic-single form-select" id="course_id">
                                        @foreach($courses as $course)
                                        <option value="{{ $course->id }}"> {{ $course->name }}</option>
                                    @endforeach
                                    </select>
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
                    url: "{{ route('task.index') }}"
                },
                columns: [{
                        data: 'course_id',
                        name: "course_id",
                    },
                    {
                        data: 'task',
                        name: "task",
                    },
                    {
                        data: 'created_at',
                        name: "created_at",
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
    });

    const reloadDT = () => {
        $('#dataTable').DataTable().ajax.reload();
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#submit').off('click').on('click', function(e) {
        e.preventDefault();

        const form = {
            course_id: $('#course_id').val(),
            task: $('#task').val()
        };

        if (!form.course_id || !form.task ) {
            warningNotification('Peringatan', 'Form harap di isi')
            return;
        }

        $.ajax({
            url: `{{ route('task.store') }}`,
            type: 'POST',
            data: form,
            success: function(response) {
                $('#createModal').modal('hide')
                ajaxSuccessHandling(response)
                $('#formCreate')[0].reset();
                reloadDT();
            },
            error: function(error) {
                ajaxErrorHandling(error)
            }
            });
    });

    $('.btn-edit').on('click', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        if (!id) {
            console.error('ID tidak ditemukan di data-id.');
            return;
        }

        $.ajax({
            url: "{{ route('task.edit', ':id') }}".replace(':id', id),
            type: 'GET',
            success: function (response) {
                if (response.data) {
                    $('#task').val(response.data.task);
                    $('#course_id').val(response.data.course_id);
                } else {
                    console.error('Data tidak ditemukan dalam response.');
                }
            },
            error: function (xhr, status, error) {
                console.error('Request gagal:', xhr.responseText);
            }
        });
});

})

</script>

@endsection
