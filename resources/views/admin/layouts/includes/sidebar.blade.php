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
              <a @class(['nav-link', 'collapsed' => !Route::is('*moderators*')]) data-bs-target="#moderators-nav" data-bs-toggle="collapse" href="#">
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
              <a @class(['nav-link', 'collapsed' => !Route::is('*uploaders*')]) data-bs-target="#uploaders-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-cloud-arrow-up"></i><span>Uploaders</span><i class="bi bi-chevron-down ms-auto"></i>
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
                  <i class="bi bi-building-fill"></i><span>Universités</span><i class="bi bi-chevron-down ms-auto"></i>
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
              <a @class(['nav-link', 'collapsed' => !Route::is('*teachers*')]) data-bs-target="#teachers-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-person-badge"></i><span>Professeur</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="teachers-nav" @class(['nav-content', 'collapse', 'show' => Route::is('*teachers*')]) data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('admin.teachers.index') }}" @class([
                          'active' => Route::currentRouteNamed('*teachers.index'),
                      ])>
                          <i class="bi bi-list-ul"></i><span>Liste</span>
                      </a>
                  </li>
              </ul>
          </li>
          <!-- End teacher Nav -->

          <li class="nav-item">
              <a @class(['nav-link', 'collapsed' => !Route::is('*academic_levels*')]) data-bs-target="#academic_levels-nav" data-bs-toggle="collapse"
                  href="#">
                  <i class="bi bi-bar-chart"></i><span>Niveau academique</span><i
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
                          <i class="bi bi-list-ul"></i><span>Liste</span>
                      </a>
                  </li>
              </ul>
          </li>
          <!-- End academic_levels Nav -->


          <li class="nav-heading">Pages</li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="users-profile.html">
                  <i class="bi bi-person"></i>
                  <span>Profile</span>
              </a>
          </li><!-- End Profile Page Nav -->

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
              <a class="nav-link collapsed" href="logout.html"
                  onclick="logout(event, '{{ route('admin.logout') }}', '{{ csrf_token() }}')">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Déconnexion</span>
              </a>
          </li>
      </ul>

  </aside>
