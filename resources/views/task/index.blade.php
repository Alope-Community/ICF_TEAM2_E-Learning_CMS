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
                            <th>Materi</th>
                            <th>Tugas</th>
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
                                    <input type="text" placeholder="Inputkan nama tugas" class="form-control"
                                        name="task">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Nama Kelas</label>
                                    <select class="js-example-basic-single form-select" name="course_id">
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}"> {{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formUpdate">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Nama Tugas</label>
                                    <input type="text" placeholder="Inputkan nama tugas" class="form-control"
                                        name="task">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Nama Kelas</label>
                                    <select class="js-example-basic-single form-select" name="course_id">
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}"> {{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="submit" class="btn btn-primary">Save changes</button>
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
                    url: "{{ route('tasks') }}"
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
                    renderedEvent()
                }

            });

            const formUpdate = $('#formUpdate')
            const updateModal = $('#updateModal')

            const renderedEvent = () => {
                $.each($('.btn-edit'), (i, editBtn) => {
                    $(editBtn).off('click');
                    $(editBtn).on('click', function() {
                        let {
                            editHref,
                            getHref
                        } = $(this).data();
                        ajaxSetup();
                        $.get({
                            url: getHref,
                            dataType: 'json'
                        }).done(response => {
                            let {
                                task
                            } = response;

                            clearInvalid();
                            updateModal.modal('show');

                            formUpdate.find(`[name="task"]`).val(task.task);
                            formUpdate.find(`[name="course_id"]`).val(task.course_id);

                            formSubmit(
                                updateModal,
                                formUpdate,
                                editHref,
                                'PUT',
                                () => {
                                    formUpdate[0].reset()
                                }
                            )

                        }).fail(error => {
                            ajaxErrorHandling(error);
                        })
                    });
                });

                $.each($('.btn-delete'), (i, deleteBtn) => {
                $(deleteBtn).off('click')
                $(deleteBtn).on('click', function() {
                    let {
                        deleteHref
                    } = $(this).data();
                    console.log();


                    confirmation('apkah yakin??', function() {
                        ajaxSetup()
                        $.ajax({
                                url: deleteHref,
                                method: 'GET',
                                dataType: 'json'
                            })
                            .done(response => {
                                console.log(response);

                                let {
                                    message
                                } = response
                                successNotification('Berhasil',
                                    'Data Berhasil Di Hapus')
                                reloadDT();
                            })
                            .fail(error => {
                                ajaxErrorHandling(error);
                            })
                    })
                })
            })
            }



            const reloadDT = () => {
                $('#dataTable').DataTable().ajax.reload();
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const formSubmit = (modal, form, href, method, addedAction = null) => {
                form.off('submit');
                form.on('submit', function(e) {
                    e.preventDefault();
                    let formData = $(this).serialize();

                    // console.log(data);

                    ajaxSetup();
                    $.ajax({
                        url: href,
                        method: method,
                        data: formData,
                        dataType: 'json'
                    }).done(response => {
                        let {
                            message
                        } = response;

                        successNotification('berhasil', message);
                        reloadDT();

                        if (addedAction) {
                            addedAction();
                        }
                    }).fail(error => {
                        ajaxErrorHandling(error);
                    })
                });

            }

            // $('#submit').off('click').on('click', function(e) {
            //     e.preventDefault();

            //     const form = {
            //         course_id: $('#course_id').val(),
            //         task: $('#task').val()
            //     };

            //     if (!form.course_id || !form.task ) {
            //         warningNotification('Peringatan', 'Form harap di isi')
            //         return;
            //     }

            //     $.ajax({
            //         url: `{{ route('task.store') }}`,
            //         type: 'POST',
            //         data: form,
            //         success: function(response) {
            //             $('#createModal').modal('hide')
            //             ajaxSuccessHandling(response)
            //             $('#formCreate')[0].reset();
            //             reloadDT();
            //         },
            //         error: function(error) {
            //             ajaxErrorHandling(error)
            //         }
            //         });
            // });

            formSubmit(
                $('#createModal'),
                $('#formCreate'),
                "{{ route('task.store') }}",
                'POST',
                () => {
                    $('#formCreate')[0].reset();
                }
            )

        })
    </script>
@endsection
