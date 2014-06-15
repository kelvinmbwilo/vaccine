<?php

class RegionPackageController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make("recieve_region.index");
    }

    /** send packagae*/
    public function sendPackage(){
        return View::make("send_region.index");

    }

    /**
     * Checking for a package with required sscc and return it details
     *
     * @param  int  $id
     * @return Response
     */
    public function checksscc($id){
        $package = NationalPackage::where('package_number',$id)->where('received_status',"")->first();
        if($package){
            if(ArrivalRegion::where('package_number',$id)->count() == NationalPackage::where('package_number',$id)->first()->packages()->count() ){
                echo "<h3 class='text-danger'>All packages from this shipping information has been received</h3>";
            }else{
                return View::make("recieve_region.package",compact('package'));
            }
        }else{
            echo "<h3 class='text-danger'>There are no information about this package</h3>";
        }

    }

    public function checkqr($id){
            $arr = $this->breakqr($id);
            $pack = NationalPackage::where('package_number',$_POST['pack'])->where('received_status',"")->first();
            $arrival = $pack->packages()->where('lot_number',$arr['lot_number'])->first();
            if($arrival){
                return View::make("recieve_region.confirm",compact('arrival'));            }
            else{
                echo "<h3 class='text-danger'>There are no information about this package</h3>";
            }
    }

    public function additemtostock($id){
        $package = NationalPackageContent::find($id);
        $arrival = ArrivalRegion::create(array(
            'national_package'      =>$package->package->id,
            'package_number'      =>$package->package->package_number,
            'regional_id'             =>$package->package->region_id,
            'lot_number'            =>$package->lot_number,
            'number_as_expected'    =>Input::get('quantity'),
            'physcal_damege'        =>Input::get('damage'),
            'vvm_status'            =>Input::get('vvm'),
            'receiver'              =>Auth::user()->id,
            'problem'               =>Input::get('comments'),
        ));

        $stock = RegionStock::where('lot_number',$package->lot_number)->first();
        $doses = $package->number_of_boxes * $package->vaccine->vials_per_box *$package->vaccine->doses_per_vial;
        if($stock){
            $stock->number_of_doses = $stock->number_of_doses + $doses;
            $stock->save();
        }else{
            RegionStock::create(array(
                'region_id'         => $package->package->region_id,
                'number_of_doses'   => $doses,
                'lot_number'        => $package->lot_number,
                'vaccine_id'        => $package->vaccine->GTIN,
                'expiry_date'       => $package->manufacturer->expiry_date
            ));
        }
        $package->status = "received";
        $package->save();
        $count = NationalPackage::find($package->package->id)->packages()->where('status','received')->count();
        $count1 = NationalPackage::find($package->package->id)->packages()->count();
        if($count == $count1){
            $package->package->received_status = "received";
            $package->package->save();
        }

        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Receive ".$package->vaccine->name." From Shipment number ". $package->package->package_number
        ));
        echo "<h3 class='text-success'>Received Successful.</h3>";
    }

    public function confirmpackage($id){
        $package = ManufacturerBarcode::find($id);
        $arr = ArrivalNational::where('ssc',$package->ssc)->count();
        $arrival = ArrivalNational::create(array(
            'ssc'=>$package->ssc,
            'number_of_packages'        =>$arr+1,
            'number_as_expected'        =>Input::get('quantity'),
            'coolant_type'              =>Input::get('coolant'),
            'temperature_monitor'       =>Input::get('temp'),
            'labels_available'          =>Input::get('labels'),
            'condition'                 =>Input::get('condition'),
            'receiver'                  =>Auth::user()->id,
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
        return View::make('recieve_region.list');
    }

    public function fillform(){
        return View::make('recieve_region.final_form');
    }

    public function areainfo($id){
        $district = District::find($id);
        return View::make('send_region.info',compact('district'));
    }

    public function prepareform($id){
            $arr = $this->breakqr(Input::get('sscc'));
            $package = RegionStock::where('lot_number',$arr['lot_number'])->where('number_of_doses','!=','0')->first();
            $idd = "";
            if($package){
                if(Input::get('id') == "first"){
                    $createdid = RegionalPackage::create(array(
                        'district_id' => $id,
                        'source_id' => District::find($id)->region_id,
                    ));
                    $createdid->package_number = '02'.strtotime($createdid->created_at);
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
                $other_vaccine = RegionStock::where('vaccine_id',$arr['gtin'])->where('number_of_doses','!=','0')->get();
                foreach($other_vaccine as $vaccine){
                    if(strtotime($vaccine->expiry_date)<strtotime($package->expiry_date))
                        $other_available = "available";
                }
                $district = District::find($id);
                return View::make("send_region.package",compact('package','idd','expiry_status','other_available','district'));
            }else{
                echo "<h3 class='text-danger'>There is no vaccine or diluent with this lot number</h3>";
            }
    }

    public function processaddpackage(){
        $stock = RegionStock::where('lot_number',Input::get('lot'))->first();
        $doses = Input::get('box') * $stock->vaccine->vials_per_box * $stock->vaccine->doses_per_vial;
        if($stock->number_of_doses > $doses){
            $pack = RegionalPackageContent::where('package_id',Input::get('idd'))->where('lot_number',Input::get('lot'))->first();
            if($pack){
                $pack->number_of_boxes = $pack->number_of_boxes+Input::get('box');
                $pack->save();
            }else{
                RegionalPackageContent::create(array(
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
        $natpack = RegionalPackage::find($id);
        return View::make('send_region.list',compact('natpack'));
    }

    public function deleteinlist($id){
        $pack = RegionalPackageContent::find($id);
        $pack->delete();
    }

    public function confirmsend($id){
        $package = RegionalPackage::find($id);
        if($package->packages()->count() != 0){
            $package->date_sent = date("Y-m-d");
            $package->sender = Auth::user()->id;

            foreach($package->packages as $pack){
                //$doses = ($pack->manufacturer->vaccine->doses_per_vial / $pack->number_of_doses )*$pack->manufacturer->vaccine->vials_per_box;
                $doses = $pack->number_of_boxes * $pack->vaccine->vials_per_box * $pack->vaccine->doses_per_vial;
                $stock = RegionStock::where('lot_number',$pack->lot_number)->first();
                $stock->number_of_doses = $stock->number_of_doses - $doses;
                $stock->save();
            }
            $package->save();
            Logs::create(array(
                "user_id"=>  Auth::user()->id,
                "action"  =>"Send a package to ".$package->district->district ." District with Shipment number ". $package->package_number
            ));
        }else{
            echo "not";
        }

    }

    public function deletprepared($id){
        $package = RegionalPackage::find($id);
        foreach($package->packages as $pack){
            $pack->delete();
        }
        $package->delete();
    }

    public function viewstock(){
        return View::make('send_region.stock');
    }

    public function viewsent(){
        return View::make('send_region.List_sent');
    }

    public function breakqr($qr){
        if (strpos($qr,'(01)') !== false && strpos($qr,'(17)') !== false) {
            $arr = explode(")",$qr);
            unset($arr[0]);
            $gtnarr1 = explode("(",$arr[1]);
            $exparr1 = explode("(",$arr[2]);
            $gtin=$gtnarr1[0];
            $lot_number=$arr[3];
            $expiry_date=$exparr1[0];
            return array("gtin"=>$gtin,"lot_number"=>$lot_number,"expiry_date"=>$expiry_date);
        }else{
            return array("lot_number"=>$qr);
        }

    }
}