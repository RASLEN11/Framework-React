<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Stagiaire;
use App\Models\Qualification;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeesExport;
use App\Exports\StagiairesExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PersonnelManagementController extends Controller
{
    /**
     * Display a listing of personnel (both employees and stagiaires)
     */
    public function index(Request $request)
    {
        // Get counts for statistics
        $employeeCount = Employee::count();
        $stagiaireCount = Stagiaire::count();
        $qualificationCount = Employee::has('qualifications')->count();

        // Get active tab from request or default to employees
        $activeTab = $request->get('tab', 'employees');

        // Initialize queries
        $employeeQuery = Employee::query();
        $stagiaireQuery = Stagiaire::query();

        // Apply search filters if present
        if ($request->has('cin')) {
            $employeeQuery->where('cin', 'like', '%' . $request->input('cin') . '%');
            $stagiaireQuery->where('cin', 'like', '%' . $request->input('cin') . '%');
        }

        // Paginate results
        $employees = $employeeQuery->latest()->paginate(5, ['*'], 'employees_page');
        $stagiaires = $stagiaireQuery->latest()->paginate(5, ['*'], 'stagiaires_page');

        return view('admin.personnel.index', compact(
            'employees',
            'stagiaires',
            'employeeCount',
            'stagiaireCount',
            'qualificationCount',
            'activeTab'
        ));
    }

    /**
     * Show the form for creating a new employee
     */
    public function createEmployee()
    {
        return view('admin.personnel.employees_modals.create');
    }

    /**
     * Store a newly created employee
     */
    public function storeEmployee(Request $request)
    {
        $request->validate([
            'cin' => [
                'required',
                'unique:employees',
                'max:255',
                'regex:/^\d{4}.+/',
                function ($attribute, $value, $fail) {
                    if (preg_match('/^\d{4}/', $value) !== 1) {
                        $fail('Le CIN doit commencer par 4 chiffres.');
                    }
                },
            ],
            'full_name' => 'required|max:255',
            'birth_date' => 'required|date|before_or_equal:-18 years',
            'genre' => 'required|in:male,female',
            'phone_number' => 'required|max:255',
            'address' => 'required',
            'education_level' => 'required|max:255',
            'hire_date' => 'required|date|before_or_equal:today',
            'category' => 'required|in:indirect,direct',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('avatar');
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        Employee::create($data);

        return redirect()->route('personnel.index', ['tab' => 'employees'])
            ->with('success', 'Employee created successfully!');
    }

    /**
     * Show the form for creating a new stagiaire
     */
    public function createStagiaire()
    {
        return view('admin.personnel.stagiaires_modals.create');
    }

    /**
     * Store a newly created stagiaire
     */
    public function storeStagiaire(Request $request)
    {
        $validated = $request->validate([
            'cin' => 'required|unique:stagiaires|max:20',
            'full_name' => 'required|max:255',
            'birth_date' => 'required|date|before_or_equal:-18 years',
            'genre' => 'required|in:male,female',
            'phone_number' => 'required|max:20',
            'education_level' => 'required',
            'address' => 'required',
            'school' => 'required',
            'field_of_study' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('stagiaires/avatars', 'public');
        }

        Stagiaire::create($validated);

        return redirect()->route('personnel.index', ['tab' => 'stagiaires'])
            ->with('success', 'Intern created successfully!');
    }

    /**
     * Display the specified employee
     */
    public function showEmployee(Employee $employee)
    {
        return view('admin.personnel.employees_modals.show', compact('employee'));
    }

    /**
     * Display the specified stagiaire
     */
    public function showStagiaire(Stagiaire $stagiaire)
    {
        return view('admin.personnel.stagiaires_modals.show', compact('stagiaire'));
    }

    /**
     * Show the form for editing the specified employee
     */
    public function editEmployee(Employee $employee)
    {
        return view('admin.personnel.employees.modals.edit', compact('employee'));
    }

    /**
     * Show the form for editing the specified stagiaire
     */
    public function editStagiaire(Stagiaire $stagiaire)
    {
        return view('admin.personnel.stagiaires_modals.edit', compact('stagiaire'));
    }

    /**
     * Update the specified employee
     */
    public function updateEmployee(Request $request, Employee $employee)
    {
        $request->validate([
            'cin' => [
                'required',
                'max:255',
                'unique:employees,cin,' . $employee->id,
                'regex:/^\d{4}.+/',
                function ($attribute, $value, $fail) {
                    if (preg_match('/^\d{4}/', $value) !== 1) {
                        $fail('Le CIN doit commencer par 4 chiffres.');
                    }
                },
            ],
            'full_name' => 'required|max:255',
            'birth_date' => 'required|date|before_or_equal:-18 years',
            'genre' => 'required|in:male,female',
            'phone_number' => 'required|max:255',
            'address' => 'required',
            'education_level' => 'required|max:255',
            'hire_date' => 'required|date|before_or_equal:today',
            'category' => 'required|in:indirect,direct',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('avatar');
        if ($request->hasFile('avatar')) {
            if ($employee->avatar) {
                Storage::disk('public')->delete($employee->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $employee->update($data);

        return redirect()->route('personnel.index', ['tab' => 'employees'])
            ->with('success', 'Employee updated successfully!');
    }

    /**
     * Update the specified stagiaire
     */
    public function updateStagiaire(Request $request, Stagiaire $stagiaire)
    {
        $validated = $request->validate([
            'cin' => 'required|max:20|unique:stagiaires,cin,' . $stagiaire->id,
            'full_name' => 'required|max:255',
            'birth_date' => 'required|date|before_or_equal:-18 years',
            'genre' => 'required|in:male,female',
            'phone_number' => 'required|max:20',
            'education_level' => 'required',
            'address' => 'required',
            'school' => 'required',
            'field_of_study' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('avatar')) {
            if ($stagiaire->avatar) {
                Storage::disk('public')->delete($stagiaire->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('stagiaires/avatars', 'public');
        }

        $stagiaire->update($validated);

        return redirect()->route('personnel.index', ['tab' => 'stagiaires'])
            ->with('success', 'Intern updated successfully!');
    }

    /**
     * Remove the specified employee
     */
    public function destroyEmployee(Employee $employee)
    {
        if ($employee->avatar) {
            Storage::disk('public')->delete($employee->avatar);
        }
        $employee->delete();

        return redirect()->route('personnel.index', ['tab' => 'employees'])
            ->with('success', 'Employee deleted successfully!');
    }

    /**
     * Remove the specified stagiaire
     */
    public function destroyStagiaire(Stagiaire $stagiaire)
    {
        if ($stagiaire->avatar) {
            Storage::disk('public')->delete($stagiaire->avatar);
        }
        
        $stagiaire->delete();
        
        return redirect()->route('personnel.index', ['tab' => 'stagiaires'])
            ->with('success', 'Intern deleted successfully!');
    }

    /**
     * Export employees to Excel
     */
    public function exportEmployeesSimple()
{
    $fileName = 'employees_' . now()->format('Y-m-d_His') . '.xlsx';
    
    return Excel::download(
        Employee::all(), 
        $fileName
    );
}

    /**
     * Export stagiaires to Excel
     */
    public function exportStagiaires(Request $request)
    {
        $filters = [
            'cin' => $request->input('cin'),
            'education_level' => $request->input('education_level'),
        ];

        $fileName = 'interns_' . now()->format('Y-m-d_His') . '.xlsx';

        return Excel::download(new StagiairesExport($filters), $fileName, \Maatwebsite\Excel\Excel::XLSX, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /**
     * Show the form for creating a new qualification for an employee.
     */
    public function createQualification(Employee $employee)
    {
        return view('admin.personnel.employees.qualifications.create', compact('employee'));
    }

    /**
     * Store a newly created qualification for an employee.
     */
    public function storeQualification(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'date' => 'required|date|before_or_equal:today',
            'trainer' => 'required|string|max:255',
            'note' => 'required|numeric|min:0|max:20',
            'next_qualification_date' => [
                'nullable',
                'date',
                'after:date',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->note < 15 && empty($value)) {
                        $fail('Next qualification date is required for scores below 15');
                    }
                },
            ],
        ]);

        $employee->qualifications()->create($validated);

        return redirect()->route('personnel.index', ['tab' => 'employees'])
            ->with('success', 'Qualification added successfully');
    }

    /**
     * Update the specified qualification in storage.
     */
    public function update(Employee $employee, Qualification $qualification, Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'date' => 'required|date|before_or_equal:today',
            'trainer' => 'required|string|max:255',
            'note' => 'required|numeric|min:0|max:20',
            'next_qualification_date' => [
                'nullable',
                'date',
                'after:date',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->note < 15 && empty($value)) {
                        $fail('Next qualification date is required for scores below 15');
                    }
                },
            ],
        ]);

        // Only allow updates for qualifications with score < 15 if the new score is >= 15
        if ($qualification->note >= 15 && $validated['note'] < 15) {
            return redirect()->route('personnel.index', ['tab' => 'employees'])
                ->with('error', 'Cannot change qualification score to below 15 once it was 15 or higher');
        }

        $qualification->update($validated);

        return redirect()->route('personnel.index', ['tab' => 'employees'])
            ->with('success', 'Qualification updated successfully');
    }
    /**
     * Remove the specified qualification from storage.
     */
    public function destroyQualification(Employee $employee, Qualification $qualification)
    {
        $qualification->delete();
        
        return redirect()->route('personnel.index', ['tab' => 'employees'])
            ->with('success', 'Qualification deleted successfully');
    }

    /**
     * Display the specified qualification.
     */
    public function showQualification(Employee $employee, Qualification $qualification)
    {
        return view('admin.personnel.employees.qualifications.show', compact('employee', 'qualification'));
    }
}