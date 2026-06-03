@extends('layout.app')

@section('title', 'Students')
@section('page-title', 'Student Admission Module')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-people-fill"></i> Students List</span>
        <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add New Student
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Enrollment No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Admission Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td><strong>{{ $student->enrollment_no }}</strong></td>
                    <td>{{ $student->full_name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>
                        @if($student->admission_status === 'Active')
                            <span class="badge badge-success">{{ $student->admission_status }}</span>
                        @elseif($student->admission_status === 'Inactive')
                            <span class="badge badge-info">{{ $student->admission_status }}</span>
                        @else
                            <span class="badge badge-danger">{{ $student->admission_status }}</span>
                        @endif
                    </td>
                    <td>{{ $student->admission_date->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('students.destroy', $student) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No students found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $students->links() }}
</div>
@endsection