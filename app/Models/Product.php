<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Psy\CodeCleaner\AssignThisVariablePass;

class Product extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }

    public function getImageAttribute()
    {
        return $this->getMedia('image')->last();
    }
}
