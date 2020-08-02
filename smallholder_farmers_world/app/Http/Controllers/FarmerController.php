<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farmer;
use App\FarmerProduct;
use Session;
use App\UssdNotification;

class FarmerController extends Controller
{

    // Adding Farmer to the system
    public function addFarmer(Request $request){
        if(Session::get('adminDetails')['farmers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if($request->isMethod('post')){
            $data = $request->all();
            $farmerCount = Farmer::where('id_number',$data['id_number'])->count();
            $farmerCount1 = Farmer::where('phonenumber',$data['phone_number'])->count();
            if($farmerCount>0){
                return redirect()->back()->with('flash_message_error','Farmer With That ID Number Already Exists!');
            }elseif($farmerCount1>0){
                return redirect()->back()->with('flash_message_error','Farmer With That Phone Number Already Exists!');
            }else{
                $farmer = new Farmer;
                $farmer->full_name  = $data['farmer_name'];
                $farmer->phonenumber  = $data['phone_number'];
                $farmer->id_number  = $data['id_number'];
                $farmer->location  = $data['location'];
                $farmer->birthday_date  = $data['dob'];
                $farmer->sex  = $data['sex'];
                $farmer->next_of_kin  = $data['next_of_kin'];
                $farmer->farm_activity  = $data['farm_activity'];
                $farmer->save();
                return redirect('/admin/view-farmers')->with('flash_message_success','Farmer Details Added Successfully');
            }
        } 
        return view('admin.farmers.add_farmer');
    }

    // Displaying Farmers in the system
    public function viewFarmers(){
        if(Session::get('adminDetails')['farmers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        $menu_active=3;
        $i=0;
        $farmers = Farmer::orderBy('created_at','desc')->get();
        return view('admin.farmers.view_farmers')->with(compact('farmers','menu_active','i'));
    }

    // Updating Farmers Details in the system
    public function editFarmer(Request $request, $id = null){
        if(Session::get('adminDetails')['farmers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        $farmerDetails = Farmer::where(['id'=>$id])->first();
        if($request->isMethod('post')){
    		$data = $request->all();
            Farmer::where(['id'=>$id])->update(['full_name'=>$data['farmer_name'],
                                                  'phonenumber'=>$data['phone_number'],
                                                  'location'=>$data['location'],
                                                  'birthday_date'=>$data['dob'],
                                                  'sex'=>$data['sex'],
                                                  'next_of_kin'=>$data['next_of_kin'],
                                                  'farm_activity'=>$data['farm_activity']
    			]);
    		return redirect('/admin/view-farmers')->with('flash_message_success','Farmer Details Updated Successfully');
        }
        return view('admin.farmers.edit_farmer')->with(compact('farmerDetails'));
    }

    // Deleting Farmer Details in the system
    public function deleteFarmer(Request $request, $id = null){
        if(Session::get('adminDetails')['farmers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if(!empty($id)){
            Farmer::where(['id'=>$id])->delete();
            UssdNotification::where(['farmer_id'=>$id])->delete();
    		return redirect()->back()->with('flash_message_success','Farmer Details Deleted Successfully');
    	}
    }
    // Add Farmer Product
    public function addFarmerProduct(Request $request){
		/*
		if(Session::get('adminDetails')['ussd_notifications_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
		}
		*/
    	if($request->isMethod('post')){
    		$data = $request->all();

            if(empty($data['farmer_id'])){
				return redirect()->back()->with('flash_message_error','Farmer Name Is Missing ');    
            }
            if(empty($data['status'])){
                $data['status'] = 0;
            }
 	   		$product = new FarmerProduct;
 	   		$product->farmer_id = $data['farmer_id'];
 	   		$product->produce_name = $data['produce_name'];
            $product->selling_price = $data['selling_price'];
            $product->amount = $data['amount'];

			if(!empty($data['description'])){
 	   			$product->description = $data['description'];
 	   		}else{
 	   			$product->description = '';
 	   		}
 	   		$product->save();
 	   		//return redirect()->back()->with('flash_message_success', 'Product has been added successfully');
 	   		return redirect('/admin/view-farmer-products')->with('flash_message_success', 'Farmer Produce has been Added successfully');
    	}

    	//Categories drop down start
		$farmers = Farmer::where(['parent_id' => 0])->get();

		$farmers_drop_down = "<option value='' selected disabled>Select</option>";
		foreach($farmers as $cat){
			$farmers_drop_down .= "<option value='".$cat->id."'>".$cat->full_name."</option>";
			
		}
    	// Categories drop down end

    	return view('admin.farmers.add_farmer_produce')->with(compact('farmers_drop_down'));
    }
    // View Farmer Product
    public function viewFarmerProducts(Request $request){
		$products = FarmerProduct::get();
        foreach($products as $key =>$val){
            $full_name = Farmer::where(['id'=>$val->farmer_id])->first();
            $products[$key]->full_name = $full_name->full_name;
		}
        foreach($products as $key =>$val){
            $phonenumber = Farmer::where(['id'=>$val->farmer_id])->first();
            $products[$key]->phonenumber = $phonenumber->phonenumber;
        }
        foreach($products as $key =>$val){
            $location = Farmer::where(['id'=>$val->farmer_id])->first();
            $products[$key]->location = $location->location;
        }        
        return view ('admin.farmers.view_farmer_products')->with(compact('products'));
	}
    // edit farmer product
    public function editFarmerProduce(Request $request, $id=null){
        if(Session::get('adminDetails')['ussd_notifications_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;
            if(empty($data['description'])){
                $data['description'] = '';
            }

            FarmerProduct::where(['id'=>$id])->update(['farmer_id'=>$data['farmer_id'],'description'=>$data['description'],'produce_name'=>$data['produce_name'],'selling_price'=>$data['selling_price'],'amount'=>$data['amount']]);


            return redirect()->back()->with('flash_message_success','Farmer Produce Details Have Been Updated Successfully');
        }

        // Get farmer details
        $farmerProduceDetails = FarmerProduct::where(['id'=>$id])->first();
        //farmers drop down start
        $farmers = Farmer::where(['parent_id'=>0])->get();
        $farmers_drop_down = "<option value='' selected disabled>Select</option>";
        foreach($farmers as $far){
            if($far->id==$farmerProduceDetails->farmer_id){
                $selected = "selected";
            }else{
                $selected = "";
            }   
            $farmers_drop_down .= "<option value='".$far->id."' ".$selected.">".$far->full_name."</option>";
        }
        // Farmers drop down end
        return view('admin.farmers.edit_farmer_produce')->with(compact('farmerProduceDetails','farmers_drop_down'));
    }       

    // deleting farmer products
    public function deleteFarmerProduct(Request $request, $id = null){

        if(!empty($id)){
            FarmerProduct::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Farmer Product Details Deleted Successfully');
        }
    }



}
