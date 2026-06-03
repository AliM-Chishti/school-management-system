@extends('layout.app')

@section('title', 'Edit Fee')
@section('page-title', 'Edit Fee Record')

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-pencil-square"></i> Edit Fee Record
            </div>
            <div class="card-body">
                <form action="{{ route('fees.update', $fee) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <h6 class="mb-3"><strong>Fee Details</strong></h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Student</label>
                                <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                                    @foreach(\App\Models\Student::all() as $student)
                                    <option value="{{ $student->id }}" @selected($fee->student_id === $student->id)>{{ $student->full_name }} ({{ $student->enrollment_no }})</option>
                                    @endforeach
                                </select>
                                @error('student_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Fee Amount</label>
                                <input type="number" name="fee_amount" step="0.01" value="{{ $fee->fee_amount }}" class="form-control @error('fee_amount') is-invalid @enderror" required>
                                @error('fee_amount') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Due Date</label>
                                <input type="date" name="due_date" value="{{ $fee->due_date }}" class="form-control @error('due_date') is-invalid @enderror" required>
                                @error('due_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Payment Status</label>
                                <select name="payment_status" class="form-select @error('payment_status') is-invalid @enderror" required>
                                    <option value="Pending" @selected($fee->payment_status === 'Pending')>Pending</option>
                                    <option value="Partial" @selected($fee->payment_status === 'Partial')>Partial</option>
                                    <option value="Paid" @selected($fee->payment_status === 'Paid')>Paid</option>
                                </select>
                                @error('payment_status') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <h6 class="mb-3 mt-4"><strong>Payment Information</strong></h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Paid Amount</label>
                                <input type="number" name="paid_amount" step="0.01" value="{{ $fee->paid_amount }}" class="form-control @error('paid_amount') is-invalid @enderror" required>
                                @error('paid_amount') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                <small class="text-muted">Amount already paid by student</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Payment Date</label>
                                <input type="date" name="payment_date" value="{{ $fee->payment_date ? $fee->payment_date->format('Y-m-d') : '' }}" class="form-control @error('payment_date') is-invalid @enderror">
                                @error('payment_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Payment Method</label>
                                <select name="payment_method" class="form-select @error('payment_method') is-invalid @enderror">
                                    <option value="">-- Select Payment Method --</option>
                                    <option value="Cash" @selected($fee->payment_method === 'Cash')>Cash</option>
                                    <option value="Check" @selected($fee->payment_method === 'Check')>Check</option>
                                    <option value="Online" @selected($fee->payment_method === 'Online')>Online Transfer</option>
                                    <option value="Card" @selected($fee->payment_method === 'Card')>Credit/Debit Card</option>
                                </select>
                                @error('payment_method') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Remarks</label>
                                <input type="text" name="remarks" value="{{ $fee->remarks }}" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Update</button>
                        <a href="{{ route('fees.show', $fee) }}" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
