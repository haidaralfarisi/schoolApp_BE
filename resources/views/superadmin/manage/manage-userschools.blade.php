@extends('layouts.app')

@section('content')
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!--  SIDEBAR -->
        @include('partials.sidebar_superadmin')

        <!--  Main wrapper -->
        <div class="body-wrapper bg-white">

            <!--  NAVBAR -->
            @include('partials.navbar')

            <div class="container-fluid">

                <!-- HEADER & BUTTON -->
                <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                    <h3 class="card-title d-flex align-items-center gap-2 mb-0">
                        Manage User Schools
                    </h3>

                    <!-- ADD BUTTON -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assignSchoolModal">
                        <i class="fas fa-plus"></i> Add User School
                    </button>
                </div>

                <!-- SUCCESS MESSAGE -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- ERROR MESSAGE -->
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th width="30">No</th>
                                <th>Full Name</th>
                                <th>Level</th>
                                <th>School Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($user_schools as $us)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $us->user->fullname }}</td>
                                    <td>{{ $us->user->level }}</td>
                                    <td>{{ $us->school->school_name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Menu
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $us->id }}">
                                                        <i class="fas fa-edit text-primary"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('superadmin.users.destroy', $us->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <!-- MODAL EDIT -->
                                <div class="modal fade" id="editModal{{ $us->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content p-3 border-0 rounded-4">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editModalLabel">Edit Data User School</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('superadmin.manage-userschools.update', $us->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <!-- Full Name -->
                                                    <div class="mb-3">
                                                        <label for="user_id" class="form-label">Full Name</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $us->user->fullname }}" readonly>

                                                        <!-- Hidden Input untuk Mengirimkan ID ke Backend -->
                                                        <input type="hidden" name="user_id" value="{{ $us->user_id }}">
                                                    </div>


                                                    <!-- School -->
                                                    <div class="mb-3">
                                                        <label for="school_id" class="form-label">School</label>
                                                        <select class="form-select" id="school_id" name="school_id"
                                                            required>
                                                            @foreach ($schools as $school)
                                                                <option value="{{ $school->id }}"
                                                                    {{ $school->school_id == $us->school->school_id ? 'selected' : '' }}>
                                                                    {{ $school->school_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <div class="py-4">
                                            <img src="{{ asset('assets/icons/close.png') }}" alt="No Data" width="40">
                                            <p class="mt-2 text-muted">Tidak ada data Siswa.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL ASSIGN SCHOOL -->
    <div class="modal fade" id="assignSchoolModal" tabindex="-1" aria-labelledby="assignSchoolModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignSchoolModalLabel">Assign User to School</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('superadmin.manage-userschools.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Select User</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="">-- Choose User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="school_id" class="form-label">Select School</label>
                            <select name="school_id" id="school_id" class="form-control" required>
                                <option value="">-- Choose School --</option>
                                @foreach ($schools as $school)
                                    <option value="{{ $school->school_id }}">{{ $school->school_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
@endsection
