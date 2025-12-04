{{-- resources/views/admin/personnel/employees_modals.blade.php --}}

@include('admin.personnel.employees_modals.create')
@foreach($employees as $employee)
    @include('admin.personnel.employees_modals.edit', ['employee' => $employee])
    @include('admin.personnel.employees_modals.show', ['employee' => $employee])
    @include('admin.personnel.employees_modals.delete', ['employee' => $employee])
@endforeach