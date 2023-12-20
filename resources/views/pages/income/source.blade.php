@extends('layouts/contentNavbarLayout')

@section('title', 'Income Sources')

@section('content')
<h5 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Income /</span> Sources
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
                    <th>Amount</th>
                    <th class="text-center" title="Actions">
                        <i class="bx bx-menu"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($sources as $source)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{\Carbon\Carbon::parse($source->income_date)->format('M. d, Y')}}</td>
                        <td>$source->income_category</td>
                        <td>$source->income_type</td>
                        <td>$source->amount</td>
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
                        <td colspan="7" class="text-center">No Records Found</td>
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