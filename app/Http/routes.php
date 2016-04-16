<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('github', function() {

//    dispatch(new \App\Jobs\StargazerCollector());
    $client = new \GuzzleHttp\Client();
    $res = $client->request('GET', 'https://api.github.com/user', [
        'auth' => ['mrabbani', 'wedevs123']
    ]);
    $page  = 1;
    $totalUsers = 0;

    $res = $client->request('GET', 'https://api.github.com/repos/WordPress/WordPress/stargazers?page=' . $page . '&per_page=1000', ['page=3']);

    $result = json_decode( $res->getBody()->getContents(), true);
    \App\User::find(1)->githubUsers()->createMany($result);
    $totalUsers += count($result);
    $page++;
    return 'working';
});