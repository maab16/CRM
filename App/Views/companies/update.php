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

            if(isset($data->company_errors)){
              if(count($data->company_errors)){

                foreach($data->company_errors as $error){

                  echo "<div class='alert-info' style='text-align:center;margin-top:10px;width:100%;'>";
                                  
                  echo "<h1 style='Margine:auto'><span style='color:red'>*</span>".$error . "</h1>".'<br/>';
                  echo "</div>";
                }
              }
            }
          ?>
          <?php
            if (!empty($data->company)):
              $company = $data->company;
          ?>
          <form action="" method="post" class="profile-form" enctype="multipart/form-data">
            <div class="row">
              <div class="form-group">
                <div class="field_label"><label>Comapny name</label> : </div>
                <div class="input_field"><input type="text" name="company_name" class="company_name" placeholder="Enter Comapny Name" value="<?=$company->company_name;?>"></div>
              </div>
              <div class="form-group">
                <div class="field_label"><label>Email</label> : </div>
                <div class="input_field"><input type="text" name="email" class="email" placeholder="Enter Email" value="<?=$company->email;?>"></div>
              </div>
             <div class="form-group">
                <div class="field_label"><label>Vat No</label> : </div>
                <div class="input_field"><input type="text" name="vat_no" class="vat_no" placeholder="Enter Vat Number" value="<?=$company->vat_no;?>"></div>
              </div>
              <div class="form-group">
                <div class="field_label"><label>Reg No</label> : </div>
                <div class="input_field"><input type="text" name="reg_no" class="reg_no" placeholder="Enter Registry Number" value="<?=$company->reg_no;?>"></div>
              </div>
              <div class="form-group">
                <div class="field_label"><label>Phone No</label> : </div>
                <div class="input_field"><input type="text" name="phone" class="phone" placeholder="Enter Phone Number" value="<?=$company->phone;?>"></div>
              </div>
              <div class="form-group">
                <div class="field_label"><label>Website</label> : </div>
                <div class="input_field"><input type="text" name="website" class="website" placeholder="Enter Website URL" value="<?=$company->website;?>"></div>
              </div>
              <div class="form-group">
                <div class="field_label"><label>Company Image</label> : </div>
                <div class="input_field"><input type="file" name="company_image" class="product_image"></div>
              </div>
              <div class="form-group">
                <div class="field_label"><label>Address</label> : </div>
                <div class="input_field"><textarea name="address" id="address" placeholder="Enter Your Address"><?=$company->address;?></textarea></div>
              </div>
            </div>
            <div class="update_profile_container text-center">
              <input type="hidden" name="id" value="<?= $company->id ?: "" ?>">
              <input type="submit" name="update_company" value="Update Company" id="update_company" class="btn btn-lg btn-success">
            </div>
          </form>
        <?php endif;?>
        </div>
      </section><!--End Content-->
    </main>