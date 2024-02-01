<script>
function submit(x) {
    if (x == 'add') {
        $('[name="id"]').val("");
        $('[name="category_name"]').val("");
        $('[name="category_description"]').val("");
        $('#modal_add .modal-title').html('Add New Category')
        $('#image').show();
        $('#btn-tambah').show();
        $('#btn-ubah').hide();
    } else {
        $('#modal_add .modal-title').html('Edit Category')
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
        url: '<?=base_url();?>category/view',
        dataType: 'json',
        success: function(data) {
            var html = '<img src="<?= base_url(); ?>uploads/category/' + data.category_image +
                '" alt="kosong" width="100%" height="300">';
            $('#view_gambar').html(html);
            $('[name="idcategory"]').val(data.idcategory);
        }
    });
    if (x == 'ganti') {
        // var table = 'produk';
        // var id = $('[name="id"]').val();
        var action = '<?= base_url(); ?>category/editImgCategory';
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
                    url: '<?=base_url();?>category/delete',
                    data: {
                        idx: delete_value
                    },
                    success: function() {
                        $('#modal_delete').modal('hide');
                        toastr.success("Deleted Permanentelly Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>category";
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
        <!-- <a href="#modal_add" class="btn btn-sm btn-primary btn-flat" data-toggle="modal" onclick="submit('add')"><i
				class="fa fa-plus"></i>
			Add New</a> -->
        <!-- <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Delete"
			id="delete_all"><i class="fa fa-recycle"></i></a> -->
        <!-- <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top"
			title="Delete Permanentelly" id="delete_permanen_all"><i class="fa fa-trash"></i></a> -->
        <!-- <a href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip" data-placement="top" title="Restore"
			id="restore_all"><i class="fa fa-history"></i></a> -->
        <!-- <a href="<?=base_url('product/addproduct');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
			data-placement="top" title="Export Excel"><i class="fa fa-file-excel-o"></i></a> -->
        <a href="<?=base_url('transaction');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
            data-placement="top" title="Refresh"><i class="fa fa-refresh"></i></a>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <?php $this->load->view('backend/alert'); ?>
    <div class="box">
        <div class="box-body table-responsive">
            <div class="row mb-5">
                <div class="col-md-4">
                    <table class="table">
                        <tr>
                            <td>Kode Pemesanan</td>
                            <td>:</td>
                            <td><strong><?=$detail->code;?></strong></td>
                        </tr>
                        <tr>
                            <td>Nama Pemesan</td>
                            <td>:</td>
                            <td><strong><?=$detail->user_fullname;?></strong></td>
                        </tr>
                        <tr>
                            <td>No. Telepon</td>
                            <td>:</td>
                            <td><strong><?=$detail->user_telp;?></strong></td>
                        </tr>
                        <tr>
                            <td>Kurir</td>
                            <td>:</td>
                            <td><strong><?=$detail->order_kurir;?></strong></td>
                        </tr>
                        <tr>
                            <td>No Resi</td>
                            <td>:</td>
                            <td><strong><?=$detail->no_resi;?></strong></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table">
                        <tr>
                            <td>Provinsi</td>
                            <td>:</td>
                            <td><strong><?=provNama($detail->order_prov);?></strong></td>
                        </tr>
                        <tr>
                            <td>Kabupaten</td>
                            <td>:</td>
                            <td><strong><?=kabNama($detail->order_kab);?></strong></td>
                        </tr>
                        <tr>
                            <td>Kecamatan</td>
                            <td>:</td>
                            <td><strong><?=$detail->order_kec;?></strong></td>
                        </tr>
                        <tr>
                            <td>Kode Pos</td>
                            <td>:</td>
                            <td><strong><?=$detail->order_kodepos;?></strong></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><strong><?=$detail->order_address;?></strong></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4">
                    <table class="table">
                        <tr>
                            <td>Ongkos Kirim</td>
                            <td>:</td>
                            <td><strong><?='Rp. '.money($detail->order_ongkir);?></strong></td>
                        </tr>
                        <tr>
                            <td>Total Harga</td>
                            <td>:</td>
                            <td><strong><?='Rp. '.money($detail->total_harga);?></strong></td>
                        </tr>
                        <tr>
                            <td>Status Bayar</td>
                            <td>:</td>
                            <td><strong><?=$detail->status_bayar;?></strong></td>
                        </tr>
                        <tr>
                            <td>Status Pesanan</td>
                            <td>:</td>
                            <td><strong><?=$detail->status;?></strong></td>
                        </tr>
                    </table>
                </div>
            </div>
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead class="bg-gray">
                    <tr>
                        <th width="20">NO</th>
                        <th width="5">GAMBAR</th>
                        <th>NAMA PRODUK</th>
                        <th>SATUAN</th>
                        <th>HARGA</th>
                        <th>QTY</th>
                        <th>BERAT</th>
                        <th>SUB TOTAL</th>
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
					foreach(detailOrder($detail->idorder) as $t): 
					?>
                    <tr>
                        <td><?=$n++.'.';?></td>
                        <td>
                            <a href="<?=base_url().'uploads/products/'.$t->product_image;?>" target="_blank"><img
                                    src="<?=base_url('uploads/products/');?><?=$t->product_image;?>"
                                    alt="<?=$t->product_image;?>" style="width:50px;height:50px;"></a>
                        </td>
                        <td><?=$t->product_name;?></td>
                        <td><?=$t->satuan;?></td>
                        <td><?='Rp. '.money($t->harga);?></td>
                        <td><?=$t->qty;?></td>
                        <td><?=money($t->berat).' gram';?></td>
                        <td><?='Rp. '.money($t->harga*$t->qty);?></td>
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
            <form action="<?=base_url('category/addCategory');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kategori <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="idcategory">
                        <input type="text" class="form-control" name="category_name" placeholder="Nama Kategori"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="category_description"
                            placeholder="keterangan Kategori" required>
                    </div>
                    <div class="form-group" id="image">
                        <label>Pilih Gambar</label>
                        <input type="file" class="form-control" name="image">
                        <span>File format : <b>.jpg, .jpeg, .png, .gif</b></span>
                    </div>
                    <div id="view_image">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat" id="btn-tambah">Add</button>
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
                        <input type="hidden" class="form-control" name="idcategory">
                        <input type="file" class="form-control" name="image">
                        <span>File format : <b>.jpg, .jpeg, .png, .gif</b></span>
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