$('#tblresult').DataTable({
    "processing": true,
    "serverSide": true,
    "dataType": 'json',
    "ajax": {
        "url": "/vocabulary/getall",
        "type": "GET",
        "dataSrc": function(json){
            var index = 0;
            json.data.forEach(element => {
                element.status = element.status == true ? "Hoạt động" : "Không hoạt đông";
                element.Method = `<a class=" my-method-button btnEdit fa-hover"    title="Sửa loại tài khoản" ><i class="fa fa-edit"></i></a> &nbsp
                                 <a class=" my-method-button btnDelete fa-hover"    title="Xóa loại tài khoản" ><i class="fa fa-trash-o"></i></a>`;
                index++;
            });
            return json.data;
        },
    },
    "columnDefs": [
        {
            "visible": false,
            "targets": 1
        },
        {
            "className": "text-center",
            "orderable": false,
            "targets": [0,6,7,9]
        },
        // {
        //     "targets": 5,
        //     "render": function(data) {
        //         return '<img src="'+ data + '" alt="IMG" style="width:200px">'
        //     }
        // }
    ],
    columns: [
        { data: null },
        { data: "id" },
        { data: "word" },
        { data: "spelling" },
        { data: "type" },
        { data: "mean" },
        { data: "views" },
        { data: "rate" },
        { data: "status" },
        { data: "Method" },
    ],
    bAutoWidth: false,
    fnRowCallback: (nRow, aData, iDisplayIndex) => {
        $("td:first", nRow).html(iDisplayIndex + 1);
        return nRow;
    },
    "language": {
        "sLengthMenu": "Số bản ghi hiển thị trên 1 trang _MENU_ ",
        "sInfo": "Hiển thị từ _START_ đến _END_ của _TOTAL_ bản ghi",
        "search": "Tìm kiếm:",
        "oPaginate": {
            "sFirst": "Đầu",
            "sPrevious": "Trước",
            "sNext": "Tiếp",
            "sLast": "Cuối"
        }
    },
});

$("#btnAdd").click(function () {
    $("#idx").val('');
    $("#word").val('');
    $("#spelling").val('');
    $("#type").val('');
    $("#mean").val('');
    $("#status").val(0);
    $("#appdetail").modal('show');
    $("#modalTitle").html('Thêm mới từ vựng');
});

$("#tblresult").on("click", ".btnEdit", function () {
    // x('sss');
    //message().success("demo");
    var obj = $("#tblresult").DataTable().row($(this).parents('tr')).data();
    $("#idx").val(obj.id);
    $("#word").val(obj.word);
    $("#spelling").val(obj.spelling );
    $("#type").val(obj.type);
    $("#mean").val(obj.mean );
    $("#status").val(obj.status == 'Hoạt động' ? '1' : '0');
    $("#modalTitle").html('Sửa từ vựng');
    $("#appdetail").modal('show');
});


