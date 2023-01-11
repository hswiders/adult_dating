@extends('front.users.layouts.header')

		@section('content')
<style type="text/css">
    label.radio_label {
    width: 100%;
    background: #f1f1f1;
    margin: 5px 5px 5px 0;
    padding: 10px;
}
label.radio_label input {
    
    margin: 0!important;
   
}
.single-items 
{
    height: auto;
}
.blockUI.blockOverlay , .blockUI.blockMsg.blockPage{
    z-index: 9999!important;
}
/* Hide default radio style */
.checkbox-input {
  opacity: 0;
  visibility: hidden;
  margin: 0;
}

/* Change icon, border and text color when radio is checked */
.checkbox-input:checked + .checkbox-tile,
.checkbox-input:checked + .checkbox-tile span {
  border-color: var(--primary-color);
  color: var(--primary-color);
}

/* Checkbox display */
.checkbox-input:checked + .checkbox-tile::before {
  transform: scale(1);
  opacity: 1;
  background-color: var(--primary-color);
  background-color: var(--primary-color);
}

/* Checkbox icon and text */
.checkbox-tile {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.2rem;
  width: 160px;
  height: 70px;
  border-radius: 5px;
  border: 1px solid #ccc;
  transition: 0.1s ease;
  cursor: pointer;
  position: relative;
}

.checkbox-tile:hover {
  border-color: #999;
}

/* Checkmark (icon inside checker) */
.checkbox-tile::before {
  content: "";
  position: absolute;
  display: block;
  width: 1rem;
  height: 1rem;
  background-color: #fff;
  border-radius: 50%;
  top: 0.25rem;
  left: 0.25rem;
  opacity: 0;
  transform: scale(0);
  transition: 0.25s ease;
  background-image: url("");
  border: 2px solid var(--primary-color);
  background-size: 12px;
  background-repeat: no-repeat;
  background-position: 50% 50%;
}

.profileimage {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    z-index: +111;
    height: 100px;
    width: 100px;
    display: flex;
    top: -36px;
    align-items: center;
    justify-content: center;
    font-size: 35px;
    color: #fff;
    background: #000000a3;
    border-radius: 50%;
	opacity: 0;
	cursor: pointer;
}
.profileimage:hover {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    z-index: +111;
    height: 100px;
    width: 100px;
    display: flex;
    top: -36px;
    align-items: center;
    justify-content: center;
    font-size: 35px;
    color: #fff;
    background: #000000a3;
    border-radius: 50%;
	opacity:1;
	cursor: pointer;
}
.coverimage {
    position: absolute;
    bottom: 30px;
    right: 20px;
    background: #fff;
    height: 50px;
    width: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: #000;
    font-size: 20px;
    cursor: pointer;  
}
/*#app_sidebar-left
{
	display: none;
}*/
</style>
<!--  -->
 <!-- id="content_outer_wrapper_profile"  -->
