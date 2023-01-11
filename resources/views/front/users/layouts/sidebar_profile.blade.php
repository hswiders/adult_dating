<aside id="app_sidebar-right">
	<div class="sidebar-inner sidebar-overlay-profile scrollbar">
		<div class="">
			<div class="card profile-menu" id="profile-menu" style="display: block;">
				<header class="card-heading card-img alt-heading">
					<div class="profile">
						@php 
		$profileimage= asset(auth()->user()->profileimage); 
		@endphp
						<header class="card-heading card-background text-center" id="card_img_02">
							<img src="{{$profileimage}}" alt="" class="img-circle max-w-75 mCS_img_loaded">
						</header>
						<label href="javascript:void(0)" class="info" data-profile=" ">
							<span>{{ auth()->user()->email }} <a href="{{  route('user-logout')  }}">Logout</a></span ></label>
						</div>
					</header>
					
					<ul class="submenu" style="display:block">
						<li><a href="{{  route('profile-dashboard')  }}"><i class="zmdi zmdi-view-dashboard"></i> Dashboard</a></li>
						<li><a href="{{  route('user-profile')  }}"><i class="zmdi zmdi-account"></i> My Profile</a></li>
						<li><a href="{{  route('view-chat')  }}"><i class="zmdi zmdi-comment-more"></i>
						Chats</a></li>						
						<li><a href="{{  route('blocked-user')  }}"><i class="zmdi zmdi-block-alt"></i> You blocked them</a></li>
						<li><a href="{{  route('wink-to-user')  }}" class=""><i class="far fa-kiss-wink-heart"></i> You sent kisses to them</a></li>
						<li><a href="{{  route('pin-to-user')  }}" class=""><i class="fas fa-map-pin"></i> You pinned them</a></li>
						<li><a href="{{  route('viewed-by-user')  }}"><i class="far fa-eye"></i> They viewed your profile</a></li>
						<li><a href="{{  route('viewed-to-user')  }}"><i class="far fa-user-circle"></i> You viewed their profiles</a></li>
						<li><a href="{{  route('wink-by-user')  }}" class=""><i class="far fa-grin-hearts"></i> They sent you kisses</a></li>
						<li><a href="{{  route('pin-by-user')  }}" class=""><i class="fas fa-thumbtack"></i> They pinned you</a></li>
						<li><a href="help_center.php" class="comming_soon"><i class="zmdi zmdi-pin-help"></i> Help Center</a></li>
						<li><a href="javascript:void(0)" data-target="#delete_modal" data-toggle="modal"><i class="zmdi zmdi-delete"></i>
						Delete profile</a></li> 
					</ul>
				</div> 
				
			</div>
		</div>
	</aside>



