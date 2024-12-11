@extends('layouts.master')
@section('content')
    <div class="col-lg-4 card">
        <div class="card-header mt-1">Profile</div>
        <hr>
        <div class="card-body">
            <form id="formUpdate">
                <div class="form col-lg-12">
                    <label for="basicInput" class="form-label">Nama</label>
                    <input type="text" placeholder="Inputkan nama" class="form-control" value="{{ auth()->user()->name }}" name="name">
                </div>
                <div class="form col-lg-12">
                    <label for="basicInput" class="form-label">Email</label>
                    <input type="text" placeholder="Inputkan nama" class="form-control" value="{{ auth()->user()->email }}" name="email">
                </div>
                <div class="form col-lg-12">
                    <label for="basicInput" class="form-label">Gender</label>
                    <select name="gender" class="form-control" id="gender">
                        <option selected disabled>Inputkan Gender</option>
                        <option value="Laki-laki">Pria</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form col-lg-12">
                    <label for="basicInput" class="form-label">Domisili</label>
                    <input type="text" placeholder="Inputkan Nomor Hp" class="form-control" value="{{ auth()->user()->phone }}" name="phone" >
                </div>
                <div class="mt-2 mb-2">
                    <hr>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Update Profil</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
          const form = $('#formUpdate')
        ajaxSetup()
        form.on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();

            ajaxSetup();
            $.ajax({
                url: "{{ route('setings.profile') }}",
                method: 'POST',
                data: formData,
                dataType: 'json',
            }).done(response => {
                let {
                    message
                } = response;

                successNotification('Berhasil', message);
                reloadDT();

            }).fail(error => {
                ajaxErrorHandling(error);
            })
        })
    </script>
@endsection
