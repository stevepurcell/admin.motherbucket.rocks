<?php

use App\Models\Song;
use App\Models\User;
use App\Models\Status;
use App\Models\Contact;
use App\Models\SongListGroup;
use App\Models\SongSonglist;
use App\Models\Songlist;

function getUsername($userId) {
 return User::where('id', $userId)->first()->name;
}

function getSongname($songId) {
    return Song::where('id', $songId)->first()->name;
   }

function getSetlistGroupName($group_id)
{
    return SongListGroup::where('id', $group_id)->first();
}

function getStatus($statusId) {
    return Status::where('id', $statusId)->first();
}

function getAccessBadge($access) {
    if($access == 0) {
        return ([
            'accesstype' => 'Private',
            'badge_type' => 'danger',]);
    } elseif($access == 1) {
        return ([
            'accesstype' => 'Public',
            'badge_type' => 'success',]);
    }
}

function getStatusCount($statusId) {
    if($statusId > 0) {
        return Song::where('status_id', $statusId)->count();
    } else {
        return Song::all()->count();
    }
}

function getSongCount($songlistId) {
    return SongSonglist::where('songlist_id', $songlistId)->count();
}

function getContactTypeCount($contactTypeId) {
    if($contactTypeId > 0) {
        return Contact::where('contact_type_id', $contactTypeId)->count();
    } else {
        return Contact::all()->count();
    }
}

function getContactType($contact_type_id) {
    if($contact_type_id == 1) {
        return ([
            'contacttype' => 'Venue',
            'badge_type' => 'info',]);
    } elseif($contact_type_id == 2) {
        return ([
            'contacttype' => 'Booker',
            'badge_type' => 'success',]);
    } elseif($contact_type_id == 3) {
        return ([
            'contacttype' => 'Band/Musician',
            'badge_type' => 'primary',]);
    } elseif($contact_type_id == 4) {
        return ([
            'contacttype' => 'Others',
            'badge_type' => 'warning',]);
    }
}

function repositionSetlist($setlist_id)
{
        $setlist = SongSonglist::where('songlist_id', $setlist_id)
            ->orderby('position', 'asc')->get();

        $position = 1;

        foreach($setlist as $setlistitem)
        {
            $setlistitem->position = $position;
            $setlistitem->save();
            $position++;
        }
}

function addToSetlist($group_id, $setlist_id, $song_id)
{
    $setlistitem = new SongSonglist();
    $setlistitem->setlist_group_id = $group_id;
    $setlistitem->songlist_id = $setlist_id;
    $setlistitem->song_id = $song_id;
    $setlistitem->position = getNextPosition($setlist_id);
    $result = $setlistitem->save();
}

function deleteFromSetlist($group_id, $setlist_id, $song_id)
{
    $song_to_del = SongSonglist::where('setlist_group_id', $group_id)
        ->where('songlist_id', $setlist_id)
        ->where('song_id', $song_id)
        ->first();
    if($song_to_del) {
        $song_to_del->delete();
    } else {
        return back()->withInput();
    }
}

function getNextPosition($setlist_id)
{
    $position = SongSonglist::where('songlist_id', $setlist_id)->max('position');
    return $position + 1;
}

function deleteSetlist($id)
{
    // Delete songs from set list
    $songs = SongSonglist::where('songlist_id', $id)->get();
    foreach($songs as $song) {
        //dump($song->setlist_group_id . "  " . $song->songlist_id . " " . $song->song_id);
        deleteFromSetlist($song->setlist_group_id, $song->songlist_id, $song->song_id);
    }
    //dd("End");
    $setlist= Songlist::findOrFail($id);
    $deleted = $setlist->delete();
    return $deleted;
}

function deleteSetlistGroup($id)
{
    // Delete songs from set list
    //$groups = SongSonglist::where('songlist_id', $id)->get();
    $groups = SongListGroup::findOrFail($id);
    $deleted = $groups->delete();
    return $deleted;
}

function getSetlistCount($id)
{
    $count = Songlist::where('song_list_group_id', $id)->count();
    return $count;
}

// function getSetlistDuration($id)
// {
//     $duration = Songlist::where('song_list_group_id', $id)->sum($song->time);
//     return $duration;
// }