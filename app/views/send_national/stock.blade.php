@extends("layout.master")

@section('title')
<h1>
    Stock level
    <small>National Stock Information </small>
</h1>
@stop
@section('contents')
@if(NationalStock::all()->count() == 0)
<h3>There are no vaccines or diluent in the stock</h3>
@else
<table class="table table-striped table-bordered" id="example2">
    <thead>
    <tr>
        <th> # </th>
        <th>Lot Number</th>
        <!--        <th>Number Of Packages</th>-->
        <th>Type</th>
        <th>Name</th>
        <th>Number Of Doses</th>
        <th>Doses Per Box</th>
        <th>Boxes</th>
        <th>Expiry Date</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach(NationalStock::all() as $us)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $us->lot_number }}</td>
        <td>{{ $us->manufacturer->content }}</td>
        <td>
            @if($us->manufacturer->content == 'vaccine')
            {{ $us->manufacturer->vaccine->vaccine_name }}
            @else
            {{ $us->manufacturer->diluent->diluent_name }}
            @endif
        </td>
        <td>{{ $us->number_of_doses }}</td>
        <td>{{ $us->manufacturer->vaccine->doses_per_vial*$us->manufacturer->vaccine->vials_per_box; }}</td>
        <td>{{ $us->number_of_doses/($us->manufacturer->vaccine->doses_per_vial*$us->manufacturer->vaccine->vials_per_box) }}</td>
        <td>{{ date('j M Y',strtotime($us->manufacturer->expiry_date)) }}</td>
    </tr>
    @endforeach

    </tbody>
</table>

@endif
</div>
</div>
</div>


@stop