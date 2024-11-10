async function home({ endpoint, params }) {
    // Initialisation des sélecteurs avec un thème commun
    const select2Options = { theme: 'bootstrap-5' };
    const academicProgramsSelect = $('#program').select2(select2Options);
    $('#level, #category, #university').select2(select2Options);

    // Récupération des universités
    const universitiesRaw = await fetchUniversities(endpoint, params);

    if (!universitiesRaw || universitiesRaw.length === 0) {
        alert('Université non chargée, veuillez recharger la page');
        return;
    }

    // Traitement des données des universités et stockage dans le localStorage
    const universities = universitiesRaw.map(item => ({
        id: item.id,
        name: item.name,
        academicPrograms: item.academicPrograms.map(program => ({
            id: program.id,
            name: program.name,
        })),
    }));
    localStorage.setItem('universities', JSON.stringify(universities));

    // Préparation et assignation des options pour le sélecteur d'universités
    const universitiesOptions = mapToSelect2Options(universities);
    $('#university').select2({
        ...select2Options,
        data: universitiesOptions
    });

    // Fonction pour obtenir les programmes d'une université par ID
    function getProgramsByUniversity(id) {
        const storedUniversities = localStorage.getItem('universities');
        if (!storedUniversities) {
            alert('Université non chargée, veuillez recharger la page');
            return [];
        }
        const university = JSON.parse(storedUniversities).find(item => item.id === +id);
        return university ? university.academicPrograms : [];
    }

    // Fonction pour remplir le sélecteur de programmes académiques
    function populateAcademicProgramsSelect(selectElement, programsData) {
        selectElement.empty().trigger('change');
        selectElement.append(new Option('Choisir la filière', -1, true, true));
        programsData.forEach(program => {
            selectElement.append(new Option(program.name, program.id));
        });
        selectElement.val(-1).trigger('change');
    }

    // Événement de changement pour l'université sélectionnée
    $('#university').on('change', function () {
        const selectedUniversityId = $(this).val();
        const programsData = getProgramsByUniversity(selectedUniversityId);
        populateAcademicProgramsSelect(academicProgramsSelect, programsData);
    });
}
