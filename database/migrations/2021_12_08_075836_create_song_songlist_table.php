<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro/Ace Laravel Export (1.8.1)
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateSongSonglistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song_songlist', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('songlist_id');
            $table->unsignedBigInteger('song_id');
            $table->unsignedBigInteger('setlist_group_id');
            $table->unsignedBigInteger('position')->default(0);
            $table->index('songlist_id', 'song_songlist_songlist_id_foreign');
            $table->index('song_id', 'song_songlist_song_id_foreign');
            $table->index('setlist_group_id', 'song_songlist_setlist_group_id_foreign');
            
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('song_songlist');
    }
}
