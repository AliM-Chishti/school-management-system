@extends('layout.app')

@section('title', 'Edit Course')
@section('page-title', 'Edit Course - ' . $course->course_name)

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-pencil-square"></i> Edit Course Information
            </div>
            <div class="card-body">
                <form action="{{ route('courses.update', $course) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Course Code</label>
                                <input type="text" name="course_code" value="{{ $course->course_code }}" class="form-control @error('course_code') is-invalid @enderror" required>
                                @error('course_code') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Course Name</label>
                                <input type="text" name="course_name" value="{{ $course->course_name }}" class="form-control @error('course_name') is-invalid @enderror" required>
                                @error('course_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <input type="text" name="department" value="{{ $course->department }}" class="form-control @error('department') is-invalid @enderror" required>
                                @error('department') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Credit Hours</label>
                                <input type="number" name="credit_hours" value="{{ $course->credit_hours }}" class="form-control @error('credit_hours') is-invalid @enderror" min="1" max="10" required>
                                @error('credit_hours') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Max Students</label>
                                <input type="number" name="max_students" value="{{ $course->max_students }}" class="form-control @error('max_students') is-invalid @enderror" min="1" required>
                                @error('max_students') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="Active" @selected($course->status === 'Active')>Active</option>
                                    <option value="Inactive" @selected($course->status === 'Inactive')>Inactive</option>
                                </select>
                                @error('status') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="2">{{ $course->description }}</textarea>
                        @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Syllabus</label>
                        <textarea name="syllabus" class="form-control @error('syllabus') is-invalid @enderror" rows="3">{{ $course->syllabus }}</textarea>
                        @error('syllabus') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Update</button>
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
