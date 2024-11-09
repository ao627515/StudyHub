async function searchAdvance({ apiUrl, params }) {
    const select2Options = { theme: 'bootstrap-5' };
    const academicProgramsSelect = $('#program').select2(select2Options);
    const academicLevelsSelect = $('#level').select2(select2Options);
    const moduleSelect = $('#module').select2(select2Options);
    $('#category, #university, #module, #shool_year').select2(select2Options);

    // Chargement des universités
    const universitiesRaw = await fetchUniversities(`${apiUrl}/api/universities`, params);
    if (!universitiesRaw || universitiesRaw.length === 0) {
        alert('Université non chargée, veuillez recharger la page');
        return;
    }

    const universities = universitiesRaw.map(item => ({
        id: item.id,
        name: item.name,
        academicPrograms: item.academicPrograms.map(program => ({
            id: program.id,
            name: program.name,
            academicLevels: program.academicLevels.map(level => ({
                id: level.id,
                name: level.name,
            })),
        })),
    }));

    // Stocker les universités en local
    localStorage.setItem('universities', JSON.stringify(universities));
    console.log(universities);


    // Initialiser les options d'université pour Select2
    const universitiesOptions = mapToSelect2Options(universities);
    $('#university').select2({
        ...select2Options,
        data: universitiesOptions,
    });

    // Fonction pour obtenir les programmes d'une université par ID
    function getProgramsByUniversity(universityId) {
        const storedUniversities = JSON.parse(localStorage.getItem('universities') || '[]');
        const university = storedUniversities.find(item => item.id === +universityId);
        return university ? university.academicPrograms : [];
    }

    // Fonction pour obtenir les niveaux académiques d'un programme par ID
    function getLevelByProgram(programId, universityId) {
        const programs = getProgramsByUniversity(universityId);
        const program = programs.find(item => item.id === +programId);
        return program ? program.academicLevels : [];
    }

    // Fonction générique pour remplir un select
    function populateSelect(selectElement, items, defaultText = 'Sélectionner') {
        selectElement.empty().trigger('change');
        selectElement.append(new Option(defaultText, -1, true, true));
        items.forEach(item => {
            selectElement.append(new Option(item.name, item.id));
        });
        selectElement.val(-1).trigger('change');
    }

    function getModulesByProgramAndLevel() {

    }

    // Événement pour changer les programmes académiques en fonction de l'université sélectionnée
    $('#university').on('change', function (levelId, programId, universityId) {
        const selectedUniversityId = $(this).val();
        const programsData = getProgramsByUniversity(selectedUniversityId);
        console.log(programsData);

        populateSelect(academicProgramsSelect, programsData, 'Sélectionner un programme');
    });

    // Événement pour changer les niveaux académiques en fonction du programme sélectionné
    $('#program').on('change', function () {
        const selectedUniversityId = $('#university').val();
        const selectedProgramId = $(this).val();
        if (selectedProgramId > 0) {
            const levelsData = getLevelByProgram(selectedProgramId, selectedUniversityId);
            populateSelect(academicLevelsSelect, levelsData, 'Sélectionner un niveau');
        }
    });

    // Événement pour changer les module en fonction du programme et du niveau academic
    $('#academicLevel').on('change', function () {
        const selectedProgramId = $('#program').val();
        const selectedUniversityId = $('#university').val();
        const selectedLevelId = $(this).val();
        if (selectedProgramId > 0 && selectedLevelId > 0) {
            const modulesData = getModulesByProgramAndLevel(
                selectedProgramId, selectedLevelId, selectedUniversityId);
            populateSelect(modulesSelect, modulesData, 'Sélectionner un module');
        }
    });

}
