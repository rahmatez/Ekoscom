<div class="hero-wrap hero-bread"
    style="background-image: url('<?=base_url().'views/themes/'.theme_active().'/';?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Beranda</a></span>&gt;
                    <span>Produk</span>
                </p>
                <h1 class="mb-0 bread">Produk Kami</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
    <div class="container">
        <!-- <div class="row justify-content-center">
            <div class="col-md-12 mb-5 text-center">
                <ul class="product-category">
                    <li><a href="#" class="active">All</a></li>
                    <li><a href="#">Vegetables</a></li>
                    <li><a href="#">Fruits</a></li>
                    <li><a href="#">Juice</a></li>
                    <li><a href="#">Dried</a></li>
                    <li><a href="#">Vegetables</a></li>
                    <li><a href="#">Fruits</a></li>
                    <li><a href="#">Juice</a></li>
                    <li><a href="#">Dried</a></li>
                    <li><a href="#">Vegetables</a></li>
                    <li><a href="#">Fruits</a></li>
                    <li><a href="#">Juice</a></li>
                    <li><a href="#">Dried</a></li>
                    <li><a href="#">Vegetables</a></li>
                    <li><a href="#">Fruits</a></li>
                    <li><a href="#">Juice</a></li>
                    <li><a href="#">Dried</a></li>
                    <li><a href="#">Vegetables</a></li>
                    <li><a href="#">Fruits</a></li>
                    <li><a href="#">Juice</a></li>
                    <li><a href="#">Dried</a></li>
                    <li><a href="#">Vegetables</a></li>
                    <li><a href="#">Fruits</a></li>
                    <li><a href="#">Juice</a></li>
                    <li><a href="#">Dried</a></li>
                </ul>
            </div>
        </div> -->
        <div class="row">
            <?php
            $page = (isset($_GET['page']))?$_GET['page']:1;
            $limit = 12;
            $limit_start = ($page-1)*$limit;
            $query = $this->db->query("SELECT * FROM product LIMIT ".$limit_start.",".$limit)->result_array();
            ?>
            <?php foreach($query as $p):?>
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
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul>
                        <?php if($page!=1): $link_prev=($page>1)?$page-1:1;?>
                        <li><a href="<?=base_url('public/product');?>?page=1">&lt;&lt;</a></li>
                        <li><a href="<?=base_url('public/product');?>?page=<?=$link_prev;?>">&lt;</a></li>
                        <?php endif;?>
                        <?php
						// $sql = $this->db->query("SELECT COUNT(*) AS jumlah FROM product")->result_array();
						$jml_page = ceil(count(produk())/$limit);
						$jml_number = 1;
						$start_number = ($page>$jml_number)?$page-$jml_number:1;
						$end_number = ($page<($jml_page-$jml_number))?$page+$jml_number:$jml_page;
						for ($i = $start_number; $i <= $end_number; $i++) :
							$link_active = ($page == $i) ? 'class="active"' : '';
						?>
                        <li <?=$link_active;?>><span><a
                                    href="<?=base_url('public/product');?>?page=<?=$i;?>"><?=$i;?></a></span></li>
                        <?php endfor;?>
                        <?php if($page!=$jml_page): $link_next=($page<$jml_page)?$page+1:$jml_page;?>
                        <li><a href="<?=base_url('public/product');?>?page=<?=$link_next;?>">&gt;</a></li>
                        <li><a href="<?=base_url('public/product');?>?page=<?=$jml_page;?>">&gt;&gt;</a></li>
                        <?php endif;?>
                        <!-- <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&gt;</a></li>
                        <li><a href="#">&gt;&gt;</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>