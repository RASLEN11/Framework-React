<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\InternshipApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    // Common Methods
    protected function getApplicationCounts()
    {
        return [
            'jobCount' => JobApplication::count(),
            'internshipCount' => InternshipApplication::count(),
            'pendingJobCount' => JobApplication::where('status', 'pending')->count(),
            'pendingInternshipCount' => InternshipApplication::where('status', 'pending')->count(),
        ];
    }

    protected function storeFile($file, $directory)
    {
        $fileName = Str::random(20) . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($directory, $fileName, 'public');
        return $path;
    }

    // Dashboard
    public function dashboard(Request $request)
    {
        $counts = $this->getApplicationCounts();
        
        $jobQuery = JobApplication::query();
        $internshipQuery = InternshipApplication::query();

        // Apply filters if present
        if ($request->has('job_status')) {
            $jobQuery->where('status', $request->job_status);
        }

        if ($request->has('internship_status')) {
            $internshipQuery->where('status', $request->internship_status);
        }

        return view('admin.apply.index', array_merge($counts, [
            'jobApplications' => $jobQuery->orderBy('created_at', 'desc')->paginate(10, ['*'], 'job_page'),
            'internshipApplications' => $internshipQuery->orderBy('created_at', 'desc')->paginate(10, ['*'], 'internship_page'),
            'filters' => $request->only(['job_status', 'internship_status'])
        ]));
    }

    // Job Application Methods
    public function showJobApplicationForm()
    {
        return view('pages.apply.jobapply');
    }

    public function jobIndex(Request $request)
{
    $query = JobApplication::query();

    if ($request->has('search')) {
        $query->where(function($q) use ($request) {
            $q->where('first_name', 'like', '%'.$request->search.'%')
              ->orWhere('last_name', 'like', '%'.$request->search.'%')
              ->orWhere('email', 'like', '%'.$request->search.'%');
        });
    }

    if ($request->has('status')) {
        $query->where('status', $request->status);
    }

    return view('admin.apply.index', [
        'jobApplications' => $query->latest()->paginate(10, ['*'], 'job_page'),
        'internshipApplications' => InternshipApplication::latest()->paginate(10, ['*'], 'internship_page'), // Add this
        'search' => $request->search,
        'statusFilter' => $request->status,
        'jobCount' => JobApplication::count(),
        'internshipCount' => InternshipApplication::count(),
        'pendingJobCount' => JobApplication::where('status', 'pending')->count(),
        'pendingInternshipCount' => InternshipApplication::where('status', 'pending')->count(),
    ]);
}

    public function jobShow(JobApplication $application)
    {
        return view('admin.apply.job', ['application' => $application]);
    }

    public function jobEdit(JobApplication $application)
    {
        return view('admin.apply.job', ['application' => $application]);
    }

    public function jobUpdate(Request $request, JobApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected',
            'position_type' => 'required|in:office,factory',
        ]);

     
        $application->update($validated);

        return redirect()->route('admin.applications.job.index')
            ->with('success', 'Job application updated successfully!');
    }

    public function jobDestroy(JobApplication $application)
    {
        Storage::delete($application->cv_path);
        $application->delete();

        return redirect()->route('admin.applications.job.index')
            ->with('success', 'Job application deleted successfully!');
    }

    public function downloadJobCv(JobApplication $application)
    {
        return Storage::download($application->cv_path);
    }

    // Internship Application Methods
    public function showInternshipApplicationForm()
    {
        return view('pages.apply.internship');
    }

    public function internshipIndex(Request $request)
{
    $query = InternshipApplication::query();

    if ($request->has('search')) {
        $query->where(function($q) use ($request) {
            $q->where('first_name', 'like', '%'.$request->search.'%')
              ->orWhere('last_name', 'like', '%'.$request->search.'%')
              ->orWhere('email', 'like', '%'.$request->search.'%');
        });
    }

    if ($request->has('status')) {
        $query->where('status', $request->status);
    }

    return view('admin.apply.index', [
        'internshipApplications' => $query->latest()->paginate(10, ['*'], 'internship_page'),
        'jobApplications' => JobApplication::latest()->paginate(10, ['*'], 'job_page'), // Add this
        'search' => $request->search,
        'statusFilter' => $request->status,
        'jobCount' => JobApplication::count(),
        'internshipCount' => InternshipApplication::count(),
        'pendingJobCount' => JobApplication::where('status', 'pending')->count(),
        'pendingInternshipCount' => InternshipApplication::where('status', 'pending')->count(),
    ]);
}

    public function internshipShow(InternshipApplication $application)
    {
        return view('admin.apply.internship', ['application' => $application]);
    }

    public function internshipEdit(InternshipApplication $application)
    {
        return view('admin.apply.internship', ['application' => $application]);
    }

    public function internshipUpdate(Request $request, InternshipApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected',
            'position_type' => 'required|in:office,factory',
        ]);

        $application->update($validated);

        return redirect()->route('admin.applications.internship.index')
            ->with('success', 'Internship application updated successfully!');
    }

    public function internshipDestroy(InternshipApplication $application)
    {
        Storage::delete($application->cv_path);
        $application->delete();

        return redirect()->route('admin.applications.internship.index')
            ->with('success', 'Internship application deleted successfully!');
    }

    public function downloadInternshipCv(InternshipApplication $application)
    {
        return Storage::download($application->cv_path);
    }

    // Application Submission
    public function submitApplication(Request $request)
    {
        $applicationType = $request->input('application_type');
        
        if ($applicationType === 'internship') {
            return $this->processInternshipApplication($request);
        } else {
            return $this->processJobApplication($request);
        }
    }

    protected function processJobApplication(Request $request)
    {
        $validated = $request->validate([
            'cin' => 'required|string|max:20',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:18|max:65',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'education_level' => 'required|in:primary,secondary,high_school,bachelor,master,phd',
            'position' => 'required|string|max:255',
            'cv' => 'required|file|mimes:pdf|max:5120',
            'cover_letter' => 'nullable|string',
            'terms' => 'accepted',
        ]);

        $cvPath = $this->storeFile($request->file('cv'), 'job_applications/cvs');

        JobApplication::create([
            'position_type' => $request->input('position_type', 'office'),
            'cin' => $validated['cin'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'age' => $validated['age'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'education_level' => $validated['education_level'],
            'position' => $validated['position'],
            'cv_path' => $cvPath,
            'cover_letter' => $validated['cover_letter'] ?? null,
            'terms_accepted' => true,
            'status' => 'pending',
        ]);

        return redirect()->back()
            ->with('success', 'Your job application has been submitted successfully!');
    }

    protected function processInternshipApplication(Request $request)
    {
        $validated = $request->validate([
            'cin' => 'required|string|max:20',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:16|max:30',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'education_level' => 'required|in:high_school,vocational,bachelor,master',
            'school' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'duration' => 'required|in:4,6,8,12',
            'cv' => 'required|file|mimes:pdf|max:5120',
            'cover_letter' => 'nullable|string',
            'terms' => 'accepted',
        ]);

        $cvPath = $this->storeFile($request->file('cv'), 'internship_applications/cvs');

        InternshipApplication::create([
            'position_type' => $request->input('position_type', 'office'),
            'cin' => $validated['cin'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'age' => $validated['age'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'education_level' => $validated['education_level'],
            'school' => $validated['school'],
            'field_of_study' => $validated['field_of_study'],
            'duration' => $validated['duration'],
            'cv_path' => $cvPath,
            'cover_letter' => $validated['cover_letter'] ?? null,
            'terms_accepted' => true,
            'status' => 'pending',
        ]);

        return redirect()->back()
            ->with('success', 'Your internship application has been submitted successfully!');
    }
}


