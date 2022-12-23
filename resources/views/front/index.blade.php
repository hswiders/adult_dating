@extends('front.layout.layouts')
@section('content')
<section class="single-items slider-items p-0" id="home">
    <div class="item slider-inner center-block parallax m-0" style="background: url({{ url('/public/front') }}/img/banner-1.png); height: 100vh;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7 center-col">
                    <div class="area-heading text-center text-lg-left wow fadeInUp">
                        <h3 class="area-title text-capitalize alt-font text-white mb-2 font-weight-100">
                            <strong style="color: #ff7171;">DROP</strong> THE SMALL TALK</h3>
                        <p class="text-white font-weight-300">YOU WANT A HOT BABE? HERE YOU CAN FIND HER!</p>
                        <a class="btn btn-blue btn-rounded btn-rounded btn-large mt-3" href="#services">PREMIUM RICH MEN & PRETTY GIRLS COMMUNITY</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Single portfolio item two-->
<section class="single-items center-block parallax services-area" id="services" style="background: url({{ url('/public/front') }}/img/section-2.png)">
    <div class="container">
        <div class="row">
            <div class="top-heading area-heading col-12">
                <h2 class="area-heading">MEET GORGEOUS GIRLS...</h2>
                <p class="text-white font-weight-300">BEAUTIFUL GIRLS FROM YOUR AREA ARE LOOKING FOR YOU TO HAVE FUN TOGETHER FOR FREE AND LIVE LIFE TO THE FULLEST.</p>
            </div>
            <div class="area-heading second-area-heading text-center text-lg-left wow fadeInUp col-12 offset-lg-6 col-lg-6">
                <h3 class="area-title text-capitalize alt-font text-white mb-0 font-weight-100"><strong style="color: #ff7171;">IMPOSSIBLE?</strong></h3>
                <p class="text-white font-weight-300">If you can afford it... it’s not!</p>
                <p class="text-white font-weight-300" style="ont-size: 16px; font-weight: 100;">This is excactly what women want, right? Just rolling in money...</p>
            </div>
            
        </div>
    </div>

</section>

<!--Single portfolio item three-->
<section class="single-items center-block parallax skills-area position-relative" id="corporate" style="background: url({{ url('/public/front') }}/img/banner-2.jpg)">
    <div class="top-heading area-heading col-12">
        <h2 class="area-heading">WHAT YOU WILL NOT FIND ON DATING</h2>
        <p class="text-white font-weight-300">Lorem ipsum dolor, sit amet consectetur, adipisicing elit. Aut ullam nihil aspernatur vel dolores, sunt esse odio nemo blanditiis vitae.</p>
    </div>
    <div class="container">
        <div class="row align-items-lg-center">
            <!-- Features Box-->
            <div class="col-lg-12 pr-lg-5">
                
                <!-- <div class="heading-area text-center text-md-left mb-5">
                    <h6 class="sub-title">45+ Year Of Experience</h6>
                    <h2 class="title">WHAT YOU WILL NOT FIND ON DATING</h2>
                </div> -->
                <div class="col-12 col-lg-7 center-col">
                    <div class="row no-gutters">
                        <div class="col-12 col-md-6 d-inline-block d-lg-flex justify-content-center align-items-center">
                            <div class="feature-item text-center text-md-left">
                                <img src="{{ url('/public/front') }}/img/couple.png" alt="" width="40px">
                                <h5 class="title">Husband-Hunting Girls</h5>
                                <p>Simply dummy text of the print has been standard.</p>
                                <!-- <a href="javascript:void(0);" class="las la-arrow-right r-icon"></a> -->
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="feature-item text-center text-md-left">
                                <img src="{{ url('/public/front') }}/img/bot.png" alt="" width="40px">
                                <h5 class="title">Software Bots</h5>
                                <p>Simply dummy text of the print has been standard.</p>
                                <!-- <a href="javascript:void(0);" class="las la-arrow-right r-icon"></a> -->
                            </div>
                            <div class="feature-item text-center text-md-left">
                                <img src="{{ url('/public/front') }}/img/admin.png" alt="" width="40px">
                                <h5 class="title">Administrators</h5>
                                <p>Simply dummy text of the print has been standard.</p>
                                <!-- <a href="javascript:void(0);" class="las la-arrow-right r-icon"></a> -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Heading Area-->
            <div class="col-lg-7">

            </div>

        </div>
    </div>
