<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant;
    public $listing;
    public $cvPath;

    public function __construct($applicant, $listing, $cvPath = null)
    {
        $this->applicant = $applicant;
        $this->listing = $listing;
        $this->cvPath = $cvPath;
    }

    public function build()
    {
        $email = $this->subject('New Job Application for: ' . $this->listing->title)
            ->view('emails.job-application')
            ->with([
                'applicant' => $this->applicant,
                'listing' => $this->listing,
            ])
            ->replyTo($this->applicant['email'], $this->applicant['name']);

        if ($this->cvPath) {
            $email->attachFromStorageDisk('local', $this->cvPath);
        }

        return $email;
    }
}
