<?php

namespace App\Http\Controllers\Admin\Layout;

use App\Http\Controllers\ApiController;
use App\LayoutTop;
use Illuminate\Http\Request;

class LayoutTopController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layoutTops = LayoutTop::all();

        return $this->ApiResponse('stable', null, ['layoutTops' => $layoutTops], 200);
    }

    public function show($lotdx)
    {
        $layoutTop = LayoutTop::find($lotdx);

        return $this->ApiResponse('stable', null, ['layoutTop' => $layoutTop], 200);
    }
}
