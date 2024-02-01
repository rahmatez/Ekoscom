<script>
function submit(x) {
    if (x == 'add') {
        $('[name="idusers"]').val("");
        $('[name="user_fullname"]').val("");
        $('[name="user_name"]').val("");
        $('[name="user_telp"]').val("");
        $('[name="user_type"]').val("");
        $('#modal_add .modal-title').html('Add New User')
        $('#username').prop('readonly', false);
        $('#password').show();
        $('#btn-tambah').show();
        $('#btn-ubah').hide();
    } else {
        if (x == 1) {
            $('#access').hide();
        } else {
            $('#access').show();
        }
        $('#modal_add .modal-title').html('Edit User')
        $('#username').prop('readonly', true);
        $('#password').hide();
        $('#btn-tambah').hide();
        $('#btn-ubah').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>user/view',
            dataType: 'json',
            success: function(data) {
                $('[name="idusers"]').val(data.idusers);
                $('[name="user_fullname"]').val(data.user_fullname);
                $('[name="user_name"]').val(data.user_name);
                $('[name="user_telp"]').val(data.user_telp);
                if (data.user_type == 'customer') {
                    $('#access').hide();
                } else {
                    $('#access').show();
                }
                $('[name="user_type"]').val(data.user_type);
            }
        });
    }
}

function ubahuser() {
    var idusers = $('[name="idusers"]').val();
    var user_fullname = $('[name="user_fullname"]').val();
    var user_telp = $('[name="user_telp"]').val();
    var user_name = $('[name="user_name"]').val();
    var user_type = $('[name="user_type"]').val();
    $.ajax({
        type: "POST",
        data: {
            idusers: idusers,
            user_fullname: user_fullname,
            user_telp: user_telp,
            user_name: user_name,
            user_type: user_type
        },
        url: '<?=base_url();?>user/updateUser',
        success: function() {
            $('#modal_add').modal('hide');
            toastr.success("Update Successfully");
            setTimeout(() => {
                window.location =
                    "<?=site_url();?>user/alluser";
            }, 2500);
        }
    });
}

function ubah_password(x) {
    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=base_url();?>user/view',
        dataType: 'json',
        success: function(data) {
            $('[name="idusers"]').val(data.idusers);
            // $('[name="user_password"]').val(data.user_password);
        }
    });
    if (x == 'ganti') {
        // var table = 'produk';
        // var id = $('[name="id"]').val();
        var action = '<?= base_url(); ?>user/changepassword';
        $('#form-ganti-password').attr('action', action).submit();
    }
}

// function hapus_data(x) {
//     $.ajax({
//         type: "POST",
//         data: {
//             id: x
//         },
//         url: '<?=base_url();?>admin/kategoriId',
//         dataType: 'json',
//         success: function(data) {
//             $('[name="id"]').val(data.id);
//         }
//     });
//     if (x == 'delete') {
//         var table = 'kategori_produk';
//         var redirect = 'kategori';
//         var id = $('[name="id"]').val();
//         var action = '<?= base_url(); ?>admin/hapus_data?t=' + table + '&id=' + id + '&r=' + redirect;
//         $('#form-hapus').attr('action', action).submit();
//     }
// }

