<?php

/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Http\Middleware\CsrfProtectionMiddleware;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
$routes->setRouteClass(DashedRoute::class);

$routes->setExtensions(['json']);

$routes->scope('/', function (RouteBuilder $builder) {
    // Register scoped middleware for in scopes.
    $builder->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httponly' => true
    ]));

    /**
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered via `Application::routes()` with `registerMiddleware()`
     */
    $builder->applyMiddleware('csrf');

    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $builder->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $builder->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     *  Connecting existing 3.x routes to 4.x syntax
     *  These routes should stay working to match the API documentation 
     *  and to keep compatiblity with projects that used these url's in the past. (Hackaton)
     */
    $builder->connect(
        '/course_duration_units/index',
        ['controller' => 'CourseDurationUnits', 'action' => 'index'],
    );
    $builder->connect(
        '/course_duration_units/view/{id}',
        ['controller' => 'CourseDurationUnits', 'action' => 'view'],
    )
        ->setPatterns(['id' => '\d+'])
        ->setPass(['id']);

    $builder->connect(
        '/deletion_reasons/index',
        ['controller' => 'DeleteReasons', 'action' => 'index'],
    );
    $builder->connect(
        '/deletion_reasons/view/{id}',
        ['controller' => 'DeleteReasons', 'action' => 'view'],
    )
        ->setPatterns(['id' => '\d+'])
        ->setPass(['id']);

    $builder->connect(
        '/course_types/index',
        ['controller' => 'CourseTypes', 'action' => 'index'],
    );
    $builder->connect(
        '/course_types/view/{id}',
        ['controller' => 'CourseTypes', 'action' => 'view'],
    )
        ->setPatterns(['id' => '\d+'])
        ->setPass(['id']);

    $builder->connect(
        '/course_parent_types/index',
        ['controller' => 'CourseParentTypes', 'action' => 'index'],
    );
    $builder->connect(
        '/course_parent_types/view/{id}',
        ['controller' => 'CourseParentTypes', 'action' => 'view'],
    )
        ->setPatterns(['id' => '\d+'])
        ->setPass(['id']);

    $builder->connect(
        '/tadirah_objects/index',
        ['controller' => 'TadirahObjects', 'action' => 'index'],
    );
    $builder->connect(
        '/tadirah_objects/view/{id}',
        ['controller' => 'TadirahObjects', 'action' => 'view'],
    )
        ->setPatterns(['id' => '\d+'])
        ->setPass(['id']);

    $builder->connect(
        '/tadirah_techniques/index',
        ['controller' => 'TadirahTechniques', 'action' => 'index'],
    );
    $builder->connect(
        '/tadirah_techniques/view/{id}',
        ['controller' => 'TadirahTechniques', 'action' => 'view'],
    )
        ->setPatterns(['id' => '\d+'])
        ->setPass(['id']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *
     * ```
     * $routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);
     * $routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);
     * ```
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $builder->fallbacks();
});

/**
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * Router::scope('/api', function (RouteBuilder $routes) {
 *     // No $routes->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */
