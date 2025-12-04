<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\JobApplication;
use App\Models\InternshipApplication;
use App\Models\Employee;
use App\Models\Qualification;
use App\Models\Message;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DashboardController extends Controller
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

        // Message Statistics
        $messageStats = $this->getMessageStatistics();

        // Qualification Calendar (3 months)
        $qualificationCalendar = $this->getQualificationCalendar();

        // Combine all data
        $data = array_merge(
            $employeeStats,
            $applicationStats,
            $qualificationStats,
            $latestRecords,
            $upcomingQualifications,
            $messageStats,
            ['qualificationCalendar' => $qualificationCalendar]
        );

        return view('admin.dashboard', $data);
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
        $currentYear = Carbon::now()->year;
        
        $totalOfficeApplications = JobApplication::where('position_type', 'office')->count();
        $totalFactoryApplications = JobApplication::where('position_type', 'factory')->count();
        $totalJobApplications = $totalOfficeApplications + $totalFactoryApplications;

        $totalOfficeInternships = InternshipApplication::where('position_type', 'office')->count();
        $totalFactoryInternships = InternshipApplication::where('position_type', 'factory')->count();
        $totalInternshipApplications = $totalOfficeInternships + $totalFactoryInternships;

        // Yearly stats
        $jobAppsThisYear = JobApplication::whereYear('created_at', $currentYear)->count();
        $internshipAppsThisYear = InternshipApplication::whereYear('created_at', $currentYear)->count();

        return [
            'totalContacts' => Contact::count(),
            'totalJobApplications' => $totalJobApplications,
            'totalOfficeApplications' => $totalOfficeApplications,
            'totalFactoryApplications' => $totalFactoryApplications,
            'totalInternshipApplications' => $totalInternshipApplications,
            'totalOfficeInternships' => $totalOfficeInternships,
            'totalFactoryInternships' => $totalFactoryInternships,
            'jobAppsThisYear' => $jobAppsThisYear,
            'internshipAppsThisYear' => $internshipAppsThisYear,
            'currentYear' => $currentYear,
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
        $upcoming = Qualification::with('employee')
            ->whereDate('next_qualification_date', '>=', Carbon::today())
            ->orderBy('next_qualification_date')
            ->take(10)
            ->get();

        $expired = Qualification::with('employee')
            ->whereDate('next_qualification_date', '<', Carbon::today())
            ->orderBy('next_qualification_date')
            ->take(5)
            ->get();

        return [
            'upcomingQualifications' => $upcoming,
            'expiredQualifications' => $expired,
            'expiredCount' => $expired->count()
        ];
    }

    protected function getMessageStatistics()
    {
        return [
            'totalMessages' => Message::count(),
            'unreadMessages' => Message::where('is_replied', false)->count(),
            'latestMessages' => Message::with('user')
                ->latest()
                ->take(5)
                ->get(),
        ];
    }

    protected function getQualificationCalendar()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth()->addMonths(2);
        
        return Qualification::with('employee')
            ->whereBetween('next_qualification_date', [$startDate, $endDate])
            ->orderBy('next_qualification_date')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->next_qualification_date)->format('Y-m-d');
            });
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
            $status = 'unknown';
            
            if ($qualification->next_qualification_date) {
                $status = $qualification->next_qualification_date->lt(Carbon::today()) ? 'expired' : 'upcoming';
            }
            
            return [
                'full_name' => $employee->full_name,
                'qualification_date' => $qualification->date->format('d/m/Y'),
                'note' => $qualification->note,
                'next_qualification_date' => $qualification->next_qualification_date ? $qualification->next_qualification_date->format('d/m/Y') : null,
                'status' => $status
            ];
        });
        
        return response()->json(['employees' => $employees]);
    }

    public function getDayQualifications(Request $request)
    {
        $date = $request->input('date');
        $qualifications = Qualification::with('employee')
            ->whereDate('next_qualification_date', $date)
            ->get();
            
        return response()->json(['qualifications' => $qualifications]);
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