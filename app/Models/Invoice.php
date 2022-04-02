<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'reference',
        'payment_status',
        'customer_id',
        'url_payment',
        'user_id',
    ];


    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
