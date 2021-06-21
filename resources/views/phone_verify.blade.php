@extends('layouts.layout')

@section('content')
<div class="wrapper">
    <div class="header header-filter" style="background-image: url('img/city.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="brand">
                        <h1>Zap Wallet.</h1>
                        <h3>Verify Your Phone!</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="main main-raised">
        <div class="section section-basic">
            <div class="container">
                <div class="col-sm-6 col-sm-offset-3" style="border: 2px solid #d0cece;padding: 15px;border-radius: 5px;">
                    <h2 class="text-center">Verify your phone</h2>
                 <form action="{{ URL::to('/codeCheck')}}" method="post">

                    {{csrf_field()}}

                  <div class="from-group mb-3">
                    <div class="col-sm-12"> <label for="inlineFormInputGroup"><strong style="color: red;">*</strong> Phone Verification Code</label></div>
                    <div class="input-group col-sm-12">


                      <input name="opt_code" type="number" class="form-control field-validate" id="opt_code" placeholder="Please enter your verification code">
                      <span class="help-block" hidden>Please enter your verification code</span>
                    </div>
                  </div>
                      <div class=" col-sm-6 col-sm-offset-3">
                          <button type="submit" class="btn btn-primary form-control">Verify</button>
                      </div>

                </form>





                </div>

                <div class="col-lg-12 recharge-content">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h2 class="k-large-header">Recharge in 3 simple steps</h2>
                    </div>
                    <div class="col-lg-12 recharge-steps">
                        <div class="col-sm-4 steps">
                            <img src="img/step-1.png">
                            <h3 class="k-header">Login</h3>
                            <p class="k-paragraph">Sign up or save time by logging in through Facebook, Google or LinkedIn.</p>
                        </div>
                        <div class="col-sm-4 steps">
                            <img src="img/step-2.png">
                            <h3 class="k-header">Enter recharge details</h3>
                            <p class="k-paragraph">Provide your number, operator, circle and recharge amount details.</p>
                        </div>
                        <div class="col-sm-4 steps">
                            <img src="img/step-3.png">
                            <h3 class="k-header">Pay & Recharge</h3>
                            <p class="k-paragraph">Payment gateway integrated means, pay with just a click!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
