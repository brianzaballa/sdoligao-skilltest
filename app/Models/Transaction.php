<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_type_id',
        'reference_no',
        'payee',
        'particulars',
        'amount',
        'transaction_date',
        'status',
        'remarks',
        'created_by',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount'           => 'decimal:2',
    ];

    public const STATUSES = [
        'draft'      => 'Draft',
        'for-review' => 'For Review',
        'approved'   => 'Approved',
        'paid'       => 'Paid',
        'cancelled'  => 'Cancelled',
    ];

    public function transactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
