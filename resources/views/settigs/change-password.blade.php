@extends('layouts.master')
@section('content')
    <div class="col-lg-4 card">
        <div class="card-header mt-1">Profile</div>
        <hr>
        <div class="card-body">
            <form id="formChangePassword">
                <div class="form col-lg-12">
                    <label for="basicInput" class="form-label">Password Lama</label>
                    <input type="text" placeholder="Inputkan paswword lama" class="form-control" name="old_password"
                        id="name">
                </div>
                <div class="form col-lg-12">
                    <label for="basicInput" class="form-label">Password Baru</label>
                    <input type="text" placeholder="Inputkan password baru" class="form-control" name="new_password"
                        id="name">
                </div>
                <div class="form col-lg-12">
                    <label for="basicInput" class="form-label">Konfirmasi Password</label>
                    <input type="text" placeholder="konfirmasi password" class="form-control" name="confirm_password"
                        id="name">
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
        const form = $('#formChangePassword')
        ajaxSetup()
        form.on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();

            ajaxSetup();
            $.ajax({
                url: "{{ route('setings.changePassword') }}",
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
