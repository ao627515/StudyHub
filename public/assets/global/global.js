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

