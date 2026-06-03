@extends('layout.app')

@section('title', 'Edit Schedule')
@section('page-title', 'Edit Class Schedule')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-pencil-square"></i> Edit Schedule
            </div>
            <div class="card-body">
                <form action="{{ route('timetable.update', $timetable) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Course</label>
                                <select name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                                    @foreach(\App\Models\Course::where('status', 'Active')->get() as $course)
                                    <option value="{{ $course->id }}" @selected($timetable->course_id === $course->id)>{{ $course->course_name }} ({{ $course->course_code }})</option>
                                    @endforeach
                                </select>
                                @error('course_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Teacher</label>
                                <select name="teacher_id" class="form-select @error('teacher_id') is-invalid @enderror" required>
                                    @foreach(\App\Models\Teacher::where('status', 'Active')->get() as $teacher)
                                    <option value="{{ $teacher->id }}" @selected($timetable->teacher_id === $teacher->id)>{{ $teacher->full_name }} ({{ $teacher->employee_id }})</option>
                                    @endforeach
                                </select>
                                @error('teacher_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Day</label>
                                <select name="day" class="form-select @error('day') is-invalid @enderror" required>
                                    <option value="Monday" @selected($timetable->day === 'Monday')>Monday</option>
                                    <option value="Tuesday" @selected($timetable->day === 'Tuesday')>Tuesday</option>
                                    <option value="Wednesday" @selected($timetable->day === 'Wednesday')>Wednesday</option>
                                    <option value="Thursday" @selected($timetable->day === 'Thursday')>Thursday</option>
                                    <option value="Friday" @selected($timetable->day === 'Friday')>Friday</option>
                                    <option value="Saturday" @selected($timetable->day === 'Saturday')>Saturday</option>
                                </select>
                                @error('day') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Room No</label>
                                <input type="text" name="room_no" value="{{ $timetable->room_no }}" class="form-control @error('room_no') is-invalid @enderror" required>
                                @error('room_no') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Start Time</label>
                                <input type="time" name="start_time" value="{{ $timetable->start_time }}" class="form-control @error('start_time') is-invalid @enderror" required>
                                @error('start_time') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">End Time</label>
                                <input type="time" name="end_time" value="{{ $timetable->end_time }}" class="form-control @error('end_time') is-invalid @enderror" required>
                                @error('end_time') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control" rows="2">{{ $timetable->remarks }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Update</button>
                        <a href="{{ route('timetable.show', $timetable) }}" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
