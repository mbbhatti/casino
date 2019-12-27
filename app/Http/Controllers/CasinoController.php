<?php

namespace App\Http\Controllers;

use App\Builder\Casino;

class CasinoController extends Controller
{
	/**
     * Use to manage casino.
     *
     * @var object
     */
    protected $casino;

    /**
     * Create a new controller instance.
     *
     * @param  Casino  $casino
     * @return void
     */
    public function __construct(Casino $casino)
    {
        $this->casino = $casino;
    }

    /**
     * Get all payouts.
     *
     * @return json
     */
    public function payouts()
    {   
        return response()->json($this->casino->getPayOut(), 200);
    }    
}
