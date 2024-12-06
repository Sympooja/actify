<?php

/**
 * Define your routes and which views to display
 * depending of the query.
 *
 * Based on WordPress conditional tags from the WordPress Codex
 * http://codex.wordpress.org/Conditional_Tags
 *
 */

use Theme\Controllers\PageController;
// flush_rewrite_rules();



Route::get('template', ['demo', 'uses' => 'PageController@demo']);
Route::get('template', ['homepage-test', 'uses' => 'PageController@homepageTest']);
Route::get('template', ['homepage-5c', 'uses' => 'PageController@homepage5c']);
Route::get('template', ['pricing', 'uses' => 'PageController@pricing']);
Route::get('singular', ['format', 'uses' => 'PageController@format']);
Route::get('single', ['uses' => 'PageController@post']);
Route::get('front',    ['default', 'uses' => 'PageController@default']);
Route::get('template', ['legal', 'uses' => 'PageController@legal']);
Route::get('template', ['default', 'uses' => 'PageController@default']);
Route::get('template', ['thankyou', 'uses' => 'PageController@thankyou']);

Route::get('template', ['blog-article', 'uses' => 'PageController@blogArticle']);
Route::get('template', ['blog', 'uses' => 'PageController@blog']);

Route::get('paged',     ['posts', 'uses' => 'PageController@resources']);
Route::get('home',     ['posts', 'uses' => 'PageController@resources']);

Route::get('category',   ['uses' => 'PageController@category']);
Route::get('search',   ['uses' => 'PageController@search']);
Route::get('404',   ['uses' => 'PageController@fourOhFour']);