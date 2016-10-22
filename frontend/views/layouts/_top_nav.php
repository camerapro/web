<?php
use yii\helpers\Url;

?>
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">

                <li class="nav_li">
                    <a href="#"><i class="fa fa-phone mr5" aria-hidden="true"></i>
                        Liên hệ</a>
                </li>
                <li class="nav_li">
                    <a href="#"><i class="fa fa-skype mr5" aria-hidden="true"></i>
                        Hỗ trợ</a>
                </li>
                <li class="nav_li">
                    <a href="#"><i class="fa fa-user mr5" aria-hidden="true"></i>
                        <?= Yii::$app->user->identity->username;?></a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="<?= $url = Url::to(['/site/logout']);?>" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >
                        <i class="fa fa-sign-out pull-right"></i>Thoát
                    </a>
                </li>
                <li class="">
                    <a href="javascript:;#" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-table mr5"></i>Hướng dẫn
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:;">Lưu dữ liệu trên máy tính</a></li>
                        <li><a href="javascript:;">Cài teamview</a></li>
                        <li><a href="javascript:;">Cấu hình camera</a></li>
                        <li><a href="javascript:;">Cấu hình máy chấm công</a></li>
                        <li><a href="javascript:;">Mở port Wifi</a></li>
                    </ul>
                </li>


                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-desktop mr5"></i>Quản trị
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:;">Cấu hình máy châm công</a></li>
                        <li><a href="<?=\yii\helpers\Url::base()?>/camera/index">Cấu hình Camera</a></li>
                        <li><a href="javascript:;">Cấu hình trên máy tính</a></li>
                        <li><a href="javascript:;">Nhân viên</a></li>
                        <li><a href="<?=\yii\helpers\Url::base()?>/user/index">Tài khoản</a></li>
                        <li><a href="javascript:;">Đổi mật khẩu</a></li>
                        <li><a href="javascript:;">Phân quyền</a></li>
                        <li><a href="javascript:;">Công ty</a></li>
                    </ul>
                </li>


                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-edit mr5"></i>Báo cáo
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:;">Báo cáo chấm công</a></li>
                        <li><a href="javascript:;">Dữ liệu gốc</a></li>
                        <li><a href="javascript:;">Báo cáo video</a></li>
                        <li><a href="javascript:;">Báo cáo ảnh</a></li>
                    </ul>
                </li>
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-home mr5"></i>Giám sát
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="<?=\yii\helpers\Url::base()?>/site/index">Xem cam</a></li>
                        <li><a href="javascript:;">Xem lại</a></li>
                        <li><a href="javascript:;">Kiểm soát</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>