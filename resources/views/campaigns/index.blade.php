@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">
        Campaign List
    </h2>

    <form action="{{ route('campaigns.index') }}" method="GET">
        <div class="row mb-4">
            <div class="col-md-3">
                <label for="brand">Brand</label>
                <select name="brand" id="brand" class="form-control">
                    <option value="">All Brands</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" @if(request('brand') == $brand->id) selected @endif>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $start_date }}">
            </div>
            <div class="col-md-3">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $end_date }}">
            </div>
            <div class="col-md-3 pt-5">
                <button type="submit" class="btn btn-primary mt-1">Search</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">
                        <a href="{{ route('campaigns.index', ['sort' => 'name', 'order' => $order_by]) }}">
                            Campaign Name
                        </a>
                        @include('partials.sort-icons', ['sort' => 'name', 'order' => $order_by])
                    </th>
                    <th scope="col">
                        <a href="{{ route('campaigns.index', ['sort' => 'brand', 'order' => $order_by]) }}">
                            Brand Name
                        </a>
                        @include('partials.sort-icons', ['sort' => 'brand', 'order' => $order_by])
                    </th>
                    <th scope="col">
                        <a href="{{ route('campaigns.index', ['sort' => 'impressions', 'order' => $order_by]) }}">
                            Impressions
                        </a>
                        @include('partials.sort-icons', ['sort' => 'impressions', 'order' => $order_by])
                    </th>
                    <th scope="col">
                        <a href="{{ route('campaigns.index', ['sort' => 'interactions', 'order' => $order_by]) }}">
                            Interactions
                        </a>
                        @include('partials.sort-icons', ['sort' => 'interactions', 'order' => $order_by])
                    </th>
                    <th scope="col">
                        <a href="{{ route('campaigns.index', ['sort' => 'conversions', 'order' => $order_by]) }}">
                            Conversions
                        </a>
                        @include('partials.sort-icons', ['sort' => 'conversions', 'order' => $order_by])
                    </th>
                    <th scope="col">
                        <a href="{{ route('campaigns.index', ['sort' => 'conversion_rate', 'order' => $order_by]) }}">
                            Conversion Rate (%)
                        </a>
                        @include('partials.sort-icons', ['sort' => 'conversion_rate', 'order' => $order_by])
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($campaigns as $campaign)
                    <tr>
                        <td>{{ $campaign->name }}</td>
                        <td>{{ $campaign->brand->name }}</td>
                        <td>{{ $campaign->impressions_count }}</td>
                        <td>{{ $campaign->interactions_count }}</td>
                        <td>{{ $campaign->conversions_count }}</td>
                        <td>
                            @if($campaign->interactions_count > 0)
                                {{ number_format(($campaign->conversions_count / $campaign->interactions_count) * 100, 2) }}%
                            @else
                                0%
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="my-5">
        {{ $campaigns->links() }}
    </div>
</div>
@endsection
