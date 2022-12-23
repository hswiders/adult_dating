@extends('front.users.layouts.header')

		@section('content')
			<section id="content_outer_wrapper">
				<div id="content_wrapper">
					<div class="d-flex align-items-center justify-content-between mx-3 my-3">
						<div class="">
						<h3 class="h3 m-0">Close to you</h3>
						<p class="m-0">Girls whom you like and are located close to you</p>
					</div>
					<a href="{{ route('user-list',['close']) }}" class="btn btn-primary">See All</a>
					</div>

					<hr class="mx-3">

					<div id="content" class="container-fluid">
						<div class="content-body">
							{!! (string)view('front.users.ajax_data.user_listing' , ['members' => $close_to_you]) !!}

					<div class="d-flex align-items-center justify-content-between my-2">
						<div class="">
							<h3 class="h3 m-0">Online</h3>
							<p class="m-0">is online</p>
						</div>
						<a href="{{ route('user-list',['online']) }}" class="btn btn-primary">See All</a>
					</div>

					<hr class="">

					{!! (string)view('front.users.ajax_data.user_listing' , ['members' => $online_user]) !!}
							
						
							<!-- ENDS $dashboard_content -->
						</div>
					</div>
					<!-- ENDS $content -->
				</div>
@endsection('content')

@section('scripts')
<script type="text/javascript">
    jQuery(function ($) {
        var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $('#left-side-menu').find('a').each(function () {
        	console.log(path)
            if (this.href === path) {
                $(this).parent().addClass('active');
            }
        });
    });
</script>
@endsection('scripts')
