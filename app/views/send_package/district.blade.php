<div class="row">

<p>Prepare package </p>
    <form role="form">
        <div class="form-group">
            <label for="batch_no">Batch Number</label>
            <input type="text" class="form-control" id="batch_no" name="batch_no" placeholder="Batch Number">
        </div>
        <div class="form-group">
            <label for="expire_date">Expire Date</label>
            <input type="text" class="form-control date" id="expire_date" name="expire_date" placeholder="Expire Date">
        </div>
        <div class="form-group">
            <label for="gtn">GTIN </label>
            <input type="text" id="gtn" class="form-control" name="gtin" placeholder="GTIN">

        </div>

        <button type="submit" class="btn btn-primary btn-sm">Send To District </button>
    </form>

</div>
<script>
    $(document).ready(function (){

        $(".dat").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd"
        });
    });