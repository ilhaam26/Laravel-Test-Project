
$(function () {
    $('#list-data').DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "desc"]],
        ajax: '/list-data-permission',
        columns: [
            {
                data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'name', name: 'name' },
            { data: 'permission_grub', name: 'permission_grub' },
            {
                render: function (data, type, row) {
                    var editButton = authUserCanEditPermission ? '<button type="button" onclick="editdata(' + row['id'] + ')" class="btn btn-success"><i class="fa fa-wrench"></i></button>' : '';
                    var deleteButton = authUserCanDeletePermission ?'<button class="btn btn-danger" onclick="hapusdata(' + row['id'] + ')"><i class="fa fa-trash"></i></button>':'';
                    return editButton + ' ' + deleteButton;
                },
                "className": 'text-center',
                "orderable": false,
                "data": null,
            }
        ],
        pageLength: 20,
        lengthMenu: [[20, 50, 100, 500], [20, 50,100, 500]]
    });

});

//=====================================================================================================
function editdata(kode) {
    $.ajax({
        type: 'GET',
        url: '/permission/' + kode + '/edit',
        success: function (data) {
            $.each(data, function (key, value) {
                $('#editform').attr('action', '/permission/' + value.id);
                $('#permission').val(value.name);
                $('#permission_grub').val(value.permission_grub);
            });
            $('#modal-edit').modal('show');
        }, complete: function () {
        },
        error: function () {
            swalWithBootstrapButtons.fire(
                'Oops!',
                'Edit Failed',
                'error'
            )
        }
    });
}

//=====================================================================================================
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
                url: '/permission/' + kode,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function () {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    $('#list-data').DataTable().ajax.reload();
                },
                error: function () {
                    swalWithBootstrapButtons.fire(
                        'Oops!',
                        'Deleted Failed',
                        'error'
                    )
                    $('#list-data').DataTable().ajax.reload();
                }
            });
        }
    })
}
