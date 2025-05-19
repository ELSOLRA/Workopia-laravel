<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get test user
        $testUser = User::where('email', 'test@test.com')->firstOrFail();
        // get random job IDs directly
        $jobIds = Job::inRandomOrder()->limit(3)->pluck('id')->toArray();
        // attach the jobs
        $testUser->bookmarkedJobs()->attach($jobIds);

        /* 
        // --- Other solution ---
        // get all job ids
        $jobIds = Job::pluck('id')->toArray();

        // randomly select jobs to bookmark; returns indexes/keys
        $randomJobIds = array_rand($jobIds, 3);

        // attach the selected jobs as bookmarks for the test user 
        foreach ($randomJobIds as $jobId) {
            $testUser->bookmarkedJobs()->attach($jobIds[$jobId]);
        } */
    }
}
