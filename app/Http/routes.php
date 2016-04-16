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
    //
    $client = new \GuzzleHttp\Client(['headers' => ['Authorization' => 'Basic bXJhYmJhbmk6d2VkZXZzMTIz']]);

    $page = 70;
    $totalUsers = 0;
    while ($page < 74) {
        $res = $client->request('GET', 'https://api.github.com/repos/WordPress/WordPress/stargazers?per_page=100&page=' . $page);
        $result = json_decode($res->getBody()->getContents(), true);
        \App\User::find(1)->githubUsers()->createMany($result);
        $totalUsers += count($result);
        $page++;
    }

    return $page;
});