<section class="left_align_content" >
	<div id="content_wrapper" class="card-overlay">
		@php 
		$coverimage= asset(auth()->user()->coverImage); 
		$profileimage= asset(auth()->user()->profileimage); 
		@endphp
		<div id="header_wrapper" class="header-xl custom profile-header" style='background-image: url("{{$coverimage}}")!important;margin-top: 35px;'>

			<div class="d-flex align-items-end flex-wrap">
				<div class="card type--profile me-3" >
					<header class="card-heading">
						<img src="{{$profileimage}}" alt="" class="img-circle">
						<div class="profileimage" onclick="show_edit_form('#profileimage')">
							<i class="fas fa-image"></i>	
						</div>
					</header>
					
					<div class="card-body">
						<h3 class="name p-0 fw-bold">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</h3>
						<span class="title me-1">{{auth()->user()->email}}</span>
						<span class="subtitle">{{getCountry(auth()->user()->country , 'name')}}, {{getCity(auth()->user()->city , 'name')}}</span>
						<!-- <button type="button" class="btn btn-primary btn-round">Connect</button> -->
					</div>
				</div>

					<div class="d-flex align-items-start mb-4">
						<div class="profile_details">
							<h3>Occupational Field</h3>
							<p>{{ getOccupation(auth()->user()->occupation , 'title') }}</p>
						</div>

						<div class="profile_details ms-5 border-left">
							<h3>Spoken Languages</h3>
							<p>{{ getLanguages(auth()->user()->spoken_language) }}</p>
						</div>
						<div class="coverimage" onclick="show_edit_form('#coverimage')">
							<i class="fas fa-image"></i>	
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
													<li class="active " role="presentation">
														<a href="#profile-info" data-toggle="tab" aria-expanded="true"><i class="fas fa-question-circle"></i> Information</a>
													</li>
													<li role="presentation">
														<a href="#profile-pub" onclick="show_photos(1 , {{ auth()->user()->id }})"  data-toggle="tab" aria-expanded="true"><i class="fas fa-users"></i> Public</a>
													</li>
													<li role="presentation">
														<a href="#profile-pub" onclick="show_photos(2 , {{ auth()->user()->id }})"  data-toggle="tab" aria-expanded="true"><i class="fas fa-fire"></i> Private</a>
													</li>
													<li role="presentation">
														<a href="#profile-pub" onclick="show_photos(3 , {{ auth()->user()->id }})"  data-toggle="tab" aria-expanded="true"><i class="fas fa-fire-alt"></i> Spicy</a>
													</li>
													<li role="presentation">
														<a href="#profile-pub" onclick="show_photos(4 , {{ auth()->user()->id }})"  data-toggle="tab" aria-expanded="true"><i class="fab fa-hotjar"></i> Chille</a>
													</li>
													{{-- <li role="presentation">
														<a href="#profile-Saved" class="comming_soon"  data-togglee="tab" aria-expanded="true"><i class="fas fa-save"></i> Saved</a>
													</li> --}}
													
												</ul>
											</div>
										</header>
	<div class="card-body">
		<div class="tab-content">
			
			<div class="tab-pane fadeIn active" id="profile-info">
				<div class="row" id="profile_data">
					<div class="col-md-6">
						<div class="card border-bottom-0 shadow p-3 mb-3">
							<div class="d-flex align-items-center justify-content-between mb-3">
								<h3 class="h3">About You</h3>
								

							</div>

							<div class="d-flex align-items-center justify-content-between border-bottom py-2" onclick="show_edit_form('#location')">
								<p class="m-0"><i class="fas fa-location-arrow me-3 text-primary"></i> Location</p>
								<p class="m-0" >{{ getCity(auth()->user()->city , 'name')}}, {{ getCountry(auth()->user()->country , 'name')}}</p>

							</div>

							<div class="d-flex align-items-center justify-content-between border-bottom py-2" onclick="show_edit_form('#dob')">
								<p class="m-0"><i class="fas fa-birthday-cake me-3 text-primary"></i> Date of birth</p>
								<p class="m-0">{{auth()->user()->dob_d}}/{{auth()->user()->dob_m}}/{{auth()->user()->dob_y}}</p>

							</div>

							<div class="d-flex align-items-center justify-content-between border-bottom py-2" onclick="show_edit_form('#occupation')">
								<p class="m-0"><i class="fas fa-briefcase me-3 text-primary"></i> Occupational Field</p>
								<p class="m-0">{{ getOccupation(auth()->user()->occupation , 'title') }}</p>

							</div>

							<div class="d-flex align-items-center justify-content-between border-bottom py-2" onclick="show_edit_form('#spoken_language')">
								<p class="m-0"><i class="fas fa-language me-3 text-primary"></i> Spoken Languages</p>
								<p class="m-0">{{ getLanguages(auth()->user()->spoken_language) }}</p>

							</div>

							{{-- <div class="d-flex align-items-center justify-content-between border-bottom py-2" onclick="show_edit_form('#nationality')">
								<p class="m-0"><i class="fas fa-globe me-3 text-primary"></i> Nationality</p>
								<p class="m-0">{{ (auth()->user()->nationality) ? getNationality(auth()->user()->nationality , 'title') : 'I dont Answer' }}</p>

							</div> --}}

							{{-- <div class="d-flex align-items-center justify-content-between border-bottom py-2" onclick="show_edit_form('#display_language')">
								<p class="m-0"><i class="fas fa-globe-asia me-3 text-primary"></i> Display Language</p>
								<p class="m-0">{{ (auth()->user()->display_language) ? auth()->user()->display_language : 'I dont Answer' }}</p>

							</div> --}}

							<div class="d-flex align-items-center justify-content-between border-bottom py-2" onclick="show_edit_form('#height')">
								<p class="m-0"><i class="fas fa-ruler me-3 text-primary"></i> Height</p>
								<p class="m-0">{{ (auth()->user()->height) ? auth()->user()->height.'cm' : 'I dont Answer' }}</p>

							</div>

							<div class="d-flex align-items-center justify-content-between border-bottom py-2" onclick="show_edit_form('#have_tatto')">
								<p class="m-0"><i class="fas fa-dragon me-3 text-primary"></i> Do you have any Tattoos/Body Art?</p>
								<p class="m-0">{{ auth()->user()->have_tatto }}</p>

							</div>


							<div class="d-flex align-items-center justify-content-between border-bottom py-2" onclick="show_edit_form('#is_smoker')">
								<p class="m-0"><i class="fas fa-smoking me-3 text-primary"></i> Are you a smoker?</p>
								<p class="m-0">{{ auth()->user()->is_smoker }}</p>

							</div>


							<div class="d-flex align-items-center justify-content-between border-bottom py-2" onclick="show_edit_form('#marital_status')">
								<p class="m-0"><i class="fas fa-ring me-3 text-primary"></i> Marital Status</p>
								<p class="m-0">{{ auth()->user()->marital_status }}</p>

							</div>


							<div class="d-flex align-items-center justify-content-between border-bottom py-2" onclick="show_edit_form('#have_children')">
								<p class="m-0"><i class="fas fa-baby me-3 text-primary"></i> Do you have children?</p>
								<p class="m-0">{{ auth()->user()->have_children }}</p>

							</div>


							<div class="d-flex align-items-center justify-content-between border-bottom py-2" onclick="show_edit_form('#education')">
								<p class="m-0"><i class="fas fa-user-graduate me-3 text-primary"></i> Education</p>
								<p class="m-0">{{getEducation(auth()->user()->education , 'title')}}</p>

							</div>


						</div>


						<div class="card border-bottom-0 shadow p-3 mb-3">
							<div class="d-flex align-items-center justify-content-between mb-3">
								<h3 class="h3">Account Settings</h3>

							</div>

							<div class="d-flex align-items-center justify-content-between border-bottom py-2"  onclick="show_edit_form('#username')">
								<p class="m-0"><i class="fas fa-user-check me-3 text-primary"></i> Username</p>
								<p class="m-0">{{'@'.auth()->user()->username}}</p>

							</div>

							<div class="d-flex align-items-center justify-content-between border-bottom py-2">
								<p class="m-0"><i class="far fa-envelope me-3 text-primary"></i> Email</p>
								<p class="m-0">{{auth()->user()->email}}</p>

							</div>

							<div class="d-flex align-items-center justify-content-between border-bottom py-2"  onclick="show_edit_form('#password')">
								<p class="m-0"><i class="fas fa-lock-open me-3 text-primary"></i> Password</p>
								<p class="m-0 text-primary text-underline"><a href="javascript:;"> Change</a></p>

							</div>
						</div>
					</div>



					<div class="col-md-6">
						<div class="card border-bottom-0 shadow p-3 mb-3">
							<div class="d-flex align-items-center justify-content-between mb-3">
								<h3 class="h3">What are you looking for?</h3>

							</div>



							<div class="togglebutton d-flex align-items-center justify-content-between">
								<p class="m-0">To have fun together</p>
								<label>
									<input type="checkbox" class="toggle-success lookingfor" name="lookingfor"  value="1" onclick="lokkingfor(this.value)" {{in_array(1, explode(',',auth()->user()->lookingfor))?'checked':''}}> 
								</label>
							</div>
							<div class="togglebutton d-flex align-items-center justify-content-between">
								<p class="m-0">To give her nice gifts</p>
								<label>
									<input type="checkbox" class="toggle-success lookingfor" onclick="lokkingfor(this.value)" value="2" {{in_array(2, explode(',',auth()->user()->lookingfor))?'checked':''}}> 
								</label>
							</div>
							<div class="togglebutton d-flex align-items-center justify-content-between">
								<p class="m-0">To help her with her expenses</p>
								<label>
									<input type="checkbox" class="toggle-success lookingfor" onclick="lokkingfor(this.value)" value="3" {{in_array(3, explode(',',auth()->user()->lookingfor))?'checked':''}}> 
								</label>
							</div>
							<div class="togglebutton d-flex align-items-center justify-content-between">
								<p class="m-0">То help her finish her studies</p>
								<label>
									<input type="checkbox" class="toggle-success lookingfor" onclick="lokkingfor(this.value)" value="4" {{in_array(4, explode(',',auth()->user()->lookingfor))?'checked':''}}> 
								</label>
							</div>
							<div class="togglebutton d-flex align-items-center justify-content-between">
								<p class="m-0">Тo go shopping together</p>
								<label>
									<input type="checkbox" class="toggle-success lookingfor" onclick="lokkingfor(this.value)" value="5" {{in_array(5, explode(',',auth()->user()->lookingfor))?'checked':''}}> 
								</label>
							</div>
							<div class="togglebutton d-flex align-items-center justify-content-between">
								<p class="m-0">To travel together</p>
								<label>
									<input type="checkbox" class="toggle-success lookingfor" onclick="lokkingfor(this.value)" value="6" {{in_array(6, explode(',',auth()->user()->lookingfor))?'checked':''}}> 
								</label>
							</div>
							<div class="togglebutton d-flex align-items-center justify-content-between">
								<p class="m-0">То make her feel secure</p>
								<label>
									<input type="checkbox" class="toggle-success lookingfor" onclick="lokkingfor(this.value)" value="7" {{in_array(7, explode(',',auth()->user()->lookingfor))?'checked':''}}> 
								</label>
							</div>
							<div class="togglebutton d-flex align-items-center justify-content-between">
								<p class="m-0">To offer her a job in my business</p>
								<label>
									<input type="checkbox" class="toggle-success lookingfor" onclick="lokkingfor(this.value)" value="8" {{in_array(8, explode(',',auth()->user()->lookingfor))?'checked':''}}> 
								</label>
							</div>
							<div class="togglebutton d-flex align-items-center justify-content-between">
								<p class="m-0">I would like to show her around my country</p>
								<label>
									<input type="checkbox" class="toggle-success lookingfor" onclick="lokkingfor(this.value)" value="9" {{in_array(9, explode(',',auth()->user()->lookingfor))?'checked':''}}> 
								</label>
							</div>
							<div class="togglebutton d-flex align-items-center justify-content-between">
								<p class="m-0">To visit her country, with her showing me around</p>
								<label>
									<input type="checkbox" class="toggle-success lookingfor" onclick="lokkingfor(this.value)" value="10" {{in_array(10, explode(',',auth()->user()->lookingfor))?'checked':''}}> 
								</label>
							</div>
							<div class="togglebutton d-flex align-items-center justify-content-between">
								<p class="m-0">I don't mind if she comes from a foreign country</p>
								<label>
									<input type="checkbox" class="toggle-success lookingfor" onclick="lokkingfor(this.value)" value="11" {{in_array(11, explode(',',auth()->user()->lookingfor))?'checked':''}}> 
								</label>
							</div>
						</div>



					</div>
			</div>
		    </div> 
		    <div class="tab-pane fadeIn" id="profile-pub"></div>




		</div>
	</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<section id="chat_compose_wrapper">
				<div class="tippy-top">
					<div class="recipient">Allison Grayce</div>
					<ul class="card-actions icons  right-top">
						<li>
							<a href="javascript:void(0)">
								<i class="zmdi zmdi-videocam"></i>
							</a>
						</li>
						<li class="dropdown">
							<a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false">
								<i class="zmdi zmdi-more-vert"></i>
							</a>
							<ul class="dropdown-menu btn-primary dropdown-menu-right">
								<li>
									<a href="javascript:void(0)">Option One</a>
								</li>
								<li>
									<a href="javascript:void(0)">Option Two</a>
								</li>
								<li>
									<a href="javascript:void(0)">Option Three</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="javascript:void(0)" data-chat="close">
								<i class="zmdi zmdi-close"></i>
							</a>
						</li>
					</ul>
				</div>
				<div class='chat-wrapper scrollbar'>
					<div class='chat-message scrollbar'>
						<div class='chat-message chat-message-recipient'>
							<img class='chat-image chat-image-default' src='assets/img/profiles/05.jpg' />
							<div class='chat-message-wrapper'>
								<div class='chat-message-content'>
									<p>Hey Mike, we have funding for our new project!</p>
								</div>
								<div class='chat-details'>
									<span class='today small'></span>
								</div>
							</div>
						</div>
						<div class='chat-message chat-message-sender'>
							<img class='chat-image chat-image-default' src='assets/img/profiles/02.jpg' />
							<div class='chat-message-wrapper '>
								<div class='chat-message-content'>
									<p>Awesome! Photo booth banh mi pitchfork kickstarter whatever, prism godard ethical 90's cray selvage.</p>
								</div>
								<div class='chat-details'>
									<span class='today small'></span>
								</div>
							</div>
						</div>
						<div class='chat-message chat-message-recipient'>
							<img class='chat-image chat-image-default' src='assets/img/profiles/05.jpg' />
							<div class='chat-message-wrapper'>
								<div class='chat-message-content'>
									<p> Artisan glossier vaporware meditation paleo humblebrag forage small batch.</p>
								</div>
								<div class='chat-details'>
									<span class='today small'></span>
								</div>
							</div>
						</div>
						<div class='chat-message chat-message-sender'>
							<img class='chat-image chat-image-default' src='assets/img/profiles/02.jpg' />
							<div class='chat-message-wrapper'>
								<div class='chat-message-content'>
									<p>Bushwick letterpress vegan craft beer dreamcatcher kickstarter.</p>
								</div>
								<div class='chat-details'>
									<span class='today small'></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<footer id="compose-footer">
					<form class="form-horizontal compose-form">
						<ul class="card-actions icons left-bottom">
							<li>
								<a href="javascript:void(0)">
									<i class="zmdi zmdi-attachment-alt"></i>
								</a>
							</li>
							<li>
								<a href="javascript:void(0)">
									<i class="zmdi zmdi-mood"></i>
								</a>
							</li>
						</ul>
						<div class="form-group m-10 p-l-75 is-empty">
							<div class="input-group">
								<label class="sr-only">Leave a comment...</label>
								<input type="text" class="form-control form-rounded input-lightGray" placeholder="Leave a comment..">
								<span class="input-group-btn">
									<button type="button" class="btn btn-blue btn-fab  btn-fab-sm">
										<i class="zmdi zmdi-mail-send"></i>
									</button>
								</span>
							</div>
						</div>
					</form>
				</footer>
			</section>

		</div> 

		<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" id="modal_data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="contact-form" id="contact-form-data" method="post" onsubmit="return update_profile(event , this);" enctype="multipart/form-data">
      <div class="modal-body">
         
                        @csrf
                        <div class="row my-form">
                            <div class="col-sm-12" id="result"></div>
                            <div class="col-12 col-md-6 d-nonee d-flex justify-content-between" id="first_name" data-title="Your Name">
                                <input type="text" class="form-control my-2" value="{{ auth()->user()->first_name }}"  name="first_name" placeholder="First Name" >
                                <input type="text" class="form-control" value="{{ auth()->user()->last_name }}" id="candidate_lname" name="last_name" placeholder="Last Name" >
                            </div>
                           
                            <div class="col-12 col-md-12  d-nonee" id="dob" data-title="Date Of Birth">
                                
                                <div class="select-date d-flex justify-content-between">
                                <select id="select-day" class="form-control" name="dob_d"></select>
                                <select id="select-month" class="form-control" name="dob_m">
                                    <option  value="1">January</option>
                                    <option  value="2">February</option>
                                    <option  value="3">March</option>
                                    <option  value="4">April</option>
                                    <option  value="5">May</option>
                                    <option  value="6">June</option>
                                    <option  value="7">July</option>
                                    <option  value="8">August</option>
                                    <option  value="9">September</option>
                                    <option  value="10">October</option>
                                    <option  value="11">November</option>
                                    <option  value="12">December</option>
                                </select>
                                <select id="select-year" class="form-control" name="dob_y"></select>
                                </div>
                                
                            </div>
                            <div class="col-12 col-md-12 d-nonee" id="location" data-title="Location">
                                
                                <select  id="country-dd"  name="country" class="form-control  ">
		                              <option value="">Select Country</option>
		                              @foreach ($countries as $data)
		                              <option {{ (auth()->user()->country == $data->id) ? 'selected' : '' }} value="{{$data->id}}">
		                                  {{$data->name}}
		                              </option>
		                              @endforeach
		                          </select>
                                 <select id="city-dd" name="city" class="form-control  ">
		                            <option value="">Select City</option>
		                            @foreach (getCitiesbycountry(auth()->user()->country) as $data)
		                              <option {{ (auth()->user()->city == $data->id) ? 'selected' : '' }} value="{{$data->id}}">
		                                  {{$data->name}}
		                              </option>
		                              @endforeach
		                          </select>
                            </div>  
                            <div class="col-12 col-md-12 d-nonee" id="username" data-title="Username">
                                <input type="text" class="form-control my-3" id="username" value="{{ !empty(auth()->user()->username)?auth()->user()->username:'' }}" name="username" placeholder="User name" pattern="^\S+$">
                                <small id="usernameerror"></small>
                                 <input type="password" class="form-control my-3" id="passwordusername"  name="passwordusername" placeholder="Enter Password">
                                <small id="passwordusernameerror"></small>
                            </div>
                            <div class="col-12 col-md-12 d-nonee" id="coverimage" data-title="Cover Image">
                                <div class="form-group is-empty">
					                        <div class="input-group">
					                          <input type="file" class="form-control" placeholder="File Upload..." name="coverimage" accept="image/*">
					                          <div class="input-group">
					                            <input type="text" readonly="" class="form-control" placeholder="Placeholder w/file chooser...">
					                            <span class="input-group-btn input-group-sm">
					                              <button type="button" class="btn btn-info btn-fab btn-fab-sm">
					                                <i class="zmdi zmdi-attachment-alt"></i>
					                              </button>
					                            </span>
					                          </div>
					                        </div>
					                      </div>
                            </div>
                            <div class="col-12 col-md-12 d-nonee" id="profileimage" data-title="Profile Image">
                                <div class="form-group is-empty">
					                        <div class="input-group">
					                          <input type="file" class="form-control" placeholder="File Upload..." name="profileimage" accept="image/*">
					                          <div class="input-group">
					                            <input type="text" readonly="" class="form-control" placeholder="Placeholder w/file chooser...">
					                            <span class="input-group-btn input-group-sm">
					                              <button type="button" class="btn btn-info btn-fab btn-fab-sm">
					                                <i class="zmdi zmdi-attachment-alt"></i>
					                              </button>
					                            </span>
					                          </div>
					                        </div>
					                      </div>
                            </div>

                            <div class="col-12 col-md-12 d-nonee" id="password" data-title="Change Password">
                                <input type="password" class="form-control my-3" id="old_password" name="old_password" placeholder="Old Password" >
                                <small id="old_passworderror"></small>
                                <input type="password" class="form-control my-3" id="new_password" name="new_password" placeholder="New Password" >
                                <small id="new_passworderror"></small>
                                <input type="password" class="form-control my-3" id="c_password" name="c_password" placeholder="Confirm Password" >
                                <small id="c_passworderror"></small>
                            </div>
                            <div class="col-12 col-md-12 d-nonee" id="height" data-title="Height">
                               <input  id="mdc-slider" class="mdc-slider __input" type="range" min="140" max="220" name="height" step="1" aria-label="Discrete slider demo" value="142">
                               <div id="height_value">0</div>
                            </div> 
                            <div class="col-12 col-md-12 d-nonee d-flex justify-content-between" id="spoken_language" data-title="Spoken Languages">
                            	@forelse ($languages as $element)
                            		<div class="checkbox">
                            			@php $spoken = explode(',', auth()->user()->spoken_language)  @endphp
								      <label class="checkbox-wrapper">
								        <input {{ (in_array($element->id, $spoken)) ? 'checked' : '' }} type="checkbox" class="checkbox-input" name="spoken_language[]" value="{{ $element->id }}"  />
								        <span class="checkbox-tile">
								         
								          <span>{{ $element->title }}</span>
								        </span>
								      </label>
								    </div>
                            	@empty
                            		{{-- empty expr --}}
                            	@endforelse
                                
                            </div> 
                            {{-- 
                            <div class="col-12 col-md-12 d-nonee d-flex justify-content-between" id="gender" data-title="Gender">
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="gender" placeholder="" value="male" {{ (auth()->user()->gender == 'male') ? 'selected' : '' }}>Male</label>
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="gender" placeholder="" value="female" {{ (auth()->user()->gender == 'female') ? 'selected' : '' }}>Female</label>
                            </div> --}} 
                            <div class="col-12 col-md-12 d-nonee d-flex justify-content-between" id="have_tatto" data-title="Do you have tatto?">
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="have_tatto" placeholder="" value="Yes" {{ (auth()->user()->have_tatto == 'Yes') ? 'checked' : '' }}>Yes</label>
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="have_tatto" placeholder="" value="No" {{ (auth()->user()->have_tatto == 'No') ? 'checked' : '' }}>No</label> 
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="have_tatto" placeholder="" value="I dont answer" {{ (auth()->user()->have_tatto == 'I dont answer') ? 'checked' : '' }}>I dont answer</label>
                            </div>

                            <div class="col-12 col-md-12 d-nonee d-flex justify-content-between" id="is_smoker" data-title="Do you Smoke?">
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="is_smoker" placeholder="" value="Yes" {{ (auth()->user()->is_smoker == 'Yes') ? 'checked' : '' }}>Yes</label>
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="is_smoker" placeholder="" value="No" {{ (auth()->user()->is_smoker == 'No') ? 'checked' : '' }}>No</label> 
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="is_smoker" placeholder="" value="I dont answer" {{ (auth()->user()->is_smoker == 'I dont answer') ? 'checked' : '' }}>I dont answer</label>
                            </div> 
                            <div class="col-12 col-md-12 d-nonee d-flex justify-content-between" id="have_children" data-title="Do you Children?">
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="have_children" placeholder="" value="Yes" {{ (auth()->user()->have_children == 'Yes') ? 'checked' : '' }}>Yes</label>
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="have_children" placeholder="" value="No" {{ (auth()->user()->have_children == 'No') ? 'checked' : '' }}>No</label> 
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="have_children" placeholder="" value="I dont answer" {{ (auth()->user()->have_children == 'I dont answer') ? 'checked' : '' }}>I dont answer</label>
                            </div> 
                            <div class="col-12 col-md-12 d-nonee d-flex justify-content-between" id="marital_status" data-title="Marital status?">
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="marital_status" placeholder="" value="Single" {{ (auth()->user()->marital_status == 'Single') ? 'checked' : '' }}>Single</label>
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="marital_status" placeholder="" value="Committed" {{ (auth()->user()->marital_status == 'Committed') ? 'checked' : '' }}>Committed</label> 
                                <label class="radio_label d-flex justify-content-between"><input type="radio" class=""  name="marital_status" placeholder="" value="I dont answer" {{ (auth()->user()->marital_status == 'I dont answer') ? 'checked' : '' }}>I dont answer</label>
                            </div>
                            <div class="col-12 col-md-12 d-nonee" id="occupation" data-title="Occupation">
                                <select class="form-control" name="occupation" >
                                    <option value="">-select occupation-</option>
                                    @forelse ($occupation as $element)
                                        <option {{ ( $element->id == auth()->user()->occupation) ? 'selected' : '' }} value="{{ $element->id }}">{{ $element->title }}</option>
                                    @empty
                                        
                                    @endforelse
                                    
                                </select>
                            </div>
                           <div class="col-12 col-md-12 d-nonee" id="nationality" data-title="Nationality">
                                <select class="form-control" name="nationality" >
                                    <option value="">-select nationality-</option>
                                    @forelse ($nationality as $element)
                                        <option {{ ( $element->id == auth()->user()->nationality) ? 'selected' : '' }} value="{{ $element->id }}">{{ $element->title }}</option>
                                    @empty
                                        
                                    @endforelse
                                    
                                </select>
                            </div>
                            <div class="col-12 col-md-12 d-nonee" id="education" data-title="Education">
                                <select class="form-control" name="education" >
                                    <option value="">-select education-</option>
                                    @forelse ($education as $element)
                                        <option {{ ( $element->id == auth()->user()->education) ? 'selected' : '' }} value="{{ $element->id }}">{{ $element->title }}</option>
                                    @empty
                                        
                                    @endforelse
                                    
                                </select>
                            </div>
                           
                           
                        </div>
                    
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			        <button type="submit" class="btn btn-primary">Save changes</button>
			      </div>
			  </form>
    </div>
  </div>
