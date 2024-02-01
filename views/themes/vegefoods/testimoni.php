<div class="hero-wrap hero-bread"
    style="background-image: url('<?=base_url().'views/themes/'.theme_active().'/';?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Beranda</a></span>&gt;
                    <span>Testimoni</span>
                </p>
                <h1 class="mb-0 bread">Testimoni Saya</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section contact-section bg-light">
    <div class="container">
        <div class="row block-9">
            <?php if(empty($testi->user_id)):?>
            <div class="col-md-6 order-md-last d-flex">
                <form action="<?=base_url('user/addTestimoni');?>" method="post" class="bg-white p-5 contact-form">
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
                        <button type="submit" class="btn btn-primary py-3 px-5">Add Testimoni</button>
                    </div>
                </form>

            </div>
            <?php endif;?>
            <?php if(!empty($testi->user_id)):?>
            <div class="col-md-6 order-md-last d-flex">
                <form action="<?=base_url('user/editTestimoni');?>" method="post" class="bg-white p-5 contact-form">
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
