<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\SupplierProduct;
use App\Supplier;
use App\District;
use App\EPAs;
use DB;
use App\Exports\farmersExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class SupplierController extends Controller
{
    public function GetSubCatAgainstMainCatEdit($id){
        echo json_encode(DB::table('epas')->where('district_id', $id)->get());
    }
    // Adding Supplier to the system
    public function addSupplier(Request $request){
        $district=District::all();
        if(Session::get('adminDetails')['suppliers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['district_id'])){
                return redirect()->back()->with('flash_message_error','District Name Missing ');    
            }
            if(empty($data['epaname'])){
                $data['epaname'] = "Not Available";    
            }
            
            $supplier = new Supplier;
            $supplier->working_day = $data['working-day'];
    		$supplier->supplier_name  = $data['supplier_name'];
            $supplier->supplier_district = $data['districtname'];
            $supplier->supplier_epa = $data['epaname'];
            $supplier->supplier_phonenumber  = $data['supplier_phonenumber'];
            $supplier->working_hour  = $data['working_hour'];
            $supplier->save();
            return redirect('/admin/view-suppliers')->with('flash_message_success','Supplier Details Added Successfully');
        } 

        
        return view('admin.suppliers.add_supplier')->with(compact('district'));
    }

    // Displaying Supplier in the system
    public function viewSuppliers(){
        if(Session::get('adminDetails')['suppliers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        $menu_active=3;
        $i=0;
        $suppliers = Supplier::orderBy('created_at','desc')->get();


        $suppliers = json_decode(json_encode($suppliers));
        /*
    	foreach($suppliers as $key => $val){
    		$epaname = epas::where(['ep_id'=>$val->supplier_epa])->first();
    		$suppliers[$key]->epaname = $epaname->epaname;
        }
        */
        foreach($suppliers as $key => $val){
    		$districtname = District::where(['id'=>$val->supplier_district])->first();
    		$suppliers[$key]->districtname = $districtname->districtname;
        }

        return view('admin.suppliers.view_suppliers')->with(compact('suppliers','menu_active','i'));
    }

    // Updating Supplier Details in the system
    public function editSupplier(Request $request, $id = null){
        $district=District::all();
        if(Session::get('adminDetails')['suppliers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        $supplierDetails = Supplier::where(['id'=>$id])->first();
        if($request->isMethod('post')){
    		$data = $request->all();
            Supplier::where(['id'=>$id])->update(['supplier_name'=>$data['supplier_name'],
                                                  'working_day' => $data['working-day'],
                                                  'supplier_district' => $data['districtname'],
                                                  'supplier_epa' => $data['epaname'],
                                                  'supplier_phonenumber'  => $data['supplier_phonenumber'],
                                                  'working_hour'  => $data['working_hour']
                                                
    			]);
    		return redirect('/admin/view-suppliers')->with('flash_message_success','Supplier Details Updated Successfully');
        }
        return view('admin.suppliers.edit_supplier')->with(compact('supplierDetails','district'));
    }

    // Deleting Supplier Details in the system
    public function deleteSupplier(Request $request, $id = null){
        if(Session::get('adminDetails')['suppliers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if(!empty($id)){
            Supplier::where(['id'=>$id])->delete();
            SupplierProduct::where(['supplier_id'=>$id])->delete();
    		return redirect()->back()->with('flash_message_success','Supplier Details Deleted Successfully');
    	}
    }
    // Add Supplier Product
    public function addSupplierProduct(Request $request){
        $district=District::all();
		/*
		if(Session::get('adminDetails')['ussd_notifications_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
		}
		*/
    	if($request->isMethod('post')){
    		$data = $request->all();

            if(empty($data['supplier_id'])){
				return redirect()->back()->with('flash_message_error','Supplier Name Is Missing ');    
            }
            if(empty($data['status'])){
                $data['status'] = 0;
            }
            if(empty($data['district_id'])){
                return redirect()->back()->with('flash_message_error','District Name Missing ');    
            }
            if(empty($data['epaname'])){
                $data['epaname'] = "Not Available";    
            }
            
 	   		$product = new SupplierProduct;
            $product->supplier_id = $data['supplier_id'];
            $product->product_district = $data['district_id'];
            $product->product_epa = $data['epaname'];
            $product->supplier_name = $data['supplier_id'];    
 	   		$product->product_name = $data['product_name'];
            $product->selling_price = $data['selling_price'];
            $product->status = $data['amount'];
            $product->status = $data['status'];

			if(!empty($data['description'])){
 	   			$product->description = $data['description'];
 	   		}else{
 	   			$product->description = '';
 	   		}
 	   		$product->save();
 	   		//return redirect()->back()->with('flash_message_success', 'Product has been added successfully');
 	   		return redirect('/admin/view-supplier-products')->with('flash_message_success', 'Supplier Product has been Added successfully');
    	}

    	//Categories drop down start
		$suppliers = Supplier::where(['supplier_parent_id' => 0])->get();
        $suppliers_drop_down = "<option value='' selected disabled>Select</option>";
        $suppliers_drop_list = "<option value='' selected disabled>Select</option>";
       
		foreach($suppliers as $cat){
            $suppliers_drop_down .= "<option value='".$cat->id." ".$cat->supplier_name." '>".$cat->supplier_name."</option>";
			
        }


		

    	return view('admin.suppliers.add_supplier_product')->with(compact('suppliers_drop_down','district'));
    }
    // View Supplier Product
    public function viewSupplierProducts(Request $request){
        $products = SupplierProduct::orderBy('created_at','desc')->get();
        
        foreach($products as $key =>$val){
            $supplier_name = Supplier::where(['id'=>$val->supplier_id])->first();
            $products[$key]->supplier_name = $supplier_name->supplier_name;
        }

        foreach($products as $key =>$val){
            $supplier_epa = Supplier::where(['id'=>$val->supplier_id])->first();
            $products[$key]->supplier_epa = $supplier_epa->supplier_epa;
        }
        $menu_active=3;
        $i=0;
        $suppliers = SupplierProduct::orderBy('created_at','desc')->get();


        return view ('admin.suppliers.view_supplier_products')->with(compact('products','menu_active','i'));
	}
    // edit supplier product
    public function editSupplierProduct(Request $request, $id=null){
        if(Session::get('adminDetails')['suppliers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;
            if(empty($data['description'])){
                $data['description'] = '';
            }

            SupplierProduct::where(['id'=>$id])->update(['supplier_id'=>$data['supplier_id'],'description'=>$data['description'],'product_name'=>$data['product_name'],'selling_price'=>$data['selling_price'], 'status'=>$data['status'], 'amount'=>$data['amount']]);


            return redirect()->back()->with('flash_message_success','Supplier Product Details Have Been Updated Successfully');
        }

        // Get farmer details
        $supplierProductDetails = SupplierProduct::where(['id'=>$id])->first();
        //farmers drop down start
        $suppliers = Supplier::where(['supplier_parent_id'=>0])->get();
        $suppliers_drop_down = "<option value='' selected disabled>Select</option>";
        foreach($suppliers as $sup){
            if($sup->id==$supplierProductDetails->supplier_id){
                $selected = "selected";
            }else{
                $selected = "";
            }   
            $suppliers_drop_down .= "<option value='".$sup->id."' ".$selected.">".$sup->supplier_name."</option>";
        }
        // Farmers drop down end
        return view('admin.suppliers.edit_supplier_product')->with(compact('supplierProductDetails','suppliers_drop_down'));
    }       


    // deleting supplier products
    public function deleteSupplierProduct(Request $request, $id = null){

        if(!empty($id)){
            SupplierProduct::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Supplier Product Details Deleted Successfully');
        }
    }
  
        // View Farmer Charts
        public function viewSupplierCharts(){

            $current_month_suppliers = Supplier::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
            $last_month_suppliers = Supplier::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
            $last_to_last_month_suppliers = Supplier::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
           
            
            return view('admin.suppliers.view_suppliers_charts')->with(compact('current_month_suppliers','last_month_suppliers','last_to_last_month_suppliers'));;
            /*
            
            return view('admin.users.view_users_charts')->with(compact('current_month_users','last_month_users','last_to_last_month_users'));
    
            */
        }
    


}
