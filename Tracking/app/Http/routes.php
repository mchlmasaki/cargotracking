<?php
use App\Shipment;
use Illuminate\Support\Facades\Input;
use App\Http\Middleware\AdminRole;
use App\Http\Middleware\ClientRole;
use App\Http\Middleware\EmployeeRole;

Route::get('/', function () {
    return view('Auth/login');
});

Route::auth();

Route::group(['middleware' => ['admin_role']], function () {

Route::get('Admin/dashboard', 'HomeController@index'); //To take the logged in admin to the dashboard
Route::get('Admin/invoice', 'HomeController@invoice'); //To take you to the invoices
Route::get('Admin/offices', 'HomeController@office'); //To take you to the offices
Route::get('Admin/neworders', 'HomeController@neworders'); //To take you to the new orders page
Route::get('Admin/charges', 'HomeController@charges'); //To take you to the charges page
Route::post('Admin/charges', 'Shipment\IndexController@storeShippingRate');  //To add shipping rates to the db
Route::delete('Admin/charges/delete/','Shipment\IndexController@destroyShippingRate'); //To delete shippingrate
Route::delete('Admin/admins/delete/','User\IndexController@destroyUser'); //To delete Admin
Route::delete('Admin/employees/delete/','User\IndexController@destroyUser'); //To delete Employees
Route::delete('Admin/users/delete/','User\IndexController@destroyUser'); //To delete Clients
Route::get('Admin/admins', 'User\IndexController@admins'); //To retrieve all Admins from the db
Route::post('Admin/admins', 'User\IndexController@storeUser');  //To add Admin to the db
Route::post('Admin/admins/update', 'User\IndexController@updateUser');  //To update Admin to the db
Route::post('Admin/users', 'User\IndexController@storeUser');  //To add the client to the db
Route::post('Admin/users/update', 'User\IndexController@updateUser');  //To add the client to the db
Route::get('Admin/users', 'User\IndexController@users'); //To retrieve all users/customers from the db in Admins page
Route::post('Admin/employees/add', 'User\IndexController@storeUser');  //To add the Employee to the db
Route::post('Admin/employees/update', 'User\IndexController@updateUser');  //To update the Employee to the db
Route::get('Admin/employees', 'User\IndexController@employees'); //To retrieve all the Employees from the db
//Route::post('Admin/employees', 'User\IndexController@employeesoffice'); //get the employees office
Route::get('Admin/containers','Container\IndexController@index'); //To retrieve all the containers from the db
Route::post('Admin/offices', 'User\IndexController@storeOffice');  //To add office to the db
Route::delete('Admin/offices/delete/','User\IndexController@destroyOffice'); //To delete an office from the db
Route::post('Admin/containers','Container\IndexController@store');  //To add the container to the db
Route::post('Admin/containers/update','Container\IndexController@updateContainer');  //To update container status
Route::delete('Admin/containers/delete/','Container\IndexController@destroy'); //To delete a container from the db
Route::get('Admin/edit_profile', 'HomeController@editProfile'); //To take you to the Admin Edit Profile page
Route::post('Admin/edit_profile', 'User\IndexController@editUserProfile');  //To Edit Admin user profile
Route::get('Admin/change_password', 'HomeController@changePassword'); //To take you to the admin Change Password page
Route::post('Admin/change_password', 'User\IndexController@changePassword');  //To Edit Admin passwd
Route::Post('Admin/recommendations', 'RecombeeController@recombee'); //To take recommendations
Route::post('Admin/recommendations/approve','Container\IndexController@updateRecommendedContainer');  //To update container recommendations
Route::get('Admin/success', 'RecombeeController@recommendsuccess'); //To take you to the admin Change Password page
//ADMIN VIEW SHIPMENTS
Route::get('Admin/all_orders', 'HomeController@allorders'); //To take you to all orders page
Route::get('Admin/pending_orders', 'HomeController@pendingorders'); //To take you to the pending orders page
Route::get('Admin/approved_orders', 'HomeController@approved_orders'); //To take you to the approved orders page
Route::get('Admin/intransit_orders', 'HomeController@intransit_orders'); //To take you to the intransit orders page
Route::get('Admin/delivered_orders', 'HomeController@delivered_orders'); //To take you to the delivered orders page
Route::get('Admin/cancelled_orders', 'HomeController@cancelled_orders'); //To take you to the cancelled orders page
Route::get('Admin/shipmentdetails/{shipment}', 'HomeController@shipmentDetails'); //To take you to shipment details page
//ADMIN DELETE SHIPMENTS
Route::delete('Admin/all_orders/delete/','Shipment\IndexController@destroyShipment'); //To delete Shipment
Route::delete('Admin/pending_orders/delete/','Shipment\IndexController@destroyShipment'); //To delete Shipment
Route::delete('Admin/approved_orders/delete/','Shipment\IndexController@destroyShipment'); //To delete Shipment
Route::delete('Admin/intransit_orders/delete/','Shipment\IndexController@destroyShipment'); //To delete Shipment
Route::delete('Admin/delivered_orders/delete/','Shipment\IndexController@destroyShipment'); //To delete Shipment
//ADMIN REPORTS
Route::get('Admin/pending_orders_report', 'ReportsController@pendingorders_report'); 
Route::get('Admin/approved_orders_report', 'ReportsController@approvedorders_report');
Route::get('Admin/intransit_orders_report', 'ReportsController@intransitorders_report');
Route::get('Admin/delivered_orders_report', 'ReportsController@deliveredorders_report');
Route::get('Admin/cancelled_orders_report', 'ReportsController@cancelledorders_report');
Route::get('Admin/clients_report', 'ReportsController@clients_report');
Route::get('Admin/employees_report', 'ReportsController@employees_report');
Route::get('Admin/containers_report', 'ReportsController@containers_report');
Route::get('Admin/offices_report', 'ReportsController@offices_report');
});

