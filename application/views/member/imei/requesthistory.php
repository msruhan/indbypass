
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

        /* Hide "Actions" column on desktop */ 
        /* @media screen and (min-width: 768px) {
            .column-actions {
                display: none;
            }
        } */

        /* Hide "Status", "Detail", and "Service" columns on smartphone */
        @media screen and (max-width: 767px) {
            .column-status, .column-details, .column-service {
                display: none;
            }
        }

        /* Styling Modal */
        .modal-content {
            padding: 0.5rem;
        }
        .modal-header {
            background-color: #007bff;
            color: white;
        }
        .details-container {
            text-align: center; /* Mengatur teks agar berada di tengah */
            padding: 1rem; /* Memberikan padding sekitar konten */
            background-color: #f8f9fa; /* Warna latar belakang opsional */
            border: 1px solid #ddd; /* Border opsional */
            border-radius: 4px; /* Sudut border opsional */
        }
        .details-row {
            margin-bottom: 0.5rem; /* Jarak antar baris */
            font-size: 1rem; /* Ukuran font */
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
                <a href="#">IMEI Orders</a>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header custom-card-header">
                <div class="card-title">IMEI Order History</div>
            </div>
            <div class="card-body custom-card-body">
                <div class="row">
                    <div class="table-responsive p-0">
                        <!-- Projects table -->
                        <table id="table_data_imei" class="table table-sm table-striped table-hover" style="width:100%;font-size:32px">
                            <thead>
                                <tr>
                                    <th class="column-actions" style="width: 1%;"></th>
                                    <th style="width: 1%;">No</th>
                                    <th style="width: 10%;">Date</th>
                                    <th style="width: 10%;">IMEI</th>
                                    <th class="column-service" style="width: 40%;">Service</th>
                                    <th class="column-status" style="width: 5%;">Status</th>
                                    <th class="column-details" style="width: 5%;">Details</th>
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

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
var base_url = "<?= base_url() ?>";

$(document).ready(function() {

// Fungsi untuk memperbarui nilai statusModal dengan badge
function updateStatusModal(status) {
    var badgeClass;
    switch (status) {
        case 'Pending':
            badgeClass = 'bg-warning'; // Kuning
            break;
        case 'Success':
            badgeClass = 'bg-success'; // Hijau
            break;
        case 'Rejected':
            badgeClass = 'bg-danger'; // Merah
            break;
        default:
            badgeClass = 'bg-secondary'; // Abu-abu
    }
    $('#statusModal').html('<span class="badge ' + badgeClass + '">' + status + '</span>'); // Memperbarui konten statusModal dengan badge
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
            className: 'details-control column-actions',
            defaultContent: '<button class="btn btn-secondary btn-round btn-xs toggle-detail"><i class="fas fa-chevron-down"></i></button>',
            orderable: false
        },
        { data: "no" },
        { data: "created_at" },
        { data: "imei" },
        { data: "service", className: 'column-service' },
        { data: "status", className: 'column-status' },
        { data: "detail", className: 'column-details' },
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
$('#table_data_imei tbody').on('click', 'button.toggle-detail', function () {
    var tr = $(this).closest('tr');
    var row = table.row(tr);
    
    if (row.child.isShown()) {
        row.child.hide();
        tr.removeClass('shown');
        $(this).find('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
    } else {
        row.child(format(row.data())).show();
        tr.addClass('shown');
        $(this).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
    }
});

// Format the details to be shown in the row table collapse
function format(d) {
    return `
        <div class="details-container">
            <div class="details-row">
                <strong>Service:</strong> ${d.service}
            </div>
            <div class="details-row">
                <strong>Status:</strong> ${d.status}
            </div>
            <div class="details-row">
                <strong>Details:</strong> ${d.detail}
            </div>
        </div>
    `;
}

// Update modal content when it is opened
$('#detailImeiOrderModal').on('shown.bs.modal', function (e) {
    var status = $('#statusModal').text().trim(); // Assuming status is already set in the modal
    var reply = $('#commentsModal').text().trim(); // Get the value of "Reply" from the modal
    console.log("Status:", status);


    if (status === "Issued") {
        status = "Success";
    } else if (status.toLowerCase() === "canceled") { // Untuk menangani case insensitive
        status = "Rejected";
    }

    updateStatusModal(status);

    // Log the status and reply values to the console
    console.log("Status:", status);
    console.log("Reply:", reply);
});
});

</script>

