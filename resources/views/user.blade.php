@extends('layouts.master')

@push('css')
<link href="{{ asset('') }}vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<link href="{{ asset('') }}vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" />
@endpush
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- jQuery -->
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}
@section('content')

<div class="content-wrapper">
    <div class="row same-hight">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>users</h4>
                </div>
                <div class="card-body">
                    {{ $dataTable -> table() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>

 </script>
@endsection

@push('js')
<script src="{{ asset('') }}vendor/jquery/jquery.min.js"></script>
<script src="{{ asset('') }}vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('') }}vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
{{ $dataTable->scripts() }}
@endpush
