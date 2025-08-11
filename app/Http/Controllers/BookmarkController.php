<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookmarkController extends Controller
{
    // @desc Get all users bookmarks
    // @route GET /bookmarks
    public function index(): View
    {
        $user = Auth::user();

        $bookmarks = $user->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(9);

        return view('jobs.bookmarked')->with('bookmarks', $bookmarks);
    }
    // @desc created or remove new bookmarked job
    // @route POST /bookmarks/{job}
    public function store(Job $job): RedirectResponse
    {
        $user = Auth::user();

        if ($job->user_id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot bookmark your own job listing');
        }

        // Toggle the bookmark 
        $user->bookmarkedJobs()->toggle($job->id);
        // Check if it was added or removed to set appropriate message 
        $bookmarked = $user->bookmarkedJobs()->where('job_id', $job->id)->exists();
        $message = $bookmarked ? 'Job bookmarked successfully!' : 'Bookmark removed successfully!';
        return back()->with('success', $message);

        /*                 // check if job is already bookmarked
        if ($user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('status', 'Job is already bookmarked');
        } 
                 // create new bookmark
        $user->bookmarkedJobs()->attach($job->id);

        return back()->with('success', 'Job bookmarked successfully!'); */
    }
}
