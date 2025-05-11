<?php

namespace fatherShop\EmailCampaign\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaigns';

    protected $fillable = ['title', 'subject', 'body'];
}
