
	@forelse ($members as $element)
		<div class="col-sm-3">
        <div class="card type--profile card_power_inner ">
          <header class="card-heading">
            <img src="{{asset($element->profileimage)}}" alt="" class="img-circle">
          </header>
          <div class="card-body">
            <h3 class="name p-0 fw-bold text-black">{{$element->first_name }} {{  $element->last_name }}</h3>
            <span class="subtitle">{{ getCity($element->city , 'name') }} ,{{getCountry($element->country , 'name')}}</span>
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
          @if($type != 'blocked')
          <div class="card-footer border-top align-items-center d-flex justify-content-between p-0 px-2 bg-white radius_10">

            <ul class="card-actions icons right-bottom">
              <li>
                <a href="javascript:void(0)"  onclick="wink_user({{ $element->id }} )" data-name="{{ $element->first_name }}" data-profile="{{ asset($element->profileimage) }}" class="wink_user{{ $element->id }}">
                      <i class="{{ checkIfWink( $element->id , auth()->user()->id ) }}" aria-hidden="true"></i>
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
                <a href="javascript:void(0)" onclick="pin_user({{ $element->id }})" class="pin_user{{ $element->id }}">
                  <i id="pin_user{{ $element->id }}" class="{{ checkIfPin( $element->id , auth()->user()->id ) }}" aria-hidden="true"></i>
                </a>
              </li>
            </ul>
          </div>
          @else
          <div class="d-flex align-items-center justify-content-center">
          <a href="javascript:void(0)" data-name="{{ $element->first_name }}" data-profile="{{ asset($element->profileimage) }}" onclick="unblock_user({{ $element->id }})"class="btn btn-sm btn-round btn-default block_user{{ $element->id }}">Unblock</a>
        </div>
        @endif
          <ul class="card-actions icons right-top">
            <li class="dropdown">
              <a href="javascript:void(0)" class="text-black" data-toggle="dropdown" aria-expanded="false">
                <i class="zmdi zmdi-more-vert white-text"></i>
              </a>
              <ul class="dropdown-menu btn-primary dropdown-menu-right">
                
                <li>
                  @if(!checkIfBlocked( $element->id , auth()->user()->id ))
                  <a href="javascript:void(0)" onclick="block_user({{ $element->id }})">Block</a>
                  @else
                  <a href="javascript:void(0)" data-name="{{ $element->first_name }}" data-profile="{{ asset($element->profileimage) }}" class="block_user{{ $element->id }}" onclick="unblock_user({{ $element->id }})">Unblock</a>
                  @endif
                </li>
                <li>
                  <a href="javascript:void(0)" onclick="show_user_detail('{{ $element->id }}')">View Profile</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
	@empty
		<div class="no-data-found text-center col-sm-12">
			<img src="{{ asset('uploads/no-data-found.png') }}">
		</div>
	@endforelse