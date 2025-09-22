<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

/**service layer */
use App\Http\Controllers\User\Service\UserService;

/**validation requests */
use App\Http\Controllers\User\Request\{
    UserRequest
};

class UserController extends Controller
{
    /**immutable class properties */
    public function __construct(
        protected readonly UserService $user_service
    ) {}

    /**
     * Create
     * @params
     * UserRequest $request
     * 
     * @return
     * mixed
     */
    public function addUser(
        UserRequest $request
    ) : mixed {
        try{
            /**valid data*/
            $data = $request->validated();

            $this->user_service->createUser($data);

            return true;
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }

    /**
     * get user record
     * @params
     * int $record_id
     * 
     * @return
     * mixed
     */
    public function getUser(
        ?int $record_id = null
    ) : mixed {
        try{
            /**execute */
            $data = $record_id
                ? $this->user_service->getUser(['id' => $record_id])->first()
                : $this->user_service->getUser([])->get();

            /**response */
            return response()->json($data);
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }

    /**
     * update user information
     * @params
     * ?int $record_id,
     * UserRequest $request
     * 
     * @return
     * mixed
     */
    public function updateUser(
        int $record_id,
        UserRequest $request
    ) : mixed {
        try{
            /**valid data */
            $data = $request->validated();

            /**execute */
            $this->user_service->updateUser(["id" => $record_id], $data);

            /**response */
            return true;
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }

    /**
     * soft delete user
     * @params
     * int $record_id
     * 
     * @return
     * mixed
     */
    public function softDeleteUser(
        int $record_id
    ) : mixed {
        try{
            /**execute */
            $this->user_service->softDeleteUser(["id" => $record_id]);

            /**response */
            return true;
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }
}