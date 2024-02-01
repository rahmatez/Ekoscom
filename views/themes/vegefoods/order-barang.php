<div class="hero-wrap hero-bread"
    style="background-image: url('<?=base_url().'views/themes/'.theme_active().'/';?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="<?=base_url();?>">Beranda</a></span>&gt;
                    <span>Proses</span>
                </p>
                <h1 class="mb-0 bread">Pesanan Dalam Proses</h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section contact-section bg-white">
    <div class="container">
        <div class="row block-9 table-responsive" style="overflow:scroll; height:400px;width:100%;">
            <table class="table">
                <thead class="thead-primary">
                    <tr class="text-center">
                        <th>Order ID</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Satuan</th>
                        <th>Berat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					foreach($orderan_barang as $o):?>
                    <tr class="text-center">
                        <td><?=$o->code;?></td>
                        <td><?=date('Y-m-d H:i:s',$o->datetime);?></td>
                        <td><?=$o->product_name;?></td>
                        <td><?=$o->qty;?></td>
                        <td><?=$o->harga;?></td>
                        <td><?=$o->satuan;?></td>
                        <td><?=$o->berat;?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</section>
