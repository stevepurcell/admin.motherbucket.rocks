<?php

namespace App\Http\Livewire;

use App\Models\Song;
use App\Models\SongList;
use App\Models\SongListItem;
use Livewire\Component;

class CreateSetlists extends Component
{
    public $invoiceProducts = [];
    public $allProducts = [];
    public $taxes = 20;
    public $name;
    public $creator;
    public $private;
    public $songListSaved = false;
    public $selectedSongs = [];
    public $groupid;

    public function render()
    {
        return view('livewire.create-setlists', [
            'data' => $this->read(),
        ]);
    }

    public function read()
    {
        return Song::orderby('name')->get();
    }

    public function saveSongList()
    {
        $songlist = SongList::create([
            'name' => $this->name,
            'creator' => $this->creator,
            'private' => $this->private,
            'song_list_group_id' => $this->groupid
        ]);

        dump('Name:' . $this->name);
        dump('Creator:' . $this->songlist_creator);
        dump('Private:' . $this->private);
        dump('GroupID:' . $$this->groupid);
        dd("done");
        
        $rowsSelected = count($this->selectedSongs);
        
            for ($i=0; $i < $rowsSelected; $i++) {
                // dump('song id = ' . $this->selectedSongs[$i]);
                // dump('position = ' . $i);
                $songlistitem = SongListItem::create([
                    'songlist_id' => $songlist->id,
                    'song_id' => $this->selectedSongs[$i],
                    'position' => $i,
                ]);
        };
        session()->flash('success', 'Songlist Created Successfully.');
        $songListSaved = true;
        return redirect()->route('show-lists');
    }

}