</div>
<div class="modal fade" id="imageUploadModal1" tabindex="-1" role="dialog" aria-labelledby="imageUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageUploadModalLabel">Upload photos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="uploader1">
		    <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
		</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="imageUploadModal2" tabindex="-1" role="dialog" aria-labelledby="imageUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageUploadModalLabel">Upload photos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="uploader2">
		    <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
		</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="imageUploadModal3" tabindex="-1" role="dialog" aria-labelledby="imageUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageUploadModalLabel">Upload photos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="uploader3">
		    <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
		</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="imageUploadModal4" tabindex="-1" role="dialog" aria-labelledby="imageUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageUploadModalLabel">Upload photos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div id="uploader4">
		    <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
		</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        
      </div>
    </div>
  </div>
</div>
@endsection

@section('right_sidebar')
@include('front.users.layouts.sidebar_profile')
@endsection
@section('scripts')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" />

<script type="text/javascript">
var i = 0;
function addScript(src) {
  return new Promise((resolve, reject) => {
    const s = document.createElement('script');

    s.setAttribute('src', src);
    s.addEventListener('load', resolve);
    s.addEventListener('error', reject);

    document.body.appendChild(s);
  });
}

function show_edit_form(field) 
{
	if(field=="#password"){
		$("#old_password").attr("required", "true");
		$("#new_password").attr("required", "true");
		$("#c_password").attr("required", "true");
	}
	if(field=="#username"){
		$("#passwordusername").attr("required", "true");
	}
	$('.d-nonee').addClass('d-none');
	$(field).removeClass('d-none');
	$(field).show();
	modal_title = $(field).data('title');
	$('#modal_title').text('Edit ' + modal_title);
	$('#edit_modal').modal('show')
	
}
document.addEventListener("DOMContentLoaded", async () => {
  
try {
  // await addScript('https://www.plupload.com/plupload/js/plupload.full.min.js');
  // await addScript('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js');
  // await addScript('https://www.plupload.com/plupload/js/jquery.ui.plupload/jquery.ui.plupload.min.js');
  
  // do something after it was loaded
} catch (e) {
  console.log(e);
}

var daysInMonth = [0,31,28,31,30,31,30,31,31,30,31,30,31];
function dateInitialize()
{
	
    today = new Date(),
    // default targetDate is christmas
    selected_d = {{ (auth()->user()->dob_d) ? auth()->user()->dob_d : 25 }} ;
   selected_m = {{  (auth()->user()->dob_m) ? auth()->user()->dob_m : 12 }} ;
   selected_y = {{ (auth()->user()->dob_y) ? auth()->user()->dob_y : 2022 }} ;
    targetDate = new Date(selected_y, selected_m, selected_d); 

	setDate(targetDate);
	 // set the next five years in dropdown

	$("#select-month").change(function() {
	  var monthIndex = $("#select-month").val();
	  setDays(monthIndex);
	});
}
dateInitialize()
	

function setDate(date) {
  setDays(date.getMonth());
  setYears(80) 
  $("#select-day").val(date.getDate());
  $("#select-month").val(date.getMonth());
  $("#select-year").val(date.getFullYear());
}

// make sure the number of days correspond with the selected month
function setDays(monthIndex) {
  var optionCount = $('#select-day option').length,
      daysCount = daysInMonth[monthIndex];
  
  if (optionCount < daysCount) {
    for (var i = optionCount; i < daysCount; i++) {
      $('#select-day')
        .append($("<option></option>")
        .attr("value", i + 1)
        .text(i + 1)); 
    }
  }
  else {
    for (var i = daysCount; i < optionCount; i++) {
      var optionItem = '#select-day option[value=' + (i+1) + ']';
      $(optionItem).remove();
    } 
  } 
}

function setYears(val) {
  var year = today.getFullYear() - 18;
  for (var i = 0; i < val; i++) {
      $('#select-year')
        .append($("<option></option>")
        .attr("value", year - i)
        .text(year - i)); 
    }
}

$("#mdc-slider").slider(
{
	value:{{ auth()->user()->height  }},
            min: 0,
            max: 142,
            step: 1,
            slide: function( event, ui ) {
            	alert('message?: DOMString')
                $("#height_value").html( ui.value );
            }
}
);

$("#height_value").html(  $('#mdc-slider').slider('value') );

 initUploader(1);
 initUploader(2);
 initUploader(3);
 initUploader(4);

	
});

