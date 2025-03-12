@extends('layouts.app')

@section('content')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('partials.sidebar_superadmin')

        <!--  Main wrapper -->
        <div class="body-wrapper bg-white">

            <!--  NAVBAR -->
            @include('partials.navbar')

            <div class="container-fluid">

                <!-- HEADER & BUTTON -->
                <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                    <h3 class="card-title d-flex align-items-center gap-2 mb-0">
                        Manage your Photo
                    </h3>

                    <!-- ADD BUTTON -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPhotoModal">
                        <i class="fas fa-plus"></i> Add Photo
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th width="30">No</th>
                                <th>Title</th>
                                <th>School ID</th>
                                <th>Class ID</th>
                                <th>Student ID</th>
                                <th>Photo</th>
                                <th>Description</th>
                                <th>Photo type</th>
                                <th>Location</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($photos->isEmpty())
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <div class="py-4">
                                            <img src="{{ asset('assets/icons/close.png') }}" alt="No Data" width="40">
                                            <p class="mt-2 text-muted">Tidak ada data Photo.</p>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($photos as $photo)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $photo->title }}</td>
                                        <td>{{ $photo->school_id }}</td>
                                        <td>{{ $photo->class_id }}</td>
                                        <td>{{ $photo->student_id }}</td>
                                        <td>{{ $photo->description }}</td>
                                        <td>{{ $photo->photo_type }}</td>
                                        <td>{{ $photo->location }}</td>
                                        <td>
                                            @if ($photo->image)
                                                <img src="{{ asset('storage/' . $note->image) }}" width="50">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Menu
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#editStudentModal{{ $photo->id }}">
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
                                    <div class="modal fade" id="editModal{{ $photo->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content p-3 border-0 rounded-4">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Photo</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="editFacilitasForm" {{-- action="{{ route('superadmin.photos.update', ['id' => $school->id]) }}" --}} method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Title</label>
                                                            <input type="text" class="form-control" id="title"
                                                                name="title" value="{{ old('title', $school->title) }}"
                                                                required>
                                                        </div>

                                                        <!-- School ID -->
                                                        <div class="mb-3">
                                                            <label for="school_id" class="form-label">School</label>
                                                            <select class="form-control" name="school_id" required>
                                                                @foreach ($schools as $school)
                                                                    <option value="{{ $school->id }}"
                                                                        {{ $photo->school_id == $school->id ? 'selected' : '' }}>
                                                                        {{ $school->name_school }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Class ID -->
                                                        {{-- <div class="mb-3">
                                                            <label for="class_id" class="form-label">Select Kelas</label>
                                                            <select name="class_id" id="class_id" class="form-control"
                                                                required>
                                                                <option value="">-- Choose School --</option>
                                                                @foreach ($chools as $school)
                                                                    <option value="{{ $school->id }}">
                                                                        {{ $school->fullname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div> --}}

                                                        <div class="mb-3">
                                                            <label for="image" class="form-label">Image</label>
                                                            <input type="file" class="form-control" id="class_id"
                                                                name="class_id"
                                                                value="{{ old('class_id', $school->class_id) }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="desciption" class="form-label">Description</label>
                                                            <input type="text-area" class="form-control" id="desciption"
                                                                name="desciption"
                                                                value="{{ old('desciption', $photo->desciption) }}"
                                                                required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="photo_type" class="form-label">Photo Type</label>
                                                            <input type="text" class="form-control" id="region"
                                                                name="photo_type"
                                                                value="{{ old('region', $school->region) }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="student_id" class="form-label">Student ID</label>
                                                            <input type="text" class="form-control" id="student_id"
                                                                name="student_id"
                                                                value="{{ old('student_id', $student->student_id) }}"
                                                                required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="location" class="form-label">lokasi</label>
                                                            <input type="text" class="form-control" id="location"
                                                                name="email"
                                                                value="{{ old('location', $photo->location) }}" required>
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
                                @endforeach
                            @endif
                        </tbody>

                    </table>
                    {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ADD PHOTO -->
    <div class="modal fade" id="addPhotoModal" tabindex="-1" aria-labelledby="addPhotoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPhotoModalLabel">Add New Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="school_id" class="form-label">Select School</label>
                            <select name="school_id" id="school_id" class="form-control" required>
                                <option value="">-- Choose School --</option>
                                @foreach ($schools as $school)
                                    <option value="{{ $school->id }}">{{ $school->name_school }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="class_id" class="form-label">Select Class</label>
                            <select name="class_id" id="class_id" class="form-control" required>
                                <option value="">-- Choose Class --</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->class_id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="student_id" class="form-label">Select Student</label>
                            <select name="student_id" id="student_id" class="form-control" required>
                                <option value="">-- Choose Student --</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->student_id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo Type</label>
                            <input type="file" class="form-control" id="photo" name="photo" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" required>
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
    $(document).ready(function () {
        // Ketika School dipilih, ambil daftar kelas berdasarkan school_id
        $('#school_id').change(function () {
            var schoolId = $(this).val();
            $('#class_id').empty().append('<option value="">-- Choose Class --</option>');
            $('#student_id').empty().append('<option value="">-- Choose Student --</option>');
            
            if (schoolId) {
                $.ajax({
                    url: "{{ route('superadmin.photos.getClasses') }}",
                    type: "GET",
                    data: { school_id: schoolId },
                    dataType: "json",
                    success: function (data) {
                        $.each(data, function (key, value) {
                            $('#class_id').append('<option value="' + value.id + '">' + value.class_id + '</option>');
                        });
                    }
                });
            }
        });

        // Ketika Class dipilih, ambil daftar siswa berdasarkan class_id
        $('#class_id').change(function () {
            var classId = $(this).val();
            $('#student_id').empty().append('<option value="">-- Choose Student --</option>');
            
            if (classId) {
                $.ajax({
                    url: "{{ route('superadmin.photos.getStudents') }}",
                    type: "GET",
                    data: { class_id: classId },
                    dataType: "json",
                    success: function (data) {
                        $.each(data, function (key, value) {
                            $('#student_id').append('<option value="' + value.id + '">' + value.student_id + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>

