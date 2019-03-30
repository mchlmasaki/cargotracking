<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use AfricasTalkingGateway\AfricasTalkingGateway;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\User;
use App\Office;
use App\Employeeoffice;
use Auth;
use Hash;

class IndexController extends Controller
{

    //ADMINS FUNCTIONS
    /**
     * Shows the Admins in the DB.
     *
     * @return \Illuminate\Http\Response
     */
    public function admins()
    {
        
        $users = User::where('role','Admin')->get();
        //orderBy('id','desc')->paginate(10);
        
        return view('Admin.admins',[
            'users'=>$users
            ]);
    }

    /**
     * Shows the offices in the DB.
     *
     * @return \Illuminate\Http\Response
     */
    public function offices()
    {
        
        $offices = Office::all();
        return view('Admin.offices',[
            'offices'=>$offices
            ]);
    }

    /**
     * Shows the Employees in the DB.
     *
     * @return \Illuminate\Http\Response
     */
    public function employees()
    {
        $employees = User::where('role','Employee')->get();
        $offices = Office::all();
        
        return view('Admin.employees',[ 
            'employees'=>$employees,
            'offices'=>$offices
            ]);
    }


    //FUNCTION TO ADD CLIENTS/ADMINS/EMPLOYEES TO THE DB

        public function storeUser(Request $request)
    {
        /**
        * validate the input fields for adding employee to the db
        **/
            $validator = Validator::make($request->all(), [
            'name'=>'required|max:255',
            'contact' => 'required|numeric|regex:/^\+(2547)[0-9]{8}/|digits:13',
            'email'=>'required|unique:users,email,'.$request->id,
            'role'=>'required|max:255',
            'verified'=>'max:255',
        ]);
            if ($validator->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($validator, 'storeUserErrors');
        }
        
        $user = Auth::user();
        $new_user = new User();
        
        if($request->verified){
            $new_user->updateOrCreate(['id'=>$request->id],[
            'name'=>$request->name,
            'contact'=>$request->contact,
            'email'=>$request->email,
            'role'=>$request->role,
            'password' => bcrypt($request['password']),
            'verified'=>$request->verified
            ]);
        }else{
            $new_user->updateOrCreate(['id'=>$request->id],[
            'name'=>$request->name,
            'contact'=>$request->contact,
            'email'=>$request->email,
            'role'=>$request->role,
            'password' => bcrypt($request['password']),
            'verified'=>'0'
            ]);
        }

        // TO SEND LOGIN CREDENTIALS TO THE USER
        // Specify your login credentials
$username   = "allankiptalam";
$apikey     = "95a1b6253602864ca21eac3c72af8570aa6b00963510dafcdcdc4e104c562121";

// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
$recipients = $request->contact;

// And of course we want our recipients to know what we really do
$message    = "Cargo Tracking System. Thank you ".$request->name." for creating an account with us. Your login credentials is: Username: ".$request->email." and Password:- ".$request->password;

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
        
        if($new_user){
            flash($request->email .'&nbsp;'.' added Successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error creating the user!')->error();
           return redirect()->back(); 
        //return back()->withInput(); 
        }
    }

    //FUNCTION TO UPDATE CLIENTS/ADMINS/EMPLOYEES TO THE DB

