<?php

namespace App\Http\Controllers;

use App\Http\Resources\PartnerCollection;
use App\Partner;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PartnerCollection
     */
    public function index()
    {
        return new PartnerCollection(Partner::all());
    }
}
