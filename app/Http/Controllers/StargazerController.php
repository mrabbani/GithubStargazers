<?php

namespace App\Http\Controllers;

use App\StargazerRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class StargazerController extends Controller
{
    //
    public function index()
    {
        $repositories = StargazerRepository::all();

        return view('welcome', compact('repositories'));
    }

    public function addRepo()
    {
        return view('add_repo');
    }

    public function storeRepo(Requests\RepositoryRequest $request)
    {
        StargazerRepository::create(
            [
                'name' => $request->get('name'),
                'token' => base64_encode($request->get('username') .':' . $request->get('password'))
            ]
        );
        return redirect('/');
    }
}
