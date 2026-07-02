<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransactionType extends Model
{
    protected $fillable = [
        'description',
        'expense_type',
        'uacs_code',
    ];

    public function attachments(): HasMany
    {
        return $this->hasMany(TransactionTypeAttachment::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
