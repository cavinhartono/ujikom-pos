<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'products';
    protected $fillable = [
        'category_id', 'name', 'barcode', 'qty', 'price'
    ];

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
}
