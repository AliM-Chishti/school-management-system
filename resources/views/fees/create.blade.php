@extends('layout.app')

@section('title', 'Add Fee')
@section('page-title', 'Add Fee Record')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-credit-card-plus"></i> Fee Registration Form
            </div>
            <div class="card-body">
                <form action="{{ route('fees.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Student</label>
                                <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                                    <option value="">Select Student</option>
                                    @foreach(\App\Models\Student::all() as $student)
                                    <option value="{{ $student->id }}">{{ $student->full_name }} ({{ $student->enrollment_no }})</option>
                                    @endforeach
                                </select>
                                @error('student_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Fee Amount</label>
                                <input type="number" name="fee_amount" step="0.01" class="form-control @error('fee_amount') is-invalid @enderror" required>
                                @error('fee_amount') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Due Date</label>
                                <input type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror" required>
                                @error('due_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Payment Method</label>
                                <input type="text" name="payment_method" class="form-control" placeholder="e.g., Cash, Check, Online">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Submit</button>
                        <a href="{{ route('fees.index') }}" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
