<?php

namespace App\Http\Controllers\Quote;

use App\Http\Controllers\Controller;

/**service layer */
use App\Http\Controllers\Quote\Service\QuoteService;

/**validation requests */
use App\Http\Controllers\Quote\Request\{
    QuoteRequest
};

class QuoteController extends Controller
{
    /**immutable class properties */
    public function __construct(
        protected readonly QuoteService $quote_service
    ) {}

    /**
     * Create
     * @params
     * QuoteRequest $request
     *
     * @return
     * mixed
     */
    public function addQuote(
        QuoteRequest $request
    ) : mixed {
        try{
            /**valid data*/
            $data = $request->validated();

            $created = $this->quote_service->createQuote($data);

            return response()->json($created, 201);
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }

    /**
     * get quote record
     * @params
     * int $record_id
     *
     * @return
     * mixed
     */
    public function getQuote(
        ?int $record_id = null
    ) : mixed {
        try{
            /**execute */
            $data = $record_id
                ? $this->quote_service->getQuote(['id' => $record_id])->first()
                : $this->quote_service->getQuote([])->get();

            /**response */
            return response()->json($data);
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }

    /**
     * get all bus quote record
     * @params
     *
     * @return
     * mixed
     */

    public function getAllQuotes() : mixed {
        try{
            $data = $this->quote_service->getAllQuotes();
            return response()->json($data);
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }

    /**
     * update bus qoute information
     * @params
     * ?int $record_id,
     * Request $request
     *
     * @return
     * mixed
     */
    public function updateQuote(
        int $record_id,
        QuoteRequest $request
    ) : mixed {
        try{
            /**valid data */
            $data = $request->validated();

            /**execute */
            $this->quote_service->updateQuote(["id" => $record_id], $data);

            /**response */
            return true;
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }

    /**
     * soft delete bus quote record
     * @params
     * int $record_id
     *
     * @return
     * mixed
     */
    public function softDeleteQuote(
        int $record_id
    ) : mixed {
        try{
            /**execute */
            $this->quote_service->softDeleteQuote(["id" => $record_id]);

            /**response */
            return true;
        }catch(\Exception $e){
            return $this->throwError($e);
        }
    }
}
