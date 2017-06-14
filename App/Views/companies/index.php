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
                      <th>Company</th>           
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Website</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                <?php if(!empty($data->companies)):?>
                <?php foreach($data->companies as $company):?>
                <tr>
                    <td scope="row" class="invoice-title">
                        <div class="invoice-img"><img src="/assets/images/companies/<?= $company->company_image ? $company->company_image : "avator.png"?>" class="img-responsive"></div>
                        <div class="invoice-meta">
                            <h2 class="invoice-id">#<?=$company->id;?></h2>
                            <p class="invoice-brand"><?=$company->company_name;?></p>
                        </div>
                    </td>
                    <td><?=$company->email;?></td>
                    <td><?=$company->phone;?></td>
                    <td><?=$company->website;?></td>
                    <td class="action-fields">
                        <a class="edit" href="/companies/update/<?=$company->id?>"><i class="fa fa-pencil"></i></a>
                        <a class="delete" href="/companies/delete/<?=$company->id?>"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                <?php endforeach;?>
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
  </section><!--End Content-->
</main>