<style>
    @media screen and (max-width: 767px) {
        .main-panel .page-header .breadcrumbs {
            margin-left: 0;
            padding-top: 5px;
            padding-left: 5px;
            padding-bottom: 0;
            border-left: 0;
        }

        p {
            font-size: 10px;
        }

        .table thead th {
            font-size: 10px;
        }

        .card-header .card-title {
            font-size: 12px;
        }

        .card .card-body, .card-light .card-body {
            padding-top: 0px;
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

    .table>tbody>tr>td{
        padding: 0px !important;
    }


    table.dataTable.table-sm .sorting:after, table.dataTable.table-sm .sorting_asc:after, table.dataTable.table-sm .sorting_desc:after {
        padding-top: 10px;
    }

    table.dataTable.table-sm .sorting:before, table.dataTable.table-sm .sorting_asc:before, table.dataTable.table-sm .sorting_desc:before {
        top: 5px;
        right: 10px;
    }
</style>
<div class="page-header">
    <div class="d-flex justify-content-between">
        <h5 class="fw-bold">Server Services</h5>
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
                <a href="#">Server Services</a>
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Server Services List</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive p-0">
                        <!-- Projects table -->
                        <table id="table_data" class="table table-sm table-hover"
                            style="width:100%;font-size:32px">
                            <thead>
                                <tr>
                                    <th style="width: 100%;">Service</th>
                                    <th style="width: 0%;">Delivery Time</th>
                                    <th style="width: 0%;">Price&nbsp;(<?= $this->session->userdata('MemberCurrency') ?>)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

    const base_url = "<?= base_url() ?>";

    const windowWidth = window.innerWidth;
    if (windowWidth > 500) {
        $('.table-responsive').removeClass('p-0');
    }

    $("#table_data").DataTable().destroy();
    new DataTable('#table_data', {

        ajax: {
            url: base_url + "member/serverrequest/listservicesdata",
            type: 'POST',
            "data": {}
        },
        columns: [
            {
                data: "title",
                orderable: true
            },
            {
                data: "delivery_time",
                orderable: false
            },
            {
                data: "price",
                orderable: false
            }
        ],

        pagingType: "input",
        "processing": true,
        "serverSide": true,
        bInfo: false,
        ordering: true,
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
        },
    });
});

function detail_service(slug,id) {

    window.location.href = "<?= base_url() ?>member/serverrequest/detail/" + slug + "/" + id
}
</script>