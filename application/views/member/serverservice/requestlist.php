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

.table>tbody>tr>td{
    padding: 0px !important;
}
</style>
<div class="page-header">
    <div class="d-flex justify-content-between">
        <h3 class="fw-bold">Server Services</h3>
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
                                    <th style="width: 0%;">Price</th>
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