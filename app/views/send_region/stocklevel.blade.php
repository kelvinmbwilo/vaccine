@extends("layout.master")

@section('title')
<h1>
    Stock
    <small>{{ Auth::user()->region->region }} Region Stock Information </small>
</h1>
@stop
@section('contents')
@if(RegionStock::all()->count() == 0)
<h3>There are no vaccines or diluent in the stock</h3>
@else
<table class="table table-striped table-bordered example3" id="example2">
    <thead>
    <tr>
        <th> # </th>
        <th>GTIN</th>
        <!--        <th>Number Of Packages</th>-->
        <th>Manufacturer</th>
        <th>Name</th>
        <th>Lot Number</th>
        <th>Number Of Doses</th>
        <th>Expiry Date</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach(RegionStock::all() as $us)
    @if($us)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $us->vaccine->GTIN }}</td>
        <td>{{ $us->vaccine->manufacturer }}</td>
        <td>
            {{ $us->vaccine->name }}
        </td>
        <td>{{ $us->lot_number }}</td>
        <td>{{ $us->number_of_doses }}</td>
        <td>{{ date('j M Y',strtotime($us->expiry_date)) }}</td>
    </tr>
    @endif
    @endforeach

    </tbody>
</table>

@endif
@stop