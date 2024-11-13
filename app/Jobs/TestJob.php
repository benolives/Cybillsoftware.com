<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        // No parameters for this test job
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Send a test email
        $details = [
            'title' => 'Test Email from Laravel Queue',
            'body' => 'This is a test email sent from a queued job.'
        ];

        Mail::to('clintonmutinda133@gmail.com')->send(new TestEmail($details));

        \Log::info('Test job executed and email sent!');
    }
}