<div class="modal-body">
	@php 
		$coverimage= asset($member->coverImage); 
		$profileimage= asset($member->profileimage); 
		@endphp
					<div id="header_wrapper" class="header-xl custom profile-header" style='background-image: url("{{$coverimage}}")!important;'>

						<div class="d-flex align-items-center">
							<div class="card type--profile me-3">
								<header class="card-heading">
									<img src="{{ $profileimage }}" alt="" class="img-circle">
								</header>
								<div class="card-body">
									<h3 class="name p-0 fw-bold">{{$member->first_name }} {{$member->last_name }}</h3>
									<span class="title me-1">{{$member->email }}</span>
									<span class="subtitle">{{ getCity($member->city , 'name')}}, {{ getCountry($member->country , 'name')}}</span>
									<!-- <button type="button" class="btn btn-primary btn-round">Connect</button> -->
								</div>
							</div>

							<div class="mt-4">


								<div class="d-flex align-items-start mb-4">
									<div class="profile_details">
										<h3>Height</h3>
										<p>{{$member->height }} cm</p>
									</div>

									{{-- <div class="profile_details ms-5 border-left">
										<h3>Weight</h3>
										<p>{{$member->weight }} Kg</p>
									</div> --}}

									<div class="profile_details ms-5 border-left">
										<h3>Spoken Languages</h3>
										<p>{{$member->spoken_language }}</p>
									</div>
								</div>

								<div class="border-top align-items-center d-flex justify-content-between p-0 px-0">

									<ul class="card-actions icons position_static">
										<li>
											<a href="javascript:void(0)" onclick="wink_user({{ $member->id }} )" data-name="{{ $member->first_name }}" data-profile="{{ asset($member->profileimage) }}" class="btn btn-sm btn-primary wink_user{{ $member->id }}">
												<i class="{{ checkIfWink( $member->id , auth()->user()->id ) }}" aria-hidden="true"></i> Send a wink
											<div class="ripple-container"></div></a>
											
										</li>
										<li>
											<a href="{{route('view-chat')}}?client_id={{ $member->id }}" class="btn btn-sm btn-primary">
												<i class="far fa-comment-dots text-white" aria-hidden="true"></i> Message
											</a>
										</li>
										<li>
											@if(checkIfBlocked( $member->id , auth()->user()->id ))									
											<a href="javascript:void(0)" class="btn btn-sm btn-danger"><i class="zmdi zmdi-block-alt" aria-hidden="true"></i> Blocked </a>
											@else
											<a href="javascript:void(0)" onclick="block_user({{ $member->id }})" class="btn btn-sm btn-primary">
												<i class="far fa-circle-xmark text-white" aria-hidden="true"></i> Block
											</a>
											@endif
										</li>
										<li>
											<a href="javascript:void(0)" class="btn btn-sm btn-primary pin_user{{ $member->id }}" onclick="pin_user({{ $member->id }})" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pin member">
												<i class="{{ checkIfPin( $member->id , auth()->user()->id ) }}" aria-hidden="true"></i> 
											<div class="ripple-container"></div></a>
										</li>
									</ul>
								</div>
							</div>



						</div>


					</div>

					<div id="content" class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<div class="card card-transparent">
						<div class="card-body wrapper">
							<div class="row">
								<div class="col-md-12 col-lg-12 p-0">
									<div class="card">
										<header class="card-heading p-0">
											<div class="tabpanel m-b-15 sticky_tabpanel">
												<ul class="nav nav-tabs nav-justified">
													<li class="active" role="presentation">
														<a href="#profile-Information" data-toggle="tab" aria-expanded="true"><i class="fas fa-question-circle" aria-hidden="true"></i> Information<div class="ripple-container"></div></a>
													</li>
													<li role="presentation">
														<a href="#profile-pub" onclick="show_photos(1 , {{$member->id}})"  data-toggle="tab" aria-expanded="true"><i class="fas fa-users"></i> Public</a>
													</li>
													
												</ul>
											</div>
										</header>
	<div class="card-body scrollbar mCustomScrollbar _mCS_2 mCS-autoHide" style="position: relative; overflow: visible;"><div id="mCSB_2" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" style="max-height: none;" tabindex="0"><div id="mCSB_2_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">
		<div class="tab-content">
			
			<div class="tab-pane fadeIn active" id="profile-Information">
				<div class="row">
					<div class="col-md-12">
						<div class="card border-bottom-0 shadow p-3 mb-3">
							<div class="d-flex align-items-center justify-content-between mb-3">
								<h3 class="h3">About You</h3>
								

							</div>

							<div class="d-flex align-items-center justify-content-between border-bottom py-2" >
								<p class="m-0"><i class="fas fa-location-arrow me-3 text-primary"></i> Location</p>
								<p class="m-0" >{{ getCity($member->city , 'name')}}, {{ getCountry($member->country , 'name')}}</p>

							</div>

							<div class="d-flex align-items-center justify-content-between border-bottom py-2" >
								<p class="m-0"><i class="fas fa-birthday-cake me-3 text-primary"></i> Date of birth</p>
								<p class="m-0">{{$member->dob_d}}/{{$member->dob_m}}/{{$member->dob_y}}</p>

							</div>

							<div class="d-flex align-items-center justify-content-between border-bottom py-2" >
								<p class="m-0"><i class="fas fa-briefcase me-3 text-primary"></i> Occupational Field</p>
								<p class="m-0">{{ getOccupation($member->occupation , 'title') }}</p>

							</div>

							<div class="d-flex align-items-center justify-content-between border-bottom py-2" >
								<p class="m-0"><i class="fas fa-language me-3 text-primary"></i> Spoken Languages</p>
								<p class="m-0">{{ getLanguages($member->spoken_language) }}</p>

							</div>

							{{-- <div class="d-flex align-items-center justify-content-between border-bottom py-2" >
								<p class="m-0"><i class="fas fa-globe me-3 text-primary"></i> Nationality</p>
								<p class="m-0">{{ ($member->nationality) ? getNationality($member->nationality , 'title') : 'I dont Answer' }}</p>

							</div> --}}

							{{-- <div class="d-flex align-items-center justify-content-between border-bottom py-2" >
								<p class="m-0"><i class="fas fa-globe-asia me-3 text-primary"></i> Display Language</p>
								<p class="m-0">{{ ($member->display_language) ? $member->display_language : 'I dont Answer' }}</p>

							</div> --}}

							<div class="d-flex align-items-center justify-content-between border-bottom py-2" >
								<p class="m-0"><i class="fas fa-ruler me-3 text-primary"></i> Height</p>
								<p class="m-0">{{ ($member->height) ? $member->height.'cm' : 'I dont Answer' }}</p>

							</div>

							<div class="d-flex align-items-center justify-content-between border-bottom py-2" >
								<p class="m-0"><i class="fas fa-dragon me-3 text-primary"></i> Do you have any Tattoos/Body Art?</p>
								<p class="m-0">{{ $member->have_tatto }}</p>

							</div>


							<div class="d-flex align-items-center justify-content-between border-bottom py-2" >
								<p class="m-0"><i class="fas fa-smoking me-3 text-primary"></i> Are you a smoker?</p>
								<p class="m-0">{{ $member->is_smoker }}</p>

							</div>


							<div class="d-flex align-items-center justify-content-between border-bottom py-2" >
								<p class="m-0"><i class="fas fa-ring me-3 text-primary"></i> Marital Status</p>
								<p class="m-0">{{ $member->marital_status }}</p>

							</div>


							<div class="d-flex align-items-center justify-content-between border-bottom py-2" >
								<p class="m-0"><i class="fas fa-baby me-3 text-primary"></i> Do you have children?</p>
								<p class="m-0">{{ $member->have_children }}</p>

							</div>


							<div class="d-flex align-items-center justify-content-between border-bottom py-2" >
								<p class="m-0"><i class="fas fa-user-graduate me-3 text-primary"></i> Education</p>
								<p class="m-0">{{getEducation($member->education , 'title')}}</p>

							</div>


						</div>
					</div>

			</div>
		    </div> 

			<div class="tab-pane fadeIn" id="profile-pub">
				
				</div>





		</div>
	</div></div><div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_2_dragger_vertical" class="mCSB_dragger"><div class="mCSB_dragger_bar" style="line-height: 50px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				</div>