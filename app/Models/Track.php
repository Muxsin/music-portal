<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function likes()
    {
        return $this->hasMany(TrackLike::class);
    }

    public function listenings()
    {
        return $this->hasMany(ListeningHistory::class);
    }

    public function downloads()
    {
        return $this->hasMany(DownloadHistory::class);
    }
}
