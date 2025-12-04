<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\JobApplication;
use App\Models\InternshipApplication;
use App\Models\Employee;
use App\Models\Qualification;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        // Employee Statistics
        $employeeStats = $this->getEmployeeStatistics();
        
        // Application Statistics
        $applicationStats = $this->getApplicationStatistics();
        
        // Qualification Statistics
        $qualificationStats = $this->getQualificationStatistics();
        
        // Latest Records
        $latestRecords = $this->getLatestRecords();
        
        // Upcoming Qualifications
        $upcomingQualifications = $this->getUpcomingQualifications();

        // Combine all data
        $data = array_merge(
            $employeeStats,
            $applicationStats,
            $qualificationStats,
            $latestRecords,
            $upcomingQualifications
        );

        return view('user.dashboard', $data);
    }

    protected function getEmployeeStatistics()
    {
        $totalEmployeeDirect = Employee::where('category', 'direct')->count();
        $totalEmployeeIndirect = Employee::where('category', 'indirect')->count();
        $totalEmployee = $totalEmployeeDirect + $totalEmployeeIndirect;

        return [
            'totalEmployee' => $totalEmployee,
            'totalEmployeeDirect' => $totalEmployeeDirect,
            'totalEmployeeIndirect' => $totalEmployeeIndirect,
            'percentageDirect' => $totalEmployee > 0 ? round(($totalEmployeeDirect / $totalEmployee) * 100) : 0,
            'percentageIndirect' => $totalEmployee > 0 ? round(($totalEmployeeIndirect / $totalEmployee) * 100) : 0,
        ];
    }

    protected function getApplicationStatistics()
    {
        $totalOfficeApplications = JobApplication::where('position_type', 'office')->count();
        $totalFactoryApplications = JobApplication::where('position_type', 'factory')->count();
        $totalJobApplications = $totalOfficeApplications + $totalFactoryApplications;

        $totalOfficeInternships = InternshipApplication::where('position_type', 'office')->count();
        $totalFactoryInternships = InternshipApplication::where('position_type', 'factory')->count();
        $totalInternshipApplications = $totalOfficeInternships + $totalFactoryInternships;

        return [
            'totalContacts' => Contact::count(),
            'totalJobApplications' => $totalJobApplications,
            'totalOfficeApplications' => $totalOfficeApplications,
            'totalFactoryApplications' => $totalFactoryApplications,
            'totalInternshipApplications' => $totalInternshipApplications,
            'totalOfficeInternships' => $totalOfficeInternships,
            'totalFactoryInternships' => $totalFactoryInternships,
            'applicationRatio' => $this->calculateApplicationRatio($totalJobApplications, $totalInternshipApplications),
            'positionTypeRatio' => $this->calculatePositionTypeRatio(
                $totalOfficeApplications, 
                $totalFactoryApplications, 
                $totalOfficeInternships, 
                $totalFactoryInternships
            )
        ];
    }

    protected function getQualificationStatistics()
    {
        $qualificationTypes = Qualification::select('type')
            ->groupBy('type')
            ->pluck('type');

        $qualificationStats = [];
        foreach ($qualificationTypes as $type) {
            $count = Employee::whereHas('qualifications', function($q) use ($type) {
                $q->where('type', $type);
            })->count();
            
            $qualificationStats[$type] = $count;
        }

        return [
            'qualificationStats' => $qualificationStats,
            'totalQualifications' => Qualification::count(),
        ];
    }

    protected function getLatestRecords()
    {
        return [
            'employees' => Employee::latest()->take(5)->get(),
            'contacts' => Contact::latest()->take(5)->get(),
            'officeApplications' => JobApplication::where('position_type', 'office')->latest()->take(5)->get(),
            'factoryApplications' => JobApplication::where('position_type', 'factory')->latest()->take(5)->get(),
            'officeInternships' => InternshipApplication::where('position_type', 'office')->latest()->take(5)->get(),
            'factoryInternships' => InternshipApplication::where('position_type', 'factory')->latest()->take(5)->get(),
            'latestQualifications' => Qualification::with('employee')
                ->latest()
                ->take(5)
                ->get(),
        ];
    }

    protected function getUpcomingQualifications()
    {
        return [
            'latestQualifications' => Qualification::with('employee')
                ->whereDate('next_qualification_date', '>=', Carbon::today())
                ->orderBy('next_qualification_date')
                ->take(10)
                ->get(),
            'expiredQualifications' => Qualification::with('employee')
                ->whereDate('next_qualification_date', '<', Carbon::today())
                ->orderBy('next_qualification_date')
                ->take(5)
                ->get()
        ];
    }

    public function getEmployeesByQualification(Request $request)
    {
        $type = $request->input('type');
        
        $employees = Employee::whereHas('qualifications', function($q) use ($type) {
            $q->where('type', $type);
        })
        ->with(['qualifications' => function($q) use ($type) {
            $q->where('type', $type)->latest();
        }])
        ->get()
        ->map(function($employee) use ($type) {
            $qualification = $employee->qualifications->first();
            return [
                'full_name' => $employee->full_name,
                'qualification_date' => $qualification->date->format('d/m/Y'),
                'note' => $qualification->note,
                'next_qualification_date' => $qualification->next_qualification_date ? $qualification->next_qualification_date->format('d/m/Y') : null,
                'status' => $qualification->next_qualification_date ? 
                    ($qualification->next_qualification_date->lt(Carbon::today()) ? 'expired' : 'upcoming') : 'unknown'
            ];
        });
        
        return response()->json(['employees' => $employees]);
    }

    protected function calculateApplicationRatio($jobApps, $internshipApps)
    {
        $total = $jobApps + $internshipApps;
        
        return [
            'jobPercentage' => $total > 0 ? round(($jobApps / $total) * 100) : 0,
            'internshipPercentage' => $total > 0 ? round(($internshipApps / $total) * 100) : 0
        ];
    }

    protected function calculatePositionTypeRatio($officeJobs, $factoryJobs, $officeInternships, $factoryInternships)
    {
        $totalOffice = $officeJobs + $officeInternships;
        $totalFactory = $factoryJobs + $factoryInternships;
        $total = $totalOffice + $totalFactory;
        
        return [
            'officePercentage' => $total > 0 ? round(($totalOffice / $total) * 100) : 0,
            'factoryPercentage' => $total > 0 ? round(($totalFactory / $total) * 100) : 0
        ];
    }
}