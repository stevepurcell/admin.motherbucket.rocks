<div class="card">
    <div class="card-header bg-light">
        <div class="d-flex justify-content-between">
            <h3><strong>{{ $songs[0]->group->name }}</strong> - {{ $songs[0]->songlist->name }}</h3> 
            <div class="d-flex justify-content-end">
            <a href="/setlists/report/{{ $songs[0]->songlist->id }}" class="btn btn-secondary">
                <i class="fas fa-list-ol"></i>  View</a>&nbsp;&nbsp;
            <a href="/setlistgroups" class="btn btn-secondary">
                <i class="nav-icon far fa-hand-point-left"></i>  Back</a>
        </div>
        </div>
    </div>
      <div class="card-body">
    <table class="table mt-4">
        <thead>
        <tr>
            <th>Name</th>
            <th>Artist</th>
            <th>Time</th>
            <th>Status</th>

        </tr>
        </thead>
        <tbody wire:sortable="updateOrder">
        @forelse ($songs as $song)
            <tr wire:sortable.item="{{ $song->id }}" wire:key="product-{{ $song->id }}">
                <td>{{ $song->position }} - {{ $song->song->name }}</td>
                <td>{{ $song->song->artist }}</td>
                <td>{{ $song->song->time }} minutes</td>
                <td><span class="badge badge-{{ $song->song->status->style }}">{{ $song->song->status->name }}</span></td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No songs found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

