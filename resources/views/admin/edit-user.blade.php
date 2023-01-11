@extends('admin.layout.layouts')
@section('content')
<div class="page-content">
	<div class="container-fluid">
		<div class="row">
			@if( Session::has('success')) 

			<div class="alert alert-success" role="alert">

				{{ Session::get('success') }}

			</div>

			@endif
			
			@if( Session::has('error')) 

			<div class="alert alert-danger" role="alert">

				{{ Session::get('error') }}

			</div>

			@endif 
			<!--end col-->
			<div class="col-xxl-9">
				<div class="card mt-xxl-n5">
					
					<div class="card-body p-4">
						<div class="tab-content">
							<div class="tab-pane active" id="personalDetails" role="tabpanel">
								<form action="#" id="update_form" method="post" onsubmit="return update_form()" enctype="multipart/form-data">
									<input type="hidden" name="id" value="{{$user->id}}">
									@csrf
									<div class="row">
										<div class="col-lg-12 mb-3">
											@if(!empty($user->image))
												<img src="{{asset($user->image)}}" class="img-fluid" width="150" height="150">
											@endif
										</div>

										<div class="col-lg-6">
											<div class="mb-3">
												<label for="firstnameInput" class="form-label">First Name</label>
												<input type="text" name="first_name" class="form-control" placeholder="Name" value="{{$user->first_name}}">
											</div>
										</div>
										@error('first_name')
    <span>{{ $message }}</span>
@enderror
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="firstnameInput" class="form-label">Last Name</label>
												<input type="text" name="last_name" class="form-control" placeholder="Name" value="{{$user->last_name}}">
											</div>
										</div>
@error('last_name') <span>{{ $message }} </span>@enderror
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="firstnameInput" class="form-label">User Name</label>
												<input type="text" name="username" class="form-control" placeholder="Username" value="{{$user->username}}">
											</div>
										</div>
@error('username') <span>{{ $message }} </span>@enderror
										<!--end col-->
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="emailInput" class="form-label">Email</label>
												<input type="email" name="email" class="form-control" placeholder="Email" readonly value="{{$user->email}}" >
											</div>
										</div>
										@error('email') <span>{{ $message }} </span>@enderror
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="emailInput" class="form-label">DOB</label>
												<input type="date" name="dob" class="form-control" placeholder="Date of birth"  value="{{date('Y-m-d', strtotime($user->dob))}}">
											</div>
										</div>
										@error('dob') <span>{{ $message }} </span>@enderror
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="firstnameInput" class="form-label">Height</label>
												<input type="number" name="height" class="form-control" placeholder="height" value="{{$user->height}}" step="any">
											</div>
										</div>
										@error('height') <span>{{ $message }} </span>@enderror
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="emailInput" class="form-label">Occupation</label>
												<select class="form-control" name="occupation">
													<option value="">Select Occuption</option>
													@if(!blank($occupation))
														@foreach($occupation as $occup)
															<option value="{{$occup->id}}" @if($occup->id==$user->occupation) selected @endif>{{$occup->title}}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
										@error('occupation') <span>{{ $message }} </span>@enderror
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="emailInput" class="form-label">Nationality</label>
												<select class="form-control" name="nationality">
													<option value="">Select nationality</option>
													@if(!blank($nationality))
														@foreach($nationality as $national)
															<option value="{{$national->id}}" @if($national->id==$user->nationality) selected @endif>{{$national->title}}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
										@error('nationality') <span>{{ $message }} </span>@enderror
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="firstnameInput" class="form-label">Country</label>
												<input type="text" name="country" class="form-control" placeholder="" value="{{$user->country}}">
											</div>
										</div>
@error('country') <span>{{ $message }} </span>@enderror
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="firstnameInput" class="form-label">City</label>
												<input type="text" name="city" class="form-control" placeholder=""  value="{{$user->city}}" >
											</div>
										</div>
@error('city') <span>{{ $message }} </span>@enderror
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="emailInput" class="form-label">Spoken language</label>
												<select class="form-control" name="spoken_language">
													<option value="">Select Spoken language</option>
													@if(!blank($language))
														@foreach($language as $lang)
															<option value="{{$lang->id}}" @if($lang->id==$user->spoken_language) selected @endif>{{$lang->title}}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
@error('spoken_language') <span>{{ $message }} </span>@enderror
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="emailInput" class="form-label">Display language</label>
												<select class="form-control" name="display_language">
													<option value="">Select Display language</option>
													@if(!blank($language))
														@foreach($language as $lang)
															<option value="{{$lang->id}}" @if($lang->id==$user->spoken_language) selected @endif>{{$lang->title}}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
