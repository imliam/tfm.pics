<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $guarded = [];

    public function getUrlAttribute()
    {
        return "http://{$this->type}/{$this->path}";
    }

    public function getAreaAttribute()
    {
        return $this->width * $this->height;
    }

    public function scopeType($query, string $type)
    {
        return $query->where('type', $type);
    }
}
