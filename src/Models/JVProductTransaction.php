<?php

namespace Josmarh\JVZooIPN\Models;

use Illuminate\Database\Eloquent\Model;

class JVProductTransaction extends Model
{
    protected $table = 'jv_product_transactions';

    protected $fillable = [
        'product_id',
        'transaction_id',
        'transaction_type',
        'customer_email',
        'customer_name',
        'amount',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(JVProduct::class, 'product_id', 'product_id');
    }
}