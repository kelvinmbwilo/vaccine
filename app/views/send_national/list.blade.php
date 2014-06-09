<h4 class="text-center">Scanned Packages Ready to Send to {{ $natpack->region->region }} </h4>
<table class="table table-hover table-responsive">
    <tr>
        <th>#</th>
        <th>Type</th>
        <th>Name</th>
        <th>Expiry Date</th>
        <th>Number Of Boxes</th>
    </tr>
    <?php $i = 1 ?>
    @foreach($natpack->packages as $pack)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $pack->manufacturer->content }}</td>
        <td>
            @if($pack->manufacturer->content == 'vaccine')
                {{ $pack->manufacturer->vaccine->vaccine_name }}
            @else
                {{ $pack->manufacturer->diluent->diluent_name }}
            @endif
        </td>
        <td>{{ $pack->manufacturer->expiry_date }}</td>
        <td>{{ $pack->number_of_boxes }}</td>
    </tr>
    @endforeach
</table>

<button type="button" class="btn btn-primary" style="margin-top: 10px">Confirm and Send</button>