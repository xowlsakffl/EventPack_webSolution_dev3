<?php

namespace App\Http\Controllers\Admin\Layout;

use App\Http\Controllers\ApiController;
use App\LayoutMiddle;
use Illuminate\Http\Request;

class LayoutMiddleController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layoutMiddles = LayoutMiddle::all();

        return $this->ApiResponse('stable', null, ['layoutMiddles' => $layoutMiddles], 200);
    }

    public function show($lomdx)
    {
        $layoutMiddle = LayoutMiddle::find($lomdx);

        return $this->ApiResponse('stable', null, ['layoutMiddle' => $layoutMiddle], 200);
    }
}
