@extends('layouts/contentNavbarLayout')

@section('title', 'Income Setup')

@section('content')
<h5 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Income /</span> Setup
</h5>

<!-- Responsive Table -->
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="table-responsive text-nowrap" style="min-height: 500px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Label</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $category->title }}</td>
                                <td>
                                    <div class="d-inline-block text-nowrap">
                                        <span class="action-tooltip" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" title="Edit">
                                            <button class="btn btn-sm btn-icon edit-type" data-oc-trigger="edit-log" data-id="{{ $category->id }}" data-bs-toggle="offcanvas"
                                            data-bs-target="#incomeLogOffcanvas" aria-controls="editLog"><i class="bx bx-edit"></i></button>
                                        </span>
                                        <span class="action-tooltip" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" title="Delete">
                                            <button class="btn btn-sm btn-icon delete-type" data-id="{{ $category->id }}"><i class="bx bx-trash"></i></button>
                                        </span>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No Records Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mx-3 mt-4">
                <div class="d-flex float-end">
                    @if(count($categories))
                        {{ $categories->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="table-responsive text-nowrap" style="min-height: 500px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Income Type Label</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($types as $type)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $type->title }}</td>
                                <td>
                                    <div class="d-inline-block text-nowrap">
                                        <span class="action-tooltip" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" title="Edit">
                                            <button class="btn btn-sm btn-icon edit-type" data-id="{{ $type->id }}" data-bs-toggle="offcanvas"
                                            data-bs-target="#incomeLogOffcanvas" aria-controls="editLog"><i class="bx bx-edit"></i></button>
                                        </span>
                                        <span class="action-tooltip" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" title="Delete">
                                            <button class="btn btn-sm btn-icon delete-type" data-id="{{ $type->id }}"><i class="bx bx-trash"></i></button>
                                        </span>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No Records Found</td>
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
    </div>
</div>
<!--/ Responsive Table -->
@endsection