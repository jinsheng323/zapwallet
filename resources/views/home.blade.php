@extends('layouts.layout')

@section('content')
<div class="wrapper">
    <div class="header header-filter" style="background-image: url('img/city.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="brand">
                        <h1>Zap Wallet.</h1>
                        <h3>Recharge on the go!</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="main main-raised">
        <div class="section section-basic">
            <div class="container">
                <div class="col-lg-6 recharge-content">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2 class="k-large-header">Latest Coupons</h2>
                    </div>
                    <div class="coupon__content">
                        <ul>
                            <li>
                                <div class="col-sm-5">
                                    <span>FIRSTCHARGE</span>
                                </div>
                                <div class="col-sm-7">
                                    Offer for you just recharge for Re.1 but get Rs.100 balance
                                </div>
                            </li>
                            <li>
                                <div class="col-sm-5">
                                    <span>FIRSTCHARGE</span>
                                </div>
                                <div class="col-sm-7">
                                    Offer for you just recharge for Re.1 but get Rs.100 balance
                                </div>
                            </li>
                            <li>
                                <div class="col-sm-5">
                                    <span>FIRSTCHARGE</span>
                                </div>
                                <div class="col-sm-7">
                                    Offer for you just recharge for Re.1 but get Rs.100 balance
                                </div>
                            </li>
                            <li>
                                <div class="col-sm-5">
                                    <span>FIRSTCHARGE</span>
                                </div>
                                <div class="col-sm-7">
                                    Offer for you just recharge for Re.1 but get Rs.100 balance
                                </div>
                            </li>
                            <li>
                                <div class="col-sm-5">
                                    <span>FIRSTCHARGE</span>
                                </div>
                                <div class="col-sm-7">
                                    Offer for you just recharge for Re.1 but get Rs.100 balance
                                </div>
                            </li>
                            <li>
                                <div class="col-sm-5">
                                    <span>FIRSTCHARGE</span>
                                </div>
                                <div class="col-sm-7">
                                    Offer for you just recharge for Re.1 but get Rs.100 balance
                                </div>
                            </li>
                            <li>
                                <div class="col-sm-5">
                                    <span>FIRSTCHARGE</span>
                                </div>
                                <div class="col-sm-7">
                                    Offer for you just recharge for Re.1 but get Rs.100 balance
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-nav-tabs">
                        <div class="header header-info text-center">
                            <h4>Quick Recharge</h4>
                            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="active">
                                            <a href="#mobile" data-toggle="tab" aria-expanded="true">
                                                <!-- <i class="material-icons">face</i> -->
                                                <img src="/img/mobile.png" style="height: 30px;">
                                                <h2>Mobile</h2>
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                        {{-- <li class="">
                                            <a href="#datacard" data-toggle="tab" aria-expanded="false">
                                                <img src="/img/datacard.png" style="height: 30px;">
                                                <h2>Datacard</h2>
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li> --}}
                                        <li class="">
                                            <a href="#dth" id="dtht" data-toggle="tab" aria-expanded="false">
                                                <img src="/img/dth.png" style="height: 30px;">
                                                <h2>DTH</h2>
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                        <!-- style="display:none;" -->
                                        <li class="" >
                                            <a href="#bus" data-toggle="tab" aria-expanded="false">
                                                <img src="/img/bus.png" style="height: 30px;">
                                                <h2>Bus</h2>
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="#wallet" data-toggle="tab" aria-expanded="false">
                                                <img src="/img/wallet.png" style="height: 30px;">
                                                <h2>Wallet</h2>
                                                <div class="ripple-container"></div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="tab-content text-center">
                                <div class="tab-pane active" id="mobile">
                                    <!--<form method="POST" action="{{ route('joloapiRecharge') }}">-->
                                    <form method="POST" action="{{ route('checkoutMobile') }}">
                                        @csrf
                                        <div class="col-sm-3 col-sm-offset-3" style="display: none">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" id="PREPAID"  class="radio-default" name="optionsRadios" checked="checked" value="prepaid">
                                                    Prepaid
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3" style="display: none">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" id="POSTPAID"  class="radio-default" name="optionsRadios" value="postpaid">
                                                    Postpaid
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label" style="text-transform: capitalize;">Enter your mobile number</label>
                                                <input type="text" id="mobileno" maxlength="10"  onkeyup="return excNumber()" onkeypress="return isNumberKey(event);"  name="mobile" class="form-control" value="{{ session('mobileno') ?? '' }}" required="required">
                                                <p id="errornumber" class="text-danger" style="display: none"></p>
                                                <span class="material-input"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label operator_lab" style="text-transform: capitalize;">Select your Operator</label>
                                                <select class="form-control" id="operator" name="operator" required="required">
                                                    <option disabled="" selected=""></option>
                                                    <option>Airtel</option>
                                                    <option>Vodafone</option>
                                                    <option>Idea</option>
                                                    <option>Aircel</option>
                                                    <option>Jio</option>
                                                    <option>Reliance</option>
                                                </select>
                                                <span class="material-input"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label operator_lab" style="text-transform: capitalize;">Select your Circle</label>
                                                <select class="form-control" id="circle" >
                                                    <option disabled="" selected=""></option>
                                                    <option>Tamil Nadu</option>
                                                    <option>Andhra Pradesh</option>
                                                    <option>Kerala</option>
                                                    <option>Karnataka</option>
                                                </select>
                                                <span class="material-input"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label" style="text-transform: capitalize;">Enter Recharge Amount</label>
                                                <input type="number" name="amount" id="mobleRechargeAmount" onkeypress="return isNumberKey(event)" value="{{ session('mobleRechargeAmount') ?? '' }}" class="form-control" required="required">
                                                <span class="material-input"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">

                                            <a class="btn btn-info" style="margin-top: 20px;"  data-toggle="modal" href="javascript:void(0)" onclick="openMobilePlan();">
                                                View Plans
                                            </a>
                                        </div>
                                        <div class="col-sm-12" id="customer_name_holder" style="display: none">
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label" style="text-transform: capitalize;">Enter Customer Name</label>
                                                <input type="text" name="customer_name" id="customer_name"  class="form-control" >
                                                <span class="material-input"></span>
                                            </div>
                                            <div class="form-group label-floating is-empty">
                                                <label class="control-label" style="text-transform: capitalize;">Enter Customer Account Number</label>
                                                <input type="text" name="customer_number" id="customer_number"  class="form-control" >
                                                <span class="material-input"></span>
                                            </div>

                                        </div>
                                        <div class="col-sm-12" id="btn_recharge">
                                            @guest
                                            <button class="btn btn-success btn-lg"  id="recharge_nologin" style="width: 100%; margin-top: 20px;">Recharge Now</button>
                                            {{-- onclick='xopenLoginModal(event);' --}}
                                            @else
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <button class="btn btn-success btn-lg" style="width: 100%; margin-top: 20px;">Recharge Now</button>
                                            @endguest
                                            <p id="prepaidOnly" class="text-center btn btn-danger" style="display: none"></p>
                                            <div class="modal fade" id="planMobileDetail">
                                                <div class="modal-dialog  modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title">Avaialble moible plan</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="showplan"></div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="dth">
                                    <form method="POST" action="{{ route('checkoutDTH') }}">
                                        @csrf
                                    <div class="col-sm-12">
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label" style="text-transform: capitalize;">Enter your DTH number</label>
                                            <input type="text" name="dthid" id="dthno" maxlength="10"  onkeyup="return excNumberDth()"  value="{{ session('dthno') ??'' }}" onkeypress="return isNumberKey(event)"  class="form-control" required="required">
                                            <p id="errorDth" class="text-danger" style="display: none"></p>
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label" style="text-transform: capitalize;">Select your Operator</label>
                                            <select class="form-control" id="dthOperator" name="operator" required="required">
                                                <option disabled="" selected=""></option>
                                                <option>Airtel</option>
                                                <option>Vodafone</option>
                                                <option>Idea</option>
                                                <option>Aircel</option>
                                                <option>Jio</option>
                                                <option>Reliance</option>
                                            </select>
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" style="display: none;">
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label operator_lab" style="text-transform: capitalize;">Select your Circle</label>
                                            <select class="form-control" id="dthCircle" >
                                                <option disabled="" selected=""></option>
                                                <option>Tamil Nadu</option>
                                                <option>Andhra Pradesh</option>
                                                <option>Kerala</option>
                                                <option>Karnataka</option>
                                            </select>
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label" style="text-transform: capitalize;">Enter Recharge Amount</label>
                                            <input type="number" name="amount" id="dthRechargeAmount" onkeypress="return isNumberKey(event)" class="form-control" required="required" value="{{ session('dthRechargeAmount') ??'' }}">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">

                                        <a class="btn btn-info" style="margin-top: 20px;"  data-toggle="modal" href="javascript:void(0)" onclick="openDthPlan();">
                                            View Plans
                                        </a>
                                    </div>
                                    <div class="col-sm-12">

                                        @guest
                                        <button class="btn btn-success btn-lg" id="rechargeDth_nologin" style="width: 100%; margin-top: 20px;">Recharge Now</button>

                                        @else
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <button class="btn btn-success btn-lg" style="width: 100%; margin-top: 20px;">Recharge Now</button>
                                        @endguest
                                        <div class="modal fade bd-example-modal-lg" id="planDthDetail">
                                            <div class="modal-dialog  modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title">Avaialble DTH plan</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="dthShowplan"></div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="bus">
                                    <form method="POST" action="{{ route('busSearch') }}">
                                        @csrf
                                            <div class="col-sm-12">
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating is-empty">
                                                        <label class="control-label" style="text-transform: capitalize;">Starting City (*)</label>
                                                        <input type="text" name="from_city" id="from_city"  class="form-control"  required="required" >
                                                        <input type="hidden" name="from_city_id" id="from_city_id">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating is-empty">
                                                        <label class="control-label" style="text-transform: capitalize;">Destination City (*)</label>
                                                        <input type="text" name="to_city" id="to_city"  class="form-control" required="required"  >
                                                        <input type="hidden" name="to_city_id" id="to_city_id">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating is-empty">
                                                        <label class="control-label" style="text-transform: capitalize;">Departure Date (*)</label>
                                                        <input type="text" name="d_date" id="d_date"  class="form-control" required="required" >
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating is-empty">
                                                        <label class="control-label" style="text-transform: capitalize;">Return Date (optional)</label>
                                                        <input type="text" name="r_date" id="r_date"  class="form-control"  >
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
												
													<button @if(!isset(Auth::user()->id)) type="button" onclick="javascript:openLoginModalFrm();" @endif class="btn btn-success btn-lg" style="width: 100%; margin-top: 20px;">Search Bus</button>
												</div>
                                    </form>

                                </div>
                                <div class="tab-pane" id="wallet">
                                    <form method="POST" action="{{ route('ccAddMoney') }}">
                                        @csrf
                                    <div class="col-sm-4">
                                        <h2>&#x20b9;
                                            {{ $walletBallance }}
                                            <span>Your Wallet Balance</span></h2>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group label-floating is-empty">
                                            <label class="control-label" style="text-transform: capitalize;">Add amount to wallet</label>
                                            <input type="number" name="amount"  onkeyup="return excNumber()" class="form-control">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        @guest
                                        <button class="btn btn-success btn-lg" onclick='xopenLoginModal(event);' style="width: 100%; margin-top: 20px;">ADD MONEY</button>

                                        @else
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <button class="btn btn-success btn-lg" style="width: 100%; margin-top: 20px;">ADD MONEY</button>
                                        @endguest
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 recharge-content">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2 class="k-large-header">Recharge in 3 simple steps</h2>
                    </div>
                    <div class="col-lg-12 recharge-steps">
                        <div class="col-sm-4 steps">
                            <img src="/img/step-1.png">
                            <h3 class="k-header">Login</h3>
                            <p class="k-paragraph">Sign up or save time by logging in through Facebook, Google or LinkedIn.</p>
                        </div>
                        <div class="col-sm-4 steps">
                            <img src="/img/step-2.png">
                            <h3 class="k-header">Enter recharge details</h3>
                            <p class="k-paragraph">Provide your number, operator, circle and recharge amount details.</p>
                        </div>
                        <div class="col-sm-4 steps">
                            <img src="/img/step-3.png">
                            <h3 class="k-header">Pay & Recharge</h3>
                            <p class="k-paragraph">Payment gateway integrated means, pay with just a click!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
            function isNumberKey(evt)
                {
                    var charCode = (evt.which) ? evt.which : event.keyCode
                    if (charCode > 31 && (charCode < 48 || charCode > 57))
                        return false;

                    return true;
                }

                function excNumber(){
                    var number=$('#mobileno').val();
                    console.log(number.length);
                    console.log(number);
                    if(number.length==10){
                        ajaxCallMobileNumb()
                    }
                }
                @if(session('mobileno'))
                    excNumber();
                @endif
                function ajaxCallMobileNumb(){
                        $('#errornumber').hide();
                    var error_email = '';
                    var mobile = $('#mobileno').val();

                    var _token = $('input[name="_token"]').val();
                    if(mobile.length==10){
                        $.ajax({
                            url:"{{ route('getOperator') }}",
                            method:"POST",
                            data:{mobile:mobile, _token:_token},
                            success:function(result)
                            {
                                console.log(result);
                                $('.operator_lab').hide();
                                $('#operator').html('<option value='+result.operator_code+'>'+result.operator_name+'</option>')
                                $('#circle').html('<option value='+result.circle_code+'>'+result.circle_name+'</option>')
                                if(result.current_type=="PREPAID"){
                                    $('#PREPAID').prop('checked', true);
                                    $('#customer_name_holder').hide();
                                    $('#customer_name').removeAttr('required')
                                    $('#customer_number').removeAttr('required')
                                    $('#btn_recharge button').show()
                                    $('#prepaidOnly').text('').hide();
                                $('#showplan').html('');

                                $.ajax({

                                    url:"{{ route('getPlan') }}",
                                    method:"POST",
                                    data:{circle_code:result.circle_code,operator_code:result.operator_code, _token:_token},
                                    success:function(result)
                                    {
                                        $('#showplan').html(result);
                                        $("#mobleRechargeAmount").focus();
                                    }
                                });
                            }
                                if(result.current_type=='POSTPAID'){
                                    $('#btn_recharge button').hide()
                                    $('#mobileno').focus().val('');
                                    $('#POSTPAID').prop('checked', true);
                                    // $('#customer_name_holder').show();
                                    $('#customer_name').attr('required','required')
                                    $('#customer_number').attr('required','required')
                                    $('#showplan').html('No Plan for POST PAID NUMBER');
                                    $('#prepaidOnly').text('Prepaid Only').show();
                                }
                            }
                        });
                    }else{
                        $('#errornumber').show().text('10 digit Mobile Number');
                        $('#mobileno').focus();
                        console.log('10 digit mobile number');
                    }

                }

                function excNumberDth(){
                    var number=$('#dthno').val();
                    console.log(number.length);
                    console.log(number);
                    if(number.length==10){
                        ajaxCallDthNumb()
                    }
                }

                function ajaxCallDthNumb(){
                    $('#errorDth').hide();
                    var error_email = '';
                    var mobile = $('#dthno').val();
                    var _token = $('input[name="_token"]').val();
                    if(mobile.length==10){

                        $.ajax({
                            url:"{{ route('getDthOperator') }}",
                            method:"POST",
                            data:{mobile:mobile, _token:_token},
                            success:function(result)
                            {
                                console.log(result);
                                $('.operator_lab').hide();
                                $('#dthOperator').html('<option>'+result.operator_name+'</option>')
                                $('#dthCircle').html('<option>'+result.circle_name+'</option>')

                                $('#dthShowplan').html('');


                                $.ajax({
                                    url:"{{ route('getDthPlan') }}",
                                    method:"POST",
                                    data:{circle_code:result.circle_code,operator_code:result.operator_code, _token:_token},
                                    success:function(result)
                                    {

                                        $('#dthShowplan').html(result);
                                        $("#dthRechargeAmount").focus()
                                    }
                                });

                            }
                        });
                    }else{
                        $('#errorDth').show().text('10 digit DTH ID');
                        $('#mobileno').focus();
                        console.log('10 digit DTH ID');
                    }
                }

                function openMobilePlan(){
                    setTimeout(function(){
                        $('#planMobileDetail').modal('show');
                        // $('.modal-backdrop').removeClass('in');
                    }, 230);
                }
                function openDthPlan(){
                    setTimeout(function(){
                        $('#planDthDetail').modal('show');
                        // $('.modal-backdrop').removeClass('in');
                    }, 230);
                }

        $(document).ready(function(){


            @if(session('dthno'))
                    excNumberDth();
                    $('#dtht').trigger( "click" )
                @endif

            $('#recharge_nologin').click(function(event){
                event.preventDefault();
                var mobileno =$('#mobileno').val();
                var _token = $('input[name="_token"]').val();
                var mobleRechargeAmount =$('#mobleRechargeAmount').val();
                $.ajax({
                    url:"{{ route('storeMobileDt') }}",
                    method:"POST",
                    data:{mobileno:mobileno,mobleRechargeAmount:mobleRechargeAmount, _token:_token},
                    success:function(result)
                    {
                        console.log(result);
                        xopenLoginModal(event);
                    }
                });
            });
            $('#rechargeDth_nologin').click(function(event){
                event.preventDefault();
                var dthno =$('#dthno').val();
                var _token = $('input[name="_token"]').val();
                var dthRechargeAmount =$('#dthRechargeAmount').val();
                $.ajax({
                    url:"{{ route('storeDthDt') }}",
                    method:"POST",
                    data:{dthno:dthno,dthRechargeAmount:dthRechargeAmount, _token:_token},
                    success:function(result)
                    {
                        console.log(result);
                        xopenLoginModal(event);
                    }
                });
            });
            $('#mobileno').blur(function(){
                // console.log('hi');

                ajaxCallMobileNumb();
            });

            $('#dthno').blur(function(){
                // console.log('hi');
                ajaxCallDthNumb();
            });

        });

    function xopenLoginModal(e){
        e.preventDefault();

    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');
    }, 230);

}
    </script>
    <style>.modal-backdrop {
        z-index: -1;
      }</style>




