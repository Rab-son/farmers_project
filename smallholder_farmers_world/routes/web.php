<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Orders;
use App\Farmer;
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::match(['get','post'], '/admin','AdminController@login');// Route for admin login
Route::match(['get','post'],'/admin/admin-register','AdminController@adminRegister');// Route for admin registration
Route::get('/admin/adminLogin-register','AdminController@adminLoginRegister');// Route for admin login registration
Route::get('/logout','AdminController@logout');// Route for admin logout

//Securing dashboard routes using middleware
Route::group(['middleware' => ['adminlogin']], function(){
    // Adminstrator Management
    Route::get('/admin/dashboard','AdminController@dashboard');// Route for admin dashboard
    Route::get('/admin/settings','AdminController@settings');// Route for settings
    Route::get('/admin/check-pwd', 'AdminController@chckPassword');// Route for checking password
    Route::match(['get','post'], '/admin/update-pwd', 'AdminController@updatePassword');// Route for updating password
    Route::get('/admin/view-admins','AdminController@viewAdmins');// Route for viewing admins
    Route::match(['get','post'], '/admin/add-admin', 'AdminController@addAdmin');// Route for adding an adminstrator
    Route::match(['get','post'], '/admin/edit-admin/{id}', 'AdminController@editAdmin');// Route for editing an adminstrator
    Route::match(['get','post'], '/admin/approve-admin/{id}', 'AdminController@approveAdmin');// Route for approving an adminstrator
    Route::match(['get', 'post'], '/admin/delete-admin/{id}', 'AdminController@deleteAdmin');//Route for deleting farmer details
    
    // SMSes Management
    Route::get('/admin/show-phonenumber', 'SmsesController@show');
    Route::post('/admin/store-phonenumber', 'SmsesController@storePhoneNumber');
    Route::post('/admin/custom', 'SmsesController@sendCustomMessage');

    // Farmers Management
    Route::match(['get','post'], '/admin/add-farmer', 'FarmerController@addFarmer');// Route for adding a farmer
    Route::match(['get', 'post'], '/admin/edit-farmer/{id}', 'FarmerController@editFarmer');// Route for editing farmer details
    Route::match(['get', 'post'], '/admin/delete-farmer/{id}', 'FarmerController@deleteFarmer');//Route for deleting farmer details
    Route::match(['get','post'],'/admin/add-yield','FarmerController@addFarmerProduct');// Route for adding product details
    Route::match(['get', 'post'], '/admin/edit-farmer-produce/{id}', 'FarmerController@editFarmerProduce');// Route for editing farmer produce details
    Route::match(['get', 'post'], '/admin/delete-farmer-product/{id}', 'FarmerController@deleteFarmerProduct');//Route for deleting farmer produce details 
    Route::get('/admin/check-idnumber', 'FarmerController@checkIdnumber');// Route for checking password
    Route::get('/admin/view-farmers','FarmerController@viewFarmers');// Route for viewing farmer details
    Route::get('/admin/export-farmers','FarmerController@exportFarmers');// Route for exporting farmer details
    Route::get('/admin/view-farmer-products','FarmerController@viewFarmerProducts');// Route for viewing product details
    Route::get('/admin/view-report-farmer','FarmerController@viewFarmerCharts');// Route for viewing farmer charts details




    // Market Management
    Route::match(['get','post'], '/admin/add-market', 'MarketController@addMarket');// Route for adding a market
    Route::match(['get', 'post'], '/admin/edit-market/{id}', 'MarketController@editMarket');// Route for editing market details
    Route::match(['get', 'post'], '/admin/delete-market/{id}', 'MarketController@deleteMarket');//Route for deleting market details
    Route::match(['get', 'post'], '/admin/delete-market-product/{id}', 'MarketController@deleteMarketProduct');//Route for deleting market product details
    Route::match(['get', 'post'], '/admin/edit-market-product/{id}', 'MarketController@editMarketProduct');// Route for editing farmer 
    Route::match(['get','post'],'/admin/add-items','MarketController@addMarketProduct');// Route for adding product details
    Route::get('/admin/view-markets','MarketController@viewMarkets');// Route for viewing market details
    Route::get('/admin/view-market-products','MarketController@viewMarketProducts');// Route for viewing product details
    Route::get('/admin/export-markets','MarketController@exportMarkets');// Route for exporting farmer details
    Route::get('/admin/view-report-market','MarketController@viewMarketCharts');// Route for viewing market charts details


    //Calculations
    Route::get('/admin/view-calculations','CalculatorController@viewMaizeCalculator');// Route for calculating market details  

    //Chat Room
    Route::get('/admin/view-chats','ChatController@viewChats');// Route for calculating market details 

    // Supplier Management
    Route::match(['get','post'], '/admin/add-supplier', 'SupplierController@addSupplier');// Route for adding a supplier
    Route::match(['get', 'post'], '/admin/edit-supplier/{id}', 'SupplierController@editSupplier');// Route for editing supplier details
    Route::match(['get', 'post'], '/admin/delete-supplier/{id}', 'SupplierController@deleteSupplier');//Route for deleting supplier details

    Route::match(['get', 'post'], '/admin/edit-supplier-product/{id}', 'SupplierController@editSupplierProduct');// Route for editing supplier productt details
    Route::match(['get','post'],'/admin/add-product','SupplierController@addSupplierProduct');// Route for add product details
    Route::match(['get', 'post'], '/admin/delete-supplier-product/{id}', 'SupplierController@deleteSupplierProduct');//Route for deleting supplier product 
    Route::get('/admin/view-supplier-products','SupplierController@viewSupplierProducts');// Route for viewing product details
    Route::get('/admin/view-suppliers','SupplierController@viewSuppliers');// Route for viewing supplier details
    Route::get('/admin/view-report-supplier','SupplierController@viewSupplierCharts');// Route for viewing farmer charts details

    
    // Advisor Management
    Route::match(['get','post'], '/admin/add-advisor', 'AdvisorController@addAdvisor');// Route for adding a advisor
    Route::match(['get', 'post'], '/admin/edit-advisor/{id}', 'AdvisorController@editAdvisor');// Route for editing advisor details
    Route::match(['get', 'post'], '/admin/delete-advisor/{id}', 'AdvisorController@deleteAdvisor');//Route for deleting advisor details
    Route::get('/admin/view-advisors','AdvisorController@viewAdvisors');// Route for viewing advisorr details
    Route::get('/admin/view-report-advisor','AdvisorController@viewAdvisorCharts');// Route for viewing farmer charts details
    

    // SMS Portal
    Route::match(['get','post'], '/admin/send-notification', 'UssdNotificationController@sendNotification');// Route for adding a advisor
    Route::match(['get', 'post'], '/admin/edit-notification/{id}', 'UssdNotificationController@editNotification');// Route for editing advisor details
    Route::match(['get', 'post'], '/admin/delete-notification/{id}', 'UssdNotificationController@deleteNotification');//Route for deleting advisor details
    Route::get('/admin/view-notifications','UssdNotificationController@viewNotifications');// Route for viewing advisorr details

    // Enquiries
    Route::get('/admin/view-enquiries','CmsController@viewEnquiries');// Route to display enquiries
    Route::get('/admin/get-enquiries','CmsController@getEnquiries');// Get Enquiries

    Route::get('/', 'AdminController@login'); 


});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
