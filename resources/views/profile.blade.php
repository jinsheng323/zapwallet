@extends('layouts.layout')

@section('content')
<div class="wrapper">
    <div class="header header-filter" style="background-image: url('img/city.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="brand">
                        <h1>Profile</h1>
                        <h3>{{ $user->name }}
                            @if($user->isPhoneVerified == 1)
                                <i class="fa fa-check-circle" style="font-size: 18px; color: #4caf50;margin-left: 5px; position: absolute;"></i>
                            @else
                                <i class="fa fa-times-circle" style="font-size: 18px; color: red;margin-left: 5px; position: absolute;"></i>
                            @endif
                        </h3>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="main main-raised">
        <div class="section section-basic">

            <div class="container text-center">
                @if($user->phone)
                    @if($user->isPhoneVerified == 1)
                        <label class="btn btn-success">Your Phone is Verified</label>
                    @else
                        <a href="{{ URL('phoneVerify')}}" class="btn btn-danger">Please Verify Your Phone</a>
                    @endif
                @endif

            </div>

            <div class="container">
                <div class="profile">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="text-center">
                                    {{-- <img class="avatar" src="./images/avatar.png" alt=""> --}}

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 h-100">
                            <ul class="nav nav-pills nav-stacked p-tabs">
                                <li class="active"><a data-toggle="tab" href="#profile">Profile</a></li>
                                <li><a data-toggle="tab" href="#security">Security</a></li>
                                <li><a data-toggle="tab" href="#wallet">Wallet</a></li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content" style="min-height: 250px">
                                <div id="profile" class="tab-pane fade in active">
                                    <div class="p-container">
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">Your Name:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                    <p class="text-info">{{ $user->name }}

                                                    </p>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">Your Email:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                    <p class="text-info">{{ $user->email }}
                                                        @if($user->email_verified_at)
                                                        <i class="fa fa-check-circle" style="font-size: 12px; color: #4caf50;margin-left: 5px; position: absolute;"></i>
                                                        @else
                                                        <i class="fa fa-times-circle" style="font-size: 12px; color: red;margin-left: 5px; position: absolute;"></i>
                                                        @endif
                                                    </p>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">Phone Number:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                    <p class="text-info">{{ $user->phone }}
                                                        @if($user->isPhoneVerified == 1)
                                                            <i class="fa fa-check-circle" style="font-size: 12px; color: #4caf50;margin-left: 5px; position: absolute;"></i>
                                                        @else
                                                            <i class="fa fa-times-circle" style="font-size: 12px; color: red;margin-left: 5px; position: absolute;"></i>
                                                        @endif
                                                    </p>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">Date Of Birth:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                    <p class="text-info">{{ $user->dateOfBirth }}
                                                    </p>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">Address:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                    <p class="text-info">{{ $user->address }}
                                                    </p>
                                                </div>
                                              </div>
                                            </div>

                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">Address 2:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                    <p class="text-info">{{ $user->address2 }}
                                                    </p>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">Zip Code:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                    <p class="text-info">{{ $user->zipcode }}
                                                    </p>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">City:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                    <p class="text-info">{{ $user->city }}
                                                    </p>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">State:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                    <p class="text-info">{{ $user->state }}
                                                    </p>
                                                </div>
                                              </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-10">
                                                    <a data-toggle="tab" href="#editProfile" id="btneditProfile" class="btn edit-btn">Edit Your Profile</a>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div id="editProfile" class="tab-pane fade">
                                    <div class="p-container">
                                        <form method="POST" action="{{ route('updateprofile') }}">
                                            @csrf
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">Your Name:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">

                                                    <input id="name"  placeholder="name"  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">Your Email:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                    <p class="text-info">{{ $user->email }}
                                                        @if($user->email_verified_at)
                                                        <i class="fa fa-check-circle" style="font-size: 12px; color: #4caf50;margin-left: 5px; position: absolute;"></i>
                                                        @else
                                                        <i class="fa fa-times-circle" style="font-size: 12px; color: red;margin-left: 5px; position: absolute;"></i>
                                                        @endif
                                                    </p>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">Phone Number:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                <input id="phone"  placeholder="phone"  type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $user->phone }}" required autocomplete="phone" autofocus>

                                                @error('phone')
                                                <script>$('#btneditProfile').click()</script>
                                                    <span class="invalid-feedback text-danger" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">Date Of Birth:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                <input id="dateOfBirth"  placeholder="dateOfBirth"  type="text" class="form-control @error('dateOfBirth') is-invalid @enderror" name="dateOfBirth" value="{{ old('dateOfBirth') ?? $user->dateOfBirth }}"  autocomplete="dateOfBirth" autofocus>

                                                @error('dateOfBirth')
                                                <script>$('#btneditProfile').click()</script>
                                                    <span class="invalid-feedback text-danger" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">Address:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                <input id="address"  placeholder="address"  type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $user->address  }}"  autocomplete="address" autofocus>

                                                @error('address')
                                                <script>$('#btneditProfile').click()</script>
                                                    <span class="invalid-feedback text-danger" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">Address 2:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                <input id="address2"  placeholder="address2"  type="text" class="form-control @error('address2') is-invalid @enderror" name="address2" value="{{ old('address2') ?? $user->address2  }}"  autocomplete="address2" autofocus>

                                                @error('address2')
                                                <script>$('#btneditProfile').click()</script>
                                                    <span class="invalid-feedback text-danger" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">zipcode:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                <input id="zipcode"  placeholder="zipcode"  type="text" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ old('zipcode') ?? $user->zipcode }}"  autocomplete="zipcode" autofocus>

                                                @error('zipcode')
                                                <script>$('#btneditProfile').click()</script>
                                                    <span class="invalid-feedback text-danger" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">city:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                <input id="city"  placeholder="city"  type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') ?? $user->city }}"  autocomplete="city" autofocus>

                                                @error('city')
                                                <script>$('#btneditProfile').click()</script>
                                                    <span class="invalid-feedback text-danger" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label col-sm-2" for="email">state:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                <input id="state"  placeholder="state"  type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') ??$user->state }}"  autocomplete="state" autofocus>

                                                @error('state')
                                                <script>$('#btneditProfile').click()</script>
                                                    <span class="invalid-feedback text-danger" role="alert">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                                </div>
                                              </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-10">
                                                    <button  class="btn edit-btn">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="security" class="tab-pane fade">
                                    <p>Update PASSWORD</p>
                                    <form method="POST" action="{{ route('updatepassword') }}">
                                        @csrf
                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <input id="password"  placeholder="Password " type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            <div class="text-danger"><small>Minimum 8 characters, One capital letter, One special character, One number</small></div>

                                            @error('password')

                                            <script>
                                                $('#loginModal').modal('show');
                                                showRegisterForm();
                                            </script>

                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <input id="password-confirm" placeholder="Repeat Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10">
                                            <button  class="btn edit-btn">Change Password</button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                                <div id="wallet" class="tab-pane fade">
                                    <script
                                        async
                                        src="https://pay.google.com/gp/p/js/pay.js"
                                        onload="onGooglePayLoaded()">
                                    </script>
                                    <h3>Current Balance &#x20b9;{{ $walletBallance }}</h3>



                                        <div class="form-group row">

                                            <div class="col-md-8">
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
                                                        <input type="text" name="amount"  onkeyup="return excNumber()" class="form-control">
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


                                        {{-- <div class="form-group row mb-0">
                                            <div class="col-md-8 text-center">


                                                <div id="googlePayButton"></div>
                                            </div>
                                        </div> --}}

                                    {{-- <p id="gPayMessage"></p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
<script>
    const tokenizationSpec={
            type:'PAYMENT_GATEWAY',
            parameters:{
                gateway:'example',
                gatewayMerchantId:'gatewayMerchantId'
            }
        };
    const cardPaymentMethod={
            type: 'CARD',
            tokenizationSpecification: tokenizationSpec,
            parameters: {
                allowedCardNetworks: ['VISA', 'AMEX'],
                allowedAuthMethods: ['PAN_ONLY','CRYPTOGRAM_3DS'],
                billingAddressRequired: true,
                billingAddressParameters: {
                    format:'FULL',
                    phoneNumberRequired:true
                }
            }
        };
    const clientConfigurtion= {
            apiVersion:2,
            apiVersionMinor:0,
            allowedPaymentMethods: [cardPaymentMethod]
        };


    function onGooglePayLoaded() {


        // console.log('hello');
        const paymentsClient =
            new google.payments.api.PaymentsClient({environment: 'TEST'});

        paymentsClient.isReadyToPay(clientConfigurtion)
            .then(function(response) {
                console.log(response);
                if (response.result) {

                    const button =
                    paymentsClient.createButton({
                        buttonColor:'default',
                        buttonType:'long',
                        onClick: onGooglePaymentButtonClicked});
                    document.getElementById('googlePayButton').appendChild(button);
                }
            })
            .catch(function(err) {
            // show error in developer console for debugging
                console.error(err);
            });
        }

        function onGooglePaymentButtonClicked() {
            const paymentDataRequest = getGooglePaymentDataRequest();
            paymentDataRequest.transactionInfo = getGoogleTransactionInfo();

            const paymentsClient = getGooglePaymentsClient();
            paymentsClient.loadPaymentData(paymentDataRequest)
            .then(function(paymentData) {
                // handle the response
                processPayment(paymentData);
            })
            .catch(function(err) {
                // show error in developer console for debugging
                console.error(err);
            });
        }

        function getGooglePaymentDataRequest() {
            const paymentDataRequest = Object.assign({}, clientConfigurtion);
            paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
            paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
            paymentDataRequest.merchantInfo = {
                // @todo a merchant ID is available for a production environment after approval by Google
                // See {@link https://developers.google.com/pay/api/web/guides/test-and-deploy/integration-checklist|Integration checklist}
                // merchantId: '01234567890123456789',
                merchantName: 'Example Merchant'
            };
            return paymentDataRequest;
        }
        function getGoogleTransactionInfo() {
            return {
                countryCode: 'US',
                currencyCode: 'USD',
                totalPriceStatus: 'FINAL',
                // set to cart total
                totalPrice: '1.00'
            };
        }
        function getGooglePaymentsClient() {

                paymentsClient = new google.payments.api.PaymentsClient({environment: 'TEST'});

            return paymentsClient;
        }
        function processPayment(paymentData) {
        // show returned data in developer console for debugging


        document.getElementById('gPayMessage').append(JSON.stringify(paymentData));
            console.log(paymentData);
        // @todo pass payment token to your gateway to process payment
            paymentToken = paymentData.paymentMethodData.tokenizationData.token;
        }
</script>
<style>
    .p-container label {
        font-weight: 500!important;
        line-height: normal!important;
        font-size: 12px!important;
        letter-spacing: 0.03em;
        text-transform: capitalize;
        color: #4F4F4F!important;
        margin-top: 0!important;
    }
    .form-group {
        padding-top: 15px;
    }

.text-content {
    background: #FFFFFF;
    box-shadow: 0px 0px 30px rgba(194, 118, 50, 0.1);
    border-radius: 19px;
    float: left;
    padding: 10px;
    max-width: 90%
}

.comment {
    margin-bottom: 15px
}

.c-text textarea {
    background: #FFFFFF;
    box-shadow: 0px 0px 30px rgba(194, 118, 50, 0.1);
    border-radius: 39px;
    padding: 10px;
    width: 70%;
    float: left
}

.c-text a {
    display: inline-block;
    padding: 20px
}

.c-text a img {
    width: 40px
}

.edit-btn {
    width: 225px;
    background: #FF993C;
    border-radius: 18px;
    color: #FFFFFF;
    margin-top: 30px;
    border: solid 1px #FF993C
}

.edit-btn:hover {
    background: #FFFFFF;
    transition: .5s;
    color: #FF993C
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

    $(function () {
        $('#dateOfBirth').datepicker({  dateFormat: "yy-mm-dd"});
    });

</script>

        </div>
    </div>
</div>
@endsection
