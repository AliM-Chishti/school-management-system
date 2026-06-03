<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'fee_amount',
        'due_date',
        'paid_amount',
        'payment_status',
        'payment_date',
        'payment_method',
        'description',
        'remarks'
    ];

    protected $casts = [
        'due_date' => 'date',
        'payment_date' => 'date',
        'fee_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getRemainingAmountAttribute()
    {
        return $this->fee_amount - $this->paid_amount;
    }

    public function getPaymentPercentageAttribute()
    {
        return ($this->paid_amount / $this->fee_amount) * 100;
    }
}

