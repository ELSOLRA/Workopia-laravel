<?php

namespace App\Http\Controllers;

use App\Mail\JobApplied;
use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    // @desc store new job application
    // @route POST /jobs/{job}/apply,

    public function store(Request $request, Job $job): RedirectResponse
    {
        // prevents users from applying to their own jobs
        if ($job->user_id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot apply to your own job listing');
        }
        // check if the user has already applied
        $existingApplication = Applicant::where('job_id', $job->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied to this job');
        }

        if (!$job->canAcceptApplications()) {
            return redirect()->back()->with('error', "This job has reached the maximum number of applications ({$job->application_limit})");
        }

        // validate data
        $validatedData = $request->validate([
            'full_name' => 'required|string',
            'contact_phone' => 'string',
            'contact_email' => 'required|string|email',
            'message' => 'string',
            'location' => 'string',
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        try {
            DB::transaction(function () use ($validatedData, $request, $job) {

                // lock to prevent race conditions
                $applicants = Applicant::where('job_id', $job->id)->lockForUpdate()->get();
                $applicationCount = $applicants->count();

                if ($applicationCount >= $job->application_limit) {
                    throw new \Exception("This job has reached the maximum number of applications ({$job->application_limit})");
                }

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

                // send email to owner
                Mail::to($job->user->email)->send(new JobApplied($application, $job));
            });

            return redirect()->back()->with('success', 'Your application has been submitted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