Route::group(['middleware' => ['client_role']], function () {
Route::get('Client/dashboard', 'HomeController@clientIndex'); //To take the logged in client to the dashboard 
Route::get('Client/sendpackage', 'HomeController@clientSendPackage'); //To take you to the clients sendpackage page
Route::get('Client/edit_profile', 'HomeController@editProfile'); //To take you to the clients Edit Profile page
Route::get('Client/change_password', 'HomeController@changePassword'); //To take you to the clients Change Password page
Route::get('Client/requests', 'HomeController@clientRequests'); //To take you to the clients Requests page
Route::post('Client/requests', 'Shipment\IndexController@editShipment'); //To Edit clients shipments
Route::post('Client/sendpackage', 'Shipment\IndexController@storeS');  //To add shipment to the db

Route::get('Client/payment/{payment}', 'Shipment\IndexController@showPaymentScreen');

Route::delete('Client/requests/delete','Shipment\IndexController@destroyShipment'); //client To delete his/her shipment 
//Route::delete('shipment/delete/{shipment}','shipment\IndexController@destroy'); //To delete a shipment from the db
Route::get('Client/trackshipment', 'HomeController@trackShipment');  //To track shipment
Route::post('Client/edit_profile', 'User\IndexController@editUserProfile');  //To Edit Clients user profile
Route::get('Client/suggentions_complaints', 'HomeController@suggestionComplaints');  //To Edit Clients user profile
Route::post('Client/change_password', 'User\IndexController@changePassword');  //To Edit Clients user profile
Route::get('Client/shipmentdetails/{shipment}', 'HomeController@shipmentDetails'); //To take you to the clients Requests page
// Route::post('Client/shipmentdetails/{shipment}', 'Shipment\IndexController@cancelShipment'); //To cancel shipment orders
Route::post('Client/requests/cancel', 'Shipment\IndexController@clientcancelShipment'); //To cancel shipment orders

Route::post ( 'Client/trackshipment', function () {
	$q = Input::get ( 'q' );
	if($q != ""){
		$user = Shipment::where ( 'cons_no', 'LIKE', '%' . $q . '%' )->get ();
	  //$query = User::leftjoin('student', 'users.id', '=', 'student.user_id')->where('users.name', 'LIKE', '%' . $keywords . '%');
		//->orWhere ( 'email', 'LIKE', '%' . $q . '%' )->get ();
		if (count ( $user ) > 0)
			return view ( 'Client/trackshipment' )->withDetails ( $user )->withQuery ( $q );
		else
			return view ( 'Client/trackshipment' )->withMessage ( 'No Details found. Try to search again !' );
	}
	return view ( 'Client/trackshipment' )->withMessage ( 'No Details found. Try to search again !' );
} );

});



