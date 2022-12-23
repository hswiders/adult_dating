<div class="row">
	@forelse ($members as $element)
		<div class="col-md-3">
		<div class="card image-over-card" >
			<div class="card-image" onclick="show_user_detail('{{ $element->id }}')">
				<a href="javascript:void(0)">
					<img src="{{asset($element->profileimage)}}">
				</a>
			</div>
			<div class="card-body p-2">
				<h4 class="card-title m-0">{{$element->first_name }}, {{  $element->age }}</h4>
				
				<h6 class="category text-gray m-0 mt-1">{{ getCity($element->city , 'name') }} ,{{getCountry($element->country , 'name')}} </h6>
				
			</div>
			<div class="card-footer border-top align-items-center d-flex justify-content-between">
				{{-- <span>
					<a href="javascript:void(0)">
						<i class="zmdi zmdi-favorite-outline"></i>
					</a>
					<a href="javascript:void(0)">
						<i class="zmdi zmdi-favorite-outline"></i>
					</a>
					<a href="javascript:void(0)">
						<i class="zmdi zmdi-favorite-outline"></i>
					</a>
					<a href="javascript:void(0)">
						<i class="zmdi zmdi-favorite-outline"></i>
					</a>
					<a href="javascript:void(0)">
						<i class="zmdi zmdi-favorite-outline"></i>
					</a>
				</span> --}}
				
				<ul class="card-actions icons right-bottom">
					<li>
						<a href="javascript:void(0)"  onclick="wink_user({{ $element->id }} )" data-name="{{ $element->first_name }}" data-profile="{{ asset($element->profileimage) }}" class="wink_user{{ $element->id }}">
		                  <i class="{{ checkIfWink( $element->id , auth()->user()->id ) }}" aria-hidden="true"></i>
		                </a>
					</li>
					<li>
						<a href="javascript:void(0)" class="comming_soon">
							<i class="far fa-comment-dots" aria-hidden="true"></i>
						</a>
					</li>
					<li>
						<a href="javascript:void(0)" onclick="pin_user({{ $element->id }})" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pin member" class="pin_user{{ $element->id }}">
							<!-- <i class="zmdi zmdi-favorite-outline"></i> -->
							<i id="pin_user{{ $element->id }}" class="{{ checkIfPin( $element->id , auth()->user()->id ) }}"></i>
						</a>

					</li>
				</ul>
			</div>
		</div>
	</div>
	@empty
		<div class="no-data-found text-center">
			<img src="{{ asset('uploads/no-data-found.png') }}">
		</div>
	@endforelse
	
	
</div>
