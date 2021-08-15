<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = [];

    public $translatable = ['name', 'description'];

    protected $appends = ['image_path', 'profit_percent'];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    } // end of asJson

    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);
    } // end of get image path

    public function getProfitPercentAttribute()
    {
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent, 2);

    } // end of get profit percent

    public function category()
    {
        return $this->belongsTo(Category::class);
    } // end of category
}
