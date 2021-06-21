<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        $userid=Auth::user()->id;
        $data['walletBallance']=DB::table('wallets')->where('user_id', $userid)->value('balance');
        $data['user']=$user;
        return view('profile', $data);
    }

    public function orderHistory(Request $request){
        $user 		= Auth::user();
        $userid		= Auth::user()->id;
		$paginate	= 5;
		if ($request->session()->exists('paginate')) {
			$paginate	= $request->session()->get('paginate');
		}
		if(isset($_REQUEST['paginate']) && in_array($_REQUEST['paginate'],array(5,10,20,50,100))){
			$paginate	= $_REQUEST['paginate'];
			$request->session()->put('paginate', $paginate);
		}
		$data['paginate']	= $paginate;
		//dd($_REQUEST);
		
        $wallet = DB::table('wallets')->where('user_id', $userid)->get();
        //$transaction=DB::table('transactions')->where('user_id', $userid)->orderBy('id', 'desc')->get();
		$transaction=DB::table('transactions')->where('user_id', $userid)->orderBy('id', 'desc')->paginate($paginate);
		
		//dd($transaction);
		
        $data['walletBallance']=DB::table('wallets')->where('user_id', $userid)->value('balance');
        $data['user']=$user;
        $data['wallet']=$wallet;
        $data['transaction']=$transaction;
        return view('orderHistory', $data);
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'unique:users'],
            'address' => ['nullable', 'string',  'max:255'],
            'address2' => ['nullable', 'string',  'max:255'],
            'dateOfBirth' => ['nullable'],
            'city' => ['nullable'],
            'state' => ['nullable'],
            'zipcode' => ['nullable'],

        ]);
    }


    public function update(User $user)
    {
        //
        // $user->id=Auth::user()->id;
        $user = User::find(Auth::user()->id);
        if(request('phone') !=Auth::user()->phone){
            $user->phone = request('phone');
            $user->isPhoneVerified = '';
            $this->validate(request(),[
                'name'=>'required|max:255',
                'phone'=>'numeric|unique:users',
                'address'=>'nullable',
                'address2'=>'nullable',
                'dateOfBirth'=>'nullable',
                'city'=>'nullable',
                'state'=>'nullable',
                'zipcode'=>'numeric|nullable',
             ]);
         }else{

             $this->validate(request(),[
                 'name'=>'required|max:255',

                 'address'=>'nullable',
                 'address2'=>'nullable',
                 'dateOfBirth'=>'nullable',
                 'city'=>'nullable',
                 'state'=>'nullable',
                 'zipcode'=>'numeric|nullable',
              ]);
         }


        $user->name=request('name');

         $user->dateOfBirth = request('dateOfBirth');
         $user->address = request('address');
         $user->address2 = request('address2');
         $user->city = request('city');
         $user->state = request('state');
         $user->zipcode = request('zipcode');


         $user->save();

        //  dd($user);
        return redirect('/profile')->with('success',"profile updated successfully. Please logout and check new password.");
        // return redirect('/')->with('success',"Password updated successfully. Please logout and check new password.");
        dd();
    }
    public function updatepassword(Request $request)
    {
        //

        $userid=Auth::user()->id;
        $affected = DB::table('users')
        ->where('id', $userid)
        ->update(['password' => Hash::make($request->password)]);


        return redirect('/')->with('success',"Password updated successfully. Please logout and check new password.");
        dd($userid);
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



    public function verifyPhone(){

        $apiKey = urlencode('UYYXwhqCy5Y-A3CE7YO2MMzFSUp8wwRm9dwPp7d21v');
        $mobile = Auth::user()->phone;
        $number = '91' . $mobile;
        $numbers = array($number);
        $sender = urlencode('ZAPWAL');
        $verify_code = mt_rand(100000, 999999);
        $messages = 'Use '. $verify_code.' as your mobile number verification OTP. OTP is confidential. Please do not share it with others. www.zapwallet.in' ;
        $message = rawurlencode($messages);

        $numbers = implode(',', $numbers);

        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

    	 //dd($response);

        $dataphone = array(
        'phone_verification_code'=> $verify_code,
      );

        $user = Auth::user();
        $userid=Auth::user()->id;
        DB::table('users')->where('id', $userid)->update($dataphone);
        $dwallet['user_id']=$userid;
        $dwallet['balance']=0;
        DB::table('wallets')->insert($dwallet);

         return redirect('/optphone')->with('success',"website.Verification Code send successfully on your phone, Please enter your code for verification");

    }

    public function optphone() {
        $user = Auth::user();
        $userid=Auth::user()->id;
        $data['walletBallance']=DB::table('wallets')->where('user_id', $userid)->value('balance');
        $data['user']=$user;
        return view('phone_verify', $data);




    }

    public function codeCheck(Request $request) {

        $opt_code = $request->opt_code;
        $phone_verification_code = Auth::user()->phone_verification_code;
        $phone_number = Auth::user()->phone;

        if($opt_code == $phone_verification_code) {
            $datacode = array(
                'phone_verification_code'=> '',
                'isPhoneVerified'=>1,
                'phone_verified_at'=>now(),
              );
             //DB::table('users')->where('phone', $phone_number)->update($datacode);
             DB::table('users')->where('id', Auth::user()->id)->update($datacode);
             return redirect('/profile');
        }
        else{
            return redirect('/optphone');
        }

    }
}
