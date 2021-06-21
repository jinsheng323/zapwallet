@extends('layouts.layout')

@section('content')
<div class="wrapper">
    <div class="header header-filter" style="background-image: url('{{ url('/img') }}/city.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="brand">
                        <h1>Zap Wallet.</h1>
                        <h3>Bus Search</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="main main-raised">
        <div class="section section-basic">
            <div class="container">
                <div class="col-sm-12">
                    <form method="POST" action="{{ route('busSearch') }}">
                        @csrf
                            <div class="col-sm-6">
                                <div class="col-sm-6">
                                    <div class="form-group ">
                                        <label class="control-label" style="text-transform: capitalize;">Starting City (*)</label>
                                        <input type="text" name="from_city" id="from_city"  class="form-control"  required="required" value="{{ $from_city ?? '' }}">
                                        <input type="hidden" name="from_city_id" id="from_city_id" value="{{ $from_city_id ?? '' }}">

                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group ">
                                        <label class="control-label" style="text-transform: capitalize;">Destination City (*)</label>
                                        <input type="text" name="to_city" id="to_city"  class="form-control" required="required"  value="{{ $to_city ?? ''}}">
                                        <input type="hidden" name="to_city_id" id="to_city_id" value="{{ $to_city_id ?? '' }}">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-6">
                                    <div class="form-group ">
                                        <label class="control-label" style="text-transform: capitalize;">Departure Date (*)</label>
                                        <input type="text" name="d_date" id="d_date"  class="form-control" required="required" value="{{ $d_date }}">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group ">
                                        <label class="control-label" style="text-transform: capitalize;">Return Date (optional)</label>
                                        <input type="text" name="r_date" id="r_date"  class="form-control"  value="{{ $r_date }}">
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-sm-offset-4">
								<button class="btn btn-success btn-lg" style="width: 100%; margin-top: 20px;">Search Bus</button>
                            </div>
                    </form>
                </div>
				
				
                <div class="col-sm-12">
                    <h2>Result</h2>
					<?php if(isset($myurl)){echo $myurl.'<hr>';}?>
					
					@if(isset($result->data->Buses))
						<table width="100%" style="margin-bottom:30px;" class="table">
							<thead>
								<th>Operator</th>
								<th>Trust Score</th>
								<th>Departure</th>
								<th>Duration</th>
								<th>Arrival</th>
								<th>Starting Price</th>
								<th></th>
							</thead>
							<tbody>
								@foreach($result->data->Buses as $val)
									<?php
										$CompanyName 	= '';
										if(isset($val->CompanyName)){
											$CompanyName 	= $val->CompanyName;
										}
										
										$Duration 	= '';
										if(isset($val->Duration)){
											$Duration 	= $val->Duration;
										}
										
										$PickupTime		= '';
										if(isset($val->Pickups[0]->PickupTime)){
											$PickupTime		= $val->Pickups[0]->PickupTime;
										}
										$DropoffTime		= '';
										if(isset($val->Dropoffs[0]->DropoffTime)){
											$DropoffTime		= $val->Dropoffs[0]->DropoffTime;
										}
										
										$DiscountAmt = 0;
										if(isset($val->DiscountAmt)){
											$DiscountAmt 	= $val->DiscountAmt;
										}
										
									?>
									<tr>
										<td>{{$CompanyName}}</td>
										<td></td>
										<td>{{$PickupTime}}</td>
										<td>{{$Duration}}</td>
										<td>{{$DropoffTime}}</td>
										<td>{{$DiscountAmt}}</td>
										<td>
											<input type="button" class="btn btn-sm btn-default" value="Select Seat" onclick="javascript:defaultTab();" >
											<?php //echo '<pre>';print_r($val);echo '</pre>';?>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						
						<div style="width:100%; display:none;" id="select_seat">
							<!-- Tab links -->
							<div class="tab">
							  <button class="tablinks" onclick="openCity(event, 'seatchart')" id="defaultOpen">Seat chart</button>
							  <button class="tablinks" onclick="openCity(event, 'pickup')">Pickup</button>
							  <button class="tablinks" onclick="openCity(event, 'dropoff')">Drop-off</button>
							  <button class="tablinks" onclick="openCity(event, 'passengerinfo')">Passenger info</button>
							  <button class="tablinks" onclick="openCity(event, 'yourinfo')">Your info</button>
							  <button class="tablinks" onclick="openCity(event, 'policies')">Policies</button>
							</div>

							<!-- Tab content -->
							<div id="seatchart" class="tabcontent">
								<h3>Seat chart</h3>
								<p>Lower berth - 15 seats available</p>
								<table width="400px;">
									<tr>
										<td><img src="/img/operator.png" width="10px;" /></td>
										<td>
											<input type="checkbox" name="seatID[]" value="1" style="display:none;" />
											<div class="busseat" id="lseat1" onclick="seatbook(1)" >5</div>
										</td>
										<td><div class="busseat" id="lseat2" onclick="seatbook(2)"  >5</div></td>
										<td><div class="busseat" id="lseat3" onclick="seatbook(3)"  >5</div></td>
										<td><div class="busseat" id="lseat4" onclick="seatbook(4)"  >5</div></td>
										<td><div class="busseat" id="lseat5" onclick="seatbook(5)"  >5</div></td>										
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td><div class="busseat" id="lseat6" onclick="seatbook(6)"  >5</div></td>
										<td><div class="busseat" id="lseat7" onclick="seatbook(7)"  >5</div></td>
										<td><div class="busseat" id="lseat8" onclick="seatbook(8)"  >5</div></td>
										<td><div class="busseat" id="lseat9" onclick="seatbook(9)"  >5</div></td>
										<td><div class="busseat" id="lseat10" onclick="seatbook(10)"  >5</div></td>										
									</tr>
									<tr>
										<td colspan="6">&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td><div class="busseat" id="lseat11" onclick="seatbook(11)"  >5</div></td>
										<td><div class="busseat" id="lseat12" onclick="seatbook(12)"  >5</div></td>
										<td><div class="busseat" id="lseat13" onclick="seatbook(13)" >5</div></td>
										<td><div class="busseat" id="lseat14" onclick="seatbook(14)"  >5</div></td>
										<td><div class="busseat" id="lseat15" onclick="seatbook(15)"  >5</div></td>										
									</tr>
								</table>
								<p>Upper berth - 15 seats available</p>
								<table width="400px;">
									<tr>
										<td>&nbsp;</td>
										<td><div class="busseat" id="useat1" onclick="useatbook(1)" >5</div></td>
										<td><div class="busseat" id="useat2" onclick="useatbook(2)"  >5</div></td>
										<td><div class="busseat" id="useat3" onclick="useatbook(3)"  >5</div></td>
										<td><div class="busseat" id="useat4" onclick="useatbook(4)"  >5</div></td>
										<td><div class="busseat" id="useat5" onclick="useatbook(5)"  >5</div></td>										
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td><div class="busseat" id="useat6" onclick="useatbook(6)"  >5</div></td>
										<td><div class="busseat" id="useat7" onclick="useatbook(7)"  >5</div></td>
										<td><div class="busseat" id="useat8" onclick="useatbook(8)"  >5</div></td>
										<td><div class="busseat" id="useat9" onclick="useatbook(9)"  >5</div></td>
										<td><div class="busseat" id="useat10" onclick="useatbook(10)"  >5</div></td>										
									</tr>
									<tr>
										<td colspan="6">&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td><div class="busseat" id="useat11" onclick="useatbook(11)"  >5</div></td>
										<td><div class="busseat" id="useat12" onclick="useatbook(12)"  >5</div></td>
										<td><div class="busseat" id="useat13" onclick="useatbook(13)" >5</div></td>
										<td><div class="busseat" id="useat14" onclick="useatbook(14)"  >5</div></td>
										<td><div class="busseat" id="useat15" onclick="useatbook(15)"  >5</div></td>										
									</tr>
								</table>
								<p>Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum .</p>
							</div>

							<div id="pickup" class="tabcontent">
							  <h3>Pickup</h3>
							  <p>Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum .</p>
							</div>

							<div id="dropoff" class="tabcontent">
							  <h3>Drop-off</h3>
							  <p>Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum .</p>
							</div>
							<div id="passengerinfo" class="tabcontent">
							  <h3>Passenger info</h3>
							  <p>Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum .</p>
							</div>
							<div id="yourinfo" class="tabcontent">
							  <h3>Your info</h3>
							  <p>Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum .</p>
							</div>
							<div id="policies" class="tabcontent">
							  <h3>Policies</h3>
							  <p>Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum Loren Ipsum .</p>
							</div>
							<style>
								/* Style the tab */
								.tab {
								  overflow: hidden;
								  border: 1px solid #ccc;
								  background-color: #f1f1f1;
								}

								/* Style the buttons that are used to open the tab content */
								.tab button {
								  background-color: inherit;
								  float: left;
								  border: none;
								  outline: none;
								  cursor: pointer;
								  padding: 14px 16px;
								  transition: 0.3s;
								}

								/* Change background color of buttons on hover */
								.tab button:hover {
								  background-color: #ddd;
								}

								/* Create an active/current tablink class */
								.tab button.active {
								  background-color: #ccc;
								}

								/* Style the tab content */
								.tabcontent {
								  display: none;
								  padding: 6px 12px;
								  border: 1px solid #ccc;
								  border-top: none;
								}
								
								.busseat {
								  margin:3px; border:1px solid #0F0; padding:3px; cursor:pointer;
								}							
							</style>
						</div>
						<div style="margin-bottom:30px;">&nbsp;</div>
					@else
						No Bus Found
					@endif					
					<?php //dd($result->data->Buses);
					/*?>
                    @forelse ($result ?? ''->data->Buses as $bus)
                        <p class="bg-danger text-white p-1">bus</p>
                    @empty
                        <p class="bg-danger text-white p-1">No bus available</p>
                    @endforelse

                    {{-- @php
                        var_dump($result ?? ''->data->Buses);
                    @endphp --}}*/?>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript">
        var path = "{{ route('autocomplete') }}";
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

        $(function () {
                $('#d_date').datepicker({  dateFormat: "yy-mm-dd", minDate: 0  });
                $('#r_date').datepicker({  dateFormat: "yy-mm-dd" , minDate: 0 });
        });
    </script>





</div>
@endsection
