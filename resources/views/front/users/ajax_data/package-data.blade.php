<div class="card m-0">
	<header class="card-heading ">
		<h2 class="card-title h3 fw-bold">Buy Coins/Credits</h2>
	</header>
	
</div>
<div class="row mt-3">
	@forelse ($packages as $item)
	<div class="col-md-4">
		<div class="height_auto">
			<div class="card pricing-card">
				<section class="card-front">
					<div class="card-heading">
						<div class="card-title">
							<h1 class="text-black"><sup>$</sup>{{$item->price}}</h1>
							<span class="pricing-period">/ {{$item->coins}} Coins</span>
							<span class="pricing-title text-blue">{{$item->title}}</span>
						</div>
					</div>
					<div class="card-body">
						<ul class="pricing-feature-list">
							@forelse ($item->package_item as $pitem)
							<li class="pricing-feature">
								<div class="d-flex align-items-center">
									<button class="btn btn-green btn-fab btn-fab-sm m-0"><i
											class="zmdi zmdi-check-all"></i>
										<div class="ripple-container"></div>
									</button>
									<p class="m-0 ms-3">{{ $pitem->item }}</p>
								</div>

							</li>
							@empty
								
							@endforelse
							
						</ul>
					</div>
					<div class="card-footer text-center">
						<a href="javascript:;" onclick="get_payment_method({{ $item->id }})" class="btn btn-info btn-round">Select</a>
					</div>
				</section>
			</div>
		</div>
	</div>
	@empty
		
	@endforelse
	
</div>