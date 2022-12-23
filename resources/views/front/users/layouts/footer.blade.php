<style type="text/css">
	.far.fa-regular.fa-thumbtack
{
    background:url('{{asset('uploads/thumbtacks.png')}}');
    background-size:cover;
    width:50px;
    height:18px;
    background-repeat:no-repeat;
    background-position:center;
}
.far.fa-regular.fa-thumbtack:before{
    content:''
}
</style>
<footer id="footer_wrapper">
	<div class="footer-content">
		<div class="row copy-wrapper">
			<div class="col-xs-12">
				<p class="copy">&copy; Copyright <time class="year"></time> Adult - All Rights Reserved</p>
			</div>
		</div>
	</div>
</footer>
</section>
<aside id="app_sidebar-right">
	<div class="sidebar-inner sidebar-overlay">
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
						<li><a href="app-chat.php"><i class="zmdi zmdi-comment-more"></i>
						Chats</a></li>						
						<li><a href="{{  route('blocked-user')  }}"><i class="zmdi zmdi-block-alt"></i> You blocked them</a></li>
						<li><a href="{{  route('wink-to-user')  }}" class=""><i class="far fa-kiss-wink-heart"></i> You sent kisses to them</a></li>
						<li><a href="{{  route('pin-to-user')  }}" class=""><i class="fas fa-map-pin"></i> You pinned them</a></li>
						<li><a href="{{  route('viewed-by-user')  }}" class=""><i class="far fa-eye"></i> They viewed your profile</a></li>
						<li><a href="{{  route('viewed-to-user')  }}" class=""><i class="far fa-user-circle"></i> You viewed their profiles</a></li>
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
	<div class="modal fullscreen fade" id="fullscreen_modal" tabindex="-1" role="dialog" aria-labelledby="fullscreen_modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content" id="user_content">
				
			</div>
		</div>
	</div>
		</div>



<script src="{{ url('/public/front') }}/assets/js/vendor.bundle.js"></script>

<script src="{{ url('/public/front') }}/assets/js/app.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>
<script src="https://kit.fontawesome.com/107d2907de.js" crossorigin="anonymous"></script>
<script src="{{asset('plugins/plupload/js/plupload.full.min.js')}}"></script>
<script src="{{asset('plugins/plupload/js/jquery.ui.plupload/jquery.ui.plupload.min.js')}}"></script>
<script type="text/javascript">
      function blockui(action='show') {
          if (action == 'show') 
          {
            $.blockUI({message:'<div class="spinner-border text-primary" role="status"></div>',css:{backgroundColor:"transparent",border:"0"},overlayCSS:{backgroundColor:"#fff",opacity:.8}})
          }
          else
          {
             $.unblockUI()
          }
        }

