<?php

namespace App\Jobs;

use App\GithubUserInfo;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailCollector extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    private $githubUsers;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users)
    {
        //
        $this->githubUsers = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $client = new \GuzzleHttp\Client(['headers' => ['Authorization' => 'Basic bXJhYmJhbmk6d2VkZXZzMTIz']]);


        foreach($this->githubUsers as $user) {
            $res = $client->request('GET', 'https://api.github.com/users/'.$user.'/events/public');
            $result = json_decode($res->getBody()->getContents(), true);

            $emails = array_map(function ($item) {
                return isset($item['payload']['commits'][0]['author']['email']) ? $item['payload']['commits'][0]['author']['email'] : null;
            }, $result);

            $email = ['email'=> implode(',', array_unique(array_filter($emails)))];
            GithubUserInfo::where('login', $user)->first()->update($email);
           }
    }
}
