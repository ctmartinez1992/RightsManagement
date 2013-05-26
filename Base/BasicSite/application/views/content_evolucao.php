<div id="main_content">
    <section id="main_area">
        <article>
            <div class="cf nestable-lists">
                <div class="dd" id="nestable">
                    <div class="dd-title">
                        <?php
                            echo 'Evolução do Artigo ' . $_GET['artigo'];
                        ?>
                    </div>
                    <?php
                        for ($i=0; $i<count($main); $i++) {
                    ?>
                        <ol class="dd-list">
                            <?php
                                echo '<li class="dd-item" id="artigo" data-id="' . $main[$i][0] . '_' . $_GET['artigo'] . '">';
                                echo '<div class="dd-handle">';
                                echo '<ul id="item_menu">';
                                echo '<li><div class="circle"><a></a></div>';
                                echo '<ul class="sub_item_menu">';
                                echo '<li><button type="button" class="button_menu_item" onclick="" value>Criar LaTeX</button>';
                                echo '<button type="button" class="button_menu_item" onclick="" value>Partilhar</button></li>';
                                echo '</ul></li></ul>';
                                echo str_replace("_", "-", (string)$main[$i][0]) . '</div>';
                                echo '<ol class="dd-list">';
                                for ($j=0; $j<count($main[$i][1]); $j++) {
                                    echo $main[$i][1][$j] . "<br>";
                                }
                                echo '</ol>';
                                echo '</li>';
                            ?>
                        </ol>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </article>
    </section>
    