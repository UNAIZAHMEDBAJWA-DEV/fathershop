<?php

namespace EmailCampaign;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CampaignManager
{
    public function createCampaign(string $title, string $subject, string $body)
    {
        return DB::table('campaigns')->insertGetId([
            'title' => $title ?? 'null',
            'subject' => $subject ?? 'null',
            'body' => $body ?? 'null',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function filterCustomers(array $filters)
    {
        $query = DB::table('customers');
        
        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['expiry_date'])) {
            $expiryDate = Carbon::now()->addDays($filters['expiry_date']);
            $query->where('plan_expiry_date', '<=', $expiryDate);
        }

        return $query->get();
    }
}