function initUploader(n)
{

	$("#uploader"+n).plupload({
        // General settings
        runtimes : 'html5,flash,silverlight,html4',
        url : "{{ route('media-upload') }}",
 
        // Maximum file size
        max_file_size : '2mb',
 
        chunk_size: '1mb',
 
        // Resize images on clientside if we can
        resize : {
           
            quality : 90,
            crop: false // crop to exact dimensions
        },
 
        // Specify what files to browse for
        filters : [
            {title : "Image files", extensions : "jpg,gif,png"},
            // {title : "Zip files", extensions : "zip,avi"}
        ],
 
        // Rename files by clicking on their titles
        rename: true,
         
        // Sort files
        sortable: true,
 
        // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
        dragdrop: true,
 
        // Views to activate
        views: {
            list: true,
            thumbs: true, // Show thumbs
            active: 'thumbs'
        },
 		multipart_params : {
                "image_category" : n,
                "_token" : '{{csrf_token()}}',
            },
        // Flash settings
        flash_swf_url : '{{ asset('plugins/plupload/js/Moxie.swf') }}',
     
        // Silverlight settings
        silverlight_xap_url : '{{ asset('plugins/plupload/js/Moxie.xap') }}',
        preinit: {
                    Init: function (up, info) {
                        //log('[Init]', 'Info:', info, 'Features:', up.features);
                    },
 
                    UploadFile: function (up, file) {
                        //log('[UploadFile]', file);
                    },
 
                    UploadComplete: function (up, file) {
                        //plupload_add
                        $(".plupload_buttons").css("display", "inline");
                        $(".plupload_upload_status").css("display", "inline");
                        $('#imageUploadModal'+n).modal('hide')
                        show_photos( n);
                    },
 
                    UploadProgress: function (up,file) {
                    },
 
                    PostInit: function (up) {
 
                    },
 
                    QueueChanged: function (up) {
                    }
                }
    });
}
function lokkingfor(id){
	var lookingdata=[];
	$(".lookingfor:checked").each(function() {
       lookingdata.push($(this).val());
  });
	$.ajax({
		url: "{{ route('lookingfor') }}",
    data: {'_token':'{{csrf_token()}}','lookingfor':lookingdata },
    type: 'POST',
    dataType:'json',
    success: function(result){
    	if(result.status == 'success'){
	    }
	  }
	});
}


