<script>
function submit(x) {
    if (x == 'add') {
        $('[name="idkurir"]').val("");
        $('[name="kode"]').val("");
        $('[name="nama"]').val("");
        $('[name="layanan"]').val("");
        $('[name="keterangan"]').val("");
        $('#modal_add .modal-title').html('Add New Postal Fee')
        // $('#image').show();
        $('#btn-tambah').show();
        $('#btn-ubah').hide();
    } else {
        $('#modal_add .modal-title').html('Edit Postal Fee')
        // $('#image').hide();
        $('#btn-tambah').hide();
        $('#btn-ubah').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>plugin/viewService',
            dataType: 'json',
            success: function(data) {
                $('[name="idkurir"]').val(data.idkurir);
                $('[name="kode"]').val(data.kode);
                $('[name="nama"]').val(data.nama);
                $('[name="layanan"]').val(data.layanan);
                $('[name="keterangan"]').val(data.keterangan);
            }
        });
    }
}

// function ubahslide(x) {
//     var idslide = $('[name="idslide"]').val();
//     var title = $('[name="title"]').val();
//     var sub_title = $('[name="sub_title"]').val();
//     $.ajax({
//         type: "POST",
//         data: {
//             idslide: idslide,
//             title: title,
//             sub_title: sub_title
//         },
//         url: '<?=base_url();?>plugin/editSlide',
//         success: function() {
//             $('#modal_add').modal('hide');
//             toastr.success("Update Successfully");
//             setTimeout(() => {
//                 window.location =
//                     "<?=site_url();?>plugin";
//             }, 2500);
//         }
//     });
// }

