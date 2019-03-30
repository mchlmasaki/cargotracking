<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Container;
use App\Employee;
use App\Office;
use App\Shipment;
use App\Transit;
use App\Shippingrate;
use App\Town;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard for admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::all();
        // return view('Admin.dashboard',[
        //     'users'=>$users
        //     ]);
        $total_clients = User::where('role','=','client')->count();
        $total_employees = User::where('role','=','employee')->count();
        $total_containers = Container::all()->count();
        $total_users = User::all();
        flash('Welcome Aboard!'.'&nbsp;'.Auth::user()->name);
        return view('Admin.dashboard',[
            'total_clients'=>$total_clients,
            'total_employees'=>$total_employees,
            'total_containers'=>$total_containers,
            'total_users'=>$total_users
            ]);
        
    }

    /**
     * Show the application dashboard for client.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientIndex()
    {
        $total_pendingshipments = Shipment::where('status','=','Pending')->count();
        $total_deliveredshipments = Shipment::where('status','=','Delivered')->count();
        flash('Welcome Aboard!'.'&nbsp;'.Auth::user()->name);
        return view('Client.dashboard',[
        'total_pendingshipments'=>$total_pendingshipments,
        'total_deliveredshipments'=>$total_deliveredshipments
        ]);
    }

    /**
     * Show the application sendpackage page for the client.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientSendPackage()
    {
        //$shipments = Shipment::orderBy('id')->paginate(10);
        $towns = Town::orderBy('town', 'asc')->get();
            return view('Client.sendpackage',[
            'towns'=>$towns
            ]);
       
    }

    /**
     * Show the application gmaps page .
     *
     * @return \Illuminate\Http\Response
     */
    public function gmaps()
    {
        return view('Employee.gmaps');
       
    }

    /**
     * Show the application Edit Profile page for the client and Employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        $userdetails = User::all();
        $role=Auth::user()->role;
        if ($role=='Client') {
            return view('Client.edit_profile',[
            'userdetails'=>$userdetails
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.edit_profile',[
            'userdetails'=>$userdetails
            ]);
        }
         
       
    }

    /**
     * Show the application Edit Profile page for the client and Employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        $userdetails = User::all();
        $role=Auth::user()->role;
        if ($role=='Client') {
            return view('Client.change_password',[
            'userdetails'=>$userdetails
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.change_password',[
            'userdetails'=>$userdetails
            ]);
        }
         
       
    }

    /**
     * Show the application TrackShipment for client.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientTrackShipment()
    {
        
        return view('Client.trackshipment');
    }

    /**
     * Show the Client ShipmentDetails page of the client.
     *
     * @return \Illuminate\Http\Response
     */
    public function shipmentDetails($id)
    {
        $shipments = Shipment::where('id',$id)->get();
        $role=Auth::user()->role;
        if ($role=='Client') {
            return view('Client.shipmentdetails',[
            'shipments'=>$shipments
            ]);

        }
        else if ($role=='Employee') {
            return view('Employee.shipmentdetails',[
            'shipments'=>$shipments
            ]);
        }
        else if ($role=='Admin') {
            return view('Admin.shipmentdetails',[
            'shipments'=>$shipments
            ]);
        }
        
       
    }

    /**
     * Show the Cient Requests page of the client.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientRequests()
    {
        $user_id=Auth::user()->id;
        $shipments = Shipment::where('user_id',$user_id)->get();
        return view('Client.requests',[
            'shipments'=>$shipments
            ]);
       
    }


    /**
     * Show the application dashboard for employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function employeeIndex()
    {
        
        $total_clients = User::where('role','=','client')->count();
        //$total_employees = User::where('role','=','employee')->count();
        $total_containers = Container::all()->count();
        $total_shipments = Shipment::all()->count();
        $total_newshipments = Shipment::where('status','=','Pending')->count();
        $total_approvedshipments = Shipment::where('status','=','Approved')->count();
        $total_intransitshipments = Shipment::where('status','=','In Transit')->count();
        $total_deliveredshipments = Shipment::where('status','=','Delivered')->count();
        $total_completedshipments = Shipment::where('status','=','Completed')->count();
        $total_cancelledshipments = Shipment::where('status','=','Cancelled')->count();
        $total_undeliveredshipments = Shipment::where('status','=','Undelivered')->count();
        //$total_users = User::all();
        flash('Welcome Aboard!'.'&nbsp;'.Auth::user()->name);
        return view('Employee.dashboard',[
            'total_clients'=>$total_clients,
            //'total_employees'=>$total_employees,
            'total_containers'=>$total_containers,
            'total_newshipments'=>$total_newshipments,
            'total_approvedshipments'=>$total_approvedshipments,
            'total_intransitshipments'=>$total_intransitshipments,
            'total_deliveredshipments'=>$total_deliveredshipments,
            'total_completedshipments'=>$total_completedshipments,
            'total_undeliveredshipments'=>$total_undeliveredshipments,
            'total_cancelledshipments'=>$total_cancelledshipments,
            'total_shipments'=>$total_shipments
            //'total_users'=>$total_users
            ]);
    }

    /**
     * Show the offices.
     *
     * @return \Illuminate\Http\Response
     */
    public function office()
    {
        $towns = Town::orderBy('town', 'asc')->get();            
        $offices = Office::all();
        return view('Admin.offices',[
            'offices'=>$offices,
            'towns'=>$towns
            ]);
    }

    /**
     * Show the pendingorders page.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendingorders()
    {
        $shipments = Shipment::where('status','Pending')->get();
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.pending_orders',[
            'shipments'=>$shipments
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.pending_orders',[
            'shipments'=>$shipments
            ]);
        }
        
    }

    /**
     * Show the application  page for manage shipment
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_shipment($id)
    {
        //$variable=$weight;
        $shipments = Shipment::where('id',$id)->get();
        //$shippingrates = Shippingrate::where('weight', '<=', $variable)->where('weights','>', $variable)->get();
        return view('Employee.manage_shipment',[
            'shipments'=>$shipments
            //'shippingrates'=>$shippingrates
            ]);

       
    }

    /**
     * Show the Approved orders page.
     *
     * @return \Illuminate\Http\Response
     */
    public function approved_orders()
    {
        $shipments = Shipment::where(function($q) {$q->where('status','Approved')->orWhere('status','Loaded');})->get();
        $containers = Container::where('status','Available')->orderBy('id')->get();
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.approved_orders',[
            'shipments'=>$shipments
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.approved_orders',[
            'shipments'=>$shipments,
            'containers'=>$containers
            ]);
        }
        
    }

    /**
     * Show the intransit orders page.
     *
     * @return \Illuminate\Http\Response
     */
    public function intransit_orders()
    {
        $shipments = Shipment::where('status','In Transit')->get();
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.intransit_orders',[
            'shipments'=>$shipments
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.intransit_orders',[
            'shipments'=>$shipments
            ]);
        }
        
    }

        /**
     * Show the delivered orders page.
     *
     * @return \Illuminate\Http\Response
     */
    public function delivered_orders()
    {
        $shipments = Shipment::where('status','Delivered')->get();
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.delivered_orders',[
            'shipments'=>$shipments
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.delivered_orders',[
            'shipments'=>$shipments
            ]);
        }
        
    }

    /**
     * Show the completed orders page.
     *
     * @return \Illuminate\Http\Response
     */
    public function completed_orders()
    {
        $shipments = Shipment::where('status','Completed')->get();
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.completed_orders',[
            'shipments'=>$shipments
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.completed_orders',[
            'shipments'=>$shipments
            ]);
        }
        
    }


    /**
     * Show the completed orders page.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelled_orders()
    {
        $shipments = Shipment::where('status','Cancelled')->get();
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.cancelled_orders',[
            'shipments'=>$shipments
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.cancelled_orders',[
            'shipments'=>$shipments
            ]);
        }
        
    }

    /**
     * Show the charges page.
     *
     * @return \Illuminate\Http\Response
     */
    public function charges()
    {
        $shippingrates = Shippingrate::orderBy('id')->paginate(10);
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.charges',[
            'shippingrates'=>$shippingrates
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.charges',[
            'shippingrates'=>$shippingrates
            ]);
        } 

        
       
    }


    /**
     * Show the invoices.
     *
     * @return \Illuminate\Http\Response
     */
    public function invoice()
    {
        $users = User::all();
        return view('Admin.invoice',[
            'users'=>$users
            ]);
    }

    /**
     * Redirect after registration
     *
     * @return \Illuminate\Http\Response
     */
    public function regsuccess(Request $request)
    {
        //Session::flush();
        $request->session()->flush();
        return view('success');
    }
    /**
     * Redirect here if account is not verified
     *
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        //Session::flush();
        $request->session()->flush();
        return view('verify');
    }


    public function checkRole(Request $request)
    {
        dd(2);
        $role=Auth::user()->role;
        $verified=Auth::user()->verified;
        if ($verified=='1') {
            if ($role=='Admin'){
               return redirect('Admin/dashboard')->send(); 
            }
            else if ($role=='Client') {
                return redirect('Client/dashboard')->send();
            }
            else if ($role=='Employee') {
                return redirect('Employee/dashboard')->send();
            }
            else {
                return redirect('/logout')->send();
                }
                
            }
        else if ($verified=='0'){
            $request->session()->flush();
            flash('<center>Your account is not verified. Please contact your local Administrator !</center>')->error();
            return redirect('/login')->send();
            }
        else {
            $request->session()->flush();
            return redirect('/logout')->send();
            }
        
    }
    
}
