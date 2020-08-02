<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\SupplierProduct;
use App\Supplier;

class SupplierController extends Controller
{
    // Adding Supplier to the system
    public function addSupplier(Request $request){
        if(Session::get('adminDetails')['suppliers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if($request->isMethod('post')){
            $data = $request->all();
            $supplier = new Supplier;
            $supplier->working_day = $data['working-day'];
    		$supplier->supplier_name  = $data['supplier_name'];
            $supplier->supplier_location  = $data['supplier_location'];
            $supplier->supplier_phonenumber  = $data['supplier_phonenumber'];
            $supplier->working_hour  = $data['working_hour'];
            $supplier->save();
            return redirect('/admin/view-suppliers')->with('flash_message_success','Supplier Details Added Successfully');

        } 
        return view('admin.suppliers.add_supplier');
    }

    // Displaying Supplier in the system
    public function viewSuppliers(){
        if(Session::get('adminDetails')['suppliers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        $menu_active=3;
        $i=0;
        $suppliers = Supplier::orderBy('created_at','desc')->get();
        return view('admin.suppliers.view_suppliers')->with(compact('suppliers','menu_active','i'));
    }

    // Updating Supplier Details in the system
    public function editSupplier(Request $request, $id = null){
        if(Session::get('adminDetails')['suppliers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        $supplierDetails = Supplier::where(['id'=>$id])->first();
        if($request->isMethod('post')){
    		$data = $request->all();
            Supplier::where(['id'=>$id])->update(['supplier_name'=>$data['supplier_name'],
                                                  'supplier_location'=>$data['supplier_location']
    			]);
    		return redirect('/admin/view-suppliers')->with('flash_message_success','Supplier Details Updated Successfully');
        }
        return view('admin.suppliers.edit_supplier')->with(compact('supplierDetails'));
    }

    // Deleting Supplier Details in the system
    public function deleteSupplier(Request $request, $id = null){
        if(Session::get('adminDetails')['suppliers_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if(!empty($id)){
    		Supplier::where(['id'=>$id])->delete();
    		return redirect()->back()->with('flash_message_success','Supplier Details Deleted Successfully');
    	}
    }
    // Add Supplier Product
    public function addSupplierProduct(Request $request){
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
 	   		$product = new SupplierProduct;
 	   		$product->supplier_id = $data['supplier_id'];
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
		foreach($suppliers as $cat){
			$suppliers_drop_down .= "<option value='".$cat->id."'>".$cat->supplier_name."</option>";
			
		}
    	// Categories drop down end

    	return view('admin.suppliers.add_supplier_product')->with(compact('suppliers_drop_down'));
    }
    // View Supplier Product
    public function viewSupplierProducts(Request $request){
		$products = SupplierProduct::get();
        foreach($products as $key =>$val){
            $supplier_name = Supplier::where(['id'=>$val->supplier_id])->first();
            $products[$key]->supplier_name = $supplier_name->supplier_name;
        }
        foreach($products as $key =>$val){
            $supplier_location = Supplier::where(['id'=>$val->supplier_id])->first();
            $products[$key]->supplier_location = $supplier_location->supplier_location;
		}
        return view ('admin.suppliers.view_supplier_products')->with(compact('products'));
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
  


}