// function ubah_gambar(x) {
//     $.ajax({
//         type: "POST",
//         data: {
//             id: x
//         },
//         url: '<?=base_url();?>plugin/view',
//         dataType: 'json',
//         success: function(data) {
//             var html = '<img src="<?= base_url(); ?>uploads/' + data.image +
//                 '" alt="kosong" width="100%" height="300">';
//             $('#view_gambar').html(html);
//             $('[name="idslide"]').val(data.idslide);
//         }
//     });
//     if (x == 'ganti') {
//         // var table = 'produk';
//         // var id = $('[name="id"]').val();
//         var action = '<?= base_url(); ?>plugin/editImgSlide';
//         $('#form-ganti-gambar').attr('action', action).submit();
//     }
// }

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
                    url: '<?=base_url();?>plugin/deleteTesti',
                    data: {
                        idx: delete_value
                    },
                    success: function() {
                        $('#modal_delete').modal('hide');
                        toastr.success("Deleted Permanentelly Successfully");
                        setTimeout(() => {
                            window.location =
                                "<?=site_url();?>plugin/testimoni";
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
$(function() {
    $.ajaxSetup({
        type: "POST",
        url: "<?= base_url('wilayah/ambilData') ?>",
        cache: false,
    });
    //Asal
    $("#provasal").change(function() {
        var value = $(this).val();
        if (value > 0) {
            $.ajax({
                data: {
                    modul: 'kabupaten',
                    id: value
                },
                success: function(respond) {
                    $("#kabasal").html(respond);
                }
            })
        }
    });
    //Tujuan
    $("#provtujuan").change(function() {
        var value = $(this).val();
        if (value > 0) {
            $.ajax({
                data: {
                    modul: 'kabupaten',
                    id: value
                },
                success: function(respond) {
                    $("#kabtujuan").html(respond);
                }
            })
        }
    });
    //Layanan
    $("#kurir").change(function() {
        var value = $(this).val();
        if (value != '') {
            $.ajax({
                data: {
                    modul: 'layanan',
                    id: value
                },
                success: function(respond) {
                    $("#layanan").html(respond);
                }
            })
        }
    });
    $("#kec").change(function() {
        var value = $(this).val();
        if (value > 0) {
            $.ajax({
                data: {
                    modul: 'kelurahan',
                    id: value
                },
                success: function(respond) {
                    $("#kel").html(respond);
                }
            })
        }
    });
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
        <a href="<?=base_url('plugin/testimoni');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
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
                        <!-- <th width="5"><i class="fa fa-calendar"></i></th> -->
                        <!-- <th width="5"><i class="fa fa-eye"></i></th> -->
                        <th>ASAL</th>
                        <th>TUJUAN</th>
                        <th>KURIR</th>
                        <th>LAYANAN</th>
                        <th>BIAYA</th>
                        <th>ESTIMASI</th>
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
					foreach($allongkir as $o): 
					?>
                    <tr>
                        <td><?=$n++.'.';?></td>
                        <td><input type="checkbox" class="check" name="check_id[]" value="<?=$o->idongkir;?>"></td>
                        <td><a href="#modal_add" data-toggle="modal" onclick="submit(<?=$o->idongkir;?>)"><i
                                    class="fa fa-edit"></i></a>
                        </td>
                        <td><?=kabNama($o->asal);?></td>
                        <td><?=kabNama($o->tujuan);?></td>
                        <td><?=$o->kurir;?></td>
                        <td><?=$o->layanan;?></td>
                        <td><?='Rp. '.money($o->biaya);?></td>
                        <td><?=$o->estimasi.' Hari';?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- Modal view produk -->
<div class="modal fade" id="modal_add" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?=base_url('plugin/addOngkir');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6" style="background-color:#00c0ef;">
                            <div class="form-group">
                                <label>Provinsi Asal <span class="text-red">*</span></label>
                                <select name="provasal" class="form-control select2" id="provasal" style="width:100%"
                                    required>
                                    <option value="0">-- Pilih Provinsi --</option>
                                    <?php foreach($provinsi as $p): ?>
                                    <option value="<?= $p['id_prov']; ?>"><?= $p['nama']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="help-block" style="color:red;"><?= form_error('prov'); ?></span>
                            </div>
                            <div class="form-group">
                                <label>Kota/Kabupaten Asal <span class="text-red">*</span></label>
                                <select name="kabasal" class="form-control select2" id="kabasal" style="width:100%"
                                    required>
                                    <option value="0">-- Pilih Kota/Kabupaten --</option>
                                </select>
                                <span class="help-block" style="color:red;"><?= form_error('kab'); ?></span>
                            </div>
                            <div class="form-group">
                                <label>Kode Pos Asal</label>
                                <input type="text" class="form-control" name="kode_pos_asal"
                                    placeholder="Kode Pos Asal">
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color:#00a55a;">
                            <div class="form-group">
                                <label>Provinsi Tujuan <span class="text-red">*</span></label>
                                <select name="provtujuan" class="form-control select2" id="provtujuan"
                                    style="width:100%" required>
                                    <option value="0">-- Pilih Provinsi --</option>
                                    <?php foreach($provinsi as $p): ?>
                                    <option value="<?= $p['id_prov']; ?>"><?= $p['nama']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="help-block" style="color:red;"><?= form_error('prov'); ?></span>
                            </div>
                            <div class="form-group">
                                <label>Kota/Kabupaten Tujuan <span class="text-red">*</span></label>
                                <select name="kabtujuan" class="form-control select2" id="kabtujuan" style="width:100%"
                                    required>
                                    <option value="0">-- Pilih Kota/Kabupaten --</option>
                                </select>
                                <span class="help-block" style="color:red;"><?= form_error('kab'); ?></span>
                            </div>
                            <div class="form-group">
                                <label>Kode Pos Tujuan</label>
                                <input type="text" class="form-control" name="kode_pos_tujuan"
                                    placeholder="Kode Pos Tujuan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kurir <span class="text-red">*</span></label>
                                <select name="kurir" class="form-control select2" id="kurir" style="width:100%"
                                    required>
                                    <option value="0">-- Pilih Kurir --</option>
                                    <?php foreach($datakurir as $k): ?>
                                    <option value="<?= $k['kode']; ?>"><?= $k['kode'].' - '.$k['nama']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="help-block" style="color:red;"><?= form_error('kurir'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Layanan <span class="text-red">*</span></label>
                                <select name="layanan" class="form-control select2" id="layanan" style="width:100%"
                                    required>
                                    <option value="0">-- Pilih Layanan --</option>
                                </select>
                                <span class="help-block" style="color:red;"><?= form_error('layanan'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Biaya <span class="text-red">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control harga" name="biaya" placeholder="Biaya per Kilo"
                                    required>
                                <span class="input-group-addon">/ Kg</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Estimasi <span class="text-red">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="estimasi" placeholder="ex: 4-5" required>
                                <span class="input-group-addon">Hari</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <br>
                                <label>Catatan</label>
                                <textarea class="form-control" name="catatan" cols="30" rows="5"
                                    placeholder="Catatan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat" id="btn-tambah">Add</button>
                    <button type="button" class="btn btn-sm btn-success btn-flat" id="btn-ubah">Edit</button>
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
                        <input type="hidden" class="form-control" name="idslide">
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