<!-- Link CSS Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
/* Responsif Breadcrumbs */
@media screen and (max-width: 767px) {
    .main-panel .page-header .breadcrumbs {
        margin-left: 0;
        padding-top: 5px;
        padding-left: 5px;
        padding-bottom: 0;
        border-left: 0;
    }
}

@media (max-width: 767px) {
    .column-actions {
        display: table-cell;
    },
    .column-details,
    .column-service,
    .column-status {
        display: none;
    }
}

@media (min-width: 768px) {
    .column-actions {
        display: none;
    }
}

/* Tabel Header dan Body */
.table thead th {
    background-color: #f8f9fa;
    color: #343a40;
    border-bottom: 2px solid #dee2e6;
    padding: 15px;
}

.table tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

.table tbody tr:hover {
    background-color: #e9ecef;
}

.table>thead>tr>th {
    padding: 5px !important;
}

.table>tbody>tr>td {
    padding: 5px !important;
}

/* Styling Pagination Input */
input.paginate_input {
    padding: 0.5rem 1rem;
    font-size: 1rem;
    border: 2px solid #007bff;
    border-radius: 0.375rem;
    transition: border-color 0.3s ease;
}

input.paginate_input:focus {
    border-color: #0056b3;
    outline: none;
}

/* Styling Modal */
.modal-content {
    padding: 1.5rem;
}

.modal-header {
    background-color: #007bff;
    color: white;
}

.modal-title {
    font-size: 1.25rem;
}

.modal-body {
    font-size: 1rem;
}

.table th, .table td {
    color: #212529;
    background-color: #fff;
}

/* Responsive Adjustments */
@media screen and (max-width: 767px) {
    .table {
        font-size: 14px;
    }

    .modal-dialog {
        max-width: 90%;
    }
}

/* Status Icons */
.status-icon {
    font-size: 1.2rem;
}

.status-completed::before {
    content: "\2714"; /* Checkmark */
    color: green;
}

.status-pending::before {
    content: "\26A0"; /* Warning */
    color: orange;
}
</style>

<div class="page-header">
    <div class="d-flex justify-content-between">
        <h3 class="fw-bold">IMEI Orders</h3>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">IMEI Orders </a>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">IMEI Order History</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive p-0">
                        <!-- Projects table -->
                        <table id="table_data_imei" class="table table-sm table-striped table-hover" style="width:100%;font-size:32px">
                            <thead>
                                <tr>
                                <th style="width: 5%;">Actions</th>
                                <th style="width: 5%;">No</th>
                                <th class="column-details" style="width: 5%;">Details</th>
                                <th style="width: 15%;">IMEI</th>
                                <th class="column-service" style="width: 50%;">Service</th>
                                <th class="column-status" style="width: 10%;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dynamic rows will be added here by DataTables -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailImeiOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail IMEI Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card card-action mb-4">
                    <div class="collapse show">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <th style="width: 160px;padding-right: 0px !important;">SERVICE </th>
                                        <td class="text-center" style="width: 0px;padding-left: 0px !important;">:</td>
                                        <td id="titleModal" style="padding-left: 0px !important;"></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 160px;padding-right: 0px !important;">IMEI </th>
                                        <td class="text-center" style="width: 0px;padding-left: 0px !important;">:</td>
                                        <td id="imeiModal" style="padding-left: 0px !important;"></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 160px;padding-right: 0px !important;">PRICE </th>
                                        <td class="text-center" style="width: 0px;padding-left: 0px !important;">:</td>
                                        <td id="priceModal" style="padding-left: 0px !important;"></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 160px;padding-right: 0px !important;">DELIVERY TIME </th>
                                        <td class="text-center" style="width: 0px;padding-left: 0px !important;">:</td>
                                        <td id="deliveryModal" style="padding-left: 0px !important;"></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 160px;padding-right: 0px !important;">STATUS </th>
                                        <td class="text-center" style="width: 0px;padding-left: 0px !important;">:</td>
                                        <td id="statusModal" style="padding-left: 0px !important;"></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 160px;padding-right: 0px !important;">REPLY </th>
                                        <td class="text-center" style="width: 0px;padding-left: 0px !important;">:</td>
                                        <td id="commentsModal" style="padding-left: 0px !important;"></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 160px;padding-right: 0px !important;">NOTE </th>
                                        <td class="text-center" style="width: 0px;padding-left: 0px !important;">:</td>
                                        <td id="noteModal" style="padding-left: 0px !important;"></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 160px;padding-right: 0px !important;">CREATED AT </th>
                                        <td class="text-center" style="width: 0px;padding-left: 0px !important;">:</td>
                                        <td id="createdAtModal" style="padding-left: 0px !important;"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk DataTables dan Collapse/Expand -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
var base_url = "<?= base_url() ?>";
$(document).ready(function() {

    const windowWidth = window.innerWidth;
    if(windowWidth > 500){
        $('.table-responsive').removeClass('p-0');
    }

    // Initialize DataTable
    var table = $("#table_data_imei").DataTable({
        ajax: {
            url: base_url + "member/dashboard/listener_new",
            type: 'POST',
            "data": {}
        },
        columns: [
            {
                data: null,
                className: 'details-control',
                defaultContent: '<button class="btn btn-primary">Toggle</button>',
                orderable: false
            },
            { data: "no" },
            { data: "detail" },
            { data: "imei" },
            { data: "service" },
            { data: "status" }
        ],
        pagingType: "input",
        "processing": true,
        "serverSide": true,
        bInfo: false,
        ordering: false,
        deferRender: true,
        searching: true
    });

    // Handle click event for the 'Toggle' button
    $('#table_data_imei tbody').on('click', 'button', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        
        // Check if row is already expanded
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

    // Format the details to be shown in the row
    function format(d) {
        return `
            <div>
                <strong>Service:</strong> ${d.service}<br>
                <strong>Status:</strong> ${d.status}<br>
                <strong>Details:</strong> ${d.detail}
            </div>
        `;
    }
});
</script>
