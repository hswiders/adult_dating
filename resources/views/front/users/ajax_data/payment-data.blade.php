<div class="card m-0">
    <header class="card-heading ">
		<button class="btn btn-primary" onclick="get_packages()"> <i class="fa fa-arrow-left"></i> Back</button>
        <h2 class="card-title h3 fw-bold">Choose Payment Method</h2>
    </header>

</div>
<div class="row mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="list-group m-0">

                    <div class="list-group-item d-flex align-items-center border-bottom">
                        <div class="row-action-primary">
                            <i class="fas fa-shopping-bag circle mw-blue" aria-hidden="true"></i>
                        </div>
                        <div class="row-content">


                            <h4 class="list-group-item-heading mb-2 h4 fw-bold">Pay via MyPos* - With
                                credit/debit card</h4>
                           
                        </div>
                        <button class="btn btn-primary btn-round pay_btn" onclick="create_mypos_payment('{{$package->price}}' , '{{$package->title}}' , {{$package->id}})">Pay Now <i class="fas fa-arrow-right"
                                aria-hidden="true"></i>
                            <div class="ripple-container"></div>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="bg-light rounded d-flex flex-column">
                <div class="p-2 ml-3">
                    <h4 class="h3 fw-bold text-black m-0">Order Summary</h4>
                </div>
                <div class="p-2 d-flex align-items-center justify-content-between pt-0 pb-0">
                    <div class="m-0">You have selected</div>
                    <h3 class="h5 fw-bold text-green m-0">Package <b>{{ $package->title }}</b></h3>
                </div>
                <div class="p-2 d-flex align-items-center justify-content-between pt-0 pb-0">
                    <div class="col-8">Coins/Credits</div>
                    <div class="ml-auto fw-bold text-black">{{ $package->coins }}</div>
                </div>

                <hr>

                <div class="p-2 d-flex pt-3 align-items-center justify-content-between pt-0 pb-0">
                    <div class="col-8"><b>Total</b></div>
                    <div class="ml-auto text-green"><b class="green">${{ $package->price }}</b></div>
                </div>

                <a href="javascript:void(0)" class="btn btn-primary checkout_btn mx-2" onclick="create_mypos_payment('{{$package->price}}' , '{{$package->title}}' , {{$package->id}})">Checkout</a>
            </div>
        </div>
    </div>
</div>
