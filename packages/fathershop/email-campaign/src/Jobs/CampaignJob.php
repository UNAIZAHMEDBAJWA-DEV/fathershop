<?php
namespace fatherShop\EmailCampaign\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use fatherShop\EmailCampaign\Models\Campaign;
use fatherShop\EmailCampaign\Models\Customer;

class CampaignJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public  $customer;
    public  $campaign;

    public function __construct(Customer $customer, Campaign $campaign)
    {
        $this->customer = $customer;
        $this->campaign = $campaign;
    }

    public function handle()
    {
        if (filter_var($this->customer->email, FILTER_VALIDATE_EMAIL)) {
            Mail::send('emailcampaign::email', [
                'body' => $this->campaign->body,
                'subject' => $this->campaign->subject,
            ], function ($message) {
                $message->to($this->customer->email);
                $message->subject($this->campaign->subject);
            });
        }
    }
}
