<a href="{{ route('campaigns.index', ['sort_by' => $sort, 'order_by' => 'asc']) }}" class="@if($sort_by === $sort && $order_by === 'asc') text-primary @else text-dark @endif">
    <i class="bi @if($sort_by === $sort && $order_by === 'asc') bi-caret-up-fill @else bi-caret-up @endif"></i>
</a>
<a href="{{ route('campaigns.index', ['sort_by' => $sort, 'order_by' => 'desc']) }}" class="@if($sort_by === $sort && $order_by === 'desc') text-primary @else text-dark @endif">
    <i class="bi @if($sort_by === $sort && $order_by === 'desc') bi-caret-down-fill @else bi-caret-down @endif"></i>
</a>
