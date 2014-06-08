<?php

class PackageController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make("recieve_national.index");
	}

/** send packagae*/
    public function sendPackage(){

                return View::make("send_package.index");

    }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function lists()
	{
		return View::make("package.receive");
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    /**
     * Recieve a package in a national level
     *
     * @return Response
     */
    public function receive()
    {
        return View::make("recieve.national");
    }

    /**
     * Checking for a package with required sscc and return it details
     *
     * @param  int  $id
     * @return Response
     */
    public function checksscc($id){
        $package = ManufacturerBarcode::where('ssc',$id)->first();
        if(ArrivalNational::where('ssc',$package->ssc)->count() == $package->number_of_packages ){
            echo "<h3 class='text-danger'>All packages from this shipping information has been scanned</h3>";
        }else{
            if($package){
                return View::make("recieve_national.package",compact('package'));
            }else{
                echo "<h3 class='text-danger'>There are no information about this package</h3>";
            }
        }

    }

    public function confirmpackage($id){
        $package = ManufacturerBarcode::find($id);
        $arr = ArrivalNational::where('ssc',$package->ssc)->count();
        $arrival = ArrivalNational::create(array(
            'ssc'=>$package->ssc,
            'number_of_packages'=>$arr+1,
            'number_as_expected'=>Input::get('quantity'),
            'coolant_type'=>Input::get('coolant'),
            'temperature_monitor'=>Input::get('temp'),
            'labels_available'=>Input::get('labels'),
            'condition'=>Input::get('condition'),
            'receiver'=>Auth::user()->id,
        ));
    }


}