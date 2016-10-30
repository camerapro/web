<script src="/video.js"></script>
<script src="/js/videojs-contrib-hls.js"></script>
<link href="/css/watch.css" rel="stylesheet">
<script src="/js/watch.js"></script>

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <div class="cam_search mt5">
            <input type="text" placeholder="Tìm camera cần xem" />
            <i class="icon_search"></i>
        </div>
        <div class="cam_show boder_1 mbt5">
            <?php
            $cams = \frontend\models\Camera::getListCam(Yii::$app->user->identity->id);
            $i=0;
            if($cams){
                foreach ($cams as $cam):
            ?>
            <ul class="cam_res cam_number_<?= $cam->id?>">
                <li class="pr2"><a class="cam_name <?php  echo $i == 0 ? 'cam_select' : '' ?>" href="#" alt="test" value="<?= $cam->id?>"><?= $cam->name?></a></li>
            </ul>
            <?php
                $i++;
                endforeach;
            }
            ?>
        </div>

        <div class="cam_setup boder_1 pd5">
            <input id="fc_create" data-toggle="modal" data-target="#CalenderModalNew" value="Thêm mới" type="button" >
            <input data-toggle="modal" data-target="#grand_cam" value="Gán cam" type="button"  onclick="window.location='<?=\yii\helpers\Url::base()?>/user/grand';">
        </div>
        <hr>
        <ul class="nav side-menu">

        </ul>
    </div>
</div>
<!-- /sidebar menu -->
