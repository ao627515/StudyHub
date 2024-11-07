@extends('public.layouts.app')

@section('content')
    <section class="wrapper bg-dark angled lower-start">
        <div class="container pt-7 pt-md-11 pb-8">
            <div class="row gx-0 gy-10 align-items-center">
                <div class="col-lg-6" data-cues="slideInDown" data-group="page-title" data-delay="600">
                    <h1 class="display-1 text-white mb-4">Sandbox focuses on <br /><span
                            class="typer text-primary text-nowrap" data-delay="100"
                            data-words="customer satisfaction,business needs,creative ideas"></span><span
                            class="cursor text-primary" data-owner="typer"></span></h1>
                    <p class="lead fs-24 lh-sm text-white mb-7 pe-md-18 pe-lg-0 pe-xxl-15">We carefully consider our
                        solutions to support each and every stage of your growth.</p>
                    <div>
                        <a class="btn btn-lg btn-primary rounded">Get Started</a>
                    </div>
                </div>
                <!-- /column -->
                <div class="col-lg-5 offset-lg-1 mb-n18" data-cues="slideInDown">
                    <div class="position-relative">
                        <a href="./assets/media/movie.mp4"
                            class="btn btn-circle btn-primary btn-play ripple mx-auto mb-6 position-absolute"
                            style="top:50%; left: 50%; transform: translate(-50%,-50%); z-index:3;" data-glightbox><i
                                class="icn-caret-right"></i></a>
                        <figure class="rounded shadow-lg"><img src="./assets/img/photos/about13.jpg"
                                srcset="./assets/img/photos/about13@2x.jpg 2x" alt=""></figure>
                    </div>
                    <!-- /div -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light">
        <div class="container pt-19 pt-md-21 pb-16 pb-md-18">
            <div class="row">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">What We Do?</h2>
                    <h3 class="display-4 mb-9">The service we offer is specifically designed to meet your needs.</h3>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="row gx-md-8 gy-8 mb-14 mb-md-18">
                <div class="col-md-6 col-lg-3">
                    <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i
                            class="uil uil-phone-volume"></i> </div>
                    <h4>24/7 Support</h4>
                    <p class="mb-3">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget
                        metus. Cras justo.</p>
                    <a href="#" class="more hover link-primary">Learn More</a>
                </div>
                <!--/column -->
                <div class="col-md-6 col-lg-3">
                    <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i
                            class="uil uil-shield-exclamation"></i> </div>
                    <h4>Secure Payments</h4>
                    <p class="mb-3">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget
                        metus. Cras justo.</p>
                    <a href="#" class="more hover link-primary">Learn More</a>
                </div>
                <!--/column -->
                <div class="col-md-6 col-lg-3">
                    <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i
                            class="uil uil-laptop-cloud"></i> </div>
                    <h4>Daily Updates</h4>
                    <p class="mb-3">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget
                        metus. Cras justo.</p>
                    <a href="#" class="more hover link-primary">Learn More</a>
                </div>
                <!--/column -->
                <div class="col-md-6 col-lg-3">
                    <div class="icon btn btn-block btn-lg btn-soft-primary pe-none mb-6"> <i class="uil uil-chart-line"></i>
                    </div>
                    <h4>Market Research</h4>
                    <p class="mb-3">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida at eget
                        metus. Cras justo.</p>
                    <a href="#" class="more hover link-primary">Learn More</a>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <div class="row">
                <div class="offset-lg-6 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">D'ou vienne nos resource?</h2>
                    <h3 class="display-4 mb-9">The service we offer is specifically designed to meet your needs.</h3>
                </div>
                <!-- /column -->
            </div>
            <!--/.row -->
            <div class="row gy-10 gy-sm-13 gx-lg-3 align-items-center">

                @foreach ($universities as $university)
                    <div class="col-md-6 col-lg-4">

                        <div class="card" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4 p-5 align-item-center d-flex justify-content-center">
                                    <img src="{{ $university->getLogoUrl() }}" class="img-fluid rounded-start d-block w-100"
                                        alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $university->name }}</h6>
                                        <div class="my-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="uil uil-download-alt"></i>
                                                <span>12,500 ressources</span>
                                            </div>
                                        </div>
                                        <a href="#" class="btn btn-primary btn-sm">Voir les ressources</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/column -->
                @endforeach
            </div>
            <!--/.row -->
            <div class="mb-16 mt-8 mb-md-18 d-flex justify-content-center align-items-center">
                <button class="btn btn-primary">Voir plus</button>
                <!-- /column -->
            </div>
            <!--/.row -->
            <div class="row gy-10 gy-sm-13 gx-lg-3 align-items-center">
                <div class="col">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Les resource les plus telecharger</h2>
                    <h3 class="display-4 mb-7">A few reasons why our valued customers choose us.</h3>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th>Categorie</th>
                                <th>Nom</th>
                                <th>Module</th>
                                <th>Filiere</th>
                                <th>Universite</th>
                                <th>Telecharger</th>
                                <th>Taille</th>
                                <th>Nombre de telechargement</th>
                                <th>Uploader le</th>
                            </thead>
                            <tbody>
                                @foreach ($moreResourcesDownload as $resource)
                                    <tr>
                                        <td>
                                            <span
                                                class="badge gradient-7 rounded-pill">{{ $resource->category->name }}</span>
                                        </td>
                                        <td>{{ $resource->name }}</td>
                                        <td>{{ $resource->courseModule->name }}</td>
                                        <td>{{ $resource->academicProgram->name }} ({{ $resource->academicLevel->name }})
                                        </td>
                                        <td>{{ $resource->university->name }}</td>
                                        <td>
                                            {{-- <a href="{{ $resource->getFileUrl() }}" download>Fichier</a> --}}
                                            <a href="{{ route('public.resource.download', $resource->id) }}">Fichier 2</a>
                                        </td>
                                        <td>{{ $resource->getFileSize(format: true) }}</td>
                                        <td>{{ $resource->download_count }}</td>
                                        <td>{{ $resource->created_at->format('d M y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper image-wrapper bg-image bg-overlay" data-image-src="./assets/img/photos/bg1.jpg">
        <div class="container py-18">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="fs-16 text-uppercase text-line text-white mb-3">Join Our Community</h2>
                    <h3 class="display-4 mb-6 text-white pe-xxl-18">We are trusted by over 5000+ clients. Join them by
                        using our services and grow your business.</h3>
                    <a href="#" class="btn btn-white rounded mb-0 text-nowrap">Join Us</a>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light angled upper-end">
        <div class="container py-14 py-md-16">
            <div class="row">
                <div class="col-lg-9 col-xl-8 col-xxl-7">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Case Studies</h2>
                    <h3 class="display-4 mb-9">Check out some of our awesome projects with creative ideas and great design.
                    </h3>
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
            <div class="swiper-container blog grid-view mb-10" data-margin="30" data-dots="true" data-items-xl="3"
                data-items-md="2" data-items-xs="1">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <article>
                                <figure class="overlay overlay-1 hover-scale rounded mb-6"><a href="#"> <img
                                            src="./assets/img/photos/b4.jpg" alt="" /></a>
                                    <figcaption>
                                        <h5 class="from-top mb-0">Read More</h5>
                                    </figcaption>
                                </figure>
                                <div class="post-header">
                                    <h2 class="post-title h3 mb-3"><a class="link-dark" href="./blog-post.html">Ligula
                                            tristique quis risus</a></h2>
                                </div>
                                <!-- /.post-header -->
                                <div class="post-footer">
                                    <ul class="post-meta">
                                        <li class="post-date"><i class="uil uil-calendar-alt"></i><span>14 Apr 2022</span>
                                        </li>
                                        <li class="post-comments"><a href="#"><i
                                                    class="uil uil-file-alt fs-15"></i>Coding</a></li>
                                    </ul>
                                    <!-- /.post-meta -->
                                </div>
                                <!-- /.post-footer -->
                            </article>
                            <!-- /article -->
                        </div>
                        <!--/.swiper-slide -->
                        <div class="swiper-slide">
                            <article>
                                <figure class="overlay overlay-1 hover-scale rounded mb-6"><a href="#"> <img
                                            src="./assets/img/photos/b5.jpg" alt="" /></a>
                                    <figcaption>
                                        <h5 class="from-top mb-0">Read More</h5>
                                    </figcaption>
                                </figure>
                                <div class="post-header">
                                    <h2 class="post-title h3 mb-3"><a class="link-dark" href="./blog-post.html">Nullam id
                                            dolor elit id nibh</a></h2>
                                </div>
                                <!-- /.post-header -->
                                <div class="post-footer">
                                    <ul class="post-meta">
                                        <li class="post-date"><i class="uil uil-calendar-alt"></i><span>29 Mar 2022</span>
                                        </li>
                                        <li class="post-comments"><a href="#"><i
                                                    class="uil uil-file-alt fs-15"></i>Workspace</a></li>
                                    </ul>
                                    <!-- /.post-meta -->
                                </div>
                                <!-- /.post-footer -->
                            </article>
                            <!-- /article -->
                        </div>
                        <!--/.swiper-slide -->
                        <div class="swiper-slide">
                            <article>
                                <figure class="overlay overlay-1 hover-scale rounded mb-6"><a href="#"> <img
                                            src="./assets/img/photos/b6.jpg" alt="" /></a>
                                    <figcaption>
                                        <h5 class="from-top mb-0">Read More</h5>
                                    </figcaption>
                                </figure>
                                <div class="post-header">
                                    <h2 class="post-title h3 mb-3"><a class="link-dark" href="./blog-post.html">Ultricies
                                            fusce porta elit</a></h2>
                                </div>
                                <!-- /.post-header -->
                                <div class="post-footer">
                                    <ul class="post-meta">
                                        <li class="post-date"><i class="uil uil-calendar-alt"></i><span>26 Feb 2022</span>
                                        </li>
                                        <li class="post-comments"><a href="#"><i
                                                    class="uil uil-file-alt fs-15"></i>Meeting</a></li>
                                    </ul>
                                    <!-- /.post-meta -->
                                </div>
                                <!-- /.post-footer -->
                            </article>
                            <!-- /article -->
                        </div>
                        <!--/.swiper-slide -->
                        <div class="swiper-slide">
                            <article>
                                <figure class="overlay overlay-1 hover-scale rounded mb-6"><a href="#"> <img
                                            src="./assets/img/photos/b7.jpg" alt="" /></a>
                                    <figcaption>
                                        <h5 class="from-top mb-0">Read More</h5>
                                    </figcaption>
                                </figure>
                                <div class="post-header">
                                    <h2 class="post-title h3 mb-3"><a class="link-dark" href="./blog-post.html">Morbi leo
                                            risus porta eget</a></h2>
                                </div>
                                <div class="post-footer">
                                    <ul class="post-meta">
                                        <li class="post-date"><i class="uil uil-calendar-alt"></i><span>7 Jan 2022</span>
                                        </li>
                                        <li class="post-comments"><a href="#"><i
                                                    class="uil uil-file-alt fs-15"></i>Business Tips</a></li>
                                    </ul>
                                    <!-- /.post-meta -->
                                </div>
                                <!-- /.post-footer -->
                            </article>
                            <!-- /article -->
                        </div>
                        <!--/.swiper-slide -->
                    </div>
                    <!-- /.swiper-wrapper -->
                </div>
                <!-- /.swiper -->
            </div>
            <!-- /.swiper-container -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-soft-primary">
        <div class="container py-14 pt-md-17 pb-md-21">
            <div class="row gx-lg-8 gx-xl-12 gy-10 gy-lg-0 mb-2 align-items-end">
                <div class="col-lg-4">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Company Facts</h2>
                    <h3 class="display-4 mb-0 pe-xxl-15">We are proud of our works</h3>
                </div>
                <!-- /column -->
                <div class="col-lg-8 mt-lg-2">
                    <div class="row align-items-center counter-wrapper gy-6 text-center">
                        <div class="col-md-4">
                            <h3 class="counter counter-lg">1000+</h3>
                            <p>Completed Projects</p>
                        </div>
                        <!--/column -->
                        <div class="col-md-4">
                            <h3 class="counter counter-lg">500+</h3>
                            <p>Happy Clients</p>
                        </div>
                        <!--/column -->
                        <div class="col-md-4">
                            <h3 class="counter counter-lg">150+</h3>
                            <p>Awards Won</p>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light angled upper-end lower-start">
        <div class="container py-16 py-md-18 position-relative">
            <div class="position-relative mt-n18 mt-md-n23 mb-16 mb-md-18">
                <div class="shape rounded-circle bg-line primary rellax w-18 h-18" data-rellax-speed="1"
                    style="top: -2rem; right: -2.7rem; z-index:0;"></div>
                <div class="shape rounded-circle bg-soft-primary rellax w-18 h-18" data-rellax-speed="1"
                    style="bottom: -1rem; left: -3rem; z-index:0;"></div>
                <div class="card shadow-lg">
                    <div class="row gx-0">
                        <div class="col-lg-6 image-wrapper bg-image bg-cover rounded-top rounded-lg-start"
                            data-image-src="./assets/img/photos/tm1.jpg">
                        </div>
                        <!--/column -->
                        <div class="col-lg-6">
                            <div class="p-10 p-md-11 p-lg-13">
                                <div class="swiper-container dots-closer mb-4" data-margin="30" data-dots="true">
                                    <div class="swiper">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <blockquote class="icon icon-top fs-lg text-center">
                                                    <p>“Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor
                                                        auctor. Vestibulum ligula porta felis euismod semper. Cras justo
                                                        odio.”</p>
                                                    <div class="blockquote-details justify-content-center text-center">
                                                        <div class="info ps-0">
                                                            <h5 class="mb-1">Coriss Ambady</h5>
                                                            <p class="mb-0">Financial Analyst</p>
                                                        </div>
                                                    </div>
                                                </blockquote>
                                            </div>
                                            <!--/.swiper-slide -->
                                            <div class="swiper-slide">
                                                <blockquote class="icon icon-top fs-lg text-center">
                                                    <p>“Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor
                                                        auctor. Vestibulum ligula porta felis euismod semper. Cras justo
                                                        odio.”</p>
                                                    <div class="blockquote-details justify-content-center text-center">
                                                        <div class="info ps-0">
                                                            <h5 class="mb-1">Cory Zamora</h5>
                                                            <p class="mb-0">Marketing Specialist</p>
                                                        </div>
                                                    </div>
                                                </blockquote>
                                            </div>
                                            <!--/.swiper-slide -->
                                            <div class="swiper-slide">
                                                <blockquote class="icon icon-top fs-lg text-center">
                                                    <p>“Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor
                                                        auctor. Vestibulum ligula porta felis euismod semper. Cras justo
                                                        odio.”</p>
                                                    <div class="blockquote-details justify-content-center text-center">
                                                        <div class="info ps-0">
                                                            <h5 class="mb-1">Nikolas Brooten</h5>
                                                            <p class="mb-0">Sales Manager</p>
                                                        </div>
                                                    </div>
                                                </blockquote>
                                            </div>
                                            <!--/.swiper-slide -->
                                        </div>
                                        <!-- /.swiper-wrapper -->
                                    </div>
                                    <!-- /.swiper -->
                                </div>
                                <!-- /.swiper-container -->
                            </div>
                            <!--/div -->
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /div -->
            <div class="row gy-6 mb-16 mb-md-18">
                <div class="col-lg-4">
                    <h2 class="fs-16 text-uppercase text-line text-primary mt-lg-18 mb-3">Our Pricing</h2>
                    <h3 class="display-4 mb-3">We offer great and premium prices.</h3>
                    <p>Enjoy a <a href="#" class="hover">free 30-day trial</a> and experience the full service. No
                        credit card required!</p>
                    <a href="#" class="btn btn-primary rounded mt-2">See All Prices</a>
                </div>
                <!--/column -->
                <div class="col-lg-7 offset-lg-1 pricing-wrapper">
                    <div class="pricing-switcher-wrapper switcher justify-content-start justify-content-lg-end">
                        <p class="mb-0 pe-3">Monthly</p>
                        <div class="pricing-switchers">
                            <div class="pricing-switcher pricing-switcher-active"></div>
                            <div class="pricing-switcher"></div>
                            <div class="switcher-button bg-primary"></div>
                        </div>
                        <p class="mb-0 ps-3">Yearly <span class="text-red">(Save 30%)</span></p>
                    </div>
                    <div class="row gy-6 position-relative mt-5">
                        <div class="shape bg-dot primary rellax w-16 h-18" data-rellax-speed="1"
                            style="bottom: -0.5rem; right: -1.6rem;"></div>
                        <div class="shape rounded-circle bg-soft-primary rellax w-18 h-18" data-rellax-speed="1"
                            style="top: -1rem; left: -2rem;"></div>
                        <div class="col-md-6">
                            <div class="pricing card shadow-lg">
                                <div class="card-body pb-12">
                                    <div class="prices text-dark">
                                        <div class="price price-show justify-content-start"><span
                                                class="price-currency">$</span><span class="price-value">19</span> <span
                                                class="price-duration">mo</span></div>
                                        <div class="price price-hide price-hidden justify-content-start"><span
                                                class="price-currency">$</span><span class="price-value">199</span> <span
                                                class="price-duration">yr</span></div>
                                    </div>
                                    <!--/.prices -->
                                    <h4 class="card-title mt-2">Premium Plan</h4>
                                    <ul class="icon-list bullet-bg bullet-soft-primary mt-7 mb-8">
                                        <li><i class="uil uil-check"></i><span><strong>5</strong> Projects </span></li>
                                        <li><i class="uil uil-check"></i><span><strong>100K</strong> API Access </span>
                                        </li>
                                        <li><i class="uil uil-check"></i><span><strong>200MB</strong> Storage </span></li>
                                        <li><i class="uil uil-check"></i><span> Weekly <strong>Reports</strong></span></li>
                                        <li><i class="uil uil-times bullet-soft-red"></i><span> 7/24
                                                <strong>Support</strong></span></li>
                                    </ul>
                                    <a href="#" class="btn btn-primary rounded">Choose Plan</a>
                                </div>
                                <!--/.card-body -->
                            </div>
                            <!--/.pricing -->
                        </div>
                        <!--/column -->
                        <div class="col-md-6 popular">
                            <div class="pricing card shadow-lg">
                                <div class="card-body pb-12">
                                    <div class="prices text-dark">
                                        <div class="price price-show justify-content-start"><span
                                                class="price-currency">$</span><span class="price-value">49</span> <span
                                                class="price-duration">mo</span></div>
                                        <div class="price price-hide price-hidden justify-content-start"><span
                                                class="price-currency">$</span><span class="price-value">499</span> <span
                                                class="price-duration">yr</span></div>
                                    </div>
                                    <!--/.prices -->
                                    <h4 class="card-title mt-2">Corporate Plan</h4>
                                    <ul class="icon-list bullet-bg bullet-soft-primary mt-7 mb-8">
                                        <li><i class="uil uil-check"></i><span><strong>20</strong> Projects </span></li>
                                        <li><i class="uil uil-check"></i><span><strong>300K</strong> API Access </span>
                                        </li>
                                        <li><i class="uil uil-check"></i><span><strong>500MB</strong> Storage </span></li>
                                        <li><i class="uil uil-check"></i><span> Weekly <strong>Reports</strong></span></li>
                                        <li><i class="uil uil-check"></i><span> 7/24 <strong>Support</strong></span></li>
                                    </ul>
                                    <a href="#" class="btn btn-primary rounded">Choose Plan</a>
                                </div>
                                <!--/.card-body -->
                            </div>
                            <!--/.pricing -->
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
            <div class="row gy-10 gy-sm-13 gx-lg-3 align-items-center">
                <div class="col-md-8 col-lg-6 position-relative">
                    <div class="shape bg-dot primary rellax w-17 h-21" data-rellax-speed="1"
                        style="top: -2rem; left: -1.9rem;"></div>
                    <div class="shape rounded bg-soft-primary rellax d-md-block" data-rellax-speed="0"
                        style="bottom: -1.8rem; right: -1.5rem; width: 85%; height: 90%; "></div>
                    <figure class="rounded"><img src="./assets/img/photos/about14.jpg"
                            srcset="./assets/img/photos/about14@2x.jpg 2x" alt="" /></figure>
                </div>
                <!--/column -->
                <div class="col-lg-5 col-xl-4 offset-lg-1">
                    <h2 class="fs-16 text-uppercase text-line text-primary mb-3">Get In Touch</h2>
                    <h2 class="display-4 mb-8">Convinced yet? Let's make something great together.</h2>
                    <div class="d-flex flex-row">
                        <div>
                            <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-location-pin-alt"></i>
                            </div>
                        </div>
                        <div>
                            <h5 class="mb-1">Address</h5>
                            <address>Moonshine St. 14/05 Light City, <br class="d-none d-md-block" />London, United Kingdom
                            </address>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div>
                            <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-phone-volume"></i> </div>
                        </div>
                        <div>
                            <h5 class="mb-1">Phone</h5>
                            <p>00 (123) 456 78 90</p>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <div>
                            <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-envelope"></i> </div>
                        </div>
                        <div>
                            <h5 class="mb-1">E-mail</h5>
                            <p class="mb-0"><a href="mailto:sandbox@email.com" class="link-body">sandbox@email.com</a>
                            </p>
                        </div>
                    </div>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
@endsection
