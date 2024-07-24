
function historyOrderTable(param) {

    $("#historyOrderModal").modal("show");
    $("#table_data_imei").DataTable().destroy();
    new DataTable('#table_data_imei', {

        ajax: {
            url: base_url + "member/imeirequest/listener_new",
            type: 'POST',
            "data": {
                "param": param
            }
        },
        columns: [
            { data: "no" },
            { data: "imei" },
            { data: "service" },
            { data: "code" },
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
}

function detailIMEI(id_order) {

    $.ajax({
        method: "POST",
        dataType: "JSON",
        url: base_url + "member/dashboard/listener_new_detail",
        data: {
            "id_order": id_order
        },
        beforeSend: function () { },
        success: function (res) {
            $("#detailImeiOrderModal").modal("show");

            $("#titleModal").html(res.Title);
            $("#imeiModal").html(res.IMEI);
            $("#priceModal").html(res.Price);
            $("#deliveryModal").html(res.DeliveryTime);
            $("#statusModal").html(res.Status);
            // $("#codeModal").html(res.Code);
            $("#commentsModal").html(res.Comments);
            $("#noteModal").html(res.Note);
            $("#createdAtModal").html(res.CreatedDateTime);

        },
    })
        .done(function (data) { })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.log("Error!!! " + errorThrown);
        });
}