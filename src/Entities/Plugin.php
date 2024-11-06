<?php
namespace AliKhaleghi\AdminPanel\Entities;

use AliKhaleghi\Wallet\Models\WalletTransactionModel;
use CodeIgniter\Entity\Entity;
/**
 * Plugin entity
 *
 * 
 * @since V011110
 */
class Plugin extends Entity
{ 

	/**
	 * Define properties that are automatically converted to Time instances.
	 */
	protected $dates = ['created_at', 'updated_at', 'released_at'];

	/**
	 * Array of field names and the type of value to cast them as
	 * when they are accessed.
	 */
	public $casts = [ 
        'files'    => 'json',  
	];
    
    protected $attributes = [
    	'id' => '',
    	'name' => '',
    	'slug' => '',
    	'configuration' => '',
    ];
}