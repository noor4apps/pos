<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];

    public $translatable = ['name'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }// end of asJson

    public function products()
    {
        return $this->hasMany(Product::class);
    }// end of products

}// end of category
