<aside class="main-sidebar">

    <section class="sidebar">

        <?php

        use backend\models\UserDirect;

        $chk = new UserDirect();
        $usr = $chk->Chkusr();

        $pt = false;
        $pto = false;
        $pi = false;
        $it = false;
        $ps = false;

        if ($usr == 'IT') {
            $it = true && $pt = true && $pi = true && $ps = true;
        } elseif ($usr == 'PS') {
            $pt = true && $pi = true && $ps = true;
        } elseif ($usr == 'PT') {
            $pt = true && $pto = true;
        } elseif ($usr == 'PI') {
            $pi = true;
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
                    ['label' => 'นึ่งยางนอก', 'url' => '#', 'icon' => 'home', 'visible' => $pt,
                        'items' =>
                            [
                                ['label' => 'BOM', 'url' => '#', 'icon' => 'chevron-circle-right',
                                    'items' =>
                                        [
                                            //['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/dashboard']],
                                            ['label' => 'ค่ามาตรฐาน', 'icon' => 'cog', 'url' => ['/extrainfo'], 'visible' => $ps],
                                            ['label' => 'ค่าพิเศษ', 'icon' => 'btc', 'url' => ['/bominfo']],
                                        ],
                                ],
                                ['label' => 'จักรยาน', 'url' => '#', 'icon' => 'chevron-circle-right',
                                    'items' =>
                                        [
                                            //['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/dashboard']],
                                            ['label' => 'เงินประจำตำแหน่ง', 'icon' => 'cog', 'url' => ['/steambicycleworkinfo'], 'visible' => $ps],
                                            ['label' => 'ค่าเข้างาน', 'icon' => 'btc', 'url' => ['/bicyclesteamworkinfo']],
                                            ['label' => 'ค่ามาตรฐาน', 'icon' => 'cog', 'url' => ['/standardtirebicycleinfo'], 'visible' => $ps],
                                            ['label' => 'ค่าพิเศษ', 'icon' => 'btc', 'url' => ['/bicycletireinfo']],
                                        ],
                                ],
                            ],
                    ],
                    ['label' => 'ประกอบยางนอก', 'url' => '#', 'icon' => 'home', 'visible' => $pt,
                        'items' =>
                            [
                                ['label' => 'จักรยาน', 'url' => '#', 'icon' => 'chevron-circle-right',
                                    'items' =>
                                        [
                                            //['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/dashboard']],
                                            ['label' => 'เงินประจำตำแหน่ง', 'icon' => 'cog', 'url' => ['/standardbicycle'], 'visible' => $ps],
                                            ['label' => 'ค่าเข้างาน', 'icon' => 'btc', 'url' => ['/bicycleempinfo']],
                                            ['label' => 'รายละเอียดยาง', 'icon' => 'cog', 'url' => ['/standardbicycleex'], 'visible' => $ps],
                                            ['label' => 'ค่าพิเศษ', 'icon' => 'btc', 'url' => ['/bicycleinfo']],
                                        ],
                                ],
                                ['label' => 'มอเตอร์ไซต์', 'url' => '#', 'icon' => 'chevron-circle-right', 'visible' => $it,
                                    'items' =>
                                        [
                                            ['label' => 'ใบสั่งประกอบยาง', 'icon' => 'btc', 'url' => ['/ptbmplanning'], 'visible' => $pto]
                                        ]
                                ]
                            ],
                    ],
                    ['label' => 'ประกอบยางใน', 'url' => '#', 'icon' => 'home', 'visible' => $pi,
                        'items' =>
                            [
                                ['label' => 'ออกยางแทน', 'url' => '#', 'icon' => 'chevron-circle-right',
                                    'items' =>
                                        [
                                            ['label' => 'ค่าพิเศษ', 'icon' => 'btc', 'url' => ['/pibitireout']],
                                        ],
                                ],
                                ['label' => 'เตรียมจุ๊บ', 'url' => '#', 'icon' => 'chevron-circle-right',
                                    'items' =>
                                        [
                                            ['label' => 'จัดการพนักงาน', 'icon' => 'user', 'url' => ['/pibitubeemplist']],
                                            ['label' => 'ค่าพิเศษ', 'icon' => 'btc', 'url' => ['/pibitubecalculator']],
                                        ],
                                ],
                                ['label' => 'จักรยาน', 'url' => '#', 'icon' => 'chevron-circle-right',
                                    'items' =>
                                        [
                                            ['label' => 'ค่ามาตรฐาน', 'icon' => 'cog', 'url' => ['/pibistandard'], 'visible' => $ps],
                                            ['label' => 'จัดการพนักงาน', 'icon' => 'user', 'url' => ['/pibibcemplist']],
                                            ['label' => 'ค่าพิเศษ', 'icon' => 'btc', 'url' => ['/pibicalculator']],
                                        ],
                                ],
                                ['label' => 'มอเตอร์ไซค์', 'url' => '#', 'icon' => 'chevron-circle-right',
                                    'items' =>
                                        [
                                            ['label' => 'ค่ามาตรฐาน', 'icon' => 'cog', 'url' => ['/pibimcstandard'], 'visible' => $ps],
                                            ['label' => 'จัดการพนักงาน', 'icon' => 'user', 'url' => ['/pibimcemplist']],
                                            ['label' => 'ค่าพิเศษ', 'icon' => 'btc', 'url' => ['/pibimccalculator']],
                                        ],
                                ],
                                ['label' => 'ประกอบยางในดำ', 'url' => '#', 'icon' => 'chevron-circle-right',
                                    'items' =>
                                        [
                                            ['label' => 'ค่ามาตรฐาน', 'icon' => 'cog', 'url' => ['/pibitirecutstandard']],
                                            ['label' => 'ค่าพิเศษ', 'icon' => 'btc', 'url' => ['/pibitirecutdetail']],
                                        ],
                                ],
                            ],
                    ],
                    ['label' => 'ผู้ดูแลระบบ', 'url' => '#', 'icon' => 'lock', 'visible' => $it,
                        'items' =>
                            [
                                ['label' => 'ข้อมูลผู้ใช้งาน', 'icon' => 'cog', 'url' => ['/userinfo'], 'visible' => $it],
                                ['label' => 'ประวัติ', 'icon' => 'cog', 'url' => ['/loginhistory'], 'visible' => $it],
                                ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'], 'visible' => $it],
                                ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'], 'visible' => $it],
                            ],
                    ],
                ],
            ]);
        ?>
    </section>

</aside>
