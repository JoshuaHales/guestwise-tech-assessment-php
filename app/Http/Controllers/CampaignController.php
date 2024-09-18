<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Campaign;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('campaigns.index', [
            'brands' => Brand::orderBy('name', 'asc')->get(),
            'campaigns' => Campaign::orderBy('name', 'asc')->paginate(),
            'start_date' => request('start_date', date('Y-m-d', strtotime('-7 days'))),
            'end_date' => request('end_date', date('Y-m-d')),
            'sort_by' => request('sort_by') ?? 'name',
            'order_by' => request('order_by') ?? 'asc',
        ]);
    }
}
