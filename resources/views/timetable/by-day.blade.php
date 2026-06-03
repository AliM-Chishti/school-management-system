@extends('layout.app')

@section('title', 'Schedule by Day')
@section('page-title', 'Weekly Schedule')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h5><i class="bi bi-calendar-week"></i> Schedule for {{ $day }}</h5>
            </div>
            <div class="col-md-6">
                <div class="btn-group float-end" role="group">
                    @foreach($days as $d)
                    <a href="{{ route('timetable.by-day', ['day' => $d]) }}" class="btn btn-sm @if($d === $day) btn-primary active @else btn-outline-primary @endif">{{ substr($d, 0, 3) }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Course</th>
                    <th>Teacher</th>
                    <th>Room</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody>
                @forelse($timetables->sortBy('start_time') as $schedule)
                <tr>
                    <td><strong>{{ $schedule->start_time }} - {{ $schedule->end_time }}</strong></td>
                    <td>{{ $schedule->course->course_code }}: {{ $schedule->course->course_name }}</td>
                    <td>{{ $schedule->teacher->full_name }}</td>
                    <td>{{ $schedule->room_no }}</td>
                    <td>{{ $schedule->duration }} mins</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">No classes scheduled for {{ $day }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('timetable.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back to Timetable</a>
</div>
@endsection
