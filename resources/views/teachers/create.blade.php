@extends('layout.app')

@section('title', 'Register Teacher')
@section('page-title', 'Register New Teacher')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom py-4">
                <div class="d-flex justify-content-between align-items-center gap-3">
                    <div>
                        <h4 class="mb-1">Teacher registration</h4>
                        <p class="text-muted mb-0">Capture new instructor details with a polished, easy form.</p>
                    </div>
                    <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-chevron-left me-1"></i> Back to list
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('teachers.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Employee ID</label>
                            <input type="text" name="employee_id" value="{{ old('employee_id') }}" class="form-control form-control-lg @error('employee_id') is-invalid @enderror" required>
                            @error('employee_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                            <label class="form-label">Joining Date</label>
                            <input type="date" name="joining_date" value="{{ old('joining_date') }}" class="form-control form-control-lg @error('joining_date') is-invalid @enderror" required>
                            @error('joining_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" rows="3" class="form-control form-control-lg @error('address') is-invalid @enderror" required>{{ old('address') }}</textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Qualification</label>
                            <input type="text" name="qualification" value="{{ old('qualification') }}" class="form-control form-control-lg @error('qualification') is-invalid @enderror" placeholder="e.g., B.Ed, M.A" required>
                            @error('qualification') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Specialization</label>
                            <input type="text" name="specialization" value="{{ old('specialization') }}" class="form-control form-control-lg @error('specialization') is-invalid @enderror" required>
                            @error('specialization') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                        <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-x-circle me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
