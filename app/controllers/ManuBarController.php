<?php

class ManuBarController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        Return View::make("manufabar.index");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        Return View::make("manufabar.add");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(ManufacturerBarcode::where("barcode",Input::get("barcode"))->count() == 0){
            $manu = ManufacturerBarcode::create(array(
                'manufacture_id'      => Input::get("manufacture"),
                'barcode'        =>Input::get("barcode"),
                'vaccine_id'     =>(Input::get("sel") == "vaccine")?Input::get("vaccine"):"",
                'diluent_id'     =>(Input::get("sel") == "diluent")?Input::get("diluent"):"",
                'Manufacture_date'      => Input::get("manu"),
                'expiry_date'        =>Input::get("exp"),
                'quantity'        =>Input::get("quantity"),
                'lot_number'        =>Input::get("lot"),
                'boxes'        =>Input::get("boxes"),
                'vials'        =>Input::get("vials")
            ));

        }else{
            return "<h4 class='text-error'>Manufacture Barcode already existed </h4>".Input::get('barcode');
        }
    }


    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function lists()
    {
        return View::make("manufabar.list");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $manu = Manufacturer::find($id);
        return View::make("manufabar.edit",compact("manu"));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $manu = Manufacturer::find($id);
        $manu->name = Input::get("name");
        $manu->country = Input::get("country");
        $manu->email = Input::get("email");
        $manu->physcal_address = Input::get("address");
        $manu->save();
        $name = $manu->name;



        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Update manufacture with name ".$name
        ));
        return "<h4 class='text-success'>Manufacture Updated Successfull</h4>";
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $manu = Manufacturer::find($id);


        if($manu->vaccine()->count() != 0){
            foreach($manu->vaccine as $vaccine){
                $vaccine->delete();
            }
        }

        if($manu->diluent()->count() != 0){
            foreach($manu->diluent as $diluent){
                $diluent->delete();
            }
        }
        $gt = $manu->name;
        $manu->delete();

        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Delete Manufacture with name ".$gt
        ));
    }


}