jQuery(document).ready(function($) {
	$('.comming_soon').attr('href', 'javascript:;');
});
        jQuery(document).on('click' , '.comming_soon',function(){
  alert('comming soon')
})
</script>
@if( Session::has('success')) 
<script type="text/javascript">
    toastr['success']('{{  Session::get('success') }}', 'Success!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                });
</script>
    
@endif
@if( Session::has('error')) 

    <script type="text/javascript">
    toastr['error']('{{  Session::get('error') }}', 'Error!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                });
</script>
@endif
<script type="text/javascript" id="user_modal_js">
	var user_modal = $('#fullscreen_modal')

	function show_user_detail(id)
	{
		$.ajax({
		url: "{{ route('member-detail') }}",
	    data: {'_token':'{{csrf_token()}}','id':id },
	    type: 'POST',
	    dataType:'json',
		beforeSend: function() 
		{        
		    blockui('show');
		},
	    success: function(result)
	    {
	    	console.log(result)
	    	$('#user_content').html(result.html);
	    	user_modal.modal('show');
		    blockui('hide');
		    
		 }
	});
	}
	function show_photos(image_category , user_id){
	
	$.ajax({
		url: "{{ route('show_photos') }}",
    data: {'_token':'{{csrf_token()}}','image_category':image_category ,'user_id':user_id },
    type: 'POST',
    dataType:'json',

	 beforeSend: function() {        
	    
	    blockui('show');
	  },
    success: function(result){
    	
    	$('#profile-pub').html(result.html);
    	$('#uploader'+image_category+'_filelist').html('');
    	$('.plupload_total_status').text('0%');
    	$('.plupload_total_file_size').text('0kb');
	   
	    blockui('hide');
	    
	  }
	});
}
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

function pin_user(user_id ){
	
	$.ajax({
		url: "{{ route('pin-user') }}",
    data: {'_token':'{{csrf_token()}}', 'user_id':user_id },
    type: 'POST',
    dataType:'json',

	 beforeSend: function() {        
	    
	    blockui('show');
	  },
    success: function(result)
    {
    	$('.pin_user'+user_id).find('i').attr('class' , '')
    	if (result.status == 1) {
    		$('.pin_user'+user_id).find('i').addClass('fas fa-solid fa-thumbtack');
    		toastr['success']('User Pinned Successfully', 'Success!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                });
    	}
    	else
    	{
    		$('.pin_user'+user_id).find('i').addClass('far fa-regular fa-thumbtack')
    		toastr['success']('User Removed from Pinned Successfully', 'Success!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                });
    	}
    	
	    blockui('hide');
	    
	  }
	});
}

function wink_user(user_id ){
	if($('.wink_user'+user_id).find('i').hasClass('text-danger'))
	{
		name = $('.wink_user'+user_id).data('name');
		profile = $('.wink_user'+user_id).data('profile');
		Swal.fire({
		  title: 'You have already sent kisses to '+name+' A few hours ago',
		  text: 'Do you want to send her again?',
		  imageUrl: profile,
		  imageWidth: 400,
		  imageHeight: 200,
		  imageAlt: 'Custom image',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, Send it!'
		}).then((result) => {
		  if (result.isConfirmed) {
		    sendWink(user_id)
		  }
		})
	}
	else
	{
		sendWink(user_id)
	}
	
}
function sendWink(user_id) {
	$.ajax({
		url: "{{ route('wink-user') }}",
    data: {'_token':'{{csrf_token()}}', 'user_id':user_id },
    type: 'POST',
    dataType:'json',

	 beforeSend: function() {        
	    
	    blockui('show');
	  },
    success: function(result)
    {
    	if (result.status == 1) {
    		$('.wink_user'+user_id).find('i').addClass('fas fa-kiss-wink-heart text-danger');
    		toastr['success']('Wink Sent Successfully', 'Success!!', {
                    closeButton: true,
                    positionClass: 'toast-top-right',
                    progressBar: true,
                    newestOnTop: true,
                });
    	}
    	
	    blockui('hide');
	    
	  }
	});
}

function block_user(user_id)
{
	name = $('.wink_user'+user_id).data('name');
	profile = $('.wink_user'+user_id).data('profile');
	Swal.fire({
		  title: 'Block '+name+'',
		  text: 'Do you want to Block her?',
		  imageUrl: profile,
		  imageWidth: 400,
		  imageHeight: 200,
		  imageAlt: 'Custom image',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, Block it!'
		}).then((result) => {
		  if (result.isConfirmed) {
		    blockUser(user_id)
		  }
		})
}
function blockUser(user_id) {
	$.ajax({
		url: "{{ route('block-user') }}",
    data: {'_token':'{{csrf_token()}}', 'user_id':user_id },
    type: 'POST',
    dataType:'json',

	 beforeSend: function() {        
	    
	    blockui('show');
	  },
    success: function(result)
    {
    	if (result.status == 1) {
    		// $('.wink_user'+user_id).find('i').addClass('fas fa-kiss-wink-heart text-danger');

    		// toastr['success']('{{  Session::get('success') }}', 'Success!!', {
      //               closeButton: true,
      //               positionClass: 'toast-top-right',
      //               progressBar: true,
      //               newestOnTop: true,
      //           });
    		location.reload();
    		
    	}
    	
	    blockui('hide');
	    
	  }
	});
}
function unblock_user(user_id)
{
	name = $('.block_user'+user_id).data('name');
	profile = $('.block_user'+user_id).data('profile');
	Swal.fire({
		  title: 'Unblock '+name+'',
		  text: 'Do you want to Unblock her?',
		  imageUrl: profile,
		  imageWidth: 400,
		  imageHeight: 200,
		  imageAlt: 'Custom image',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, Unblock it!'
		}).then((result) => {
		  if (result.isConfirmed) {
		    unblockUser(user_id)
		  }
		})
}
function unblockUser(user_id) {
	$.ajax({
		url: "{{ route('unblock-user') }}",
    data: {'_token':'{{csrf_token()}}', 'user_id':user_id },
    type: 'POST',
    dataType:'json',

	 beforeSend: function() {        
	    
	    blockui('show');
	  },
    success: function(result)
    {
    	if (result.status == 1) {
    		// $('.wink_user'+user_id).find('i').addClass('fas fa-kiss-wink-heart text-danger');
    		// toastr['success']('Unblocked Successfully', 'Success!!', {
      //               closeButton: true,
      //               positionClass: 'toast-top-right',
      //               progressBar: true,
      //               newestOnTop: true,
      //           });
    		location.reload();
    	}
    	
	    blockui('hide');
	    
	  }
	});
}
function markAsRead(id , elem , remove='no') {
	$.ajax({
		url: "{{ route('read-notification') }}",
    data: {'_token':'{{csrf_token()}}', 'id':id ,'remove':remove },
    type: 'POST',
    dataType:'json',

	 beforeSend: function() {        
	    
	    blockui('show');
	  },
    success: function(result)
    {
    	url = $(elem).data('url')
    	if (result.status == 1) {

    		if (url == '#' || remove != 'no') {
    			location.reload();
    		}
    		else
    		{
    			window.location.href = url;
    		}
    		
    	}
    	
	    blockui('hide');
	    
	  }
	});
}
</script>

</body>	 
</html>