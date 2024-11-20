<div>
    <div class="card h-100">
        <!-- Image de la ressource -->
        {{-- <img src="{{ $resource->getImageUrl() }}" class="card-img-top" alt="Image de {{ $resource->name }}"
            style="height: 200px; object-fit: cover;"> --}}

        <div class="card-body">
            <!-- Nom et Catégorie -->
            <h5 class="card-title">{{ $resource->name }}</h5>
            <span class="badge gradient-7 rounded-pill">{{ $resource->category->name }}</span>


            <!-- Informations essentielles -->
            <p class="card-text">
                <strong>Module :</strong> {{ $resource->courseModule->name }} <br>
                <strong>Filière :</strong> {{ $resource->academicProgram->name }}
                ({{ $resource->academicLevel->name }})
                <br>
                <strong>Université :</strong> {{ $resource->university->name }}
                {{-- <br>
                <strong>Téléchargements :</strong> {{ $resource->download_count }} --}}
            </p>

            <!-- Boutons d'actions -->
            <button class="btn btn-sm btn-soft-blue" data-bs-toggle="modal"
                data-bs-target="#resourceModal{{ $resource->id }}" title="Voir plus d'information">
                <i class="uil uil-info-circle"></i>
                {{-- Infos --}}
                {{-- <i class="uil uil-eye"></i> --}}
            </button>
            <a href="{{ route('public.resource.view', $resource) }}" class="btn btn-sm btn-soft-blue "
                title="visualise la resource" target="_blank">
                <i class="uil uil-eye"></i>
            </a>
            {{-- <a href="{{ asset('storage/' . $resource->file_url) }}" class="btn btn-sm btn-soft-blue view-resource"
                title="visualise la resource" target="_blank">
                <i class="uil uil-eye"></i>
            </a> --}}
            <a href="{{ route('public.resource.download', $resource->id) }}" class="btn btn-sm btn-primary">
                <i class="uil uil-download-alt me-2"></i>
                <span>Télécharger</span>
            </a>
        </div>
    </div>

    <div class="modal fade" id="resourceModal{{ $resource->id }}" tabindex="-1"
        aria-labelledby="resourceModalLabel{{ $resource->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resourceModalLabel{{ $resource->id }}">
                        {{ $resource->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Catégorie :</strong> <span
                            class="badge gradient-7 rounded-pill">{{ $resource->category->name }}</span>
                    </p>
                    <p><strong>Module :</strong> {{ $resource->courseModule->name }}
                    </p>
                    <p><strong>Filière :</strong>
                        {{ $resource->academicProgram->name }}
                        ({{ $resource->academicLevel->name }})</p>
                    <p><strong>Université :</strong> {{ $resource->university->name }}
                    </p>
                    <p><strong>Taille :</strong>
                        {{ $resource->getFileSize(format: true) }}
                    </p>
                    <p><strong>Téléchargements :</strong>
                        {{ $resource->download_count }}
                    </p>
                    <p><strong>Date d'upload :</strong>
                        {{ $resource->created_at->format('d M y') }}</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('public.resource.download', $resource->id) }}" class="btn btn-primary">
                        <i class="uil uil-download-alt me-2"></i>
                        Télécharger
                    </a>
                    <a href="{{ asset('storage/' . $resource->file_url) }}" class="btn btn-soft-blue"
                        title="visualise la resource ">
                        <i class="uil uil-eye me-2"></i>
                        Lire
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>
