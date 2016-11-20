<!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <ul class="nav side-menu">
                <?php $menu = \frontend\models\FrontendMenu::getMenu();?>
                <?php foreach ($menu as $item):?>
                <li><a><i class="<?= $item['icon']?>"></i><?= $item['name']?><span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <?php foreach ($item['child'] as $child):
                        $link = '#';
                        $class = 'hidden';
                        if(isset($child['controller']) && isset($child['action'])){
                            $link = \yii\helpers\Url::base() . '/'. $child['controller'] . '/'. $child['action'];
                            $checkMenuShow = \frontend\models\Permission::checkShowMenu($user_id = Yii::$app->user->identity->id, $child['controller'], $child['action']);
                            if($checkMenuShow){
                                $class = '';
                            }
                            if(isset($child['params'])) $link .=   '?' .  $child['params'];

                        }
                        if(Yii::$app->user->identity->level == 4){
                            $class = '';
                        }
                        ?>
                        <li class="<?= $class?>"><a href="<?= $link ?>"><?= $child['name']?></a></li>
                    <?php endforeach;?>
                    </ul>
                </li>

                <?php endforeach;?>
            </ul>
        </div>

    </div>
    <!-- /sidebar menu -->
