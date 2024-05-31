<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'description'];

    // By this accessor, price will be get in string format
    public function getPriceAttribute($value)
    {
        return number_format($value / 100, 2);
    }

    // By this Mutator, price will be get in as an integer in cents
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value * 100;
    }

    // Accessor to capitalize the first letter of each word in the name, ucwords function : Uppercase the first character of each word in a string
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    // By this Mutator,  Uppercase the first character of each word in a string
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
}
