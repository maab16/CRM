    <main class="main">
    <?php require_once VIEWS_PATH.DS.'aside.php';?>
     <section class="content-container">
    <h2 class="title dashboard-title">All Products</h2>
    <div class="content">
      <div class="row">
         <div class="invoice">
            <table class="table">
              <thead>
                  <tr>  
                      <th>Product</th>           
                      <th>Price</th>
                      <th>QTY</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php if(!empty($data->products)):?><!-- Start Product List if not user product -->
                  <?php foreach($data->products as $product):?><!-- Start Foreach Loop for Product List if not user product -->
                  <tr>
                      <td scope="row" class="invoice-title">
                          <div class="invoice-img"><img src="/assets/images/products/<?= $product->product_image ? $product->product_image : "avator.png"?>" class="img-responsive"></div>
                          <div class="invoice-meta">
                              <h2 class="invoice-id">#<?=$product->code;?></h2>
                              <p class="invoice-brand"><?=$product->company;?></p>
                          </div>
                      </td>
                      <td><?=$product->currency." ".$product->price;?></td>
                      <td><input type="number" name="qty" min="0" id="qty_<?=$product->id?>" class="qty" value="<?=$product->qty?>"></td>
                      <td class="action-fields">
                          <button class="edit" onclick="updateCart('<?=$product->id?>','<?=$product->user?>','qty_<?=$product->id?>');">Update Cart</button>
                      </td>
                  </tr>
                  <?php endforeach;?><!-- End Foreach Loop for Product List if not user product -->
                  <?php endif;?><!-- End Product List if not user product -->
              </tbody>
          </table>
        </div>

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