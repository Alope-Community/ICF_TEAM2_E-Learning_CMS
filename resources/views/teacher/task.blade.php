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
                        <th>course_id</th>
                        <th>task</th>
                        <th>created_at</th>
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
        })

</script>

@endsection
