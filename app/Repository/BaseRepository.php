<?php

namespace App\Repository;

/**contract */
use App\Repository\Contract\IBaseRepository;

class BaseRepository implements IBaseRepository
{
    /**
     * create
     * @params
     * ?array $data,
     * ?string $model
     * 
     * @return
     * mixed
     */
    public function create(
        ?array $data,
        ?string $model
    ) : mixed{
        return $model::create($data);
    }

    /**
     * get
     * @params
     * ?array $where
     * ?string $model
     * 
     * @return
     * mixed
     */
    public function get(
        ?array $where,
        ?string $model
    ) : mixed{
        return $model::where($where);
    }

    /**
     * update
     * @params
     * ?array $where,
     * ?array $data,
     * ?string $model
     * 
     * @return
     * int | bool
     */
    public function update(
        ?array $where,
        ?array $data,
        ?string $model
    ) : int | bool{
        return $model::where($where)->update($data);
    }

    /**
     * soft delete
     * @params
     * ?array $where,
     * ?string $model
     * 
     * @return
     * int | bool
     */
    public function softDelete(
        ?array $where,
        ?string $model
    ) : int | bool{
        return $model::where($where)->delete();
    }

    /**
     * perma delete
     * @params
     * ?array $where,
     * ?string $model
     * 
     * @return
     * int | bool
     */
    public function permaDelete(
        ?array $where,
        ?string $model
    ) : int | bool{
        return $model::where($where)->forceDelete();
    }

    /**
     * recover soft deleted
     * @params
     * ?array $where,
     * ?string $model
     * 
     * @return
     * int | bool
     */
    public function revertSoftDelete(
        ?array $where,
        ?string $model
    ) : int | bool{
        return $model::where($where)->restore();
    }
}