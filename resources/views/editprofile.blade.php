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
                                    <img class="avatar" src="./images/avatar.png" alt="">

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
                                              <label class="control-label col-sm-2" for="email">Your Address:</label>
                                              <div class="col-sm-10 ">
                                                <div class="under-line">
                                                    <p class="text-info">US</p>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-10">
                                                    <a href="{{ route('editprofile') }}" class="btn edit-btn">Edit Your Profile</a>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div id="security" class="tab-pane fade">
                                    <p>Some content in menu 1.</p>
                                </div>
                                <div id="wallet" class="tab-pane fade">
                                    <h3>Current Balance &#x20b9;{{ $walletBallance }}</h3>

                                    <form method="POST" action="{{ route('addmoney') }}">
                                        @csrf

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


                                        <div class="form-group row mb-0">
                                            <div class="col-md-8 text-center">
                                                <button type="submit" class="btn btn-default btn-login">
                                                    {{ __('Add Money') }}
                                                </button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

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


        </div>
    </div>
</div>
@endsection
