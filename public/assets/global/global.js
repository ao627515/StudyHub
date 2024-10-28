// document.addEventListener('DOMContentLoaded', function () {


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
    newResourceData = {},
    resource = 'option',
    placeholder = "Select an option",
    noResultsMessage = "Option not found",
    fetchOptions = () => null,
    afterSelectCallback = () => null,
    data = null
}) {
    const select2 = $(selectId).select2({
        theme: 'bootstrap-5',
        placeholder: placeholder,
        allowClear: true,
        ajax: fetchOptions(apiUrl),
        data: data,
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
            // console.log(newResourceData);

            createNewResource(apiUrl, newResourceData)

                .then(data => addOptionToSelect(selectId, data, resource, afterSelectCallback))
                .catch(error => handleError(error, resource));
        }
    });

    return select2;
}

// Fonction pour créer une nouvelle ressource via une requête POST
function createNewResource(apiUrl, data) {
    console.log(data);

    const keys = Object.keys(data);

    keys.forEach(key => {
        if (typeof data[key] == 'function') {
            data[key] = data[key]()
        }
    });

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
            if (!response.ok) {
                throw new Error('Network response was not ok')
            };
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

function buildUrlWithParams(endpoint, params) {
    const url = new URL(endpoint);
    Object.entries(params).forEach(([key, value]) => url.searchParams.append(key, JSON.stringify(
        value)));
    return url;
}

// Fonction pour récupérer les universités avec leurs programmes académiques
async function fetchUniversities(endpoint, params = {}) {
    try {
        const urlWithParams = buildUrlWithParams(endpoint, params);
        const response = await fetch(urlWithParams, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            credentials: 'same-origin'
        });

        if (!response.ok) throw new Error('Network response was not ok');
        const data = await response.json();
        return data.data || [];
    } catch (error) {
        console.error('Error fetching universities data:', error);
        return [];
    }
}

async function fetchUniversity(endpoint, params = {}) {
    try {
        const urlWithParams = buildUrlWithParams(endpoint, params);
        const response = await fetch(urlWithParams, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            credentials: 'same-origin'
        });

        if (!response.ok) {

            // console.log(await response.json());

            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        return data.data || null;
    } catch (error) {
        console.error('Error fetching university data:', error);
        return null;
    }
}

// Transformer les données pour Select2
function mapToSelect2Options(data, labelKey = 'name') {
    return data.map(item => ({
        id: item.id,
        text: item[labelKey]
    }));
}

// // Initialiser Select2 avec des données
// async function initializeSelect2Fields(apiUri) {
//     const endpoint = `${apiUri} / api / universities`;
//     const params = {
//         relations: ['academicPrograms']
//     };

//     const universitiesData = await fetchUniversities(endpoint, params);

//     // Initialiser le champ des universités
//     initializeSelect2WithCreate({
//         selectId: '#universities',
//         apiUrl: endpoint,
//         newResourceData: {
//             name: $('.select2-search__field').val()
//         },
//         resource: 'university',
//         placeholder: 'Search for a university...',
//         noResultsMessage: 'No results found',
//         data: mapToSelect2Options(universitiesData)
//     });

//     // Initialiser le champ des niveaux académiques
//     initializeSelect2WithCreate({
//         selectId: '#academic_levels',
//         apiUrl: `${apiUri} / api / academic_levels`,
//         newResourceData: {
//             name: $('.select2-search__field').val()
//         },
//         resource: 'academic level',
//         placeholder: 'Search for an academic level...',
//         noResultsMessage: 'No results found'
//     });

//     // Initialiser le champ des programmes académiques sans données
//     const academicProgramsSelect = initializeSelect2WithCreate({
//         selectId: '#academic_programs',
//         apiUrl: `${apiUri} / api / academic_programs`,
//         newResourceData: {
//             name: $('.select2-search__field').val(),
//             university_id: $('#universities').val()
//         },
//         resource: 'academic program',
//         placeholder: 'Search for an academic program...',
//         noResultsMessage: 'No results found',
//         data: []
//     });

//     // Mettre à jour les programmes académiques en fonction de l'université sélectionnée
//     $('#universities').on('change', function () {
//         const selectedUniversity = universitiesData.find(u => u.id == $(this).val());
//         const programsData = selectedUniversity ? mapToSelect2Options(selectedUniversity
//             .academicPrograms) : [];

//         academicProgramsSelect.empty().trigger('change');
//         programsData.forEach(option => {
//             academicProgramsSelect.append(new Option(option.text, option.id));
//         });
//         $('#academic_programs').val(null).trigger('change');

//         // Afficher le champ des programmes si une université est sélectionnée
//         // if (programsData.length) {
//         //     $('#academic_programs').closest('.d-none').removeClass('d-none');
//         // } else {
//         //     $('#academic_programs').closest('.d-none').addClass('d-none');
//         // }

//         if ($('#academic_programs').closest('.d-none').hasClass('d-none')) {
//             $('#academic_programs').closest('.d-none').removeClass('d-none');
//         }
//     });
// }

// window.edit = edit; // Expose la fonction au global si nécessaire
// });
