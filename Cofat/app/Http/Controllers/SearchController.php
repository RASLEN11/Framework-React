<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = strtolower(trim($request->input('query')));
        
        // Define keyword to view mappings
        $keywordMap = [
            'career' => 'pages.careers',
            'job' => 'pages.careers',
            'work' => 'pages.careers',
            'employment' => 'pages.careers',
            'hiring' => 'pages.careers',
            'contact' => 'pages.contact',
            'email' => 'pages.contact',
            'message' => 'pages.contact',
            'location' => 'pages.locations',
            'map' => 'pages.locations',
            'address' => 'pages.locations',
            'about' => 'pages.about',
            'company' => 'pages.about',
            'stat' => 'pages.stats',
            'dashboard' => 'pages.stats',
            'metrics' => 'pages.stats',
            'home' => 'pages.home',
            'main' => 'pages.home',
            'apply' => 'pages.apply.index',
            'application' => 'pages.apply.index',
            'internship' => 'pages.apply.internship',
            'training' => 'pages.apply.internship'
        ];
        
        // Check if query matches any keyword
        foreach ($keywordMap as $keyword => $view) {
            if (str_contains($query, $keyword)) {
                return view($view);
            }
        }
        
  
    }
    

}