Route::group(['middleware' => ['employee_role']], function () {
Route::get('Employee/dashboard', 'HomeController@employeeIndex'); //To take the logged in employee to the dashboard
Route::post('Employee/users', 'User\IndexController@storeUser');  //To add the Customer/client to the db
Route::post('Employee/users/update', 'User\IndexController@updateUser');  //To add the Customer/client to the db
Route::delete('Employee/users/delete/','User\IndexController@destroyUser'); //To delete Clients
Route::get('Employee/users', 'User\IndexController@users'); //To retrieve all users/customers from the db in Employees Page
Route::get('Employee/containers','Container\IndexController@index'); //To retrieve all the containers from the db
Route::delete('Employee/containers/delete/','Container\IndexController@destroy'); //To delete a container from the db
Route::post('Employee/containers/update','Container\IndexController@updateContainer');  //To update container status
Route::get('Employee/shipmentdetails/{shipment}', 'HomeController@shipmentDetails'); //To take you to shipment details page
Route::get('Employee/manage_shipment/{shipment}', 'HomeController@manage_shipment'); //To take you to the manage shipment page
Route::post('Employee/shipmentdetails/{shipment}', 'Shipment\IndexController@cancelShipment'); //To cancel shipment orders
Route::post('Employee/manage_shipment/cost/{weight}', 'Shipment\IndexController@calculateShipmentCost'); //To calculate cost of shipment
Route::post('Employee/manage_shipment/{shipment}', 'Shipment\IndexController@approveShipment'); //To approve shipment orders
Route::get('Employee/all_orders', 'HomeController@allorders'); //To take you to the all orders page
Route::get('Employee/pending_orders', 'HomeController@pendingorders'); //To take you to the pending orders page
Route::get('Employee/approved_orders', 'HomeController@approved_orders'); //To take you to the approved orders page
Route::get('Employee/intransit_orders', 'HomeController@intransit_orders'); //To take you to the intransit orders page
Route::get('Employee/delivered_orders', 'HomeController@delivered_orders'); //To take you to the delivered orders page
Route::get('Employee/cancelled_orders', 'HomeController@cancelled_orders'); //To take you to the cancelled orders page
Route::post('Employee/pendingorders','Shipment\IndexController@updateShipment');  //To Update Shipment orders
Route::post('Employee/approved_orders','Shipment\IndexController@updateApprovedShipment');  //To Update Shipment orders
Route::post('Employee/intransit_orders','Shipment\IndexController@updateInTransitShipment');  //To Update Shipment orders
Route::post('Employee/delivered_orders','Shipment\IndexController@updateDeliveredShipment');  //To Update Shipment orders
//Route::post('Employee/completed_orders','Shipment\IndexController@updateShipment');  //To Edit Shipment orders
Route::delete('Employee/all_orders/delete/','Shipment\IndexController@destroyShipment'); //To delete Shipment
Route::delete('Employee/pending_orders/delete/','Shipment\IndexController@destroyShipment'); //To delete Shipment
Route::delete('Employee/approved_orders/delete/','Shipment\IndexController@destroyShipment'); //To delete Shipment
Route::delete('Employee/intransit_orders/delete/','Shipment\IndexController@destroyShipment'); //To delete Shipment
Route::delete('Employee/delivered_orders/delete/','Shipment\IndexController@destroyShipment'); //To delete Shipment
//Route::delete('Employee/completed_orders/delete/','Shipment\IndexController@destroyShipment'); //To delete Shipment
Route::delete('Employee/cancelled_orders/delete/','Shipment\IndexController@destroyShipment'); //To delete Shipment
Route::get('Employee/shipments_in_container/{container_number}', 'HomeController@shipments_in_container'); //To shipments in container
Route::get('Employee/edit_profile', 'HomeController@editProfile'); //To take you to the employee Edit Profile page
Route::post('Employee/edit_profile', 'User\IndexController@editUserProfile');  //To Edit employee user profile
Route::get('Employee/change_password', 'HomeController@changePassword'); //To take you to the employee Change Password page
Route::post('Employee/change_password', 'User\IndexController@changePassword');  //To Edit employee user profile
Route::get('Employee/trackshipment', 'HomeController@trackShipment');  //To track shipment

Route::post ( 'Employee/trackshipment', function () {
	$q = Input::get ( 'q' );
	if($q != ""){
		$user = Shipment::where ( 'cons_no', 'LIKE', '%' . $q . '%' )->get ();
		if (count ( $user ) > 0)
			return view ( 'Employee/trackshipment' )->withDetails ( $user )->withQuery ( $q );
		else
			return view ( 'Employee/trackshipment' )->withMessage ( 'No Details found. Try to search again !' );
	}
	return view ( 'Employee/trackshipment' )->withMessage ( 'No Details found. Try to search again !' );
} );


//EMPLOYEE REPORTS
Route::get('Employee/pending_orders_report', 'ReportsController@pendingorders_report'); 
Route::get('Employee/approved_orders_report', 'ReportsController@approvedorders_report');
Route::get('Employee/intransit_orders_report', 'ReportsController@intransitorders_report');
Route::get('Employee/delivered_orders_report', 'ReportsController@deliveredorders_report');
Route::get('Employee/cancelled_orders_report', 'ReportsController@cancelledorders_report');
Route::get('Employee/clients_report', 'ReportsController@clients_report');
Route::get('Employee/containers_report', 'ReportsController@containers_report');
Route::get('Employee/offices_report', 'ReportsController@offices_report');

Route::get('Employee/gmaps', 'HomeController@gmaps'); //To take you to the gmaps page
});



Route::get('404',['as'=>'404','uses'=>'ErrorHandlerController@errorCode404']); //404 error page
Route::get('403','ErrorController@error403'); 

//Sending Emails
Route::get('sendhtmlemail','MailController@html_email');

Route::get('auth-user','HomeController@checkRole');
Route::get('success','HomeController@regsuccess');
Route::get('verify','HomeController@verify');

// Password reset link request routes
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
// Password reset routes
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


Route::post('payment/initialize', 'PaymentController@initPayment');
Route::post('payment/callback/{method}', 'PaymentController@handleCallback');
// Route::post('/')