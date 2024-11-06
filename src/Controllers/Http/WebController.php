<?php
namespace AliKhaleghi\AdminPanel\Controllers\Http;

use CodeIgniter\Controller;


class WebController extends Controller
{
    
    public function __construct() {
        

    }

    public function maintainer() {
        helper("\AliKhaleghi\AdminPanel\Helpers\admin_template");
        view_template('maintenance', 'health', [

        ]);
    }
}
