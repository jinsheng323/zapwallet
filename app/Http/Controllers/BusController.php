<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BusController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user = Auth::user();
        $userid=Auth::user()->id;
        $data['walletBallance']=DB::table('wallets')->where('user_id', $userid)->value('balance');
        $data['user']=$user;
        $data['from_city']='';
        $data['from_city_id']='';
        $data['to_city']='';
        $data['to_city_id']='';
        $data['d_date']='';
        $data['r_date']='';
        if($request->isMethod("GET")){

            $data['method']='GET';

        }else{

            $data['method']='POST';
            $data['from_city']=$request->from_city;
            $data['from_city_id']=$request->from_city_id;
            $data['to_city']=$request->to_city;
            $data['to_city_id']=$request->to_city_id;
            $data['d_date']=$request->d_date;
            $data['r_date']=$request->r_date;

            $post_data['ClientId']		= '7605';
            $post_data['ClientSecret']	= '78a83fbe2544114407d54b4fe383f689';			
			
			
			/** Start **********/
			//curl -X POST "http://api.iamgds.com/ota/Auth" -H  "accept: application/xml" -H  "content-type: application/json" -d "{  \"ClientId\": 50,  \"ClientSecret\": \"a77de32aa3473a93415b02494253f088\"}"	
            			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"http://api.iamgds.com/ota/Auth");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"ClientId=".$post_data['ClientId']."&ClientSecret=".$post_data['ClientSecret']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$login_token = curl_exec($ch);
			curl_close ($ch);
			$login_token = json_decode($login_token);		
			$login_token = 'access-token: '.$login_token;
			
            $myurl = "http://api.iamgds.com/ota/Search?fromCityId=$request->from_city_id&toCityId=$request->to_city_id&journeyDate=$request->d_date";			
            $timeout = 30; // set to zero for no timeout
			$ch = curl_init();
            curl_setopt ($ch, CURLOPT_URL, $myurl);
            curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json', $login_token));
			//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json', 'access-token: 8ADE858626E69B96BAD50D44E61D847B|7605-S|202006182135||FFFF'));
			//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json', 'access-token: '.$login_token));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $jsonxx = curl_exec($ch);
            $result = json_decode($jsonxx);
            $data['result']	= $result;
			$data['myurl']	= $myurl;
            // dd("result", $result, $myurl, $request->d_date, date('Y-m-d') , $login_token, $data);
        }
		
		if($request->d_date == "2020-06-23"){
			return view('bus.myindex', $data);
		}
		else{
			return view('bus.index', $data);
		}
        
    }



    public function autocomplete(Request $request)
    {
        $query=$request->input('query');
        // dd("SELECT city FROM cities where city like '%$query%'");
        // $data = DB::select("cities")
        //         ->where("city","LIKE","%{{$request->input('query')}%")
        //         ->get();

        $hasil=DB::select("SELECT * FROM cities where city like '%$query%'");

        $data = array();
        foreach ($hasil as $hsl)
        {
                $data[] = $hsl;
        }
        return response()->json($data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
