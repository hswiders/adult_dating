
				<div class="card mt-0 pb-2">
					<div class="d-flex align-items-center justify-content-between">
						<div class="heading w-75">
						 	<h6 class="h4 m-0">{{ $title }}</h6>
						 	<p class="p-0 m-0">These photos can be viewed only by users that you choose and by users</p>
					    </div>
					   
					</div>
				</div>
@php
	$user_id = '';
@endphp
				<div class="gallary_redesign">
					@forelse ($images as $element)
					@php
						$user_id = $element->user_id
					@endphp
						<div class="card">
						<header class="card-heading card-image">
							<img src="{{ asset($element->image) }}" alt="" class="mCS_img_loaded">
							@if (auth()->user()->id == $element->user_id)
								
							
							<ul class="card-actions icons right-top">
								<li class="dropdown">
									<a href="javascript:void(0)" class="text-white" data-toggle="dropdown" aria-expanded="false">
										<i class="zmdi zmdi-more-vert white-text"></i>
									</a>
									<ul class="dropdown-menu btn-primary dropdown-menu-right">
										<li>
											<a href="javascript:void(0)" onclick="setProfile({{ $element->id }},{{ $image_category }})">Set as Profile</a>
										</li>
										<li>
											<a href="javascript:void(0)" onclick="setCover({{ $element->id }},{{ $image_category }})">Set as Cover</a>
										</li>
										
										<li>
											<a href="javascript:void(0)" onclick="deletePhoto({{ $element->id }},{{ $image_category }})">Delete</a>
										</li>
									</ul>
								</li>
							</ul>
							@endif
						</header>
					</div>
					@empty
						<div class="alert alert-danger">No photos found</div>
					@endforelse
					
					
				</div>
				
				@if (auth()->user()->id == $user_id)
				<input type="hidden" name="image_category" value="{{$image_category}}">
				<input type="hidden" name="image_token" value="{{csrf_token()}}">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#imageUploadModal{{$image_category}}">
				  Add Photo
				</button>
					@endif
			