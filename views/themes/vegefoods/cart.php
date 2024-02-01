<div class="hero-wrap hero-bread"
    style="background-image: url('<?=base_url().'views/themes/'.theme_active().'/';?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Beranda</a></span>&gt;
                    <span>Keranjang</span>
                </p>
                <h1 class="mb-0 bread">Keranjang Saya</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>PRODUCT IMAGE</th>
                                <th>PRODUCT NAME</th>
                                <th>PRICE</th>
                                <th>QTY</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <?php if($this->session->userdata('username') && $this->session->userdata('access')=='customer'):?>
                        <tbody>
                            <?php
							foreach(cartlist(user()['idusers']) as $items):?>
                            <tr class="text-center">
                                <td class="product-remove"><a href="#" id="<?=$items['idcart'];?>" class="hapus"><span
                                            class="ion-ios-close"></span></a></td>

                                <td class="image-prod">
                                    <div class="img"
                                        style="background-image:url('<?=base_url('uploads/products/').$items['product_image'];?>');">
                                    </div>
                                </td>

                                <td class="product-name">
                                    <h3><?=$items['product_name'];?></h3>
                                    <p>Satuan : <?=$items['satuan'];?><br> Berat : <?=$items['berat']*$items['qty'];?>
                                        gram
                                    </p>
                                </td>

                                <td class="price"><?=money($items['harga']);?></td>

                                <td class="quantity">
                                    <p class="text-center" style="color:black;"><?=$items['qty'];?></p>

                                </td>

                                <td class="total"><?=money($items['harga']*$items['qty']);?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                        <?php else:?>
                        <tbody id="cart_detail">
                        </tbody>
                        <?php endif;?>
                    </table>
                </div>
            </div>
        </div>
        <form action="<?=base_url('user/proses_order');?>" method="post" enctype="multipart/form-data">
            <div class="row justify-content-end">
                <!-- <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Coupon Code</h3>
                    <p>Enter your coupon code if you have one</p>
                    <form action="#" class="info">
                        <div class="form-group">
                            <label for="">Coupon code</label>
                            <input type="text" class="form-control text-left px-3" placeholder="">
                        </div>
                    </form>
                </div>
                <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
            </div> -->
                <?php if($this->session->userdata('username') && $this->session->userdata('access')=='customer'):?>
                <div class="col-lg-8 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Alamat Pengiriman Anda</h3>
                        <p>Silahkan atur lokasi anda dan lihat ongkos kirim anda</p>
                        <!-- <form action="#" class="info"> -->
                        <div class="form-group mt-4">
                            <div class="radio">
                                <label class="mr-3"><input type="radio" name="alamatbaru" id="alamatbaru" value="baru"
                                        checked>
                                    Alamat
                                    Baru ? </label>
                                <label><input type="radio" name="alamatsaya" id="alamatsaya"
                                        value="<?=user()['idusers'];?>">
                                    Alamat
                                    Saya</label>
                            </div>
                        </div>
                        <div class="form-group" id="provbaru">
                            <label for="">Provinsi</label>
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select name="prov" id="prov_order" class="form-control px-3" required>
                                    <option value="0">-- Pilih Provinsi --</option>
                                    <?php foreach($provinsi as $p): ?>
                                    <option value="<?= $p['id_prov']; ?>"><?= $p['nama']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="kabbaru">
                            <label for="">Kota/Kabupaten</label>
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select name="kab" id="kab_order" class="form-control px-3" required>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="towncity">Kecamatan</label>
                            <input type="text" class="form-control text-left px-3" name="kec" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="streetaddress">Kode Pos</label>
                            <input type="text" class="form-control text-left px-3" name="kodepos" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <textarea name="address" id="" cols="30" rows="7" class="form-control text-left px-3"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Pilih Kurir</label>
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select name="kurir" id="kurir" class="form-control  px-3" required>
                                    <option value="0">-- Pilih Kurir --</option>
                                    <?php foreach($datakurir as $k): ?>
                                    <option value="<?= $k['kode']; ?>"><?= $k['kode'].' - '.$k['nama']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Layanan</label>
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select name="layanan" id="layanan" class="form-control px-3" required>
                                    <option value="0">-- Pilih Layanan --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Biaya</label>
                            <input type="hidden" class="form-control text-left px-3" name="weight"
                                value="<?=cartWeight(user()['idusers']);?>">
                            <input type="text" class="form-control text-left px-3" name="ongkir" placeholder="" readonly
                                required>
                        </div>
                        <div class="form-group">
                            <label>Estimasi (Hari)</label>
                            <input type="text" class="form-control text-left px-3" name="estimasi" placeholder=""
                                readonly required>
                            <input type="hidden" name="subtotal">
                            <input type="hidden" name="delivery">
                            <input type="hidden" name="carttotal">
                        </div>
                        <!-- <div class="form-group">
                            <label>Kecamatan/Distrik</label>
                            <input type="text" class="form-control text-left px-3" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Kode Pos</label>
                            <input type="text" class="form-control text-left px-3" placeholder="">
                        </div> -->
                        <!-- </form> -->
                    </div>
                    <p><button type="button" class="btn btn-primary py-3 px-4" id="cekOngkir">Hitung</button>
                    </p>
                </div>
                <?php endif;?>
                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>CART TOTALS</h3>
                        <?php if($this->session->userdata('username') && $this->session->userdata('access')=='customer'):?>
                        <p class="d-flex">
                            <span>SUBTOTAL</span>
                            <span id="cart-subtotal"><?='Rp. '.money(cartsubTotal(user()['idusers']));?></span>
                        </p>
                        <p class="d-flex">
                            <span>DELIVERY</span>
                            <span class="biaya-ongkir">0</span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>TOTAL</span>
                            <span id="cart-total"><?='Rp. '.money(cartsubTotal(user()['idusers']));?></span>
                        </p>
                        <?php else:?>
                        <p class="d-flex">
                            <span>SUBTOTAL</span>
                            <span class="view-cart-total"></span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>TOTAL</span>
                            <span class="view-cart-total" id="cart-total"></span>
                        </p>
                        <?php endif;?>
                        <!-- <p class="d-flex">
                        <span>COUPON</span>
                        <span>0.00</span>
                    </p> -->
                    </div>
                    <?php if($this->session->userdata('username') && $this->session->userdata('access')=='customer'):?>
                    <p>
                        <!-- <a href="<?=base_url('user/proses_order');?>" class="btn btn-primary py-3 px-4">Proceed to
                            Checkout</a> -->
                        <button type="submit" class="btn btn-primary py-3 px-4">Proceed to
                            Checkout</bu>
                    </p>
                    <?php else:?>
                    <p>Anda harus login terlebih dahulu untuk melakuak checkout. Silahkan <a
                            href="<?=base_url('auth');?>">Klik disini</a> untuk login.</p>
                    <?php endif;?>

                </div>
            </div>
        </form>
    </div>









</section>