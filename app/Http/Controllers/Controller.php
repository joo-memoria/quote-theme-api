<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function throwError(
        \Exception $err
    ) : mixed {
        return response()->json([
            'response'  => false,
            'message'   => $err->getMessage()
        ], 500);
    }
}
