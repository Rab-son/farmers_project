<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use App\Market;
use App\MarketProduct;
use App\District;
use App\EPAs;
use DB;
use App\Exports\marketsExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class MarketController extends Controller
{

    public function GetSubCatAgainstMainCatEdit($id){
        echo json_encode(DB::table('epas')->where('id', $id)->get());
    }

    // Adding Market To The System
    public function addMarket(Request $request){
        $district=District::all();//get data from table
        
        if(Session::get('adminDetails')['markets_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if($request->isMethod('post')){
    		$data = $request->all();
    		$market = new Market;
            $market->mark_name  = $data['mark_name'];
            $market->market_district = $data['district_id'];
            $market->market_epa = $data['epaname'];
            $market->save();
            return redirect('/admin/view-markets')->with('flash_message_success','Market Details Added Successfully');
        } 

            	//Categories drop down start
		$markets = Market::where(['market_parent_id' => 0])->get();

        return view('admin.markets.add_market')->with(compact('markets_drop_down','district'));
        
    }
	// markets product
    public function addMarketProduct(Request $request){
        $district=District::all();//get data from table
		/*
		if(Session::get('adminDetails')['ussd_notifications_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
		}
		*/
    	if($request->isMethod('post')){
    		$data = $request->all();

            if(empty($data['market_id'])){
				return redirect()->back()->with('flash_message_error','Market Name Is Missing ');    
            }

            if(empty($data['status'])){
                $data['status'] = 0;
            }
 	   		$product = new MarketProduct;
            $product->market_id = $data['market_id'];
            //$product->mark_location = $data['mark_location'];
            $product->product_district = $data['district_id'];
            $product->product_epa = $data['epaname'];
            $product->mark_name = $data['market_id'];
            $product->product_name = $data['product_name']; 
 	   		$product->selling_price = $data['selling_price'];
            $product->amount = $data['amount'];
            $product->buying_price = $data['buying_price'];
            $product->status = $data['status'];

			if(!empty($data['description'])){
 	   			$product->description = $data['description'];
 	   		}else{
 	   			$product->description = '';
 	   		}
 	   		$product->save();
 	   		//return redirect()->back()->with('flash_message_success', 'Market Product has been added successfully');
 	   		return redirect('/admin/view-market-products')->with('flash_message_success', 'Market Product has been Added successfully');
    	}

    	//Categories drop down start
		$markets = Market::where(['market_parent_id' => 0])->get();

        $markets_drop_down = "<option value='' selected disabled>Select</option>";
        $markets_drop_list = "<option value='' selected disabled>Select</option>";
		foreach($markets as $cat){
			$markets_drop_down .= "<option value='".$cat->mark_id." ".$cat->mark_name."'>".$cat->mark_name."</option>";
			
        }
       // $markets_drop_down .= "<option value='".$cat->mark_id." ".$cat->mark_name."'>".$cat->mark_name."</option>";
			

    	return view('admin.markets.add_market_product')->with(compact('markets_drop_down','district'));
    }
    
    // Exporting Market details
    public function exportMarkets(){
        return Excel::download(new marketsExport,'markets.xlsx');
    }   

    // Displaying Markets in the system
    public function viewMarkets(){
        if(Session::get('adminDetails')['markets_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        $menu_active=3;
        $i=0;
        $markets = Market::orderBy('created_at','desc')->get();
        
        $markets = json_decode(json_encode($markets));
        /*
    	foreach($markets as $key => $val){
    		$epaname = epas::where(['ep_id'=>$val->market_epa])->first();
    		$markets[$key]->epaname = $epaname->epaname;
        }*/

        foreach($markets as $key => $val){
    		$districtname = District::where(['id'=>$val->market_district])->first();
    		$markets[$key]->districtname = $districtname->districtname;
        }

        

        return view('admin.markets.view_markets')->with(compact('markets','menu_active','i'));
    }

    // Updating Market Details in the system
    public function editMarket(Request $request, $mark_id = null){
        if(Session::get('adminDetails')['markets_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        $marketDetails = Market::where(['mark_id'=>$mark_id])->first();
        if($request->isMethod('post')){
    		$data = $request->all();
            Market::where(['mark_id'=>$mark_id])->update(['mark_name'=>$data['mark_name'],
                                                'mark_location'=>$data['mark_location']
    			]);
    		return redirect('/admin/view-markets')->with('flash_message_success','Market Details Updated Successfully');
        }
        return view('admin.markets.edit_market')->with(compact('marketDetails'));
    }

    // Deleting Market Details in the system
    public function deleteMarket(Request $request, $mark_id = null){
        if(Session::get('adminDetails')['markets_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
    	if(!empty($mark_id)){
            Market::where(['mark_id'=>$mark_id])->delete();
            MarketProduct::where(['market_id'=>$mark_id])->delete();
    		return redirect()->back()->with('flash_message_success','Market Details Deleted Successfully');
    	}
    }
	// view markets products
    public function viewMarketProducts(Request $request){
        $products = MarketProduct::orderBy('created_at','desc')->get();
        //$products = json_decode(json_encode('$products'));
        /*
        foreach($products as $key =>$val){
            $mark_name = Market::where(['mark_id'=>$val->market_id])->first();
            $products[$key]->mark_name = $mark_name->mark_name;
        }
        */
        /*
        $products = json_decode(json_encode($products));
    	foreach($products as $key => $val){
    		$epaname = epas::where(['ep_id'=>$val->product_epa])->first();
    		$products[$key]->epaname = $epaname->epaname;
        }
        */
		foreach($products as $key =>$val){
            $mark_name = Market::where(['mark_id'=>$val->market_id])->first();
            $products[$key]->mark_name = $mark_name->mark_name;
        }
        foreach($products as $key =>$val){
            $market_epa = Market::where(['mark_id'=>$val->market_id])->first();
            $products[$key]->market_epa = $market_epa->market_epa;
        }
        

        foreach($products as $key => $val){
    		$districtname = District::where(['id'=>$val->product_district])->first();
    		$products[$key]->districtname = $districtname->districtname;
        }

        $menu_active=3;
        $i=0;
        //$markets = MarketProduct::orderBy('created_at','desc')->get();
        //echo "<pre>"; print_r($products);die;
        return view ('admin.markets.view_market_products')->with(compact('products','menu_active','i'));
    }
    // edit market product
    public function editMarketProduct(Request $request, $id=null){
        if(Session::get('adminDetails')['markets_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;
            if(empty($data['description'])){
                $data['description'] = '';
            }

            MarketProduct::where(['id'=>$id])->update(['market_id'=>$data['market_id'],'description'=>$data['description'],'product_name'=>$data['product_name'],'buying_price'=>$data['buying_price'],'selling_price'=>$data['selling_price'], 'status'=>$data['status'], 'amount'=>$data['amount']]);


            return redirect()->back()->with('flash_message_success','Market Product Details Have Been Updated Successfully');
        }

        // Get farmer details
        $marketProductDetails = MarketProduct::where(['id'=>$id])->first();
        //farmers drop down start
        $markets = Market::where(['market_parent_id'=>0])->get();
        $markets_drop_down = "<option value='' selected disabled>Select</option>";
        foreach($markets as $mar){
            if($mar->mark_id==$marketProductDetails->market_id){
                $selected = "selected";
            }else{
                $selected = "";
            }   
            $markets_drop_down .= "<option value='".$mar->mark_id."' ".$selected.">".$mar->mark_name."</option>";
        }
        // Farmers drop down end
        return view('admin.markets.edit_market_product')->with(compact('marketProductDetails','markets_drop_down'));
    }       

    // deleting market products
    public function deleteMarketProduct(Request $request, $id = null){

    	if(!empty($id)){
    		MarketProduct::where(['id'=>$id])->delete();
    		return redirect()->back()->with('flash_message_success','Market Product Details Deleted Successfully');
    	}
    }

        // View Market Charts
        public function viewMarketCharts(){

            $current_month_markets = Market::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
            $last_month_markets = Market::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->count();
            $last_to_last_month_markets = Market::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->count();
           
            
            return view('admin.markets.view_markets_charts')->with(compact('current_month_markets','last_month_markets','last_to_last_month_markets'));;
            /*
            
            return view('admin.users.view_users_charts')->with(compact('current_month_users','last_month_users','last_to_last_month_users'));
    
            */
        }
    /*
    // edit farmer notificatio
    public function editMarketProduct(Request $request, $id=null){
        if(Session::get('adminDetails')['ussd_notifications_access']==0){
            return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<prev>"; print_r($data); die;
            if(empty($data['description'])){
                $data['description'] = '';
            }

            MarketProduct::where(['id'=>$id])->update(['market_id'=>$data['market_id'],'description'=>$data['description'],'produce_name'=>$data['produce_name'],'buying_price'=>$data['buying_price'],'selling_price'=>$data['selling_price'],'amount'=>$data['amount']]);


            return redirect()->back()->with('flash_message_success','Market Product Details Have Been Updated Successfully');
        }

        // Get farmer details
        $supplierProductDetails = MarketProduct::where(['id'=>$id])->first();
        //farmers drop down start
        $suppliers = Supplier::where(['parent_id'=>0])->get();
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
        return view('admin.suppliers.edit_supplier_produce')->with(compact('supplierProductDetails','suppliers_drop_down'));
    }    

    */



}
