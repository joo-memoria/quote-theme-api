<?php

namespace App\Http\Controllers\Quote\Service;

use App\Http\Controllers\Controller;
use App\Models\BusQuote;
use App\Mail\QuoteConfirmation;
use App\Models\Quote;
use Illuminate\Support\Facades\Mail;

/**base repository */
use App\Repository\BaseRepository;

/**laravel facades */
use Illuminate\Support\Facades\DB;

/**models */
// use App\Models\User;
// use Soap\Url;

class QuoteService extends Controller
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
    public function createQuote(
        ?array $data
    ): mixed {
        try{
            DB::beginTransaction();
            $created = $this->base_repo->create($data, Quote::class);
            DB::commit();

            // send confirmation email. Use queue if available, otherwise send synchronously
            try{
                if(method_exists(Mail::class, 'to')){
                    Mail::to($created->email)->queue(new QuoteConfirmation($created));
                    $created->update(['is_confirmation' => true]);
                }else{
                    Mail::to($created->email)->send(new QuoteConfirmation($created));
                    $created->update(['is_confirmation' => true]);
                }
            }catch(\Exception $e){
                // don't break the flow if mail fails; log and continue
                report($e);
            }

            /**response */
            return $created;
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
    public function getQuote(
        ?array $where
    ) : mixed {
        try{
            return $this->base_repo->get($where, Quote::class);
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
    public function updateQuote(
        ?array $where,
        ?array $data
    ) : mixed {
        try{
            DB::beginTransaction();
            $this->base_repo->update($where, $data, Quote::class);
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
    public function softDeleteQuote(
        ?array $where
    ) : mixed {
        try{
            DB::beginTransaction();
            $this->base_repo->softDelete($where, Quote::class);
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            return $this->throwError($e);
        }
    }

    public function getAllQuotes() : mixed {
        try{
            return $this->base_repo->get([], Quote::class)->get();
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }
}
