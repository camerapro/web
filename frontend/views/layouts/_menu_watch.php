<script src="/js/video.js"></script>
<script src="/js/videojs-contrib-hls.js"></script>
<link href="/css/watch.css" rel="stylesheet">


<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <div class="cam_search mt5">
            <input type="text" placeholder="Tìm camera cần xem"/>
            <i class="icon_search"></i>
        </div>
        <div class="cam_show boder_1 mbt5">
            <?php
            $recoders = \frontend\models\FrontendRecorder::getRecorder();
            $i = 0;
            if ($recoders) {
                foreach ($recoders as $recoder):?>
                    <ul class="cam_res">
                        <li class="pr2">
                            <a href="#" alt="<?= $recoder->name ?>" value="<?= $recoder->id ?>"><?= $recoder->name ?></a>
                        </li>
                    </ul>
                    <?php foreach ($recoder['channels'] as $cam): ?>
                        <ul class="pl15 cam_res cam_number_<?= $cam->id ?>">
                            <li class="pr2">
                                <a class="cam_name <?php echo $i == 0 ? 'cam_select' : '' ?>" href="#" alt="test" protocol="<?= $recoder->protocol;?>"
                                   value="<?= $cam->id ?>"><?= $cam->name ?></a>
                            </li>
                        </ul>
                        <?php
                        $i++;
                endforeach;
            endforeach;
            }
            ?>
        </div>

        <div class="cam_setup boder_1 pd5">
            <?php
            $checkMenuShow = \frontend\models\Permission::checkShowMenu($user_id = Yii::$app->user->identity->id, 'camera', 'create');
            if($checkMenuShow): ?>
                <input id="fc_create" data-toggle="modal" data-target="#CalenderModalNew" value="Thêm mới" type="button">
            <?php endif; ?>
            <input data-toggle="modal" data-target="#grand_cam" value="Gán cam" type="button"
                   onclick="window.location='<?= \yii\helpers\Url::base() ?>/user/grand';">
        </div>
        <hr>
        <ul class="nav side-menu">

        </ul>
    </div>
</div>
<!-- /sidebar menu -->
