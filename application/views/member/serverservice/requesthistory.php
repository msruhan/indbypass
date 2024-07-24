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
                <a href="#">Server Orders </a>
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
                        <table id="table_data_server" class="table table-sm table-striped table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Service</th>
                                <th>Code</th>
                                <th>Email</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</style>
<!-- Select2 -->
<script type="text/javascript">
var base_url = "<?= base_url() ?>";
$(document).ready(function() {

    const windowWidth = window.innerWidth;
    if(windowWidth > 500){
        $('.table-responsive').removeClass('p-0');
    }

    $("#table_data_server").DataTable().destroy();
    new DataTable('#table_data_server', {

        ajax: {
            url: base_url + "member/dashboard/serverorder_new",
            type: 'POST',
            "data": {}
        },
        columns: [
            { data: "no" },
            { data: "service" },
            { data: "code" },
            { data: "email" },
            { data: "note" },
            { data: "status" },
            { data: "created_at" },
        ],

        pagingType: "input",
        "processing": true,
        "serverSide": true,
        bInfo: false,
        ordering: false,
        deferRender: true,
        searching: true,
    });
});
</script>