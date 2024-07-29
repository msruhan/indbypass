<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMEI Services</title>
    <!-- Include CSS for DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        @media screen and (max-width: 767px) {
            .main-panel .page-header .breadcrumbs {
                margin-left: 0;
                padding-top: 5px;
                padding-left: 5px;
                padding-bottom: 0;
                border-left: 0;
            }
        }

        div.dataTables_wrapper div.dataTables_filter input {
            display: inline-block;
            width: 340px;
            padding: 10px;
        }

        .dataTables_wrapper .dataTables_filter {
            float: left;
        }

        .table>tbody>tr>td {
            padding: 0px !important;
        }

        /* Custom font style for the table */
        .table {
            font-family: 'Arial', sans-serif; /* Ganti dengan font yang diinginkan */
            font-size: 12px; /* Ganti dengan ukuran font yang diinginkan */
            color: #333; /* Ganti dengan warna font yang diinginkan */
            font-weight: normal; /* Ganti dengan 'bold' atau 'normal' sesuai kebutuhan */
        }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="d-flex justify-content-between">
            <h3 class="fw-bold">IMEI Services</h3>
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
                    <a href="#">All Services</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">IMEI Services</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">IMEI Services List</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive p-0">
                            <!-- Projects table -->
                            <table id="table_data" class="table table-sm table-hover"
                                style="width:100%; font-size:8px">
                                <thead>
                                    <tr>
                                        <th style="width: 40%;">Service</th>
                                        <th style="width: 10%;">Delivery Time</th>
                                        <th style="width: 10%;">Price ($)</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Include jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            const base_url = "<?= base_url() ?>"; // Adjust this as needed

            const windowWidth = window.innerWidth;
            if (windowWidth > 500) {
                $('.table-responsive').removeClass('p-0');
            }

            $("#table_data").DataTable().destroy();
            new DataTable('#table_data', {
                ajax: {
                    url: base_url + "member/imeirequest/listservicesdata",
                    type: 'POST',
                    "data": {}
                },
                columns: [
                    {
                        data: "title"
                    },
                    {
                        data: "delivery_time"
                    },
                    {
                        data: "price"
                    }
                ],
                pagingType: "input",
                "processing": true,
                "serverSide": true,
                bInfo: false,
                ordering: false,
                deferRender: true,
                searching: true,
                lengthChange: false,
                language: {
                    search: "",
                    searchPlaceholder: "Search services...",
                },
                drawCallback: function(res) {
                    $('div.dataTables_wrapper div.dataTables_paginate').css('display', 'none');
                    var response = res.json;
                }
            });
        });
    </script>
</body>
</html>
