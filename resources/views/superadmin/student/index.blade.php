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
                        Manage Your Student
                        {{-- <span>
                                    <iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-custom-class="tooltip-success"
                                        data-bs-title="Traffic Overview"></iconify-icon>
                                </span> --}}
                    </h3>

                    <div>
                        <!-- ADD BUTTON -->
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClassModal">
                            <i class="fas fa-plus"></i> Add Student
                        </a>

                        <!-- Import Button -->
                        <a href="#" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#importStudentsModal">
                            <i class="fas fa-file-import"></i> Import Students
                        </a>
                    </div>

                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class>
                    <table class="table table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th width="30">No</th>
                                <th>Student ID</th>
                                <th>School ID</th>
                                <th>Class ID</th>
                                <th>NISN</th>
                                <th>Full Name</th>
                                {{-- <th>User Name</th> --}}
                                <th>Gender</th>
                                {{-- <th>Place Of Born</th> --}}
                                {{-- <th>Date Of Born</th> --}}
                                <th>Entry Year</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $student->student_id }}</td>
                                    <td>{{ $student->school_id }}</td>
                                    <td>{{ $student->class_id }}</td>
                                    <td>{{ $student->nisn }}</td>
                                    <td>{{ $student->fullname }}</td>
                                    {{-- <td>{{ $student->username }}</td> --}}
                                    <td>{{ $student->gender }}</td>
                                    {{-- <td>{{ $student->pob }}</td> --}}
                                    {{-- <td>{{ $student->dob }}</td> --}}
                                    <td>{{ $student->entry_year }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Menu
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editStudentModal{{ $student->id }}">
                                                        <i class="fas fa-edit text-primary"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <form
                                                        action="{{ route('superadmin.students.destroy', $student->student_id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this student?');">
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

                                <!-- Modal Untuk Edit User-->
                                {{-- Modal harus di dalam foreach dan harus meletakkan {{ $user->id }} agar bisa di panggil sesuai id yang
                                        di inginkan --}}
                                {{-- <div class="modal fade" id="editClassModal{{ $class->id }}" tabindex="-1"
                                    aria-labelledby="editClassModalLabel{{ $class->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editClassModalLabel">Edit
                                                    Class</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="editClassForm"
                                                    action="{{ route('tusekolah.classes.update', ['id' => $class->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <!-- Class ID (Readonly jika tidak boleh diubah) -->
                                                    <div class="mb-3">
                                                        <label for="class_id" class="form-label">Class
                                                            ID</label>
                                                        <input type="text" class="form-control" id="class_id"
                                                            name="class_id" value="{{ old('class_id', $class->class_id) }}"
                                                            required>
                                                    </div>

                                                    <!-- Class Name -->
                                                    <div class="mb-3">
                                                        <label for="class_name" class="form-label">Class
                                                            Name</label>
                                                        <input type="text" class="form-control" id="class_name"
                                                            name="class_name"
                                                            value="{{ old('class_name', $class->class_name) }}" required>
                                                    </div>

                                                    <!-- School ID (Dropdown) -->
                                                    <div class="mb-3">
                                                        <label for="school_id" class="form-label">School</label>
                                                        <select class="form-control" name="school_id" required>
                                                            @foreach ($schools as $school)
                                                                <option value="{{ $school->school_id }}"
                                                                    {{ old('school_id', $class->school_id) == $school->school_id ? 'selected' : '' }}>
                                                                    {{ $school->school_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>


                                                    <!-- Grade -->
                                                    <div class="mb-3">
                                                        <label for="grade" class="form-label">Grade</label>
                                                        <input type="number" class="form-control" id="grade"
                                                            name="grade" value="{{ old('grade', $class->grade) }}"
                                                            required>
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
                                </div> --}}
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ADD Class -->
    <div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClassModalLabel">Add New Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('superadmin.students.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student Id</label>
                            <input type="text" class="form-control" id="student_id" name="student_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="school_id" class="form-label">School ID</label>
                            <input type="text" value="{{ $school->school_id }}" class="form-control bg-light"
                                id="school_id" name="school_id" readonly required>
                        </div>
                        <div class="mb-3">
                            <label for="class_id" class="form-label">Class Id</label>
                            <select name="class_id" id="class_id" class="form-control" required>
                                <option value="">-- Choose Class --</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->class_id }}">{{ $class->class_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nisn" class="form-label">NISN</label>
                            <input type="text" class="form-control" id="nisn" name="nisn" required>
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="">-- Choose Gender --</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="pob" class="form-label">Place of Birth</label>
                            <input type="text" class="form-control" id="pob" name="pob" required>
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                        <div class="mb-3">
                            <label for="entry_year" class="form-label">Entry Year</label>
                            <input type="number" class="form-control" id="entry_year" name="entry_year" required>
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


    <!-- Modal Upload Excel -->
    <div class="modal fade" id="importStudentsModal" tabindex="-1" aria-labelledby="importStudentsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importStudentsModalLabel">
                        <i class="fas fa-file-excel"></i> Import Students from Excel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-grid gap-2 mb-3">
                        <a href="{{ route('students.template') }}" class="btn btn-info text-white">
                            <i class="fas fa-download"></i> Download Template
                        </a>
                    </div>
                    <form id="importStudentsForm" action="{{ route('superadmin.students.import') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label fw-bold">Upload Excel File</label>
                            <input type="file" class="form-control" name="file" id="file"
                                accept=".xls, .xlsx" required>
                            <small class="text-muted">Only .xls or .xlsx files allowed.</small>
                        </div>
                        <div id="uploadProgress" class="progress d-none">
                            <div id="uploadBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                style="width: 0%">0%</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i> Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Import
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- FontAwesome for Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
@endsection

<script>
    document.getElementById('importStudentsForm').addEventListener('submit', function(e) {
        const fileInput = document.getElementById('file');
        if (!fileInput.value) {
            alert('Please select an Excel file.');
            e.preventDefault();
            return;
        }

        document.getElementById('uploadProgress').classList.remove('d-none');
        const progressBar = document.getElementById('uploadBar');
        let width = 0;
        const interval = setInterval(() => {
            if (width >= 100) {
                clearInterval(interval);
            } else {
                width += 10;
                progressBar.style.width = width + '%';
                progressBar.innerText = width + '%';
            }
        }, 500);
    });
</script>
