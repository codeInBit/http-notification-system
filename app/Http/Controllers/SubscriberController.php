<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\SubscriberRequest;
use Symfony\Component\HttpFoundation\Response;

class SubscriberController extends Controller
{
    /**
     * Subscribe to a topic
     *
     * @param SubscriberRequest $request
     * @return JsonResponse
     */
    public function subscribe(SubscriberRequest $request, $topic): JsonResponse
    {
        $newTopic = Topic::firstOrCreate(
            ['slug' =>  Str::slug($topic)],
            ['topic' => $topic]
        );

        $subscription = $newTopic->subscribers()->whereUrl($request->get('url'))->first();
        if ($subscription) {
            return $this->errorResponse([], 'You are already subscribed to this topic', Response::HTTP_OK);
        }

        $newTopic->subscribers()->create([
            'url' => $request->get('url')
        ]);

        $response = [
            "url" => $request->get('url'),
            "topic" => $topic
        ];

        return $this->successResponse($response, Response::HTTP_CREATED);
    }
}
