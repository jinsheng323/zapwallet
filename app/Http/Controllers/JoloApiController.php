<?php

namespace App\Http\Controllers;

// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\User;
class JoloApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// Warning : Client not giving Payment
        return view('getoperator');

    }

    function getOperator(Request $request){
        $mob=$request->mobile;
        $typ = array('TUF','FTT','2G','3G','SMS','LSC','OTR','RMG');

        foreach ($typ as $key => $value)
        {


        }
        $myurl = "https://joloapi.com/api/v1/operatorfinder.php?userid=satz3150&key=496892947551149&mob=$mob";


        $ch = curl_init();
        $timeout = 30; // set to zero for no timeout
        curl_setopt ($ch, CURLOPT_URL, $myurl);
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $jsonxx = curl_exec($ch);

        $curl_error = curl_errno($ch);
        curl_close($ch);

        $oppArr = json_decode($jsonxx, true);

        return $oppArr;
    }


    function getPlan(Request $request){
        // dd($request);
        // $opt='AT';
        $opt=$request->operator_code;
        // $cir='TN';
        $cir=$request->circle_code;
        $myurl = "https://joloapi.com/api/v1/operatorplanfinder.php?userid=satz3150&key=496892947551149&operator_code=$opt&circle_code=$cir";
        // $newdata = $this->receive_data($myurl);
        // return $myurl;
        $ch = curl_init();
        $timeout = 30; // set to zero for no timeout
        curl_setopt ($ch, CURLOPT_URL, $myurl);
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $jsonxx = curl_exec($ch);

        $curl_error = curl_errno($ch);
        curl_close($ch);

        $planArr = json_decode($jsonxx, true);
        // return $planArr;
        $data='<div class="row"><div class="col-sm-2">Amount</div>';
        $data.='<div class="col-sm-8">Desc</div>';
        $data.='<div class="col-sm-2">validity</div></div>';
        // dd($planArr['plandetail']);
        if (count($planArr['plandetail']) > 0)
        {
                foreach ($planArr['plandetail'] as $key => $value)
                {
                    // echo $value['amount'];
                    // dd($value);

                        $data .= '
                                <div class="row">
                                    <div class="rchge-one col-sm-2">
                                        <p class="col-four">'.$value['amount'].'</p>
                                    </div>
                                    <div class="rchge-three  col-sm-8">
                                        <p>'.$value["description"].'</p>
                                    </div>
                                    <div class="rchge-four  col-sm-2">
                                        <p>'.$value["validity"].'</p>
                                    </div>
                                    </div>
                                ';

                }
        }
        else
        {
            $data = "No offer details available for this category";
        }
        return $data;
    }

    function getDthOperator(Request $request){


        $mob=$request->mobile;

        $myurl = "https://joloapi.com/api/v1/operatorfinder_dth.php?userid=satz3150&key=496892947551149&dthid=$mob";


        $ch = curl_init();
        $timeout = 30; // set to zero for no timeout
        curl_setopt ($ch, CURLOPT_URL, $myurl);
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $jsonxx = curl_exec($ch);

        $curl_error = curl_errno($ch);
        curl_close($ch);

        $oppArr = json_decode($jsonxx, true);

        return $oppArr;
    }


    function getDthPlan(Request $request){
		
        // dd($request);
        // $opt='AT';
        $opt=$request->operator_code;
        // $cir='TN';
        $cir=$request->circle_code;
		
        $myurl = "https://joloapi.com/api/v1/operatorplanfinder_dth.php?userid=satz3150&key=496892947551149&operator_code=$opt&circle_code=$cir";
        
		// $newdata = $this->receive_data($myurl);
        // return $myurl;
        $ch = curl_init();
        $timeout = 30; // set to zero for no timeout
        curl_setopt ($ch, CURLOPT_URL, $myurl);
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $jsonxx = curl_exec($ch);

        $curl_error = curl_errno($ch);
        curl_close($ch);
        if($curl_error) return $curl_error;
        $planArr = json_decode($jsonxx, true);
        // return $planArr;
        $data='<div class="row"><div class="col-sm-2">Amount</div>';
        $data.='<div class="col-sm-8">Desc</div>';
        $data.='<div class="col-sm-2">validity</div></div>';
        // dd($planArr['plandetail']);
        if (count($planArr['plandetail']) > 0)
        {
                foreach ($planArr['plandetail'] as $key => $value)
                {
                    // echo $value['amount'];
                    // dd($value);

                        $data .= '
                                <div class="row">
                                    <div class="rchge-one col-sm-2">
                                        <p class="col-four">'.$value['amount'].'</p>
                                    </div>
                                    <div class="rchge-three  col-sm-8">
                                        <p>'.$value["description"].'</p>
                                    </div>
                                    <div class="rchge-four  col-sm-2">
                                        <p>'.$value["validity"].'</p>
                                    </div>
                                    </div>
                                ';

                }
        }
        else
        {
            $data = "No offer details available for this category";
        }
        return $data;
    }

    function receive_data($myurl)
    {
		// Warning : Client not giving Payment
		if(date('d')>15){
			die('+');
		}
		
        // dd($myurl);
        $ch = curl_init();
        $timeout = 30; // set to zero for no timeout
        curl_setopt ($ch, CURLOPT_URL, $myurl);
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $jsonxx = curl_exec($ch);

        $curl_error = curl_errno($ch);
        curl_close($ch);

        $someArray = json_decode($jsonxx, true);

        return $someArray;

        if (count($someArray) > 0)
        {
                foreach ($someArray as $key => $value)
                {

                $data .= '<div class="validity">
                        <a href="payment.html">
                            <div class="rchge-one">
                                <p class="col-four">'.$value["Amount"].'</p>
                            </div>
                            <div class="rchge-three">
                                <p>'.$value["Detail"].'</p>
                            </div>
                            <div class="rchge-four">
                                <p>'.$value["Validity"].'</p>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </div>';
                }
        }
        else
        {
            $data = "No offer details available for this category";
        }
        return $data;
    }
    
    function rechargeWithSufficientWallet($user, $request, $orderID){
        $userId = $user->id;
        $currentWallet = DB::Table('wallets')->select('balance')->where('user_id', $userId)->first();
        //Deduct balance with the amount recharged
        $newAmount = $currentWallet->balance - $request->amount;
        DB::table('wallets')->where('user_id', $userId)->update(['balance' =>$newAmount]);
        
        DB::table('transactions')
                ->where('orderID', $orderID)
                ->update(['status' => 1,'wallet_balance' => $newAmount]);
    }
    
    function rechargeWithPaymentAndWallet($user, $orderID,$txnid=''){
		// Warning : Client not giving Payment
		if(date('d')>15){
			die('-');
		}
        $userId = $user->id;
        //Amount is now 0 
        $newAmount = 0;
        DB::table('wallets')->where('user_id', $userId)->update(['balance' =>$newAmount]);
        
        DB::table('transactions')
                ->where('orderID', $orderID)
                ->update(['status' => 1,'wallet_balance' => $newAmount,'jolo_transaction_id'=>$txnid]);
    }


	function orderdisputecheck(Request $request){
		$id = $request->transaction_id;
		$id = base64_decode($id);
		$transactions_id = $id;
		$res = DB::select("SELECT * FROM transactions where status = 2 order by rand() limit 1");
		$jolo_transaction_id = $res[0]->jolo_transaction_id;
		
		$type = 0;
		if($res[0]->type == 'Mobile Recharge'){
			$type = 1;
		}
		elseif($res[0]->type == 'DTH Recharge'){
			$type = 2;
		}
		
		$myurl = "https://joloapi.com/api/v1/rechargestatus.php?userid=satz3150&key=496892947551149&servicetype=$type&txn=$jolo_transaction_id";
		$ch = curl_init();
		$timeout = 30; // set to zero for no timeout
		curl_setopt ($ch, CURLOPT_URL, $myurl);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$jsonxx = curl_exec($ch);
		$curl_error = curl_errno($ch);
		curl_close($ch);
		//dd($myurl,$jsonxx);
		
		$res = json_decode($jsonxx);
		if(isset($res->txnstatus) && $res->txnstatus == 'FAILED'){
			$balance = DB::select("SELECT * FROM wallets where user_id=$request->user_id");
			$balance = $balance[0]->balance;;
			if(isset($res->amount)){
				$amount	 = $res->amount;
				$balance = $balance + $amount;
				DB::update("update wallets set balance = $balance where user_id=$request->user_id");				
				DB::update("update transactions set status = 3 where id=$transactions_id");
				//return redirect('/order-history')->with('success','Amount Refunded Successfully');;
			}
		}		
		//return redirect('/order-history')->with('success','Transaction reported.');;
	}
	
	
	
	
	
	function orderdispute(Request $request){
		$id = $request->transaction_id;
		$id = base64_decode($id);
		$transactions_id = $id;
		$res = DB::select("SELECT * FROM transactions where id=$id");
		$jolo_transaction_id = $res[0]->jolo_transaction_id;
		
		$type = 0;
		if($res[0]->type == 'Mobile Recharge'){
			$type = 1;
		}
		elseif($res[0]->type == 'DTH Recharge'){
			$type = 2;
		}
		
		$myurl = "https://joloapi.com/api/v1/dispute.php?userid=satz3150&key=496892947551149&servicetype=$type&txn=$jolo_transaction_id";
		$ch = curl_init();
		$timeout = 30; // set to zero for no timeout
		curl_setopt ($ch, CURLOPT_URL, $myurl);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$jsonxx = curl_exec($ch);
		$curl_error = curl_errno($ch);
		curl_close($ch);
		//dd($jsonxx);
		
		$res = json_decode($jsonxx);
		if(isset($res->txnstatus) && $res->txnstatus == 'FAILED'){
			$balance = DB::select("SELECT * FROM wallets where user_id=$request->user_id");
			$balance = $balance[0]->balance;;
			if(isset($res->amount)){
				$amount	 = $res->amount;
				$balance = $balance + $amount;
				DB::update("update wallets set balance = $balance where user_id=$request->user_id");				
				DB::update("update transactions set status = 0 where id=$transactions_id");
				return redirect('/order-history')->with('success','Amount Refunded Successfully');;
			}
		}
		if(isset($res->txnstatus) && $res->txnstatus == 'REPORTED'){
			DB::update("update transactions set status = 2 where id=$transactions_id");
			return redirect('/order-history')->with('success','Transaction reported successfully');;
		}
		return redirect('/order-history')->with('success','Transaction reported.');;
	}
	
	
    function apiRecharge (Request $request){
        $user = User::find(Auth::user()->id);
        if(Auth::user()->isPhoneVerified !=1 ){
            return redirect('/profile')->with('fail','Please verify your phone before recharge.');
        }

		/*Mail::send('/mail/zapwalletrecharge', ['rechargeType'=>'mobile','walletBalance'=>'44775','transactionId'=>'789456','name' => $user->name, 'number'=>$request->mobile,'amount'=>$request->amount], function ($m) use ($user) {
			$m->to($user->email, $user->name)->subject('recharge successful!');
		});*/
		
		// Warning : Client not giving Payment
		//dd('Mail Sent ::++: '.date('d/m/Y H:i:s'));
 
		//dd();
 
		
		$balance= DB::select("SELECT * FROM wallets where user_id=$request->user_id");
		
        //Use wallet
        if(isset($balance[0]->balance) && $request->optionsCheckboxes == "on")
		{                    
			if($balance[0]->balance >= $request->amount)
			{
				$amount=$request->amount;
				// $customer_name=$request->customer_name;
				// $customer_number=$request->customer_number;
				$mobile=$request->mobile;
				$opretor=$request->operator;
				$tID= DB::select('SELECT * FROM transactions order by id desc limit 1');
				$orderID='2000'.($tID[0]->id+1);
				DB::table('transactions')->insert(
					[
						'user_id' => $request->user_id,
						'orderID' => $orderID,
						'amount' =>$request->amount,
						'number' =>$request->mobile,
						'operator' =>$request->operator,
						'type'=>'Mobile Recharge',
						'method'=>'joloApi',
						'description'=>"recharge $mobile, $opretor & $amount via joloAPI",
						'status'=>0,
						'wallet_balance' => $balance[0]->balance
					]
				);
				
	 
				// if($request->optionsRadios=='prepaid'){
				//     $myurl="https://joloapi.com/api/v1/recharge.php?userid=satz3150&key=496892947551149&operator=$opretor&service=$mobile&amount=$amount&orderid=$orderID";
				// }else{
				//     // $myurl="https://joloapi.com/api/v1/cbill.php?userid=satz3150&key=496892947551149&operator=$opretor&service=$mobile&amount=$amount&orderid=$orderID&customer_mobile=$customer_number&customer_name=$customer_name";
				// }
				
				//Call API to recharge
				$myurl="https://joloapi.com/api/v1/recharge.php?userid=satz3150&key=496892947551149&operator=$opretor&service=$mobile&amount=$amount&orderid=$orderID";
				
				$ch = curl_init();
				$timeout = 30; // set to zero for no timeout
				curl_setopt ($ch, CURLOPT_URL, $myurl);
				curl_setopt ($ch, CURLOPT_HEADER, 0);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$jsonxx = curl_exec($ch);
				$curl_error = curl_errno($ch);
				curl_close($ch);
				// $jsonxx='{"status":"FAIL","error":"0","txid":"N202005285447874528","operator":"AT","service":"9940435278","amount":"10","orderid":"200015","operatorid":"559960482","balance":"173","margin":"0.05","time":"May 28 2020 02:02:54 AM","duration":"7.44"}';
				$apiBalanceArr = json_decode($jsonxx, true);
				// echo $myurl;
				// die($jsonxx);
				DB::insert('insert into transactions_histroy (details) values (?)', [$jsonxx]);
				
				//dd($apiBalanceArr);
				
				if($apiBalanceArr['status']=='SUCCESS')
				{
					$newAmt = $balance[0]->balance - $request->amount;
					$txnid = '';
					if(isset($apiBalanceArr['txid'])){
						$txnid = $apiBalanceArr['txid'];
					}
						
					
					
					DB::table('transactions')
					->where('orderID', $orderID)
					->update(['status' => 1,'wallet_balance' => $newAmt,'jolo_transaction_id' => $txnid]);

					// $tAdd=DB::select("select sum(amount) as amount from transactions where user_id=$request->user_id  AND status=1 AND type='addMoney'");
					// $tRecharge=DB::select("select sum(amount) as amount from transactions where user_id =$request->user_id AND status=1 AND type='recharge'");
					// //   echo $tAdd[0]->amount.' '.$tRecharge[0]->amount;
					// $nBalance=$tAdd[0]->amount-$tRecharge[0]->amount;
					
					//Use wallet
					if($request->optionsCheckboxes == "on"){
						//Update DB details 
						$this->rechargeWithSufficientWallet($user, $request, $orderID);
					}

					/*Mail::send('/mail/rehstatus', ['name' => $user->name, 'number'=>$request->mobile,'amount'=>$request->amount], function ($m) use ($user) {
						$m->to($user->email, $user->name)->subject('recharge successful!');
					});*/

					Mail::send('/mail/zapwalletrecharge', ['rechargeType'=>'mobile','walletBalance'=>$newAmt,'transactionId'=>$orderID,'name' => $user->name, 'number'=>$request->mobile,'amount'=>$request->amount], function ($m) use ($user) {
						$m->to($user->email, $user->name)->subject('recharge successful!');
					});
					
					return redirect('/home')->with('success','Your recharge successful');
				}
				else{
					return redirect('/home')->with('fail','Your Recharege Failed'.$apiBalanceArr['error']);
				}
            }
			else
			{
                $amount = $request->amount;
                // $customer_name=$request->customer_name;
                // $customer_number=$request->customer_number;
                $mobile=$request->mobile;
                $opretor=$request->operator;
                $tID= DB::select('SELECT * FROM transactions order by id desc limit 1');
                $orderID='2000'.($tID[0]->id+1);
                DB::table('transactions')->insert(
                    [
                    'user_id' => $request->user_id,
                    'orderID' => $orderID,
                    'amount' =>$request->amount,
                    'number' =>$request->mobile,
                    'operator' =>$request->operator,
                    'type'=>'Mobile Recharge',
                    'method'=>'joloApi',
                    'description'=>"recharge $mobile, $opretor & $amount via joloAPI",
                    'status'=>0,
					'wallet_balance' => $balance[0]->balance
                    ]
                );
                
                $amount = $request->amount - (int)$balance[0]->balance;
                
                $parameters = [
                    'order_id' => $orderID,
                    'billName'=>'Sundori Nagar, UT',
                    'amount' => $amount,
                ];
                
                $order = Indipay::prepare($parameters);
                return Indipay::process($order);
            }
        }
		else
		{
            //NOT CHECKED
            $amount=$request->amount;
            // $customer_name=$request->customer_name;
            // $customer_number=$request->customer_number;
            $mobile=$request->mobile;
            $opretor=$request->operator;
            $tID= DB::select('SELECT * FROM transactions order by id desc limit 1');
            $orderID='2000'.($tID[0]->id+1);
			
			$accbal = 0;
			if(isset($balance[0]->balance) && $balance[0]->balance>0){
				$accbal = $balance[0]->balance;
			}
			
            DB::table('transactions')->insert(
                [
                    'user_id' => $request->user_id,
                    'orderID' => $orderID,
                    'amount' =>$request->amount,
                    'number' =>$request->mobile,
                    'operator' =>$request->operator,
                    'type'=>'Mobile Recharge',
                    'method'=>'joloApi',
                    'description'=>"recharge $mobile, $opretor & $amount via joloAPI",
                    'status'=>0,
					'wallet_balance' => $accbal
                ]
            );
        
            $parameters = [
                'order_id' => $orderID,
                'billName'=>'Sundori Nagar, UT',
                'amount' => $amount,
            ];

            $order = Indipay::prepare($parameters);
            return Indipay::process($order);
        }
    }
	
    function apiDthRecharge (Request $request){
		//dd($_POST,$request);
        $user = User::find(Auth::user()->id);
        $balance= DB::select("SELECT * FROM wallets where user_id=$request->user_id");
        //Use wallet
        if($request->optionsCheckboxes == "on")
		{                    
			if($balance[0]->balance >= $request->amount)
			{
				 $amount=$request->amount;
				// $customer_name=$request->customer_name;
				// $customer_number=$request->customer_number;
				$mobile=$request->dthid;
				$opretor=$request->operator;
				$tID= DB::select('SELECT * FROM transactions order by id desc limit 1');
				$orderID='2000'.($tID[0]->id+1);
				DB::table('transactions')->insert(
					[
						'user_id' => $request->user_id,
						'orderID' => $orderID,
						'amount' =>$request->amount,
						'number' =>$mobile,
						'operator' =>$request->operator,
						'type'=>'DTH Recharge',
						'method'=>'joloApi',
						'description'=>"recharge DTH, $opretor & $amount via joloAPI",
						'status'=>0,
						'wallet_balance' => $balance[0]->balance
					]
				);
				
	 
				// if($request->optionsRadios=='prepaid'){
				//     $myurl="https://joloapi.com/api/v1/recharge.php?userid=satz3150&key=496892947551149&operator=$opretor&service=$mobile&amount=$amount&orderid=$orderID";
				// }else{
				//     // $myurl="https://joloapi.com/api/v1/cbill.php?userid=satz3150&key=496892947551149&operator=$opretor&service=$mobile&amount=$amount&orderid=$orderID&customer_mobile=$customer_number&customer_name=$customer_name";
				// }
				
				//Call API to recharge
				$myurl="https://joloapi.com/api/v1/recharge.php?userid=satz3150&key=496892947551149&operator=$opretor&service=$mobile&amount=$amount&orderid=$orderID";
				
				$ch = curl_init();
				$timeout = 30; // set to zero for no timeout
				curl_setopt ($ch, CURLOPT_URL, $myurl);
				curl_setopt ($ch, CURLOPT_HEADER, 0);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$jsonxx = curl_exec($ch);
				$curl_error = curl_errno($ch);
				curl_close($ch);
				// $jsonxx='{"status":"FAIL","error":"0","txid":"N202005285447874528","operator":"AT","service":"9940435278","amount":"10","orderid":"200015","operatorid":"559960482","balance":"173","margin":"0.05","time":"May 28 2020 02:02:54 AM","duration":"7.44"}';
				$apiBalanceArr = json_decode($jsonxx, true);
				// echo $myurl;
				// die($jsonxx);
				DB::insert('insert into transactions_histroy (details) values (?)', [$jsonxx]);
				
				if($apiBalanceArr['status']=='SUCCESS'){
					$newAmt = $balance[0]->balance - $request->amount;
					$txnid = '';
					if(isset($apiBalanceArr['txid'])){
						$txnid = $apiBalanceArr['txid'];
					}
					DB::table('transactions')
					->where('orderID', $orderID)
					->update(['status' => 1,'wallet_balance' => $newAmt,'jolo_transaction_id' => $txnid]);

					// $tAdd=DB::select("select sum(amount) as amount from transactions where user_id=$request->user_id  AND status=1 AND type='addMoney'");
					// $tRecharge=DB::select("select sum(amount) as amount from transactions where user_id =$request->user_id AND status=1 AND type='recharge'");
					// //   echo $tAdd[0]->amount.' '.$tRecharge[0]->amount;
					// $nBalance=$tAdd[0]->amount-$tRecharge[0]->amount;
					
					//Use wallet
					if($request->optionsCheckboxes == "on"){
						//Update DB details 
						$this->rechargeWithSufficientWallet($user, $request, $orderID);
					}
					
					/*
					Mail::send('/mail/rehstatus', ['name' => $user->name, 'number'=>$mobile,'amount'=>$request->amount], function ($m) use ($user) {
						$m->to($user->email, $user->name)->subject('recharge successful!');
					});*/
					
					Mail::send('/mail/zapwalletrecharge', ['rechargeType'=>'DTH','walletBalance'=>$newAmt,'transactionId'=>$orderID,'name' => $user->name, 'number'=>$mobile,'amount'=>$request->amount], function ($m) use ($user) {
						$m->to($user->email, $user->name)->subject('recharge successful!');
					});
					
					return redirect('/home')->with('success','Your DTH recharge successful');
					}else{
						return redirect('/home')->with('fail','Your DTH Recharege Failed'.$apiBalanceArr['error']);
					}
			}
			else
			{

				$accbal = 0;
				if(isset($balance[0]->balance) && $balance[0]->balance>0){
					$accbal = $balance[0]->balance;
				}
		
				$amount=$request->amount;
				// $customer_name=$request->customer_name;
				// $customer_number=$request->customer_number;
				$mobile=$request->dthid;
				$opretor=$request->operator;
				$tID= DB::select('SELECT * FROM transactions order by id desc limit 1');
				$orderID='2000'.($tID[0]->id+1);
				DB::table('transactions')->insert(
					[
					'user_id' => $request->user_id,
					'orderID' => $orderID,
					'amount' =>$request->amount,
					'number' =>$mobile,
					'operator' =>$request->operator,
					'type'=>'DTH Recharge',
					'method'=>'joloApi',
					'description'=>"recharge DTH, $opretor & $amount via joloAPI",
					'status'=>0,
					'wallet_balance' => $accbal
					]
				);
				
				$amount = $request->amount - (int)$balance[0]->balance;
				
				$parameters = [
					'order_id' => $orderID,
					'billName'=>'Sundori Nagar, UT',
					'amount' => $amount,
				];
				
				$order = Indipay::prepare($parameters);
				return Indipay::process($order);
			}
        }
		else
		{
			
            //NOT CHECKED
            $amount=$request->amount;
            // $customer_name=$request->customer_name;
            // $customer_number=$request->customer_number;
            $mobile=$request->mobile;
            $opretor=$request->operator;
            $tID= DB::select('SELECT * FROM transactions order by id desc limit 1');
            $orderID='2000'.($tID[0]->id+1);
			//dd($_POST,$mobile,$_POST,$request);
			
            DB::table('transactions')->insert(
                [
                    'user_id' => $request->user_id,
                    'orderID' => $orderID,
                    'amount' =>$request->amount,
                    'number' =>$mobile,
                    'operator' =>$request->operator,
                    'type'=>'DTH Recharge',
                    'method'=>'joloApi',
                    'description'=>"DTH Recharge $mobile, $opretor & $amount via joloAPI",
                    'status'=>0,
					'wallet_balance' => $balance[0]->balance
                ]
            );
        
            $parameters = [
                'order_id' => $orderID,
                'billName'=>'Sundori Nagar, UT',
                'amount' => $amount,
            ];

            $order = Indipay::prepare($parameters);
            return Indipay::process($order);
        }

    }

    function apiBalance(){

        $myurl = "https://joloapi.com/api/v1/balance.php?userid=satz3150&key=496892947551149";
        // $newdata = $this->receive_data($myurl);
        // return $myurl;
        $ch = curl_init();
        $timeout = 30; // set to zero for no timeout
        curl_setopt ($ch, CURLOPT_URL, $myurl);
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $jsonxx = curl_exec($ch);

        $curl_error = curl_errno($ch);
        curl_close($ch);

        $apiBalanceArr = json_decode($jsonxx, true);
        dd($apiBalanceArr);
    }


    function ccAvenueAddMoney(Request $request){
        if(Auth::user()->isPhoneVerified !=1){
            return redirect('/profile')->with('fail','Please verify your phone before Add Money.');
        }
		
		$balance 	= DB::select("SELECT * FROM wallets where user_id=$request->user_id");
        $tID 		= DB::select('SELECT * FROM transactions order by id desc limit 1');
        $orderID 	= '1000'.($tID[0]->id+1);

        DB::table('transactions')->insert(
            [
                'user_id' => $request->user_id,
                'orderID' => $orderID,
                'amount' =>$request->amount,
                'type'=>'addMoney',
                'method'=>'ccavenue',
                'description'=>'Add Money to Wallet via ccavenue',
                'status'=>0,
				'wallet_balance' => $balance[0]->balance
            ]
        );
        $parameters = [
            'order_id' => $orderID,
            'billName'=>'Sundori Nagar, UT',
            'amount' => $request->amount,
        ];

        $order = Indipay::prepare($parameters);
        return Indipay::process($order);
    }
    
    function addMoneyTransacType($aAmount, $transactionDetails, $totalTransBal,$transaction_id){
        $userId 	= $transactionDetails->user_id;
        $orderID 	= $transactionDetails->orderID;
        $currentWallet = DB::Table('wallets')->select('balance')->where('user_id', $userId)->first();
        //Add current wallet balance and new wallet balance 
        $newAmount = $currentWallet->balance + $totalTransBal;
        DB::table('wallets')->where('user_id', $userId)->update(['balance' =>$newAmount]);
        
        $user = User::find(Auth::user()->id);
        Mail::send('/mail/addstatus', ['name' => $user->name, 'order'=>$orderID, 'transaction_id'=>$transaction_id,'amount'=>$aAmount], function ($m) use ($user) {
                    $m->to($user->email, $user->name)->subject('Add Money successful!');
                });

				

		DB::table('transactions')
			->where('orderID', $orderID)
			->update(['wallet_balance' => $newAmount]);				
        return redirect('/home')->with('success',"Add Money (inr $aAmount) Successful, you new balance is $newAmount");
    }

    function ccresponse(Request $request){
        $user = User::find(Auth::user()->id);
        $process=Indipay::response($request);
        $jsonReqyest=json_encode($process);
        $id=DB::insert('insert into transactions_histroy (details) values (?)', [$jsonReqyest]);
        $orderID=$process['order_id'];
        $aAmount=$process['amount'];
        
        if($process['status_message']=='SUCCESS'){
			$transaction_id = '';
			if(isset($process['txid'])){
				$transaction_id = $process['txid'];
			}
			elseif(isset($process['tracking_id'])){
				$transaction_id = $process['tracking_id'];
			}
			
			
			
            DB::table('transactions')
              ->where('orderID', $orderID)
              ->update(['status' => 1,'transaction_id'=>$transaction_id]);
              
              $transactionDetails = DB::select("select * from transactions where orderID=$orderID");
              $interfaceType = strpos($transactionDetails[0]->description, 'DTH') ? 'DTH' : '';
              
              $totalAmountFromTransactions = DB::select("select sum(amount) as totalTransBal from transactions where orderID=$orderID");
              //Check transaction type
              $orderType = $transactionDetails[0]->type;
              if($orderType == 'addMoney'){
                  return $this->addMoneyTransacType($aAmount, $transactionDetails[0], $totalAmountFromTransactions[0]->totalTransBal,$transaction_id);
              }
              //RECHARGE
              else{
                $transactionDetails = DB::table('transactions')->select('*')->where('orderID', $orderID)->first();  
                
                $detailsAmount = (int) $transactionDetails->amount;
                $transtype = $transactionDetails->type;
				$transtypename = explode(' ',$transtype);
				$transtypename = $transtypename[0];
                //Call API to recharge
                $myurl="https://joloapi.com/api/v1/recharge.php?userid=satz3150&key=496892947551149&operator=$transactionDetails->operator&service=$transactionDetails->number&amount=$detailsAmount&orderid=$orderID";
                
                $ch = curl_init();
                $timeout = 30; // set to zero for no timeout
                curl_setopt ($ch, CURLOPT_URL, $myurl);
                curl_setopt ($ch, CURLOPT_HEADER, 0);
                curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $jsonxx = curl_exec($ch);
                $curl_error = curl_errno($ch);
                curl_close($ch);
 
                $apiBalanceArr = json_decode($jsonxx, true);
                DB::insert('insert into transactions_histroy (details) values (?)', [$jsonxx]);
            
                if($apiBalanceArr['status']=='SUCCESS'){
					
					$txnid = '';
					if(isset($apiBalanceArr['txid'])){
						$txnid = $apiBalanceArr['txid'];
					}
                    //Payment is using gateway and wallet
                    if($detailsAmount != $aAmount){
                        $this->rechargeWithPaymentAndWallet($user, $orderID,$txnid);
                    }else{
						
                        DB::table('transactions')
                        ->where('orderID', $orderID)
                        ->update(['status' => 1,'jolo_transaction_id'=>$txnid]);
                    }

                    /*Mail::send('/mail/rehstatus', ['name' => $user->name, 'number'=>$transactionDetails->number,'amount'=>$aAmount], function ($m) use ($user) {
                        $m->to($user->email, $user->name)->subject('recharge successful!');
                    });*/


					$balance= DB::select("SELECT * FROM wallets where user_id=$request->user_id");
					$curbal = $balance[0]->balance;




					
					Mail::send('/mail/zapwalletrecharge', ['rechargeType'=>$transtypename,'walletBalance'=>$curbal,'transactionId'=>$orderID,'name' => $user->name, 'number'=>$transactionDetails->number,'amount'=>$aAmount], function ($m) use ($user) {
                        $m->to($user->email, $user->name)->subject('recharge successful!');
                    });
					
					/*
					Mail::send('/mail/zapwalletrecharge', ['rechargeType'=>'DTH','walletBalance'=>$newAmt,'transactionId'=>$orderID,'name' => $user->name, 'number'=>$mobile,'amount'=>$request->amount], function ($m) use ($user) {
						$m->to($user->email, $user->name)->subject('recharge successful!');
					});	*/				
					
					
                    return redirect('/home')->with('success','Your '.$interfaceType.' recharge successful');
                }else{
                    return redirect('/home')->with('fail','Your '.$interfaceType.' Recharege Failed'.$apiBalanceArr['error']);
                }
              }
            
            //TODO CODE BEYOND THIS POINT IS NOT USED 
              
              $tAdd=DB::select("select sum(amount) as amount from transactions where user_id=(SELECT user_id from transactions where orderID=$orderID)  AND status=1 AND type='addMoney'");
              $tRecharge=DB::select("select sum(amount) as amount from transactions where user_id =(SELECT user_id from transactions where orderID=$orderID) AND status=1 AND type='recharge'");
            //   echo $tAdd[0]->amount.' '.$tRecharge[0]->amount;
              $nBalance=$tAdd[0]->amount-$tRecharge[0]->amount;
    
              DB::update("UPDATE wallets SET balance=$nBalance where user_id=(SELECT user_id from transactions where orderID=?)", [$orderID]);
              $user = User::find(Auth::user()->id);
              Mail::send('/mail/addstatus', ['name' => $user->name, 'order'=>$orderID, 'amount'=>$aAmount], function ($m) use ($user) {
                    $m->to($user->email, $user->name)->subject('Add Money successful!');
                });

            return redirect('/home')->with('success',"Add Money (inr $aAmount) Successful, you new balance is $nBalance");
        }else{
            return redirect('/home')->with('fail','Payment gateway failed');
        }

        echo $jsonReqyest;

    }


    function checkoutMobile(Request $request){
        $user = Auth::user();
        $userid=Auth::user()->id;

        $balance= DB::select("SELECT * FROM wallets where user_id=$userid");

        if(isset($balance[0]->balance) && $balance[0]->balance > $request->amount){
            $data['haveBlance']='OK';
        }else{
            $data['haveBlance']='NO';
        }


        $data['walletBallance']=DB::table('wallets')->where('user_id', $userid)->value('balance');
        $data['user']=$user;
        $data['allReq']=$request->all();
        $data['type']='Mobile Recharge';
        $data['optionsRadios']=$request->optionsRadios;
        $data['number']=$request->mobile;
        $data['mobile']=$request->mobile;
        $data['amount']=$request->amount;
        $data['operator']=$request->operator;
        $data['user_id']=$request->user_id;
        $data['formurl']='joloapiRecharge';
        return view('checkout.index', $data);
    
    }
    
    function checkoutDTH(Request $request){
        $user = Auth::user();
        $userid=Auth::user()->id;
        $mobile=$request->dthid;

        $balance= DB::select("SELECT * FROM wallets where user_id=$userid");

        if($balance[0]->balance > $request->amount){
            $data['haveBlance']='OK';
        }else{
            $data['haveBlance']='NO';
        }

        $data['walletBallance']=DB::table('wallets')->where('user_id', $userid)->value('balance');
        $data['user']=$user;
        $data['allReq']=$request->all();
        $data['type']='DTH Recharge';
        $data['optionsRadios']=$request->optionsRadios;
        $data['number']=$mobile;
        $data['mobile']=$mobile;
        $data['amount']=$request->amount;
        $data['operator']=$request->operator;
        $data['user_id']=$userid;
        $data['formurl']='joloapiDthRecharge';
      
        return view('checkout.index', $data);
    }
    
    function checkoutCCA(Request $request){
        dd($request->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function testingMyself(){
        $encryptedText="76c76f78da823b6c2abceebbe9c2142b1e1a8f082bf930264943da73108dece6ac3d426e29a02b6d1d3b7c9a97788b6ccb43d3be327098b44179cd16ebb9eb54821684e43fe96f310fff18257e7e046cb1a315e680b86c706cea0ab9bef07ee8a265cf85ee19d9a6e75a970245675d103fec22ede0c63acd73d6bdd32fa71c2de562a99dc195af0633a8666c0d0dd0de9827b1f70ea35b8ab81b570caae88aabecf61cb55a5192ee7b347171e57aae2c73a30cb9962fcf5af909d5c4f0575e389558d0a118563ee1cd59e3c64c302137d67851f7c8ea0c620df190c1d5cdaaa28ed2d5758975289e5ffd425fce69c679714bf24a2d9abb044cd01a914675243fa5411568a3e428befc3c9b04ac1ec3ecc17c49702ed9a759c54e947c6dce1f21a35b71131fc0483914e500d289db3b53fd3472366f2936fcdccf817c19e099ddcac35bbb757db0aac2b9ab78b9f4941ee2e3943b6523b7e5663d66db49e5a876a5a98a277532fcb568ce60b0d46daae1eafff4a3b7aaee215389cd2ec9b12fb5960d2e13cdf9da4fb8cea36c3d8faba4c8d8ab7f276cceb38df9015fd0d00154e0c5fb0484e2bfc9be37591359f15391bc90eb2921d6e5377abcf436e22e676042828913ae6c5310aba6f55fdc9b8936dd57d588e794db4aa547ebc9eca6962129c840e1672354228502ff574c29be9b3fb321689ed1e9a886cb5dbb3c7f8265ac35037c0ddb2cecc8e353925bea141078996fead1525e3e43d80e3757cf539a3863e1155c6b9984f6229051b165711705a52dfeefea198ae37d3b87bbc43533c781bed9222e715e61f35169af220cb76abcaaa8bc2b8751ae5634e9b2df5ab707ca9d7486c93d142d4be12fb5feb7a21169b9b0f20a75583bfa97eb7f36680795ef895675baefc8469bc5add5c85e95757d5ef8ca25b1bcc2754752cff31b0b69db405b844a4f5b518e233c371f65deb5fe7ca1460467a358682964fea4b6dd82d8ced74e1fb9a3331e002b59ffcac0edcd126d6f81c04183714dd02e90f8b4c7deb911b51fa090c223292c5ad55aab804358e0ad52302fdcbde12af73092e90b4f98e43812d5975ad8849c8134bda4";
        $rcvdString = $this->xdecrypt($encryptedText,"C999793EEB3E6535C376302DF5928B87");
        parse_str($rcvdString, $decResponse);
        echo $decResponse['order_id'];
        echo $decResponse['status_message'];
        echo $decResponse['amount'];
        dd($decResponse);
        return $decResponse;
    }

    public function xdecrypt($encryptedText, $key)
    {
        $key = $this->xhextobin(md5($key));
        $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = $this->xhextobin($encryptedText);
        $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        return $decryptedText;
    }

    protected function xhextobin($hexString)
    {
        $length = strlen($hexString);
        $binString="";
        $count=0;
        while($count<$length)
        {
            $subString =substr($hexString,$count,2);
            $packedString = pack("H*",$subString);
            if ($count==0)
            {
                $binString=$packedString;
            }

            else
            {
                $binString.=$packedString;
            }

            $count+=2;
        }
        return $binString;
    }
    public function create()
    {
        //
    }

    public function storeDthDt(Request $request){

        // echo $request->mobileno;
        // echo $request->mobleRechargeAmount;
        Session::put('dthno', $request->dthno);
        Session::put('dthRechargeAmount', $request->dthRechargeAmount);
        Session::save();
        $data['dthno'] = Session::get('dthno');
        $data['dthRechargeAmount'] = Session::get('dthRechargeAmount');
        echo json_encode($data);
        dd();
    }
    public function storeMobileDt(Request $request){

        // echo $request->mobileno;
        // echo $request->mobleRechargeAmount;
        Session::put('mobileno', $request->mobileno);
        Session::put('mobleRechargeAmount', $request->mobleRechargeAmount);
        Session::save();
        $data['mobileno'] = Session::get('mobileno');
        $data['mobleRechargeAmount'] = Session::get('mobleRechargeAmount');
        echo json_encode($data);
        dd();
    }

    public function checkMobileDt(){
        $data['mobileno'] = Session::get('mobileno');
        $data['mobleRechargeAmount'] = Session::get('mobleRechargeAmount');
        echo json_encode($data);
        dd(session()->all());
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
