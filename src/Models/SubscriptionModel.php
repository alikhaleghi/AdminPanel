<?php namespace AliKhaleghi\AdminPanel\Models;
use CodeIgniter\Model;
use AliKhaleghi\AdminPanel\Entities\Subscription;

class SubscriptionModel extends Model
{
    protected $returnType =  Subscription::class;

    protected $table = 'AdminPanel_plans_subscribed';
    protected $primaryKey = 'id';

    protected $allowedFields = [ 
        'user_id',
        'track_id',
    ];
    
    protected $validationRules = [ ]; 
}