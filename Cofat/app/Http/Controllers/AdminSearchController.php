<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\InternshipApplication;
use App\Models\Message;
use App\Models\Contact;
use App\Models\Employee;

class AdminSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        
        if (empty($query)) {
            return redirect()->back()->with('error', 'Please enter a search term');
        }
        
        // Search across different models
        $jobResults = JobApplication::where('first_name', 'like', "%$query%")
            ->orWhere('last_name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->orWhere('position', 'like', "%$query%")
            ->get();
            
        $internshipResults = InternshipApplication::where('first_name', 'like', "%$query%")
            ->orWhere('last_name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->orWhere('position_type', 'like', "%$query%")
            ->get();
            
        $messageResults = Message::whereHas('user', function($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                  ->orWhere('email', 'like', "%$query%");
            })
            ->orWhere('message', 'like', "%$query%")
            ->get();
            
        $contactResults = Contact::where('name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->orWhere('message', 'like', "%$query%")
            ->get();
            
        // Add employee search
        $employeeResults = Employee::where('full_name', 'like', "%$query%")
            ->orWhere('cin', 'like', "%$query%")
            ->orWhere('phone_number', 'like', "%$query%")
            ->orWhere('education_level', 'like', "%$query%")
            ->orWhere('category', 'like', "%$query%")
            ->get();
            
        return view('search.results', compact(
            'query',
            'jobResults',
            'internshipResults',
            'messageResults',
            'contactResults',
            'employeeResults'
        ));
    }
}