        public function updateUser(Request $request)
    { 
        /**
        * validate the input fields for adding employee to the db
        **/
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:255',
            'contact' => 'required|numeric|regex:/^\+(2547)[0-9]{8}/|digits:13',
            'email'=>'required|unique:users,email,'.$request->id,
            'role'=>'required|max:255',
            'verified'=>'max:255',
        ]);
            if ($validator->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($validator, 'updateUserErrors');
        }
        //dd($request);
        $office_id = Office::select('id')->where('name', '=', $request->office_name)->first();
        $user = Auth::user();
        $new_user = new User();
        
        
        if($request->verified){
        $new_user->updateOrCreate(['id'=>$request->id],[
            'name'=>$request->name,
            'contact'=>$request->contact,
            'email'=>$request->email,
            'role'=>$request->role,
            'verified'=>$request->verified
            ]);}else{
            $new_user->updateOrCreate(['id'=>$request->id],[
            'name'=>$request->name,
            'contact'=>$request->contact,
            'email'=>$request->email,
            'role'=>$request->role,
            'verified'=>'0'
            ]);
        }
        //dd($request);
        $user_role=$request->role;
        if($user_role=='Employee'){
        //$employeeofffice = Auth::employeeofffice();

        $officedetails = Office::select('name','city','location')->where('id', '=', $office_id->id)->first();
        $employeeofffice = new Employeeoffice();
        $employeeofffice ->updateOrCreate(['user_id'=>$request->id],[
            'user_id'=>$request->id,
            'office_id'=>$office_id->id,
            'office_name'=>$officedetails->name,
            'office_city'=>$officedetails->city,
            'office_location'=>$officedetails->location
            ]);}else{
            
        }


        

        if($new_user){
            flash($request->name .'&nbsp;'.' Updated successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error updating the user!')->error();
           return redirect()->back(); 
        //return back()->withInput(); 
        }
    }

        //FUNCTION TO ADD OFFICES TO THE DB

            public function storeOffice(Request $request)
    {
        /**
        * validate the input fields for adding employee to the db
        **/
        //dd($request);
        $this->validate($request,[
            'name'=>'required|unique:offices,name,'.$request->id,
            'city'=>'required|max:255',
            'location'=>'required|max:255',
            'address'=>'required|max:255',
            'contact' => 'required|numeric|regex:/^\+(2547)[0-9]{8}/|digits:13',
            'contact_person'=>'required|max:255',
            ]);
        

        $user = Auth::user();
        $new_office = new Office();
        $new_office = $user->offices()->updateOrCreate(['id'=>$request->id],[
            'name'=>$request->name,
            'city'=>$request->city,
            'location'=>$request->location,
            'address'=>$request->address,
            'contact'=>$request->contact,
            'contact_person'=>$request->contact_person
            ]);
        // //To update employeeoffice table
       Employeeoffice::where('office_id', '=', $request->id)->update(array(
        'office_name' => $request->name,
        'office_city'=>$request->city,
        'office_location'=>$request->location   
        ));
        if($new_office){
            flash('Office added Successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error adding car!')->error();
           return redirect()->back(); 
        //return back()->withInput(); 
        }

    }
     //END OF FUNCTION TO ADD OFFICES TO THE DB

    /**
    * delete Office from the db
    **/
    public function destroyOffice(Request $request)
    {
         //dd($request);
        $office = Office::findOrFail($request->id);
        $office->delete();
        if($office){
            flash('Office deleted successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error deleting the office!')->error();
           return redirect()->back(); 
        //return back()->withInput(); 
        }
    }

    /**
    * delete a client/Admin/Employee from the db
    **/
    public function destroyUser(Request $request)
    {
        //dd($request);
        $user = User::findOrFail($request->id);
        $user->delete();
        
        if($user){
            flash('User deleted successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error deleting the user!')->error();
           return redirect()->back(); 
        
        }
    }
    

    // END OF ADMINS FUNCTION

    // CLIENTS FUNCTIONS
    // FUNCTION TO EDIT USER PROFILES
    // if ($request->has('edit_profile')){

    // }
    // if ($request->has('change_password')){
        
    // }

    public function editUserProfile(Request $request)
    {
        /**
        * validate the input fields for updating user profile
        **/
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,'.$request->id,
            'contact'=>'required|numeric|regex:/^\+(254)[0-9]{9}/|digits:13',
        ]);
            if ($validator->fails())
        {
            return redirect()->back()->withInput($request->input())->withErrors($validator, 'updateUserErrors');
        }

        //dd($request);
        $user = Auth::user();
        $new_user = new User();
        //dd($request);
        $new_user->updateOrCreate(['id'=>$request->id],[
            'name'=>$request->name,
            'email'=>$request->email,
            'contact'=>$request->contact
            ]);
         if($new_user){
            flash('Account details updated successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error updating account!')->error();
           return redirect()->back(); 
        }
    }




        public function changePassword(Request $request)
    {
        /**
        * validate the input fields for pdating user Password
        **/
        
        $this->validate($request,[
            'oldpassword' => 'required',
            'password' => 'required|min:6|confirmed',
            
            ]);
            //dd($request);

        
        if (Hash::check($request->input('oldpassword'),
            Auth::user()->password)){
            $user = Auth::user();
            $change_pwd = new User();
            
            //dd($request);
            $change_pwd->updateOrCreate(['id'=>$request->id],[
            'password' => bcrypt($request->password),
            ]);
            if($change_pwd){
            flash('Password updated successfully!')->info();
           return redirect()->back(); 
        }else{
           flash('Error updating password!')->error();
           return redirect()->back();  
        }
        }else{
            return redirect()->back()->withInput($request->only('oldpassword'))->withErrors([
                'oldpassword' => 'Wrong password',
                ]);
        }
        //return redirect()->back();
    }
    //END OF CLIENTS FUNCTION

    //EMPLOYEES FUNCTIONS
    //END OF EMPLOYEES FUNCTION



    /**
     * Shows the Clients/Customers/users in the DB.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
    	
        $users = User::where('role','Client')->get();
        //orderBy('id','desc')->paginate(10);
        $role=Auth::user()->role;
        if ($role=='Admin') {
            return view('Admin.users',[
            'users'=>$users
            ]);
        }
        else if ($role=='Employee') {
            return view('Employee.users',[
            'users'=>$users
            ]);
        }
    	
    }
}







    
