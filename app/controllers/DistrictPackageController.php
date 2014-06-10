<?php

class DistrictPackageController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make("recieve_district.index");
    }

    /** send packagae*/
    public function sendPackage(){
        return View::make("send_district.index");

    }

    /**
     * Checking for a package with required sscc and return it details
     *
     * @param  int  $id
     * @return Response
     */
    public function checksscc($id){
        $district =  Auth::user()->district_id;
        $package = RegionalPackage::where('received_status','')->where('district_id',$district)->where('id',$id)->first();
        if($package){
            return View::make("recieve_district.package",compact('package'));
        }else{
            echo "<h3 class='text-danger'>There are no information about this package</h3>";
        }

    }

    public function confirmpackage($id){
        $package = RegionalPackage::find($id);
        $arr = Arrivaldistrict::where('lot_number',$package->ssc)->where('district_id',Auth::user()->district_id)->count();
        $arrival = Arrivaldistrict::create(array(
            'regional_package'=>$package->id,
            'district_id'=>Auth::user()->district_id,
            'number_as_expected'=>Input::get('quantity'),
            'coolant_type'=>Input::get('coolant'),
            'temperature_monitor'=>Input::get('temp'),
            'labels_available'=>Input::get('labels'),
            'condition'=>Input::get('condition'),
            'receiver'=>Auth::user()->id,
        ));

        foreach($package->packages as $pack){
            $stock = DistrictStock::where('lot_number',$pack->lot_number)->first();
            $doses = $pack->number_of_boxes * $pack->manufacturer->vaccine->vials_per_box * $pack->manufacturer->vaccine->doses_per_vial;
            if($stock){
                $stock->number_of_doses = $stock->number_of_doses + $doses;
                $stock->save();
            }else{
                DistrictStock::create(array(
                    'number_of_doses'   => $doses,
                    'lot_number'        => $pack->lot_number,
                    'district_id'         => Auth::user()->district_id,
                ));
            }
        }
        $package->receiver = Auth::user()->id;
        $package->received_status = 'received';
        $package->date_received  =date('Y-m-d');
        $package->save();
        echo "<h3 class='text-success'><i class='fa fa-check fa-2x'></i> All packages Are confirmed</h3>";

    }

    public function listrecieved(){
        return View::make('recieve_district.list');
    }

    public function fillform(){
        return View::make('recieve_regional.final_form');
    }

    public function prepareform($id){
        $package = DistrictStock::where('lot_number',$id)->where('district_id',Auth::user()->district_id)->first();
        $idd = "";
        if($package){
            if(Input::get('id') == "first"){
                $createdid = DistrictPackage::create(array(
                    'source_id' => Auth::user()->district_id,
                    'district_id' => Input::get('district'),
                ));
                $idd = $createdid->id;
            }else{

            }

            return View::make("send_district.package",compact('package','idd'));
        }else{
            echo "<h3 class='text-danger'>There is no vaccine or diluent with this lot number</h3>";
        }
    }

    public function processaddpackage(){
        $stock = DistrictStock::where('lot_number',Input::get('lot'))->where('district_id',Auth::user()->district_id)->first();
        $doses = Input::get('box') * $stock->manufacturer->vaccine->vials_per_box * $stock->manufacturer->vaccine->doses_per_vial;
        if($stock->number_of_doses > $doses){
            $pack = DistrictPackageContent::where('package_id',Input::get('idd'))->where('lot_number',Input::get('lot'))->first();
            if($pack){
                $pack->number_of_boxes = $pack->number_of_boxes+Input::get('box');
                $pack->save();
            }else{
                DistrictPackageContent::create(array(
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
        $natpack = DistrictPackage::find($id);
        return View::make('send_district.list',compact('natpack'));
    }

    public function deleteinlist($id){
        $pack = DistrictPackageContent::find($id);
        $pack->delete();
    }

    public function confirmsend($id){
        $package = DistrictPackage::find($id);
        if($package->packages()->count() != 0){
            $package->date_sent = date("Y-m-d");
            $package->sender = Auth::user()->id;

            foreach($package->packages as $pack){
                //$doses = ($pack->manufacturer->vaccine->doses_per_vial / $pack->number_of_doses )*$pack->manufacturer->vaccine->vials_per_box;
                $doses = $pack->number_of_boxes * $pack->manufacturer->vaccine->vials_per_box * $pack->manufacturer->vaccine->doses_per_vial;
                $stock = DistrictStock::where('lot_number',$pack->lot_number)->where('district_id',Auth::user()->district_id)->first();
                $stock->number_of_doses = $stock->number_of_doses - $doses;
                $stock->save();
            }
            $package->save();
        }else{
            echo "not";
        }

    }

    public function deletprepared($id){
        $package = DistrictPackage::find($id);
        foreach($package->packages as $pack){
            $pack->delete();
        }
        $package->delete();
    }

    public function viewstock(){
        return View::make('send_district.stock');
    }

    public function viewsent(){
        return View::make('send_district.List_sent');
    }
}
