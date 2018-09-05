






                            <!-- RD Navbar Nav -->
                            <ul class="rd-navbar-nav">




<?
$menuBD = read('menu', "WHERE menu_localizacao_id = 1 AND situacao = 'on' AND  precedencia = 0 ORDER BY ordem");
if ($menuBD) {
  foreach ($menuBD as $menu) {
    switch ($menu['menu_tipo_id']) {
          case '1': //linha
            $target = '_self';
            $linkMenuTopo = BASE."/ml/$menu[uri]";
            break;
          case '2': //coluna
            $target = '_self';
            $linkMenuTopo = BASE."/mc/$menu[uri]";
            break;
          case '3': //link externo
            $target = '_blank';
            $linkMenuTopo = $menu['uri'];
            break;
          case '4': //link interno
            $target = '_self';
            $linkMenuTopo = $menu['uri'];
            break;
          default:
            $target = '_self';
            $linkMenuTopo = 'index';
            break;
        }

?>
    <?$smenuBD = read('menu', "WHERE menu_localizacao_id = 1 AND situacao = 'on' AND precedencia = $menu[id] ORDER BY ordem"); ?>
    <? if ($smenuBD) { // terá submenu ?>
                                <li>
                                    <a href="#"><?=$menu['titulo']?></a>
                                    <!-- RD Navbar Dropdown -->
                                    <ul class="rd-navbar-dropdown">
                                          <? foreach ($smenuBD as $smenu) { ?>
                                            <?
                                                switch ($smenu['menu_tipo_id']) {
                                                  case '1': //linha
                                                    $target = '_self';
                                                    $linkMenuTopo = BASE."/ml/$smenu[uri]";
                                                    break;
                                                  case '2': //coluna
                                                    $target = '_self';
                                                    $linkMenuTopo = BASE."/mc/$smenu[uri]";
                                                    break;
                                                  case '3': //link externo
                                                    $target = '_blank';
                                                    $linkMenuTopo = $smenu['uri'];
                                                    break;
                                                  case '4': //link interno
                                                    $target = '_self';
                                                    $linkMenuTopo = $smenu['uri'];
                                                    break;
                                                  default:
                                                    $target = '_self';
                                                    $linkMenuTopo = 'index';
                                                    break;
                                                }
                                            ?>
                                              <li>
                                                  <a target="<?=$target?>" href="<?=$linkMenuTopo?>"><?=$smenu['titulo']?></a>
                                              </li>
                                          <? } ?>
                                    </ul>
                                    <!-- END RD Navbar Dropdown -->
                                </li>
    <? } else { // não terá submenu ?>
                                <li class="active">
                                    <a class="nav-link" target="<?=$target?>" href="<?=$linkMenuTopo?>"><?=$menu['titulo']?></a>
                                </li>
    <? } ?>
<? 
  }}//ende switch e foreach menu
?>





                            </ul>
                            <!-- END RD Navbar Nav -->


