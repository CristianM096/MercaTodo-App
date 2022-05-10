<?php

namespace App\Models;

use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function invoice(): BelongsToMany
    {
        return $this->belongsToMany(Invoice::class)->withPivot('quantity', 'subtotal', 'price');
    }

    protected $with = ['category'];

    protected $casts = ['active' => 'boolean',];

    protected $fillable = [
        'name',
        'price',
        'discount',
        'photo',
        'description',
        'stock',
        'color',
        'weight',
        'size',
        'active',
        'category_id',
    ];

    public function getPhotoAttribute()
    {
        $name = $this->getImageName();
        return url('/storage/productImages/'.$name);
    }
    public function getImageName()
    {
        $path = explode("\\", $this->attributes['photo']);
        if (sizeof($path) === 2) {
            $name = $path[1];
        } else {
            $name = $path[0];
        }
        return $name;
    }
    public static function scopeName(Builder $query, ?string $name): Builder
    {
        if (null !== $name) {
            $query->where('name', 'like', "%$name%");
            return $query;
        }
        return $query;
    }
    public static function scopePriceMax(Builder $query, ?float $priceMax): Builder
    {
        if (null === $priceMax || 0>=$priceMax) {
            return $query;
        } else {
            $query->where('price', '<', $priceMax);
            return $query;
        }
    }

    public static function scopePriceMin(Builder $query, ?float $priceMin): Builder
    {
        if (null === $priceMin || 0 > $priceMin) {
            return $query;
        } else {
            $query->where('price', ">", $priceMin);
            return $query;
        }
    }
}
