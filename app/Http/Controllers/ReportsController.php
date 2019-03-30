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

class ReportsController extends Controller
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
     * Show the pendingorders Report.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendingorders_report()
    {
        $shipments = Shipment::where('status','Pending')->get();
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.pending_orders_report',[
            'shipments'=>$shipments
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.pending_orders_report',[
            'shipments'=>$shipments
            ]);
        }
        
    }

    /**
     * Show the approvedorders Report.
     *
     * @return \Illuminate\Http\Response
     */
    public function approvedorders_report()
    {
        $shipments = Shipment::where('status','Approved')->get();
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.approved_orders_report',[
            'shipments'=>$shipments
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.approved_orders_report',[
            'shipments'=>$shipments
            ]);
        }
        
    }

    /**
     * Show the intransitorders Report.
     *
     * @return \Illuminate\Http\Response
     */
    public function intransitorders_report()
    {
        $shipments = Shipment::where('status','In Transit')->get();
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.intransit_orders_report',[
            'shipments'=>$shipments
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.intransit_orders_report',[
            'shipments'=>$shipments
            ]);
        }
        
    }

        /**
     * Show the deliveredorders Report.
     *
     * @return \Illuminate\Http\Response
     */
    public function deliveredorders_report()
    {
        $shipments = Shipment::where('status','Delivered')->get();
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.delivered_orders_report',[
            'shipments'=>$shipments
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.delivered_orders_report',[
            'shipments'=>$shipments
            ]);
        }
        
    }

    /**
     * Show the cancelledorders Report.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelledorders_report()
    {
        $shipments = Shipment::where('status','Cancelled')->get();
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.cancelled_orders_report',[
            'shipments'=>$shipments
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.cancelled_orders_report',[
            'shipments'=>$shipments
            ]);
        }
        
    }

    /**
     * Show the clients Report.
     *
     * @return \Illuminate\Http\Response
     */
    public function clients_report()
    {
        $users = User::where('role','Client')->get();
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.clients_report',[
            'users'=>$users
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.clients_report',[
            'users'=>$users
            ]);
        }
        
    }
        /**
     * Show the employees Report.
     *
     * @return \Illuminate\Http\Response
     */
    public function employees_report()
    {
        $users = User::where('role','Employee')->get();
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.employees_report',[
            'users'=>$users
            ]);
        }
        else {
            return redirect()->back();
        }
        
    }

    /**
     * Show the Containers Report.
     *
     * @return \Illuminate\Http\Response
     */
    public function containers_report()
    {
        $containers = Container::orderBy('id')->paginate(10);
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.containers_report',[
            'containers'=>$containers
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.containers_report',[
            'containers'=>$containers
            ]);
        }
        
    }

        /**
     * Show the offices Report.
     *
     * @return \Illuminate\Http\Response
     */
    public function offices_report()
    {
        $offices = Office::orderBy('id')->paginate(10);
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.offices_report',[
            'offices'=>$offices
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.offices_report',[
            'offices'=>$offices
            ]);
        }
        
    }

    


 
    
}
