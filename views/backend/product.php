<script>
function view(id) {
    $.ajax({
        type: "POST",
        data: {
            id: id
        },
        url: '<?=base_url();?>product/view',
        dataType: 'json',
        success: function(data) {
            $('[name="idproduct"]').val(data.idproduct);
            $('[name="old_stok"]').val(data.stok);
        }
    });
}

function ubah_gambar(x) {
    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=base_url();?>product/view',
        dataType: 'json',
        success: function(data) {
            var html = '<img src="<?= base_url(); ?>uploads/products/' + data.product_image +
                '" alt="kosong" width="100%" height="300">';
            $('#view_gambar').html(html);
            $('[name="idproduct"]').val(data.idproduct);
        }
    });
    if (x == 'ganti') {
        // var table = 'produk';
        // var id = $('[name="id"]').val();
        var action = '<?= base_url(); ?>product/editImgProduct';
        $('#form-ganti-gambar').attr('action', action).submit();
    }
}
$(function() {
    $('#delete_all').click(function() {
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
                    url: '<?=site_url();?>product/delete',
                    method: 'produk',
                    data: {
                        id: delete_value
                    },
                    success: function() {
                        $('#modal_delete').modal('hide');
                        toastr.success("Deleted Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>product?s=delete";
                        }, 2500);
                    }
                })
            } else {
                $('#modal_delete').modal('hide');
                toastr.warning("Please Select Data To Deleted !");
            }
        })
    });
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
                    url: '<?=base_url();?>product/delete',
                    data: {
                        idx: delete_value
                    },
                    success: function() {
                        $('#modal_delete').modal('hide');
                        toastr.success("Deleted Permanentelly Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>product";
                        }, 2500);
                    }
                })
            } else {
                $('#modal_delete').modal('hide');
                toastr.warning("Please Select Data To Delete Permanentelly !");
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
                url: '<?=site_url();?>product/restore',
                method: 'produk',
                data: {
                    id: restore_value
                },
                success: function() {
                    toastr.success("Restored Successfully");
                    setTimeout(() => {
                        window.location =
                            "<?=site_url();?>product?s=draft";
                    }, 2500);
                }
            })
        } else {
            toastr.warning("Please Select Data To Restore !");
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
        <!-- <a class="text-green" href="<?=site_url('product?s=publish');?>">Pulished(<?=count(produk(null,'publish'));?>)
            |</a> -->
        <a class="text-orange" href="<?=site_url('product?s=minim');?>">Stok < 10 (<?=count(produk(null,10));?>) | </a>
                <a href="<?=base_url('product/create');?>" class="btn btn-sm btn-primary btn-flat"><i
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
        <a href="<?=base_url('product?s=all');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
            data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <?php $this->load->view('backend/alert'); ?>
    <div class="box">
        <div class="box-body table-responsive">
            * Klik gambar untuk merubah gambar
            <hr>
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead class="bg-gray">
                    <tr>
                        <th width="20">NO</th>
                        <th width="5"><input type="checkbox" id="check_all" value=""></th>
                        <th width="5"><i class="fa fa-edit"></i></th>
                        <!-- <th width="5"><i class="fa fa-image"></i></th> -->
                        <!-- <th width="5"><i class="fa fa-eye"></i></th> -->
                        <th with="60">GAMBAR</th>
                        <th>NAMA PRODUK</th>
                        <th>SATUAN</th>
                        <th>HARJA BELI</th>
                        <th>HARJA JUAL</th>
                        <th>DISKON</th>
                        <!-- <th>STOK</th> -->
                        <?php if($_GET['s']=='minim'):?>
                        <th>STOK</th>
                        <th width="20">ACTION</th>
                        <?php else:?>
                        <th>TANGGAL</th>
                        <?php endif;?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
					$n=1; 
					if($_GET['s']=='minim'){
						$param = 10;
					}else{
						$param = '';
					}
					// elseif($_GET['s']=='delete'){
					// 	$param = 'delete';
					// }else{
					// 	$param = 'publish';
					// }
					foreach(produk(null,$param) as $p): 
					?>
                    <tr>
                        <td><?=$n++.'.';?></td>
                        <td><input type="checkbox" class="check" name="check_id[]" value="<?=$p['idproduct'];?>"></td>
                        <td><a href="<?=site_url('product/create/'.$p['idproduct']);?>"><i class="fa fa-edit"></i></a>
                        </td>
                        <!-- <td><a href=""><i class="fa fa-image"></i></a></td> -->
                        <!-- <td><a href="#"><i class="fa fa-eye" data-toggle="modal"
									data-target="#modal_view<?=$p['idproduct'];?>"></i></a>
						</td> -->
                        <td class="text-center">
                            <a href="#ganti_gambar" data-toggle="modal"
                                onclick="ubah_gambar(<?=$p['idproduct'];?>)"><img
                                    src="<?=base_url('uploads/products/').$p['product_image'];?>"
                                    alt="<?=$p['product_image'];?>" width="60" height="50"></a>
                        </td>
                        <td><?=$p['product_name'];?></td>
                        <td><?=$p['satuan'];?></td>
                        <td><?='Rp. '.money($p['harga_beli']);?></td>
                        <td><?='Rp. '.money($p['harga_jual']);?></td>
                        <td><?='Rp. '.money($p['diskon']);?></td>
                        <?php if($_GET['s']=='minim'):?>
                        <td><?=money($p['stok']);?></td>
                        <td><a href="#modal_restok" class="btn btn-xs btn-info btn-flat" data-toggle="modal"
                                onclick="view(<?=$p['idproduct'];?>)">Re-Stok</a>
                        </td>
                        <?php else:?>
                        <td><?=date('Y-m-d',$p['create_at']);?></td>
                        <?php endif;?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- Modal view produk -->
<div class="modal fade" id="modal_restok" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('product/restok');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Re-Stok</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jumlah Stok <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="idproduct">
                        <input type="hidden" class="form-control" name="old_stok">
                        <input type="text" class="form-control harga" name="stok" placeholder="Stok Produk" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat" id="btn-tambah">Update</button>
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
                        <input type="hidden" class="form-control" name="idproduct">
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
