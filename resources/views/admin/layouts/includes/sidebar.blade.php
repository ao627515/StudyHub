  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a @class([
                  'nav-link',
                  'collapsed' => !Route::currentRouteNamed('admin.dashboard'),
              ]) href="{{ route('admin.dashboard') }}">
                  <i class="bi bi-house-door"></i>
                  <span>Dashboard</span>
              </a>
          </li>
          <!-- End Dashboard Nav -->

          @if (Auth::user()->isAdmin())
              <li class="nav-item">
                  <a @class(['nav-link', 'collapsed' => !Route::is('*administrators*')]) data-bs-target="#administrators-nav" data-bs-toggle="collapse"
                      href="#">
                      <i class="bi bi-person-lock"></i><span>Administrateurs</span><i
                          class="bi bi-chevron-down ms-auto"></i>
                  </a>
                  <ul id="administrators-nav" @class([
                      'nav-content',
                      'collapse',
                      'show' => Route::is('*administrators*'),
                  ]) data-bs-parent="#sidebar-nav">
                      <li>
                          <a href="{{ route('admin.administrators.create') }}" @class([
                              'active' => Route::currentRouteNamed('*administrators.create'),
                          ])>
                              <i class="bi bi-person-plus"></i><span>Ajouter</span>
                          </a>
                      </li>
                      <li>
                          <a href="{{ route('admin.administrators.index') }}" @class([
                              'active' => Route::currentRouteNamed('*administrators.index'),
                          ])>
                              <i class="bi bi-person-lines-fill"></i><span>Liste</span>
                          </a>
                      </li>
                  </ul>
              </li>
              <!-- End administrators Nav -->

              <li class="nav-item">
                  <a @class(['nav-link', 'collapsed' => !Route::is('*moderators*')]) data-bs-target="#moderators-nav" data-bs-toggle="collapse"
                      href="#">
                      <i class="bi bi-person-bounding-box"></i><span>Modérateurs</span><i
                          class="bi bi-chevron-down ms-auto"></i>
                  </a>
                  <ul id="moderators-nav" @class([
                      'nav-content',
                      'collapse',
                      'show' => Route::is('*moderators*'),
                  ]) data-bs-parent="#sidebar-nav">
                      <li>
                          <a href="{{ route('admin.moderators.create') }}" @class(['active' => Route::currentRouteNamed('*moderators.create')])>
                              <i class="bi bi-person-plus-fill"></i><span>Ajouter</span>
                          </a>
                      </li>
                      <li>
                          <a href="{{ route('admin.moderators.index') }}" @class(['active' => Route::currentRouteNamed('*moderators.index')])>
                              <i class="bi bi-people-fill"></i><span>Liste</span>
                          </a>
                      </li>
                  </ul>
              </li>
              <!-- End moderators Nav -->

              <li class="nav-item">
                  <a @class(['nav-link', 'collapsed' => !Route::is('*uploaders*')]) data-bs-target="#uploaders-nav" data-bs-toggle="collapse"
                      href="#">
                      <i class="bi bi-cloud-arrow-up"></i><span>Uploaders</span><i
                          class="bi bi-chevron-down ms-auto"></i>
                  </a>
                  <ul id="uploaders-nav" @class([
                      'nav-content',
                      'collapse',
                      'show' => Route::is('*uploaders*'),
                  ]) data-bs-parent="#sidebar-nav">
                      <li>
                          <a href="{{ route('admin.uploaders.create') }}" @class(['active' => Route::currentRouteNamed('*uploaders.create')])>
                              <i class="bi bi-cloud-upload-fill"></i><span>Ajouter</span>
                          </a>
                      </li>
                      <li>
                          <a href="{{ route('admin.uploaders.index') }}" @class(['active' => Route::currentRouteNamed('*uploaders.index')])>
                              <i class="bi bi-archive"></i><span>Liste</span>
                          </a>
                      </li>
                  </ul>
              </li>
              <!-- End uploaders Nav -->

              <li class="nav-item">
                  <a @class(['nav-link', 'collapsed' => !Route::is('*universities*')]) data-bs-target="#universities-nav" data-bs-toggle="collapse"
                      href="#">
                      <i class="bi bi-building-fill"></i><span>Universités</span><i
                          class="bi bi-chevron-down ms-auto"></i>
                  </a>
                  <ul id="universities-nav" @class([
                      'nav-content',
                      'collapse',
                      'show' => Route::is('*universities*'),
                  ]) data-bs-parent="#sidebar-nav">
                      <li>
                          <a href="{{ route('admin.universities.index') }}" @class(['active' => Route::currentRouteNamed('*universities.index')])>
                              <i class="bi bi-list-task"></i><span>Liste</span>
                          </a>
                      </li>
                  </ul>
              </li>
              <!-- End universities Nav -->

              <li class="nav-item">
                  <a @class(['nav-link', 'collapsed' => !Route::is('*academic_programs*')]) data-bs-target="#academic_programs-nav" data-bs-toggle="collapse"
                      href="#">
                      <i class="bi bi-journal"></i><span>Filières</span><i class="bi bi-chevron-down ms-auto"></i>
                  </a>
                  <ul id="academic_programs-nav" @class([
                      'nav-content',
                      'collapse',
                      'show' => Route::is('*academic_programs*'),
                  ]) data-bs-parent="#sidebar-nav">
                      <li>
                          <a href="{{ route('admin.academic_programs.index') }}" @class([
                              'active' => Route::currentRouteNamed('*academic_programs.index'),
                          ])>
                              <i class="bi bi-list-ul"></i><span>Liste</span>
                          </a>
                      </li>
                  </ul>
              </li>
              <!-- End academic programs Nav -->

              <li class="nav-item">
                  <a @class(['nav-link', 'collapsed' => !Route::is('*academic_levels*')]) data-bs-target="#academic_levels-nav" data-bs-toggle="collapse"
                      href="#">
                      <i class="bi bi-bar-chart-line"></i><span>Niveaux Académiques</span><i
                          class="bi bi-chevron-down ms-auto"></i>
                  </a>
                  <ul id="academic_levels-nav" @class([
                      'nav-content',
                      'collapse',
                      'show' => Route::is('*academic_levels*'),
                  ]) data-bs-parent="#sidebar-nav">
                      <li>
                          <a href="{{ route('admin.academic_levels.index') }}" @class([
                              'active' => Route::currentRouteNamed('*academic_levels.index'),
                          ])>
                              <i class="bi bi-list-check"></i><span>Liste</span>
                          </a>
                      </li>
                  </ul>
              </li>
              <!-- End academic_levels Nav -->

              <li class="nav-item">
                  <a @class(['nav-link', 'collapsed' => !Route::is('*teachers*')]) data-bs-target="#teachers-nav" data-bs-toggle="collapse"
                      href="#">
                      <i class="bi bi-person-video3"></i><span>Professeurs</span><i
                          class="bi bi-chevron-down ms-auto"></i>
                  </a>
                  <ul id="teachers-nav" @class(['nav-content', 'collapse', 'show' => Route::is('*teachers*')]) data-bs-parent="#sidebar-nav">
                      <li>
                          <a href="{{ route('admin.teachers.index') }}" @class(['active' => Route::currentRouteNamed('*teachers.index')])>
                              <i class="bi bi-list-check"></i><span>Liste</span>
                          </a>
                      </li>
                  </ul>
              </li>
              <!-- End teacher Nav -->

              <li class="nav-item">
                  <a @class([
                      'nav-link',
                      'collapsed' => !Route::is('*academic_program_levels*'),
                  ]) data-bs-target="#academic_program_levels-nav"
                      data-bs-toggle="collapse" href="#">
                      <i class="bi bi-bar-chart-line"></i><span>Filiere - Niveau academique</span><i
                          class="bi bi-chevron-down ms-auto"></i>
                  </a>
                  <ul id="academic_program_levels-nav" @class([
                      'nav-content',
                      'collapse',
                      'show' => Route::is('*academic_program_levels*'),
                  ]) data-bs-parent="#sidebar-nav">
                      <li>
                          <a href="{{ route('admin.academic_program_levels.index') }}" @class([
                              'active' => Route::currentRouteNamed('*academic_program_levels.index'),
                          ])>
                              <i class="bi bi-list-check"></i><span>Liste</span>
                          </a>
                      </li>
                  </ul>
              </li>
              <!-- End academic_program_levels Nav -->

              <li class="nav-item">
                  <a @class([
                      'nav-link',
                      'collapsed' => !Route::is('*category_resources*'),
                  ]) data-bs-target="#category_resources-nav" data-bs-toggle="collapse"
                      href="#">
                      <i class="bi bi-folder-symlink"></i><span>Catégories de Ressources</span><i
                          class="bi bi-chevron-down ms-auto"></i>
                  </a>
                  <ul id="category_resources-nav" @class([
                      'nav-content',
                      'collapse',
                      'show' => Route::is('*category_resources*'),
                  ]) data-bs-parent="#sidebar-nav">
                      <li>
                          <a href="{{ route('admin.category_resources.index') }}" @class([
                              'active' => Route::currentRouteNamed('*category_resources.index'),
                          ])>
                              <i class="bi bi-list-check"></i><span>Liste</span>
                          </a>
                      </li>
                  </ul>
              </li>
              <!-- End category_resources Nav -->
          @endif

          <li class="nav-item">
              <a @class(['nav-link', 'collapsed' => !Route::is('*course_modules*')]) data-bs-target="#course_modules-nav" data-bs-toggle="collapse"
                  href="#">
                  <i class="bi bi-box-seam"></i><span>Modules</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="course_modules-nav" @class([
                  'nav-content',
                  'collapse',
                  'show' => Route::is('*course_modules*'),
              ]) data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('admin.course_modules.index') }}" @class([
                          'active' => Route::currentRouteNamed('*course_modules.index'),
                      ])>
                          <i class="bi bi-list-check"></i><span>Liste</span>
                      </a>
                  </li>
              </ul>
          </li>
          <!-- End course_modules Nav -->

          <li class="nav-item">
              <a @class(['nav-link', 'collapsed' => !Route::is('*resources*')]) data-bs-target="#resources-nav" data-bs-toggle="collapse"
                  href="#">
                  <i class="bi bi-file-earmark"></i><span>Ressources</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="resources-nav" @class([
                  'nav-content',
                  'collapse',
                  'show' => Route::is('*resources*'),
              ]) data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('admin.resources.index') }}" @class(['active' => Route::currentRouteNamed('*resources.index')])>
                          <i class="bi bi-collection"></i><span>Liste</span>
                      </a>
                  </li>
                  @if (Auth::user()->isUploader())
                      <li>
                          <a href="{{ route('admin.resources.create') }}" @class(['active' => Route::currentRouteNamed('*resources.create')])>
                              <i class="bi bi-file-earmark-plus"></i><span>Créer</span>
                          </a>
                      </li>
                  @endif
              </ul>
          </li>
          <!-- End resources Nav -->

          <li class="nav-heading">Pages</li>

          <li class="nav-item">
              <a @class([
                  'nav-link',
                  'collapsed' => !Route::currentRouteNamed('admin.profile'),
              ]) href="{{ route('admin.profile.show') }}">
                  <i class="bi bi-person"></i>
                  <span>Profile</span>
              </a>
          </li>
          <!-- End Profile Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-faq.html">
                  <i class="bi bi-question-circle"></i>
                  <span>F.A.Q</span>
              </a>
          </li><!-- End F.A.Q Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="pages-contact.html">
                  <i class="bi bi-envelope"></i>
                  <span>Contact</span>
              </a>
          </li>
          <!-- End Contact Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('public.pages.home') }}">
                  <i class="bi bi-home"></i>
                  <span>Acceuil</span>
              </a>
          </li>
          <!-- End Profile Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="logout.html"
                  onclick="logout(event, '{{ route('admin.logout') }}', '{{ csrf_token() }}')">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Déconnexion</span>
              </a>
          </li>
      </ul>

  </aside>
