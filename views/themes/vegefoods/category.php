<div class="hero-wrap hero-bread"
    style="background-image: url('<?=base_url().'views/themes/'.theme_active().'/';?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Beranda</a></span>&gt;
                    <span>Kategori</span>
                </p>
                <h1 class="mb-0 bread">KATEGORI PRODUK KAMI</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-category ftco-no-pt mt-4">
    <div class="container">
        <div class="row justify-content-center mt-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <!-- <h3 class="mb-4">KATEGORI PRODUK KAMI</h3> -->
                <!-- <span class="subheading">Featured Products</span> -->
                <!-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p> -->
            </div>
        </div>
        <div class="row">
            <?php
			$page = (isset($_GET['page']))?$_GET['page']:1;
			$limit = 12;
			$limit_start = ($page-1)*$limit;
			$query = $this->db->query("SELECT * FROM product_category LIMIT ".$limit_start.",".$limit)->result_array();
			?>
            <?php foreach($query as $pk):?>
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
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul>
                        <?php if($page!=1): $link_prev=($page>1)?$page-1:1;?>
                        <li><a href="<?=base_url('public/category');?>?page=1">&lt;&lt;</a></li>
                        <li><a href="<?=base_url('public/category');?>?page=<?=$link_prev;?>">&lt;</a></li>
                        <?php endif;?>
                        <?php
						// $sql = $this->db->query("SELECT COUNT(*) AS jumlah FROM category")->result_array();
						$jml_page = ceil(count(produk_kategori())/$limit);
						$jml_number = 1;
						$start_number = ($page>$jml_number)?$page-$jml_number:1;
						$end_number = ($page<($jml_page-$jml_number))?$page+$jml_number:$jml_page;
						for ($i = $start_number; $i <= $end_number; $i++) :
							$link_active = ($page == $i) ? 'class="active"' : '';
						?>
                        <li <?=$link_active;?>><span><a
                                    href="<?=base_url('public/category');?>?page=<?=$i;?>"><?=$i;?></a></span></li>
                        <?php endfor;?>
                        <?php if($page!=$jml_page): $link_next=($page<$jml_page)?$page+1:$jml_page;?>
                        <li><a href="<?=base_url('public/category');?>?page=<?=$link_next;?>">&gt;</a></li>
                        <li><a href="<?=base_url('public/category');?>?page=<?=$jml_page;?>">&gt;&gt;</a></li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </div>
</section>