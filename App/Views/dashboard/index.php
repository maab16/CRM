    <?php

      require_once VIEWS_PATH.DS.'header.php';

     

    ?>

    <!-- Start Main -->

    <main class="main">

      <!-- Start Sidebar Menu -->

      <?php require_once VIEWS_PATH.DS.'aside.php';?>

      <!--End Sidebar Menu-->

      <!-- Start Content -->

      <section class="content-container">

        <h2 class="title">Dashboard</h2>

        <div class="content">

        <?php if($user->isLoggedIn()):?>

          <?php if((new \Blab\Libs\Permission())->hasPermission('admin')):?>

          <div class="row">

            <!-- Start Category Item 1-->

            <div class="col-sm-4 col-md-3">

              <div class="category-item">

                <!-- Start Category Top-->

                <div class="category-item-top">

                  <div class="category-item-logo">

                    <i class="fa fa-users" aria-hidden="true"></i>

                  </div>

                  <div class="category-item-content">

                    

                    <span class="total-students"><?=$data->total_users;?></span>

                    <h3>Users</h3>

                  </div>

                </div><!-- End Category Top -->

                <!-- Start Category Bottom -->

                <div class="category-item-bottom">

                  <a href="/users/">View All</a>

                  <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                </div><!-- End Category Bottom -->

              </div>

            </div><!-- End Category Item 1 -->

            <!-- Start Category Item 2 -->

            <div class="col-sm-4 col-md-3">

              <div class="category-item course-category">

                <!-- Start Category Top -->

                <div class="category-item-top">

                  <div class="category-item-logo">

                    <i class="fa fa-book" aria-hidden="true"></i>

                  </div>

                  <div class="category-item-content">

                    

                    <span class="total-students"><?=$data->total_products;?></span>

                    <h3>Products</h3>

                  </div>

                </div><!-- End Category Top -->

                <!-- Start Category Bottom -->

                <div class="category-item-bottom">

                  <a href="/products/">View All</a>

                  <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                </div><!-- End Category Bottom -->

              </div>

            </div><!-- End Category Item 2 -->

            <!-- Start Category Item 3-->

            <div class="col-sm-4 col-md-3">

              <div class="category-item class-category">

                <!-- Start Category Top -->

                <div class="category-item-top">

                  <div class="category-item-logo">

                    <i class="fa fa-users" aria-hidden="true"></i>

                  </div>

                  <div class="category-item-content">

                    <span class="total-students"><?=$data->total_companies;?></span>

                    <h3>Companies</h3>

                  </div>

                </div><!-- End Category Top -->

                <!-- Start Category Bottom -->

                <div class="category-item-bottom">

                  <a href="/companies/">View All</a>

                  <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                </div><!-- End Category Bottom -->

              </div>

            </div><!-- End Category Item 3 -->

            <!-- Start Category Item 4 -->

            <div class="col-sm-4 col-md-3">

              <div class="category-item test-category">

                <!-- Start Category Top-->

                <div class="category-item-top">

                  <div class="category-item-logo">

                    <i class="fa fa-users" aria-hidden="true"></i>

                  </div>

                  <div class="category-item-content">

                    <span class="total-students"><?=$data->total_carts;?></span>

                    <h3>Carts</h3>

                  </div>

                </div><!-- End Category Top -->

                <!-- Start Category Bottom -->

                <div class="category-item-bottom">

                  <a href="/dashboard/carts/">View All</a>

                  <i class="fa fa-long-arrow-right" aria-hidden="true"></i>

                </div><!-- End Category Bottom-->

              </div>

            </div><!-- End Category Item 4 -->

          </div><!-- End Category Items -->

          <?php endif;?>
        
        <?php endif;?>
        <?php
        ?>
          <div class="invoice">

            <h3 class="title invoice-title">Invoice List</h3>

            <?php if(!empty($data->cart)):?>

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

                            <a class="download" href="/Invoice/index/<?=$cart->product_id;?>"><i class="fa fa-download" aria-hidden="true"></i></a>

                            <a class="delete" href="/invoice/delete/<?=$cart->product_id;?>"><i class="fa fa-times"></i></a>

                        </td>

                    </tr>

                  <?php endforeach;?>

              </tbody>

          </table>

          <?php else:?>

            <h3>There is no Invoices</h3>

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

    <?php require_once VIEWS_PATH.DS.'footer.php';?>