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

<section class="left_align_content">
	<div class="mt-65"></div>

	<div class="card p-3">
		<div class="row">
			<div class="col-sm-3 text-center">
				<div class="dash_bx shadow">
				<div class="text-center number">
					<p class="m-0">{{$kisses}} <i class="far fa-kiss-wink-heart"></i></p>
				</div>
				<h3 class="text-center font-size-30">Kisses</h3>				
			</div>
			</div>
			<div class="col-sm-3 text-center">
				<div class="dash_bx shadow">
				<div class="text-center number">
					<p class="m-0">0 <i class="zmdi zmdi-comment-more"></i></p>					
				</div>
				<h3 class="text-center font-size-30 ">Chats</h3>
			</div>
			</div>
			<div class="col-sm-3 text-center">
				<div class="dash_bx shadow">
				<div class="text-center number">
					<p class="m-0">{{$pins}} <i class="fas fa-thumbtack" aria-hidden="true"></i></p>
				</div>
				<h3 class="text-center font-size-30 ">Pins</h3>
			</div>
			</div>
			<div class="col-sm-3 text-center">
				<div class="dash_bx shadow">
				<div class="text-center number">
					<p class="m-0">0 <i class="zmdi zmdi-favorite-outline"></i></p>
				</div>
				<h3 class="text-center font-size-30">You Rated</h3>
			</div>
			</div>


		</div>
	</div>


	<div class="m-3">
		<div class="card mt-3 mb-0 border-bottom">
			<header class="card-heading py-2">
				<h2 class="card-title fw-bold text-black">Your Top Contacts</h2>
				<p class="m-0 p-0">You interact often with these girls</p>
			</header>
		</div>
		
		@if (!$contact_wink->isEmpty())
			
		
		<div class="row card mx-0 ps-3">
			<div class="card type--profile card_power_inner col-sm-3 ">
          <header class="card-heading">
            <img src="{{asset($contact_wink[0]->profileimage)}}" alt="" class="img-circle">
          </header>
          <div class="card-body">
            <h3 class="name p-0 fw-bold text-black">{{$contact_wink[0]->first_name }} {{  $contact_wink[0]->last_name }}</h3>
            <span class="subtitle">{{ getCity($contact_wink[0]->city , 'name') }} ,{{getCountry($contact_wink[0]->country , 'name')}}</span>
            {{-- <span class="text-white">
              <a href="javascript:void(0)">
                <i class="zmdi zmdi-favorite"></i>
              </a>
              <a href="javascript:void(0)">
                <i class="zmdi zmdi-favorite"></i>
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
            <!-- <button type="button" class="btn btn-primary btn-round">Connect</button> -->
          </div>
         
          <div class="card-footer border-top align-items-center d-flex justify-content-between p-0 px-2 bg-white radius_10">

            <ul class="card-actions icons right-bottom">
              <li>
                <a href="javascript:void(0)"  onclick="wink_user({{ $contact_wink[0]->id }} )" data-name="{{ $contact_wink[0]->first_name }}" data-profile="{{ asset($contact_wink[0]->profileimage) }}" class="wink_user{{ $contact_wink[0]->id }}">
                      <i class="{{ checkIfWink( $contact_wink[0]->id , auth()->user()->id ) }}" aria-hidden="true"></i>
                    </a>
              </li>
              <li>
                <a href="javascript:void(0)">
                  <i class="far fa-comment-dots" aria-hidden="true"></i>
                </a>
              </li>
            </ul>

            <ul class="card-actions icons right-bottom">
              <li>
                <a href="javascript:void(0)" onclick="pin_user({{ $contact_wink[0]->id }})" class="pin_user{{ $contact_wink[0]->id }}">
                  <i id="pin_user{{ $contact_wink[0]->id }}" class="{{ checkIfPin( $contact_wink[0]->id , auth()->user()->id ) }}" aria-hidden="true"></i>
                </a>
              </li>
            </ul>
          </div>
          
          <ul class="card-actions icons right-top">
            <li class="dropdown">
              <a href="javascript:void(0)" class="text-black" data-toggle="dropdown" aria-expanded="false">
                <i class="zmdi zmdi-more-vert white-text"></i>
              </a>
              <ul class="dropdown-menu btn-primary dropdown-menu-right">
                
                <li>
                  @if(!checkIfBlocked( $contact_wink[0]->id , auth()->user()->id ))
                  <a href="javascript:void(0)" onclick="block_user({{ $contact_wink[0]->id }})">Block</a>
                  @else
                  <a href="javascript:void(0)" data-name="{{ $contact_wink[0]->first_name }}" data-profile="{{ asset($contact_wink[0]->profileimage) }}" class="block_user{{ $contact_wink[0]->id }}" onclick="unblock_user({{ $contact_wink[0]->id }})">Unblock</a>
                  @endif
                </li>
                <li>
                  <a href="javascript:void(0)" onclick="show_user_detail('{{ $contact_wink[0]->id }}')">View Profile</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
			<div class="col-sm-9 pe-0">
				<div class="gallary">
				<div class="row m-0">
					
					@foreach($contact_wink as $key => $user)
					@php
						if ($key == 0) {
							continue;
						}
					 //$user = DB::table('users')->where('id',$wink->wink_by)->first(); 
					 @endphp
					<div class="col-xs-3">
						<a href="javascript:void(0)" onclick="show_user_detail('{{ $user->id }}')">
							<img src="{{url('public/'.$user->profileimage)}}" alt="">
						</a>
					</div>
					@endforeach
					
				</div>
				</div>
			</div>
		</div>
		@endif
	</div>

	<div class="mb-3 m-3">
		<div class="card mt-3 mb-0 border-bottom">
			<header class="card-heading py-2">
				<h2 class="card-title fw-bold text-black">Kisses</h2>
				<p class="m-0 p-0">The kisses you sent and the response you had to them.</p>
			</header>
		</div>
		<div class="card">
			<div class="card-body p-t-0">
				<div class="chart"> 
					<div id="dashboardC3Donut" data-kisses="{{$kisses}}" data-received="{{$kisses_received}}"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="m-3 mb-5">
		<div class="row">
			<div class="col-sm-6">
				<div class="card mt-3 mb-0 border-bottom">
					<header class="card-heading py-2">
						<h2 class="card-title fw-bold text-black">Pins</h2>
						<p class="m-0 p-0">Pin Anyone You Like!</p>
					</header>
				</div>
				<div class="card view_crd">
					<div class="d-flex align-items-center justify-content-between mx-3 border-bottom">
						<div class="dash_bx">
							<div class="text-center number">
								<p class="m-0">{{$pins_by}} <i class="far fa-kiss-wink-heart" aria-hidden="true"></i></p>
							</div>
							<h3 class="text-left">Your Pins</h3>				
						</div>
						<a class="btn-primary btn btn-sm" href="{{route('pin-to-user')}}">See all</a>
					</div>
					<div class="d-flex align-items-center justify-content-between mx-3">
						<div class="dash_bx">
							<div class="text-center number">
								<p class="m-0">{{$pins}} <i class="far fa-kiss-wink-heart" aria-hidden="true"></i></p>
							</div>
							<h3 class="text-left">They Pinned You</h3>				
						</div>
						<a class="btn-primary btn btn-sm" href="{{route('pin-by-user')}}">See all</a>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="card mt-3 mb-0 border-bottom">
					<header class="card-heading py-2">
						<h2 class="card-title fw-bold text-black">Views</h2>
						<p class="m-0 p-0">Girls Who Viewed Your Pfofile and You Viewed Back Theirs</p>
					</header>
				</div>
				<div class="card view_crd">
					<div class="d-flex align-items-center justify-content-between mx-3 border-bottom">
						<div class="dash_bx">
							<div class="text-center number">
								<p class="m-0">{{$viewed_by}} <i class="far fa-kiss-wink-heart" aria-hidden="true"></i></p>
							</div>
							<h3 class="text-left">Girls Whom You Viewed</h3>				
						</div>
						<a href="{{route('viewed-to-user')}}" class="btn-primary btn btn-sm">See all</a>
					</div>
					<div class="d-flex align-items-center justify-content-between mx-3 border-bottom">
						<div class="dash_bx">
							<div class="text-center number">
								<p class="m-0">{{$viewed_to}} <i class="far fa-kiss-wink-heart" aria-hidden="true"></i></p>
							</div>
							<h3 class="text-left">Girls Who Viewed Your Profile</h3>				
						</div>
						<a class="btn-primary btn btn-sm" href="{{route('viewed-by-user')}}">See all</a>
					</div>
				</div>
			</div>
		</div>
	</div>


@endsection

@section('right_sidebar')
@include('front.users.layouts.sidebar_profile')
@endsection
@section('scripts')
