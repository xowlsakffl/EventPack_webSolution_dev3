<?php

namespace App\Http\Controllers\Admin\Layout;

use App\Http\Controllers\ApiController;
use App\LayoutBottom;
use Illuminate\Http\Request;

class LayoutBottomController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layoutBottoms = LayoutBottom::all();

        return $this->ApiResponse('stable', null, ['layoutBottoms' => $layoutBottoms], 200);
    }

    public function show($lobdx)
    {
        $layoutBottom = LayoutBottom::find($lobdx);

        return $this->ApiResponse('stable', null, ['layoutBottom' => $layoutBottom], 200);
    }
}
