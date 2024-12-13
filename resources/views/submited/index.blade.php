@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-4 ">
            <div class="card">
                <div class="card-header mt-1">
                    Detail Siswa Ikut Materi
                </div>
                <hr>
                <div class="card-body">
                    <table class="table" style="width: 100%;">
                        <tr>
                            <td style="border-bottom: none;">Soal Tugas</td>
                            <td style="border-bottom: none;">:</td>
                            <td style="border-bottom: none;">{{ $data ? $data['soalTugas'] : 'Data Belum Ada' }}</</td>
                        </tr>
                            <td style="border-bottom: none;">Total Siswa Mengumpulkan</td>
                            <td style="border-bottom: none;">:</td>
                            <td style="border-bottom: none;">{{ $data ? $data['totalPengumpulan'] : 'Data Belum Ada'}}</</td>
                        </tr>
    
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header mt-1">
                    Detail Siswa Ikut Materi
                </div>
                <hr>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10%">No</th>
                                    <th>Nama</th>
                                    <th>File Tugas</th>
                                    <th>Nilai</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($submited as $item)
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $item->user->name }}</th>
                                    <th>
                                        @if ($item)
                                            <a href="{{ asset('storage/task_submited/'.$item->file) }}" target="blank" class="text-success">Lihat File</a>
                                        @else
                                            <span class="text-danger">Belum Ada</span>
                                        @endif
                                    </th>
                                    <th>{{ $item->grade ? $item->grade->grade : 'Belum Ada'  }}</th>
                                    <th>
                                        <button class="btn btn-sm btn-primary" data-id-item="{{ route('submited.grade', $item->id) }}" type="button" id="grade">Nilai +</button></th>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Nilai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formCreate">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Nilai</label>
                                    <input type="text" placeholder="Inputkan nama" class="form-control" name="grade">
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
            autoWidth: false,
        });

        const modal = $('#createModal')
        $('#grade').on('click', function(){
            const url = $(this).data('id-item');
            modal.modal('show');

            $('#formCreate').on('submit',function (e){
                e.preventDefault();

                const data = $(this).serialize();

                ajaxSetup();
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                }).done(response => {
                    let {
                        message
                    } = response;

                    successNotification('Berhasil', message);
                    reloadDT();

                    modal.modal('hide');

                }).fail(error => {
                    ajaxErrorHandling(error);
                })
            })
        });
    </script>
@endsection
