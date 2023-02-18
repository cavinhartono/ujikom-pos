<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customers";

    protected $fillable = ['customer_index', 'name', 'phone'];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
