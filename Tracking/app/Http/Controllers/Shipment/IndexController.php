<?php

namespace App\Http\Controllers\Shipment;

use App\Payment;
use App\Uuid;
use Illuminate\Http\Request;

use Recombee\RecommApi\Client;
use Recombee\RecommApi\Requests as Reqs;
use Recombee\RecommApi\Exceptions as Ex;

use AfricasTalkingGateway\AfricasTalkingGateway;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Shipment;
use App\Container;
use App\Transit;
use App\Shippingrate;
use App\Town;
use App\Keyword;
use Auth;

class IndexController extends Controller
{
    
        //FUNCTION TO ADD SHIPMENT TO THE DB
        public function storeS(Request $request)
        {
        /**
        * validate the input fields
        **/
        $client = new Client('allan-kiptalam', '2j3zzpeORWnJjt9AfnIwehkhAWVk9Daqiq8wFvA35pbMgJNv0xRjmwHZXSIqKRjb');

        $this->validate($request,[
            'sender_name'=>'required|max:255',
            'sender_contact'=>'required|numeric|regex:/^\+(254)[0-9]{9}/|digits:13',
            'sender_email'=>'required',
            'from_location'=>'required|max:255',
            'town'=>'required',
            'sender_address'=>'required|max:255',
            'receiver_name'=>'required|max:255',
            'receiver_contact'=>'required|numeric|regex:/^\+(254)[0-9]{9}/|digits:13',
            'to_location'=>'required|max:255',
            'receiver_address'=>'required|max:255',
            'type_ofshipment'=>'required|max:255',
            'product_name'=>'required|max:255',
            'qty'=>'required|numeric|max:255',
            'weight'=>'required|numeric|max:255',
            'description'=>'required|max:100',
            'mode'=>'required|max:255',
            'cons_no'=>'required|unique:shipments,cons_no,'.$request->id,
            'status'=>'required|max:255',
            ]);
//dd($request);
// //To get the latitude and longitude of the From location
  $address =$request->from_location; // Google HQ
  $prepAddr = str_replace(' ','+',$address);
  $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
  $output= json_decode($geocode);
  $status = $output->status;
  //dd($status);
    if($status == "OK")
  {
    $latitude = $output->results[0]->geometry->location->lat;
    $longitude = $output->results[0]->geometry->location->lng;
   // echo "From latitude: ".$latitude;
   // echo "From longitude: ".$longitude;
  }else{
  //echo "No Data Found for From location";
    //Default lat and lng
      $latitude='-1.2920659';
      $longitude='36.8219462';
  }



//To get the latitude and longitude of the To location
  $To_address =$request->to_location; // Google HQ
  $To_prepAddr = str_replace(' ','+',$To_address);
  $To_geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$To_prepAddr.'&sensor=false');
  $To_output= json_decode($To_geocode);
  $To_status = $To_output->status;

  
  if($To_status == "OK")
  {
    $to_latitude = $To_output->results[0]->geometry->location->lat;
    $to_longitude = $To_output->results[0]->geometry->location->lng;
   // echo "To latitude: ".$to_latitude;
   // echo "To longitude: ".$to_longitude;
  }else{
  //echo "No Data Found for To Location";
    //Default lat and lng
     $to_latitude='-1.2920659';
     $to_longitude='36.8219462';
  }
                
