<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\StargazerRepository;
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
    private  $githubUsers;
    private  $repository;
    public function __construct($users, StargazerRepository $repository)
    {
        //
        $this->githubUsers = $users;
        $this->repository =  $repository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $client = new \GuzzleHttp\Client(['headers' => ['Authorization' => 'Basic ' . $this->repository->token]]);

        foreach ($this->githubUsers as $user) {
            $res = $client->request('GET', 'https://api.github.com/users/' . $user);
            $result = json_decode($res->getBody()->getContents(), true);
            $this->repository->userInfos()->create($result);
        }
    }
}
