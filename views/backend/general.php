<script>
// $(document).ready(function() {
//     $('#timezone-form').hide();
// })

function submit(x) {
    // $('#modal_edit .modal-title').html('Edit Setting Value')

    // $('#image').hide();
    // $('#btn-tambah').hide();
    // $('#btn-ubah').show();
    if (x == 8) {
        $('#timezome-form').show();
        // alert('ok');
    } else if (x == 6) {
        $('#icon-form').show();
        // alert('ok');
    } else {
        $('#default-form').show();
        $('#timezome-form').hide();
        $('#icon-form').hide();
    }
    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=base_url();?>settings/view',
        dataType: 'json',
        success: function(data) {
            $('[name="id"]').val(data.id);
            $('[name="value"]').val(data.value);

        }
    });
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

$(function() {
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
})
$(function() {
    $.ajaxSetup({
        type: "POST",
        url: "<?= base_url('wilayah/ambilData') ?>",
        cache: false,
    });
    //Asal
    $("#prov").change(function() {
        var value = $(this).val();
        if (value > 0) {
            $.ajax({
                data: {
                    modul: 'kabupaten',
                    id: value
                },
                success: function(respond) {
                    $("#kab").html(respond);
                }
            })
        }
    });
})
</script>
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
        <a href="<?=base_url('settings');?>" class="btn btn-sm btn-primary btn-flat" data-toggle="tooltip"
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
                        <!-- <th width="5"><input type="checkbox" id="check_all" value=""></th> -->
                        <th width="5"><i class="fa fa-edit"></i></th>
                        <!-- <th width="5"><i class="fa fa-calendar"></i></th> -->
                        <!-- <th width="5"><i class="fa fa-eye"></i></th> -->
                        <th>SETTING NAME</th>
                        <th>SETTING VALUE</th>
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
					foreach(settings('general') as $sg): 
					?>
                    <tr>
                        <td><?=$n++.'.';?></td>
                        <!-- <td><input type="checkbox" class="check" name="check_id[]" value="<?=$sg['id'];?>"></td> -->
                        <td><a href="#<?=idModal($sg['variable']);?>" data-toggle="modal"
                                onclick="submit(<?=$sg['id'];?>)"><i class="fa fa-edit"></i></a>
                        </td>
                        <td><?=$sg['description'];?></td>
                        <td><?php if($sg['value']!='' || $sg['value']!=null){echo $sg['value'];}else{echo $sg['default'];}?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- Modal view produk -->
<div class="modal fade" id="modal_edit" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('settings/editGeneral');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Setting Value</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="default-form">
                        <label>Setting Value <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="id">
                        <input type="text" class="form-control" name="value" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat" id="btn-tambah">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal view produk -->
<div class="modal fade" id="modal_edit_favicon" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('settings/editFavicon');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Setting Value</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="icon-form">
                        <label>Setting Value <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="id">
                        <input type="file" class="form-control" name="image" required>
                        <span>File format : <b><?=settings('general','file_allowed_types');?></b></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat" id="btn-tambah">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal view produk -->
<div class="modal fade" id="modal_edit_timezone" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('settings/editGeneral');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Setting Value</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" id="timezone-form">
                        <label>Setting Value <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="id">
                        <select name="value" class="form-control select2" style="width: 100%;">
                            <?php foreach(timezone_list() as $tl):?>
                            <option value="<?=explode(' ',$tl)[1];?>"><?=$tl;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat" id="btn-tambah">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal view produk -->
<div class="modal fade" id="modal_edit_city_from_delivery" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('settings/editGeneral');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Setting Value</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Provinsi Tujuan <span class="text-red">*</span></label>
                        <select class="form-control select2" id="prov" style="width:100%" required>
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
                        <input type="hidden" class="form-control" name="id">
                        <select name="value" class="form-control select2" id="kab" style="width:100%" required>
                            <option value="0">-- Pilih Kota/Kabupaten --</option>
                        </select>
                        <span class="help-block" style="color:red;"><?= form_error('kab'); ?></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat" id="btn-tambah">Edit</button>
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