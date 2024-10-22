function editProgram(program) {
    const form = document.getElementById('programForm');
    form.action = `{{ url('academic_programs') }}/${program.id}`;
    document.getElementById('program_id').value = program.id;
    document.getElementById('name').value = program.name;
    document.getElementById('abb').value = program.abb;
    document.getElementById('programModalLabel').innerText = 'Modifier un Programme Académique';
    const modal = new bootstrap.Modal(document.getElementById('programModal'));
    modal.show();
}

document.getElementById('programModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('programForm').reset();
    document.getElementById('program_id').value = '';
    document.getElementById('programModalLabel').innerText = 'Ajouter un Programme Académique';
});
