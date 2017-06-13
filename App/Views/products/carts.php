<!-- Start Main -->
<main class="main">
  <!-- Start Sidebar Menu -->
  <?php require_once VIEWS_PATH.DS.'aside.php';?>
  <!--End Sidebar Menu-->
  <!-- Start Content -->
  <section class="content-container">
    <div class="content">
      <?php if(!empty($data->cart)):?>
      <div class="invoice">
        <h3 class="title invoice-title">Carts</h3>
        <table class="table">
          <thead>
              <tr>  
                  <th>Title</th>
                  <th>Unique Price</th>          
                  <th>Qty</th>
                  <th>Total</th>
                  <th>Issued</th>
                  <th class="text-center">Actions</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach($data->cart as $cart):?>
                <tr>
                    <td scope="row" class="invoice-title">
                      <div class="invoice-img"><img src="/assets/images/products/<?= ($cart->product_image) ? $cart->product_image : 'avator.png';?>" alt="C" title="Libera" class="img-responsive"></div>
                        <div class="invoice-meta">
                          <h2 class="invoice-id">#<?=$cart->product_code;?></h2>
                          <p class="invoice-brand"><?=$cart->company_name;?></p>
                        </div>
                    </td>
                    <td><?=$cart->price?></td>
                    <td><?=$cart->qty?></td>
                    <td><?=($cart->price * $cart->qty);?></td>
                    <td><?=date("M , y", strtotime($cart->issued_date) )?></td>
                    <td class="action-fields">
                        <a class="edit" href="/invoice/update/<?=$cart->product_id;?>"><i class="fa fa-pencil"></i></a>
                        <a class="delete" href="/invoice/delete/<?=$cart->product_id;?>"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
              <?php endforeach;?>
          </tbody>
      </table>
      <div id='pagination_controls'>
        <?php

          if (!empty($data->pagination_controll)) {
          
            echo $data->pagination_controll;
          }
        ?>
      </div>
      </div>
      <?php else:?>
        <h3>There is no Cart Item</h3>
      <?php endif;?>
    </div>
  </section><!--End Content-->
</main>