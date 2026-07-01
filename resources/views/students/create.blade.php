@extends('layout.app')

@section('title', 'Add Student')
@section('page-title', 'Add New Student')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom py-4">
                <div class="d-flex justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="mb-1">Student admission</h4>
                        <p class="text-muted mb-0">Capture student details with a clean form layout and clear field grouping.</p>
                    </div>
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-chevron-left me-1"></i> Back to list
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Enrollment No</label>
                            <input type="text" name="enrollment_no" value="{{ old('enrollment_no') }}" class="form-control form-control-lg @error('enrollment_no') is-invalid @enderror" required>
                            @error('enrollment_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg @error('email') is-invalid @enderror" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control form-control-lg @error('first_name') is-invalid @enderror" required>
                            @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control form-control-lg @error('last_name') is-invalid @enderror" required>
                            @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control form-control-lg @error('phone') is-invalid @enderror" required>
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control form-control-lg @error('date_of_birth') is-invalid @enderror" required>
                            @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select form-select-lg @error('gender') is-invalid @enderror" required>
                                <option value="">Select gender</option>
                                <option value="Male" @selected(old('gender') === 'Male')>Male</option>
                                <option value="Female" @selected(old('gender') === 'Female')>Female</option>
                                <option value="Other" @selected(old('gender') === 'Other')>Other</option>
                            </select>
                            @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Admission Date</label>
                            <input type="date" name="admission_date" value="{{ old('admission_date') }}" class="form-control form-control-lg @error('admission_date') is-invalid @enderror" required>
                            @error('admission_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" rows="3" class="form-control form-control-lg @error('address') is-invalid @enderror" required>{{ old('address') }}</textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Parent / Guardian Name</label>
                            <input type="text" name="parent_name" value="{{ old('parent_name') }}" class="form-control form-control-lg @error('parent_name') is-invalid @enderror" required>
                            @error('parent_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Parent / Guardian Phone</label>
                            <input type="tel" name="parent_phone" value="{{ old('parent_phone') }}" class="form-control form-control-lg @error('parent_phone') is-invalid @enderror" required>
                            @error('parent_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Remarks</label>
                            <textarea name="remarks" rows="3" class="form-control form-control-lg">{{ old('remarks') }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row align-items-center gap-2 mt-4">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-check-circle me-1"></i> Submit
                        </button>
                        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-x-circle me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection