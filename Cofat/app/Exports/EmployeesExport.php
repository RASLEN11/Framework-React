<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Employee::query();

        if (!empty($this->filters['cin'])) {
            $query->where('cin', 'like', '%' . $this->filters['cin'] . '%');
        }

        if (!empty($this->filters['category'])) {
            $query->where('category', $this->filters['category']);
        }

        if (!empty($this->filters['education_level'])) {
            $query->where('education_level', $this->filters['education_level']);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'CIN',
            'First Name',
            'Last Name',
            'Email',
            'Phone',
            'Address',
            'Category',
            'Education Level',
            'Hire Date',
            'Salary',
            'Created At',
            'Updated At'
        ];
    }

    public function map($employee): array
    {
        return [
            $employee->id,
            $employee->cin,
            $employee->first_name,
            $employee->last_name,
            $employee->email,
            $employee->phone,
            $employee->address,
            $employee->category,
            $employee->education_level,
            $employee->hire_date,
            $employee->salary,
            $employee->created_at,
            $employee->updated_at,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text
            1 => ['font' => ['bold' => true]],
            
            // Optional: Style the header row with background color
            'A1:M1' => ['fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['argb' => 'FFD3D3D3']]],
        ];
    }
}