<?php

namespace fatherShop\EmailCampaign;
use fatherShop\EmailCampaign\Models\Customer;

use Illuminate\Support\Facades\DB;

class CampaignManager
{
    // Store Campaign
    public function createCampaign($title, $subject, $body)
    {
        // Store the campaign in the database
        $campaign = DB::table('campaigns')->insertGetId([
            'title' => $title,
            'subject' => $subject,
            'body' => $body,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $campaign;
    }

    // Filter Customers based on certain criteria (status, expiry date)

    public function filterCustomers($filters)
    {
        $query = Customer::query(); // ✅ Fix: use `query()` to get a builder instance
    
        // Filter based on status
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }
    
        // Filter based on plan expiry
        if (isset($filters['plan_expiry_date'])) {
            $query->where('plan_expiry_date', '<=', now()->addDays($filters['plan_expiry_date']));
        }
    
        return $query->get(); // ✅ Will now return a Collection of Customer models
    }
    
}
