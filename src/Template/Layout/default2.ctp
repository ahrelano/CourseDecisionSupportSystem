<!DOCTYPE html>
<html>
<head>
    <title>National Achievement Test</title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->script('jquery.js') ?>
    <?= $this->Html->css('../vendor/bootstrap/css/bootstrap.min.css') ?>
    <?= $this->Html->script('../vendor/jquery/jquery.min.js') ?>
    <?= $this->Html->script('../vendor/bootstrap/js/bootstrap.min.js') ?>
</head>
<body>
<style>
.natlogo {
    height: 70px; margin-left: 100px;
}

.nat_link{
    color: white;
}

.nat_link:hover{
    color: blue;
    text-decoration: none;
}
</style>
    <div id="header">
        <center> <span id="text"> ONLINE REVIEW EXAMINATION AND RECOMMENDATION OF COLLEGE COURSES FOR JUNIOR HIGH SCHOOL STUDENTS </span> </center>
    </div>

    <div>
        <?= $this->Html->link($this->Html->image('nat.png',['class'=>'natlogo']), ['controller'=>'Users', 'action'=>'index'], ['escape' => false, 'target'=>'_blank']); ?>
        <span><?= $this->Html->image('titlebar.png') ?></span>
    </div>

    <div id="gr"></div>
    <div id="gr2"></div>
    <div id="gr3">
        <div id="mid">
            <div id="parent">
                <div class="wrapper">
                <!-- <div class="box"> <center><?= $this->Html->link(__('INSTRUCTIONS'), ['controller'=>'Tests', 'action'=>'index'], ['class'=>'nat_link']) ?></center> </div>
                
                <div class="box"> <center>EXAMINATION</center> </div>
                
                <div class="box"> <center> INFORMATIONS</center> </div>
    
                <div class="box"> <center><?= $this->Html->link(__('EXAM RESULTS'), ['controller'=>'Userdetails', 'action'=>'index'], ['class'=>'nat_link']) ?> </center></div> -->
                 </div>
            </div>
        <?= $this->Flash->render() ?>
        <div id="instruction">
        <?= $this->fetch('content') ?>
        </div>
            <!-- <button id="se"> <span id="es"> Start Examination </span></button> -->
        </div>
    </div>

</body>
</html>