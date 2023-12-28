@extends('layouts/contentNavbarLayout')

@section('title', 'Income Logs')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
@endsection

@section('page-style')
    <style>
        td {
            font-size: 0.9rem;
        }
    </style>
@endsection

@section('content')
    <h5 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Income /</span> Income Logs
    </h5>

    <!-- Responsive Table -->
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4 col-10">


                    <h5 style="margin-top: 0.5rem; margin-bottom: 0.5rem;">Income Logs</h5>
                </div>
                <div class="col-md-8 col-2">
                    <div class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                        <div data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                        title="<i class='bx bx-plus bx-xs' ></i> <span>Log Income</span>">
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#incomeLogOffcanvas"
                            aria-controls="addLog">
                            <i class="bx bx-plus mb-1"></i>
                        </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap container" style="min-height: 500px;">
            <table class="table" id="incomeLogTable">
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
                    {{-- @forelse($sources as $source)
                        @php
                            $diff = $source->expected_income - $source->actual_incomes_sum_amount;
                        @endphp
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ \Carbon\Carbon::parse($source->income_date)->format('M. d, Y') }}</td>
                            <td>{{ $source->category->title }}</td>
                            <td>{{ $source->type->title }}</td>
                            <td>&#8369; {{ number_format($source->expected_income) }}</td>
                            <td>&#8369; {{ number_format($source->actual_incomes_sum_amount) }}</td>
                            <td>
                                @if ($diff >= 0)
                                    <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0">
                                        <span class="badge badge-dot bg-success me-1"></span> &#8369;
                                        {{ number_format($diff) }}
                                    </div>
                                @else
                                    <span class="badge bg-label-danger">&#8369; {{ number_format($diff) }}</span>
                                @endif
                            </td>
                            <td>&#8369; {{ number_format($source->actual_incomes_sum_amount) }}</td>
                            <td>&#8369; {{ number_format($source->actual_incomes_sum_amount) }}</td>
                            <!-- <td>{{ \Carbon\Carbon::parse($source->created_at)->format('M. d, Y H:i:s') }}</td>
                                                                        <td>{{ \Carbon\Carbon::parse($source->updated_at)->format('M. d, Y H:i:s') }}</td> -->
                            <td class="text-center">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#add-income-logs"><i class="bx bx-show-alt me-1"></i> View</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No Records Found</td>
                        </tr>
                    @endforelse --}}
                </tbody>
            </table>
        </div>

        {{-- <div class="mx-3 mt-4">
            <div class="d-flex float-end">
                @if (count($sources))
                    {{ $sources->links() }}
                @endif
            </div>
        </div> --}}
    </div>
    <!--/ Responsive Table -->

    <!-- Modal -->
    <div class="modal fade" id="add-income-logs" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-income-logs-title">Add Income Logs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Name</label>
                            <input type="text" id="nameBackdrop" class="form-control" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailBackdrop" class="form-label">Email</label>
                            <input type="email" id="emailBackdrop" class="form-control" placeholder="xxxx@xxx.xx">
                        </div>
                        <div class="col mb-0">
                            <label for="dobBackdrop" class="form-label">DOB</label>
                            <input type="date" id="dobBackdrop" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="incomeLogOffcanvas" aria-labelledby="addLogLabel">
        <div class="offcanvas-header">
            <h5 id="addLogLabel" class="offcanvas-title">Add New Income Log</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0" id="add-log-body">
            <form id="addNewLogForm" class="add-log needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="bs-validation-date">Income Date</label>
                    <input type="text" class="form-control flatpickr-validation date-mask" id="bs-validation-date"
                        placeholder=" yyyy-MM-dd" name="income_date" autocomplete="off" required />
                    <div class="valid-feedback"> Looks good! </div>
                    <div class="invalid-feedback"> Please Enter Income Date </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bs-validation-category">Category</label>
                    <select class="form-select select2" id="bs-validation-category" name="income_category" required>
                        <option disabled selected>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    <div class="valid-feedback"> Looks good! </div>
                    <div class="invalid-feedback"> Please select any Category </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bs-validation-type">Income Type</label>
                    <select class="form-select select2" id="bs-validation-type" name="income_type" required>
                        <option value="" disabled selected>Select Income Type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->title }}</option>
                        @endforeach
                    </select>
                    <div class="valid-feedback"> Looks good! </div>
                    <div class="invalid-feedback"> Please select any Income Type </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bs-validation-expected">Expected Income</label>
                    <div class="input-group">
                        <span class="input-group-text">&#8369;</span>
                        <input class="form-control numeral-mask numeral-maxlength" type="text"
                            id="bs-validation-expected" placeholder="Enter Expected Income" maxlength="10"
                            autocomplete="off" name="expected_income" />
                    </div>
                    <div class="valid-feedback"> Looks good! </div>
                    <div class="invalid-feedback"> Please Enter Expected Income </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bs-validation-actual">Actual Income</label>
                    <div class="input-group">
                        <span class="input-group-text">&#8369;</span>
                        <input class="form-control numeral-mask numeral-maxlength" type="text"
                            id="bs-validation-actual" placeholder="Enter Actual Income" maxlength="10"
                            autocomplete="off" name="actual_income" />
                    </div>
                    <div class="valid-feedback"> Looks good! </div>
                    <div class="invalid-feedback"> Please Enter Actual Income </div>
                </div>
                <div class="row">
                    <div class="col-12 d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('page-script')
    <!-- Init Plugins Scripts -->
    <script src="{{ asset('js/custom/income/income-logs-init.js') }}"></script>

    <!-- Transactional Script -->
    <script src="{{ asset('js/custom/income/income-logs.js') }}"></script>
@endsection
