<?php namespace AliKhaleghi\AdminPanel\Models;
use CodeIgniter\Model;
use AliKhaleghi\AdminPanel\Entities\Plugin;

class PluginModel extends Model
{
    protected $returnType =  Plugin::class;

    protected $table = 'AdminPanel_plugins';
    protected $primaryKey = 'id';
 
    protected $useTimestamps   = true;

    protected $allowedFields = [
        'user_id',
        'name',
        'slug',
        'description',
        'files',
        'released_at',
        'created_at',
        'updated_at',
    ];
    
    protected $validationRules = [ ]; 
}