function setProfile(id , cat){
	
	$.ajax({
		url: "{{ route('setProfile') }}",
    data: {'_token':'{{csrf_token()}}','id':id },
    type: 'POST',
    dataType:'json',

	 beforeSend: function() {        
	    
	    blockui('show');
	  },
    success: function(result){
    	
    	location.reload()
	    
	  }
	});
}
function setCover(id , cat){
	
	$.ajax({
		url: "{{ route('setCover') }}",
    data: {'_token':'{{csrf_token()}}','id':id },
    type: 'POST',
    dataType:'json',

	 beforeSend: function() {        
	    
	    blockui('show');
	  },
    success: function(result){
    	
    	location.reload()
	    
	  }
	});
}

function deletePhoto(id , image_category){
	Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
      
      form = new FormData();
      form.append('id' , id);
      form.append('_token' , '{{csrf_token()}}');
      $.ajax({
      url: '{{ route('deletePhoto') }}',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:form,
      dataType: 'json',
      beforeSend: function() 
      {        
        blockui('show')
      },
      success : function(res){
        blockui('hide')
        if (res.status == 'success') 
        {
            show_photos(image_category)
           
          }
        
        }
      });
      }
      else
      {
        return false;
      }
    })
	
}
function update_profile(e , form) {
            e.preventDefault();
            var btn = $(form).find('button[type="submit"]')
            $('.validation').remove()
            var btn_text = btn.text()
            
            if($('#new_password').val()!='' && $('#new_password').val()!=$('#c_password').val()){
            		$("#c_passworderror").html("Password and Confirm Password not match");
            		return false;
            }
            formdata = new FormData($(form)[0]);
            $.ajax({
                  url: '{{ route('user-update-profile') }}',
                  data: formdata,
                  processData: false,
                  contentType: false,
                  type: 'POST',
                  dataType:'json',
                 beforeSend: function() {        
                    btn.prop('disabled' , true);
                    btn.text('Processing..');
                    blockui('show');
                  },
                 success: function(result)
                 {
                    if(result.status == 'success')
                    {
                        blockui('hide');
                        btn.prop('disabled' , false);
                        btn.text(btn_text);
                        window.location.href = result.redirect
                    }else{
                    		blockui('hide');
                        btn.prop('disabled' , false);
                        btn.text(btn_text);
                    		$("#"+result.errorid).html(result.message);
                    }
                    
                  },
                  error :function($xhr,textStatus,res) {
                    btn.prop('disabled' , false);
                    btn.text(btn_text);
                    blockui('hide');
                    res = JSON.parse($xhr.responseText);

                    for (var err in res.errors) 
                    {
                        $("[name='" + err + "']").after("<div  class='label validation alert-danger'>" + res.errors[err] + "</div>");
                        $("[name='" + err + "']").focus();
                    }
                }
            });
           
            
        }
</script>
<script>
        $(document).ready(function () {
          
            $('#country-dd').on('change', function () {
                var idCountry = this.value;
                $("#city-dd").html('');
                blockui()
                $.ajax({
                    url: "{{url('api/fetch-cities')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#city-dd').html('<option value="">Select City</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        blockui('hide')
                    }
                });
            });
        });
    </script>
@endsection