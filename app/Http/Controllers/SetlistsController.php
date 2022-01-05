<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Songlist;
use App\Models\SongSonglist;
use App\Models\Song;
use Illuminate\Support\Arr;


class SetlistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create($id)
    {
        $songs = Song::whereIn('status_id', [1,2,3])->orderBy('name', 'asc')->get();
        return view('setlists.create', ['id' => $id, 'songs' => $songs]);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $position = 0;

        //Validate form date
        $this->validate($request, [
            'name' => 'required|unique:songlists|max:255',
        ]);


        // Process data and submit
        $setlist = new Songlist();
        $setlist->name = $request->name;
        $setlist->creator = auth()->user()->id;
        $setlist->private = $request->private;
        $setlist->song_list_group_id = $request->groupId;
        $result1 = $setlist->save();
        $songs = $request->input('songlist');

        foreach($songs as $song){
            $setlistitem = new SongSonglist();
            $setlistitem->songlist_id = $setlist->id;
            $setlistitem->setlist_group_id = $setlist->song_list_group_id;
            $setlistitem->song_id = $song;
            $setlistitem->position = $position += 1;
            $result2 = $setlistitem->save();
        }

        // If successful, redirect to show method
        if($result1 && $result2) {
            return redirect()->route('setlistgroups.index')->with('success' , 'Setlist Group created successfully');;
        } else {
            return redirect()->route('setlistgroups.create')->with('error' , 'Error creating Setlist Group');;
        }
    }

    public function copy($id)
    {
        // $songs = SongSonglist::where('songlist_id', $id)
        //     ->orderBy('position', 'asc')
        //     ->get();
        //dd($songs);
        $setlist = Songlist::where('id', $id)->first();
        return view('setlists.copy', compact('setlist'));       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storecopy(Request $request)
    {
        $position = 0;
        // Validate form data

        
        $this->validate($request, [
            'name' => 'required|unique:songlists|max:255',
        ]);

        // Process data and submit
        $setlist = new Songlist();
        $setlist->name = $request->newname;
        $setlist->creator = auth()->user()->id;
        $setlist->private = $request->private;
        $setlist->song_list_group_id = $request->groupId;
        $result1 = $setlist->save();
        $oldId = $request->setlistId;
        $newId = $setlist->id;
        
        $songs = SongSonglist::where('songlist_id', $oldId)->get();

        foreach($songs as $song){
            $setlistitem = new SongSonglist();
            $setlistitem->songlist_id = $newId;
            $setlistitem->setlist_group_id = $song->setlist_group_id;
            $setlistitem->song_id = $song->song_id;
            $setlistitem->position = $song->position;
            $result2 = $setlistitem->save();
        }

        if($result1 && $result2) {
            return redirect()->route('setlistgroups.index')->with('success' , 'Setlist Group copied successfully');;
        } else {
            return redirect()->route('setlistgroups.index')->with('error' , 'Error copying Setlist Group');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $songs = SongSonglist::where('songlist_id', $id)
        //     ->orderBy('position', 'asc')
        //     ->get();
        //dd($songs);

        return view('setlists.show', ['listid' => $id]);       
    }

    public function sort($id)
    {
        // $songs = SongSonglist::where('songlist_id', $id)
        //     ->orderBy('position', 'asc')
        //     ->get();
        //dd($songs);

        return view('setlists.sort', ['listid' => $id]);       
    }

    


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function report($id)
    {
        $data = SongSonglist::where('songlist_id', $id)
            ->orderby('position', 'asc')
            ->get();        
        return view('setlists.report', compact('data'));        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setlist = Songlist::where('id', $id)->first();
        $group_id = $setlist->groups->id;
        $setlist_items = SongSonglist::where('songlist_id', $id)->pluck('song_id')->toArray();
        $songs = Song::orderby('name', 'asc')->get();
        return view('setlists.edit', compact(['setlist', 'setlist_items', 'songs', 'group_id']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $input = $request->all();

        // Update the name, privacy fiels first.
        $setlist = Songlist::findOrFail($id);
        $setlist->update($input);
        $result1 = $setlist;

        $songs = $input['songlist'];
        $songlist_db = SongSonglist::where('songlist_id', $id)->orderby('position', 'asc')->pluck('song_id')->toArray();
        
        for($i = 0; $i < count($songs); $i++) {
            //dump(getSongname($songs[$i]));
            if(!in_array($songs[$i], $songlist_db)) {
                //dump("Add " . getSongname($songs[$i]) . " to DB");
                $result2 = addToSetlist($input['groupId'], $input['setlistId'], $songs[$i]);
            }
        }

        for($i = 0; $i < count($songlist_db); $i++) {
            if(!in_array($songlist_db[$i], $songs)) {
                $result2 = deleteFromSetlist($input['groupId'], $input['setlistId'], $songlist_db[$i]);
                //dump("remove " . getSongname($songlist_db[$i]) . " from DB");
            }
        }
        return redirect()->route('setlistgroups.index')
                ->with('success', 'Setlist updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete songs from set list
        $songs = SongSonglist::where('songlist_id', $id)->get();
        foreach($songs as $song) {

            //dump($song->setlist_group_id . "  " . $song->songlist_id . " " . $song->song_id);
            deleteFromSetlist($song->setlist_group_id, $song->songlist_id, $song->song_id);
        }
        //dd("End");
        $setlist= Songlist::findOrFail($id);
        $setlist->delete();
        return redirect()->route('setlistgroups.index')
                ->with('success', 'Setlist deleted successfully!');
    }
}
