async function home() {
    // Initialisation des sélecteurs avec un thème commun
    const select2Options = { theme: 'bootstrap-5' };
    $('#level, #category, #university, #program').select2(select2Options);

}
