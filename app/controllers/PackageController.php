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
        return View::make("send_national.index");

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
        if($package){
        if(ArrivalNational::where('ssc',$package->ssc)->count() == $package->number_of_packages ){
            echo "<h3 class='text-danger'>All packages from this shipping information has been scanned</h3>";
        }else{

                return View::make("recieve_national.package",compact('package'));
            }
        }else{
            echo "<h3 class='text-danger'>There are no information about this package</h3>";
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
        if($arr+1 != $package->number_of_packages)
            echo "<h3 class='text-success'><i class='fa fa-check fa-2x'></i> The package is confirmed</h3>";
        if($arr+1 == $package->number_of_packages){
            foreach($package->packages as $pack){
                $stock = NationalStock::where('lot_number',$pack->lot_number)->first();
                if($stock){
                    $stock->number_of_doses = $stock->number_of_doses + $pack->number_of_doses;
                }else{
                    NationalStock::create(array(
                        'number_of_doses'   => $pack->number_of_doses,
                        'lot_number'        => $pack->lot_number
                    ));
                }
            }
            echo "<h3 class='text-success'><i class='fa fa-check fa-2x'></i> All packages Are confirmed</h3>";
        }
    }

    public function listrecieved(){
        return View::make('recieve_national.list');
    }

    public function fillform(){
        return View::make('recieve_national.final_form');
    }

    public function prepareform($id){
        $package = NationalStock::where('lot_number',$id)->first();
        $idd = "";
        if($package){
            if(Input::get('id') == "first"){
                $createdid = NationalPackage::create(array(
                    'region_id' => Input::get('region')
                ));
                $idd = $createdid->id;
            }else{

            }

            return View::make("send_national.package",compact('package','idd'));
        }else{
            echo "<h3 class='text-danger'>There is no vaccine or diluent with this lot number</h3>";
        }
    }

    public function processaddpackage(){
        $stock = NationalStock::where('lot_number',Input::get('lot'))->first();
        $doses = Input::get('box') * $stock->manufacturer->vaccine->vials_per_box * $stock->manufacturer->vaccine->doses_per_vial;

        if($stock->number_of_doses > $doses){
            $pack = NationalPackageContent::where('package_id',Input::get('idd'))->where('lot_number',Input::get('lot'))->first();
            if($pack){
                $pack->number_of_boxes = $pack->number_of_boxes+Input::get('box');
                $pack->save();
            }else{
                NationalPackageContent::create(array(
                    'package_id' => Input::get('idd'),
                    'number_of_boxes' => Input::get('box'),
                    'lot_number' => Input::get('lot')
                ));
            }
            echo '<h3 class="text-success">Added Successfull</h3>';
        }else{
            echo '<h3 class="text-danger"> This amount is not available on stock</h3>';
        }
    }

    public function sendPackageList($id){
        $natpack = NationalPackage::find($id);
        return View::make('send_national.list',compact('natpack'));
    }

    public function deleteinlist($id){
        $pack = NationalPackageContent::find($id);
        $pack->delete();
    }

    public function confirmsend($id){
        $package = NationalPackage::find($id);
        if($package->packages()->count() != 0){
            $package->date_sent = date("Y-m-d");
            $package->sender = Auth::user()->id;

            foreach($package->packages as $pack){
                //$doses = ($pack->manufacturer->vaccine->doses_per_vial / $pack->number_of_doses )*$pack->manufacturer->vaccine->vials_per_box;
                $doses = $pack->number_of_boxes * $pack->manufacturer->vaccine->vials_per_box * $pack->manufacturer->vaccine->doses_per_vial;
                $stock = NationalStock::where('lot_number',$pack->lot_number)->first();
                $stock->number_of_doses = $stock->number_of_doses - $doses;
                $stock->save();
            }
            $package->save();
        }else{
            echo "not";
        }

    }

    public function deletprepared($id){
        $package = NationalPackage::find($id);
        foreach($package->packages as $pack){
            $pack->delete();
        }
        $package->delete();
    }

    public function viewstock(){
        return View::make('send_national.stock');
    }

    public function viewsent(){
        return View::make('send_national.List_sent');
    }
}