// function edit(id) {
//     $.ajax({
//         type: "POST",
//         data: {
//             id: id
//         },
//         url: '<?=base_url();?>category/view',
//         dataType: 'json',
//         success: function(data) {
//             $('[name="id"]').val(data.id);
//             $('[name="category_name"]').val(data.category_name);
//             $('[name="category_description"]').val(data.category_description);
//             $('#image').hide();
//             var img = '<img src="<?=base_url();?>uploads/category/' + data.category_image +
//                 '" width="100" height="100"';
//             $('#view_image').html(img);
//         }
//     });
// }
$(function() {
    // $('#delete_all').click(function() {
    //     $('#modal_delete').modal('show', {
    //         backdrop: 'static',
    //         keyboard: false
    //     });
    //     $('#deleted').click(function() {
    //         var delete_check = $('.check:checked');
    //         if (delete_check.length > 0) {
    //             var delete_value = [];
    //             $(delete_check).each(function() {
    //                 delete_value.push($(this).val());
    //             });
    //             $.ajax({
    //                 url: '<?=site_url();?>product/delete',
    //                 method: 'produk',
    //                 data: {
    //                     id: delete_value
    //                 },
    //                 success: function() {
    //                     $('#modal_delete').modal('hide');
    //                     toastr.success("Deleted Successfully");
    //                     setTimeout(() => {
    //                         window.location =
    //                             "<?=site_url();?>product?s=delete";
    //                     }, 2500);
    //                 }
    //             })
    //         } else {
    //             $('#modal_delete').modal('hide');
    //             toastr.warning("Please Select Data To Deleted !");
    //         }
    //     })
    // });
    $('#block_all').click(function() {
        $('#modal_block').modal('show', {
            backdrop: 'static',
            keyboard: false
        });
        $('#blocked').click(function() {
            var block_check = $('.check:checked');
            if (block_check.length > 0) {
                var block_value = [];
                $(block_check).each(function() {
                    block_value.push($(this).val());
                });

                $.ajax({
                    type: 'post',
                    url: '<?=base_url();?>user/block',
                    data: {
                        id: block_value
                    },
                    success: function() {
                        $('#modal_block').modal('hide');
                        toastr.success("Block User Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>user/alluser";
                        }, 2500);
                    }
                })
            } else {
                $('#modal_block').modal('hide');
                toastr.warning("Please Select User To Blocked!");
            }
        })
    });
    $('#restore_all').click(function() {
        var restore_check = $('.check:checked');
        if (restore_check.length > 0) {
            var restore_value = [];
            $(restore_check).each(function() {
                restore_value.push($(this).val());
            });
            $.ajax({
                type: 'post',
                url: '<?=site_url();?>user/unblock',
                data: {
                    id: restore_value
                },
                success: function() {
                    toastr.success("Unblock User Successfully");
                    setTimeout(() => {
                        window.location =
                            "<?=site_url();?>user/alluser";
                    }, 2500);
                }
            })
        } else {
            toastr.warning("Please Select User To Unblocked !");
        }
    });
    // $('.check').on('click', function() {
    //     var html =
    //         '<a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Delete Permanentelly" id="delete_all"><i class="fa fa-trash"></i></a>';
    //     if (this.checked) {
    //         $('.breadcrumb').html(html);
    //     } else {
    //         window.location = "<?=site_url();?>product?s=publish";
    //     }
    // });
})
</script>
<!-- Content Header -->
<section class="content-header">
    <h1>
        <?=$title;?>
    </h1>
    <ol class="breadcrumb">
        <a href="#modal_add" class="btn btn-sm btn-primary btn-flat" data-toggle="modal" onclick="submit('add')"><i
                class="fa fa-plus"></i>
            Add New</a>
        <!-- <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Delete"
			id="delete_all"><i class="fa fa-recycle"></i></a> -->
        <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top"
            title="Block User" id="block_all"><i class="fa fa-ban"></i></a>
        <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top"
            title="Unblock User" id="restore_all"><i class="fa fa-history"></i></a>
        <!-- <a href="<?=base_url('product/addproduct');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
            data-placement="top" title="Export Excel"><i class="fa fa-file-excel-o"></i></a> -->
        <a href="<?=base_url('user/alluser');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
            data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <?php $this->load->view('backend/alert'); ?>
    <div class="box">
        <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead class="bg-gray">
                    <tr>
                        <th width="20">NO</th>
                        <th width="5"><input type="checkbox" id="check_all" value=""></th>
                        <th width="5"><i class="fa fa-edit"></i></th>
                        <th width="5"><i class="fa fa-key"></i></th>
                        <!-- <th width="5"><i class="fa fa-calendar"></i></th> -->
                        <!-- <th width="5"><i class="fa fa-eye"></i></th> -->
                        <th>FULLNAME</th>
                        <th>NO. TELP</th>
                        <th>USERNAME</th>
                        <th>DATETIME</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$n=1; 
					// if($_GET['s']=='draft'){
					// 	$param = 'draft';
					// }elseif($_GET['s']=='delete'){
					// 	$param = 'delete';
					// }else{
					// 	$param = 'publish';
					// }
					foreach($alluser as $u): 
					?>
                    <tr <?php if($u['is_block']==1){ echo 'style="color:red;text-decoration:line-through;"';}?>>
                        <td><?=$n++.'.';?></td>
                        <td><input type="checkbox" class="check" name="check_id[]" value="<?=$u['idusers'];?>"></td>
                        <td><a href="#modal_add" data-toggle="modal" onclick="submit(<?=$u['idusers'];?>)"><i
                                    class="fa fa-edit"></i></a>
                        </td>
                        <td><a href="#ganti_password" data-toggle="modal"
                                onclick="ubah_password(<?=$u['idusers'];?>)"><i class="fa fa-key"></i></a>
                        </td>
                        <td><?=$u['user_fullname'];?></td>
                        <td><?=$u['user_telp'];?></td>
                        <td><?=$u['user_name'];?></td>
                        <td><?=date('Y-m-d H:i:s',$u['create_at']);?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- Modal view produk -->
<div class="modal fade" id="modal_add" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('user/addNewUser');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Fullname <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="idusers">
                        <input type="text" class="form-control" name="user_fullname" placeholder="Fullname" required>
                    </div>
                    <div class="form-group">
                        <label>No. Telp <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="user_telp" placeholder="Nomor telepon" required>
                    </div>
                    <div class="form-group">
                        <label>Username <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="user_name" id="username" placeholder="Username"
                            required>
                    </div>
                    <div class="form-group" id="password">
                        <label>Password <span style="color:red;">*</span></label>
                        <input type="password" class="form-control" name="user_password" placeholder="Password"
                            required>
                    </div>
                    <div class="form-group" id="access">
                        <label>User Access <span style="color:red;">*</span></label>
                        <select name="user_type" class="form-control">
                            <option value="administrator">Administrator</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat" id="btn-tambah">Add</button>
                    <button type="button" class="btn btn-sm btn-success btn-flat" id="btn-ubah"
                        onclick="ubahuser()">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal konfirmasi delete -->
<div class="modal fade" id="modal_block" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body bg-red">
                <p>Anda yakin akan memblokir akun ini ? </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default btn-flat" data-dismiss="modal">Cancel</button>
                <button class="btn btn-sm btn-danger btn-flat" id="blocked">Yes, Block</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ubah Gambar -->
<div class="modal fade" tabindex="-1" id="ganti_password" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="" method="post" enctype="multipart/form-data" id="form-ganti-password">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Change Password</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="idusers">
                        <label>New Password <span style="color:red;">*</span></label>
                        <input type="password" class="form-control" name="user_password" placeholder="New Password"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-flat" onclick="ubah_password('ganti')">Change
                        Password</button>
                </div>
            </div>
        </form>
    </div>
</div>
