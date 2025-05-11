<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use fatherShop\EmailCampaign\CampaignManager;
use fatherShop\EmailCampaign\Jobs\CampaignJob;
use fatherShop\EmailCampaign\Models\Campaign;

Route::post('/create-campaign', function (Request $request) {
    try {
        $data = $request->validate([
            'title' => 'required|string',
            'subject' => 'required|string',
            'body' => 'required|string',
        ]);
        $manager = new CampaignManager();
        $campaignId = $manager->createCampaign($data['title'], $data['subject'], $data['body']);
        return response()->json(['status' => 'Campaign created', 'id' => $campaignId]);
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('Error creating campaign: ' . $e->getMessage());
        \Log::error($e->getTraceAsString()); // Logs the stack trace
        return response()->json(['error' => 'Something went wrong, please try again later.'], 500);
    }
});


Route::post('/send-campaign/{campaignId}', function ($campaignId, Request $request) {
    try {
        Log::info('Request received for campaign sending', [
            'campaignId' => $campaignId,
            'filters' => $request->all(),
        ]);

        $data = $request->validate([
            'filters' => 'array',
        ]);

        $manager = new CampaignManager();
        $customers = $manager->filterCustomers($data['filters'] ?? []);
        Log::info('Customers filtered successfully', ['customerCount' => count($customers)]);

        $campaign = Campaign::findOrFail($campaignId);

        foreach ($customers as $customer) {
            CampaignJob::dispatch($customer->email, $campaign->subject, $campaign->body);
        }

        return response()->json(['status' => 'Emails queued for sending']);

    } catch (\Throwable $th) {
        Log::error('Error in sending campaign emails', [
            'campaignId' => $campaignId,
            'errorMessage' => $th->getMessage(),
            'errorTrace' => $th->getTraceAsString()
        ]);

        return response()->json(['error' => 'Failed to send campaign'], 500);
    }
});

Route::get('/send-email-grid', function () {
    $to = 'unaiz@yopmail.com'; // replace with the recipient's email
    Mail::raw('This is a test email using SendGrid!', function ($message) use ($to) {
        $message->to($to)
                ->subject('Test Email from Laravel using SendGrid');
    });
    return 'Email sent!';
});




