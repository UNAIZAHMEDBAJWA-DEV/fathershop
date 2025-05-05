<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use EmailCampaign\CampaignManager;
use EmailCampaign\Jobs\CampaignJob;
 // Correct Request import

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
    $data = $request->validate([
        'filters' => 'array',
    ]);
    $manager = new CampaignManager();
    $customers = $manager->filterCustomers($data['filters'] ?? []);

    foreach ($customers as $customer) {
        CampaignJob::dispatch($customer->email, $customer->subject, $customer->body);
    }

    return response()->json(['status' => 'Emails queued for sending']);
});


Route::get('/send-email-grid', function () {
    return 'successfully send';
    $to = 'unaiz@yopmail.com'; // replace with the recipient's email
    Mail::raw('This is a test email using SendGrid!', function ($message) use ($to) {
        $message->to($to)
                ->subject('Test Email from Laravel using SendGrid');
    });
    return 'Email sent!';
});

