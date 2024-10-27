function logout(event, route, csrfToken) {
    // Prévenir le comportement par défaut du formulaire ou du lien
    event.preventDefault();

    // Créer un formulaire
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = route;

    // Créer un input pour le CSRF token
    const csrfTokenInput = document.createElement('input');
    csrfTokenInput.type = 'hidden';
    csrfTokenInput.name = '_token';
    csrfTokenInput.value = csrfToken;
    form.appendChild(csrfTokenInput);

    // Créer un input pour la méthode DELETE
    // const methodInput = document.createElement('input');
    // methodInput.type = 'hidden';
    // methodInput.name = '_method';
    // methodInput.value = 'DELETE';
    // form.appendChild(methodInput);

    // Ajouter le formulaire au DOM
    document.body.appendChild(form);

    // Confirmer l'action de déconnexion
    if (confirm("Voulez-vous vraiment vous déconnecter ?")) {
        // Soumettre le formulaire
        form.submit();
    } else {
        // Supprimer le formulaire si l'utilisateur annule
        document.body.removeChild(form);
    }
}

function showModal(selector, condition) {
    const modalElement = document.querySelector(selector);
    if (modalElement && condition) {
        const modal = new bootstrap.Modal(modalElement);
        modal.show();
    }
}

function initializeModalForm(modalSelector, formSelector, callback) {
    const modalElement = document.querySelector(modalSelector);

    modalElement.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const form = document.querySelector(formSelector);

        console.log(form);


        if (button && typeof callback === 'function') {
            callback(button, form);
        }
    });
}

function initializeModalForm(modalSelector, formSelector, callback) {
    const modalElement = document.querySelector(modalSelector);

    modalElement.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Le bouton qui a ouvert le modal
        const form = document.querySelector(formSelector); // Le formulaire dans le modal

        // Vérifier si le formulaire est trouvé
        if (!form) {
            console.error("Le formulaire n'a pas été trouvé !");
            return;
        }

        // Appeler le callback si fourni
        if (button && typeof callback === 'function') {
            callback(button, form);
        }
    });
}

function initializeSelect2WithCreate({
    selectId,
    apiUrl,
    resource = 'option',
    placeholder = "Select an option",
    noResultsMessage = "Option not found",
    fetchOptions = () => null,
    afterSelectCallback = () => { }
}) {
    $(selectId).select2({
        theme: 'bootstrap-5',
        placeholder: placeholder,
        allowClear: true,
        ajax: fetchOptions(apiUrl),
        language: {
            noResults: function () {
                return `
                        <div>
                            <p>${noResultsMessage}</p>
                            <button id="create-btn-${selectId.replace('#', '')}" class="btn btn-primary mt-2">Create new ${resource}</button>
                        </div>
                    `;
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        }
    });

    // Création d'une nouvelle option lorsque le bouton "Create new" est cliqué
    $(document).on('click', `#create-btn-${selectId.replace('#', '')}`, function () {
        const searchValue = $('.select2-search__field').val();
        if (searchValue) {
            createNewResource(apiUrl, {
                name: searchValue
            })
                .then(data => addOptionToSelect(selectId, data, resource, afterSelectCallback))
                .catch(error => handleError(error, resource));
        }
    });
}

// Fonction pour créer une nouvelle ressource via une requête POST
function createNewResource(apiUrl, data) {
    return fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify(data),
        credentials: 'same-origin'
    })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        });
}

// Ajout de l'option créée au select et déclenchement d'une action après sélection
function addOptionToSelect(selectId, result, resource, afterSelectCallback) {
    if (result.status === 'success') {
        const newOption = new Option(result.data.name, result.data.id, false, true);
        $(selectId).append(newOption).val(result.data.id).trigger('change');
        alert(`New ${resource} "${result.data.name}" created successfully!`);
        $('.select2-search__field').val('').trigger('input');
        afterSelectCallback();
    } else {
        alert('Error: ' + result.message);
    }
}

// Gestion des erreurs de création d'option
function handleError(error, resource) {
    console.error('Error:', error);
    alert(`Failed to create the ${resource}.`);
}
