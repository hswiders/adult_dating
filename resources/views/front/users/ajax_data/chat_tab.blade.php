@if (isset($chats['users']))

@forelse (@$chats['users'] as $element)
@if ($element->sender->id != $my_user->id)

<div class="chat-row response">
	<img src="{{ asset($element->sender->profileimage) }}" alt="" class="img-circle img-sm pull-left">
	<div class="bubble_response">
		<div class="message">
			@if($element->msg_type == 'text')
				<p>{{$element->message}}</p>
			@elseif($element->msg_type == 'image')
				<p><a class="venobox" data-gall="mygallery" data-title="" href="{{ asset($element->message) }}"> <img src="{{ asset($element->message) }}" width="200px"></a></p>
			@elseif($element->msg_type == 'video')
			<p class="video_box">
					<a href="{{ asset($element->message) }}" class="venobox" data-gall="mygallery" data-autoplay="true" data-vbtype="video"  data-title="" > 
						<video width="200px" >
				  		<source src="{{ asset($element->message) }}" >
				  		Your browser does not support HTML video.
						</video>
						
					</a>
					<a  data-gall="mygallery" data-autoplay="true" data-vbtype="video"  data-title="" href="{{ asset($element->message) }}" class="venobox play_icon"><i class="fa fa-play"></i></a>
				</p>
			@endif
		</div>
		<div class="date">
			{{ \Carbon\Carbon::parse($element->create_date)->diffForHumans() }}
		</div>
	</div>
</div>
@else
<div class="chat-row first">
	<img src="{{ asset($element->sender->profileimage) }}" alt="" class="img-circle img-sm pull-right">
	<div class="bubble">
		<div class="message">
			@if($element->msg_type == 'text')
				<p>{{$element->message}}</p>
			@elseif($element->msg_type == 'image')
				<p><a class="venobox" data-gall="mygallery" data-title="" href="{{ asset($element->message) }}"> <img src="{{ asset($element->message) }}" width="200px"></a></p>
			@elseif($element->msg_type == 'video')
			<p class="video_box">
					<a href="{{ asset($element->message) }}" class="venobox" data-gall="mygallery" data-autoplay="true" data-vbtype="video"  data-title="" > 
						<video width="200px" >
				  		<source src="{{ asset($element->message) }}" >
				  		Your browser does not support HTML video.
						</video>
						
					</a>
					<a  data-gall="mygallery" data-autoplay="true" data-vbtype="video"  data-title="" href="{{ asset($element->message) }}" class="venobox play_icon"><i class="fa fa-play"></i></a>
				</p>
			@endif
		</div>
		<div class="date">
			{{ \Carbon\Carbon::parse($element->create_date)->diffForHumans() }}
		</div>
	</div>
</div>
@endif

@empty

	<div class="alert alert-warning">Start a new chat by send your first message.</div>
@endforelse
	
@else 
<div class="alert alert-warning">Start a new chat by send your first message.</div>
@endif