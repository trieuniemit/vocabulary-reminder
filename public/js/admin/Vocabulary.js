(function ($) {
    $.fn.serializeFormJSON = function () {

        var o = {};
        var a = this.serializeArray().filter(e => e.value !== '');
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
})(jQuery);

var table = $('#tblresult').DataTable({
    responsive: true,
    "processing": true,
    "serverSide": true,
    "dataType": 'json',
    "ajax": {
        "url": "/admin/vocabularymanager/getandfill",
        "type": "GET",
        "dataSrc": function(json){
            var index = 0;
            json.data.forEach(element => {
                element.type = element.means[0] == null ? "" : element.means[0].type;
                element.mean = element.means[0] == null ? "" : element.means[0].mean;
                element.Method = `<a class=" my-method-button btnEdit fa-hover"    title="Sửa loại tài khoản" ><i class="fa fa-edit" style="color:blue"></i></a> &nbsp
                                <a class=" my-method-button btnDelete fa-hover"    title="Xóa loại tài khoản" ><i class="fa fa-trash-o" style="color:red"></i></a>`;
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
            "width": "2%",
            "orderable": false,
            "targets": [0,6,7,8]
        },
        {
            "className": "text-center",
            "width": "50px",
            "orderable": false,
            "targets": 9
        },
        // { "responsivePriority": 2, "targets": 2 },
        {
            "targets": 8,
            "render": function(data) {
                return data == 1 ? `<i class="fa fa-toggle-on" title="Hoạt động" style="color:green"></i>` : `<i class="fa fa-toggle-off" title="Không hoạt động" ></i>`;
            }
        }
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
$.fn.dataTable.Responsive.breakpoints = [
    { name: 'spelling', width: Infinity },
    { name: 'mean',  width: 1024 },
    { name: 'views',  width: 768 }
];
$("#btnAdd").click(function () {
    $("#idx").val(-1);
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
    $("#status").val(obj.status);
    $("#status").niceSelect('update');
    $("#modalTitle").html('Sửa từ vựng');
    $("#appdetail").modal('show');
});

$("#tblresult").on("click", ".btnDelete", function () {
    var obj = $('#tblresult').DataTable().row($(this).parents('tr')).data();
    $("input[name='idx']").val(obj.id);
    $('#appConfirm h4').html("Xóa dữ liệu");
    let q = "Bạn có chắc chắn muốn từ <b>" + obj.word + "</b> không?";
    $("#btnSubmitDetail").html("Xóa")
    $('#appConfirm h5').html(q);
    $("#appConfirm").modal('show');
});

$('#frmPost').submit((e) => {
    e.preventDefault();
    // e.preventDefault();
    var id = $("#idx").val();
    $("#btnSubmitDetail").attr("disabled", true);
    var form = $('#frmPost').serializeFormJSON();
    form.means = {
        mean : form.mean,
        type : form.type,
        vocabulary_id : form.id,
    };
    delete form.mean;
    delete form.type;
    var formData = new FormData();
        $.ajax({
            url: "/admin/vocabularymanager/edit/"+id,
            method: "POST",
            data: form,
        })
        .done((data) => {
            console.log(data)
            if (data.code === 1) {
                $('#tblresult').DataTable().ajax.reload();
                $("#appdetail").modal('hide');
                toastr.success("Cập nhập bản ghi thành công");
            }
            else {
                toastr.error("có lỗi xảy ra vui long thử lại sau->" + data.error);
            }
        })
        .fail(() => {
            $("#appConfirm").modal('hide');
            toastr.error("Xảy ra lỗi, vui lòng tải lại trang!");
        });
    $("#btnSubmitDetail").removeAttr("disabled");
});
toastr.options = {
    "closeButton": true,
    "debug": false,
    "positionClass": "toast-bottom-right",
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "300000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

$('#frmDelete').submit((e) => {
    e.preventDefault();
    $("#btnSubmitConfirm").attr("disabled", true);
    let form = $('#frmDelete').serializeArray();
    var id = $('#idx').val();
    //var guid = $("#txtguid").val();
    $.ajax({
        url: "/admin/vocabularymanager/delete/"+id,
        method: "POST",
        data: form,
        dataType: 'json'
    })
    .done((data) => {
        console.log(data.code);
        if (data.code === 1) {
            $('#tblresult').DataTable().ajax.reload();
            $("#appConfirm").modal('hide');
            toastr.success("Xóa bản ghi thành công");
        }
        else {
            toastr.error("có lỗi xảy ra vui long thử lại sau->" + data.error);
        }

    })
    .fail(() => {
        $('#tblresult').DataTable().ajax.reload();
        $("#appConfirm").modal('hide');
        toastr.error("Xảy ra lỗi, vui lòng tải lại trang!");
    });
    $("#btnSubmitConfirm").removeAttr("disabled");
});

