<?php

namespace App\Http\Controllers\ContentHowItWorks;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ContentHowItWorks\Service\ContentHowItWorksService;
use App\Http\Controllers\ContentHowItWorks\Request\ContentHowItWorksRequest;

class ContentHowItWorksController extends Controller
{
    public function __construct(
        protected readonly ContentHowItWorksService $content_service
    ) {}

    public function addContentHowItWorks(ContentHowItWorksRequest $request): mixed
    {
        try {
            $data = $request->validated();
            $created = $this->content_service->createContentHowItWorks($data);
            return response()->json($created, 201);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    public function getContentHowItWorks(?int $record_id = null): mixed
    {
        try {
            $data = $record_id
                ? $this->content_service->getContentHowItWorks(['id' => $record_id])->first()
                : $this->content_service->getContentHowItWorks([])->get();

            return response()->json($data);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    public function getAllContentHowItWorks(): mixed
    {
        try {
            $data = $this->content_service->getAllContentHowItWorks();
            return response()->json($data);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    public function updateContentHowItWorks(int $record_id, ContentHowItWorksRequest $request): mixed
    {
        try {
            $data = $request->validated();
            $this->content_service->updateContentHowItWorks(['id' => $record_id], $data);
            return true;
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    public function softDeleteContentHowItWorks(int $record_id): mixed
    {
        try {
            $this->content_service->softDeleteContentHowItWorks(['id' => $record_id]);
            return true;
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    public function getLatestPublished(): mixed
    {
        try {
            $data = $this->content_service->getLatestPublished();
            return response()->json($data);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }
}
