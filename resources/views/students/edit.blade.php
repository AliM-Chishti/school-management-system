@extends('layout.app')

@section('title', 'Edit Student')
@section('page-title', 'Edit Student - ' . $student->full_name)

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-pencil-square"></i> Edit Student Information
            </div>
            <div class="card-body">
                <form action="{{ route('students.update', $student) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Enrollment No</label>
                                <input type="text" name="enrollment_no" value="{{ $student->enrollment_no }}" class="form-control @error('enrollment_no') is-invalid @enderror" required>
                                @error('enrollment_no') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ $student->email }}" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" value="{{ $student->first_name }}" class="form-control @error('first_name') is-invalid @enderror" required>
                                @error('first_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" value="{{ $student->last_name }}" class="form-control @error('last_name') is-invalid @enderror" required>
                                @error('last_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="tel" name="phone" value="{{ $student->phone }}" class="form-control @error('phone') is-invalid @enderror" required>
                                @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" value="{{ $student->date_of_birth }}" class="form-control @error('date_of_birth') is-invalid @enderror" required>
                                @error('date_of_birth') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" @selected($student->gender === 'Male')>Male</option>
                                    <option value="Female" @selected($student->gender === 'Female')>Female</option>
                                    <option value="Other" @selected($student->gender === 'Other')>Other</option>
                                </select>
                                @error('gender') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Admission Status</label>
                                <select name="admission_status" class="form-select @error('admission_status') is-invalid @enderror" required>
                                    <option value="Active" @selected($student->admission_status === 'Active')>Active</option>
                                    <option value="Inactive" @selected($student->admission_status === 'Inactive')>Inactive</option>
                                    <option value="Suspended" @selected($student->admission_status === 'Suspended')>Suspended</option>
                                </select>
                                @error('admission_status') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2" required>{{ $student->address }}</textarea>
                        @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Parent/Guardian Name</label>
                                <input type="text" name="parent_name" value="{{ $student->parent_name }}" class="form-control @error('parent_name') is-invalid @enderror" required>
                                @error('parent_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Parent/Guardian Phone</label>
                                <input type="tel" name="parent_phone" value="{{ $student->parent_phone }}" class="form-control @error('parent_phone') is-invalid @enderror" required>
                                @error('parent_phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control" rows="2">{{ $student->remarks }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Update</button>
                        <a href="{{ route('students.show', $student) }}" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
