<div>
    <div class="table-responsive">
        <table class="table table-striped {{ $datatable === 'simple-datatable' ? 'datatable' : '' }}">
            <thead>
                <th>Catégorie</th>
                <th>Nom</th>
                <th>Module</th>
                <th>Filière</th>
                <th>Université</th>
                <th>Fichier</th>
                <th>Taille</th>
                <th>Téléchargements</th>
                <th>Uploader le</th>
            </thead>
            <tbody>
                @foreach ($resources as $resource)
                    <tr>
                        <td>
                            <span class="badge gradient-7 rounded-pill">{{ $resource->category->name }}</span>
                        </td>
                        <td>{{ $resource->name }}</td>
                        <td>{{ $resource->courseModule->name }}</td>
                        <td>{{ $resource->academicProgram->name }}
                            ({{ $resource->academicLevel->name }})
                        </td>
                        <td>{{ $resource->university->name }}</td>
                        <td>
                            <a href="{{ route('public.resource.download', $resource->id) }}">Télécharger</a>
                            <br>
                            <a href="{{ route('public.resource.view', $resource) }}">Voir</a>
                        </td>
                        <td>{{ $resource->getFileSize(format: true) }}</td>
                        <td>{{ $resource->download_count }}</td>
                        <td>{{ $resource->created_at->format('d M y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($datatable === 'simple-datatable')
        {{ $resources->link() }}
    @endif
</div>
