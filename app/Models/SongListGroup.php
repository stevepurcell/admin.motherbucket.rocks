<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Songlist;

class SongListGroup extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'creator', 'private'];

    public function songlists()
    {
        return $this->hasMany(Songlist::class);
    }
}
