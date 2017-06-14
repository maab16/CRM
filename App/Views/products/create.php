    <!-- Start Main -->
    <main class="main">
      <!-- Start Sidebar Menu -->
      <?php require_once VIEWS_PATH.DS.'aside.php';?>
      <!--End Sidebar Menu-->
      <!-- Start Content -->
      <section class="content-container">
        <div class="content profile-content">
          <?php

            use \Blab\Libs\Input;

            if(isset($data->product_errors)){
              if(count($data->product_errors)){

                foreach($data->product_errors as $error){

                  echo "<div class='alert-info' style='text-align:center;margin-top:10px;width:100%;'>";
                                  
                  echo "<h1 style='Margine:auto'><span style='color:red'>*</span>".$error . "</h1>".'<br/>';
                  echo "</div>";
                }
              }
            }
          ?>
          <form action="" method="post" class="profile-form" enctype="multipart/form-data">
            <div class="row">
              <div class="form-group">
                <div class="field_label"><label>Code</label> : </div>
                <div class="input_field"><input type="text" name="code" class="code" placeholder="Enter Product Code" value="<?=Input::get('code');?>"></div>
              </div>
              <div class="form-group">
                <div class="field_label"><label>Title</label> : </div>
                <div class="input_field"><input type="text" name="title" class="title" placeholder="Enter Title" value="<?=Input::get('title');?>"></div>
              </div>
              <!-- <div class="form-group">
                <div class="field_label"><label>Password</label> : </div>
                <div class="input_field"><input type="password" name="password" class="password" value="" placeholder="Enter Password"></div>
              </div>
              <div class="form-group">
                <div class="field_label"><label>Re Password</label> : </div>
                <div class="input_field"><input type="password" name="re_password" class="password" value="" placeholder="Re Enter Password"></div>
              </div> -->
              <div class="form-group">
                <div class="field_label"><label>Company</label> : </div>
                <div class="input_field">
                  <select name="company" id="company" class="company form-control">
                    <option value="">SELECT COMPANY</option>
                    <?php
                      if (!empty($data->companies)):
                        foreach($data->companies as $company):
                    ?>
                    <?php if($company->id == Input::get('company')):?>
                      <option value="<?=$company->id;?>" selected><?= $company->company_name;?></option>
                    <?php else:?>
                      <option value="<?=$company->id;?>"><?= $company->company_name;?></option>
                    <?php endif;?>
                    <?php
                      endforeach;
                      endif;
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="field_label"><label>Price</label> : </div>
                <div class="input_field"><input type="number" name="price" class="price" placeholder="Enter Your Price" value="<?=Input::get('price');?>"></div>
              </div>
              <div class="form-group">
                <div class="field_label"><label>Currency</label> : </div>
                <div class="input_field"><input type="text" name="currency" class="currency" placeholder="Enter Currency" value="<?=Input::get('currency');?>"></div>
              </div>
              <div class="form-group">
                <div class="field_label"><label>Status</label> : </div>
                <div class="input_field">
                  <select name="status" id="status" class="status form-control">
                    <option value="">SELECT Availability</option>
                    <?php
                      if (!empty($data->availabilities)):
                        foreach($data->availabilities as $availability):
                    ?>
                    <?php if($availability->code == Input::get('status')):?>
                      <option value="<?=$availability->code;?>" selected><?= $availability->title;?></option>
                    <?php else:?>
                      <option value="<?=$availability->code;?>"><?= $availability->title;?></option>
                    <?php endif;?>
                    <?php
                      endforeach;
                      endif;
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="field_label"><label>Product Image</label> : </div>
                <div class="input_field"><input type="file" name="product_image" class="product_image"></div>
              </div>
            </div>
            <div class="update_profile_container text-center">
              <input type="hidden" name="id" value="<?= $user->id ?: "" ?>">
              <input type="submit" name="create_product" value="Create Product" id="create_product" class="btn btn-lg btn-success">
            </div>
          </form>
        </div>
      </section><!--End Content-->
    </main>