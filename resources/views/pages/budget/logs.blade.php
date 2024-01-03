@extends('layouts/contentNavbarLayout')

@section('title', 'Budget Logs')

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
        <span class="text-muted fw-light">Budget /</span> Budget Logs
    </h5>

    <!-- Expense Log Table -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4 col-10">
                    <h5 style="margin-top: 0.5rem; margin-bottom: 0.5rem;">Expense Logs</h5>
                </div>
                <div class="col-md-8 col-2">
                    <div
                        class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                        <div data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                            title="<i class='bx bx-plus bx-xs' ></i> <span>Log Expense</span>">
                            <button class="btn btn-primary add-log" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#expenseLogOffcanvas" aria-controls="addLog">
                                <i class="bx bx-plus mb-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap container" style="min-height: 500px;">
            <table class="table" id="expenseLogTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Item</th>
                        <th>Due</th>
                        <th>Estimate</th>
                        <th>Total</th>
                        <th>Variance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Expense Log Table -->

    <!-- Investment Log Table -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4 col-10">
                    <h5 style="margin-top: 0.5rem; margin-bottom: 0.5rem;">Investment Logs</h5>
                </div>
                <div class="col-md-8 col-2">
                    <div
                        class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                        <div data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                            title="<i class='bx bx-plus bx-xs' ></i> <span>Log Investment</span>">
                            <button class="btn btn-primary add-log" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#investmentLogOffcanvas" aria-controls="addLog">
                                <i class="bx bx-plus mb-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap container" style="min-height: 500px;">
            <table class="table" id="investmentLogTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Item</th>
                        <th>Due</th>
                        <th>Estimate</th>
                        <th>Total</th>
                        <th>Variance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
    <!-- Investment Log Table -->

    <!-- Savings Log Table -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4 col-10">
                    <h5 style="margin-top: 0.5rem; margin-bottom: 0.5rem;">Savings Logs</h5>
                </div>
                <div class="col-md-8 col-2">
                    <div
                        class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                        <div data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                            title="<i class='bx bx-plus bx-xs' ></i> <span>Log Savings</span>">
                            <button class="btn btn-primary add-log" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#savingsLogOffcanvas" aria-controls="addLog">
                                <i class="bx bx-plus mb-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap container" style="min-height: 500px;">
            <table class="table" id="savingsLogTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Due</th>
                        <th>Estimate</th>
                        <th>Total</th>
                        <th>Variance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
    <!-- Savings Log Table -->
@endsection

@section('page-script')
    <!-- Init Plugins Scripts -->
    {{-- <script src="{{ asset('js/custom/income/income-logs-init.js') }}"></script> --}}

    <!-- Transactional Script -->
    {{-- <script src="{{ asset('js/custom/income/income-logs.js') }}"></script> --}}
@endsection
