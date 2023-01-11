@extends('front.users.layouts.header')
<style type="text/css">
	/*#app_sidebar-left
	{
		display: none;
	}*/
	section#chat-wrapper {
		padding: 0px 21px 80px 21px;
}
i.emoji-picker-icon.emoji-picker.fa.fa-smile-o {
    left: 13px;
    clear: both;
    width: 0;
    top: 12px;
}

.emoji-menu {
    left: 0;
    bottom: 50;
}
</style>
		@section('content')
<section id="chat_module" class="mt-65">
				<div id="content_wrapper">
					<div id="content" class="container px-0">
						<div id="content_type" class="boxed-leftnav card drawer">
							<div id="leftnav">
								<div class="card">
									<header class="card-heading">
										<ul class="card-actions icons left-top">
											Chat Users
										</ul>
										{{-- <ul class="card-actions icons right-top">
											<li class="dropdown">
												<a href="javascript:void(0)" data-toggle="dropdown">
													<i class="zmdi zmdi-more-vert"></i>
												</a>
												<ul class="dropdown-menu btn-primary dropdown-menu-right">
													<li>
														<a href="javascript:void(0)">All</a>
													</li>
													<li>
														<a href="javascript:void(0)">Online</a>
													</li>
													<li>
														<a href="javascript:void(0)">Unread</a>
													</li>
													<li>
														<a href="javascript:void(0)">Requests</a>
													</li>
												</ul>
											</li>
										</ul> --}}
									</header>
									<div class="card-body">
										<ul class="list-group scrollbar" id="chat_users"></ul>
									</div>
								</div>
							</div>
							<div class="content-body">
								<div class="card">
									<header class="card-heading">
										
										<ul class="active-contact" id="client_data">
											
										</ul>
										
										<ul class="card-actions icons right-top">
											{{-- <li>
												<a href="javascript:void(0)">
													<i class="zmdi zmdi-videocam"></i>
												</a>
											</li>
											<li class="expand">
												<a href="javascript:void(0)" data-toggle-expand="content-expanded" data-key="contentExpand" data-expand-location="chat">
													<i class="zmdi zmdi-fullscreen"></i>
												</a>
											</li> --}}
											{{-- <li class="dropdown">
												<a href="javascript:void(0)" data-toggle="dropdown">
													<i class="zmdi zmdi-more-vert"></i>
												</a>
												<ul class="dropdown-menu btn-primary dropdown-menu-right">
													<li>
														<a href="javascript:void(0)">Translation</a>
													</li>
													<li>
														<a href="javascript:void(0)">Delete Conversation</a>
													</li>
													<li>
														<a href="javascript:void(0)">Photos Access Settings</a>
													</li>
													<li>
														<a href="javascript:void(0)">Donate Luns</a>
													</li>
													<li>
														<a href="javascript:void(0)">Date</a>
													</li>
													<li>
														<a href="javascript:void(0)">Delete</a>
													</li>
												</ul>
											</li> --}}
										</ul>
									</header>
									<div class="card-body mw-lightGray scrollbar" id="chat_tab">
										<section id="chat-wrapper"></section>
									</div>
									<div class="card-footer p-10">
										{{-- <ul class="card-actions icons left-bottom">
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
										</ul> --}}
										<div class="form-group m-10 p-0 p-l-75 is-empty" id="send_msg_bar">
											<div class="input-group">
												<label class="sr-only">Send Message...</label>
												<input id="chat_message_input" type="text" class="form-control form-rounded input-lightGray" placeholder="Send Message...." data-emojiable="true">
												<label class="ms-1 text-muted" style="cursor: pointer;"><i class="fa fa-paperclip"></i><input type="file" onchange="send_message('file')" name="chat_file" accept="image/* , video/*" id="chat_file" style="display: contents;"></label>
												<span class="input-group-btn">
													<button type="button" id="send_btn_chat" onclick="send_message()" class="btn btn-blue btn-fab animate-fab btn-fab-sm">
														<i class="zmdi zmdi-mail-send"></i>
													</button>
												</span>
											</div>
										</div>
									</div>
								</div>
								<!--Chat Contact List -->
								
												</div>
												
												</div>
											</div>
											
										</div>
										
				<!-- <footer id="footer_wrapper">
				  <div class="footer-content">
				      <div class="row copy-wrapper">
				        <div class="col-xs-12">
				          <p class="copy">&copy; Copyright <time class="year"></time> Adult - All Rights Reserved</p>
				        </div>
				      </div>
				    </div>
				  </footer> -->
			</section>
@endsection

@section('scripts')
<link href="{{asset('')}}/front/emoji-picker/lib/css/emoji.css" rel="stylesheet"> 
<script src="{{asset('')}}/front/emoji-picker/lib/js/config.js"></script>
<script src="{{asset('')}}/front/emoji-picker/lib/js/util.js"></script>
<script src="{{asset('')}}/front/emoji-picker/lib/js/jquery.emojiarea.js"></script>
<script src="{{asset('')}}/front/emoji-picker/lib/js/emoji-picker.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/venobox/2.0.4/venobox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/venobox/2.0.4/venobox.min.js"></script>
<script type="text/javascript">
	function initVenobox()
	{
		new VenoBox({
    selector: ".venobox"
		});
		
	}
