@extends('layouts.layout')

@section('content')
<div class="wrapper">
    <div class="header header-filter" style="background-image: url('../img/city.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="brand">
                        <h1>Zap Wallet.</h1>
                        <h3>Checkout</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--<div class="main main-raised">-->
    <!--    <div class="section section-basic">-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
    <!--                <div class="col-sm-9">-->
    <!--                    <h3>Checkout Detail</h3>-->
    <!--                    <hr>-->
    <!--                    <table class="table table-bordered">-->
    <!--                        <tr>-->
    <!--                            <th>SL</th>-->
    <!--                            <th>Type</th>-->
    <!--                            <th>Number</th>-->
    <!--                            <th>Amount</th>-->
    <!--                        </tr>-->
    <!--                        <tr>-->
    <!--                            <td>1.</td>-->
    <!--                            <td>{{ $type }}</td>-->
    <!--                            <td>{{ $number }}</td>-->
    <!--                            <td>{{ $amount }}</td>-->
    <!--                        </tr>-->
    <!--                    </table>-->
    <!--                </div>-->
    <!--                <div class="col-sm-3">-->
    <!--                    <h3>Proceed</h3>-->
    <!--                    <hr>-->
    <!--                    Your Current Balance: {{ $walletBallance }}-->

    <!--                    @if($haveBlance=="OK")-->

    <!--                        <form method="POST" action="{{ route('joloapiRecharge') }}">-->

    <!--                        @csrf-->

    <!--                        <input type="hidden" name="optionsRadios" value="{{ $optionsRadios }}">-->
    <!--                        <input type="hidden" name="mobile" value="{{ $mobile }}">-->
    <!--                        <input type="hidden" name="operator" value="{{ $operator }}">-->
    <!--                        <input type="hidden" name="amount" value="{{ $amount }}">-->
    <!--                        <input type="hidden" name="user_id" value="{{ $user_id }}">-->


    <!--                        <div class="col-sm-12" id="btn_recharge">-->
    <!--                              <button class="btn btn-success btn-lg" style="width: 100%; margin-top: 20px;">Recharge Now</button>-->
    <!--                        </div>-->
    <!--                    </form>-->
    <!--                    @else-->
    <!--                        <h3>You dont have enough balance to rechage</h3>-->
    <!--                        <p>Please recharege</p>-->
    <!--                    @endif-->
    <!--                </div>-->
    <!--            </div>-->

    <!--        </div>-->
    <!--        <div class="container">-->

    <!--            <div class="col-lg-12 recharge-content">-->
    <!--                <div class="col-lg-12 col-md-12 col-sm-12">-->
    <!--                    <h2 class="k-large-header">Recharge in 3 simple steps</h2>-->
    <!--                </div>-->
    <!--                <div class="col-lg-12 recharge-steps">-->
    <!--                    <div class="col-sm-4 steps">-->
    <!--                        <img src="{{ env('APP_URL') }}/img/step-1.png">-->
    <!--                        <h3 class="k-header">Login</h3>-->
    <!--                        <p class="k-paragraph">Sign up or save time by logging in through Facebook, Google or LinkedIn.</p>-->
    <!--                    </div>-->
    <!--                    <div class="col-sm-4 steps">-->
    <!--                        <img src="{{ env('APP_URL') }}/img/step-2.png">-->
    <!--                        <h3 class="k-header">Enter recharge details</h3>-->
    <!--                        <p class="k-paragraph">Provide your number, operator, circle and recharge amount details.</p>-->
    <!--                    </div>-->
    <!--                    <div class="col-sm-4 steps">-->
    <!--                        <img src="{{ env('APP_URL') }}/img/step-3.png">-->
    <!--                        <h3 class="k-header">Pay & Recharge</h3>-->
    <!--                        <p class="k-paragraph">Payment gateway integrated means, pay with just a click!</p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div> -->


    <div class="main main-raised">
        <div class="section section-basic">
            <div class="container">
            <div class="col-lg-6">
                <div class="card card-nav-tabs">
                    <div class="header header-info text-center">
                        <h4>Order Summary</h4>
                         <!--colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="tab-content text-center">
                            <div class="tab-pane active" id="mobile">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <h4>Mobile<span>Recharge Type</span></h4>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <h4>&#x20b9; {{$amount}} <span>Recharge Amount</span></h4>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <h4>{{$operator}}<span>Operator</span></h4>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <h4>Tamil Nadu<span>Circle</span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card card-nav-tabs">
                    <div class="header header-info text-center">
                        <h4>Cashback</h4>
                         <!--colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <div class="tab-content text-center">
                            <div class="tab-pane active" id="mobile">
                                <form method="POST" action="{{ route($formurl) }}">
                                        @csrf
                                        
                                    <input type="hidden" name="optionsRadios" value="{{ $optionsRadios }}">
                                    <input type="hidden" name="mobile" value="{{ $mobile }}">
                                    <input type="hidden" name="operator" value="{{ $operator }}">
                                    <!--<input type="hidden" name="amount" value="{{ $amount }}">-->
                                    <!--<input type="hidden" name="user_id" value="{{ $user_id }}">-->
                            
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="amount" value="{{$amount}}" class="form-control">
                                    <div class="form-group label-floating is-empty">
                                        <label class="control-label" style="text-transform: capitalize;">Enter your coupon code</label>
                                        <input type="text" name="coupon_code" class="form-control">
                                        <span class="material-input"></span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <h4>&#x20b9; {{$walletBallance}} <span>Your Wallet Balance</span></h4>
                                    </div>
                                     <!--<div class="clearfix"></div> -->
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <h4>&#x20b9; {{$amount}} <span>Total Bill Amount</span></h4>
                                    </div>

                                    @if($walletBallance > 0)
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="checkbox" style="margin-left: -60px;">
                                            <label>
                                                <input type="checkbox" name="optionsCheckboxes">
                                                Use Wallet Balance?
                                            </label>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-sm-12">
                                        <button class="btn btn-success btn-lg" style="width: 100%; margin-top: 20px;">Pay Now</button>
                                    </div>
                                </form>
                            </div>
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
