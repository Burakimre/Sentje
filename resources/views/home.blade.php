@extends('layouts/page')

@section('title', 'Home')

@section('content')
	<div id="bg_img" style="background-image: url(../img/header-bg.jpg)">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7">
					<div class="card" style="margin-bottom: 35px;">
						<div class="card-header">
							{{ __('header.openrequest') }}
						</div>
						<div class="card-body">
						@if ($openrequests->count() > 0)
							<table class="table">
									<thead>
										<tr>
											<th></th>
											<th>Titel</th>
											<th>Ontvangers</th>
										</tr>
									</thead>
									<tbody>
									@foreach ($openrequests as $openrequest)
										<tr>											
											<th><a href="/accounts/{{ $openrequest->deposit_account_id}}/paymentrequests/{{ $openrequest->id }}">open</a></th>
											<td>{{ $openrequest->title }}</td>
											<td>{{ decrypt($openrequest->created_by_user->name) }}</td>
										</tr>
									@endforeach
									</tbody>
							</table>
						@else
							<p>{{ __('header.noincomingrequest') }}</p>
						@endif
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							{{ __('header.incomingrequest') }}
						</div>
						<div class="card-body">
						@if ($paymentrequests->count() > 0)
							<table class="table">
									<tbody>
									@foreach ($paymentrequests as $paymentrequest)
										<tr>
											<td>{{ $paymentrequest->title }}</td>
											<td>
												<span class="float-right">
													<a href="{{ $paymentrequest->payment_url }}">
														<i class="fas fa-hand-holding-usd" style="font-size: 30px; margin-right: 20px;"></i>
													</a>
												</span>
											</td>
										</tr>
									@endforeach
									</tbody>
								@else
									<p>{{ __('header.noincomingrequest') }}</p>
						@endif
							</table>
						</div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="card" style="margin-bottom: 35px;">
						<div class="card-header">Dashboard</div>

						<div class="card-body">
							@if (session('status'))
								<div class="alert alert-success" role="alert">
									{{ session('status') }}
								</div>
							@endif

							Welcome to the Dashboard.
						</div>
					</div>
					<div class="card" style="margin-bottom: 35px;">
						<div class="card-header">
							<a href="{{ route('accounts.index') }}">Accounts</a></div>
						<div class="card-body">
							<table class="table table-hover">
								<tbody>
								@foreach ($accounts as $account)
									<tr>
										<td>
											<a href="/accounts/{{ $account->id }}"><span
														style="vertical-align: middle;">{{ $account->user_id . ' ' . decrypt($account->name) }}</span></a>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div class="card" style="margin-bottom: 35px;">
						<div class="card-header">
							<a href="{{ route('contact.index') }}">{{ __('header.contact') }}</a>
						</div>
						<div class="card-body">
							<table class="table table-hover">
								<tbody>
								@foreach ($friends as $friend)
									<tr>
										<td>
											<span
														style="vertical-align: middle;">#{{ $friend->user_id1 . ' ' . decrypt($friend->user1->name) }}</span><span
														class="float-right"></span>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div class="card" style="margin-bottom: 50px;">
						<div class="card-header">
							<a href="{{ route('group.index') }}">{{ __('header.group') }}</a>
						</div>
						<div class="card-body">
							<table class="table table-hover">
								<tbody>
								@foreach ($groups as $group)
									<tr>
										<td>
											<a href="/group/{{ $group->id }}">
												<span style="vertical-align: middle;">{{ $group->user_id . ' ' . $group->groupname }}</span></a>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
