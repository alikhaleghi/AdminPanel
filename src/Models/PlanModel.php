<?php namespace AliKhaleghi\AdminPanel\Models;
use CodeIgniter\Model;
use AliKhaleghi\AdminPanel\Entities\Plan;

class PlanModel extends Model
{
    protected $returnType =  Plan::class;

    protected $table = 'AdminPanel_plans';
    protected $primaryKey = 'id';
 

    protected $allowedFields = [   
        'plugin_id',
        'name',
        'description',
        'months',
        'cost',
    ];
    
    protected $validationRules = [ ]; 
}