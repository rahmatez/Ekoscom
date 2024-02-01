<section id="home-section" class="hero">
    <div class="home-slider owl-carousel">
        <?php foreach(slider() as $s):?>
        <div class="slider-item" style="background-image: url(<?=base_url().'uploads/'.$s['image'];?>);">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

                    <div class="col-md-12 ftco-animate text-center">
                        <h1 class="mb-2"><?=$s['title'];?></h1>
                        <h2 class="subheading mb-4"><?=$s['sub_title'];?></h2>
                        <!-- <a><a href="#" class="btn btn-primary">View Details</a></p> -->
                    </div>

                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row no-gutters ftco-services">
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-shipped"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Free Shipping</h3>
                        <span>On order over $100</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-diet"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Always Fresh</h3>
                        <span>Product well package</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-award"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Superior Quality</h3>
                        <span>Quality Products</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services mb-md-0 mb-4">
                    <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                        <span class="flaticon-customer-service"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Support</h3>
                        <span>24/7 Support</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-category ftco-no-pt">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 align-items-stretch d-flex">
                        <div class="category-wrap-2 ftco-animate img align-self-stretch d-flex"
                            style="background-image: url(<?=base_url().'views/themes/'.theme_active().'/';?>images/category.jpg);">
                            <div class="text text-center">
                                <h2>KATEGORI PRODUK</h2>
                                <p>Silahkan pilih kategori produk yang ada</p>
                                <p><a href="<?=base_url('public/category');?>" class="btn btn-primary">Semua
                                        Kategori</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <?php foreach(produk_kategori() as $pk):?>
                            <div class="col-md-3">
                                <a href="<?=base_url('category/').$pk['idcategory'].'/'.$pk['category_seo'];?>">
                                    <div class="category-wrap ftco-animate img mb-2 d-flex align-items-end"
                                        style="background-image: url(<?=base_url().'uploads/category/'.$pk['category_image'];?>);">
                                        <div class="text px-3 py-1">
                                            <h2 class="mb-0" style="color:white;"><?=$pk['category_name'];?></h2>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

<section class="ftco-section" style="margin-top:-65px;">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <!-- <span class="subheading">Featured Products</span> -->
                <h2 class="mb-4">PRODUK KAMI</h2>
				
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed nisi orci.</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php foreach(produk(null,null,8) as $p):?>
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="<?=base_url();?>detail/<?=encrypt_url($p['idproduct']);?>/<?=$p['product_seo'];?>"
                        class="img-prod"><img class="img-fluid"
                            src="<?=base_url().'uploads/products/'.$p['product_image'];?>"
                            alt="<?=$p['product_image'];?>" style="width:100%;height:200px;">
                        <?php 
							$diskon=(int)$p['diskon'];
							$harga=(int)$p['harga_jual'];
							$harga_pas=$harga-$diskon;
							$hasil=ceil(($diskon/$harga)*100); ?>
                        <?php if($p['diskon']!=0):?>
                        <span class="status">Diskon <?=$hasil.' %';?></span>
                        <?php endif;?>
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a
                                href="<?=base_url();?>detail/<?=encrypt_url($p['idproduct']);?>/<?=$p['product_seo'];?>"><?=$p['product_name'];?></a>
                        </h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price">
                                    <?php if($p['diskon']!=0):?>
                                    <span class="mr-2 price-dc"><?=money($p['diskon']);?></span>
                                    <?php endif;?>
                                    <span class="price-sale"><?=money($harga_pas);?></span>
                                </p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="<?=base_url();?>detail/<?=encrypt_url($p['idproduct']);?>/<?=$p['product_seo'];?>"
                                    class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                    <span><i class="ion-ios-menu"></i></span>
                                </a>
                                <?php if($p['stok']!=0):?>
                                <?php if($this->session->userdata('username') && $this->session->userdata('access')=='customer'):?>
                                <input type="hidden" id="<?=$p['idproduct'];?>" name="qty" value="1">
                                <a href="#" class="buy-now-login d-flex justify-content-center align-items-center mx-1"
                                    data-produkid="<?=$p['idproduct'];?>" data-produkgambar="<?=$p['product_image'];?>"
                                    data-produknama="<?=$p['product_name'];?>" data-produkharga="<?=$harga_pas;?>"
                                    data-produksatuan="<?=$p['satuan'];?>" data-produkberat="<?=$p['berat'];?>">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a>
                                <?php else:?>
                                <input type="hidden" id="<?=$p['idproduct'];?>" name="qty" value="1">
                                <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1"
                                    data-produkid="<?=$p['idproduct'];?>" data-produkgambar="<?=$p['product_image'];?>"
                                    data-produknama="<?=$p['product_name'];?>" data-produkharga="<?=$harga_pas;?>"
                                    data-produksatuan="<?=$p['satuan'];?>" data-produkberat="<?=$p['berat'];?>">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a>
                                <?php endif;?>
                                <?php endif;?>
                                <!-- <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                    <span><i class="ion-ios-heart"></i></span>
                                </a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <a href="<?=base_url('public/product');?>"><span class="subheading">-- LIHAT SEMUA PRODUK KAMI
                        --</span></a>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section testimony-section" style="margin-top:-95px;">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-7 heading-section ftco-animate text-center">
                <!-- <span class="subheading">Testimony</span> -->
                <h2 class="mb-4">TESTIMONI PELANGGAN</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed nisi orci. Vestibulum vestibulum fermentum dui, vitae ullamcorper ipsum imperdiet id.</p>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel">
                    <?php foreach(testi() as $testi):?>
                    <div class="item">
                        <div class="testimony-wrap p-4 pb-5">
                            <!-- <div class="user-img mb-5"
                                style="background-image: url(<?=base_url().'views/themes/'.theme_active().'/';?>images/person_1.jpg)">
                                <span class="quote d-flex align-items-center justify-content-center">
                                    <i class="icon-quote-left"></i>
                                </span>
                            </div> -->
                            <div class="text text-center">
                                <p class="mb-5 pl-4 line"><?=$testi['message'];?></p>
                                <p class="name"><?=$testi['name'];?></p>
                                <span class="position"><?=$testi['job'];?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>

            </div>
        </div>
    </div>
</section>
