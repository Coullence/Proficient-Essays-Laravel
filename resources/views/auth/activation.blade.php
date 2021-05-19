@extends('layouts.app')

@section('template_title')
	{{ trans('titles.activation') }}
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1">
				<div class="card card-default">
					<div class="card-header">{{ trans('titles.activation') }}</div>
					<div class="card-body">
						<p>{{ trans('auth.regThanks') }}</p>
						<p>{{ trans('auth.anEmailWasSent',['email' => $email, 'date' => $date ] ) }}</p>
						<p>{{ trans('auth.clickInEmail') }}</p>
						<p>
							<strong>Why this?</strong><br>
							We strongly advice you to do so, so as to access user dashboard. We do this to ensure effective communication between our servers and your email for day to day support & efficient communications. <br>We're are glad to have you.
							
						</p>
						<p><a href='/activation' class="btn btn-primary">{{ trans('auth.clickHereResend') }}</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
