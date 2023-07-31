<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatusUpdateNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $users;
    public $statusText;

    public function __construct(User $users)
    {
        $this->users = $users;

        // Tentukan teks status berdasarkan nilai status
        if ($this->users->status === 'Aktif') {
            $this->statusText = 'Aktif';
        } elseif ($this->users->status === 'Pending') {
            $this->statusText = 'Pending';
        } elseif ($this->users->status === 'Nonaktif') {
            $this->statusText = 'Nonaktif';
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Status Akun Anda Telah Diperbarui')
                    ->view('emails.status-update-notification');
    }
}
