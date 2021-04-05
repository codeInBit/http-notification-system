<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Jobs\Publish;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\PublisherRequest;
use Symfony\Component\HttpFoundation\Response;

class PublisherController extends Controller
{
    /**
     * Subscribe to a topic
     *
     * @param PublisherRequest $request
     * @return JsonResponse
     */
    public function publish(PublisherRequest $request, $topic): JsonResponse
    {     
        try {   
            $topicObj = Topic::whereSlug(Str::slug($topic))->first();
            if (!$topicObj) {
                return $this->errorResponse([], 'This topic does not exist', Response::HTTP_NOT_FOUND);
            }

            $subscribers = $topicObj->subscribers;

            Publish::dispatch($topic, $subscribers, $request->get('payload'));

            return $this->successResponse([], Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->fatalErrorResponse($e);
        }
    }
}
