<?php

class DemographicsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        Return View::make("demographics.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     *@param  int  $id
     * @return Response
     */
    public function create($id)
    {
        $district = District::find($id);
        Return View::make("demographics.add",compact('district'));
    }


    /**
     * Store a newly created resource in storage.
     *@param  int  $id
     * @return Response
     */
    public function putt($id)
    {
        $district = District::find($id);
        $district->target_population=Input::get("population");
        $district->annual_birth     =Input::get("birth");
        $district->surviving_infants= Input::get("infants");
        $district->save();
        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Update Demographic information for  ".$district->district." district"
        ));
        return "<h4 class='text-success'>Demographic information Updated Successful</h4>";
    }


    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function lists()
    {
        return View::make("demographics.list");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $facility = Facility::find($id);
        return View::make("demographics.edit",compact("facility"));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $vaccine = Facility::find($id);
        $vaccine->district_id=Input::get("district");
        $vaccine->name=Input::get("name");
        $vaccine->contact=Input::get("contact");
        $vaccine->target_population=Input::get("population");
        $vaccine->annual_birth=Input::get("birth");
        $vaccine->surviving_infants=Input::get("infants");
        $vaccine->save();
        $name = $vaccine->name;

        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Update facility with name ".$name
        ));
        return "<h4 class='text-success'>Facility Updated Successful</h4>";
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $facility = Facility::find($id);
        $gt = $facility->name;
        $facility->delete();
        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Delete facility with name ".$gt
        ));
    }


}
