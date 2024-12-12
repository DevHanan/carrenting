<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class City extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['title','page_title','page_description'];

    protected $fillable = [
        'title',
        'country_id',
        'sync_id',
        'page_title',
        'page_description',
    ];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function slug() {
        $title  = $this->getTranslation('title','en');
        // remove spaces from start
        $title = ltrim($title);
        $slug = str_replace(' ', '-', $title);
        return $slug; 
    }
}
