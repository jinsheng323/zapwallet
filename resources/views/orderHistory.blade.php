@extends('layouts.layout')

@section('content')
<div class="wrapper">
    <div class="header header-filter" style="background-image: url('img/city.jpg');">

    </div>

    <div class="main main-raised">
        <div class="section section-basic">
            <div class="container">
				<div class="row owner">
				   	<div class="col-md-2 col-md-offset-5 col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3 text-center">
				        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
				            <div class="fileinput-new thumbnail img-circle img-no-padding" style="width: 150px; height: 150px;">
				                <img src="img/christian.jpg" alt="Circle Image">
				            </div>
				            <div class="fileinput-preview fileinput-exists thumbnail img-circle img-no-padding" style="max-width: 150px; max-height: 150px;"></div>
				            <div>
                            <h2>All Orders</h2>

				            </div>
				        </div>
				    </div>
				</div>
				<div class="profile-information" style="margin-top:5px;">
				<table width="100%">
                    <tbody>
                        <tr>
                            <td><b>Current Balance &#x20b9;{{ $walletBallance }}</b></td>
							<td class="text-center"><span onclick="javascript:window.location.href='/'"  class="btn btn-sm btn-default">Go Home</span></td>
							<td><select style="float:right; font-size:15px; padding:1px; margin:10px;" id="paginate" onchange="changepaginate()">
							<option>5</option>
							<option @if($paginate == 10) selected @endif >10</option>
							<option @if($paginate == 20) selected @endif >20</option>
							<option @if($paginate == 50) selected @endif >50</option>
							<option @if($paginate == 100) selected @endif >100</option>
						</select>
						<span style="float:right;font-size:15px;padding:1px;margin: 8px;">Per Page</span></td>
						</tr>
					</tbody>
				</table>
					
					<?php if(session('success')){ ?>
					<div class="col-12">
					<div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true" style="font-size:20px">×</span>
					</button>  {{session('success')}}
					</div>
					</div>
					<?php } ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Order Id</th>
							<th class="text-center">Date & Time</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Desc</th>
                            <th class="text-right">Net Amount</th>
							<th class="text-center">Status</th>
							<th class="text-right">Wallet Balance</th>
							<th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $i = 0; @endphp
                    @foreach($transaction as $trans)
						
							
						
					
                        <tr>
                            <td class="text-center">
								{{  ++$i  }}
							</td>
							<td>{{ $trans->orderID }}</td>
                            <td>{{ date('d/m/Y h:i A',strtotime($trans->created_at)+19800) }}</td>
                            <td>
								@if($trans->type == 'addMoney')
									Add Money
								@else
									{{ ucfirst($trans->type) }}
								@endif
							</td>
                            <td>
								@if($trans->number != NULL)
									{{ $trans->number }} | 
								@endif
								@if($trans->operator != NULL)
									{{ $trans->operator }} | 
								@endif
								@if($trans->amount != NULL)
									&#x20b9; {{ $trans->amount }}
								@endif
								
								@if($trans->transaction_id != NULL)
									<br>Txn {{ $trans->transaction_id }}
								@endif
								@if($trans->jolo_transaction_id != NULL)
									<br>Jolo Txn {{ $trans->jolo_transaction_id }}
								@endif
								
								<?php /*<br>
								{{ str_replace('via joloAPI','',$trans->description) }}*/?>
							</td>
                            <td class="text-right">&#x20b9; {{ $trans->amount }}</td>
							<td>
								@if($trans->status == 1)								 
									<span style="color:#056106;">Success</span> 
								@elseif($trans->status == 2)								 
									<span style="color:#F00;">Reported</span> 
								
								@elseif($trans->status == 3)								 
									<span style="color:#F00;">Refunded</span> 
								@else
									<span style="color:#F00;">Fail</span> 
								@endif
							</td>
							<td class="text-right">
								&#x20b9; {{ $trans->wallet_balance }}
							</td>
							<td>
								@if(time() - strtotime($trans->created_at) < 5*24*60*60)
									@if($trans->status == 1 && $trans->type != 'addMoney')	
										<a href="/order/dispute/{{ base64_encode($trans->id) }}" class="btn btn-sm btn-danger">Dispute</a>
									@endif
								@endif
							</td>
                        </tr>
                    @endforeach

						</tbody>
					</table>
					<div style="float:right;">{{ $transaction->links() }}</div>
				</div>
			</div>
        </div>
    </div>

</div>
@endsection
