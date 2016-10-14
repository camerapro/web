<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <?php include('_header.php');?>
<body class="nav-md">
<?php $this->beginBody() ?>
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.html" class="site_title"><i class="fa fa-camera"></i> <span>Camera An Ninh</span></a>
                </div>
                <div class="clearfix"></div>
            <?php
            $controller = Yii::$app->controller->id;
            $action = Yii::$app->controller->action->id;
            if($controller =='site' && $action=='index') include('_menu_watch.php');
            else include('_menu_left.php');
            ?>
            </div>
        </div>
            <?php include('_top_nav.php');?>
            <!-- page content -->
        <div class="right_col" role="main">
            <?= $content ?>
        </div>
            <!-- /page content -->
            <!-- footer content -->
            <?php include('_footer.php');?>
            <?php include('_script.php');?>
            <!-- /footer content -->
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
