<?php

namespace App\Http\Controllers;

use App\Wallet;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data =[];
         $data['walletBallance']=0;
        if(@file_get_contents("https://zapwallet.in/order/disputecheck")){
            file_get_contents('https://zapwallet.in/order/disputecheck');
    		if(Auth::user()){
                $userid=Auth::user()->id;
                $data['walletBallance']=DB::table('wallets')->where('user_id', $userid)->value('balance');
            }else{
                $data['walletBallance']=0;
            }
        }
	
        return view('home', $data);
    }
	
    public function passwordreset(Request $request)
    {
        if(Auth::user()){
            $userid=Auth::user()->id;
            $data['walletBallance']=DB::table('wallets')->where('user_id', $userid)->value('balance');
        }else{
            $data['walletBallance']=0;
        }
		
		$data['passwordreset_token'] = $request->token;
		$data['email']	= '';
		if(isset($_REQUEST['email'])){
			$data['email']	= $_REQUEST['email'];
		}
		
		return view('home', $data);
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
	
	public function bus_search(Request $request){
		
		$ch = curl_init();
		$timeout = 30; // set to zero for no timeout
		curl_setopt ($ch, CURLOPT_URL, $myurl);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json', 'access-token: 3EDF2858811673D7957F9BACDABFA002|7605-S|202006061703||FFFF'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	}
	
	public function adminlogin(){
		return view('admin.login');
	}
	public function forgetpwd(){
		return view('admin.forgetpwd');
	}	
	
}
