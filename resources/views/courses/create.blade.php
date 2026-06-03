@extends('layout.app')

@section('title', 'Add Course')
@section('page-title', 'Add New Course')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-book-plus"></i> Course Registration Form
            </div>
            <div class="card-body">
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Course Code</label>
                                <input type="text" name="course_code" class="form-control @error('course_code') is-invalid @enderror" placeholder="e.g., CS101" required>
                                @error('course_code') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Course Name</label>
                                <input type="text" name="course_name" class="form-control @error('course_name') is-invalid @enderror" required>
                                @error('course_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <input type="text" name="department" class="form-control @error('department') is-invalid @enderror" required>
                                @error('department') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Credit Hours</label>
                                <input type="number" name="credit_hours" class="form-control @error('credit_hours') is-invalid @enderror" min="1" max="10" required>
                                @error('credit_hours') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Max Students</label>
                                <input type="number" name="max_students" class="form-control @error('max_students') is-invalid @enderror" value="50" min="1" required>
                                @error('max_students') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                                @error('status') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="2"></textarea>
                        @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Syllabus</label>
                        <textarea name="syllabus" class="form-control @error('syllabus') is-invalid @enderror" rows="3"></textarea>
                        @error('syllabus') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Submit</button>
                        <a href="{{ route('courses.index') }}" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
