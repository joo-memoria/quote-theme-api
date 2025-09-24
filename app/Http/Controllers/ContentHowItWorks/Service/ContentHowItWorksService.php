<?php

namespace App\Http\Controllers\ContentHowItWorks\Service;

use App\Http\Controllers\Controller;
use App\Models\ContentHowItWorks;
use App\Repository\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContentHowItWorksService extends Controller
{
    public function __construct(
        protected readonly BaseRepository $base_repo
    ){}

    public function createContentHowItWorks(?array $data): mixed
    {
        try{
            DB::beginTransaction();

            if (!isset($data['version'])) {
                $latestVersion = ContentHowItWorks::max('version') ?? 0;
                $data['version'] = $latestVersion + 1;
            }

            $data['created_by'] = Auth::id();

            $created = $this->base_repo->create($data, ContentHowItWorks::class);
            DB::commit();
            return $created;
        }catch(\Exception $e){
            DB::rollBack();
            return $this->throwError($e);
        }
    }

    public function getContentHowItWorks(?array $where): mixed
    {
        try{
            return $this->base_repo->get($where, ContentHowItWorks::class);
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }

    public function getAllContentHowItWorks(): mixed
    {
        try{
            $table = (new ContentHowItWorks)->getTable();

            $latestPerUrl = ContentHowItWorks::selectRaw("COALESCE(url, '/') AS url_key, MAX(version) AS max_version")
                ->groupBy('url_key');

            $rows = ContentHowItWorks::from("$table as chw")
                ->select('chw.*')
                ->joinSub($latestPerUrl, 'lp', function ($join) {
                    $join->on(DB::raw("COALESCE(chw.url, '/')"), '=', 'lp.url_key')
                         ->on('chw.version', '=', 'lp.max_version');
                })
                ->orderBy('lp.url_key')
                ->get();

            return $rows;
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }

    public function updateContentHowItWorks(?array $where, ?array $data): mixed
    {
        try{
            DB::beginTransaction();
            $this->base_repo->update($where, $data, ContentHowItWorks::class);
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            return $this->throwError($e);
        }
    }

    public function softDeleteContentHowItWorks(?array $where): mixed
    {
        try{
            DB::beginTransaction();
            $this->base_repo->softDelete($where, ContentHowItWorks::class);
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            return $this->throwError($e);
        }
    }

    public function getLatestPublished(): mixed
    {
        try{
            return ContentHowItWorks::published()->latest()->first();
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }
}
