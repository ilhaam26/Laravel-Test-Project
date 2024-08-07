
$(function () {
    $('#list-data').DataTable({
        processing: true,
        serverSide: true,
        order: [[0, "desc"]],
        ajax: '/list-data-employee',
        columns: [
            {
                data: 'id', render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'first_name'},
            {data:'last_name'},
            {data:'email'},
            {data:'phone_number'},
            {data:'date_of_birth'},
            {data:'current_position'},
            {
                render: function (data, type, row) {
                    var editButton = authUserCanEditEmployee ? '<a href="/employee/' + row['id'] + '/edit" class="btn btn-success"><i class="fa fa-pencil"></i></a>':'';
                    var deleteButton = authUserCanDeleteEmployee ?'<button class="btn btn-danger" onclick="hapusdata(' + row['id'] + ')"><i class="fa fa-trash"></i></button>':'';
                    var viewButton = authUserCanViewEmployee ? '<a href="/employee/' + row['id'] + '" class="btn btn-info"><i class="fa fa-eye"></i></a>' : '';
                    return   viewButton+' '+ editButton + ' ' + deleteButton;
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
                url: '/employee/' + kode,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                error: function () {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    $('#list-data').DataTable().ajax.reload();
                },
                success: function () {
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
