<?php

namespace App\Http\Controllers\Admin\Layout;

use App\Http\Controllers\ApiController;
use App\LayoutNavigation;
use Illuminate\Http\Request;

class LayoutNaviController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layoutNavis = LayoutNavigation::all();

        return $this->ApiResponse('stable', null, ['layoutNavis' => $layoutNavis], 200);
    }

    public function show($londx)
    {
        $layoutNavi = LayoutNavigation::find($londx);

        return $this->ApiResponse('stable', null, ['layoutNavi' => $layoutNavi], 200);
    }
}
