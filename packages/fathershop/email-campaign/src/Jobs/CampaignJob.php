<?php


namespace fatherShop\EmailCampaign\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CampaignJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email, $subject, $body;

    public function __construct($email, $subject, $body)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->body = $body;
    }

    public function handle()
    {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            Mail::send('emailcampaign::email', [
                'body' => $campaign->body,
                'subject' => $campaign->subject,
            ], function ($message) use ($customer, $campaign) {
                $message->to($customer->email);
                $message->subject($campaign->subject);
            });
            
        }
        
    }
}
