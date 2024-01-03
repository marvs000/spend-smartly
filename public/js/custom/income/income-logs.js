
let offcanvasTriggerSource = "";
let currentId = 0;
let addLogButton = document.querySelector(".add-log")
let editLogButton = document.querySelector(".edit-log")

const numberFormatter = new Intl.NumberFormat('en-US', {
    style: 'decimal',
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
});
const incomeLogTable = $('#incomeLogTable')

let incomeLogDataTable = incomeLogTable.DataTable({
    processing: true,
    serverSide: true,
    "order": [
        [1, "asc"]
    ],
    ajax: {
        url: window.location.pathname,
        data: function (d) {
          return $.extend({}, d, {
            "month": $("#month").val(),
            "year": $("#year").val()
          });
        }
    },
    columns: [
        {
            data: 'id',
            name: 'id'
        },
        {
            data: 'income_date',
            render: function (data, type, row) {
                return `<td>${moment(data).format("MMM. D, Y")}</td>`
            }
        },
        {
            data: 'category',
            name: 'category.title'
        },
        {
            data: 'type',
            name: 'type.title'
        },
        {
            data: 'expected_income',
            render: function (data, type, row) {
                return `<td>&#8369; ${numberFormatter.format(data)}</td>`
            }
        },
        {
            data: 'actual_income',
            render: function (data, type, row) {
                return `<td>&#8369; ${numberFormatter.format(data)}</td>`
            }
        },
        {
            data: 'diff',
            render: function (data, type, row) {
                // let diff = (row.actual_income || 0) - row.expected_income;
                if (data >= 0) {
                    return `<span class="badge py-2 px-2 bg-success">&#8369; ${numberFormatter.format(data)}</span>`
                } else {
                    return `<span class="badge py-2 px-2 bg-label-danger">&#8369; ${numberFormatter.format(data)}</span>`
                }
            }
        },
        {
            data: 'action',
            name: 'action'
        },
    ],
    fnDrawCallback: function(oSettings) {
        const actionTooltipTriggerList = document.querySelectorAll('.action-tooltip')
        const actionTooltipList = [...actionTooltipTriggerList].map(actionTooltipTriggerEl => new bootstrap.Tooltip(actionTooltipTriggerEl))
        
        // Highlight the row on create or update
        const rows = incomeLogDataTable.rows().nodes();
        rows.each(function(index, element) {
            const rowData = incomeLogDataTable.row(element).data();

            if (rowData && rowData.created_or_updated) {
                $(element).addClass('highlight-row');

                // Remove highlight after 3 seconds
                setTimeout(function() {
                    $(element).removeClass('highlight-row');
                }, 3000);
            }
        });
    }
})

$(document).ready(function(){
    // Redraw the table
    incomeLogDataTable.draw();
    
    // Redraw the table based on the custom input
    $('#year, #month').bind("keyup change", function(){
        incomeLogDataTable.draw();
    });
});

$(document).on('click', '.open-form-btn', function(e) {
    let offcanvasTriggerSource = $(this).data('oc-trigger')
    let incomeLogTitle = document.querySelector('#incomeLogTitle')

    if (offcanvasTriggerSource === 'add-log') {
        incomeLogTitle.innerText = 'Add New Income Log'
        document.querySelector("#incomeLogForm").dataset.formtype = offcanvasTriggerSource
        document.querySelector("#incomeLogForm").dataset.id = null
    }
    if (offcanvasTriggerSource === 'edit-log') {
        incomeLogTitle.innerText = 'Edit Income Log'
        let id = $(this).data('id')

        
        document.querySelector("#incomeLogForm").dataset.formtype = offcanvasTriggerSource
        document.querySelector("#incomeLogForm").dataset.id = id

        fetch(`/income/logs/edit/${id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        })
            .then(response => response.json())
            .then(data => {
                let res = data.result
                document.querySelector('[name="income_date"]').value = res.income_date
                $("#income_category").val(res.income_category)
                $("#income_category").trigger('change')
                $("#income_type").val(res.income_type)
                $("#income_type").trigger('change')
                document.querySelector('[name="expected_income"]').value = res.expected_income
                document.querySelector('[name="actual_income"]').value = res.actual_income
            })
            .catch(error => {
                toastr.warning(error, 'Spend Smartly Says:')
            });
    }
})

$(document).on('click', '.delete-log-btn', function(e) {
    let id = $(this).data('id')
    $.confirm({
        title: 'Sure \'bout that ?',
        content: 'Are you sure you want to delete this Income Log ?',
        buttons: {
            confirm: {
                text: 'Delete',
                btnClass: 'btn-danger',
                keys: ['enter', 'shift'],
                action: function() {
                    fetch(`/income/logs/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    })
                        .then(response => response.json())
                        .then(data => {
                            incomeLogTable.DataTable().ajax.reload(null, false)
                            toastr.success('Income Log successfully deleted!', 'Spend Smartly Says:')
                        })
                        .catch(error => {
                            toastr.warning(error, 'Spend Smartly Says:')
                        });
                    // $.alert('Deleted');
                }
            },
            cancel: function () {
                //
            }
        }
    });
})

const incomeLogOffcanvas = document.querySelector('#incomeLogOffcanvas')
incomeLogOffcanvas.addEventListener('hide.bs.offcanvas', event => {
    document.querySelector("#incomeLogForm").reset();
    $("#income_category").val('default')
    $("#income_category").trigger('change')
    $("#income_type").val('default')
    $("#income_type").trigger('change')
})

/**
 * Submit Income Log Form
 */
let incomeLogForm = document.querySelector("#incomeLogForm");
incomeLogForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const formFields = e.target.elements

    let formData = {
        income_date: formFields.income_date.value,
        income_category: formFields.income_category.value,
        income_type: formFields.income_type.value,
        expected_income: formFields.expected_income.value.replace(/,/g, ""),
        actual_income: formFields.actual_income.value.replace(/,/g, ""),
        created_or_updated: true
    };

    let form_type = incomeLogForm.dataset.formtype
    let method = ''
    let endpoint = ''
    let message = ''

    if (form_type === 'add-log') {
        method = 'POST'
        endpoint = '/income/logs/store'
        message = 'Income log successfully added!'
    }
    if (form_type === 'edit-log') {
        method = 'PUT'
        endpoint = `/income/logs/update/${incomeLogForm.dataset.id}`
        message = 'Income log successfully updated!'
    }
    console.log({form_type, method, endpoint, message})

    fetch(endpoint, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify(formData),
    })
        .then(response => response.json())
        .then(data => {
            toastr.success(message, 'Spend Smartly Says:')
            setTimeout(function(){ incomeLogTable.DataTable().ajax.reload(null, false) }, 2000);
            setTimeout(function(){ toastr.clear() }, 5000);
            const incomeLogOffcanvas = bootstrap.Offcanvas.getInstance('#incomeLogOffcanvas')
            setTimeout(function(){ incomeLogOffcanvas.hide(); }, 1000);
        })
        .catch(error => {
            toastr.warning(error, 'Spend Smartly Says:')
        });
});