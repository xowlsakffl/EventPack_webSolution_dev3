<?php

namespace App\Http\Controllers\Admin\Layout;

use App\Http\Controllers\ApiController;
use App\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LayoutController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $layouts = Layout::with('siteLayoutSets.site')->get();
        
        return $this->ApiResponse('stable', null, ['layouts' => $layouts], 200);
    }

    public function show($lodx)
    {
        $layout = Layout::find($lodx);

        return $this->ApiResponse('stable', null, ['layout' => $layout], 200);
    }
}
