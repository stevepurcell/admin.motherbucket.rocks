@extends('layouts.master')

@section('content')
<div id="app">
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                
                <div class="col-md-12">

<div class="card">
    <div class="card-header bg-light">
        <div class="d-flex justify-content-between">
            <h3><i class="nav-icon fa fa-list"></i>&nbsp;Setlists</h3> 
            <a href="setlistgroups/create" class="btn btn-secondary">New Group</a>
        </div>
    </div>
    <div class="card-body">

    <table class="table">
        <thead>
            <tr>
                
                <th>Name</th>
                <th>Creator</th>
                <th>Count</th>
                <th>Action</th>
            </tr>
        </thead>
  <tbody>
        @forelse ($data as $item)
            <tr>
            @if (getSetlistCount( $item->id ))
                <td><a data-toggle="collapse" href="#collapseExample{{$item->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{ $item->id }}"><i class="fa fa-plus" aria-hidden="true"></i></a>&nbsp;{{ $item->name }}</td>
            @else                    
                <td>{{ $item->name }}</td>
            @endif
            <td>{{ getUsername($item->creator) }}</td>
            <td>{{ getSetlistCount( $item->id ) }} Set Lists</td>
            <td class="">
                <div class="btn-group">
                <button type="button" class="btn btn-primary">Edit</button>
                <form action="{{ route('setlistgroups.destroy',$item->id) }}" method="POST">   
                    @csrf
                    @method('DELETE')      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                <a href="setlists/create/{{ $item->id }}" class="btn btn-success">
                    Add Setlist</a>
                </div>
                </td>
            </tr>
            @foreach($item->songlists as $songlist)
                <tr class="collapse" id="collapseExample{{$item->id}}" height="12px">
                    <td class="h6"><a href="/setlists/report/{{ $songlist->id }}"><i class="fa fa-print" aria-hidden="true"></i>
                    </a><small>{{ $songlist->name }}</small></td>
                    <td class="h6"><small>{{ getUsername($songlist->creator) }}</small></td>
                    <td class="h6"><small>{{ getSongCount($songlist->id) }} Songs</small></td>
                    <td class="">
                        <div class="btn-group">
                            <form action="{{ route('setlists.destroy',$songlist->id) }}" method="POST">   
                                <a class="btn btn-sm btn-success" href="{{ route('setlists.sort', $songlist->id) }}">Sort</a>
                                <a class="btn btn-sm btn-primary" href="{{ route('setlists.edit',$songlist->id) }}">Edit</a>   
                                    @csrf
                                    @method('DELETE')      
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @empty
            <tr>
                <td colspan="3">No Songs found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

    {{-- {!! $data->links() !!}      --}}
</div>
    
    </div>

</div>

</div>
            </div>
        </div>

    </main>
@endsection






