<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Models extends Model
{
    use HasFactory;

    use HasTranslations;

    public $translatable = ['title','page_features','page_description'];

    protected $fillable = [
        'title',
        'brand_id',
        'type',
        'sync_id',
        'page_features',
        'page_description',
    ];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function cars() {
        return $this->hasMany(Car::class, 'model_id');
    }
}
