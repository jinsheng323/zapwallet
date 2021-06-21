@extends('layouts.layout')

@section('content')
<div class="wrapper">
    <div class="header header-filter" style="background-image: url('img/city.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="brand">
                        <h1>Get Operator</h1>

                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="main main-raised">
        <div class="section section-basic">

            <div class="container text-center">

                <div class="col-sm-12">

                    <form method="POST" action="{{ route('getOperator') }}">
                            @csrf

                    <span>Mobile Number :</span>
                    <input type="text" name="mobile" id="mobile" />
                    <span style="display:none;" id="mobno_err_span">Please enter a valid mobile number.</span>

                    <br/><br/>

                    <span>Choose Operator :</span>
                    <select name="sel_opereator" id="sel_opereator">
                    <option value="">Select</option>
                                <option value="28">Airtel</option>
                                <option value="1">Aircel</option>
                                <option value="3">BSNL</option>
                                <option value="24">BSNL Special</option>
                                <option value="8">Idea</option>
                                <option value="22">Vodafone</option>
                                <option value="17">Docomo GSM</option>
                                <option value="25">Docomo GSM Special</option>
                                <option value="18">Docomo CDMA (Indicom)</option>
                                    <option value="13">Reliance GSM</option>
                                <option value="12">Reliance CDMA</option>
                        <option value="10">MTS</option>
                                <option value="19">Uninor</option>
                                <option value="26">Uninor Special</option>
                                <option value="9">Loop Mobile</option>
                                <option value="5">Videocon</option>
                                <option value="27">Videocon Special</option>
                                <option value="6">MTNL Mumbai</option>
                                <option value="7">MTNL Mumbai Special</option>
                                <option value="20">MTNL Delhi</option>
                                <option value="21">MTNL Delhi Special</option>
                                <option value="30">Tata Walky</option>
                    </select>


                    <br/><br/>


                    <span>Choose Circle :</span>
                    <select name="sel_circle" id="sel_circle">
                    <option value="">Select</option>
                            <option value="5">Andhra Pradesh</option>
                    <option value="19">Assam</option>
                    <option value="17">Bihar & Jharkhand</option>
                    <option value="23">Chennai</option>
                    <option value="1">Delhi/NCR</option>
                    <option value="8">Gujarat</option>
                    <option value="16">Haryana</option>
                    <option value="21">Himachal Pradesh</option>
                    <option value="22">Jammu & Kashmir</option>
                    <option value="7">Karnataka</option>
                    <option value="14">Kerala</option>
                    <option value="3">Kolkata</option>
                    <option value="4">Maharashtra</option>
                    <option value="10">Madhya Pradesh</option>
                    <option value="2">Mumbai</option>
                    <option value="20">North East</option>
                    <option value="18">Orissa</option>
                    <option value="15">Punjab</option>
                    <option value="13">Rajasthan</option>
                    <option value="6">Tamil Nadu</option>
                    <option value="9">Uttar Pradesh (E)</option>
                    <option value="11">Uttar Pradesh (W)</option>
                    <option value="12">West Bengal</option>

                    </select>

                    <div id="loading"><img src="loading.gif" /></div><br/>


                            <span>&nbsp;</span> <br/>
                            <input type="submit" class="button" value="Submit" />

                    <div id="operator-details"><label id="operator"></label><label id="circle" ></label></div>
                    </form>
                </div>


            </div>

            <script>
                $(document).ready(function(){

                 $('#mobile').blur(function(){
                  var error_email = '';
                  var mobile = $('#mobile').val();
                  var _token = $('input[name="_token"]').val();


                   $.ajax({
                    url:"{{ route('getOperator') }}",
                    method:"POST",
                    data:{mobile:mobile, _token:_token},
                    success:function(result)
                    {
                        console.log(result.circle_code);
                        console.log(result.current_type);
                        console.log(result.operator_code);


                    }
                   })

                 });

                });
                </script>


        </div>
    </div>
</div>
@endsection