@error('display_language') <span>{{ $message }} </span>@enderror
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="emailInput" class="form-label">Education</label>
												<select class="form-control" name="education">
													<option value="">Select Education</option>
													@if(!blank($education))
														@foreach($education as $edu)
															<option value="{{$edu->id}}" @if($edu->id==$user->education) selected @endif>{{$edu->title}}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
										@error('education') <span>{{ $message }} </span>@enderror
										<div class="col-lg-6">
											<div class="mb-3">
												<label for="firstnameInput" class="form-label">Image</label>
												<input type="file" name="image" class="form-control" placeholder="">
											</div>
										</div>
										<div class="col-lg-6">
			                                <label for="emailInput" class="form-label">Are you a smoker? </label>
			                                <input type="radio" class="" name="is_smoker" placeholder="" value="Yes" @if($user->is_smoker=='Yes') checked @endif> Yes
			                                <input type="radio" class="" name="is_smoker" placeholder="" value="No" @if($user->is_smoker=='No') checked @endif> No 
			                               	<input type="radio" class="" name="is_smoker" placeholder="" value="I dont answer" @if($user->is_smoker=='I dont answer') checked @endif> I dont answer
			                            </div>
@error('is_smoker') <span>{{ $message }} </span>@enderror
			                            <div class="col-lg-6">
			                                <label for="emailInput" class="form-label">Marital Status </label>
			                                <input type="radio" class="" name="marital_status" placeholder="" value="Yes" @if($user->marital_status=='Yes') checked @endif> Yes
			                                <input type="radio" class="" name="marital_status" placeholder="" value="No" @if($user->marital_status=='No') checked @endif> No 
			                               	<input type="radio" class="" name="marital_status" placeholder="" value="I dont answer" @if($user->marital_status=='I dont answer') checked @endif> I dont answer
			                            </div>
@error('marital_status') <span>{{ $message }} </span>@enderror
			                            <div class="col-lg-6">
			                                <label for="emailInput" class="form-label">Do you have children?</label>
			                                <input type="radio" class="" name="have_children" placeholder="" value="Yes" @if($user->have_children=='Yes') checked @endif> Yes
			                                <input type="radio" class="" name="have_children" placeholder="" value="No" @if($user->have_children=='No') checked @endif> No 
			                               	<input type="radio" class="" name="have_children" placeholder="" value="I dont answer" @if($user->have_children=='I dont answer') checked @endif> I dont answer
			                            </div>
@error('have_children') <span>{{ $message }} </span>@enderror
			                            <div class="col-lg-6">
			                                <label for="emailInput" class="form-label">Do you have any Tattoos/Body Art?</label>
			                                <input type="radio" class="" name="have_tatto" placeholder="" value="Yes" @if($user->have_tatto=='Yes') checked @endif> Yes
			                                <input type="radio" class="" name="have_tatto" placeholder="" value="No" @if($user->have_tatto=='No') checked @endif> No 
			                               	<input type="radio" class="" name="have_tatto" placeholder="" value="I dont answer" @if($user->have_tatto=='I dont answer') checked @endif> I dont answer
			                            </div>
			                           @error('have_tatto') <span>{{ $message }} </span>@enderror
			                            <div class="col-lg-6">
			                                <label for="emailInput" class="form-label">Gender</label>
			                                <input type="radio" class="" name="gender" placeholder="" value="Male" @if($user->gender=='Male') checked @endif> Male
			                                <input type="radio" class="" name="gender" placeholder="" value="Female" @if($user->gender=='Female') checked @endif> Female 
			                               	
			                            </div>
                                       	@error('gender') <span>{{ $message }} </span>@enderror

										<div class="col-lg-12">
											<div class="hstack gap-2 justify-content-end">
												<button type="submit" class="btn btn-primary" id="sub_btn">Updates</button>
											</div>
										</div>
                                        <!--end col-->
									</div>
                                    <!--end row-->
								</form>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
        <!--end row-->

	</div>
    <!-- container-fluid -->
</div><!-- End Page-content -->
@endsection
@section('scripts')
<script type="text/javascript">
    function update_form() {
        $('.alert-danger').remove();
        $.ajax({
            url: "{{route('admin.update-user-profile')}}",
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            data: new FormData($('#update_form')[0]),
            dataType: 'json',
            beforeSend: function() {
                $('#sub_btn').prop('disabled', true);
                $('#sub_btn').text('Processing..');
            },
            success: function(res) {
                $('#sub_btn').prop('disabled', false);
                $('#sub_btn').text('Update');
                if (res.status == 1) {

                    window.location.reload();

                } else {

                    $('#result1').html(res.message);
                    for (var err in res.validation) {

                        $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.validation[err] + "</div>");
                    }
                }
            }
        });
        return false;
    }
</script>
@endsection