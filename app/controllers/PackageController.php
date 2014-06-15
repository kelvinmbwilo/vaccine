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
        $package = ManufacturePackage::where('sscc',$id)->where('status',"")->get();
        if($package){
        if(ArrivalNational::where('ssc',$id)->count() == ManufacturePackage::where('sscc',$id)->count() ){
            echo "<h3 class='text-danger'>All packages from this shipping information has been received</h3>";
        }else{
                return View::make("recieve_national.package",compact('package'));
            }
        }else{
            echo "<h3 class='text-danger'>There are no information about this package</h3>";
        }

    }

    public function checkqr($id){
        if (strpos($id,')') !== false) {
        $arr = $this->breakqr($id);
        $arrival = ManufacturePackage::where('lot_number',$arr['lot_number'])->where('status',"")->first();
        if($arrival){
                return View::make("recieve_national.confirm",compact('arrival'));            }
        else{
            echo "<h3 class='text-danger'>There are no information about this item</h3>";
        }

        }else{
            echo "<h3 class='text-danger'>The scanned Qr Code is Invalid</h3>";
        }



    }

    public function additemtostock($id){
        $package = ManufacturePackage::find($id);
        $arr = ArrivalNational::where('ssc',$package->ssc)->count();
        $arr1 = ManufacturePackage::where('sscc',$package->sscc);
        $arrival = ArrivalNational::create(array(
            'ssc'                   =>$package->sscc,
            'lot_number'            =>$package->lot_number,
            'number_as_expected'    =>Input::get('quantity'),
            'temperature_monitor'   =>Input::get('temp'),
            'physcal_damege'        =>Input::get('damage'),
            'vvm_status'            =>Input::get('vvm'),
            'receiver'              =>Auth::user()->id,
            'problem'               =>Input::get('comments'),
        ));

        $stock = NationalStock::where('lot_number',$package->lot_number)->first();
        if($stock){
            $stock->number_of_doses = $stock->number_of_doses + $package->number_of_doses;
            $stock->save();
        }else{
            NationalStock::create(array(
                'number_of_doses'   => $package->number_of_doses,
                'lot_number'        => $package->lot_number,
                'GTIN'              => $package->vaccine->GTIN,
                'expiry_date'       => $package->expiry_date
            ));
        }
        $package->status = "received";
        $package->save();
        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Receive ".$package->vaccine->name." From Shipment number ". $package->sscc
        ));
        echo "<h3 class='text-success'>Received Successful.</h3>";
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
                    $stock->number_of_doses = $stock->number_of_doses + ($package->number_of_packages*$pack->number_of_doses);
                    $stock->save();
                }else{
                    NationalStock::create(array(
                        'number_of_doses'   => $package->number_of_packages*$pack->number_of_doses,
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

    public function areainfo($id){
        $region = Region::find($id);
        return View::make('send_national.info',compact('region'));
    }

    public function prepareform($id){
        if (strpos(Input::get('sscc'),')') !== false) {
            $arr = $this->breakqr(Input::get('sscc'));
            $package = NationalStock::where('lot_number',$arr['lot_number'])->where('number_of_doses','!=','0')->first();
            $idd = "";
            if($package){
                if(Input::get('id') == "first"){
                    $createdid = NationalPackage::create(array(
                        'region_id' => $id,
                    ));
                    $createdid->package_number = strtotime($createdid->created_at);
                    $createdid->save();
                    $idd = $createdid->id;
                }
                //ckecking expiry and diluent collarance
                $expiry_status ="";
                 if(strtotime($package->expiry_date) < strtotime(date('Y-m-d')) ){
                     $expiry_status = "expired";
                 }elseif((strtotime($package->expiry_date) - strtotime(date('Y-m-d')))/2592000 < $package->vaccine->warning_period){
                     $expiry_status = "near expiry";
                 }

                //checking the existance of same vaccine with close expiry date
                $other_available="";
                $other_vaccine = NationalStock::where('GTIN',$arr['gtin'])->where('number_of_doses','!=','0')->get();
                foreach($other_vaccine as $vaccine){
                    if(strtotime($vaccine->expiry_date)<strtotime($package->expiry_date))
                        $other_available = "available";
                }
                return View::make("send_national.package",compact('package','idd','expiry_status','other_available'));
            }else{
                echo "<h3 class='text-danger'>There is no vaccine or diluent with this lot number</h3>";
            }
        }else{
            echo "<h3 class='text-danger'>The scanned Qr Code is Invalid</h3>";
        }

    }

    public function processaddpackage(){
        $stock = NationalStock::where('lot_number',Input::get('lot'))->first();
        $doses = Input::get('box') * $stock->vaccine->vials_per_box * $stock->vaccine->doses_per_vial;
        if($stock->number_of_doses > $doses){
            $pack = NationalPackageContent::where('package_id',Input::get('idd'))->where('lot_number',Input::get('lot'))->first();
            if($pack){
                $pack->number_of_boxes = $pack->number_of_boxes+Input::get('box');
                $pack->save();
            }else{
                NationalPackageContent::create(array(
                    'package_id' => Input::get('idd'),
                    'number_of_boxes' => Input::get('box'),
                    'lot_number' => Input::get('lot'),
                    'vaccine_id' => $stock->vaccine->id
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
                $doses = $pack->number_of_boxes * $pack->vaccine->vials_per_box * $pack->vaccine->doses_per_vial;
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

    public function breakqr($qr){

        $arr = explode(")",$qr);
        unset($arr[0]);
        $gtnarr1 = explode("(",$arr[1]);
        $exparr1 = explode("(",$arr[2]);
        $gtin=$gtnarr1[0];
        $lot_number=$arr[3];
        $expiry_date=$exparr1[0];
        return array("gtin"=>$gtin,"lot_number"=>$lot_number,"expiry_date"=>$expiry_date);
    }
}