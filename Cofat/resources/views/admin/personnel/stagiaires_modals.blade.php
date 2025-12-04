{{-- resources/views/admin/personnel/stagiaires_modals.blade.php --}}

@include('admin.personnel.stagiaires_modals.create')
@foreach($stagiaires as $stagiaire)
    @include('admin.personnel.stagiaires_modals.edit', ['stagiaire' => $stagiaire])
    @include('admin.personnel.stagiaires_modals.show', ['stagiaire' => $stagiaire])
    @include('admin.personnel.stagiaires_modals.delete', ['stagiaire' => $stagiaire])
@endforeach