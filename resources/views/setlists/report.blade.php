<html>
<head>
<style type="text/css">
@media print
{
    .noprint {display:none;}
}

@media screen
{
}
</style>

</head>
<div id="app">
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
<div class="card">
    <div class="card-header bg-light">
        <div class="d-flex justify-content-between">
            <button class="noprint btn btn-primary" onclick="window.print()">Print</button>
            <button class="noprint btn btn-primary" onclick="window.history.back()">Back</button>
        </div>
    </div>
    <div class="card-body">

    <table class="table" width="100%">
  <tbody>
        <tr>
            <td>
                <font size="+.9" style="font-family:'Courier New'"><h1><u>{{ $data[0]->group->name }} - {{ $data[0]->songlist->name }}</u></h1> </font>
            </td>
        </tr>
        @forelse ($data as $item)
            <tr style="height: 0">
                <td><font size="+.9" style="font-family:'Courier New'"><h1>{{ $item->song->name }}</h1></font></td>
            </tr>
        @empty
            <tr>
                <td>No Songs found.</td>
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






