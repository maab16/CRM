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

                      <th>Status</th>

                      <th class="text-center">Actions</th>

                  </tr>

              </thead>

              <tbody>

              <?php 

                if((new \Blab\Libs\Blab_User())->isLoggedIn()):

                  if((new \Blab\Libs\Permission())->hasPermission('admin') || (new \Blab\Libs\Permission())->hasPermission('moderator')):

              ?>

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

                      <td><?=$product->status;?></td>

                      <td class="action-fields">

                        <a class="edit" href="/products/view/<?=$product->id?>"><i class="fa fa-eye"></i></a>

                        <a class="edit" href="/products/update/<?=$product->id?>"><i class="fa fa-pencil"></i></a>

                        <a class="delete" href="/products/delete/<?=$product->id?>"><i class="fa fa-times"></i></a>

                      </td>

                  </tr>

                  <?php endforeach;?><!-- End Foreach Loop for Product List if not user product -->

                <?php endif;?><!-- End Product List if not user product -->

              <?php else:?>

                <!-- Start Check User Product -->

                <?php 

                  if(!empty($data->user_products)):

                    foreach ($data->user_products as $user_product) {

                      $ids[] =  $user_product->product_id;

                    }

                ?>



                  <?php if(!empty($data->products)):?><!-- Start Product List if user product exists -->

                    <?php foreach($data->products as $product):?><!-- Start Foreach Loop for Product List if user product exists -->

                      <?php if(in_array($product->id, $ids)):?><!-- Start If ID matched in product id and user product id -->

                    <tr class="already-cart">

                        <td scope="row" class="invoice-title">

                            <div class="invoice-img"><img src="/assets/images/products/<?= $product->product_image ? $product->product_image : "avator.png"?>" class="img-responsive"></div>

                            <div class="invoice-meta">

                                <h2 class="invoice-id">#<?=$product->code;?></h2>

                                <p class="invoice-brand"><?=$product->company;?></p>

                            </div>

                        </td>

                        <td><?=$product->currency." ".$product->price;?></td>

                        <td><input type="number" name="qty" min="0" id="qty_<?=$product->id?>" class="qty" value="<?=(new \Blab\Libs\Blab_User())->getSingleCart($product->id)->qty;?>" disabled></td>

                        <td><?=$product->status;?></td>

                        <td class="action-fields">
                          <a class="edit" href="/products/view/<?=$product->id?>"><i class="fa fa-eye"></i></a>
                          <button class="edit" onclick="addToCart('<?=$product->id?>','<?=$data->user?>','qty_<?=$product->id?>');" disabled>Already Carted</button>

                        </td>

                    </tr>

                  <?php else:?><!-- Else ID matched in product id and user product id -->

                    <tr>

                        <td scope="row" class="invoice-title">

                            <div class="invoice-img"><img src="/assets/images/products/<?= $product->product_image ? $product->product_image : "avator.png"?>" class="img-responsive"></div>

                            <div class="invoice-meta">

                                <h2 class="invoice-id">#<?=$product->code;?></h2>

                                <p class="invoice-brand"><?=$product->company;?></p>

                            </div>

                        </td>

                        <td><?=$product->currency." ".$product->price;?></td>

                        <td><input type="number" name="qty" min="0" id="qty_<?=$product->id?>" class="qty" value="1"></td>

                        <td><?=$product->status;?></td>

                        <td class="action-fields">
                          <a class="edit" href="/products/view/<?=$product->id?>"><i class="fa fa-eye"></i></a>
                          <button class="edit" onclick="addToCart('<?=$product->id?>','<?=$data->user?>','qty_<?=$product->id?>');">Add to Cart</button>

                        </td>

                    </tr>

                  <?php endif;?><!-- End If ID matched in product id and user product id -->

                    <?php endforeach;?><!-- End Foreach Loop for Product List if user product exists -->

                  <?php endif;?><!-- End Product List if user product exists -->

                <?php else:?><!-- Else Check User Product -->

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

                      <td><input type="number" name="qty" min="0" id="qty_<?=$product->id?>" class="qty" value="1"></td>

                      <td><?=$product->status;?></td>

                      <td class="action-fields">
                        <a class="edit" href="/products/view/<?=$product->id?>"><i class="fa fa-eye"></i></a>
                        <button class="edit" onclick="addToCart('<?=$product->id?>','<?=$data->user?>','qty_<?=$product->id?>');">Add to Cart</button>

                      </td>

                  </tr>

                  <?php endforeach;?><!-- End Foreach Loop for Product List if not user product -->

                  <?php endif;?><!-- End Product List if not user product -->

                <?php endif;?><!-- End Check User Product -->

              <?php endif;?>

            <?php endif;?>

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