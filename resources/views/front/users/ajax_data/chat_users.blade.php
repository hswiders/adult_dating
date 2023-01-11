@forelse ($user_list as $element)

<li class="list-group-item chat_userss cc{{$element->data->id}}" onclick="open_chat({{$element->data->id}} , 1 , 1)" >
	<span class="pull-left"><img src="{{ asset($element->data->profileimage) }}" alt="" class="img-circle img-sm m-r-10"></span>
	<div class="list-group-item-body">
		<div class="list-group-item-heading">{{ $element->data->full_name }} 
			@if ($element->unread)
				<span class="pull-right"> 
					<span class="label label-danger">{{ $element->unread }}</span>
				</span>
			@endif
			
		</div>
		<div class="list-group-item-text">
			{!! ($element->unread) ? '<b>' : '' !!}
			  @if($element->last_message->msg_type == 'text')	
				{{ $element->last_message->message }}
			  @elseif($element->last_message->msg_type == 'image')
			  	<i class="fa fa-image"></i> Image
			  @elseif($element->last_message->msg_type == 'video')
			  	<i class="fa fa-video"></i> Video
			  @endif
			  
			{!! ($element->unread) ? '</b>' : '' !!}
		</div>
	</div>

</li>
@empty
<li class="list-group-item ">
	<div class="alert alert-danger">No user found</div>
</li>
@endforelse


