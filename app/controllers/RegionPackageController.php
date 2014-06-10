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
        $region =  Auth::user()->region_id;
        $package = NationalPackage::where('received_status','')->where('region_id',$region)->where('id',$id)->first();
        if($package){
            return View::make("recieve_region.package",compact('package'));
        }else{
            echo "<h3 class='text-danger'>There are no information about this package</h3>";
        }

    }

    public function confirmpackage($id){
        $package = NationalPackage::find($id);
        $arr = ArrivalRegion::where('lot_number',$package->ssc)->count();
        $arrival = ArrivalRegion::create(array(
            'national_package'=>$package->id,
            'regional_id'=>Auth::user()->region_id,
            'number_as_expected'=>Input::get('quantity'),
            'coolant_type'=>Input::get('coolant'),
            'temperature_monitor'=>Input::get('temp'),
            'labels_available'=>Input::get('labels'),
            'condition'=>Input::get('condition'),
            'receiver'=>Auth::user()->id,
        ));

            foreach($package->packages as $pack){
                $stock = RegionStock::where('lot_number',$pack->lot_number)->first();
                $doses = $pack->number_of_boxes * $pack->manufacturer->vaccine->vials_per_box * $pack->manufacturer->vaccine->doses_per_vial;
                if($stock){
                    $stock->number_of_doses = $stock->number_of_doses + $doses;
                    $stock->save();
                }else{
                    RegionStock::create(array(
                        'number_of_doses'   => $doses,
                        'lot_number'        => $pack->lot_number,
                        'region_id'         => Auth::user()->region_id,
                    ));
                }
            }
        $package->receiver = Auth::user()->id;
        $package->received_status = 'received';
        $package->save();
            echo "<h3 class='text-success'><i class='fa fa-check fa-2x'></i> All packages Are confirmed</h3>";

    }

    public function listrecieved(){
        return View::make('recieve_region.list');
    }

    public function fillform(){
        return View::make('recieve_national.final_form');
    }

    public function prepareform($id){
        $package = RegionStock::where('lot_number',$id)->first();
        $idd = "";
        if($package){
            if(Input::get('id') == "first"){
                $createdid = NationalPackage::create(array(
                    'region_id' => Input::get('region')
                ));
                $idd = $createdid->id;
            }else{

            }

            return View::make("send_region.package",compact('package','idd'));
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
        return View::make('send_regional.list',compact('natpack'));
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
        return View::make('send_region.stock');
    }

    public function viewsent(){
        return View::make('send_region.List_sent');
    }
}