
const numberFormatter = new Intl.NumberFormat('en-US', {
    style: 'decimal',
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
});
const incomeLogTable = $('#incomeLogTable')

incomeLogTable.DataTable({
    processing: true,
    serverSide: true,
    "order": [
        [1, "asc"]
    ],
    ajax: window.location.pathname,
    columns: [{
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
        data: 'actual_incomes_sum_amount',
        render: function (data, type, row) {
            return `<td>&#8369; ${numberFormatter.format(data)} 
                    <button class="btn btn-light btn-sm"><i class="bx bx-plus mb-2"></button></td>`
        }
    },
    {
        data: 'diff',
        render: function (data, type, row) {
            let diff = row.actual_incomes_sum_amount - row.expected_income;
            if (diff >= 0) {
                return `<span class="badge bg-success">&#8369; ${numberFormatter.format(diff)}</span>`
            } else {
                return `<span class="badge bg-label-danger">&#8369; ${numberFormatter.format(diff)}</span>`
            }
        }
    },
    {
        data: 'final',
        render: function (data, type, row) {
            return `<td>&#8369; ${numberFormatter.format(row.actual_incomes_sum_amount)}</td>`
        }
    },
    {
        data: 'remaining',
        render: function (data, type, row) {
            return `<td>&#8369; ${numberFormatter.format(row.actual_incomes_sum_amount)}</td>`
        }
    },
    {
        data: 'action',
        name: 'action'
    },
    ]
})

/**
 * Submit Add Income Log Form
 */
let addNewLogForm = document.querySelector("#addNewLogForm");
addNewLogForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const formFields = e.target.elements

    let formData = {
        income_date: formFields.income_date.value,
        income_category: formFields.income_category.value,
        income_type: formFields.income_type.value,
        expected_income: formFields.expected_income.value.replace(/,/g, ""),
        actual_income: formFields.actual_income.value.replace(/,/g, ""),
    };

    fetch('/income/logs/store', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify(formData),
    })
        .then(response => response.json())
        .then(data => {
            toastr.success('Income log successfully added!', 'Spend Smartly Says:')
            setTimeout(function(){ incomeLogTable.DataTable().ajax.reload(null, false) }, 2000);
            setTimeout(function(){ toastr.clear() }, 5000);
            const incomeLogOffcanvas = bootstrap.Offcanvas.getInstance('#incomeLogOffcanvas')
            setTimeout(function(){ incomeLogOffcanvas.hide(); }, 1000);
            addNewLogForm.reset();
        })
        .catch(error => {
            console.error('Error:', error);
        });
});