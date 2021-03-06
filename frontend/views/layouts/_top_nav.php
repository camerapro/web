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
                <li class="">
                    <a href="<?= \yii\helpers\Url::base()?>/site/logout">
                        <i class="fa fa-sign-out pull-right"></i>Thoát
                    </a>
                <li class="nav_li">
                    <a href="#"><i class="fa fa-phone mr5" aria-hidden="true"></i>
                        Liên hệ
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li class=""><a>CÔNG TY TNHH CÔNG NGHỆ THÔNG MINH Á CHÂU VIỆT NAM</a></li>
                        <li class=""><a>Địa chỉ : Số 28, ngõ 36, Đào Tấn, Ba Đình, Hà Nội</a></li>
                        <li class=""><a>web : thietbianninh.com - astech.com.vn</a></li>
                    </ul>
                </li>

                <li class="nav_li">
                    <a href="#"><i class="fa fa-skype mr5" aria-hidden="true"></i>
                        Hỗ trợ
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li class=""><a>Skype : viet_hung902</a></li>
                        <li class=""><a>Zalo : 0969 617 388</a></li>
                        <li class=""><a>Hotline : 0969 617 388</a></li>
                    </ul>
                </li>
                <li class="nav_li">
                    <a href="#"><i class="fa fa-user mr5" aria-hidden="true"></i>
                        <?= Yii::$app->user->identity->username;?></a>
                </li>


            </ul>
            <ul class="nav navbar-nav navbar-right">

                <?php $menu = \frontend\models\FrontendMenu::getMenu(0);?>
                <?php foreach ($menu as $item):?>
                <li>
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="<?= $item['icon']?> mr5"></i><?= $item['name']?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <?php foreach ($item['child'] as $child):
                        $link = '#';
                        $class = 'hidden';
                        if(isset($child['controller']) && isset($child['action'])){
                            $link = \yii\helpers\Url::base() . '/'. $child['controller'] . '/'. $child['action'];
                            $checkMenuShow = \frontend\models\Permission::checkShowMenu($user_id = Yii::$app->user->identity->id, $child['controller'], $child['action'], $child['params']);
                            if($checkMenuShow){
                                $class = '';
                            }
                            if(!empty($child['params'])) $link .=   '?' .  $child['params'];
                        }
                        if(Yii::$app->user->identity->level == 4){
                            $class = '';
                        }
                        ?>
                        <li class="<?= $class?>"><a href="<?= $link?>"><?= $child['name']?></a></li>
                    <?php endforeach;?>
                    </ul>
                </li>
                <?php endforeach;?>
            </ul>
        </nav>
    </div>
</div>