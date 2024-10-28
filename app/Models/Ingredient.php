<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Models\Meal;

class Ingredient extends Model implements TranslatableContract
{

    use Translatable;
    public $translatedAttributes = ['title'];
    public $timestamps = false;
    protected $fillable = ['slug'];

    public function meals(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(Meal::class, 'meal_ingredient');
    }
    
}