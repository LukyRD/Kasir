let table;

$(function () {
    $(".table").DataTable({
        processing: true,
        autoWidth: false,
    });

    $("#modal-form").on("submit"),
        function () {
            $.ajax({
                url: $("#modal-form form").attr("action"),
                type: "post",
                data: $("#modal-form form").serialize(),
            });

            $("#modal-form").modal("hide");
            table.ajax.reload();
        };
});

function addForm(url) {
    $("#modal-form").modal("show");
    $("#modal-form .modal-title").text("Tambah Kategori");

    $("#modal-form form")[0].reset();
    $("#modal-form form").attr("action", url);
    $("#modal-form [name=_method]").val("post");
    $("modal-form [name=nama_kategori]").focus();
}

function updateForm(url, nama) {
    // alert(url);
    $("#modal-form").modal("show");
    $("#modal-form .modal-title").text("Edit Kategori");

    $("#modal-form form")[0].reset();
    $("#modal-form form").attr("action", url);
    $("#modal-form [name=_method]").val("put");
    $("modal-form [name=nama_kategori]").focus();
    $("#modal-form [name=nama_kategori]").val(nama);
}
