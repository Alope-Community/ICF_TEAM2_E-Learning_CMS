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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enrolment as $item)
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $item->user->name }}</th>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
