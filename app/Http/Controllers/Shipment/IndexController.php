<?php

namespace App\Http\Controllers\Shipment;

use Illuminate\Http\Request;

use AfricasTalkingGateway\AfricasTalkingGateway;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Shipment;
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
         
//dd($request);
        $this->validate($request,[
            'sender_name'=>'required|max:255',
            'sender_contact'=>'required|numeric|regex:/^\+(254)[0-9]{9}/',
            'sender_email'=>'required',
            'from_location'=>'required|max:255',
            'sender_address'=>'required|max:255',
            'receiver_name'=>'required|max:255',
            'receiver_contact'=>'required|numeric|regex:/^\+(254)[0-9]{9}/',
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

// //To get the latitude and longitude of the From location
  $address =$request->from_location; // Google HQ
  $prepAddr = str_replace(' ','+',$address);
  $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
  $output= json_decode($geocode);
  $status = $output->status;

    if($status == "OK")
  {
    $latitude = $output->results[0]->geometry->location->lat;
    $longitude = $output->results[0]->geometry->location->lng;
   // echo "From latitude: ".$latitude;
   // echo "From longitude: ".$longitude;
  }else{
  //echo "No Data Found for From location";
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
  }



  //To get points for each town selected

                $selectcounty = Town::select('county')->where('town', '=', $request->town)->first();
                //echo $selecttown->town;
                $county=$selectcounty->county;
                $selectpoints = Keyword::select('id','points')->where('town', '=', $request->town)->where('county', '=', $county)->where('keywords', '=', $request->type_ofshipment)->first();
                
                if($selectpoints){
                    $points   = $selectpoints->points;
                    $id   = $selectpoints->id;
                    $npoints  = $points + 1;
                    $createkeyword = new Keyword();
            $createkeyword ->updateOrCreate(['id'=>$id],[
            'keywords'=>$request->type_ofshipment,
            'town'=>$request->town,
            'county'=>$selectcounty->county,
            'points'=>$npoints
            ]);
                }else{
                    $points   = 0;
                    $npoints  = $points + 1;
                    $createkeyword = new Keyword();
            $createkeyword ->updateOrCreate(['id'=>$request->id],[
            'keywords'=>$request->type_ofshipment,
            'town'=>$request->town,
            'county'=>$selectcounty->county,
            'points'=>$npoints
            ]);
                }
                
   //dd($request);

        
        $user = Auth::user();
        $shipment = new Shipment();
        $shipment= $user->shipments() ->updateOrCreate(['id'=>$request->id],[
            'sender_name'=>$request->sender_name,
            'sender_contact'=>$request->sender_contact,
            'sender_email'=>$request->sender_email,
            'from_location'=>$request->from_location,
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
        if($shipment){
            flash(' Your shipment request with consignment number,&nbsp;'.$request->cons_no.'&nbsp; has been received Successfully!')->info();
           return redirect()->back(); 
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
            'sender_contact'=>'required|numeric|regex:/^\+(254)[0-9]{9}/',
            'from_location'=>'required|max:255',
            'sender_address'=>'required|max:255',
            'receiver_name'=>'required|max:255',
            'receiver_contact'=>'required|numeric|regex:/^\+(254)[0-9]{9}/',
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

        //dd($request);
        //dd($shippingrates);
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
        //return back()->withInput(); 
        }

    }

        public function updateApprovedShipment(Request $request)
    {
        /**
        * validate the input fields
        **/
         //dd( $request );

        $this->validate($request,[
            
            'from_location'=>'required|max:255',
            'to_location'=>'required|max:255',
            'status'=>'required|max:255',
            'container_number'=>'required',
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
            'cons_no'=>$request->cons_no,
            'status'=>'Loaded',
            'from'=>$request->from_location,
            'to'=>$request->to_location,
            'weight'=>$request->weight
            //'current_location'=>'officelocation'
            
            ]);

        // Specify your login credentials
$username   = "allankiptalam";
$apikey     = "95a1b6253602864ca21eac3c72af8570aa6b00963510dafcdcdc4e104c562121";

// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
$recipients = $request->sender_contact;

// And of course we want our recipients to know what we really do
$message    = "Dear customer,".$request->sender_name.",your shipment with consignment number:".$request->cons_no." is in Transit from".$request->from_location." to".$request->to_location.".";

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

                // Specify your login credentials
$username   = "allankiptalam";
$apikey     = "95a1b6253602864ca21eac3c72af8570aa6b00963510dafcdcdc4e104c562121";

// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
$sender_contact = $request->sender_contact;
$receiver_contact = $request->receiver_contact;

// And of course we want our recipients to know what we really do
$sender_message    = "Dear customer,".$request->sender_name.",your shipment with consignment number:".$request->cons_no." has been delivered at ".$request->to_location.".";
$receiver_message    = "Dear".$request->receiver_name.",a shipment to you with consignment number:".$request->cons_no." has been delivered at ".$request->to_location.".";

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


            public function updateDeliveredShipment(Request $request)
    {
        /**
        * validate the input fields
        **/
         //dd( $request );

        $this->validate($request,[
            'status'=>'required|max:255',
            'cons_no'=>'required',
            ]);
        
        //dd($request);
        $user = Auth::user();
        $shipment = new Shipment();
        $updatedby_employee_id=Auth::user()->id;
        $shipment ->updateOrCreate(['id'=>$request->id],[
            'status'=>$request->status
            ]);


        // Specify your login credentials
$username   = "allankiptalam";
$apikey     = "95a1b6253602864ca21eac3c72af8570aa6b00963510dafcdcdc4e104c562121";

// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
$sender_contact = $request->sender_contact;
$receiver_contact = $request->receiver_contact;

// And of course we want our recipients to know what we really do
$sender_message    = "Dear,".$request->sender_name.", Thank you for choosing our Courier Services. We look forward to continue working with you.";
$receiver_message    = "Dear".$request->receiver_name.", Thank you for choosing our Courier Services. We look forward to continue working with you.";

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
        $users = Shipment::where('cons_no', '=', $request->cons_no)->first();
        if ($users === null) {
           // user doesn't exist
            flash('No Shipment!')->error();
            return redirect()->back();
        }else{
        return view('Client.trackshipment',[
            'users'=>$users
            ]);
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

        $this->validate($request,[
            'weight_from'=>'required|numeric|regex:/[0-9]/|unique:shippingrates,weight_from,'.$request->id,
            'weight_to'=>'required|numeric|regex:/[0-9]/|unique:shippingrates,weight_to,'.$request->id,
            'rate'=>'required|numeric',
            ]);
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

}
