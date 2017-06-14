<!-- Start Main -->
<main class="main">
  <!-- Start Sidebar Menu -->
  <?php require_once VIEWS_PATH.DS.'aside.php';?>
  <!--End Sidebar Menu-->
  <!-- Start Content -->
  <section class="content-container">
    <div class="content">
      <div class="invoice">
        <h3 class="title invoice-title">All Carts</h3>
        <?php if(!empty($data->carts)):?>
        <table class="table">
          <thead>
              <tr>  
                  <th>Title</th>
                  <th>Username</th>
                  <th>Unique Price</th>          
                  <th>Qty</th>
                  <th>Total</th>
                  <th>Issued</th>
                  <th class="text-center">Actions</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach($data->carts as $cart):?>
                <tr>
                    <td scope="row" class="invoice-title">
                      <div class="invoice-img"><img src="/assets/images/products/<?= ($cart->product_image) ? $cart->product_image : 'avator.png';?>" alt="C" title="Libera" class="img-responsive"></div>
                        <div class="invoice-meta">
                          <h2 class="invoice-id">#<?=$cart->product_code;?></h2>
                          <p class="invoice-brand"><?=$cart->company_name;?></p>
                        </div>
                    </td>
                    <td><?=$cart->username?></td>
                    <td><?=$cart->price?></td>
                    <td><?=$cart->qty?></td>
                    <td><?=($cart->price * $cart->qty);?></td>
                    <td><?=date("M , y", strtotime($cart->issued_date) )?></td>
                    <td class="action-fields">
                        <a class="download" href="/Invoice/index/<?=$cart->product_id;?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                        <!-- <a class="edit" href="/invoice/update/<?=$cart->product_id;?>"><i class="fa fa-pencil"></i></a> -->
                        <a class="delete" href="/dashboard/delete_cart/<?=$cart->product_id;?>"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
              <?php endforeach;?>
          </tbody>
      </table>
      <?php endif;?>
      <div id='pagination_controls'>
        <?php

          if (!empty($data->pagination_controll)) {
          
            echo $data->pagination_controll;
          }
        ?>
      </div>
      </div>
    </div>
  </section><!--End Content-->
</main>