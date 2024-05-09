let table = new DataTable('#inventoryTable', {
    layout: {
        topStart: {
            buttons: [
                {
                    extend: 'csv',
                    text: 'Export Csv',
                    className: 'btn btn-success',
                    filename: 'inventory_csv_report',
                    exportOptions: {
                        columns: ':not(.action_btns)'
                    }
                },
                {
                    extend: 'excel',
                    text: 'Export Excel',
                    className: 'btn btn-success',
                    filename: 'inventory_excel_report',
                    exportOptions: {
                        columns: ':not(.action_btns)'
                    }
                },
                {
                    text: 'Import Csv',
                    className: 'btn btn-dark',
                    action: function() {
                        $('#file-import').trigger('click');
                    }
                },
                // {
                //     text: 'Import Excel',
                //     className: 'btn btn-dark',
                //     action: function() {
                //         $('#excel-import').trigger('click');
                //     }
                // },
            ]
        },
    },
});

let roleTable = new DataTable('#roleTable');
let permissionTable = new DataTable('#permissionTable');
let rolePermissionTable = new DataTable('#rolePermissionTable');

$('#file-import').on('change', function(e) {
    var file = e.target.files[0];
    if (file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var data = e.target.result;
            var lines = data.split(/\r\n|\n/);
            var headers = lines[0].split(',');
            var tableData = [];
            for (var i = 1; i < lines.length; i++) {
                var row = lines[i].split(',');
                row = row.map(value => value.replace(/^"(.+(?="$))"$/, '$1'));
                if (row.length === headers.length) {
                    tableData.push(row);
                }
            }
            $.ajax({
                url: '/create-product',
                type: 'POST',
                data: { data: tableData },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    Swal.fire({
                        title: "Data Imported!",
                        text: "Data imported successfully",
                        icon: "success",
                        willClose: () => {
                            location.reload();
                        }
                    });
                },
            });
        };
        reader.readAsText(file);
    }
});

// $('#excel-import').on('change', function(e) {
//     var file = e.target.files[0];
//     if (file) {
//         var reader = new FileReader();
//         reader.onload = function(e) {
//             var data = e.target.result;
//             $.ajax({
//                 url: '/excel-import',
//                 type: 'POST',
//                 data: { data },
//                 headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
//                 success: function(response) {
//                     Swal.fire({
//                         title: "Data Imported!",
//                         text: "Data imported successfully",
//                         icon: "success",
//                         willClose: () => {
//                             location.reload();
//                         }
//                     });
//                 },
//             });
//         };
        
//     }
// });

/* Clears the items */
$(document).on('click',"#new_item_btn", function(){
    $('#modalHeader').text('Add new item');
    $('#modalRoleHeader').text('Add new role');
    $('#modalPermHeader').text('Add new permission');
    $('#save_item, #save_role_item, #save_role_permission').text('Save');   
    $('#name,#description,#quantity_in_stock,#price').val(''); 
    $('#role_name, #permission_name').val('');
});

/* Adding/updating new inventory items */
$(document).on('submit','#add_item_form',function(e){
    e.preventDefault();
    let formData = $('#add_item_form').serialize();
    let id_value = $('#product_id_val').val();
    if (id_value != '') {
        $.ajax({
            url: '/update-product/'+id_value,
            type: 'POST',
            data: formData,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {
                $('#addItemModal').hide();
                Swal.fire({
                    title: "Updated!",
                    text: "Data has been updated",
                    icon: "success",
                    willClose: () => {
                        location.reload();
                    }
                });
            }
        });
    } else {
        $.ajax({
            url: '/create-product',
            type: 'POST',
            data: formData,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {
                $('#addItemModal').hide();
                Swal.fire({
                    title: "Added!",
                    text: "New Data item has been added",
                    icon: "success",
                    willClose: () => {
                        location.reload();
                    }
                });
            }
        });
    }
});

/* Edit the inventory items */
$(document).on('click','#edit_btn', function(){
    let id = $(this).data('id');
    $.ajax({
        url: '/edit-product/'+id,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(response) {
            $('#product_id_val').val(response.id);
            $('#addItemModal').modal('show');
            $('#modalHeader').text('Edit an item');
            $('#save_item').text('Update')   
            $('#name').val(response.name); 
            $('#description').val(response.description); 
            $('#quantity_in_stock').val(response.quantity_in_stock); 
            $('#price').val(response.price); 
        }
    });
});

/* Delete the inventory item  */
$(document).on('click','#delete_btn', function(){
    let id = $(this).data('id');
    $.ajax({
        url: '/delete-product/'+id,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(response) {
            Swal.fire({
                title: "Deleted!",
                text: "The data has been deleted",
                icon: "success",
                willClose: () => {
                    location.reload();
                }
            });
        }
    });
});

