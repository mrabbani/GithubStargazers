<?php

namespace App\Jobs;

use App\Jobs\Job;
use GuzzleHttp\Client;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GithubUserInfoCollector extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $client = new Client();
        $page  = 1;
        $totalUsers = 0;
        while($totalUsers>7270) {
            $res = $client->request('GET', 'https://api.github.com/repos/WordPress/WordPress/stargazers?page=' . $page, ['page=3']);

            $result = json_decode( $res->getBody()->getContents(), true);
            \App\User::find(1)->githubUsers()->createMany($result);
            $totalUsers += count($result);
            $page++;
        }
        $this->release();
    }
}