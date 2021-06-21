<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Transaction;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['auth', 'verified']);

    }

    public function index()
    {
        $role=Auth::user()->role;
        if($role !='admin'){
            return redirect('/home')->with('fail','You are not allow to visit admin part');
        }
		return view('admin.dashboard');
    }

    public function users()
    {
        $role=Auth::user()->role;
        if($role !='admin'){
            return redirect('/home')->with('fail','You are not allow to visit admin part');
        }
		$data['users'] = User::where(array('role'=>'subscriber'))->get()->toArray();
		//dd($data);
		return view('admin.users',$data);
    }
	
    public function transaction()
    {
        $role=Auth::user()->role;
        if($role !='admin'){
            return redirect('/home')->with('fail','You are not allow to visit admin part');
        }
		
		$res = User::where(array('role'=>'subscriber'))->get()->toArray();
		$users = array();
		foreach($res as $val){
			$users[$val['id']] = $val;
		}
		$data['users'] = $users;
		$data['transaction'] = Transaction::orderBy('id','desc')->get()->toArray();
		//dd($data);
		return view('admin.transaction',$data);
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
