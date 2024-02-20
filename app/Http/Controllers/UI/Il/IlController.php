<?php

namespace App\Http\Controllers\UI\Il;

use App\Http\Controllers\Controller;
use App\Http\Resources\UI\Il\IlCollection;
use App\Http\Resources\UI\Ilce\IlceCollection;
use App\Models\Cities\Cities;
use Illuminate\Http\Request;

class IlController extends Controller
{
    public function iller()
    {
        return new IlCollection(Cities::get());
    }

    public function ilceler(Cities $ilce)
    {
        return new IlceCollection($ilce->districts);
    }
}
