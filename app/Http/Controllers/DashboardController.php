<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Fee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalCourses = Course::count();
        $totalFees = Fee::sum('fee_amount');
        $totalPaid = Fee::sum('paid_amount');
        $totalPending = $totalFees - $totalPaid;
        
        $activeStudents = Student::where('admission_status', 'Active')->count();
        $activeTeachers = Teacher::where('status', 'Active')->count();
        $activeCourses = Course::where('status', 'Active')->count();
        
        $recentStudents = Student::latest()->take(5)->get();
        $recentFees = Fee::with('student')->latest()->take(5)->get();
        
        $feeStats = Fee::groupBy('payment_status')
            ->selectRaw('payment_status, count(*) as total, sum(fee_amount) as total_amount')
            ->get();

        return view('dashboard', compact(
            'totalStudents',
            'totalTeachers',
            'totalCourses',
            'totalFees',
            'totalPaid',
            'totalPending',
            'activeStudents',
            'activeTeachers',
            'activeCourses',
            'recentStudents',
            'recentFees',
            'feeStats'
        ));
    }
}
