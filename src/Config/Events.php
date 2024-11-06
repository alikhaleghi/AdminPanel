<?php
namespace AliKhaleghi\AdminPanel\Config;

use CodeIgniter\Events\Events;

 
use AliKhaleghi\BaseSys\Entities\User;

// --------------------------------------------------------------------

/**
 * On User Requested an update for their plugin
 * 
 * @param User  			$user           User
 * 
 * @return null
 */
Events::on('update_requested', function(
    User $user
) {
    // Deposit money
    
}, Events::PRIORITY_NORMAL);
