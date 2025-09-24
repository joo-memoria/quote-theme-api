<?php

namespace App\Http\Controllers\ContentAbout\Service;

use App\Http\Controllers\Controller;
use App\Models\ContentAbout;
use App\Repository\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContentAboutService extends Controller
{
    public function __construct(
        protected readonly BaseRepository $base_repo
    ){}

    public function createContentAbout(?array $data): mixed
    {
        try{
            DB::beginTransaction();

            if (!isset($data['version'])) {
                $latestVersion = ContentAbout::max('version') ?? 0;
                $data['version'] = $latestVersion + 1;
            }

            $data['created_by'] = Auth::id();

            $created = $this->base_repo->create($data, ContentAbout::class);
            DB::commit();
            return $created;
        }catch(\Exception $e){
            DB::rollBack();
            return $this->throwError($e);
        }
    }

    public function getContentAbout(?array $where): mixed
    {
        try{
            return $this->base_repo->get($where, ContentAbout::class);
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }

    public function getAllContentAbout(): mixed
    {
        try{
            $table = (new ContentAbout)->getTable();

            $latestPerUrl = ContentAbout::selectRaw("COALESCE(url, '/') AS url_key, MAX(version) AS max_version")
                ->groupBy('url_key');

            $rows = ContentAbout::from("$table as ca")
                ->select('ca.*')
                ->joinSub($latestPerUrl, 'lp', function ($join) {
                    $join->on(DB::raw("COALESCE(ca.url, '/')"), '=', 'lp.url_key')
                         ->on('ca.version', '=', 'lp.max_version');
                })
                ->orderBy('lp.url_key')
                ->get();

            return $rows;
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }

    public function updateContentAbout(?array $where, ?array $data): mixed
    {
        try{
            DB::beginTransaction();
            $this->base_repo->update($where, $data, ContentAbout::class);
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            return $this->throwError($e);
        }
    }

    public function softDeleteContentAbout(?array $where): mixed
    {
        try{
            DB::beginTransaction();
            $this->base_repo->softDelete($where, ContentAbout::class);
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
            return ContentAbout::published()->latest()->first();
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }
}
