<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    
    <?= $this->Html->css('../vendor/bootstrap/css/bootstrap.min.css') ?>
    <?= $this->Html->script('../vendor/jquery/jquery.min.js') ?>
    <?= $this->Html->script('../vendor/bootstrap/js/bootstrap.min.js') ?>
    <!-- DatePicker -->
    <?= $this->Html->css('../vendor/datepicker/css/jquery-ui.css') ?>
    <?= $this->Html->script('../vendor/datepicker/js/jquery-ui.js') ?>
    <?= $this->Html->css('base.css') ?> 
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <?php if($this->request->session()->read('Auth.User.type') == 'client'){ ?>
                    <li><?= $this->Html->link(__('Test'), ['controller'=>'Tests', 'action'=>'index']) ?></li>
                    <li><?= $this->Html->link(__('Results'), ['controller'=>'Userdetails', 'action'=>'index']) ?></li>
                    <li><?= $this->Html->link(__('Profile'), ['controller'=>'Users', 'action'=>'index']) ?></li>
                    <li><?= $this->Html->link(__('Logout'), ['controller'=>'Users', 'action'=>'logout']) ?></li>
                <?php }else if ($this->request->session()->read('Auth.User.type') == 'superadmin') { ?>
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
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
