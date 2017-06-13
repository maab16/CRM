<aside class="sidebar-menu">
  <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#dashboard">Dashboard</a>
        </h4>
      </div>
      <div id="dashboard" class="panel-collapse collapse">
        <ul class="sub-menu">
          <li><a class="child_panel" href="/">All</a></li>
          <?php 
            if((new \Blab\Libs\Blab_User())->isLoggedIn()):
              if((new \Blab\Libs\Permission())->hasPermission('admin')):
          ?>
            <li><a class="child_panel" href="/dashboard/carts/">All Carts</a></li>
            <?php endif;?>
          <?php endif;?>
        </ul>
      </div>
    </div>
    <?php 
      if((new \Blab\Libs\Blab_User())->isLoggedIn()):
        if((new \Blab\Libs\Permission())->hasPermission('admin')):
    ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Users</a>
          </h4>
        </div>
        <div id="collapse2" class="panel-collapse collapse">
          <ul class="sub-menu">
            <li><a class="child_panel" href="/users/">All users</a></li>
            <li><a class="child_panel" href="/users/create/">Create user</a></li>
          </ul>
        </div>
      </div>
      <?php endif;?>
    <?php endif;?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Products</a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <ul class="sub-menu">
          <?php 
            if((new \Blab\Libs\Blab_User())->isLoggedIn()):
              if((new \Blab\Libs\Permission())->hasPermission('admin')):
          ?>
            <li><a class="child_panel" href="/products/create/">Create Products</a></li>
            <li><a class="child_panel" href="/products/all/">All Products</a></li>
          <?php else:?>
            <li><a class="child_panel" href="/products/">All Products</a></li>
          <?php endif;?>
        <?php endif;?>
        </ul>
      </div>
    </div>
     <?php 
        if((new \Blab\Libs\Blab_User())->isLoggedIn()):
          if((new \Blab\Libs\Permission())->hasPermission('admin')):
      ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#Companies">Companies</a>
          </h4>
        </div>
        <div id="Companies" class="panel-collapse collapse">
          <ul class="sub-menu">
            <li><a class="child_panel" href="/companies/">All Company</a></li>
            <li><a class="child_panel" href="/companies/create/">Create Company</a></li>
          </ul>
        </div>
      </div>
      <?php endif;?>
    <?php endif;?>
  </div>
</aside>