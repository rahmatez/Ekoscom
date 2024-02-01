<script>
function submit(x) {
    $('#modal_add .modal-title').html('Update Status')

    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=base_url();?>transaction/view',
        dataType: 'json',
        success: function(data) {
            $('[name="idorder"]').val(data.idorder);
            $('[name="status"]').val(data.status);
        }
    });
}

function addresi(x) {
    $('#modal_resi .modal-title').html('Update No Resi')

    $.ajax({
        type: "POST",
        data: {
            id: x
        },
        url: '<?=base_url();?>transaction/view',
        dataType: 'json',
        success: function(data) {
            $('[name="idorder"]').val(data.idorder);
            $('[name="no_resi"]').val(data.no_resi);
        }
    });
}
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
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead class="bg-gray">
                    <tr>
                        <th width="20">NO</th>
                        <th width="5"><i class="fa fa-edit"></i></th>
                        <th width="5"><i class="fa fa-eye"></i></th>
                        <th width="5"><i class="fa fa-barcode"></i></th>
                        <th>KODE</th>
                        <th>NO RESI</th>
                        <th>WAKTU</th>
                        <th>PEMESAN</th>
                        <th>TOTAL HARGA</th>
                        <th>STATUS BAYAR</th>
                        <th>STATUS</th>
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
					foreach($alltransaction as $t): 
					?>
                    <tr>
                        <td><?=$n++.'.';?></td>
                        <td><a href="#modal_add" data-toggle="modal" onclick="submit(<?=$t->idorder;?>)"><i
                                    class="fa fa-edit"></i></a>
                        </td>
                        <td><a href="<?=base_url('transaction/detail/').$t->idorder;?>"><i class="fa fa-eye"></i></a>
                        </td>
                        <td><a href="#modal_resi" data-toggle="modal" onclick="addresi(<?=$t->idorder;?>)"><i
                                    class="fa fa-barcode"></i></a>
                        </td>
                        <td><?=$t->code;?></td>
                        <td><?=$t->no_resi;?></td>
                        <td><?=date('Y-m-d H:i:s',$t->datetime);?></td>
                        <td><?=$t->user_fullname;?></td>
                        <td><?='Rp. '.money($t->total_harga);?></td>
                        <td>
                            <label
                                class="label <?php if($t->status_bayar=='lunas'){echo 'label-success';}else{echo 'label-warning';}?>"><?=$t->status_bayar;?></label>
                        </td>
                        <td>
                            <label
                                class="label <?php if($t->status=='proses'||$t->status=='pengiriman'){echo 'label-info';}elseif($t->status=='pembayaran pending'){echo 'label-warning';}else{echo 'label-success';}?>"><?=$t->status;?></label>
                        </td>
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
            <form action="<?=base_url('transaction/editStatus');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="idorder">
                        <select name="status" class="form-control">
                            <option value="pembayaran terima">Pembayaran Terima</option>
                            <option value="proses">Proses</option>
                            <option value="pengiriman">Pengiriman</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Add Resi -->
<div class="modal fade" id="modal_resi" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=base_url('transaction/editResi');?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nomor Resi Pengiriman <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="idorder">
                        <input type="text" class="form-control" name="no_resi">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default btn-flat pull-left"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-success btn-flat">Update</button>
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