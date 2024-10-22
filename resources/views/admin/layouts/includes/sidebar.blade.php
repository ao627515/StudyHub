  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a @class([
                  'nav-link',
                  'collapsed' => !Route::currentRouteNamed('admin.dashboard'),
              ]) href="{{ route('admin.dashboard') }}">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li>
          <!-- End Dashboard Nav -->

          <li class="nav-item">
              <a @class(['nav-link', 'collapsed' => !Route::is('*administrators*')]) data-bs-target="#administrators-nav" data-bs-toggle="collapse"
                  href="#">
                  <i class="bi bi-journal-text"></i><span>Adminstrateurs</span><i
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
                          <i class="bi bi-circle"></i><span>Ajouter</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.administrators.index') }}" @class([
                          'active' => Route::currentRouteNamed('*administrators.index'),
                      ])>
                          <i class="bi bi-circle"></i><span>Liste</span>
                      </a>
                  </li>
              </ul>
          </li>
          <!-- End administrators Nav -->

          <li class="nav-item">
              <a @class(['nav-link', 'collapsed' => !Route::is('*moderators*')]) data-bs-target="#moderators-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-journal-text"></i><span>Moderateurs</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="moderators-nav" @class([
                  'nav-content',
                  'collapse',
                  'show' => Route::is('*moderators*'),
              ]) data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('admin.moderators.create') }}" @class([
                          'active' => Route::currentRouteNamed('*moderators.create'),
                      ])>
                          <i class="bi bi-circle"></i><span>Ajouter</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.moderators.index') }}" @class([
                          'active' => Route::currentRouteNamed('*moderators.index'),
                      ])>
                          <i class="bi bi-circle"></i><span>Liste</span>
                      </a>
                  </li>
              </ul>
          </li>
          <!-- End moderators Nav -->

          <li class="nav-item">
              <a @class(['nav-link', 'collapsed' => !Route::is('*uploders*')]) data-bs-target="#uploders-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-journal-text"></i><span>Uploders</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="uploders-nav" @class(['nav-content', 'collapse', 'show' => Route::is('*uploders*')]) data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('admin.uploders.create') }}" @class([
                          'active' => Route::currentRouteNamed('*uploders.create'),
                      ])>
                          <i class="bi bi-circle"></i><span>Ajouter</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.uploders.index') }}" @class([
                          'active' => Route::currentRouteNamed('*uploders.index'),
                      ])>
                          <i class="bi bi-circle"></i><span>Liste</span>
                      </a>
                  </li>
              </ul>
          </li>
          <!-- End uploders Nav -->

          <li class="nav-item">
              <a @class(['nav-link', 'collapsed' => !Route::is('*universities*')]) data-bs-target="#universities-nav" data-bs-toggle="collapse"
                  href="#">
                  <i class="bi bi-journal-text"></i><span>Universites</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="universities-nav" @class([
                  'nav-content',
                  'collapse',
                  'show' => Route::is('*universities*'),
              ]) data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('admin.universities.create') }}" @class([
                          'active' => Route::currentRouteNamed('*universities.create'),
                      ])>
                          <i class="bi bi-circle"></i><span>Ajouter</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.universities.index') }}" @class([
                          'active' => Route::currentRouteNamed('*universities.index'),
                      ])>
                          <i class="bi bi-circle"></i><span>Liste</span>
                      </a>
                  </li>
              </ul>
          </li>
          <!-- End universities Nav -->

          {{-- academic_programs --}}


          <li class="nav-item">
              <a @class(['nav-link', 'collapsed' => !Route::is('*academic_programs*')]) data-bs-target="#academic_programs-nav" data-bs-toggle="collapse"
                  href="#">
                  <i class="bi bi-journal-text"></i><span>Universites</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="academic_programs-nav" @class([
                  'nav-content',
                  'collapse',
                  'show' => Route::is('*academic_programs*'),
              ]) data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('admin.academic_programs.create') }}" @class([
                          'active' => Route::currentRouteNamed('*academic_programs.create'),
                      ])>
                          <i class="bi bi-circle"></i><span>Ajouter</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('admin.academic_programs.index') }}" @class([
                          'active' => Route::currentRouteNamed('*academic_programs.index'),
                      ])>
                          <i class="bi bi-circle"></i><span>Liste</span>
                      </a>
                  </li>
              </ul>
          </li>

          <!-- End academic_programs Nav -->
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
      </ul>

  </aside>