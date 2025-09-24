<?php

namespace App\Http\Controllers\ContentIndex;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ContentIndex\Service\ContentIndexService;
use App\Http\Controllers\ContentIndex\Request\ContentIndexRequest;

class ContentIndexController extends Controller
{
    public function __construct(
        protected readonly ContentIndexService $content_service
    ) {}

    /**
     * Create a new homepage content version
     */
    public function addContentIndex(ContentIndexRequest $request): mixed
    {
        try {
            $data = $request->validated();
            $created = $this->content_service->createContentIndex($data);
            return response()->json($created, 201);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    /**
     * Get specific or list of content
     */
    public function getContentIndex(?int $record_id = null): mixed
    {
        try {
            $data = $record_id
                ? $this->content_service->getContentIndex(['id' => $record_id])->first()
                : $this->content_service->getContentIndex([])->get();

            return response()->json($data);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    /**
     * Get all content (no filters)
     */
    public function getAllContentIndex(): mixed
    {
        try {
            $data = $this->content_service->getAllContentIndexes();
            return response()->json($data);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    /**
     * Update content by id
     */
    public function updateContentIndex(int $record_id, ContentIndexRequest $request): mixed
    {
        try {
            $data = $request->validated();
            $this->content_service->updateContentIndex(['id' => $record_id], $data);
            return true;
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    /**
     * Soft delete content by id
     */
    public function softDeleteContentIndex(int $record_id): mixed
    {
        try {
            $this->content_service->softDeleteContentIndex(['id' => $record_id]);
            return true;
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    /**
     * Public endpoint: get latest published content
     */
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
