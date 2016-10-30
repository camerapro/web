<link href="/css/watch.css" rel="stylesheet">
<script src="/js/watch.js"></script>

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <div class="table_view boder_1 pd5">
            <p>Bảng hiển thị</p>
            <input class="col-xs-4 table_view_fs" value="Xem camera" type="button">
            <input class="col-xs-4 table_view_sc" value="Xem lại" type="button">
        </div>
        <div class="cam_search mt5">
            <input type="text" placeholder="Tìm camera cần xem" />
            <i class="icon_search"></i>
        </div>
        <div class="cam_show boder_1 mbt5">
            <!--<ul class="cam_show_select">
                <li class="mt2 col-xs-1"><input type="checkbox"/></li>
                <li  class="col-xs-4"><span>Tên camera</span></li>
                <li  class="col-xs-4"><span>Chọn</span></li>
            </ul>-->
            <?php
            $cams = \frontend\models\Camera::getListCam();
            $i=0;
            if($cams){
                foreach ($cams as $cam):
            ?>
            <ul class="cam_res cam_number_<?= $cam->id?>">
<!--                <li class="col-xs-1"><input type="checkbox"/></li>-->
                <li class="col-xs-3 pr2 cam_name <?php  echo $i == 0 ? 'cam_select' : 'cam_visible' ?>"><a href="#" alt="test"><?= $cam->name?></a></li>
<!--                <li class="col-xs-2"><i title="<?php /* echo $cam->status == 1 ? 'Tắt' : 'Bật'*/?>" class="icon icon_play_shut <?php /* echo $cam->status == 1 ? 'icon_shutdown' : 'icon_play'*/?>" value="<?/*= $cam->id*/?>"></i></li>
                <li class="col-xs-2"><i title="dừng lại" class="icon icon_stop" value="<?/*= $cam->id*/?>"></i></li>
                <li class="col-xs-2"><i title="chụp ảnh" class="icon icon_capture" value="<?/*= $cam->id*/?>"></i></li>
                <li class="col-xs-2"><i title="ghi" class="icon icon_record" value="<?/*= $cam->id*/?>"></i></li>-->
            </ul>
            <?php
                $i++;
                endforeach;
            }
            ?>
        </div>

        <div class="cam_setup boder_1 pd5">

            <!--<ul class="cam_rec">
                <li><p>Cấu hình camera</p></li>
                <li><i title="1 màn hình" class="icon_rec_1"></i></li>
                <li><i title="4 màn hình" class="icon_rec_4"></i></li>
                <li><i title="9 màn hình" class="icon_rec_9"></i></li>
                <li><i title="16 màn hình" class="icon_rec_16"></i></li>
            </ul>-->
            <input id="fc_create" data-toggle="modal" data-target="#CalenderModalNew" value="Thêm mới" type="button" >
            <input value="Gán cam" type="button">
            <input value="Xóa" type="button">
        </div>
        <hr>
        <ul class="nav side-menu">

        </ul>
    </div>
</div>
<!-- /sidebar menu -->
