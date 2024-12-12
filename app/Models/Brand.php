<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;
use Carbon\Carbon;
class Brand extends Model implements Sitemapable
{
    use HasFactory;

    use HasTranslations;

    public $translatable = ['title','page_title','page_description'];

    protected $fillable = [
        'title',
        'image',
        'slug',
        'sync_id',
        'page_title',
        'page_description',
    ];

    protected $hidden = ['image'];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute() {
        return url('storage/'.$this->image);
    }

    public function models() {
        return $this->hasMany(Models::class);
    }

    public function cars() {
        return $this->hasMany(Car::class);
    }

    public function slug() {
        // $slug = str_replace(' ', '-', $this->getTranslation('title','en'));
        // return $slug;        
        $slug = "rent-".str_replace(' ', '-', $this->getTranslation('title','en'))."-in-Dubai";
        return $slug;
    }

    public function toSitemapTag(): Url | string | array
    {
        return Url::create(url('/').'/b/'.$this->sync_id.'/'.$this->slug())
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
    }

}
