    <!-- Start Main -->

    <main class="main">

      <!-- Start Sidebar Menu -->

      <?php require_once VIEWS_PATH.DS.'aside.php';?>

      <!--End Sidebar Menu-->

      <!-- Start Content -->

      <section class="content-container">

        <div class="content profile-content">

          <?php 

              if(!empty($data->product)):

               $product = $data->product;

          ?>

          <div class="row">

              <div class="col-sm-5">

                <div class="profile-image-container">
                  <img src="/assets/images/products/<?= $product->product_image ? $product->product_image : "avator.png"?>" class="img-responsive">
                </div>

              </div>

              <div class="col-sm-7">

                <h2 class="title"><?= $product->title ?: ""?></h2>


                <p class="overview">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat nam mollitia officiis deleniti quae quos. Nulla voluptate, quibusdam dolor vero sed voluptatum, incidunt eum dicta, iste beatae animi inventore repudiandae.</p>

              </div>

            </div>

            <div class="row">

              <?php if($product->code):?>

              <div class="form-group">

                <div class="field_label"><span>Product Code</span> : </div>

                <div class="field_value"><span><?=$product->code ?: "" ?></span></div>

              </div>

              <?php endif;?>

              <?php if($product->company):?>

              <div class="form-group">

                <div class="field_label"><span>Company</span> : </div>

                <div class="field_value"><span><?= $product->company ?: "" ?></span></div>

              </div>

              <?php endif;?>

              <?php if($product->vat_no):?>

              <div class="form-group">

                <div class="field_label"><span>Vat No</span> : </div>

                <div class="field_value"><span><?= $product->vat_no ?: "" ?></span></div>

              </div>

              <?php endif;?>

              <?php if($product->reg_no):?>

              <div class="form-group">

                <div class="field_label"><span>Registry No</span> : </div>

                <div class="field_value"><span><?= $product->reg_no ?: "" ?></span></div>

              </div>

              <?php endif;?>

              <?php if($product->price):?>

              <div class="form-group">

                <div class="field_label"><span>Price</span> : </div>

                <div class="field_value"><span><?= $product->price ?: "" ?></span></div>

              </div>

              <?php endif;?>

              <?php if($product->currency):?>

              <div class="form-group">

                <div class="field_label"><span>Currency</span> : </div>

                <div class="field_value"><span><?= $product->currency ?: "" ?></span></div>

              </div>

              <?php endif;?>

              <?php if($product->availability):?>

              <div class="form-group">

                <div class="field_label"><span>Availability</span> : </div>

                <div class="field_value"><span><?= $product->availability ?: "" ?></span></div>

              </div>

              <?php endif;?>

            </div>

          <?php endif;?>

        </div>

      </section><!--End Content-->

    </main>