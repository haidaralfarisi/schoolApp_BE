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
                        Manage Your Video
                    </h3>

                    <!-- ADD BUTTON -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addVideoModal">
                        <i class="fas fa-plus"></i> Add Video
                    </button>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="30">No</th>
                            <th>Title</th>
                            <th>School ID</th>
                            <th>Class ID</th>
                            <th>Url</th>
                            {{-- <th>Description</th> --}}
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($videos->isEmpty())
                            <tr>
                                <td colspan="10" class="text-center">
                                    <div class="py-4">
                                        <img src="{{ asset('assets/icons/close.png') }}" alt="No Data" width="40">
                                        <p class="mt-2 text-muted">Tidak ada data Video.</p>
                                    </div>
                                </td>
                            </tr>
                        @else
                            @foreach ($videos as $video)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $video->title }}</td>
                                    <td>{{ $video->school->school_name }}</td>
                                    <td>{{ $video->schoolClass->class_id ?? '' }}</td>
                                    <td>{{ $video->url }}</td>
                                    {{-- <td>{{ $video->description }}</td> --}}
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Menu
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editStudentModal{{ $video->id }}">
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

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editStudentModal{{ $video->id }}" tabindex="-1"
                                    aria-labelledby="editStudentModalLabel{{ $video->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editStudentModalLabel{{ $video->id }}">
                                                    Edit Data E-report
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{-- <form action="{{ route('superadmin.videos.update', $video->id) }}" method="POST"> --}}
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-3">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="fullname"
                                                        value="{{ $video->title }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="school_id" class="form-label">School</label>
                                                    <select class="form-select" id="school_id" name="school_id" required>
                                                        <option value="" disabled selected>Pilih Nama Sekolah</option>
                                                        @foreach ($schools as $school)
                                                            <option value="{{ $school->id }}"
                                                                {{ old('class_id', $video->school->id ?? '') == $school->id ? 'selected' : '' }}>
                                                                {{ $school->name_school }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="class_id" class="form-label">Class</label>
                                                    <select class="form-select" id="class_id" name="class_id" required>
                                                        <option value="" disabled selected>Pilih Nama Class</option>
                                                        @foreach ($schoolClasses as $schoolClass)
                                                            <option value="{{ $schoolClass->id }}"
                                                                {{ old('class_id', $video->schoolClass->id ?? '') == $schoolClass->id ? 'selected' : '' }}>
                                                                {{ $schoolClass->class_id }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Description</label>
                                                    <textarea class="form-control" name="description" rows="4" required>{{ $video->description }}
                                                    </textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">URL</label>
                                                    <input type="text" class="form-control" name="url"
                                                        value="{{ $video->url }}" required>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save
                                                        Changes</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </tbody>

                </table>
                {{-- {{ $users->links() }} --}}
            </div>
        </div>
    </div>

    <!-- MODAL ADD VIDEO -->
    <div class="modal fade" id="addVideoModal" tabindex="-1" aria-labelledby="addVideoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVideoModalLabel">Add New Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('superadmin.videos.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="school_id" class="form-label">School</label>
                            <select class="form-control" id="school_id" name="school_id" required>
                                <option value="">-- Select School --</option>
                                @foreach ($schools as $school)
                                    <option value="{{ $school->id }}">{{ $school->name_school }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="class_id" class="form-label">Class</label>
                            <select class="form-control" id="class_id" name="class_id" required>
                                <option value="">-- Select Class --</option>
                                @foreach ($schoolClasses as $schoolClass)
                                    <option value="{{ $schoolClass->id }}">{{ $schoolClass->class_id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="text" class="form-control" id="url" name="url" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- FontAwesome for Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#school_id').change(function() {
            var schoolId = $(this).val();
            if (schoolId) {
                $.ajax({
                    url: "{{ route('superadmin.videos.getClasses') }}",
                    type: "GET",
                    data: {
                        school_id: schoolId
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#class_id').empty();
                        $('#class_id').append(
                            '<option value="">-- Select Class --</option>');
                        $.each(data, function(key, value) {
                            $('#class_id').append('<option value="' + value.id +
                                '">' + value.class_id + '</option>');
                        });
                    }
                });
            } else {
                $('#class_id').empty();
                $('#class_id').append('<option value="">-- Select Class --</option>');
            }
        });
    });
</script>
