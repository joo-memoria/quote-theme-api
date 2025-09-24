<?php

namespace App\Http\Controllers\ContentIndex\Service;

use App\Http\Controllers\Controller;
use App\Models\ContentIndex;
use App\Repository\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContentIndexService extends Controller
{
    public function __construct(
        protected readonly BaseRepository $base_repo
    ) {}

    /**
     * Create a new ContentIndex record.
     */
    public function createContentIndex(?array $data): mixed
    {
        try {
            DB::beginTransaction();

            // Auto-bump version if not provided
            if (!isset($data['version'])) {
                $latestVersion = ContentIndex::max('version') ?? 0;
                $data['version'] = $latestVersion + 1;
            }

            // Track creator when available
            $data['created_by'] = Auth::id();

            $created = $this->base_repo->create($data, ContentIndex::class);
            DB::commit();
            return $created;
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->throwError($e);
        }
    }

    /**
     * Get a query builder filtered by where conditions.
     */
    public function getContentIndex(?array $where): mixed
    {
        try {
            return $this->base_repo->get($where, ContentIndex::class);
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    /**
     * Get all ContentIndex records.
     */
    public function getAllContentIndexes(): mixed
    {
        try {
            $table = (new ContentIndex)->getTable();

            $latestPerUrl = ContentIndex::selectRaw("COALESCE(url, '/') AS url_key, MAX(version) AS max_version")
                ->groupBy('url_key');

            $rows = ContentIndex::from("$table as ci")
                ->select('ci.*')
                ->joinSub($latestPerUrl, 'lp', function ($join) {
                    $join->on(DB::raw("COALESCE(ci.url, '/')"), '=', 'lp.url_key')
                         ->on('ci.version', '=', 'lp.max_version');
                })
                ->orderBy('lp.url_key')
                ->get();

            return $rows;
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }

    /**
     * Update ContentIndex records by where clause.
     */
    public function updateContentIndex(?array $where, ?array $data): mixed
    {
        try {
            DB::beginTransaction();
            $this->base_repo->update($where, $data, ContentIndex::class);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->throwError($e);
        }
    }

    /**
     * Soft delete ContentIndex records.
     */
    public function softDeleteContentIndex(?array $where): mixed
    {
        try {
            DB::beginTransaction();
            $this->base_repo->softDelete($where, ContentIndex::class);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->throwError($e);
        }
    }

    /**
     * Get the latest published ContentIndex record globally.
     */
    public function getLatestPublished(): mixed
    {
        try {
            return ContentIndex::published()->latest()->first();
        } catch (\Exception $e) {
            return $this->throwError($e);
        }
    }
}
