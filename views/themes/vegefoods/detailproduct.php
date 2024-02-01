<div class="hero-wrap hero-bread"
    style="background-image: url('<?=base_url().'views/themes/'.theme_active().'/';?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Beranda</a></span>&gt;
                    <span>Detail Produk</span>
                </p>
                <h1 class="mb-0 bread"><?=$produk->product_name;?></h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate" style="overflow:scroll; height:400px;">
                <?php foreach(produk_gambar(decrypt_url($produk->idproduct)) as $img):?>
                <a href="<?=base_url().'uploads/products/'.$img->image;?>" class="image-popup"><img
                        src="<?=base_url().'uploads/products/'.$img->image;?>" class="img-fluid" alt="<?=$img->image;?>"
                        style="border:1px solid;margin-bottom:5px;width:150px;height:135px;"></a>
                <?php endforeach;?>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3><?=$produk->product_name;?></h3>
                <div class="rating d-flex">
                    <!-- <p class="text-left mr-4">
                        <a href="#" class="mr-2">5.0</a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                    </p> -->
                    <?php 
							$diskon=(int)$produk->diskon;
							$harga=(int)$produk->harga_jual;
							$harga_pas=$harga-$diskon;
							$hasil=ceil(($diskon/$harga)*100); ?>
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2" style="color: #000;"><?=$hasil.'%';?> <span
                                style="color: #bbb;">Diskon</span></a>
                    </p>
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2" style="color: #000;"><?=jmlTerjual($produk->idproduct)->terjual;?>
                            <span style="color: #bbb;">Terjual</span></a>
                    </p>
                    <p class="text-left">
                        <a href="#" class="mr-2" style="color: #000;"><?=$produk->stok;?> <span
                                style="color: #bbb;">Stok Tersedia</span></a>
                    </p>
                </div>
                <p class="price">
                    <?php if($produk->diskon!=0):?>
                    <span style="font-size:16pt;color:green;text-decoration:line-through solid;">
                        <?=money($produk->diskon);?>
                    </span>
                    <?php endif;?>
                    <span><?=money($harga_pas);?></span>
                </p>
                <p>
                    <?=$produk->keterangan;?>
                </p>
                <div class="row mt-4">
                    <!-- <div class="col-md-6">
                        <div class="form-group d-flex">
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select name="" id="" class="form-control">
                                    <option value="">Small</option>
                                    <option value="">Medium</option>
                                    <option value="">Large</option>
                                    <option value="">Extra Large</option>
                                </select>
                            </div>
                        </div>
                    </div> -->
                    <div class="w-100"></div>
                    <div class="input-group col-md-6 d-flex mb-3">
                        <span class="input-group-btn mr-2">
                            <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                <i class="ion-ios-remove"></i>
                            </button>
                        </span>
                        <input type="text" id="<?=$produk->idproduct;?>" name="qty"
                            class="quantity form-control input-number" value="1" min="1" max="100" readonly>
                        <span class="input-group-btn ml-2">
                            <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                <i class="ion-ios-add"></i>
                            </button>
                        </span>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <p style="color: #000;"><?=$produk->berat;?> gram available</p>
                        <!-- <p class="text-left mr-4">
                            <a href="#" class="mr-2">5.0</a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                        </p> -->
                    </div>

                </div>
                <?php if($produk->stok>0):?>
                <?php if($this->session->userdata('username') && $this->session->userdata('access')=='customer'):?>
                <p class="text-center"><a href="#" class="buy-now-login btn btn-black py-3 px-5"
                        data-produkid="<?=$produk->idproduct;?>" data-produkgambar="<?=$produk->product_image;?>"
                        data-produknama="<?=$produk->product_name;?>" data-produkharga="<?=$harga_pas;?>"
                        data-produksatuan="<?=$produk->satuan;?>" data-produkberat="<?=$produk->berat;?>">Add to
                        Cart</a></p>
                <?php else:?>
                <p class="text-center"><a href="#" class="buy-now btn btn-black py-3 px-5"
                        data-produkid="<?=$produk->idproduct;?>" data-produkgambar="<?=$produk->product_image;?>"
                        data-produknama="<?=$produk->product_name;?>" data-produkharga="<?=$harga_pas;?>"
                        data-produksatuan="<?=$produk->satuan;?>" data-produkberat="<?=$produk->berat;?>">Add to
                        Cart</a></p>
                <?php endif;?>
                <?php endif;?>
            </div>
        </div>
    </div>




</section>
