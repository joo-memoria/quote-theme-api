<?php

namespace App\Repository\Contract;

interface IBaseRepository
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
    ) : mixed;

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
    ) : mixed;

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
    ) : int | bool;

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
    ) : int | bool;

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
    ) : int | bool;

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
    ) : int | bool;
}