@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-lg-5 ">
        <div class="card">
            <div class="card-header mt-1">
                Detail Siswa Ikut Materi
            </div>
            <hr>
            <div class="card-body">
                <table class="table" style="width: 100%;">
                    <tr>
                        <td style="border-bottom: none;" width="45%">Materi</td>
                        <td style="border-bottom: none;" width="2%">:</td>
                        <td style="border-bottom: none;">{{ $data['namaKelas'] }}</</td>
                    </tr>
                    <tr>
                        <td style="border-bottom: none;">Total Siswa Berdiskusi</td>
                        <td style="border-bottom: none;">:</td>
                        <td style="border-bottom: none;">{{ $data['totalSiswa'] }}</</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
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
                                <th>Discussion</th>
                                <th>Balasan</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discussion as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name ?? 'Unknown User' }}</td>
                                    <td>{{ $item->discussion ?? 'No Discussion' }}</td>
                                    <td>{{ $item->reply->message ?? 'TIdak Ada Balasan' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary btn-reply" data-href="{{ route('reply.discussion', $item->id)}}" type="button" >Balas</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="createModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCreate">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Balas Diskusi</label>
                                <textarea type="text" placeholder="balas diskusi ini" class="form-control" name="message" id="message"></textarea>
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
        $('.btn-reply').on('click', function(){
            console.log('klik');
            
            const url = $(this).data('href');
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
                    
                    $('#dataTable').DataTable().reload();
                }).fail(error => {
                    ajaxErrorHandling(error);
                })
            })
        });
    </script>
@endsection
