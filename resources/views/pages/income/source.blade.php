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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
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
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
@endsection

@section('page-style')
    <style>
        td {
            font-size: 0.9rem;
        }
        .highlight-row {
            background-color: #FFFF99; /* Change this to your desired highlight color */
        }
    </style>
@endsection

@section('content')
    <h5 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Income /</span> Income Logs
    </h5>

    <!-- Responsive Table -->
    <div class="card ">
        {{-- <div class="card-header">
            
            <div class="row">
                <div class="col-md-4 col-10">
                    <h5 style="margin-top: 0.5rem; margin-bottom: 0.5rem;">Income Logs</h5>
                </div>
                <div class="col-md-8 col-2">
                    <div
                        class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                        <div data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                            title="<i class='bx bx-plus bx-xs' ></i> <span>Log Income</span>">
                            <button class="btn btn-primary add-log" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#incomeLogOffcanvas" aria-controls="addLog">
                                <i class="bx bx-plus mb-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="card-header border-bottom mb-4">
            {{-- <h5 class="card-title">Filter</h5> --}}
            <div class="d-flex justify-content-between align-items-center row gap-4 gap-md-0">
                <div class="col-md-3 user_plan">
                    <select id="month" class="form-select text-capitalize">
                        <option value="1" selected>January</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <div class="col-md-2 user_role">
                    <select id="year" class="form-select text-capitalize">
                        <option value="2024" selected>2024</option>
                        <option value="2023">2023</option>
                    </select>
                </div>
                
                <div class="col-md-7 col-2">
                    <div
                        class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                        <div data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                            title="<i class='bx bx-plus bx-xs' ></i> <span>Log Income</span>">
                            <button class="btn btn-primary add-log open-form-btn" data-oc-trigger="add-log" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#incomeLogOffcanvas" aria-controls="addLog">
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
                        <th>Actions</th>
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

    <!-- Income Log Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="incomeLogOffcanvas" aria-labelledby="addLogLabel">
        <div class="offcanvas-header">
            <h5 id="incomeLogTitle" class="offcanvas-title">Add New Income Log</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0" id="add-log-body">
            <form id="incomeLogForm" class="income-log-form needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="bs-validation-date">Income Date</label>
                    <input type="text" class="form-control flatpickr-validation date-mask" id="bs-validation-date"
                        placeholder=" yyyy-MM-dd" name="income_date" autocomplete="off" required />
                    <div class="valid-feedback"> Looks good! </div>
                    <div class="invalid-feedback"> Please Enter Income Date </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="income_category">Category</label>
                    <select class="form-select select2" id="income_category" name="income_category" required>
                        <option disabled selected value="default">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    <div class="valid-feedback"> Looks good! </div>
                    <div class="invalid-feedback"> Please select any Category </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="income_type">Income Type</label>
                    <select class="form-select select2" id="income_type" name="income_type" required>
                        <option disabled selected value="default">Select Income Type</option>
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

    <!-- Actual Income Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="actualIncomeOffcanvas" aria-labelledby="addLogLabel">
        <div class="offcanvas-header">
            <h5 id="actualIncomeLabel" class="offcanvas-title">Actual Income</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0" id="actualIncomeBody">
            <form class="form-repeater" id="form-repeater">
                @csrf
                <div data-repeater-list="group-a">
                    <div data-repeater-item>
                        <div class="row">
                            <div class="mb-3 col-lg-10 col-xl-10 col-10 mb-0 pe-0">
                                <div class="input-group">
                                    <span class="input-group-text">&#8369;</span>
                                    <input class="form-control numeral-mask numeral-maxlength" type="text"
                                        id="form-repeater-1-1" placeholder="Enter Actual Income" maxlength="10"
                                        autocomplete="off" name="actual_income" />
                                </div>
                            </div>
                            <div class="mb-3 col-lg-2 col-xl-2 col-2 mt-0">
                                <button class="btn btn-sm btn-danger py-2" data-repeater-delete="">
                                    <i class="bx bx-x me-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-12 pe-1">
                        <div class="mb-0 float-end">
                            <button class="btn btn-sm btn-primary py-2" data-repeater-create>
                                <i class="bx bx-plus me-1"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 pe-0">
                        <div class="mb-0">
                            <hr>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="mb-3 col-lg-10 col-xl-10 col-10 mb-0 pe-0">
                        <label class="form-label">Total Actual Income</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary"
                                style="font-weight: 400; color: white; border-color:rgba(0,0,0,0);">&#8369;</span>
                            <input class="form-control numeral-mask bg-primary" type="text" id="total_actual_income"
                                placeholder="Total Actual Income" autocomplete="off" name="actual_income" disabled
                                value="1000" style="font-weight: 600; color: white; border-color:rgba(0,0,0,0);" />
                        </div>
                    </div>
                    <div class="mb-3 col-lg-2 col-xl-2 col-2 mt-1">
                        <button class="btn btn-sm btn-primary mt-4 py-2" data-repeater-create>
                            <i class="bx bx-plus me-1"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-12 pe-1">
                        <div class="mb-0 d-grid gap-2">
                            <button class="btn btn-dark" type="submit">
                                <span class="align-middle">SAVE</span>
                            </button>
                        </div>
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
