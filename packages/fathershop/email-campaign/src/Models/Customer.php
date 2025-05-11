<?php
namespace fatherShop\EmailCampaign\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers'; // or your actual table name
    protected $guarded = []; // or use fillable if needed
}
