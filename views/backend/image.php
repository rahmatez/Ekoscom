<script>
function submit(x) {
    if (x == 'add') {
        $('[name="id"]').val("");
        $('[name="category_name"]').val("");
        $('[name="category_description"]').val("");
        $('#modal_add .modal-title').html('Add New Image Product')
        $('#image').show();
        $('#btn-tambah').show();
        $('#btn-ubah').hide();
    } else {
        $('#modal_add .modal-title').html('Edit Image Product')
        $('#image').hide();
        $('#btn-tambah').hide();
        $('#btn-ubah').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>category/view',
            dataType: 'json',
            success: function(data) {
                $('[name="idcategory"]').val(data.idcategory);
                $('[name="category_name"]').val(data.category_name);
                $('[name="category_description"]').val(data.category_description);
            }
        });
    }
}

function ubahkategori(x) {
    var idcategory = $('[name="idcategory"]').val();
    var category_name = $('[name="category_name"]').val();
    var category_description = $('[name="category_description"]').val();
    $.ajax({
        type: "POST",
        data: {
            idcategory: idcategory,
            category_name: category_name,
            category_description: category_description
        },
        url: '<?=base_url();?>category/editCategory',
        success: function() {
            $('#modal_add').modal('hide');
            toastr.success("Update Successfully");
            setTimeout(() => {
                window.location =
                    "<?=site_url();?>category";
            }, 2500);
        }
    });
}

function ubah_gambar(x) {
    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=base_url();?>image/view',
        dataType: 'json',
        success: function(data) {
            var html = '<img src="<?= base_url(); ?>uploads/products/' + data.image +
                '" alt="kosong" width="100%" height="300">';
            $('#view_gambar').html(html);
            $('[name="idimage"]').val(data.idImage);
        }
    });
    if (x == 'ganti') {
        // var table = 'produk';
        // var id = $('[name="id"]').val();
        var action = '<?= base_url(); ?>image/edit';
        $('#form-ganti-gambar').attr('action', action).submit();
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
    $('#delete_permanen_all').click(function() {
        $('#modal_delete').modal('show', {
            backdrop: 'static',
            keyboard: false
        });
        $('#deleted').click(function() {
            var delete_check = $('.check:checked');
            if (delete_check.length > 0) {
                var delete_value = [];
                $(delete_check).each(function() {
                    delete_value.push($(this).val());
                });

                $.ajax({
                    type: 'post',
                    url: '<?=base_url();?>image/delete',
                    data: {
                        idx: delete_value
                    },
                    success: function() {
                        $('#modal_delete').modal('hide');
                        toastr.success("Deleted Permanentelly Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>image";
                        }, 2500);
                    }
                })
            } else {
                $('#modal_delete').modal('hide');
                toastr.warning("Please Select Data To Delete Permanentelly !");
            }
        })
    });
    // $('#restore_all').click(function() {
    //     var restore_check = $('.check:checked');
    //     if (restore_check.length > 0) {
    //         var restore_value = [];
    //         $(restore_check).each(function() {
    //             restore_value.push($(this).val());
    //         });
    //         $.ajax({
    //             url: '<?=site_url();?>product/restore',
    //             method: 'produk',
    //             data: {
    //                 id: restore_value
    //             },
    //             success: function() {
    //                 toastr.success("Restored Successfully");
    //                 setTimeout(() => {
    //                     window.location =
    //                         "<?=site_url();?>product?s=draft";
    //                 }, 2500);
    //             }
    //         })
    //     } else {
    //         toastr.warning("Please Select Data To Restore !");
    //     }
    // });
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
            title="Delete Permanentelly" id="delete_permanen_all"><i class="fa fa-trash"></i></a>
        <!-- <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Restore"
			id="restore_all"><i class="fa fa-history"></i></a> -->
        <!-- <a href="<?=base_url('product/addproduct');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
            data-placement="top" title="Export Excel"><i class="fa fa-file-excel-o"></i></a> -->
        <a href="<?=base_url('image');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
            data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <?php $this->load->view('backend/alert'); ?>
    <div class="box">
        <div class="box-body">
            * Klik gambar untuk merubah gambar
            <hr>
            <div class="row">
                <?php foreach(produk_gambar() as $img):?>
                <div class="col-sm-2" style="margin-bottom:15px;">
                    <!-- <input type="checkbox" name="" id=""> -->
                    <input type="checkbox" class="check" name="check_id[]" value="<?=$img->idImage;?>">
                    <a href="#ganti_gambar" data-toggle="modal" onclick="ubah_gambar(<?=$img->idImage;?>)"><img
                            class="img-responsive" src="<?=base_url('uploads/products/');?><?=$img->image;?>"
                            alt="Foto Produk KSU Agro Bintuni" style="height:100px;width:200px;"></a>

                    <button type="button" class="btn btn-default btn-xs btn-flat"><?=$img->product_id;?> |
                        <?=date('Y-m-d H:i:s',$img->create_at);?></button>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>


</section>
<!-- Modal view produk -->
<div class="modal fade" id="modal_add" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('image/add');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <!-- <div class="form-group">
                        <label>Nama Kategori <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="idcategory">
                        <input type="text" class="form-control" name="category_name" placeholder="Nama Kategori"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="category_description"
                            placeholder="keterangan Kategori" required>
                    </div> -->
                    <div class="form-group">
                        <label>Nama Produk</label><br>
                        <select class="form-control select2 col-md-12" name="product_id" id="" style="width: 100%;">
                            <?php foreach(produk() as $p):?>
                            <option value="<?=$p['idproduct'];?>"><?=$p['product_name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group" id="image">
                        <label>Pilih Gambar</label>
                        <input type="file" class="form-control" name="image[]" multiple>
                        <span>File format : <b><?=settings('general','file_allowed_types');?></b></span>
                    </div>
                    <div id="view_image">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat" id="btn-tambah"
                        name="add">Add</button>
                    <button type="button" class="btn btn-sm btn-success btn-flat" id="btn-ubah"
                        onclick="ubahkategori()">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal konfirmasi delete -->
<div class="modal fade" id="modal_delete" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body bg-red">
                <p>Anda yakin akan menghapus data ini ? </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-default btn-flat" data-dismiss="modal">Cancel</button>
                <button class="btn btn-sm btn-danger btn-flat" id="deleted">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ubah Gambar -->
<div class="modal fade" tabindex="-1" id="ganti_gambar" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="" method="post" enctype="multipart/form-data" id="form-ganti-gambar">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Change Image</h4>
                </div>
                <div class="modal-body">
                    <div id="view_gambar" style="margin-bottom:15px;padding:15px;border:1px solid;">

                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="idimage">
                        <input type="file" class="form-control" name="image">
                        <span>File format : <b><?=settings('general','file_allowed_types');?></b></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-flat" onclick="ubah_gambar('ganti')">Update
                        Image</button>
                </div>
            </div>
        </form>
    </div>
</div>