  // dd($request);
//dd($longitude);
        //echo "string";
        $user = Auth::user();
        $shipment = new Shipment();
        $shipment= $user->shipments() ->updateOrCreate(['id'=>$request->id],[
            'sender_name'=>$request->sender_name,
            'sender_contact'=>$request->sender_contact,
            'sender_email'=>$request->sender_email,
            'from_location'=>$request->from_location,
            'nearest_town'=>$request->town,
            'from_lat'=>$latitude,
            'from_lng'=>$longitude,
            'sender_address'=>$request->sender_address,
            'receiver_name'=>$request->receiver_name,
            'receiver_contact'=>$request->receiver_contact,
            'to_location'=>$request->to_location,
            'to_lat'=>$to_latitude,
            'to_lng'=>$to_longitude,
            'receiver_address'=>$request->receiver_address,
            'type_ofshipment'=>$request->type_ofshipment,
            'product_name'=>$request->product_name,
            'qty'=>$request->qty,
            'weight'=>$request->weight,
            'description'=>$request->description,
            'mode'=>$request->mode,
            'cons_no'=>$request->cons_no,
            'status'=>$request->status
            ]);
            $uuid = Uuid::generate()->string;
        $payment_data = [
            'shipment_id' => $shipment->id,
            'user_id' => $user->id,
            'ref_number' => $request->cons_no,
            'amount' => $this->getPrice($shipment),
            'phone' => str_replace('+', '', $request->sender_contact)
        ];
        
        $payment = Payment::create($payment_data);
        //dd($shipment->id);
        
//Recombee
        try
        {
// Add properties of items
// $client->send(new Reqs\AddUserProperty('from_location', 'string'));
// $client->send(new Reqs\AddUserProperty('nearest_town', 'string'));
# Prepare requests
//getting the user id
 $selectuserid = Town::select('id')->where('town', '=', $request->town)->first();      
$user_id=$selectuserid->id;

$client->send(new Reqs\SetUserValues($user_id,
    [
    'from_location'=>$request->from_location,
    'nearest_town'=>$request->town],
 [ //optional parameters:
  'cascadeCreate' => true
]));




            
// Generate some random purchases of items by users
         

// // $client->send(new Reqs\ResetDatabase()); //Clear everything from the database
// // Add properties of items
// $client->send(new Reqs\AddUserProperty('from_location', 'string'));
// $client->send(new Reqs\AddUserProperty('nearest_town', 'string'));
// # Prepare requests  
// $requests = array();

// $shipments = Shipment::orderBy('id')->paginate(10);
// $containers = Container::orderBy('id')->paginate(10);



// //dd($user_id);
// foreach($shipments as $shipment)
//     foreach($containers as $container)
//         { 
//             $userId = $selectuserid->id;
//             $r = new Reqs\SetUserValues(
//       $userId,
//       //values:
//       [ 
//             'from_location'=>$shipment->from_location,
//             'nearest_town'=>$shipment->nearest_town
//       ],
//       //optional parameters:
//       ['cascadeCreate' => true] // Use cascadeCreate for creating item
//                                  // with given itemId, if it doesn't exist]
//     );

//            array_push($requests, $r);
//         }

//     // Send purchases to the recommender system
//     $res = $client->send(new Reqs\Batch($requests));  //Use Batch for faster processing of larger data
}
catch(Ex\ApiTimeoutException $e)
{
    //Handle timeout => use fallback
//     $myerror= 'Client did not get response within #3000 ms'; 
flash(' Your shipment request with consignment number,&nbsp;'.$request->cons_no.'&nbsp; has been received successfully!')->info();
//dd($payment->id);
return redirect()->to("Client/payment/$payment->id");
    //echo '1'; dd($e);
}
catch(Ex\ResponseException $e)
{
    //Handle errorneous request => use fallback
   flash(' Your shipment request with consignment number,&nbsp;'.$request->cons_no.'&nbsp; has been received successfully!')->info();
//    dd($payment->id);
    return redirect()->to("Client/payment/$payment->id");
    //echo '2'; 
    //dd($e);
}
catch(Ex\ApiException $e)
{
    //ApiException is parent of both ResponseException and ApiTimeoutException
    flash(' Your shipment request with consignment number,&nbsp;'.$request->cons_no.'&nbsp; has been received successfully!')->info();
//    dd($payment->id);
    return redirect()->to("Client/payment/$payment->id");
    //echo '3'; dd($e);
}

