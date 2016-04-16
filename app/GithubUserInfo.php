<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GithubUserInfo extends Model
{
    //
    protected $fillable = [
        'login',
'id',
'avatar_url',
'gravatar_id',
'url',
'html_url',
'followers_url',
'following_url',
'gists_url',
'starred_url',
'subscriptions_url',
'organizations_url',
'repos_url',
'events_url',
'received_events_url',
'type',
'name',
'company',
'blog',
'location',
'email',
'hireable',
'bio',
'public_repos',
'public_gists',
'followers',
'following',
    ];
}
