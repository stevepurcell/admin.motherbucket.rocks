<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Songlist extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'creator', 'private'];

    public function songs()
    {
        // 1 list can have many songs
        // 1 song can belong to many lists
        // belongsToMany

        return $this->belongsToMany(Song::class)->withPivot('position');
    }

    public function groups() {
        return $this->belongsTo(SongListGroup::class, 'song_list_group_id');
    }
}
