<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StargazerRepository extends Model
{
    //
    protected $fillable = ['name', 'token'];

    public function githubUsers() {
        return $this->hasMany(GithubUser::class);
    }
    public function userInfos()
    {
        return $this->hasMany(GithubUserInfo::class);
    }
}
