<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
loadcategories();
loadtags();

function loadcategories() {
    $.ajax({
        type: 'POST',
        url: '<?= site_url()."posts/categories/load" ?>',
        dataType: 'json',
        success: function(data) {
            var row = '';
            for (var i = 0; i < data.length; i++) {
                row += '<option value="' + data[i].idcategories + '">' + data[i].category_name +
                    '</option>';
            }
            $('#post_categories').html(row);
        }
    })
}

function loadtags() {
    $.ajax({
        type: 'POST',
        url: '<?= site_url()."posts/tags/load" ?>',
        dataType: 'json',
        success: function(data) {
            var row = '';
            for (var i = 0; i < data.length; i++) {
                row += '<option value="' + data[i].idtags + '">' + data[i].tag_name +
                    '</option>';
            }
            $('#post_tag').html(row);
        }
    })
}

function add_category() {
    var category_name = $("[name='category_name']").val();
    $.ajax({
        type: 'POST',
        data: {
            category_name: category_name
        },
        url: '<?= site_url()."posts/categories/addcategories" ?>',
        success: function() {
            $("#modal_add_categories").modal('hide');
            loadcategories();
        }
    })
}

function add_tag() {
    var tag_name = $("[name='tag_name']").val();
    $.ajax({
        type: 'POST',
        data: {
            tag_name: tag_name
        },
        url: '<?= site_url()."posts/tags/addtag" ?>',
        success: function() {
            $("#modal_add_tags").modal('hide');
            loadtags();
        }
    })
}
</script>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?=$title;?>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <?php $this->load->view('backend/alert'); ?>
    <!-- <div class="row"> -->
    <form action="<?=base_url('plugin/editInfo');?>" method="post" enctype="multipart/form-data">
        <div class="box">
            <div class="box-body pad">
                <div class="col-md-12">
                    <!-- Box Add Post -->
                    <!-- <div>
                    </div> -->
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Keterangan <span style="color:red;">*</span></label>
                        <input type="hidden" class="form-control" name="idinfo" value="<?=$infobank->idinfo;?>">
                        <textarea id="editor1" name="informasi" rows="10"
                            cols="80"><?=$infobank->informasi;?></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- <a href="" class="btn btn-sm btn-default btn-flat pull-left">Cancel</a> -->
                    <button type="submit" class="btn btn-sm btn-success btn-flat pull-right">Save</button>
                </div>
            </div>
        </div>
    </form>
    <!-- </div> -->
</section>
<!-- Modal add categories -->
<div class="modal fade" id="modal_add_categories">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Categories</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="category_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left btn-sm btn-flat"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success btn-sm btn-flat" onclick="add_category()">Add
                        Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal add tags -->
<div class="modal fade" id="modal_add_tags">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Tags</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tag Name</label>
                        <input type="text" class="form-control" name="tag_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left btn-sm btn-flat"
                        data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success btn-sm btn-flat" onclick="add_tag()">Add Tag</button>
                </div>
            </form>
        </div>
    </div>
</div>
