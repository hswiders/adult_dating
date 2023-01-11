@extends('front.users.layouts.header')
@section('wallet-sidebar')
    @include('front.users.layouts.sidebar_wallet')
@endsection

@section('content')
    <section id="content_outer_wrapper" class="common_p">

        <div style="padding-top: 65px;"></div>

        <div class="pricing-wrapper p-3 mb-0">
            
        </div>

        <div class="card m-3 mt-0 mb-0">
			
            <div class="card-body">
                <p>Your Credit/Debit card will be charged only once with full confidentiality and security. There will be no
                    recurring charges imposed or arising liabilities. Please visit our Billing Support page for more
                    information. Your security is fully guaranteed. Using a credit/debit card is the easiest way to buy
                    credits. In case you do not have a Credit/Debit card, you can buy a prepaid Paysafecard from a kiosk. If
                    you require any further information or you have any questions or if you encounter any issues, contact us
                    by simply speaking to LUNA.</p>
            </div>
        </div>
    @endsection('content')

    @section('scripts')
	
        <script type="text/javascript">
            jQuery(function($) {
                var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
                $('#app_sidebar-left').find('a').each(function() {
                    console.log(path)
                    if (this.href === path) {
                        $(this).parent().addClass('active');
                    }
                });
            });
        </script>
		<script>
			function get_packages()
			{
				blockui()
				form_data = new FormData();
				form_data.append('_token' , '{{ csrf_token() }}');;
				$.ajax({
					url:"{{ route('get-packages') }}",
					method:"POST",
					dataType:"JSON",
					cache:false,
					contentType: false,
					processData: false,
					data:form_data,
					
					success:function(data)
					{
						blockui('hide')
						console.log(data)
						$('.pricing-wrapper').html(data.html);
						$('body').removeClass('app_sidebar-menu-collapsed');
					}
				})
			}
			function get_payment_method(id)
			{
				blockui()
				form_data = new FormData();
				form_data.append('_token' , '{{ csrf_token() }}');
				form_data.append('package_id' , id);
				$.ajax({
					url:"{{ route('get-payment-method') }}",
					method:"POST",
					dataType:"JSON",
					cache:false,
					contentType: false,
					processData: false,
					data:form_data,
					
					success:function(data)
					{
						blockui('hide')
						console.log(data)
						$('.pricing-wrapper').html(data.html);
						$('body').removeClass('app_sidebar-menu-collapsed');

					}
				})
			}
			function confirmPayment(form_data)
			{
				blockui()
				
				$.ajax({
					url:"{{ route('confirm-payment') }}",
					method:"POST",
					dataType:"JSON",
					cache:false,
					contentType: false,
					processData: false,
					data:form_data,
					
					success:function(data)
					{
						blockui('hide')
						console.log(data)
						Swal.fire({
							title: "Success", 
							text: data.message, 
							icon: "success"
							}).then(function (result) {
							
								window.location.href = data.redirect;
							
							})

					}
				})
			}
			$(document).ready(function () {
				get_packages()
			});		
		</script>
		<script src="https://developers.mypos.com/repository/mypos-embedded-sdk.js" type="text/javascript"></script>
		<script>
			function create_mypos_payment(price, title , package_id)
            {
                blockui()
				$('.pricing-wrapper').html('<div id="embeddedCheckout"></div>');
				
				
                var paymentParams = 
				{
					sid: '000000000000010',
					ipcLanguage: 'en', //Checkout page language (ISO 2 format).
					walletNumber: '61938166610',
					amount: price,
					currency: 'USD',
					orderID: Math.random().toString(36).substr(2, 9),
					urlNotify: MyPOSEmbedded.IPC_URL + '/client/ipcNotify', // Warning: use your own url to verify your payment!
					urlOk: window.location.href,
					urlCancel: window.location.href,
					keyIndex: 1,
					cartItems: 
					[
						{
							article: title,
							quantity: 1,
							price: price,
							currency: 'USD',
						}
					]
				};
		 
				var callbackParams = {
					isSandbox: true,
					onSuccess: function (data) {
						console.log('success callback');
						console.log(data);
						var order_data = JSON.stringify(data);
						//location.reload()
						form_data = new FormData();
						form_data.append('_token' , '{{ csrf_token() }}');
						form_data.append('order_data' , order_data);
						form_data.append('package_id' , package_id);
						confirmPayment(form_data)

					},
			
					onError: function (ee) {
						console.log('error' , ee);
					}
				};
			
				MyPOSEmbedded.createPayment(
					'embeddedCheckout',
					paymentParams,
					callbackParams
				);
				blockui('hide')
				setTimeout(() => {
					$('body').removeClass('app_sidebar-menu-collapsed');
				}, 1000);
				
				$('#IPCIFrame').show();
			}
			
		</script>
    @endsection('scripts')
