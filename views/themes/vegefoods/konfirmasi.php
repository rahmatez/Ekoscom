<div class="hero-wrap hero-bread"
    style="background-image: url('<?=base_url().'views/themes/'.theme_active().'/';?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Beranda</a></span>&gt;
                    <span>Konfirmasi</span>
                </p>
                <h1 class="mb-0 bread">Konfirmasi Pembayaran</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section contact-section bg-light">
    <div class="container">
        <div class="bg-white p-3 mb-4" style="overflow:scroll; height:300px;width:100%;color:black;">
            <?=$infobank->informasi;?>
        </div>
        <div class="row block-9">
            <?php if(empty($testi->user_id)):?>
            <?php 
			foreach(bayar(user()['idusers']) as $b): 
			?>
            <div class="col-md-6 d-flex mb-3" id="form-addbayar">
                <form action="<?=base_url('user/addKonfirmasi');?>" method="post" class="bg-white p-5 contact-form"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Jumlah pembayaran</label>
                        <input type="hidden" class="form-control" name="idbayar" value="<?=$b->idpembayaran;?>">
                        <input type="text" class="form-control" name="total" placeholder="Total Bayar"
                            value="<?=$b->total;?>" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" id="" cols="30" rows="7" class="form-control"
                            placeholder="Keterangan" required><?=$b->keterangan;?></textarea>
                    </div>
                    <?php if($b->file!=''):?>
                    <div class="form-group">
                        <label>File bukti pembayaran anda</label>
                        <img src="<?=base_url('uploads/bukti/');?><?=$b->file;?>" alt="<?=$b->file;?>"
                            style="width:435px;height:200px;text-align:center;">
                    </div>
                    <?php if($b->status=='pending'):?>
                    <div class="form-group">
                        <input type="file" class="form-control" name="bukti">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary py-3 px-5">Konfirmasi Lagi</button>
                    </div>
                    <?php endif;?>
                    <?php else:?>
                    <div class="form-group">
                        <input type="file" class="form-control" name="bukti">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary py-3 px-5">Konfirmasi</button>
                    </div>
                    <?php endif;?>
                </form>
            </div>
            <?php endforeach; ?>
            <?php endif;?>
            <?php if(!empty($testi->user_id)):?>
            <div class="col-md-6 order-md-last d-flex">
                <form action="<?=base_url('user/editKonfirmasi');?>" method="post" class="bg-white p-5 contact-form">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="user_id" value="<?=user()['idusers'];?>">
                        <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap Anda"
                            value="<?=user()['user_fullname'];?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="telp" placeholder="No. Telp Anda"
                            value="<?=user()['user_telp'];?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="job" placeholder="Pekerjaan Anda" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" id="" cols="30" rows="7" class="form-control"
                            placeholder="Testimoni Anda" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary py-3 px-5">Edit Testimoni</button>
                    </div>
                </form>

            </div>
            <?php endif;?>
            <?php if(!empty($testi->user_id)):?>
            <div class="col-md-6 d-flex">
                <form action="#" class="bg-white p-5 contact-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Name" value="<?=$testi->name;?>"
                            readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Phone" value="<?=$testi->telp;?>"
                            readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" value="<?=$testi->job;?>" readonly>
                    </div>
                    <div class="form-group">
                        <textarea name="" id="" cols="30" rows="7" class="form-control"
                            readonly><?=$testi->message;?></textarea>
                    </div>
                    <!-- <div class="form-group">
						<input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
					</div> -->
                </form>

            </div>
            <?php endif;?>
        </div>
    </div>

</section>