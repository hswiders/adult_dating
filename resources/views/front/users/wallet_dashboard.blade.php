@extends('front.users.layouts.header')
@section('wallet-sidebar')
@include('front.users.layouts.sidebar_wallet')
@endsection

		@section('content')
		<section id="content_outer_wrapper" class="common_p">

			<div style="padding-top: 65px;"></div>
			<div class="row p-3 pb-0">
				<div class="col-sm-12">
					<div class="card shadow radius_10 p-3">
						<h3 class="h3 text-black mb-2 m-0">Your Coins/Credits</h3>
						<p class="m-0 p-0 mb-5">Your available Coins/Credits, deposited at the bank! The more you have, the easier it gets for you! What can we do? That’s life!!!</p>
						<div class="progress blue mb-3">
						<span class="progress-left">
							<span class="progress-bar"></span>
						</span>
						<span class="progress-right">
							<span class="progress-bar"></span>
						</span>
						<div class="progress-value text-black">C {{ auth()->user()->wallet_coins }}</div>
					</div>
		
					<div class="d-flex align-items-center justify-content-between">
						<div class="">
							<h3 class="m-0 p-0 text-success fw-bold">Incoming</h3>
							<p class="p-0 mt-1 text-success">C {{ $incoming }}</p>
						</div>
		
						<div class="">
							<h3 class="m-0 p-0 text-danger fw-bold">Outgoing</h3>
							<p class="p-0 mt-1 text-danger">C {{ $outgoing }}</p>
						</div>
		
		
					</div>
		
				</div>
			</div>
				{{-- <div class="col-sm-6">
					<div class="card shadow radius_10 p-3">
						<h3 class="h3 text-black mb-2 m-0">Your social status</h3>
						<p class="m-0 p-0 mb-5">It's the power that counts and is visible on your profile. The higher, the better for you!</p>
						
						<div class="card type--profile me-3 shadow">
							<header class="card-heading">
								<img src="assets/img/profiles/05.jpg" alt="" class="img-circle">
							</header>
							
							<div class="card-body">
								<h3 class="name p-0 fw-bold">SOCIAL CLASSES ON LUNONA</h3>
								<span class="title me-1 fw-bold text-danger">Your are → PENNILESS, Level -1</span>
							</div>
		
							
						</div>
						<div class="text-center">
								<button class="btn btn-sm btn-primary radius_30">Upgrade Now</button>
							</div>
		
				</div>
				</div> --}}
			</div>
		
			{{-- <div class="row p-3 pt-0">
				<div class="col-sm-6">
					<div class="card shadow radius_10 p-3">
						<h3 class="h3 text-black mb-2 m-0">Your vote's power</h3>
						<div class="d-flex align-items-center justify-content-between">
						<div class="chart me-3">
							<div id="c3_gauge"></div>
						</div>
						<p class="m-0">The multiplier is the power of your vote. When you vote, your vote will count as if 1 people have voted.</p>
					</div>
					</div>
				</div>
		
				<div class="col-sm-6">
					<div class="card shadow radius_10 p-3">
						<h3 class="h3 text-black mb-2 m-0">Reward Multiplier</h3>
						<div class="d-flex align-items-center justify-content-between">
						<div class="chart me-3">
							<div id="c5_gauge"></div>
						</div>
						<p>The multiplier is the power of your vote. When you vote, your vote will count as if 1 people have voted.</p>
					</div>
					</div>
				</div>
			</div> --}}
		
@endsection('content')

@section('scripts')
<script type="text/javascript">
    jQuery(function ($) {
        var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $('#app_sidebar-left').find('a').each(function () {
        	console.log(path)
            if (this.href === path) {
                $(this).parent().addClass('active');
            }
        });
    });
</script>
@endsection('scripts')
