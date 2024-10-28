async function edit({
    appUrl,
    universitiesSelectId,
    academicLevelsSelectId,
    academicProgramsSelectId,
    initialProgramId = null,
    select2InitFunction,
    searchTerm = () => null
}) {
    // Initialise Select2 pour les universités
    select2InitFunction({
        selectId: universitiesSelectId,
        apiUrl: `${appUrl}/api/universities`,
        newResourceData: {
            name: searchTerm
        },
        resource: 'university',
        placeholder: 'Search for a university...',
        noResultsMessage: 'No results found'
    });

    // Initialise Select2 pour les niveaux académiques
    select2InitFunction({
        selectId: academicLevelsSelectId,
        apiUrl: `${appUrl}/api/academic_levels`,
        newResourceData: {
            name: searchTerm
        },
        resource: 'academic level',
        placeholder: 'Search for an academic level...',
        noResultsMessage: 'No results found'
    });

    // Initialise Select2 pour les programmes académiques
    const academicProgramsSelect = select2InitFunction({
        selectId: academicProgramsSelectId,
        apiUrl: `${appUrl}/api/academic_programs`,
        newResourceData: {
            name: searchTerm,
            university_id: () => $(universitiesSelectId).val()
        },
        resource: 'academic program',
        placeholder: 'Search for an academic program...',
        noResultsMessage: 'No results found',
        data: []
    });

    // Fetch et définir les options pour les programmes académiques
    async function fetchUniversityPrograms(universityId) {
        const endpoint = `${appUrl}/api/universities/${universityId}`;
        const params = { relations: ['academicPrograms'] };
        const university = await fetchUniversity(endpoint, params);

        if (university) {
            const programsData = mapToSelect2Options(university.academicPrograms);
            academicProgramsSelect.empty().trigger('change');
            programsData.forEach(option => {
                academicProgramsSelect.append(new Option(option.text, option.id));
            });
            if (initialProgramId) {
                $(academicProgramsSelectId).val(initialProgramId).trigger('change');
            }
        }
    }

    // Chargement initial des programmes académiques si une université est sélectionnée
    const initialUniversityId = $(universitiesSelectId).val();
    if (initialUniversityId) {
        await fetchUniversityPrograms(initialUniversityId);
    }

    // Mettre à jour les programmes académiques lorsque l'université change
    $(universitiesSelectId).on('change', async function () {
        const universityId = $(this).val();
        await fetchUniversityPrograms(universityId);
        $(academicProgramsSelectId).val(initialProgramId).trigger('change');
    });
}
