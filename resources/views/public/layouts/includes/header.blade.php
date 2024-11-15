   <header class="wrapper bg-dark">
       <nav class="navbar navbar-expand-lg center-nav transparent navbar-dark">
           <div class="container flex-lg-row flex-nowrap align-items-center">
               <div class="navbar-brand w-100">
                   <a href="{{ route('public.pages.home') }}">
                       <img class="logo-dark" width="50px" src="{{ asset('assets/global/svg/logo.svg') }}"
                           srcset="{{ asset('assets/global/svg/logo.svg') }} 2x" alt="" />
                       {{-- <h3 class="text-white fs-30 mb-0">Study Hub</h3> --}}
                       <img class="logo-light" width="50px" src="{{ asset('assets/global/svg/logo.svg') }}"
                           srcset="{{ asset('assets/global/svg/logo.svg') }} 2x" alt="" />
                   </a>
               </div>
               <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                   <div class="offcanvas-header d-lg-none">
                       <h3 class="text-white fs-30 mb-0">Study Hub</h3>
                       <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                           aria-label="Close"></button>
                   </div>
                   <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                       <ul class="navbar-nav">
                           <li class="nav-item"><a class="nav-link" href="{{ route('public.pages.home') }}">Accueil</a>
                           </li>
                           {{-- <li class="nav-item"><a class="nav-link" href="{{ route('un') }}">Universite</a></li> --}}
                           <li class="nav-item"><a class="nav-link"
                                   href="{{ route('public.resources.seachAdvance') }}">Recherche avancée</a></li>
                           @auth
                               <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Page
                                       D'administration</a></li>
                           @endauth
                       </ul>
                       <!-- /.navbar-nav -->
                       <div class="offcanvas-footer d-lg-none">
                           <div>
                               <a href="mailto:ao627515@gmail.com" class="link-inverse">ao627515@gmail.com</a>
                               <br />+226 73471085 <br />
                               {{-- <nav class="nav social social-white mt-4">
                                   <a href="#"><i class="uil uil-twitter"></i></a>
                                   <a href="#"><i class="uil uil-facebook-f"></i></a>
                                   <a href="#"><i class="uil uil-dribbble"></i></a>
                                   <a href="#"><i class="uil uil-instagram"></i></a>
                                   <a href="#"><i class="uil uil-youtube"></i></a>
                               </nav> --}}
                               <!-- /.social -->
                           </div>
                       </div>
                       <!-- /.offcanvas-footer -->
                   </div>
                   <!-- /.offcanvas-body -->
               </div>
               <!-- /.navbar-collapse -->
               <div class="navbar-other w-100 d-flex ms-auto">
                   <ul class="navbar-nav flex-row align-items-center ms-auto">
                       <li class="nav-item d-none d-md-block">
                           <a href="{{ route('public.pages.home') }}#contact"
                               class="btn btn-sm btn-primary rounded">Contact</a>
                       </li>
                       <li class="nav-item d-lg-none">
                           <button class="hamburger offcanvas-nav-btn"><span></span></button>
                       </li>
                   </ul>
                   <!-- /.navbar-nav -->
               </div>
               <!-- /.navbar-other -->
           </div>
           <!-- /.container -->
       </nav>
       <!-- /.offcanvas -->
   </header>
