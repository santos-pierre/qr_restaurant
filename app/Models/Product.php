<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['name', 'price', 'description'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->nonQueued()
            ->manualCrop(105, 105, 0, 0);
    }

    public static function productByRestaurantFilterByCategory($restaurant_id, $category_id)
    {
        $productsId = collect([]);
        if ($category_id) {
            $productsId = ProductMenu::where('r_id', $restaurant_id)
                    ->where('c_id', $category_id)
                    ->get()
                    ->pluck('p_id');
        } else {
            $productsId = ProductMenu::where('r_id', $restaurant_id)
                    ->get()
                    ->pluck('p_id');
        }
        return Product::whereIn('id', $productsId)->get();
    }
}