{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript">
        var path = "{{ route('autocomplete') }}";
        // $('#to_city').typeahead({
        //     source:  function (query, process) {
        //     return $.get(path, { query: query }, function (data) {
        //         console.log(data);
        //             return process(data);
        //         });
        //     }
        // });
        $('#to_city').autocomplete({
            source:  function (query, reponse) {

                $.ajax({
                    url : "{{ route('autocomplete') }}",
                    dataType : 'json',
                    data : {"query": query.term },
                    success : function(donnee){

                        reponse($.map(donnee, function(objet){

                            return {
                                label: objet.city,
                                value: objet.cityId
                                };
                        }));

                    }
                });
            },

            minLength: 3,
            delay:0,

            select: function( event, ui ) {
                $(' #to_city ' ).val( ui.item.label );
                $(' #to_city_id ').val( ui.item.value );
                return false;
            } ,

            messages: {
                noResults: '',
                results: function() {}
            }
        });
        $('#from_city').autocomplete({
            source:  function (query, reponse) {

                $.ajax({
                    url : "{{ route('autocomplete') }}",
                    dataType : 'json',
                    data : {"query": query.term },
                    success : function(donnee){

                        reponse($.map(donnee, function(objet){

                            return {
                                label: objet.city,
                                value: objet.cityId
                                };
                        }));

                    }
                });
            },

            minLength: 3,
            delay:0,

            select: function( event, ui ) {
                $(' #from_city ' ).val( ui.item.label );
                $(' #from_city_id ').val( ui.item.value );
                return false;
            } ,

            messages: {
                noResults: '',
                results: function() {}
            }
        });
        // $('#from_city').typeahead({
        //     source:  function (query, process) {
        //     return $.get(path, { query: query }, function (data) {
        //         console.log(data);
        //             return process(data);
        //         });
        //     }
        // });

        $(function () {
                $('#d_date').datepicker({  dateFormat: "yy-mm-dd", minDate: 0  });
                $('#r_date').datepicker({  dateFormat: "yy-mm-dd" , minDate: 0 });
        });
    </script>
</div>
@endsection
