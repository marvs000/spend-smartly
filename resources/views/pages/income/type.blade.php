@extends('layouts/contentNavbarLayout')

@section('title', 'Income Type')

@section('content')
<h5 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Income /</span> Types
</h5>

<!-- Responsive Table -->
<div class="card">
    <div class="table-responsive text-nowrap" style="min-height: 500px;">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Income Type Label</th>
                    <th>Related Source of Income</th>
                    <th class="text-center" title="Actions">
                        <i class="bx bx-menu"></i>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($types as $type)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $type->title }}</td>
                        <td></td>
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
                        <td colspan="5" class="text-center">No Records Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mx-3 mt-4">
        <div class="d-flex float-end">
            @if(count($types))
                {{ $types->links() }}
            @endif
        </div>
    </div>
</div>
<!--/ Responsive Table -->
@endsection