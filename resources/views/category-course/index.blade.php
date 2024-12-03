@extends('layouts.master')
@section('content')
    <div class="col-lg-12 card">
        <div class="card-header mt-1">
            Data kategori Materi
            <div class="float-end">
                <button class="btn btn-sm btn-primary">Tambah +</button>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                },
            ],
            drawCallback: settings => {

            }
        })
    </script>
@endsection
