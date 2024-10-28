async function populateAcademicProgramsSelect(academicProgramsSelect, apiUri) {
    const university = await fetchUniversity(`${apiUri}/universities/` + document
        .querySelector('#universities').value, {
        relations: ['academicPrograms']
    });

    if (university) {

        const programsData = mapToSelect2Options(university.academicPrograms);
        academicProgramsSelect.empty().trigger('change');
        programsData.forEach(option => {
            academicProgramsSelect.append(new Option(option.text, option
                .id));
        });
        document.querySelector('#academic_programs').value = null;
        $('#academic_programs').trigger('change');
    }
}

async function uploaderCreate(apiUri) {
    // Initialisation des sélecteurs avec Select2
    initializeSelect2WithCreate({
        selectId: '#universities',
        apiUrl: `${apiUri}/universities`,
        newResourceData: {
            name: (() => document.querySelector('.select2-search__field').value)
        },
        resource: 'university',
        placeholder: 'Search for a university...',
        noResultsMessage: 'No results found',
    });

    initializeSelect2WithCreate({
        selectId: '#academic_levels',
        apiUrl: `${apiUri}/academic_levels`,
        newResourceData: {
            name: (() => document.querySelector('.select2-search__field').value)
        },
        resource: 'academic level',
        placeholder: 'Search for an academic level...',
        noResultsMessage: 'No results found'
    });

    const academicProgramsSelect = initializeSelect2WithCreate({
        selectId: '#academic_programs',
        apiUrl: `${apiUri}/academic_programs`,
        newResourceData: {
            name: (() => document.querySelector('.select2-search__field').value),
            university_id: () => document.querySelector('#universities').value
        },
        resource: 'academic program',
        placeholder: 'Search for an academic program...',
        noResultsMessage: 'No results found',
        data: []
    });


    $('#universities').on('change', function () {
        populateAcademicProgramsSelect(academicProgramsSelect, apiUri);
        if (document.querySelector('#academic_programs').closest('.d-none') && document
            .querySelector('#academic_programs').closest('.d-none').classList
            .contains('d-none')) {
            document.querySelector('#academic_programs').closest('.d-none').classList
                .remove('d-none');
        }
    });
}
