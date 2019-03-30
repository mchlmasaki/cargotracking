<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Container;
use App\Town;
use App\User;
use Auth;

use Recombee\RecommApi\Client;
use Recombee\RecommApi\Requests as Reqs;
use Recombee\RecommApi\Exceptions as Ex;

class RecombeeController extends Controller
{
    
    public function recombee(Request $request)
    {

   try
        {
 $client = new Client('allan-kiptalam', '2j3zzpeORWnJjt9AfnIwehkhAWVk9Daqiq8wFvA35pbMgJNv0xRjmwHZXSIqKRjb');
// //RECOMMENDATIONS
 //dd($request);
 $user_id=$request->town_id; 
 $result = $client->send(new Reqs\RecommendItemsToUser($user_id, 2 ));
 $ids = [];

 //dd($result);
 foreach($result['recomms'] as $res){
 	 $ids[] = $res['id'];
 	 //var_dump($res);     
 }
 //dd($res['id']);
 $search_results = [];
 if (count($ids) > 0) {
 	$search_results = Container::whereIn('id',$ids)->get();
 }
//dd(count($search_results));  
$select_town_name = Town::select('town')->where('id', '=', $request->town_id)->first();      
$town_name=$select_town_name->town; 

return view('Admin.recommendations',[
            'search_results'=>$search_results,
            'town_name'=>$town_name
            ]);
 //return view ( 'Admin/recommendations' )->withDetails ( $result );

// $recommended = $client->send(
// new Reqs\RecommendItemsToUser('3KZKLX5A', 3, [ 'filter' => "'max_weight'>=200"])); 
// echo 'Recommended items with at least 200 Weight: ' . json_encode($recommended, JSON_PRETTY_PRINT) . "\n";
// $ru='Recommended items with at least 200 Weight: ' . json_encode($recommended, JSON_PRETTY_PRINT) . "\n";
// dd($ru);


// // Recommend only computers that have at least 3 cores
// $recommended = $client->send(
//   new Reqs\RecommendItemsToItem('computer-6', 'user-42', 5, ['filter' => "'num-cores'>=3"]) 
//   );
// echo 'Recommended items with at least 3 processor cores: ' . json_encode($recommended, JSON_PRETTY_PRINT) . "\n"; 

        
    }
    catch(Ex\ApiTimeoutException $e)
{
    //Handle timeout => use fallback echo '1'; dd($e);
     $myerror= 'Client did not get response within 3000ms';
return view('Admin.recommendations')->with('myerror',$myerror);
}
catch(Ex\ResponseException $e)
{ //echo '2'; dd($e);
    //Handle errorneous request => use fallback
$myerror = 'The chosen location does not have any recommendations at the moment!';
return view('Admin.recommendations')->with('myerror',$myerror); 
}
catch(Ex\ApiException $e)
{
    //ApiException is parent of both ResponseException and ApiTimeoutException 
    echo '3'; dd($e);
}
}

    public function recommendsuccess() 
    {
        return view('Admin.success');
    }

}