<?php
if (!function_exists('view_template')) {
    function view_template(string $type, string $section, array $data) {

        switch ($type) {
            case 'maintenance':
                var_dump( scandir(dirname(__FILE__).'/../Views/maintainer/')); 
                include(dirname(__FILE__).'\\..\\Views\\maintainer\\'.$section.'.php');
                break;
            
            default:
                # code...
                break;
        }

    }
}