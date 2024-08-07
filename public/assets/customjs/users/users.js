
$(function () {
    $('#list-data').DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "desc"]],
        ajax: '/list-data-users',
        columns: [
            {
                data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'name', name: 'name' },
            { data: 'username', name: 'username' },
            { data: 'email', name: 'email' },
            { data: 'levelnama', name: 'levelnama' },
            {
                render: function (data, type, row) {
                    var editButton = authUserCanEditUsers ? '<a href="/users/' + row['id'] + '/edit" class="btn btn-success"><i class="fa fa-wrench"></i></a>':'';
                    var deleteButton = authUserCanDeleteUsers ?'<button class="btn btn-danger" onclick="hapusdata(' + row['id'] + ')"><i class="fa fa-trash"></i></button>':'';
                    return editButton + ' ' + deleteButton;
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
                url: '/users/' + kode,
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
                        'Deleted!',
                        'Delete failed',
                        'error'
                    )
                    $('#list-data').DataTable().ajax.reload();
                }
            });
        }
    })
}
window.hapusdata = hapusdata;
