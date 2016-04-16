<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StargazerCollector extends Job implements ShouldQueue
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

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://api.github.com/user', [
            'auth' => ['mrabbani', 'wedevs123']
        ]);
        return $res->getBody();
        $page  = 1;
        $totalUsers = 0;

            $res = $client->request('GET', 'https://api.github.com/repos/WordPress/WordPress/stargazers?page=' . $page . '&per_page=1000', ['mrabbani', 'wedevs123']);
            $result = json_decode( $res->getBody()->getContents(), true);
            \App\User::find(1)->githubUsers()->createMany($result);
            $totalUsers += count($result);
            $page++;
    }
}