/* Adding/updating new role item */
$(document).on('submit','#add_role_form',function(e){
    e.preventDefault();
    let formData = $('#add_role_form').serialize();
    let id_value = $('#role_id_val').val();
    if (id_value != '') {
        $.ajax({
            url: '/update-role/'+id_value,
            type: 'POST',
            data: formData,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {
                $('#roleItemModal').hide();
                Swal.fire({
                    title: "Role Updated!",
                    icon: "success",
                    willClose: () => {
                        location.reload();
                    }
                });
            }
        });
    } else {
        $.ajax({
            url: '/create-role',
            type: 'POST',
            data: formData,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {
                $('#roleItemModal').hide();
                Swal.fire({
                    title: "Role Added!",
                    icon: "success",
                    willClose: () => {
                        location.reload();
                    }
                });
            }
        });
    }
});

/* Edit the role */
$(document).on('click','#edit_role_btn', function(){
    let id = $(this).data('id');
    $.ajax({
        url: '/edit-role/'+id,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(response) {
            $('#role_id_val').val(response.id);
            $('#roleItemModal').modal('show');
            $('#modalRoleHeader').text('Edit an item');
            $('#save_role_item').text('Update');   
            $('#role_name').val(response.role_name); 
        }
    });
});

/* Delete the role  */
$(document).on('click','#delete_role_btn', function(){
    let id = $(this).data('id');
    $.ajax({
        url: '/delete-role/'+id,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(response) {
            Swal.fire({
                title: "Role Deleted!",
                icon: "success",
                willClose: () => {
                    location.reload();
                }
            });
        }
    });
});

/* Adding/updating new permission */
$(document).on('submit','#add_permission_form',function(e){
    e.preventDefault();
    let formData = $('#add_permission_form').serialize();
    let id_value = $('#permission_id_val').val();
    if (id_value != '') {
        $.ajax({
            url: '/update-permission/'+id_value,
            type: 'POST',
            data: formData,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {
                $('#permissionModal').hide();
                Swal.fire({
                    title: "Permission Updated!",
                    icon: "success",
                    willClose: () => {
                        location.reload();
                    }
                });
            }
        });
    } else {
        $.ajax({
            url: '/create-permission',
            type: 'POST',
            data: formData,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {
                $('#permissionModal').hide();
                Swal.fire({
                    title: "Permission Added!",
                    icon: "success",
                    willClose: () => {
                        location.reload();
                    }
                });
            }
        });
    }
});

/* Edit the permission */
$(document).on('click','#edit_perm_btn', function(){
    let id = $(this).data('id');
    $.ajax({
        url: '/edit-permission/'+id,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(response) {
            $('#permission_id_val').val(response.id);
            $('#permissionModal').modal('show');
            $('#modalPermHeader').text('Edit an item');
            $('#save_permission').text('Update');   
            $('#permission_name').val(response.permission_name); 
        }
    });
});

/* Delete the permission  */
$(document).on('click','#delete_perm_btn', function(){
    let id = $(this).data('id');
    $.ajax({
        url: '/delete-permission/'+id,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(response) {
            Swal.fire({
                title: "Permission Deleted!",
                icon: "success",
                willClose: () => {
                    location.reload();
                }
            });
        }
    });
});

/* Adding/updating new rolepermission */
// $(document).on('submit','#add_permission_form',function(e){
//     e.preventDefault();
//     let formData = $('#add_permission_form').serialize();
//     let id_value = $('#permission_id_val').val();
//     if (id_value != '') {
//         $.ajax({
//             url: '/update-permission/'+id_value,
//             type: 'POST',
//             data: formData,
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             success: function(response) {
//                 $('#permissionModal').hide();
//                 Swal.fire({
//                     title: "Permission Updated!",
//                     icon: "success",
//                     willClose: () => {
//                         location.reload();
//                     }
//                 });
//             }
//         });
//     } else {
//         $.ajax({
//             url: '/create-permission',
//             type: 'POST',
//             data: formData,
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             success: function(response) {
//                 $('#permissionModal').hide();
//                 Swal.fire({
//                     title: "Permission Added!",
//                     icon: "success",
//                     willClose: () => {
//                         location.reload();
//                     }
//                 });
//             }
//         });
//     }
// });

/* Edit the rolepermission */
$(document).on('click','#edit_perm_btn', function(){
    let id = $(this).data('id');
    $.ajax({
        url: '/edit-role-permission/'+id,
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(response) {
            $('#permission_id_val').val(response.id);
            $('#rolesPermissionModal').modal('show');
            // $('#modalRolePermHeader').text('Edit an item');
            // $('#save_role_permission').text('Update');   
            // $('#permission_name').val(response.permission_name); 
        }
    });
});

// /* Delete the rolepermission  */
// $(document).on('click','#delete_perm_btn', function(){
//     let id = $(this).data('id');
//     $.ajax({
//         url: '/delete-permission/'+id,
//         type: 'POST',
//         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//         success: function(response) {
//             Swal.fire({
//                 title: "Permission Deleted!",
//                 icon: "success",
//                 willClose: () => {
//                     location.reload();
//                 }
//             });
//         }
//     });
// });
// ----------------------------------------------