<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['category_id', 'language_id', 'title'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
}
