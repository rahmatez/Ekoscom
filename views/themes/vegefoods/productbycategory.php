<div class="hero-wrap hero-bread"
    style="background-image: url('<?=base_url().'views/themes/'.theme_active().'/';?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Beranda</a></span>&gt;
                    <span>Produk By Kategori</span>
                </p>
                <h1 class="mb-0 bread"><?=$kategori->category_name;?></h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <h3 class="mb-4">PRODUK DENGAN KATEGORI "<?=$kategori->category_name;?>"</h3>
        <div class="row">
            <?php
			$id = _toInteger($this->uri->segment(2));
			$page = (isset($_GET['page']))?$_GET['page']:1;
			$limit = 8;
			$limit_start = ($page-1)*$limit;
			$query = $this->db->query("SELECT * FROM product WHERE category_id='$id' LIMIT ".$limit_start.",".$limit)->result_array();
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
                <?php if(count($query)>0):?>
                <div class="block-27">
                    <ul>
                        <?php if($page!=1): $link_prev=($page>1)?$page-1:1;?>
                        <li><a
                                href="<?=base_url();?>category/<?=$kategori->idcategory;?>/<?=$kategori->category_seo;?>?page=1">&lt;&lt;</a>
                        </li>
                        <li><a
                                href="<?=base_url();?>category/<?=$kategori->idcategory;?>/<?=$kategori->category_seo;?>?page=<?=$link_prev;?>">&lt;</a>
                        </li>
                        <?php endif;?>
                        <?php
						$sql = $this->db->query("SELECT * FROM product WHERE category_id=".$kategori->idcategory)->result_array();
						$jml_page = ceil(count($sql)/$limit);
						$jml_number = 1;
						$start_number = ($page>$jml_number)?$page-$jml_number:1;
						$end_number = ($page<($jml_page-$jml_number))?$page+$jml_number:$jml_page;
						for ($i = $start_number; $i <= $end_number; $i++) :
							$link_active = ($page == $i) ? 'class="active"' : '';
						?>
                        <li <?=$link_active;?>><span><a
                                    href="<?=base_url();?>category/<?=$kategori->idcategory;?>/<?=$kategori->category_seo;?>?page=<?=$i;?>"><?=$i;?></a></span>
                        </li>
                        <?php endfor;?>
                        <?php if($page!=$jml_page): $link_next=($page<$jml_page)?$page+1:$jml_page;?>
                        <li><a
                                href="<?=base_url();?>category/<?=$kategori->idcategory;?>/<?=$kategori->category_seo;?>?page=<?=$link_next;?>">&gt;</a>
                        </li>
                        <li><a
                                href="<?=base_url();?>category/<?=$kategori->idcategory;?>/<?=$kategori->category_seo;?>?page=<?=$jml_page;?>">&gt;&gt;</a>
                        </li>
                        <?php endif;?>
                    </ul>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>
