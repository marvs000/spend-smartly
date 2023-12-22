@extends('layouts/contentNavbarLayout')

@section('title', 'Income Logs')

@section('content')
<h5 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Income /</span> Income Logs
</h5>

<!-- Responsive Table -->
<div class="card">
    <div class="table-responsive text-nowrap" style="min-height: 500px;">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Expected</th>
                    <th>Actual</th>
                    <th>Diff</th>
                    <th>Final</th>
                    <th>Remaining</th>
                    <th class="text-center" title="Actions">
                        <i class="bx bx-menu"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($sources as $source)
                    @php
                        $diff = $source->expected_income - $source->actual_incomes_sum_amount;
                    @endphp
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{\Carbon\Carbon::parse($source->income_date)->format('M. d, Y')}}</td>
                        <td>{{ $source->category->title }}</td>
                        <td>{{ $source->type->title }}</td>
                        <td>&#8369; {{ number_format($source->expected_income) }}</td>
                        <td>&#8369; {{ number_format($source->actual_incomes_sum_amount) }}</td>
                        <td>
                            @if($diff >= 0)
                                <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                    <span class="badge badge-dot bg-success me-1"></span> &#8369; {{ number_format($diff) }}
                                </div>
                            @else
                                <span class="badge bg-label-danger">&#8369; {{ number_format($diff) }}</span>
                            @endif
                        </td>
                        <td>&#8369; {{ number_format($source->actual_incomes_sum_amount) }}</td>
                        <td>&#8369; {{ number_format($source->actual_incomes_sum_amount) }}</td>
                        <!-- <td>{{\Carbon\Carbon::parse($source->created_at)->format('M. d, Y H:i:s')}}</td>
                        <td>{{\Carbon\Carbon::parse($source->updated_at)->format('M. d, Y H:i:s')}}</td> -->
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show-alt me-1"></i> View</a>
                                </div>
                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="10" class="text-center">No Records Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mx-3 mt-4">
        <div class="d-flex float-end">
            @if(count($sources))
                {{ $sources->links() }}
            @endif
        </div>
    </div>
</div>
<!--/ Responsive Table -->
@endsection