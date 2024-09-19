<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_number',
        'series_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_season')->withTimestamps();
    }    

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    protected static function booted()
    {
        static::deleting(function ($season) {
            // Remove as relações na tabela user_season
            $season->users()->detach();
        });
    }
}