</section>

<!--Single portfolio item four-->
<section class="single-items center-block parallax counter-sec" id="rules" style="background: url({{ url('/public/front') }}/img/banner-4.png)">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-area text-center text-md-left mb-3">
                    <h2 class="title fw-bold">RULES OF DATING</h2>
                </div>

                <div class="col-lg-12 rules_wrapper">
                    <div class="block-1 card">
                        <span><img src="{{ url('/public/front') }}/img/gift.png" alt=""></span>
                        <div class="content">
                            <h2>All women love presents</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit ex culpa odio eum fugit esse, ipsa a consectetur voluptate laboriosam autem excepturi.</p>
                        </div>
                    </div>

                    <div class="block-1 card">
                        <span><img src="{{ url('/public/front') }}/img/heart.png" alt=""></span>
                        <div class="content">
                            <h2>Be sensitive and tender</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit ex culpa odio eum fugit esse, ipsa a consectetur voluptate laboriosam autem excepturi.</p>
                        </div>
                    </div>

                    <div class="block-1 card">
                        <span><img src="{{ url('/public/front') }}/img/bulb.png" alt=""></span>
                        <div class="content">
                            <h2>Be the solution to her problems</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit ex culpa odio eum fugit esse, ipsa a consectetur voluptate laboriosam autem excepturi.</p>
                        </div>
                    </div>

                    <div class="block-1 card">
                        <span><img src="{{ url('/public/front') }}/img/woman.png" alt=""></span>
                        <div class="content">
                            <h2>The woman who accompanies you is always the most beautiful</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit ex culpa odio eum fugit esse, ipsa a consectetur voluptate laboriosam autem excepturi.</p>
                        </div>
                    </div>

                    <div class="block-1 card">
                        <span><img src="{{ url('/public/front') }}/img/valid.png" alt=""></span>
                        <div class="content">
                            <h2>A woman never pays</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit ex culpa odio eum fugit esse, ipsa a consectetur voluptate laboriosam autem excepturi.</p>
                        </div>
                    </div>

                    <div class="block-1 card">
                        <span><img src="{{ url('/public/front') }}/img/decision.png" alt=""></span>
                        <div class="content">
                            <h2>Be decisive and strong</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit ex culpa odio eum fugit esse, ipsa a consectetur voluptate laboriosam autem excepturi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--Single portfolio item seven-->
<section class="single-items center-block item-seven parallax testimonial-sec" id="reviews" style="background: url({{ url('/public/front') }}/img/banner-3.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-5 text-center review-box">
                <div class="row no-gutters slick-test">
                     <div class="reviews item">
                        <div class="review-body">
                            <p class="user-comment">Click edit button to change this text. Lorem dolor sit amet, sit consectetur  elit. amet, for  adipiscing elit. amet, consect adipiscing elit.</p>
                            <p class="comment-date">19-dec-2020</p>
                            <ul class="review-stars">
                                <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                            </ul>
                        </div>
                        <div class="user-img"><img src="https://megaone.acrothemes.com/innovative1/img/review.jpg" class="rounded-circle" alt="img"></div>
                        <h4 class="user-name">Mickal Devid</h4>
                        <p class="user-designation">- Web Designer -</p>
                     </div>
                     <div class="reviews item">
                        <div class="review-body">
                            <p class="user-comment">Edit button to change this text. Lorem dolor sit amet, sit consectetur  elit. amet, for  adipiscing elit. amet, consect adipiscing elit.</p>
                            <p class="comment-date">19-dec-2020</p>
                            <ul class="review-stars">
                                <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                            </ul>
                        </div>
                        <div class="user-img"><img src="https://megaone.acrothemes.com/innovative1/img/rev.jpg" class="rounded-circle" alt="img"></div>
                        <h4 class="user-name">Mickal Devid</h4>
                        <p class="user-designation">- Web Designer -</p>
                     </div>
                     <div class="reviews item">
                        <div class="review-body">
                            <p class="user-comment">Edit with button to change this text. Lorem dolor sit amet, sit consectetur  elit. amet, for  adipiscing elit. amet, consect adipiscing elit.</p>
                            <p class="comment-date">19-dec-2020</p>
                            <ul class="review-stars">
                                <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                                <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                            </ul>
                        </div>
                        <div class="user-img"><img src="https://megaone.acrothemes.com/innovative1/img/rev1.jpg" class="rounded-circle" alt="img"></div>
                        <h4 class="user-name">Mickal Devid</h4>
                        <p class="user-designation">- Web Designer -</p>
                    </div>
                </div>
                <a class="navigate-btn prev-review-btn"><span class="fly-line"></span>Prev <i class="bi bi-arrow-right"></i></a>
                <a class="navigate-btn next-review-btn"><span class="fly-line"></span>Next <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>


