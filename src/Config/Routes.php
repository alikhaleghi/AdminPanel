<?php

namespace AliKhaleghi\AdminPanel\Config;

use CodeIgniter\Router\RouteCollection;
use AliKhaleghi\BaseSys\Config\Api as ApiConfig; 

try {
    
    /** @var ApiConfig $endpointGroups */
    $endpointGroups = service("settings")->get("Api.endpointGroups");

} catch (\Throwable $th) {
    $endpointGroups = [
        'client'    => '/',
        'admin'     => '/administrator'
    ];
}

/** @var RouteCollection $routes */

$routes->get('/maintainer', '\AliKhaleghi\AdminPanel\Controllers\Http\WebController::maintainer');

$routes->group($endpointGroups['client'], [ ], static function ($routes) {

    $routes->group('AdminPanel', [
        'namespace' => 'AliKhaleghi\AdminPanel\Controllers',
    ], static function ($routes) {

        // Plugin Management - Client Side
        $routes->group('plugin', static function ($routes) {
            $routes->add('validate/license', 'AliKhaleghi\AdminPanel\Controllers\Http\ClientController::explore');
            $routes->add('update', 'ClientController::explore');
            $routes->get('plans', 'ClientController::pluginPlans');

        });


        $routes->get('search', 'ClientController::search');


        $routes->group('premium', [
            'namespace' => 'AliKhaleghi\AdminPanel\Controllers',
            // User Only routes
            'filter'    => 'jwt_logged_in'
        ], static function ($routes) {

            $routes->post('like/track', 'ClientController::likeTrack');
            $routes->post('archive/make/zip', 'ClientController::archiveSongs');
        });
    });
});
$routes->group($endpointGroups['admin'], [ ], static function ($routes) {

    $routes->group('AdminPanel', [
        'namespace' => 'AliKhaleghi\AdminPanel\Controllers\Admin',
        // Admin Only routes
        'filter'    => 'jwt_permission:superadmin'
    ], static function ($routes) {
        
        $routes->group('plugin', static function ($routes) {
            $routes->get('list', 'PluginController::list');
            $routes->post('create', 'PluginController::create');
            $routes->post('update', 'PluginController::update');
            $routes->post('delete', 'PluginController::delete');
        });
        
        $routes->group('plan', static function ($routes) {
            $routes->get('list', 'PlanController::list');
            $routes->post('create', 'PlanController::create');
            $routes->post('update', 'PlanController::update');
            $routes->post('delete', 'PlanController::delete');
        });
        
        $routes->group('track', static function ($routes) {
            $routes->get('list', 'TrackController::list');
            $routes->post('create', 'TrackController::create');
            $routes->post('update', 'TrackController::update');
            $routes->post('delete', 'TrackController::delete');
        });
    });
});
 