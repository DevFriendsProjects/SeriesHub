<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    protected static function booted()
    {
        static::deleting(function ($series) {
            // Remove todas as temporadas relacionadas a série
            $series->seasons->each->delete();
        });
    }
}