</script>
<script type="text/javascript">
	var active_client_id = 0;
  var active_is_group = 0;
  var csrf = '{{ csrf_token() }}';
  let scroll_to_bottom = '';
  function open_chat(client_id , open=0 ) 
  {
    
    $.ajax({
        url: '{{route('ajax_chat_between_users')}}',
        type: 'post',
        dataType: 'json',
        data: {'client_id':client_id , 'open':open , '_token':csrf },
        success: function (data) 
        {
          active_client_id = client_id;
          $('#chat-wrapper').html(data.html)
          
          $('#client_data').html( data.client_data);
          scroll_to_bottom = document.getElementById('chat_tab');
          scrollBottom(scroll_to_bottom);
          $('.chat_userss').removeClass('active')
          $('.cc'+client_id).addClass('active')
          initVenobox()
	          
	    }
      });
  }
  window.emojiPicker = new EmojiPicker({
	  emojiable_selector: '[data-emojiable=true]',
	  assetsPath: '{{asset('')}}/front/emoji-picker/lib/img/',
	  popupButtonClasses: 'fa fa-smile-o'
	});

	window.emojiPicker.discover();
	$('.emoji-wysiwyg-editor').keypress(function(e){
		if(e.which === 13)
		{

		  $('.emoji-wysiwyg-editor').blur(); 
		  $('#send_btn_chat').click();
		  
		}

	   

	});
  function refresh_chat_users( is_first=0)
 {
  $.ajax({
        url: '{{route('ajax_chat_users')}}',
        type: 'post',
        data: {'_token':csrf , 'hi':'hii'},
        success: function (data) 
        {
          
            $('#chat_users').html(data)
            	if (is_first) 
            	{
            		@if ($client_id)
            			open_chat({{ $client_id }})
	            	@else 
	            		if ($('.chat_userss').length) 
	            		{
	            			$('.chat_userss:first-child').trigger('click')
	            		}
	            		else
	            		{
	            			$('#send_msg_bar').hide();
	            			$('#send_msg_bar').hide();
	            	
          					$('#client_data').hide();
          					$('#chat-wrapper').html('<div class="alert alert-danger"> No user to chat </div><div class="text-center mt-5"><a class="btn btn-primary" href="{{ url('members/all') }}">Find users</a></div>')
	            		}
	            		
	            	@endif
            	}
            	
            	
          	
          
        }
      });
}
jQuery(document).ready(function($) {
	
	 refresh_chat_users(1)
});
 setInterval(function()
  {
     //alert(active_client_id)
     //refresh_chat_users()
  
      if(active_client_id != 0)
      {
        //open_chat(active_client_id , 0 );
      }
      
    
  } , 10000);
 
  
  function send_message(is_file=false) 
  {
  	client_id = active_client_id;
    message = $('#chat_message_input').val();
    chat_file = $('#chat_file').val();
    $('#chat_message_input').val('')
     $(".emoji-wysiwyg-editor").html('');
    //$('.emoji-wysiwyg-editor').text('')
    
    if(message.trim() == '' && chat_file.trim() == '')
    {
      toastr['error']('Please type a msg', 'Oops..!!', {
                      closeButton: true,
                      positionClass: 'toast-top-right',
                      progressBar: true,
                      newestOnTop: true,
                  });
      return false;
    }
    fd = new FormData();
    fd.append('client_id' , client_id);
    fd.append('message', message);
    fd.append('_token' , csrf);
    if(chat_file.trim() != '')
    {
    	var files = $('#chat_file');
    	fd.append('files' , files[0].files[0]);
    }
    
    $.ajax({
    	 xhr: function() {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function(evt) {
            if (evt.lengthComputable) {
                var percentComplete = (evt.loaded / evt.total) * 100;
                console.log(percentComplete)
                if(chat_file.trim() != '')
    						{
                	$('.blockUI.blockMsg').html('<progress id="progressBar" value="'+Math.round(percentComplete)+'" max="100" style="width:300px;"></progress><h3 id="status">'+Math.round(percentComplete)+' % uploaded... please wait </h3>')
              	}
            }
        }, false);
        return xhr;
    },
        url: '{{route('ajax_send_message')}}',
        type: 'post',
        processData: false,
        contentType: false,
        dataType:'json',
        data: fd,
        beforeSend: function() {
        blockui()        
        $('#chat_message_input').val('')
           $('#chat_file').val('')
          $('.emoji-wysiwyg-editor').text('')
      },
        success: function (data) 
        {
        	blockui('hide');
        	console.log(data);
          open_chat(client_id , 0 );
        	refresh_chat_users()
        	if(data.chats.status == 0)
        	{
        		 toastr['error'](data.chats.msg, {
                      closeButton: true,
                      positionClass: 'toast-top-right',
                      progressBar: true,
                      newestOnTop: true,
                  });
      			return false;
        	}
        }
      });
  }
  
 
    function scrollBottom(element) {
      element.scroll({ top: element.scrollHeight})
    }
</script>
@endsection