<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Fee::with('student')->paginate(15);
        return view('fees.index', compact('fees'));
    }

    public function create()
    {
        $students = Student::all();
        return view('fees.create', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'payment_method' => 'nullable|string|max:50',
            'remarks' => 'nullable|string',
        ]);

        Fee::create($validated);
        return redirect()->route('fees.index')->with('success', 'Fee record created successfully!');
    }

    public function show(Fee $fee)
    {
        $fee->load('student');
        return view('fees.show', compact('fee'));
    }

    public function edit(Fee $fee)
    {
        $students = Student::all();
        return view('fees.edit', compact('fee', 'students'));
    }

    public function update(Request $request, Fee $fee)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'fee_amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'paid_amount' => 'required|numeric|min:0',
            'payment_status' => 'required|in:Pending,Partial,Paid',
            'payment_date' => 'nullable|date',
            'payment_method' => 'nullable|string|max:50',
            'remarks' => 'nullable|string',
        ]);

        $fee->update($validated);
        return redirect()->route('fees.show', $fee)->with('success', 'Fee updated successfully!');
    }

    public function destroy(Fee $fee)
    {
        $fee->delete();
        return redirect()->route('fees.index')->with('success', 'Fee record deleted successfully!');
    }

    public function recordPayment(Request $request, Fee $fee)
    {
        $validated = $request->validate([
            'paid_amount' => 'required|numeric|min:0|max:' . ($fee->fee_amount - $fee->paid_amount),
            'payment_date' => 'required|date|before_or_equal:today',
            'payment_method' => 'required|string|max:50',
            'remarks' => 'nullable|string',
        ]);

        $new_paid_amount = $fee->paid_amount + $validated['paid_amount'];
        $fee->paid_amount = $new_paid_amount;
        $fee->payment_date = $validated['payment_date'];
        $fee->payment_method = $validated['payment_method'];
        $fee->remarks = $validated['remarks'] ?? $fee->remarks;

        if ($new_paid_amount >= $fee->fee_amount) {
            $fee->payment_status = 'Paid';
        } else {
            $fee->payment_status = 'Partial';
        }

        $fee->save();

        return back()->with('success', 'Payment recorded successfully!');
    }

    public function generateReceipt(Fee $fee)
    {
        $fee->load('student');
        $pdf = Pdf::loadView('fees.receipt', compact('fee'));
        return $pdf->download('payment_receipt_' . $fee->id . '.pdf');
    }

    public function feeReport()
    {
        $totalFees = Fee::sum('fee_amount');
        $totalPaid = Fee::sum('paid_amount');
        $totalPending = $totalFees - $totalPaid;
        $paymentStatus = Fee::groupBy('payment_status')
            ->selectRaw('payment_status, count(*) as total, sum(fee_amount) as total_amount')
            ->get();

        return view('fees.report', compact('totalFees', 'totalPaid', 'totalPending', 'paymentStatus'));
    }
}
