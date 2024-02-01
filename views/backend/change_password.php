<script type="text/javascript">
// Change Input Type
function change_type(elem_id) {
    var input_type = $('#' + elem_id).attr('type');
    var change_type = input_type === 'password' ? 'text' : 'password';
    $('#' + elem_id).attr('type', change_type);
}
</script>
<section class="content-header">
    <h1>
        <?=$title;?>
    </h1>
</section>
<section class="content">
    <?php $this->load->view('backend/alert'); ?>
    <form class="form-horizontal" action="<?=base_url('user/editpassword');?>" method="post"
        enctype="multipart/form-data">
        <div class="box">
            <div class="box-body">
                <!-- <div class="form-group">
                    <label for="current_password" class="col-sm-3 control-label">Kata Sandi Saat Ini</label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="password" class="form-control rounded-0" id="current_password">
                            <span class="input-group-btn">
                                <button type="submit" onclick="change_type('current_password'); return false;"
                                    class="btn btn-warning btn-flat rounded-0"><i class="fa fa-eye"></i></button>
                            </span>
                        </div>
                    </div>
                </div> -->
                <div class="form-group">
                    <label for="new_password" class="col-sm-3 control-label">Kata Sandi Baru</label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="hidden" class="form-control" value="<?=$update_user->idusers;?>"
                                name="idusers">
                            <input type="password" class="form-control rounded-0" id="new_password" name="password">
                            <span class="input-group-btn">
                                <button type="submit" onclick="change_type('new_password'); return false;"
                                    class="btn btn-warning btn-flat rounded-0"><i class="fa fa-eye"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="retype_new_password" class="col-sm-3 control-label">Ulangi Kata Sandi Baru</label>
                    <div class="col-sm-9">
                        <div class="input-group input-group-sm">
                            <input type="password" class="form-control rounded-0" id="retype_new_password"
                                name="retype_password">
                            <span class="input-group-btn">
                                <button type="submit" onclick="change_type('retype_new_password'); return false;"
                                    class="btn btn-warning btn-flat rounded-0"><i class="fa fa-eye"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-primary submit"><i class="fa fa-save"></i> CHANGE
                            PASSWORD</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>