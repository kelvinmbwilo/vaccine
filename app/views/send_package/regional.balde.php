<div class="row">
    <div class="col-md-5 col-md-offset-1">
        <p style="font-size:20px;font-weight:bold;">Prepare vaccine package  </p>
        <form role="form">

            <div class='form-group'>
                <label for="region">Region Name</label>
                {{ Form::select('region',array('all'=>'all')+Region::all()->lists('region','id'),'',array('class'=>'form-control','required'=>'requiered')) }}
            </div>
            <div class="form-group">
                <label for="batch_no">Batch Number</label>
                <input type="text" class="form-control" id="batch_no" name="batch_no" placeholder="Batch Number">
            </div>
            <div class="form-group">
                <label for="expire_date">Expire Date</label>
                <input type="text" class="form-control dat" id="expire_date" name="expire_date" placeholder="Expire Date">
            </div>
            <div class="form-group">
                <label for="gtn">GTIN </label>
                <input type="text" id="gtn" class="form-control" name="gtin" placeholder="GTIN">

            </div>

            <div class="form-group">
                <label for="boxes">Number Of Boxes </label>
                <input type="text" id="boxes" class="form-control" name="boxes" placeholder="Number Of Boxes">

            </div>

            <button type="submit" class="btn btn-primary btn-sm">Send To Region </button>
        </form>
    </div>
    <div class="col-md-5 ">
        <p style="font-size:20px;font-weight:bold;">Prepare diluent package </p>
        <form role="form">

            <div class='form-group'>
                <label for="region">Region Name</label>
                {{ Form::select('region',array('all'=>'all')+Region::all()->lists('region','id'),'',array('class'=>'form-control','required'=>'requiered')) }}
            </div>
            <div class="form-group">
                <label for="batch_no">Batch Number</label>
                <input type="text" class="form-control" id="batch_no" name="batch_no" placeholder="Batch Number">
            </div>
            <div class="form-group">
                <label for="expire_date">Expire Date</label>
                <input type="text" class="form-control dat" id="expire_date" name="expire_date" placeholder="Expire Date">
            </div>
            <div class="form-group">
                <label for="gtn">GTIN </label>
                <input type="text" id="gtn" class="form-control" name="gtin" placeholder="GTIN">

            </div>

            <div class="form-group">
                <label for="boxes">Number Of Boxes </label>
                <input type="text" id="boxes" class="form-control" name="boxes" placeholder="Number Of Boxes">

            </div>

            <button type="submit" class="btn btn-primary btn-sm">Send To District </button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function (){

        $(".dat").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd"
        });
    });
</script>