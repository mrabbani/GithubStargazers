<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGithubUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('github_user_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login');
            $table->string('avatar_url');
            $table->string('gravatar_id');
            $table->string('url');
            $table->string('html_url');
            $table->string('followers_url');
            $table->string('following_url');
            $table->string('gists_url');
            $table->string('starred_url');
            $table->string('subscriptions_url');
            $table->string('organizations_url');
            $table->string('repos_url');
            $table->string('events_url');
            $table->string('received_events_url');
            $table->string('type');
            $table->string('name');
            $table->string('company');
            $table->string('blog');
            $table->string('location');
            $table->string('email');
            $table->string('hireable');
            $table->string('bio');
            $table->string('public_repos');
            $table->string('public_gists');
            $table->string('followers');
            $table->string('following');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('github_user_infos');
    }
}
