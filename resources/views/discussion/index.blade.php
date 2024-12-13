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
                        <td style="border-bottom: none;">Total Siswa</td>
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
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discussion as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name ?? 'Unknown User' }}</td>
                                    <td>{{ $item->discussion ?? 'No Discussion' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#createModal">Balas</button>
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
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Nama</label>
                                <input type="text" placeholder="Inputkan nama" class="form-control" name="name"
                                    id="name">
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
    </script>
@endsection
