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
        <h3 class="fw-bold">Server Orders</h3>
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
                <a href="#">Server Orders</a>
            </li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Server Order History</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive p-0">
                        <!-- Projects table -->
                        <table id="table_data_server" class="table table-sm table-striped table-hover" style="width:100%;font-size:32px">
                            <thead>
                                <tr>
                                    <th class="column-actions" style="width: 1%;"></th>
                                    <th style="width: 1%;">No</th>
                                    <th style="width: 10%;">Date</th>
                                    <th style="width: 10%;">Email</th>
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
<div class="modal fade" id="detailServerOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Server Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card card-action mb-4">
                    <div class="collapse show">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <th style="width: 160px;">SERVICE</th>
                                        <td id="serviceModal"></td>
                                    </tr>
                                    <tr>
                                        <th>EMAIL</th>
                                        <td id="emailModal"></td>
                                    </tr>
                                    <tr>
                                        <th>PRICE</th>
                                        <td id="priceModal"></td>
                                    </tr>
                                    <tr>
                                        <th>STATUS</th>
                                        <td id="statusModal"></td>
                                    </tr>
                                    <tr>
                                        <th>CREATED AT</th>
                                        <td id="createdAtModal"></td>
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

<!-- HTML and CSS remains unchanged -->

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    var base_url = "<?= base_url() ?>";
    $(document).ready(function() {
        // Initialize DataTable
        var table = $("#table_data_server").DataTable({
            ajax: {
                url: base_url + "member/dashboard/serverorder_new",
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
                { data: "email" },
                { data: "service", className: 'column-service' },
                { data: "status", className: 'column-status' },
                {
                    data: null,
                    className: 'column-details',
                    defaultContent: '<button class="btn btn-info btn-xs view-detail">View</button>',
                    orderable: false
                }
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
        $('#table_data_server tbody').on('click', 'button.toggle-detail', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            
            // Check if row is already expanded
            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
                $(this).find('i').removeClass('fa-chevron-up').addClass('fa-chevron-down'); // Change to down arrow
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
                $(this).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up'); // Change to up arrow
            }
        });

        // Handle click event for 'View Details' button in the main table column
        $('#table_data_server tbody').on('click', 'button.view-detail', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.data()) { // Check if data exists
                console.log("Row data:", row.data()); // Log data for debugging

                // Populate modal with row data
                $('#serviceModal').text(row.data().service || 'N/A');
                $('#emailModal').text(row.data().email || 'N/A');
                $('#priceModal').text(row.data().price || 'N/A');
                $('#statusModal').html(formatBadge(row.data().status));
                $('#createdAtModal').text(row.data().created_at || 'N/A');

                // Show the modal
                $('#detailServerOrderModal').modal('show');
            } else {
                console.error('No data available for this row.');
            }
        });

        // Format the details to be shown in the row
        function format(d) {
            return `
                <div class="details-container">
                    <div class="details-row">
                        <strong>Service:</strong> ${d.service || 'N/A'}
                    </div>
                    <div class="details-row">
                        <strong>Status:</strong> ${formatBadge(d.status)}
                    </div>
                    <div class="details-row">
                        <strong>Detail:</strong> <button class="btn btn-info btn-xs view-detail-inline">View</button>
                    </div>
                </div>
            `;
        }

        // Handle click event for 'View Details' button in expandable row
        $('#table_data_server tbody').on('click', 'button.view-detail-inline', function () {
            var tr = $(this).closest('tr').prev(); // The row is the previous sibling (because it was expanded)
            var row = table.row(tr);
            
            if (row.data()) { // Check if data exists
                console.log("Row data inline:", row.data()); // Log data for debugging

                // Populate modal with row data
                $('#serviceModal').text(row.data().service || 'N/A');
                $('#emailModal').text(row.data().email || 'N/A');
                $('#priceModal').text(row.data().price || 'N/A');
                $('#statusModal').html(formatBadge(row.data().status));
                $('#createdAtModal').text(row.data().created_at || 'N/A');

                // Show the modal
                $('#detailServerOrderModal').modal('show');
            } else {
                console.error('No data available for this row.');
            }
        });

        function extractTextFromHTML(htmlString) {
            var tempDiv = document.createElement("div");
            tempDiv.innerHTML = htmlString;
            return tempDiv.textContent || tempDiv.innerText || "";
        }

        function formatBadge(status) {
            var normalizedStatus = extractTextFromHTML(status).trim(); // Normalize status by trimming whitespace
            console.log("Normalized status:", normalizedStatus); // Log normalized status for debugging

            switch (normalizedStatus) {
                case 'Success':
                    return "<span class='badge bg-success'>Success</span>";
                case 'Pending':
                    return "<span class='badge bg-warning'>Pending</span>";
                case 'Rejected':
                    return "<span class='badge bg-danger'>Rejected</span>";
                default:
                    return "<span class='badge bg-secondary'>Unknown</span>";
            }
        }

    });
</script>
