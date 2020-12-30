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
      <?= $this->Html->link('Course Decision Support System', ['controller'=>'Home', 'action'=>'index'], ['class'=>'navbar-brand', 'target'=>'_blank']) ?>
    </div>
  </div><!-- /.container-fluid -->
</nav>
      <div class="content">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
      </div>
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
