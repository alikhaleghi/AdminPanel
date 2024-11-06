<?php
namespace AliKhaleghi\AdminPanel\Controllers\Client;

use CodeIgniter\Controller;

use CodeIgniter\API\ResponseTrait;

class WebController extends Controller
{
	use ResponseTrait; 

    public function __construct() { }
    
    // -------------------------------------------------------------

    /**
     * Like a Track
     * 
     * @method POST
     * 
     * @return (Response)
     */
    public function likeTrack() {
        
 
        $records = [];
        // Done.
        return $this->respond([
            'data' => $records
        ], 200);
    
    } 
}
