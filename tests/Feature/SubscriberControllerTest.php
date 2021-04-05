<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class SubscriberControllerTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function testSubscribeToNewTopic()
    {
        $this->withExceptionHandling();
        $topic = 
        $response = $this->post('/api/subscribe/topic' .Str::random(3), [
            "url" => "https://subscriber.site/09742acc-754e-41b8-922a-7300663604d3"
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                "url",
                "topic"
            ]);
    }

    /**
     *
     * @return void
     */
    public function testSubscribeToATopicMultipleTime()
    {
        $this->withExceptionHandling();

        $response = $this->post('/api/subscribe/topic1', [
            "url" => "https://subscriber.site/09742acc-754e-41b8-922a-7300663604d3"
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                "data",
                "message"
            ]);
    }
}
