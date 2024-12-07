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
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Create Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formCreate">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Nama</label>
                                    <input type="text" placeholder="Inputkan nama" class="form-control" name="name"
                                        id="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="disableInput" class="form-label">URL Image</label>
                                    <input type="link" class="form-control" name="image" id="image">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Deskripsi</label>
                                    <textarea type="text" placeholder="Inputkan Deskripsi" name="description" class="form-control" id="description"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formUpdate">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Nama</label>
                                    <input type="text" placeholder="Inputkan nama" class="form-control" name="name"
                                        id="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="disableInput" class="form-label">URL Image</label>
                                    <input type="url" class="form-control" placeholder="Masukan Url Image"
                                        name="image" id="image">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Deskripsi</label>
                                    <textarea type="text" placeholder="Inputkan Deskripsi" name="description" class="form-control" id="description"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('categoryCourse') }}"
            },
            columns: [{
                    data: 'name',
                    name: "name",
                },
                {
                    data: 'description',
                    name: "description",
                },
                {
                    data: 'image',
                    name: "image",
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

        const formUpdate = $('#formUpdate')
        const modalUpdate = $('#updateModal')

        const renderedEvent = () => {
            $.each($('.btn-edit'), (i, editBtn) => {
                $(editBtn).off('click')
                $(editBtn).on('click', function() {
                    let {
                        editHref,
                        getHref
                    } = $(this).data();

                    $.get({
                            url: getHref,
                            dataType: 'json'
                        })
                        .done(response => {
                            let {
                                category
                            } = response;

                            clearInvalid();
                            modalUpdate.modal('show')
                            // formUpdate.attr('action', editHref)
                            formUpdate.find(`[name="name"]`).val(category
                                .name);
                            formUpdate.find(`[name="description"]`).append(category
                                .description);
                            formUpdate.find(`[name="image"]`).val(category.image);

                            console.log(editHref)

                            formSubmit(
                                modalUpdate,
                                formUpdate,
                                editHref,
                                'PUT',
                                () => {
                                    $('#formCreate')[0].reset()
                                }
                            )


                        })
                        .fail(error => {
                            ajaxErrorHandling(error);
                        })
                })
            })

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
                                console.log(response);

                                let {
                                    message
                                } = response
                                successNotification('Berhasil', 'Data Berhasil Di Hapus')
                                reloadDT();
                            })
                            .fail(error => {
                                ajaxErrorHandling(error);
                            })
                    })
                })
            })
        }


        const formSubmit = ($modal, $form, $href, $method, addedAction = null) => {
            $form.off('submit')
            $form.on('submit', function(e) {
                e.preventDefault();
                clearInvalid();

                let formData = $(this).serialize();
                console.log('keKlik');


                ajaxSetup();
                $.ajax({
                    url: $href,
                    method: $method,
                    data: formData,
                    dataType: 'json',
                }).done(response => {
                    let {
                        message
                    } = response;
                    console.log(message);

                    successNotification('Berhasil', message);
                    reloadDT();

                    $modal.modal('hide');

                    if (addedAction) {
                        addedAction();
                    }
                }).fail(error => {
                    ajaxErrorHandling(error);
                })
            })
        }


        const form = $('#formCreate')
        // create data
        formSubmit(
            $('#createModal'),
            form,
            "{{ route('categoryCourse.create') }}",
            'POST',
            () => {
                $('#formCreate')[0].reset()
            }
        )
    </script>
@endsection
