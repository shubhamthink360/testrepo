<?php

namespace App\Models\MetaTag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    use HasFactory;
    public function entity()
    {
        return $this->morphTo();
    }
}
