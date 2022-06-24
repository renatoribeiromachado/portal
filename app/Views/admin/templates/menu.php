<aside class="main-sidebar">
    <section class="sidebar">
       
        <ul class="sidebar-menu mt-5">
            <?php
            foreach ($menus AS $menu)
            {
                extract($menu);

                switch ($id)
                {
                    case 1:
                        $icon = "fa fa-user";
                        break;
                    case 2:
                        $icon = "fa fa-users";
                        break;
                    case 3:
                        $icon = "fa fa-book";
                        break;
                    case 4:
                        $icon = "fa fa-tags";
                        break;
                    case 5:
                        $icon = "fa fa-wrench";
                        break;
                    case 6:
                        $icon = "fa fa-print";
                        break;
                    case 7:
                        $icon = "fa fa-check";
                        break;
                    case 8:
                        $icon = "fa fa-archive";
                        break;
                    case 9:
                        $icon = "fa fa-archive";
                        break;
                    case 10:
                        $icon = "fa fa-suitcase";
                        break;
                }
                ?>
                <li>
                    <a href="">
                        <i class="<?= $icon; ?>"></i> <span><?= $page; ?></span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="<?= base_url(); ?>/pt-BR/boards/<?= $url; ?>"><i class="fa fa-circle-o"></i> <?= $sub_page; ?></a></li>
                    </ul>
                </li>
            <?php } ?>
        </ul>

    </section>
</aside>