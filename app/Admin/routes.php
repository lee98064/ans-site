<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('books', BookController::class);
    $router->resource('subjects', SubjectController::class);
    $router->resource('publishers', PublisherController::class);
    $router->resource('files', FileController::class);
    $router->resource('catalogs', CatalogController::class);
});
