<?php 

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser
{
    protected function ApiResponse($kind, $message = null, $target = null, $code)
    {
        return response()->json([
            'alert' => [
                'kind' => $kind,
                'message' => $message ? $message : [],
                'target' => $target ? $target : [],
            ],
        ], $code);
    }
}