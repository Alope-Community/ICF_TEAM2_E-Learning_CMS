@extends('layouts.master')
@section('content')
    <div class="col-lg-4 card">
        <div class="card-header mt-1">Profile</div>
        <hr>
        <div class="card-body">
            <form id="formUpdate">
                <div class="form col-lg-12">
                    <label for="basicInput" class="form-label">Nama</label>
                    <input type="text" placeholder="Inputkan nama" class="form-control" value="{{ auth()->user()->name }}" name="name" id="name">
                </div>
                <div class="form col-lg-12">
                    <label for="basicInput" class="form-label">Email</label>
                    <input type="text" placeholder="Inputkan nama" class="form-control" value="{{ auth()->user()->email }}" name="name" id="name">
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
                    <textarea type="text" placeholder="Inputkan Domisili" class="form-control" value="{{ auth()->user()->domisili }}" name="domisili" id="domisili"></textarea>
                </div>
                <div class="mt-2 mb-2">
                    <hr>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Update Profil</button>
            </form>
        </div>
    </div>
@endsection
