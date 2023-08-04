<?php

namespace App\Models\Package;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = ['country_id', 'thumbnail', 'is_starting_price', 'is_day_night'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function metaTags()
    {
        return $this->morphMany(MetaTag::class, 'entity');
    }
}
