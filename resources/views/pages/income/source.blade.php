@extends('layouts/contentNavbarLayout')

@section('title', 'Income Logs')

@section('content')
<h5 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Income /</span> Income Logs
</h5>

<!-- Responsive Table -->
<div class="card ">
    <div class="card-header">
        <div class="row">
            <div class="col-md-2">
                <h5 style="margin-top: 0.5rem; margin-bottom: 0.5rem;">Income Logs</h5>
            </div>
            <div class="col-md-10">
                <div class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd">
                        <i class="bx bx-plus me-0 me-sm-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
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
                                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#add-income-logs"><i class="bx bx-show-alt me-1"></i> View</a>
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
            <input type="date" id="dobBackdrop" class="form-control" >
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

<!-- End Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasEndLabel" class="offcanvas-title">Offcanvas End</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body my-auto mx-0 flex-grow-0">
    <p class="text-center">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</p>
    <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
    <button type="button" class="btn btn-label-secondary d-grid w-100" data-bs-dismiss="offcanvas">Cancel</button>
  </div>
</div>
@endsection