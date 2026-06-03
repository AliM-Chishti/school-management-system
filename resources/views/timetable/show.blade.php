@extends('layout.app')

@section('title', 'Schedule Details')
@section('page-title', 'Class Schedule Details')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-book-fill"></i> Course Information
            </div>
            <div class="card-body">
                <p><strong>Course Code:</strong> {{ $timetable->course->course_code }}</p>
                <p><strong>Course Name:</strong> {{ $timetable->course->course_name }}</p>
                <p><strong>Department:</strong> {{ $timetable->course->department }}</p>
                <p><strong>Credit Hours:</strong> {{ $timetable->course->credit_hours }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-workspace"></i> Teacher Information
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $timetable->teacher->full_name }}</p>
                <p><strong>Employee ID:</strong> {{ $timetable->teacher->employee_id }}</p>
                <p><strong>Email:</strong> {{ $timetable->teacher->email }}</p>
                <p><strong>Phone:</strong> {{ $timetable->teacher->phone }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-calendar-event"></i> Schedule Details
            </div>
            <div class="card-body">
                <p><strong>Day:</strong> <span class="badge badge-info">{{ $timetable->day }}</span></p>
                <p><strong>Start Time:</strong> {{ $timetable->start_time }}</p>
                <p><strong>End Time:</strong> {{ $timetable->end_time }}</p>
                <p><strong>Duration:</strong> {{ $timetable->duration }} minutes</p>
                <p><strong>Room No:</strong> {{ $timetable->room_no }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-info-circle"></i> Additional Info
            </div>
            <div class="card-body">
                <p><strong>Remarks:</strong> {{ $timetable->remarks ?? 'N/A' }}</p>
                <p><strong>Created:</strong> {{ $timetable->created_at->format('d M Y') }}</p>
                <p><strong>Updated:</strong> {{ $timetable->updated_at->format('d M Y') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('timetable.edit', $timetable) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
    <a href="{{ route('timetable.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
@endsection
