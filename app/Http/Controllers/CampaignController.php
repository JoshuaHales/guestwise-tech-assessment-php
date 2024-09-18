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
        $startDate = request('start_date', now()->subDays(7)->format('Y-m-d'));
        $endDate = request('end_date', now()->format('Y-m-d'));
        $brandId = request('brand');
        $sortBy = request('sort_by', 'name');
        $orderBy = request('order_by', 'asc');

        $campaigns = Campaign::with(['brand'])
            ->withCount([
                'impressions as impressions_count' => function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('occurred_at', [$startDate, $endDate]);
                },
                'interactions as interactions_count' => function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('occurred_at', [$startDate, $endDate]);
                },
                'conversions as conversions_count' => function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('occurred_at', [$startDate, $endDate]);
                },
            ])
            ->when($brandId, function ($query) use ($brandId) {
                return $query->where('brand_id', $brandId);
            })
            ->orderBy($sortBy, $orderBy)
            ->paginate(10);

        return view('campaigns.index', [
            'brands' => Brand::orderBy('name')->get(),
            'campaigns' => $campaigns,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'sort_by' => $sortBy,
            'order_by' => $orderBy,
        ]);
    }

}
