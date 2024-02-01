<div class="hero-wrap hero-bread"
    style="background-image: url('<?=base_url().'views/themes/'.theme_active().'/';?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Beranda</a></span>&gt;
                    <span>Profil</span>
                </p>
                <h1 class="mb-0 bread">Profil Saya</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section contact-section bg-light">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
            <div class="w-100"></div>
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <span>Total Pesanan :</span>
                    <h1 class="text-center"><a href="<?=base_url('order-total');?>"><?=money($totalorder);?></a></h1>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <span>Dalam Proses :</span>
                    <h1 class="text-center"><a href="<?=base_url('order-dalam-proses');?>"><?=money($totalproses);?></a>
                    </h1>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <span>Pengiriman :</span>
                    <h1 class="text-center"><a
                            href="<?=base_url('order-dalam-pengiriman');?>"><?=money($totalpengiriman);?></a></h1>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <span>Total Barang Dibeli:</span>
                    <h1 class="text-center"><a href="<?=base_url('order-barang');?>"><?=money($totalbeli);?></a></h1>
                </div>
            </div>
            <!-- <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <p><span class="icon icon-phone">Website</span> <a href="#">yoursite.com</a></p>
                </div>
            </div> -->
        </div>
        <div class="row block-9">
            <?php if(empty($profil->users_id)):?>
            <div class="col-md-6 d-flex">
                <form action="<?=base_url('user/add');?>" class="bg-white p-5 contact-form" method="post"
                    enctype="multipart/form-data">
                    <h4 class="mb-4">Alamat Pengiriman Anda</h4>
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstname">Nama Lengkap</label>
                                <input type="hidden" class="form-control" name="users_id"
                                    value="<?=user()['idusers'];?>">
                                <input type="text" class="form-control" name="nama"
                                    value="<?=user()['user_fullname'];?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lastname">Nomor Telepon</label>
                                <input type="text" class="form-control" name="telp" value="<?=user()['user_telp'];?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Provinsi</label>
                                <div class="select-wrap">
                                    <select name="prov" id="prov_customer" class="form-control px-3" required>
                                        <option value="0">-- Pilih Provinsi --</option>
                                        <?php foreach($provinsi as $p): ?>
                                        <option value="<?= $p['id_prov']; ?>"><?= $p['nama']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Kota/Kabupaten</label>
                                <div class="select-wrap">
                                    <select name="kab" id="kab_customer" class="form-control px-3" required>
                                        <option value="0">-- Pilih Kota/Kabupaten --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="towncity">Kecamatan</label>
                                <input type="text" class="form-control" name="kec" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="streetaddress">Kode Pos</label>
                                <input type="text" class="form-control" name="kodepos" required>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat Lengkap</label>
                                <textarea name="address" id="" cols="30" rows="7" class="form-control"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary py-3 px-5">Simpan Alamat</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php endif;?>

            <?php if(!empty($profil->users_id)):?>
            <div class="col-md-6 d-flex">
                <form action="<?=base_url('user/add');?>" class="bg-white p-5 contact-form" method="post"
                    enctype="multipart/form-data">
                    <h4 class="mb-4">Alamat Pengiriman Anda</h4>
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstname">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" value="<?=$profil->fullname;?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lastname">Nomor Telepon</label>
                                <input type="text" class="form-control" name="telp" value="<?=$profil->telp;?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Provinsi</label>
                                <input type="text" class="form-control" name="prov" value="<?=$profil->nama_prov;?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Kota/Kabupaten</label>
                                <input type="text" class="form-control" name="kab" value="<?=$profil->nama_kab;?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="towncity">Kecamatan</label>
                                <input type="text" class="form-control" name="kec" value="<?=$profil->kec;?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="streetaddress">Kode Pos</label>
                                <input type="text" class="form-control" name="kodepos" value="<?=$profil->kodepos;?>"
                                    readonly>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat Lengkap</label>
                                <textarea name="address" id="" cols="30" rows="7" class="form-control"
                                    readonly><?=$profil->address;?></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php endif;?>
            <?php if(!empty($profil->users_id)):?>
            <div class="col-md-6 d-flex">
                <form action="<?=base_url('user/edit');?>" class="bg-white p-5 contact-form" method="post"
                    enctype="multipart/form-data">
                    <h4 class="mb-4">Ubah Alamat Pengiriman Anda</h4>
                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstname">Nama Lengkap</label>
                                <input type="hidden" class="form-control" name="iduser_profile"
                                    value="<?=$profil->idUser_profile;?>">
                                <input type="text" class="form-control" name="nama" value="<?=$profil->fullname;?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="lastname">Nomor Telepon</label>
                                <input type="text" class="form-control" name="telp" value="<?=$profil->telp;?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Provinsi</label>
                                <div class="select-wrap">
                                    <select name="prov" id="prov_customer" class="form-control px-3">
                                        <option value="0">-- Pilih Provinsi --</option>
                                        <?php foreach($provinsi as $p): ?>
                                        <option value="<?= $p['id_prov']; ?>"><?= $p['nama']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Kota/Kabupaten</label>
                                <div class="select-wrap">
                                    <select name="kab" id="kab_customer" class="form-control px-3">
                                        <option value="0">-- Pilih Kota/Kabupaten --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="towncity">Kecamatan</label>
                                <input type="text" class="form-control" name="kec" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="streetaddress">Kode Pos</label>
                                <input type="text" class="form-control" name="kodepos">
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Alamat Lengkap</label>
                                <textarea name="address" id="" cols="30" rows="7" class="form-control"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary py-3 px-5">Ubah Alamat</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php endif;?>
        </div>
    </div>




</section>