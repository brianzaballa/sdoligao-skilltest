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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_type_id')->constrained()->restrictOnDelete();
            $table->string('reference_no')->unique();
            $table->string('payee');
            $table->text('particulars');
            $table->decimal('amount', 15, 2);
            $table->date('transaction_date');
            $table->string('status')->default('draft'); // draft, for-review, approved, paid, cancelled
            $table->text('remarks')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
