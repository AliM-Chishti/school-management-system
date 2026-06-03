@extends('layout.app')

@section('title', 'Teachers')
@section('page-title', 'Teacher Module')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-person-workspace"></i> Teachers List</span>
        <a href="{{ route('teachers.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Register Teacher
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Qualification</th>
                    <th>Status</th>
                    <th>Courses</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $teacher)
                <tr>
                    <td><strong>{{ $teacher->employee_id }}</strong></td>
                    <td>{{ $teacher->full_name }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->qualification }}</td>
                    <td>
                        @if($teacher->status === 'Active')
                            <span class="badge badge-success">{{ $teacher->status }}</span>
                        @elseif($teacher->status === 'On Leave')
                            <span class="badge badge-warning">{{ $teacher->status }}</span>
                        @else
                            <span class="badge badge-danger">{{ $teacher->status }}</span>
                        @endif
                    </td>
                    <td><span class="badge badge-info">{{ $teacher->courses_count }}</span></td>
                    <td>
                        <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('teachers.destroy', $teacher) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No teachers found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $teachers->links() }}
</div>
@endsection
