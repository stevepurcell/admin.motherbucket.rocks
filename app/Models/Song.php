<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Song extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'artist', 'status_id', 'created_by', 'singer', 'solo', 'keyboard', 'acoustic', 'time', 'notes'];

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function songlists()
    {
        // 1 list can have many songs
        // 1 song can belong to many lists
        // belongsToMany

        return $this->belongsToMany(Songlist::class);
    }

    // public function solo() {
    //     return $this->belongsTo(Member::class);
    // }

    // public function singer() {
    //     return $this->belongsTo(Member::class);
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
