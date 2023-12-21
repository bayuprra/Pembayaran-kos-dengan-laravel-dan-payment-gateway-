<?php

namespace App\Http\Controllers;

use App\Models\AkunModel;
use App\Models\KamarModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $akunModel, $kamarModel;

    public function __construct()
    {
        $this->akunModel = new AkunModel();
        $this->kamarModel = new KamarModel();
    }
}
