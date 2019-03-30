<?php

namespace App\Http\Controllers\Container;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Container;

use Auth;

class IndexController extends Controller
{
    public function index()
    {
    	$containers = Container::orderBy('id')->paginate(10);
        $role=Auth::user()->role;
        //return View::make('result')->with(['info' => $info, 'error_code', 5]);
        if ($role=='Admin') {
            return view('Admin.containers.index',[
            'containers'=>$containers
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

    	$user = Auth::user();
        //dd($request);

    	$container = $user->containers()->updateOrCreate(['id'=>$request->id],[
    		'name'=>$request->name,
    		'container_number'=>$request->container_number,
            'max_weight'=>$request->max_weight,
            'status'=>$request->status
    		]);
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

        $user = Auth::user();
        //dd($request);

        $container = $user->containers()->updateOrCreate(['id'=>$request->id],[
            'status'=>$request->status
            ]);
        if($container){
            flash('Container status updated successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error updating container!')->error();
           return redirect()->back();  
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
