<?php

namespace App\Http\Controllers;

use App\Models\AkunModel;
use App\Models\KamarModel;
use App\Models\kostModel;
use App\Models\PenyewaModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $akunModel, $kamarModel, $penyewaModel, $kostModel;

    public function __construct()
    {
        $this->akunModel = new AkunModel();
        $this->kamarModel = new KamarModel();
        $this->penyewaModel = new PenyewaModel();
        $this->kostModel = new kostModel();
    }
}
