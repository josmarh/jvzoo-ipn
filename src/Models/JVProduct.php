<?php

namespace Josmarh\JVZooIPN\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Josmarh\JVZooIPN\Database\Factories\JVProductFactory;

class JVProduct extends Model
{
    /** @use HasFactory<JVProductFactory> */
    use HasFactory;

    protected $table = 'jv_products';

    protected $fillable = [
        'product_id',
        'product_name',
        'access_level',
    ];

    public function transactions()
    {
        return $this->hasMany(JVProductTransaction::class, 'product_id', 'product_id');
    }

    protected static function newFactory()
    {
        return JVProductFactory::new();
    }
}