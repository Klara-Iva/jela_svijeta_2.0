<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class IngredientTranslation extends Model
{

    public $translatedAttributes = ['title'];
    public $timestamps = false;
    protected $fillable = ['ingredient_id', 'language_id', 'title'];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
    
}