<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class CampaignController extends Controller
{
    /**
     * Display a listing of the campaigns, with optional filtering and sorting.
     */
    public function index(Request $request)
    {
        // Number of results per page
        $perPage = 10;

        // Get filtering and sorting parameters from the request
        $brandId = $request->input('brand');
        $currentPage = $request->input('page', 1);
        $sortBy = $request->input('sort_by', 'name');
        $orderBy = $request->input('order_by', 'asc');
        $endDate = $request->input('end_date', now()->format('Y-m-d'));
        $startDate = $request->input('start_date', now()->subDays(7)->format('Y-m-d'));

        // Generate a cache key using the filtering and sorting parameters
        $cacheKey = "campaigns_{$brandId}_{$sortBy}_{$orderBy}_{$startDate}_{$endDate}_page_{$currentPage}";

        // Cache the query results for 10 minutes (600 seconds)
        $paginatedCampaigns = Cache::remember($cacheKey, 600, function () use ($brandId, $sortBy, $orderBy, $startDate, $endDate, $perPage, $currentPage) {
            
            // Build the query to retrieve campaigns, including brand and counts for impressions, interactions, and conversions
            $campaigns = Campaign::with(['brand'])
                ->withCount([
                    'impressions' => function ($query) use ($startDate, $endDate) {
                        // Filter impressions within the selected date range
                        $query->whereBetween('occurred_at', [$startDate, $endDate]);
                    },
                    'interactions' => function ($query) use ($startDate, $endDate) {
                        // Filter interactions within the selected date range
                        $query->whereBetween('occurred_at', [$startDate, $endDate]);
                    },
                    'conversions' => function ($query) use ($startDate, $endDate) {
                        // Filter conversions within the selected date range
                        $query->whereBetween('occurred_at', [$startDate, $endDate]);
                    }
                ])
                // Filter campaigns by brand if a brand ID is provided
                ->when($brandId, function ($query) use ($brandId) {
                    return $query->where('brand_id', $brandId);
                });

            // If sorting by conversion rate, calculate and sort in-memory
            if ($sortBy === 'conversion_rate') {
                $campaigns = $campaigns->get()->sortBy(function ($campaign) use ($orderBy) {
                    // Calculate conversion rate as (conversions / interactions) * 100
                    $rate = $campaign->interactions_count > 0
                        ? ($campaign->conversions_count / $campaign->interactions_count) * 100
                        : 0;
                    // Sort based on the rate, ascending or descending
                    return $orderBy === 'asc' ? $rate : -$rate;
                });
    
                // Paginate the results after sorting in-memory
                return $this->paginateCollection($campaigns, $perPage, $currentPage);
            } else {
                // If sorting by other columns, handle it in the query and paginate the result
                return $campaigns->orderBy($sortBy, $orderBy)->paginate($perPage);
            }
        });

        // Return the view with the paginated campaigns and filtering data
        return view('campaigns.index', [
            'brands' => Brand::orderBy('name')->get(),
            'campaigns' => $paginatedCampaigns, 
            'start_date' => $startDate, 
            'end_date' => $endDate,
            'sort_by' => $sortBy, 
            'order_by' => $orderBy, 
        ]);
    }

    /**
     * Manually paginate a collection of campaigns.
     */
    private function paginateCollection($campaigns, $perPage, $currentPage)
    {
        // Calculate the offset for the current page
        $offset = ($currentPage - 1) * $perPage;

        // Slice the collection to get the campaigns for the current page
        $paginatedCampaigns = $campaigns->slice($offset, $perPage)->values();

        // Create a LengthAwarePaginator to handle pagination
        return new LengthAwarePaginator(
            $paginatedCampaigns, // Data for the current page
            $campaigns->count(), // Total number of campaigns
            $perPage, // Number of items per page
            $currentPage, // Current page
            ['path' => request()->url(), 'query' => request()->query()] // Pagination path and query parameters
        );
    }
}