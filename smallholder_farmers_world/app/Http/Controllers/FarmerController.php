<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farmer;
use App\FarmerProduct;
use App\District;
use App\EPAs;
use DB;
use Session;
use App\UssdNotification;
use App\Exports\farmersExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class FarmerController extends Controller
{

    public function GetSubCatAgainstMainCatEdit($id){
        echo json_encode(DB::table('epas')->where('id', $id)->get());
    }
<<<<<<< HEAD
    
    
=======
      
>>>>>>> b93bc578f52316868abdf6ac085cdba739fb774f

    // Adding Farmer to the system
    public function addFarmer(Request $request){
        $district=District::all();//get data from table
        if(Session::get('adminDetails')['farmers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if($request->isMethod('post')){
            $data = $request->all();
            $farmerCount = Farmer::where('id_number',$data['id_number'])->count();
            $farmerCount1 = Farmer::where('phonenumber',$data['phone_number'])->count();
            if(empty($data['sex'])){
                $data['sex'] = 0;
            }
<<<<<<< HEAD
            if(empty($data['district_id'])){
                return redirect()->back()->with('flash_message_error','District Name Missing ');    
            }
            if(empty($data['epaname'])){
                $data['epaname'] = "Not Available";    
            }            
=======
            
>>>>>>> b93bc578f52316868abdf6ac085cdba739fb774f
            if($farmerCount>0){
                return redirect()->back()->with('flash_message_error','Farmer With That ID Number Already Exists!');
            }elseif($farmerCount1>0){
                return redirect()->back()->with('flash_message_error','Farmer With That Phone Number Already Exists!');
                
            }else{
                $farmer = new Farmer;
                $farmer->full_name  = $data['farmer_name'];
                $farmer->phonenumber  = $data['phone_number'];
                $farmer->id_number  = $data['id_number'];
                $farmer->farmer_district = $data['district_id'];
                $farmer->farmer_epa = $data['epaname'];
                $farmer->birthday_date  = $data['dob'];
                $farmer->sex  = $data['sex'];
                $farmer->next_of_kin  = $data['next_of_kin'];
                $farmer->farm_activity  = $data['farm_activity'];
                $farmer->status = $data['status']= 2;
                $farmer->save();
                return redirect('/admin/view-farmers')->with('flash_message_success','Farmer Details Added Successfully');
            }
        } 
        return view('admin.farmers.add_farmer')->with(compact('district'));
    }

    // Displaying Farmers in the system
    public function viewFarmers(){
        if(Session::get('adminDetails')['farmers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        $menu_active=3;
        $i=0;
        $farmers = Farmer::orderBy('created_at','desc')->get();
        $farmers = json_decode(json_encode($farmers));
        /*
    	foreach($farmers as $key => $val){
    		$epaname = epas::where(['ep_id'=>$val->farmer_epa])->first();
    		$farmers[$key]->epaname = $epaname->epaname;
        }
        */
        foreach($farmers as $key => $val){
    		$districtname = District::where(['id'=>$val->farmer_district])->first();
    		$farmers[$key]->districtname = $districtname->districtname;
        }


        return view('admin.farmers.view_farmers')->with(compact('farmers','menu_active','i'));

        
    }

    // Updating Farmers Details in the system
    public function editFarmer(Request $request, $id = null){
        $district=District::all();//get data from table

        if(Session::get('adminDetails')['farmers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        $farmerDetails = Farmer::where(['id'=>$id])->first();
        if($request->isMethod('post')){
            $data = $request->all();
            $farmerCount = Farmer::where('id_number',$data['id_number'])->count();
            $farmerCount1 = Farmer::where('phonenumber',$data['phone_number'])->count();
            if(empty($data['sex'])){
                $data['sex'] = 0;
            }
            else{
            Farmer::where(['id'=>$id])->update(['full_name'=>$data['farmer_name'],
                                                  'phonenumber'=>$data['phone_number'],
                                                  'id_number'=>$data['id_number'],
                                                  'farmer_district' =>$data ['district_id'],
                                                  'farmer_epa' => $data['epaname'],
                                                  'birthday_date'=>$data['dob'],
                                                  'sex'=>$data['sex'],
                                                  'next_of_kin'=>$data['next_of_kin'],
                                                  'farm_activity'=>$data['farm_activity']

                ]);
            }
    		return redirect('/admin/view-farmers')->with('flash_message_success','Farmer Details Updated Successfully');
        }
        return view('admin.farmers.edit_farmer')->with(compact('farmerDetails','district'));
    }

    // Deleting Farmer Details in the system
    public function deleteFarmer(Request $request, $id = null){
        if(Session::get('adminDetails')['farmers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if(!empty($id)){
            Farmer::where(['id'=>$id])->delete();
            UssdNotification::where(['farmer_id'=>$id])->delete();
            FarmerProduct::where(['farmer_id'=>$id])->delete();
            //UssdNotification::where(['id'=>$id])->delete();
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
            $farmer_epa = Farmer::where(['id'=>$val->farmer_id])->first();
            $products[$key]->farmer_epa = $farmer_epa->farmer_epa;
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
    
    // Exporting Farmer details
    public function exportFarmers(){
        return Excel::download(new farmersExport,'farmers.xlsx');
    }    

    // View Farmer Charts
    public function viewFarmerCharts(){

        $current_month_farmers = Farmer::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $last_month_farmers = Farmer::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
        $last_to_last_month_farmers = Farmer::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
       
        
        return view('admin.farmers.view_farmers_charts')->with(compact('current_month_farmers','last_month_farmers','last_to_last_month_farmers'));;
        /*
        
        return view('admin.users.view_users_charts')->with(compact('current_month_users','last_month_users','last_to_last_month_users'));

        */
    }

    // deleting farmer products
    public function deleteFarmerProduct(Request $request, $id = null){

        if(!empty($id)){
            FarmerProduct::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Farmer Product Details Deleted Successfully');
        }
    }

    



}
