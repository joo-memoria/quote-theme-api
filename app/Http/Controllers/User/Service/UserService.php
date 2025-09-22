<?php

namespace App\Http\Controllers\User\Service;

use App\Http\Controllers\Controller;


/**base repository */
use App\Repository\BaseRepository;

/**laravel facades */
use Illuminate\Support\Facades\DB;

/**models */
use App\Models\User;
use Soap\Url;

class UserService extends Controller
{
    /**immutable class properties */
    public function __construct(
        protected readonly BaseRepository $base_repo
    ){}

    /**
     * add user
     * @params
     * ?array $data
     * 
     * @return
     * mixed
     */
    public function createUser(
        ?array $data
    ): mixed {
        try{
            DB::beginTransaction();
            $this->base_repo->create($data, User::class);
            DB::commit();

            /**response */
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            return $this->throwError($e);
        }
    }

    /**
     * get user record
     * @params
     * ?array $where
     * 
     * @return
     * mixed
     */
    public function getUser(
        ?array $where
    ) : mixed {
        try{
            return $this->base_repo->get($where, User::class);
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }

    /**
     * update user record
     * @params
     * ?array $where,
     * ?array $data
     * 
     * @return
     * mixed
     */
    public function updateUser(
        ?array $where,
        ?array $data
    ) : mixed {
        try{
            DB::beginTransaction();
            $this->base_repo->update($where, $data, User::class);
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            return $this->throwError($e);
        }
    }

    /**
     * soft delete record
     * @params
     * ?array $where
     * 
     * @return
     * mixed
     */
    public function softDeleteUser(
        ?array $where
    ) : mixed {
        try{
            DB::beginTransaction();
            $this->base_repo->softDelete($where, User::class);
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            return $this->throwError($e);
        }
    }
}