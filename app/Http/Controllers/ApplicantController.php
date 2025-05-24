<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    // @desc store new job application
    // @route POST /jobs/{job}/apply,

    public function store(Request $request, Job $job): RedirectResponse
    {
        // validate data
        $validatedData = $request->validate([
            'full_name' => 'required|string',
            'contact_phone' => 'string',
            'contact_email' => 'required|string|email',
            'message' => 'string',
            'location' => 'string',
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        // handle resume upload
        if ($request->hasFile('resume')) {
            $path = $request->file('resume')->store('resumes', 'public');
            \Log::info('Resume uploaded, public url: ', [
                'url' => asset('storage/' . $path),
            ]);
            $validatedData['resume_path'] = $path;
        }

        // store the application
        $application = new Applicant($validatedData);
        $application->job_id = $job->id;
        $application->user_id = auth()->id();
        $application->save();

        return redirect()->back()->with('success', 'Your application has been submitted');
    }

    //  @desc delete job applicant
    // @route DELETE /applicants/{applicant}
    public function destroy($id): RedirectResponse
    {
        $applicant = Applicant::findOrFail($id);
        $applicant->delete();

        return redirect()->route('dashboard')->with('success', 'Applicant deleted successfully');
    }
}
