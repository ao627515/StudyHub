

function getFormElement(selector) {
    return document.querySelector(selector);
}

function previewLogo(event) {
    const logoPreviewContainer = getFormElement('#logoPreviewContainer');
    const logoPreview = getFormElement('#logoPreview');

    if (event.target.files && event.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            logoPreview.src = e.target.result;
            logoPreviewContainer.style.display = 'block'; // Afficher la prévisualisation
        }
        reader.readAsDataURL(event.target.files[0]);
    }
}

function editUniversity(university) {
    const form = getFormElement('#universityForm');
    const modalLabel = getFormElement('#universityModalLabel');
    const currentLogoContainer = getFormElement('#currentLogoContainer');
    const currentLogo = getFormElement('#currentLogo');

    // Pré-remplir le formulaire avec les données de l'université sélectionnée
    form.action = `{{ route('admin.universities.update', '') }}/${university.id}`;
    modalLabel.innerText = 'Modifier une Université';
    getFormElement('#name').value = university.name;
    getFormElement('#abb').value = university.abb;
    getFormElement('#university_id').value = university.id;

    // Afficher le logo actuel s'il existe
    if (university.logo) {
        currentLogo.src = '/storage/' + university.logo;
        currentLogoContainer.style.display = 'block'; // Afficher le conteneur du logo actuel
    } else {
        currentLogoContainer.style.display = 'none'; // Masquer si pas de logo actuel
    }

    // Réinitialiser la prévisualisation du logo
    getFormElement('#logoPreviewContainer').style.display = 'none'; // Masquer la prévisualisation
    getFormElement('#logoPreview').src = ''; // Réinitialiser l'image de prévisualisation

    // Ajout de l'input caché pour la méthode PUT
    if (!form.querySelector("input[name='_method']")) {
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PUT';
        form.appendChild(methodInput);
    }
}

document.getElementById('universityModal').addEventListener('hidden.bs.modal', function () {
    const form = getFormElement('#universityForm');
    form.reset();
    getFormElement('#universityModalLabel').innerText = 'Ajouter une Université';

    // Suppression de l'input caché de méthode si présent
    const methodInput = form.querySelector("input[name='_method']");
    if (methodInput) {
        form.removeChild(methodInput);
    }

    // Réinitialiser la prévisualisation et le logo actuel
    getFormElement('#logoPreviewContainer').style.display = 'none';
    getFormElement('#logoPreview').src = '';
    getFormElement('#currentLogoContainer').style.display = 'none';
});
