<?php

namespace App\Http\Controllers\Container;

use Recombee\RecommApi\Client;
use Recombee\RecommApi\Requests as Reqs;
use Recombee\RecommApi\Exceptions as Ex;

use Illuminate\Http\Request;
use AfricasTalkingGateway\AfricasTalkingGateway;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Container;
use App\Shipment;
use App\Transit;
use App\Office;

use Auth;

class IndexController extends Controller
{
    public function index()
    {
    	$containers = Container::orderBy('id')->paginate(10);
        $role=Auth::user()->role;
        $offices = Office::all();
        //return View::make('result')->with(['info' => $info, 'error_code', 5]);
        if ($role=='Admin') {
            return view('Admin.containers.index',[
            'containers'=>$containers,
            'offices'=>$offices
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.containers',[
            'containers'=>$containers
            ]);
        }
    	
    }

    public function store(Request $request)
    {
    	//$client = new Client('allan-kiptalam', '2j3zzpeORWnJjt9AfnIwehkhAWVk9Daqiq8wFvA35pbMgJNv0xRjmwHZXSIqKRjb');
        //$client->send(new Reqs\ResetDatabase()); //Clear everything from the database
        /**
    	* validate the input fields
    	**/
    	//dd();
    	$this->validate($request,[
    		'name'=>'required|max:255|unique:containers,name,'.$request->id,
    		'container_number'=>'required|unique:containers,container_number,'.$request->id,
            'max_weight'=>'required|numeric|max:5000',
            'status'=>'required|max:255',
    		]);

    	//$user = Auth::user();
        //dd($request);

      $container = new Container();
    	$container ->updateOrCreate(['id'=>$request->id],[
    		'name'=>$request->name,
    		'container_number'=>$request->container_number,
            'max_weight'=>$request->max_weight,
            'status'=>$request->status
    		]);


try
{
$client = new Client('allan-kiptalam', '2j3zzpeORWnJjt9AfnIwehkhAWVk9Daqiq8wFvA35pbMgJNv0xRjmwHZXSIqKRjb');
// Add properties of items
// $client->send(new Reqs\AddItemProperty('name', 'string'));
// $client->send(new Reqs\AddItemProperty('container_number', 'string'));
// $client->send(new Reqs\AddItemProperty('max_weight', 'string')); 
// $client->send(new Reqs\AddItemProperty('status', 'string'));
// # Prepare requests
$selectitemid = Container::select('id')->where('container_number', '=', $request->container_number)->first();
//$county=$selectpoints->id;
//dd($county);
$itemId = $selectitemid->id;
$client->send(new Reqs\SetItemValues($itemId,
    [
    'name'=>$request->name,
    'container_number'=>$request->container_number,
    'max_weight'=>$request->max_weight,
    'status'=>$request->status],
 [ //optional parameters:
  'cascadeCreate' => true
]));





// $client->send(new Reqs\ResetDatabase()); //Clear everything from the database
// // Add properties of items
// $client->send(new Reqs\AddItemProperty('name', 'string'));
// $client->send(new Reqs\AddItemProperty('container_number', 'string'));
// $client->send(new Reqs\AddItemProperty('max_weight', 'string'));
// $client->send(new Reqs\AddItemProperty('status', 'string'));
// # Prepare requests  
// $requests = array();
// $containers = Container::orderBy('id')->paginate(10);

// foreach($containers as $container)
// {
//     $itemId = $container->id;
//     //dd($itemId);
//     $r = new Reqs\SetItemValues(
//       $itemId,
//       //values:
//       [ 
//             'name'=>$container->name,
//             'container_number'=>$container->container_number,
//             'max_weight'=>$container->max_weight,
//             'status'=>$container->status
//       ],
//       //optional parameters:
//       ['cascadeCreate' => true] // Use cascadeCreate for creating item
//                                  // with given itemId, if it doesn't exist]
//     );
//     array_push($requests, $r);
// }

// // Send catalog to the recommender system
// $result =  $client->send(new Reqs\Batch($requests));
// //var_dump($result);

}
catch(Ex\ApiTimeoutException $e)
{
    //Handle timeout => use fallback
}
catch(Ex\ResponseException $e)
{
    //Handle errorneous request => use fallback
}
catch(Ex\ApiException $e)
{
    //ApiException is parent of both ResponseException and ApiTimeoutException
}



        if($container){
            flash($request->name .'&nbsp;'.' added successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error adding container!')->error();
           return redirect()->back();  
        }
        
    }

        public function updateContainer(Request $request)
    {
        /**
        * validate the input fields
        **/
        //dd();
        $this->validate($request,[
            'status'=>'required|max:255',
            ]);

        //$user = Auth::user();
        //dd($request);
        $container = new Container();
        $container->updateOrCreate(['id'=>$request->id],[
            'status'=>$request->status,
            'container_number'=>$request->container_number
            ]);


        $container_status=$request->status;
        if($container_status=='In Transit'){

             $conn = mysqli_connect("localhost", "root", "", "cargotrackingsystem");
                   $customer_details = mysqli_query($conn,"SELECT * FROM transits WHERE container_number='$request->container_number'");
              while($row = mysqli_fetch_array($customer_details))
                {
                  $container_number=$row['container_number'];
                  $sender_contact=$row['sender_contact'];
                  $cons_no=$row['cons_no'];
                  $from=$row['from'];
                  $to=$row['to'];
                   //dd($customer_details);
                  
                      
            // To send sms Specify your login credentials
$username   = "allankiptalam";
$apikey     = "95a1b6253602864ca21eac3c72af8570aa6b00963510dafcdcdc4e104c562121";

// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
$recipients = $sender_contact;

// And of course we want our recipients to know what we really do
$message    = "Cargo Tracking System. Your shipment with consignment number: ".$cons_no." is in transit from: ".$from." To: ".$to;

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
        //change status of shipments in table transit 
        $transit = new Transit();
        $transit ->updateOrCreate(['cons_no'=>$cons_no],[
            'status'=>$request->status
            
            ]);
        //change status of shipments in table shipments 
        $shipment = new Shipment();
        $shipment ->updateOrCreate(['cons_no'=>$cons_no],[
            'status'=>$request->status
            ]);
           }     
        }
        //else if status is Available
        else{
            //change status of container in table container 
        $container = new Container();
        $container ->updateOrCreate(['id'=>$request->id],[
            'status'=>$request->status,
            'office'=>$request->office_name
            ]);


        }

        if($container){
            flash('Container status updated successfully......!')->info();
           return redirect()->back(); 
        }else{
           flash('Error updating container!')->error();
           return redirect()->back();  
        }
        
    }

    /**
    * update container location from recommendations
    **/
    public function updateRecommendedContainer(Request $request)
    {

        //dd($request);
        $container = new Container();
        $container ->updateOrCreate(['id'=>$request->id],[
            'status'=>$request->status,
            'office'=>$request->location
            ]);
//dd($request);
         if($container){
            $myfeedback= 'Delivery Truck updated/recommended successfully';
            return Redirect::to('Admin/success')->with ( 'myfeedback',$myfeedback);
           //return view ( 'Admin.success' );
        }else{
           return view ( 'Admin/success' )->withMessage ( 'Error updating the container!');
        }
    }


    /**
    * delete container
    **/
    public function destroy(Request $request)
    {
    	$container = Container::findOrFail($request->id);
        $container->delete();
    	 if($container){
            flash('Container deleted successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error deleting the container!')->error();
           return redirect()->back(); 
        }
    }
}
