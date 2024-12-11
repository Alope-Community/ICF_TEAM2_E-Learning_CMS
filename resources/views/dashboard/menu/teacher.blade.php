@extends('layouts.master')

@section('content')
    <div class="title">
        Dashboard
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-5">
                                <div class="text-center">
                                    <h1> <i class="ti ti-user text-primary"></i></h1>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category"> Total Siswa </p>
                                    <h4 class="card-title">{{ App\Models\User::where('role', 'User')->count() }} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-5">
                                <div class="text-center">
                                    <h1> <i class="ti ti-receipt text-primary"></i></h1>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category"> Total Kategori Materi</p>
                                    <h4 class="card-title">{{ App\Models\CategoryCourse::all()->count() }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-5">
                                <div class="text-center">
                                    <h1> <i class="ti-video-clapper text-primary"></i></h1>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category"> Total Materi </p>
                                    <h4 class="card-title">{{ App\Models\Course::all()->count() }} </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
