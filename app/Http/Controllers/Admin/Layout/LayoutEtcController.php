<?php

namespace App\Http\Controllers\Admin\Layout;

use App\Http\Controllers\ApiController;
use App\LayoutEtc;
use Illuminate\Http\Request;

class LayoutEtcController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layoutEtcs = LayoutEtc::all();

        return $this->ApiResponse('stable', null, ['layoutEtcs' => $layoutEtcs], 200);
    }

    public function show($loedx)
    {
        $layoutEtc = LayoutEtc::find($loedx);

        return $this->ApiResponse('stable', null, ['layoutEtc' => $layoutEtc], 200);
    }
}
