<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovalNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     use SerializesModels;

    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function build()
    {
        $statusText = $this->status === 'approve' ? 'Approved' : 'Rejected';
        return $this->view('emails.approval_notification')
                    ->subject("Your verification request has been {$statusText}")
                    ->with([
                        'status' => $this->status,
                    ]);
    }




}
