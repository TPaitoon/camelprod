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
                    ['label' => 'นึ่งยางนอก', 'url' => '#', 'icon' => 'home', 'visible' => $bom,
                        'items' =>
                            [
                                ['label' => 'BOM', 'url' => '#', 'icon' => 'chevron-circle-right',
                                    'items' =>
                                        [
                                            //['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/dashboard']],
                                            ['label' => 'ค่ามาตรฐาน', 'icon' => 'cog', 'url' => ['/extrainfo'], 'visible' => $edi],
                                            ['label' => 'ค่าพิเศษ', 'icon' => 'btc', 'url' => ['/bominfo']],
                                        ],
                                ],
                                ['label' => 'จักรยาน', 'url' => '#', 'icon' => 'chevron-circle-right',
                                    'items' =>
                                        [
                                            //['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/dashboard']],
                                            ['label' => 'เงินประจำตำแหน่ง', 'icon' => 'cog', 'url' => ['/steambicycleworkinfo'], 'visible' => $edi],
                                            ['label' => 'ค่าเข้างาน', 'icon' => 'btc', 'url' => ['/bicyclesteamworkinfo']],
                                            ['label' => 'ค่ามาตรฐาน', 'icon' => 'cog', 'url' => ['/standardtirebicycleinfo'], 'visible' => $edi],
                                            ['label' => 'ค่าพิเศษ', 'icon' => 'btc', 'url' => ['/bicycletireinfo']],
                                        ],
                                ],
                            ],
                    ],
                    ['label' => 'ประกอบยางนอก', 'url' => '#', 'icon' => 'home', 'visible' => $bce,
                        'items' =>
                            [
                                ['label' => 'จักรยาน', 'url' => '#', 'icon' => 'chevron-circle-right',
                                    'items' =>
                                        [
                                            //['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/dashboard']],
                                            ['label' => 'เงินประจำตำแหน่ง', 'icon' => 'cog', 'url' => ['/standardbicycle'], 'visible' => $edi],
                                            ['label' => 'ค่าเข้างาน', 'icon' => 'btc', 'url' => ['/bicycleempinfo']],
                                            ['label' => 'รายละเอียดยาง', 'icon' => 'cog', 'url' => ['/standardbicycleex'], 'visible' => $edi],
                                            ['label' => 'ค่าพิเศษ', 'icon' => 'btc', 'url' => ['/bicycleinfo']],
                                        ],
                                ],
                            ],
                    ],
                    ['label' => 'ประกอบยางใน', 'url' => '#', 'icon' => 'home', 'visible' => $pibi,
                        'items' =>
                            [
                                ['label' => 'จักรยาน', 'url' => '#', 'icon' => 'chevron-circle-right',
                                    'items' =>
                                        [
                                            ['label' => 'ค่ามาตรฐาน', 'icon' => 'cog', 'url' => ['/pibistandard'], 'visible' => $edi],
                                            ['label' => 'ค่าพิเศษ', 'icon' => 'btc', 'url' => ['/pibicalculator']],
                                        ],
                                ],
                                ['label' => 'มอเตอร์ไซค์', 'url' => '#', 'icon' => 'chevron-circle-right',
                                    'items' =>
                                        [
                                            ['label' => 'ค่ามาตรฐาน', 'icon' => 'cog', 'url' => ['/pibimcstandard'], 'visible' => $edi],
                                            ['label' => 'ค่าพิเศษ', 'icon' => 'btc', 'url' => ['/pibimccalculator']],
                                        ],
                                ],
                            ],
                    ],
                    ['label' => 'ผู้ดูแลระบบ', 'url' => '#', 'icon' => 'lock', 'visible' => $it,
                        'items' =>
                            [
                                ['label' => 'User Info', 'icon' => 'cog', 'url' => ['/userinfo'], 'visible' => $it],
                                ['label' => 'Log History', 'icon' => 'cog', 'url' => ['/loginhistory'], 'visible' => $it],
                            ],
                    ],
                ],
            ]);
        ?>
    </section>

</aside>
