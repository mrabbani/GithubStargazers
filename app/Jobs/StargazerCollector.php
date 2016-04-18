<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\StargazerRepository;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StargazerCollector extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $repository;
    private $token;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($repo, $token)
    {
        //
        $this->repository = $repo;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $client = new \GuzzleHttp\Client(['headers' => ['Authorization' => 'Basic ' . $this->token]]);
        $page = 1;
        while ($page < 2) {
            $res = $client->request('GET', 'https://api.github.com/repos/' . $this->repository . '/stargazers?page=' . $page . '&per_page=100', []);
            $result = json_decode($res->getBody()->getContents(), true);
            if(count($result)<1) {
                break;
            }
            StargazerRepository::where('name', $this->repository)
                ->first()
                ->githubUsers()
                ->createMany($result);
            $page++;
        }

    }
}
