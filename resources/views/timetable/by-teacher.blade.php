@extends('layout.app')

@section('title', 'Schedule by Teacher')
@section('page-title', 'Teacher Schedule')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <h5>Select Teacher</h5>
    </div>
    <div class="card-body">
        <div class="row">
            @forelse($teachers as $t)
            <div class="col-md-3 mb-2">
                <a href="{{ route('timetable.by-teacher', ['teacher_id' => $t->id]) }}" class="btn btn-outline-primary w-100 @if($teacher && $t->id === $teacher->id) active btn-primary @endif">
                    {{ $t->full_name }}
                </a>
            </div>
            @empty
            <div class="col-12">
                <p class="text-muted">No active teachers found</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

@if($teacher)
<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-person-workspace"></i> Schedule for {{ $teacher->full_name }}</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Course</th>
                    <th>Room</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody>
                @forelse($timetables as $schedule)
                <tr>
                    <td><span class="badge badge-info">{{ $schedule->day }}</span></td>
                    <td><strong>{{ $schedule->start_time }} - {{ $schedule->end_time }}</strong></td>
                    <td>{{ $schedule->course->course_code }}: {{ $schedule->course->course_name }}</td>
                    <td>{{ $schedule->room_no }}</td>
                    <td>{{ $schedule->duration }} mins</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">No schedule assigned</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@else
<div class="alert alert-info">
    <strong>Select a teacher</strong> from the options above to view their schedule.
</div>
@endif

<div class="mt-3">
    <a href="{{ route('timetable.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back to Timetable</a>
</div>
@endsection
