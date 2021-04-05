<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class Publish implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $topic;
    protected $subscribers;
    protected $payload;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($topic, $subscribers, $payload)
    {
        $this->topic = $topic;
        $this->subscribers = $subscribers;
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->subscribers as $subscriber) {
            Http::post($subscriber->url, [
                "topic" => $this->topic,
                "data" => $this->payload
            ]);
        }
    }
}
