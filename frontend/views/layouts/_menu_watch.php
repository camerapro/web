<link href="/css/watch.css" rel="stylesheet">
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <div class="table_view boder_1 pd5">
            <p>Bảng hiển thị</p>
            <input class="table_view_fs" value="Xem camera" type="button">
            <input class="table_view_sc" value="Xem lại" type="button">
        </div>
        <div class="cam_search mt5">
            <input type="text" placeholder="Tìm camera cần xem" />
            <i class="icon_search"></i>
        </div>
        <div class="cam_show boder_1 mbt5">
            <ul class="cam_show_select">
                <li class="mt2"><input type="checkbox"/></li>
                <li><span>Tên camera</span></li>
                <li><span>Chọn</span></li>
            </ul>
            <?php
            $cams = \frontend\models\Camera::getListCam();
            if($cams){
                foreach ($cams as $cam):
            ?>
            <ul class="cam_res">
                <li><input type="checkbox"/></li>
                <li class="pr2"><?= $cam->name?></li>
                <li><i class="icon icon_play"></i></li>
                <li><i class="icon icon_stop"></i></li>
                <li><i class="icon icon_capture"></i></li>
                <li><i class="icon icon_record"></i></li>
            </ul>
            <?php
                endforeach;
            }
            ?>
        </div>

        <div class="cam_setup boder_1 pd5">

            <ul class="cam_rec">
                <li><p>Cấu hình camera</p></li>
                <li><i class="icon_rec_1"></i></li>
                <li><i class="icon_rec_4"></i></li>
                <li><i class="icon_rec_9"></i></li>
                <li><i class="icon_rec_16"></i></li>
            </ul>
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