<section class="single-items center-block parallax contact-sec overlay-sec" id="contact" style="background: url({{ url('/public/front') }}/img/banner-5.png)">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-6 contact-box text-center text-md-left">
                <div class="c-box wow fadeInRight">
                    <h4 class="small-heading">Let's Get In <strong class="text-pink">Touch</strong></h4>
                    <p class="small-text">Lorem ipsum is simply dummy text of the printing and typesetting industry with dummmy text.</p>
                    <form class="contact-form" id="contact-form-data">
                        <div class="row my-form">
                            <div class="col-sm-12" id="result"></div>
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control" id="candidate_fname" name="firstName" placeholder="First Name" required="required">
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control" id="candidate_lname" name="lastName" placeholder="Last Name" required="required">
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="email" class="form-control" id="user_email" name="userEmail" placeholder="Email" required="required">
                            </div>
                            <div class="col-12 col-md-6">
                                <input type="text" class="form-control" id="user_subject" name="userSubject" placeholder="Subject" required="required">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" id="user_message" name="userMessage" placeholder="Message" rows="6" required="required"></textarea>
                            </div>
                            <div class="col-12">
                                <a href="javascript:void(0);" class="btn btn-blue rounded-pill user-contact contact_btn" type="submit"><i class="fa fa-spinner fa-spin mr-2 d-none" aria-hidden="true"></i>SUBMIT
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="single-items center-block parallax download-app justify-content-end p-0 position-relative" id="download-app" style="  background: linear-gradient(to right, #cb2d3e, #ef473a);">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 text-center text-md-left align-self-center">
                <h5 class="text-white">Download App Our Dating</h5>
                <h2 class="text-white fw-bold mb-3">Easy Connect to Everyone</h2>
                <p>You find us, finally, and you are already in love. More than 5.000.000 around the world already shared the same experience andng ares uses our system Joining us today just got easier!</p>
                <ul class="app-download list-unstyled d-flex flex-wrap mt-5">
                    <li>
                        <a href="#" class="d-flex flex-wrap align-items-center bg-light py-2 px-3">
                            <div class="app-thumb">
                                <img src="{{ url('/public/front') }}/img/apple.png" alt="apple">
                            </div>
                            <div class="app-content ml-3">
                                <p class="text-dark mb-0">Available on the</p>
                                <h4>App Store</h4>
                            </div>
                        </a>
                    </li>
                    <li class="d-inline-block ml-4">
                        <a href="#" class="d-flex flex-wrap align-items-center bg-light py-2 px-3">
                            <div class="app-thumb">
                                <img src="{{ url('/public/front') }}/img/playstore.png" alt="playstore">
                            </div>
                            <div class="app-content ml-3">
                                <p class="text-dark mb-0">Available on the</p>
                                <h4>Google Play</h4>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-6 text-right">
                <img src="{{ url('/public/front') }}/img/mobile-view.png" alt="">
            </div>
        </div>
    </div>
</section>
<!-- footer -->
@endsection('content')

