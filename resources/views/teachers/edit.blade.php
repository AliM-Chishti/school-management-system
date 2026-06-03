@extends('layout.app')

@section('title', 'Edit Teacher')
@section('page-title', 'Edit Teacher - ' . $teacher->full_name)

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-pencil-square"></i> Edit Teacher Information
            </div>
            <div class="card-body">
                <form action="{{ route('teachers.update', $teacher) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Employee ID</label>
                                <input type="text" name="employee_id" value="{{ $teacher->employee_id }}" class="form-control @error('employee_id') is-invalid @enderror" required>
                                @error('employee_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ $teacher->email }}" class="form-control @error('email') is-invalid @enderror" required>
                                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" name="first_name" value="{{ $teacher->first_name }}" class="form-control @error('first_name') is-invalid @enderror" required>
                                @error('first_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name" value="{{ $teacher->last_name }}" class="form-control @error('last_name') is-invalid @enderror" required>
                                @error('last_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="tel" name="phone" value="{{ $teacher->phone }}" class="form-control @error('phone') is-invalid @enderror" required>
                                @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" value="{{ $teacher->date_of_birth }}" class="form-control @error('date_of_birth') is-invalid @enderror" required>
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
                                    <option value="Male" @selected($teacher->gender === 'Male')>Male</option>
                                    <option value="Female" @selected($teacher->gender === 'Female')>Female</option>
                                    <option value="Other" @selected($teacher->gender === 'Other')>Other</option>
                                </select>
                                @error('gender') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="Active" @selected($teacher->status === 'Active')>Active</option>
                                    <option value="Inactive" @selected($teacher->status === 'Inactive')>Inactive</option>
                                    <option value="On Leave" @selected($teacher->status === 'On Leave')>On Leave</option>
                                </select>
                                @error('status') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2" required>{{ $teacher->address }}</textarea>
                        @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Qualification</label>
                                <input type="text" name="qualification" value="{{ $teacher->qualification }}" class="form-control @error('qualification') is-invalid @enderror" required>
                                @error('qualification') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Specialization</label>
                                <input type="text" name="specialization" value="{{ $teacher->specialization }}" class="form-control @error('specialization') is-invalid @enderror" required>
                                @error('specialization') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control" rows="2">{{ $teacher->remarks }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Update</button>
                        <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
