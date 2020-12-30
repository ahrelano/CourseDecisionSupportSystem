<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
        Course Decision Support System
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->script('jquery.js') ?>
    <?= $this->Html->css('../vendor/bootstrap/css/bootstrap.min.css') ?>
    <?= $this->Html->script('../vendor/jquery/jquery.min.js') ?>
    <?= $this->Html->script('../vendor/bootstrap/js/bootstrap.min.js') ?>
    <?= $this->Html->css('scrolling-nav.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bgd fixed-top" role="navigation">
  <div >
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?= $this->Html->link('Course Decision Support System', ['controller'=>'Home', 'action'=>'index'], ['class'=>'navbar-brand']) ?>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <?php if($this->request->session()->read('Auth.User.type') == 'client'){ ?>
            <li><?= $this->Html->link(__('Home'), ['controller'=>'Home', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Test'), ['controller'=>'Tests', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Results'), ['controller'=>'Userdetails', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Profile'), ['controller'=>'Users', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Logout'), ['controller'=>'Users', 'action'=>'logout']) ?></li>
        <?php }else if ($this->request->session()->read('Auth.User.type') == 'superadmin') { ?>
            <li><?= $this->Html->link(__('Home'), ['controller'=>'Home', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Admins'), ['controller'=>'Admins', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Results'), ['controller'=>'Userdetails', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Subjects'), ['controller'=>'Subjects', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Questions'), ['controller'=>'Questions', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Schools'), ['controller'=>'Schools', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Courses'), ['controller'=>'Courses', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Locations'), ['controller'=>'Locations', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Profile'), ['controller'=>'Users', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Logout'), ['controller'=>'Users', 'action'=>'logout']) ?></li>
        <?php }else if ($this->request->session()->read('Auth.User.type') == 'admin') { ?>
            <li><?= $this->Html->link(__('Home'), ['controller'=>'Home', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Results'), ['controller'=>'Userdetails', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Subjects'), ['controller'=>'Subjects', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Questions'), ['controller'=>'Questions', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Schools'), ['controller'=>'Schools', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Courses'), ['controller'=>'Courses', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Locations'), ['controller'=>'Locations', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Profile'), ['controller'=>'Users', 'action'=>'index']) ?></li>
            <li><?= $this->Html->link(__('Logout'), ['controller'=>'Users', 'action'=>'logout']) ?></li>
        <?php } ?>
      </ul>
    </div>
  </div><!-- /.container-fluid -->
</nav>
    <header class="custom text-black">
    <?= $this->Html->Image('logotitle.jpg', ['width'=>'150px', 'height'=>'150px', 'style'=>'padding-top: 10px;','class'=>'text-left img-responsive']) ?>
      <div class="container" style="margin-left: 23%;">
        <div id="cds">
        <!-- <?= $this->Html->Image('title.jpg', ['class'=>'img-responsive']) ?> -->
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        </div>
      </div>
    </header>
    
    <!-- Footer -->
    <footer class="py-5 bgd">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Course Decision Support System</p>
      </div>
      <!-- /.container -->
    </footer>
    <!-- Bootstrap core JavaScript -->
    <?= $this->Html->script('../vendor/popper/popper.min.js') ?>
    <?= $this->Html->script('../vendor/jquery-easing/jquery.easing.min.js') ?>
    <?= $this->Html->script('scrolling-nav.js') ?>
</body>
</html>
