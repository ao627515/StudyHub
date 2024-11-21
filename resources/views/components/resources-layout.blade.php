  <div class="card">
      <div class="card-header d-flex align-items-center">
          <span class="me-2">Disposition :</span>

          @if (Route::is('*admin*'))
              <a href="{{ request()->fullUrlWithQuery(['layout' => 'list']) }}"
                  class="btn btn-sm {{ request('layout') === 'list' || !request()->has('layout') ? 'btn-primary' : 'btn-outline-primary' }}"
                  title="Vue liste">
                  <i class="bi bi-list"></i>
              </a>

              <a href="{{ request()->fullUrlWithQuery(['layout' => 'grid']) }}"
                  class="btn btn-sm ms-2 {{ request('layout') === 'grid' ? 'btn-primary' : 'btn-outline-primary' }}"
                  title="Vue en grille">
                  <i class="bi bi-grid"></i>
              </a>
          @else
              <a href="{{ request()->fullUrlWithQuery(['layout' => 'list']) }}"
                  class="btn btn-sm {{ request('layout') === 'list' ? 'btn-primary' : 'btn-outline-primary' }}
                  title="Vue
                  liste">
                  <i class="uil uil-list-ul"></i>
              </a>


              <a href="{{ request()->fullUrlWithQuery(['layout' => 'grid']) }}"
                  class="btn btn-sm ms-2 {{ request('layout') === 'grid' || request('layout') === null || !request()->has('layout') ? 'btn-primary' : 'btn-outline-primary' }}"
                  title="Vue en grille">
                  <i class="uil uil-apps"></i>
              </a>
          @endif


      </div>

      <div class="card-body">
          @if (request('layout') == 'list')
              <x:resource-table :resources="$resources" />
          @else
              <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3">
                  @foreach ($resources as $resource)
                      <div class="col mb-3">
                          <x:resource-card :resource="$resource" :datatable="$datatable" />
                      </div>
                  @endforeach
              </div>
          @endif
      </div>
  </div>
