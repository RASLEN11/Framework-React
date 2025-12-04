{{-- resources/views/admin/personnel/qualification_modals.blade.php --}}

@foreach($employees as $employee)
    @include('admin.personnel.qualification_modals.create-qualification', ['employee' => $employee])
@endforeach