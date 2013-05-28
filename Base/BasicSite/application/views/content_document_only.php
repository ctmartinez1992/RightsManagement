<div id="main_content">
    <section id="main_area">
        <article>
            <div class="cf nestable-lists">
                <div class="dd" id="nestable">
                    <div class="dd-title">
                        <?php
                            echo 'Documento ' . $_GET['nome'];
                        ?>
                    </div>
                    <?php
                        if (!empty($main[0])) {
                    ?>
                    <div class="dd-subtitle">
                        <?php
                            echo 'Alterações';
                        ?>
                    </div>
                    <?php
                        }
                        for ($i=0; $i<count($main[0]); $i++) {
                    ?>
                        <ol class="dd-list">
                            <?php
                                echo '<li class="dd-item" id="artigo" data-id="' . $main[0][$i][0] . '">';
                                echo '<div class="dd-handle">';
                                echo '<ul id="item_menu">';
                                echo '<li><div class="circle"><a></a></div>';
                                echo '<ul class="sub_item_menu">';
                                echo '<li><button type="button" class="button_menu_item" onclick="" value>Criar LaTeX</button>';
                                echo '<button type="button" class="button_menu_item" onclick="" value>Partilhar</button></li>';
                                echo '</ul></li></ul>';
                                echo (string)$main[0][$i][0] . ' - ' . $main[0][$i][1][0] . '</div>';
                                echo '<ol class="dd-list">';
                                for ($j=1; $j<count($main[0][$i][1]); $j++) {
                                    echo $main[0][$i][1][$j] . "<br>";
                                }
                                echo '</ol>';
                                echo '</li>';
                            ?>
                        </ol>
                    <?php
                        }
                    ?>
                    <?php
                        if (!empty($main[1])) {
                    ?>
                    <div class="dd-subtitle">
                        <?php
                            echo 'Aditamentos';
                        ?>
                    </div>
                    <?php
                        }
                        for ($i=0; $i<count($main[1]); $i++) {
                    ?>
                        <ol class="dd-list">
                            <?php
                                echo '<li class="dd-item" id="artigo" data-id="' . $main[1][$i][0] . '_' . $main[1][$i][1][0] . '">';
                                echo '<div class="dd-handle">';
                                echo '<ul id="item_menu">';
                                echo '<li><div class="circle"><a></a></div>';
                                echo '<ul class="sub_item_menu">';
                                echo '<li><button type="button" class="button_menu_item" onclick="" value>Criar LaTeX</button>';
                                echo '<button type="button" class="button_menu_item" onclick="" value>Partilhar</button></li>';
                                echo '</ul></li></ul>';
                                echo str_replace("_", "-", (string)$main[1][$i][0]) . '</div>';
                                echo '<ol class="dd-list">';
                                for ($j=1; $j<count($main[1][$i][1]); $j++) {
                                    echo $main[1][$i][1][$j] . "<br>";
                                }
                                echo '</ol>';
                                echo '</li>';
                            ?>
                        </ol>
                    <?php
                        }
                    ?>
                    <?php
                        if (!empty($main[2])) {
                    ?>
                    <div class="dd-subtitle">
                        <?php
                            echo 'Revogações';
                        ?>
                    </div>
                    <?php
                        }
                        for ($i=0; $i<count($main[2]); $i++) {
                            echo $main[2][$i] . "<br>";
                        }
                    ?>
                </div>
            </div>
        </article>
    </section>
    