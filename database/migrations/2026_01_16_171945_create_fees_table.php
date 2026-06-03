<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->decimal('fee_amount', 10, 2);
            $table->date('due_date');
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->enum('payment_status', ['Pending', 'Partial', 'Paid'])->default('Pending');
            $table->date('payment_date')->nullable();
            $table->string('payment_method')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
