@extends('layouts.app')

@section('content')
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!--  SIDEBAR -->
        @include('partials.sidebar_guru')

        <!--  Main wrapper -->
        <div class="body-wrapper bg-white">
            <!--  NAVBAR -->
            @include('partials.navbar')

            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <!-- NAV TABS -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="classes-tab" data-bs-toggle="tab"
                                    data-bs-target="#classes" type="button" role="tab" aria-controls="classes"
                                    aria-selected="true">Class 1</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="schools-tab" data-bs-toggle="tab" data-bs-target="#schools"
                                    type="button" role="tab" aria-controls="schools"
                                    aria-selected="false">Class 2</button>
                            </li>
                        </ul>

                        <div class="tab-content mt-3" id="myTabContent">
                            <!-- Classes Tab -->
                            <div class="tab-pane fade show active" id="classes" role="tabpanel"
                                aria-labelledby="classes-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Class ID</th>
                                                <th>Class Name</th>
                                                <th>School ID</th>
                                                <th>Grade</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($classes->isEmpty())
                                                <tr>
                                                    <td colspan="6" class="text-center">
                                                        <div class="py-4">
                                                            <img src="{{ asset('assets/icons/close.png') }}" alt="No Data"
                                                                width="40">
                                                            <p class="mt-2 text-muted">Tidak ada data kelas.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($classes as $class)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $class->class_id }}</td>
                                                        <td>{{ $class->class_name }}</td>
                                                        <td>{{ $class->school_id }}</td>
                                                        <td>{{ $class->grade }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-secondary btn-sm dropdown-toggle"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    Menu
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a class="dropdown-item" href="#">
                                                                            <i class="fas fa-edit text-primary"></i> Edit
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item text-danger" href="#">
                                                                            <i class="fas fa-trash-alt"></i> Delete
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Schools Tab -->
                            <div class="tab-pane fade" id="schools" role="tabpanel" aria-labelledby="schools-tab">
                                <p class="text-muted mt-3">Informasi sekolah akan ditampilkan di sini.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FontAwesome for Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
@endsection
