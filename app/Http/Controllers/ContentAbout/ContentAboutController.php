<?php

namespace App\Http\Controllers\ContentAbout;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ContentAbout\Service\ContentAboutService;
use App\Http\Controllers\ContentAbout\Request\ContentAboutRequest;

class ContentAboutController extends Controller
{
    public function __construct(
        protected readonly ContentAboutService $content_service
    ) {}

    public function addContentAbout(ContentAboutRequest $request): mixed
    {
        try {
            $data = $request->validated();
            $created = $this->content_service->createContentAbout($data);
            return response()->json($created, 201);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    public function getContentAbout(?int $record_id = null): mixed
    {
        try {
            $data = $record_id
                ? $this->content_service->getContentAbout(['id' => $record_id])->first()
                : $this->content_service->getContentAbout([])->get();

            return response()->json($data);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    public function getAllContentAbout(): mixed
    {
        try {
            $data = $this->content_service->getAllContentAbout();
            return response()->json($data);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    public function updateContentAbout(int $record_id, ContentAboutRequest $request): mixed
    {
        try {
            $data = $request->validated();
            $this->content_service->updateContentAbout(['id' => $record_id], $data);
            return true;
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    public function softDeleteContentAbout(int $record_id): mixed
    {
        try {
            $this->content_service->softDeleteContentAbout(['id' => $record_id]);
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
