<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongSonglist extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = ['songlist_id', 'song_id', 'position'];
    protected $table="song_songlist";

    public function song() {
        return $this->belongsTo(Song::class, 'song_id');
    }

    public function songlist() {
        return $this->belongsTo(Songlist::class, 'songlist_id');
    }

    public function group() {
         return $this->belongsTo(SongListGroup::class, 'setlist_group_id');
    }
}