        if($shipment){
            flash(' Your shipment request with consignment number,&nbsp;'.$request->cons_no.'&nbsp; has been received successfully!')->info();
//            dd($payment->id);
            return redirect()->to("Client/payment/$payment->id");
        }else{
           flash('Error Adding shipment!')->error();
           return redirect()->back(); 
        //return back()->withInput(); 
        }
    }
     //END OF FUNCTION TO ADD SHIPMENT TO THE DB
    //FUNCTION TO EDIT SHIPMENT TO THE DB
        public function editShipment(Request $request)
    {
        /**
        * validate the input fields
        **/
         //dd( $request );

        $this->validate($request,[
            'sender_name'=>'required|max:255',
            'sender_contact'=>'required|numeric|regex:/^\+(254)[0-9]{9}/|digits:13',
            'from_location'=>'required|max:255',
            'sender_address'=>'required|max:255',
            'receiver_name'=>'required|max:255',
            'receiver_contact'=>'required|numeric|regex:/^\+(254)[0-9]{9}/digits:13',
            'to_location'=>'required|max:255',
            'receiver_address'=>'required|max:255',
            'type_ofshipment'=>'required|max:255',
            'product_name'=>'required|max:255',
            'qty'=>'required|numeric|max:255',
            'weight'=>'required|numeric|max:255',
            'description'=>'required|max:100',
            'mode'=>'required|max:255',
            ]);
        

        $user = Auth::user();
        $shipment = new Shipment();
        $shipment ->updateOrCreate(['id'=>$request->id],[
            'sender_name'=>$request->sender_name,
            'sender_contact'=>$request->sender_contact,
            'from_location'=>$request->from_location,
            'sender_address'=>$request->sender_address,
            'receiver_name'=>$request->receiver_name,
            'receiver_contact'=>$request->receiver_contact,
            'to_location'=>$request->to_location,
            'receiver_address'=>$request->receiver_address,
            'type_ofshipment'=>$request->type_ofshipment,
            'product_name'=>$request->product_name,
            'qty'=>$request->qty,
            'weight'=>$request->weight,
            'description'=>$request->description,
            'mode'=>$request->mode
            ]);
        if($shipment){
            flash('Shipment updated successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error updating shipment!')->error();
           return redirect()->back(); 
        //return back()->withInput(); 
        }
    }
     //END OF FUNCTION TO UPDATE SHIPMENT TO THE DB

    //FUNCTION TO UPDATE SHIPMENT 
        public function calculateShipmentCost(Request $request)
    {
        
        /**
        * validate the input fields
        **/
        
        //dd($request);
         $user = Auth::user();
         
         $shippingrates = Shippingrate::select('rate')->where('weight_from', '<=', $request->weight)
         ->where('weight_to','>', $request->weight)->first();
         if ($shippingrates === null) {
           echo "No rates";
            
        }else{
        //dd($request);
        //dd($shippingrates->rate);
        $shipment = new Shipment();
        $shipment ->updateOrCreate(['id'=>$request->id],[
            'shipping_rate'=>$shippingrates->rate,
            'shipping_cost'=>$shippingrates->rate*$request->weight
            ]);

        //dd($shipment);
        //$cost=$shippingrates*$request->weight;
         //dd($cost);
        if($shipment){
                flash('Shipping cost updated successfully!')->info();
                $role=Auth::user()->role;
                if ($role=='Admin') {
                    return redirect()->back();
                }
                else if ($role=='Employee') {
                    return redirect()->back();
                } 
            
        }else{
           flash('Error updating shipping cost!')->error();
           return redirect()->back(); 
        }
       
    }
    }

    //FUNCTION TO UPDATE SHIPMENT 
        public function approveShipment(Request $request)
    {
        
        /**
        * validate the input fields
        **/
         //dd( $request );

        $this->validate($request,[
            'status'=>'required',
            ]);
        
        $user = Auth::user();
        $shipment = new Shipment();
        $shipment ->updateOrCreate(['id'=>$request->id],[
            'status'=>$request->status
            ]);

        $shipment = new Shipment();
        $shipment ->updateOrCreate(['id'=>$request->id],[
            'status'=>$request->status
            ]);


        if($shipment){
            flash('Shipment has been approved!')->info();
           return redirect()->back(); 
        }else{
           flash('Error approving shipment!')->error();
           return redirect()->back(); 
        }

    }

    //Client cancels his own shipment requests
        public function clientcancelShipment(Request $request)
    {
        //dd($request);
        $user = Auth::user();
        $shipment = new Shipment();
        $shipment = Shipment::findOrFail($request->id);
        $shipment ->updateOrCreate(['id'=>$request->id],[
            'status'=>$request->status
            ]);
        if($shipment){
            flash('You have successfully cancelled your shipment!')->info();
           return redirect()->back(); 
        }else{
           flash('Error cancelling your shipment!')->error();
           return redirect()->back(); 
        }
    }

            public function cancelShipment(Request $request)
    {
        
        /**
        * validate the input fields
        **/
         //dd( $request );

        $this->validate($request,[
            'status'=>'required',
            'contact'=>'required',
            'cons_no'=>'required',
            'reason'=>'required',
            ]);
        
        //dd($request);
        $user = Auth::user();
        $shipment = new Shipment();
        $shipment = Shipment::findOrFail($request->id);
        $shipment ->updateOrCreate(['id'=>$request->id],[
            'status'=>$request->status
            //'reason'=>$request->reason
            ]);

        

// Specify your login credentials
$username   = "allankiptalam";
$apikey     = "95a1b6253602864ca21eac3c72af8570aa6b00963510dafcdcdc4e104c562121";

// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
$recipients = $request->contact;

// And of course we want our recipients to know what we really do
$message    = "Dear, ".$request->sender_name.". Your shipment with consignment number: ".$request->cons_no." has been cancelled because of the following reasons. ".$request->reason;

// Create a new instance of the gateway class
$gateway    = new AfricasTalkingGateway($username, $apikey);

// Any gateway error will be captured by the custom Exception class below, 
// so wrap the call in a try-catch block
try 
{

    $results = $gateway->sendMessage($recipients, $message);
            
    foreach( $results as $result ) {
    
        // status is either "Success" or "error message"
        //echo " Number: " .$result->number;
        //echo " Status: " .$result->status;
        //echo " MessageId: " .$result->messageId;
        //echo " Cost: "   .$result->cost."\n";
    
    }

}
catch ( AfricasTalkingGatewayException $e )
{

    echo "Encountered an error while sending: ".$e->getMessage();

}

        if($shipment){
            flash('Shipment cancelled successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error cancelling shipment!')->error();
           return redirect()->back(); 
        }

    }


        public function updateShipment(Request $request)
    {
        /**
        * validate the input fields
        **/
         //dd( $request );

        $this->validate($request,[
            
            'from_location'=>'required|max:255',
            'to_location'=>'required|max:255',
            'status'=>'required|max:255',
            ]);
        
        //dd($request);
        $user = Auth::user();
        $shipment = new Shipment();
        $updatedby_employee_id=Auth::user()->id;
        $shipment ->updateOrCreate(['id'=>$request->id],[
            'from_location'=>$request->from_location,
            'to_location'=>$request->to_location,
            'status'=>$request->status,
            'employee_id'=>$updatedby_employee_id
            ]);


        if($shipment){
            flash('Shipment updated successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error updating shipment!')->error();
           return redirect()->back(); 
        // return back()->withInput(); 
        }

    }

        public function updateApprovedShipment(Request $request)
    {
        $client = new Client('allan-kiptalam', '2j3zzpeORWnJjt9AfnIwehkhAWVk9Daqiq8wFvA35pbMgJNv0xRjmwHZXSIqKRjb');
         //dd( $request );

        $this->validate($request,[
            
            'from_location'=>'required|max:255',
            'to_location'=>'required|max:255',
            'status'=>'required|max:255',
            'container_number'=>'required',
            'sender_contact'=>'required',
            'cons_no'=>'required',
            ]);       
        
        //dd($request);
        $user = Auth::user();
        $shipment = new Shipment();
        $shipment ->updateOrCreate(['id'=>$request->id],[
            'from'=>$request->from_location,
            'to'=>$request->to_location,
            'status'=>'Loaded'
            ]);

        $transit = new Transit();
        $transit ->updateOrCreate(['cons_no'=>$request->cons_no],[
            'container_number'=>$request->container_number,
            'sender_contact'=>$request->sender_contact,
            'cons_no'=>$request->cons_no,
            'status'=>'Loaded',
            'from'=>$request->from_location,
            'to'=>$request->to_location,
            'weight'=>$request->weight
            //'current_location'=>'officelocation'
            
            ]);
   try
        {
$selectuserid = Shipment::select('id')->where('cons_no', '=', $request->cons_no)->first(); 
$selectitemid = Container::select('id')->where('container_number', '=', $request->container_number)->first();

$user_id=$selectuserid->id;
$item_id=$selectitemid->id;
$client->send(new Reqs\AddPurchase($user_id, $item_id, [ 
  'cascadeCreate' => true,
]));
    }
    catch(Ex\ApiTimeoutException $e)
{
    //Handle timeout => use fallback echo '1'; dd($e);
     $myerror= 'Client did not get response within 3000ms';
return view('Employee.approved_orders')->with('myerror',$myerror);
}
catch(Ex\ResponseException $e)
{ //echo '2'; dd($e);
    //Handle errorneous request => use fallback
$myerror = 'The chosen location does not have any recommendations at the moment!';
return view('Employee.approved_orders')->with('myerror',$myerror); 
}
catch(Ex\ApiException $e)
{
    //ApiException is parent of both ResponseException and ApiTimeoutException 
    echo '3'; dd($e);
}


        if($transit){
            flash('Shipment updated successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error updating shipment!')->error();
           return redirect()->back(); 
        //return back()->withInput(); 
        }

    }

            public function updateInTransitShipment(Request $request)
    {
        /**
        * validate the input fields
        **/
         //dd( $request );

        $this->validate($request,[
            
            'from_location'=>'required|max:255',
            'to_location'=>'required|max:255',
            'status'=>'required|max:255',
            ]);
        
        //dd($request);
        $user = Auth::user();
        $shipment = new Shipment();
        $updatedby_employee_id=Auth::user()->id;
        $shipment ->updateOrCreate(['id'=>$request->id],[
            'from_location'=>$request->from_location,
            'to_location'=>$request->to_location,
            'status'=>$request->status,
            'employee_id'=>$updatedby_employee_id
            ]);
        $transit = new Transit();
        $transit ->updateOrCreate(['cons_no'=>$request->cons_no],[
            'status'=>$request->status
            
            ]);
        $status=$request->status;
        if($status=='Delivered'){
            $delete = \DB::delete('delete from transits where cons_no = ?',[$request->cons_no]);
        }else{}

//To count containers in Transit table

         $count_containers = Transit::where('status', '=', 'Loaded')->where('status', '=', 'Pending')->where('status', '=', 'Approved')->where('status', '=', 'In Transit')->count();
         //dd($count_containers);


                // Specify your login credentials
$username   = "allankiptalam";
$apikey     = "95a1b6253602864ca21eac3c72af8570aa6b00963510dafcdcdc4e104c562121";

// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
$sender_contact = $request->sender_contact;
$receiver_contact = $request->receiver_contact;

// And of course we want our recipients to know what we really do
$sender_message    = "Dear,".$request->sender_name.",your shipment with consignment number:".$request->cons_no." has been delivered at ".$request->to_location.". Thank you for choosing our Courier Services. We look forward to continue working with you.";
$receiver_message    = "Dear".$request->receiver_name.",a shipment belonging to you with consignment number:".$request->cons_no." has been delivered at ".$request->to_location.". Thank you for choosing our Courier Services. We look forward to continue working with you.";

// Create a new instance of the gateway class
$gateway    = new AfricasTalkingGateway($username, $apikey);


try 
{

    $results = $gateway->sendMessage($sender_contact, $sender_message);
            
    foreach( $results as $result ) {
    
    }
    $results = $gateway->sendMessage($receiver_contact, $receiver_message);
            
    foreach( $results as $result ) {
    
    }

}
catch ( AfricasTalkingGatewayException $e )
{

    echo "Encountered an error while sending: ".$e->getMessage();

}

        if($shipment){
            flash('Shipment updated successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error updating shipment!')->error();
           return redirect()->back(); 
        //return back()->withInput(); 
        }

    }


     //END OF FUNCTION TO UPDATE SHIPMENT


        //FUNCTION TO TRACK SHIPMENT
        public function trackShipment(Request $request)
    {
        /**
        * validate the input fields
        **/
         //dd( $request );

        $this->validate($request,[
            'cons_no'=>'required|max:255',
            ]);
        //dd($request);
        $search_results = Shipment::where('cons_no', '=', $request->cons_no)->first();
        if ($search_results === null) {
            
           // user doesn't exist
            //echo "No shipment";
            
        }else{
 //echo "Exist"; 
            dd($search_results);
            return view('Client.track_results',[
            'search_results'=>$search_results
            ]);
        //return view('Client.trackshipment',[
            //'users'=>$users
            // ]);
            //flash('Shipment exists!')->info();
            //return redirect()->back();
        }

    }
     //END OF FUNCTION TO TRACK SHIPMENT




    /**
    * Client to delete shipment from the db
    **/
    public function destroyShipment(Request $request)
    {
        //dd($request);
        $shipment = Shipment::findOrFail($request->id);
        $shipment->delete();
        if($shipment){
            flash('Shipment deleted successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error deleting shipment!')->error();
           return redirect()->back(); 
        //return back()->withInput(); 
        }
    }


        //FUNCTION TO ADD SHIPPING RATES TO THE DB
        public function storeShippingRate(Request $request)
    {
        /**
        * validate the input fields
        **/
        //dd( $request );

// Validator::extend('less_than', function($attribute, $value, $parameters)
// {
//     $other = Input::get($parameters[0]);
    
//     return isset($other) and intval($value) < intval($other);
// });
// $validation = Validator::make(Input::all(), ['weight_to' => 'less_than:weight_from']);




       
        $validator = Validator::make($request->all(), [
            'weight_from'=>'required|numeric|regex:/[0-9]/|unique:shippingrates,weight_from,'.$request->id,
            'weight_to'=>'required|numeric|regex:/[0-9]/|unique:shippingrates,weight_to,'.$request->id,
            'rate'=>'required|numeric',
        ]);
         
            if ($validator->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($validator, 'storeShippingrateErrors');
        }

dd($request);
        //dd($request);
        $user = Auth::user();
        $shippingrate = new Shippingrate();
        $shippingrate->updateOrCreate(['id'=>$request->id],[
            'weight_from'=>$request->weight_from,
            'weight_to'=>$request->weight_to,
            'rate'=>$request->rate
            ]);
        if($shippingrate){
            flash('Shipping rate added successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error adding shipping rate!')->error();
           return redirect()->back();  
        }
    }
     //END OF FUNCTION TO ADD SHIPMENT TO THE DB

        /**
    * Client to delete shipment from the db
    **/
    public function destroyShippingRate(Request $request)
    {
        //dd($request);
        $shippingrate = Shippingrate::findOrFail($request->id);
        $shippingrate->delete();
        if($shippingrate){
            flash('Shipping rate deleted successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error deleting shipping rate!')->error();
           return redirect()->back(); 
        //return back()->withInput(); 
        }
    }

    /**
     * Get Payment
     */
    public function showPaymentScreen(Payment $payment)
    {
        return view('Client.payment')->with('payment', $payment);
    }

    protected function getPrice(Shipment $shipment) {
        return 1;
    }
}
