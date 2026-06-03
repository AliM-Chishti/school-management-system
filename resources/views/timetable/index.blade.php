@extends('layout.app')

@section('title', 'Timetable')
@section('page-title', 'Class Schedule Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-calendar-event-fill"></i> Timetable Schedule</span>
        <div>
            <a href="{{ route('timetable.create') }}" class="btn btn-primary btn-sm me-2">
                <i class="bi bi-plus-circle"></i> Add Schedule
            </a>
            <a href="{{ route('timetable.by-day') }}" class="btn btn-info btn-sm me-2">
                <i class="bi bi-calendar-week"></i> View by Day
            </a>
            <a href="{{ route('timetable.by-teacher') }}" class="btn btn-info btn-sm">
                <i class="bi bi-person-workspace"></i> View by Teacher
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Teacher</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Room</th>
                    <th>Duration</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($timetables as $timetable)
                <tr>
                    <td>{{ $timetable->course->course_code }}</td>
                    <td>{{ $timetable->teacher->full_name }}</td>
                    <td><span class="badge badge-info">{{ $timetable->day }}</span></td>
                    <td>{{ $timetable->start_time }} - {{ $timetable->end_time }}</td>
                    <td>{{ $timetable->room_no }}</td>
                    <td>{{ $timetable->duration }} mins</td>
                    <td>
                        <a href="{{ route('timetable.show', $timetable) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('timetable.edit', $timetable) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('timetable.destroy', $timetable) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No schedule created yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $timetables->links() }}
</div>
@endsection
