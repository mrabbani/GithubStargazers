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

Route::get('/', 'StargazerController@index');
Route::get('add-repo', 'StargazerController@addRepo');
Route::post('store-repo', 'StargazerController@storeRepo');


Route::get('collect-email/{id}', function ($repository) {
    $repository = \App\StargazerRepository::find($repository);
    $gitUsers = \App\GithubUserInfo::where('stargazer_repository_id', $repository->id)
        ->whereNull('email')
        ->lists('login');
    foreach ($gitUsers->chunk(10) as $users) {
        dispatch(new \App\Jobs\EmailCollector($users));
    }

    return 'Email Collecting';
});

Route::get('user-info/{id}', function ($repository) {
    $repository = \App\StargazerRepository::find($repository);

    $gitUsers = \App\GithubUser::where('stargazer_repository_id', $repository->id)
        ->take(4000)
        ->lists('login');

    foreach ($gitUsers->chunk(10) as $users) {
        dispatch(new \App\Jobs\GithubUserInfoCollector($users, $repository));
    }

    return 'Information Collecting';
});

Route::get('user-name/{id}', function ($repository) {
    //
    $repository = \App\StargazerRepository::find($repository);
    dispatch(new \App\Jobs\StargazerCollector($repository->name, $repository->token));

    return 'User name Working';
});
