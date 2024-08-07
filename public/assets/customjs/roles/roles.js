
$(function () {
    $('#list-data').DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "desc"]],
        ajax: '/list-data-roles',
        columns: [
            {
                data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'name', name: 'name' },
            {
                render: function (data, type, row) {
                    return row['total'] + ' Permission'
                },
                "className": 'text-center',
                "orderable": false,
                "data": 'total',
            },
            {
                render: function (data, type, row) {
                    if(row['id']!=1){
                        var editButton = authUserCanEditRoles ?'<a href="/roles/' + row['id'] + '/edit" class="btn btn-success"><i class="fa fa-wrench"></i></a>' : '';
                        var deleteButton = authUserCanDeleteRoles ?' <button class="btn btn-danger" onclick="hapusdata(' + row['id'] + ')"><i class="fa fa-trash"></i></button>' : '';
                        return editButton + ' ' + deleteButton;
                    }else{
                        var editButton = authUserCanEditRoles ?'<a href="/roles/' + row['id'] + '/edit" class="btn btn-success"><i class="fa fa-wrench"></i></a>' : '';
                        return editButton;
                    }

                },
                "className": 'text-center',
                "orderable": false,
                "data": null,
            },
        ],
        pageLength: 10,
        lengthMenu: [[5, 10, 20], [5, 10, 20]]
    });

});

function hapusdata(kode) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })
    swalWithBootstrapButtons.fire({
        title: 'Hapus Data ?',
        text: "Data tidak dapat di pulihkan kembali!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: '/roles/' + kode,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function (response) {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        response.message,
                        'success'
                    )
                    $('#list-data').DataTable().ajax.reload();
                },
                error: function (xhr, status, error,response) {
                    swalWithBootstrapButtons.fire(
                        'Gagal!',
                        'Role gagal dihapus, masih ada user terkait',
                        'error'
                    )
                }
            });
        }
    })
}
window.hapusdata = hapusdata;
