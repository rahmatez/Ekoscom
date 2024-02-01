<section class="content-header">
    <h1>
        <?=$title;?>
    </h1>
</section>
<section class="content">
    <?php $this->load->view('backend/alert'); ?>
    <div class="box">
        <form class="form-horizontal" action="<?=base_url('user/editprofil');?>" method="post"
            enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group has-error">
                    <label for="user_name" class="col-sm-3 control-label">Nama Pengguna</label>
                    <div class="col-sm-9">
                        <input type="hidden" class="form-control" value="<?=$update_user->idusers;?>" name="idusers">
                        <input type="text" disabled="disabled" class="form-control" id="user_name"
                            value="<?=$update_user->user_name;?>">
                        <span class="help-block">Nama pengguna tidak dapat diubah</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="user_full_name" class="col-sm-3 control-label">Nama Lengkap</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="user_full_name"
                            value="<?=$update_user->user_fullname;?>" name="user_fullname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="user_email" class="col-sm-3 control-label">No Handphone</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="user_email" value="<?=$update_user->user_telp;?>"
                            name="user_telp">
                    </div>
                </div>
                <div class="form-group">
                    <label for="user_url" class="col-sm-3 control-label">URL</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="user_url" value="<?=$update_user->user_url;?>"
                            name="user_url">
                    </div>
                </div>
                <div class="form-group">
                    <label for="user_biography" class="col-sm-3 control-label">Biografi</label>
                    <div class="col-sm-9">
                        <textarea rows="5" class="form-control" id="user_biography"
                            name="user_bio"><?=$update_user->user_bio;?></textarea>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-primary submit"><i class="fa fa-save"></i> UPDATE
                            PROFILE</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>