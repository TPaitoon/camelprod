<aside class="main-sidebar">

    <section class="sidebar">

        <?php

        use backend\models\UserDirect;

        $chk = new UserDirect();
        $usr = $chk->Chkusr();

        $bom = false;
        $bce = false;
        $sbw = false;
        $edi = false;
        $pibi = false;
        $it = false;

        if (count($usr) > 0) {
            if ($usr === 'PSPS') {
                $bom = true;
                $bce = true;
                $sbw = true;
                $edi = true;
                $pibi = true;
            } elseif ($usr === 'PTBT') {
                $bce = true;
            } elseif ($usr === 'PTVT') {
                $bom = true;
                $sbw = true;
            } elseif ($usr === 'ITIT') {
                $it = true;
                $bom = true;
                $bce = true;
                $sbw = true;
                $edi = true;
                $pibi = true;
            } elseif ($usr === 'PIBI') {
                $pibi = true;
            }
        }
        ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
//                    ['label' => 'Menu Yii2', 'visible' => $edi == 'ITIT', 'url' => '#', 'items' =>
//                        [
//                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
//                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
//                        ],
//                    ],
                    ['label' => 'นึ่งยางเตา BOM', 'url' => '#', 'visible' => $bom,
                        'items' =>
                            [
                                //['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/dashboard']],
                                ['label' => 'ค่ามาตรฐาน', 'icon' => 'fa fa-address-card-o', 'url' => ['/extrainfo'], 'visible' => $edi],
                                ['label' => 'ค่าพิเศษ', 'icon' => 'fa fa-address-card-o', 'url' => ['/bominfo']],
                            ],
                    ],
                    ['label' => 'ประกอบยางนอกจกย', 'url' => '#', 'visible' => $bce,
                        'items' =>
                            [
                                //['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/dashboard']],
                                ['label' => 'เงินประจำตำแหน่ง', 'icon' => 'fa fa-address-card-o', 'url' => ['/standardbicycle'], 'visible' => $edi],
                                ['label' => 'ค่าเข้างาน', 'icon' => 'fa fa-address-card-o', 'url' => ['/bicycleempinfo']],
                                ['label' => 'รายละเอียดยาง', 'icon' => 'fa fa-address-card-o', 'url' => ['/standardbicycleex'], 'visible' => $edi],
                                ['label' => 'ค่าพิเศษ', 'icon' => 'fa fa-address-card-o', 'url' => ['/bicycleinfo']],
                            ],
                    ],
                    ['label' => 'นึ่งยางนอกจกย', 'url' => '#', 'visible' => $sbw,
                        'items' =>
                            [
                                //['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/dashboard']],
                                ['label' => 'เงินประจำตำแหน่ง', 'icon' => 'fa fa-address-card-o', 'url' => ['/steambicycleworkinfo'], 'visible' => $edi],
                                ['label' => 'ค่าเข้างาน', 'icon' => 'fa fa-address-card-o', 'url' => ['/bicyclesteamworkinfo']],
                                ['label' => 'ค่ามาตรฐาน', 'icon' => 'fa fa-address-card-o', 'url' => ['/standardtirebicycleinfo'], 'visible' => $edi],
                                ['label' => 'ค่าพิเศษ', 'icon' => 'fa fa-address-card-o', 'url' => ['/bicycletireinfo']],
                            ],
                    ],
                    ['label' => 'ประกอบยางในจกย', 'url' => '#', 'visible' => $pibi,
                        'items' =>
                            [
                                ['label' => 'ค่ามาตรฐาน', 'icon' => 'fa fa-address-card-o', 'url' => ['/pibistandard'], 'visible' => $edi],
                                ['label' => 'ค่าพิเศษ', 'icon' => 'fa fa-address-card-o', 'url' => ['/pibicalculator']],
                            ],
                    ],
                    ['label' => 'ประกอบยางในมตซ', 'url' => '#', 'visible' => $pibi,
                        'items' =>
                            [
                                ['label' => 'ค่ามาตรฐาน', 'icon' => 'fa fa-address-card-o', 'url' => ['/pibimcstandard'],'visible' => $edi],
                                ['label' => 'ค่าพิเศษ', 'icon' => 'fa fa-address-card-o', 'url' => ['/pibimccalculator']],
                            ],
                    ],
                    ['label' => 'User Info', 'icon' => 'fa fa-user-o', 'url' => ['/userinfo'], 'visible' => $it],
                    ['label' => 'Log History', 'icon' => 'fa fa-user-o', 'url' => ['/loginhistory'], 'visible' => $it],
                ],
            ]);
        ?>
    </section>

</aside>
