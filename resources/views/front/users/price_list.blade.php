@extends('front.users.layouts.header')
@section('wallet-sidebar')
@include('front.users.layouts.sidebar_wallet')
@endsection

@section('content')

<section id="content_outer_wrapper" class="common_p">

    <div style="padding-top: 65px;"></div>

  <div class="m-3">
    <div class="card">
      <header class="card-heading m-0 pb-1 bg-primary">
        <h2 class="card-title text-white fw-bold">Charges</h2>
        <p class="text-white m-0">
         What is paid, what is free and what are the costs:
       </p>
      </header>
    </div>
    
    <div class="row">
      <div class="col-sm-6">
        <div class="card card_price">
          <div class="card-body m-0 bg-white">

            <div class="d-flex d-flex align-items-center justify-content-between">
              <div class="">
                <p class="fw-bold mb-3">The characters that а message contains</p>
                <p class="m-0 mb-2 ms-1"><span class="text-green">Cost:</span> The cost per each 30 characters is <span class="text-black fw-bold">{{$payment_setting->men_send_msg_price}} Coins</span></p>
                <!-- <div class="bg-success radius_5 p-3 shadow">
                  <p class="fw-bold m-0 mb-1 text-black">For example:</p>
                  <p class="m-0">1 message of 22 characters costs <span class="text-black fw-bold">13 Luns</span></p>
                </div> -->
              </div>

               <img src="{{ url('/public/front') }}/img/message.png" class="img_gifts">

            </div>
          </div>
        </div>
      </div>

     <!--  <div class="col-sm-6">
        <div class="card card_price">
          <div class="card-body m-0 bg-white">

            <div class="d-flex align-items-center justify-content-between">
              <div class="">
                <p class="fw-bold mb-3">2. Auto Translation</p>
                <p class="m-0 mb-2 ms-1 mb-5"><span class="text-green">Cost:</span> The cost is calculated the same way as the message cost <span class="text-black fw-bold">13 Luns per 30 characters</span></p>
                
              </div>
                <img src="{{ url('/public/front') }}/img/translation.png" class="img_gifts">


            </div>
          </div>
        </div>
      </div> -->

       <!-- <div class="col-sm-6">
        <div class="card card_price">
          <div class="card-body m-0 bg-white">

            <div class="d-flex d-flex align-items-center justify-content-between">
              <div class="">
                <p class="fw-bold mb-3">3. Human translation</p>
                <p class="m-0 mb-2 ms-1"><span class="text-green">Cost:</span> The cost per each 30 characters is <span class="text-black fw-bold">13 Luns</span></p>
                <div class="bg-success radius_5 p-3 shadow">
                  <p class="fw-bold m-0 mb-1 text-black">For example:</p>
                  <p class="m-0" style="font-size: 12px;">Even If a "Hi" is been sent <span class="text-black fw-bold">the wost will be 50 Luns</span></p>
                </div>
              </div>

              
              <img src="{{ url('/public/front') }}/img/translator.png" class="img_gifts">
            </div>
          </div>
        </div>
      </div> -->


      <!--  <div class="col-sm-6">
        <div class="card card_price">
          <div class="card-body m-0 bg-white">

            <div class="d-flex align-items-center justify-content-between">
              <div class="">
                <p class="fw-bold mb-3">4. Stickers, GIFS & Gifts.</p>
                <p class="m-0 mb-2 ms-1 mb-5"><span class="text-green">Cost:</span> <span class="fw-bold">Each one has a price on it</span> so by cicking on the chosen one, you will be charged accordingly.</p>
                
              </div>

              <img src="{{ url('/public/front') }}/img/happy.png" class="img_gifts">
          </div>
          </div>
        </div>
      </div> -->

      <div class="col-sm-6">
        <div class="card card_price">
          <div class="card-body m-0 bg-white">

            <div class="d-flex align-items-center justify-content-between">
              <div class="">
                <p class="fw-bold mb-3">Sending Image..</p>
                 <p class="m-0 mb-2 ms-1 mb-5"><span class="text-green">Cost:</span> <span class="fw-bold">{{$payment_setting->men_send_image_price}} Coins</span> for each sent image.</p>
                
              </div>

              <img src="{{ url('/public/front') }}/img/picture.png" class="img_gifts">


            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="card card_price">
          <div class="card-body m-0 bg-white">

            <div class="d-flex align-items-center justify-content-between">
              <div class="">
                <p class="fw-bold mb-3">Receive Image..</p>
                <p class="m-0 mb-2 ms-1 mb-5"><span class="text-green">Cost:</span> <span class="fw-bold">{{$payment_setting->men_recieve_image_price}} Coins</span> for each received image.</p>
                
              </div>

              <img src="{{ url('/public/front') }}/img/picture.png" class="img_gifts">



            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="card card_price">
          <div class="card-body m-0 bg-white">

            <div class="d-flex align-items-center justify-content-between">
              <div class="">
                <p class="fw-bold mb-3">Send Videos..</p>
                <p class="m-0 mb-2 ms-1 mb-5"><span class="text-green">Cost:</span> Size-dependent pricing, {{$payment_setting->men_send_video_price}} Coins per <span class="fw-bold">100 kb.</span></p>
                
              </div>

              <img src="{{ url('/public/front') }}/img/video-camera.png" class="img_gifts">


            </div>
          </div>
        </div>
      </div>

       <div class="col-sm-6">
        <div class="card card_price">
          <div class="card-body m-0 bg-white">

            <div class="d-flex align-items-center justify-content-between">
              <div class="">
                <p class="fw-bold mb-3">Receive Videos..</p>
                <p class="m-0 mb-2 ms-1 mb-5"><span class="text-green">Cost:</span> Size-dependent pricing, {{$payment_setting->men_recieve_video_price}} Coins per <span class="fw-bold">100 kb.</span></p>
                
              </div>

              <img src="{{ url('/public/front') }}/img/video-camera.png" class="img_gifts">


            </div>
          </div>
        </div>
      </div>




    </div>

    <div class="card">
      <header class="card-heading m-0 bg-primary">
        <h2 class="card-title text-white fw-bold">What is free of charge:</h2>
      </header>
    </div>


<div class="row">
  <div class="col-sm-4">
    <div class="card">
          <div class="card-body m-0 bg-white">

            <div class="d-flex align-items-center justify-content-between">
              <div class="">
                <p class="fw-bold mb-3">Anything women send is free of charge!</p>
              </div>

              
              <img src="{{ url('/public/front') }}/img/free.png" class="img_gifts">


            </div>
          </div>
        </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
          <div class="card-body m-0 bg-white">

            <div class="d-flex align-items-center justify-content-between">
              <div class="">
                <p class="fw-bold mb-3">Kisses are for free! ;)</p>           
              </div>

              
             <img src="{{ url('/public/front') }}/img/kiss.png" class="img_gifts">

            </div>
          </div>
        </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
          <div class="card-body m-0 bg-white">

            <div class="d-flex align-items-center justify-content-between">
              <div class="">
                <p class="fw-bold mb-3">Some of the Stickers & Emoticons</p>
                            
              </div>

              <img src="{{ url('/public/front') }}/img/kiss_imogy.png" class="img_gifts">


            </div>
          </div>
        </div>
  </div>
</div>
    
    

</div>

@endsection('content')

