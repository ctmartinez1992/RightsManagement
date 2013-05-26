<div id="main_content">
    <section id="main_area">
        <article>
            <?php
                if ($revogado != null) {
                    echo '<p class="alert">Este documento for revogado integralmente pelo documento com a data ' . str_replace("_", "-", $revogado[1]) . '</p>';
                } else {
                }
            ?>
            <div class="cf nestable-lists">
                <div class="dd" id="nestable">
                    <div class="dd-title">
                        <?php
                            echo $title . ' : ' . str_replace("_", "-", $current_doc);
                        ?>
                    </div>
                    <ol class="dd-list">
                        <?php
                            for ($i=0; $i<count($main); $i++) {
                                echo '<li class="dd-item" id="livro" data-id="' . ($i+1) . '">';
                                echo '<div class="dd-handle">';
                                echo '<ul id="item_menu">';
                                echo '<li><div class="circle"><a></a></div>';
                                echo '<ul class="sub_item_menu">';
                                echo '<li><button type="button" class="button_menu_item" onclick="" value>Criar LaTeX</button>';
                                echo '<button type="button" class="button_menu_item" onclick="" value>Partilhar</button></li>';
                                echo '</ul></li></ul>';
                                echo 'Livro:' . $main[$i][0] . ' - ' . $main[$i][1] . '</div>';
                                echo '<ol class="dd-list">';
                                echo '</ol>';
                                echo '</li>';
                            }
                        ?>
                    </ol>
                </div>
            </div>
            <table class="color_lable">
                <tr>
                    <th colspan="2" style="">Legenda</th>
                </tr>
                <tr>
                    <td>Alteração</td>
                    <td><div class="alter_square"></div></td>
                </tr>
                <tr>
                    <td>Aditamento</td>
                    <td><div class="add_square"></div></td>
                </tr>
                <tr>
                    <td>Revogação</td>
                    <td><div class="revoke_square"></div></td>
                </tr>
                <tr>
                    <td>Igual</td>
                    <td><div class="default_square"></div></td>
                </tr>
            </table>
        </article>
        <?php
//            $file = $this->model_codigo_civil->get_article("/1975_2_19/1975_2_19_1029.txt");
//            echo "<li><ul>".$file[0];
//            echo "</ul><ul>".$file[1];
//            echo "</ul><ul>".$file[2];
//            echo "</ul><ul>".$file[3];
//            echo "</ul><ul>".sizeof($file);
//            echo "</ul></li>";

//            echo $this->model_codigo_civil->get_article_title("1975_2_19/1975_2_19_1029.txt");

//            $file = $this->model_codigo_civil->get_article_text("/1975_2_19/1975_2_19_1029.txt");
//            echo "<li><ul>".$file[0];
//            echo "</ul><ul>".$file[1];
//            echo "</ul><ul>".$file[2];
//            echo "</ul><ul>".sizeof($file);
//            echo "</ul></li>";
        
//            $file = $this->model_codigo_civil->get_all_articles("1977_11_25");
//            echo $file['altera'][51][2];
//            echo "<br>";
//            echo $file['acrescenta'][10][3];
//            echo "<br>";
//            echo $file['revoga'][2];
        
//            $file = $this->model_codigo_civil->get_doc_content("/1975_2_19/1975_2_19.xml");
        
//            echo $this->model_codigo_civil->get_doc_name("/1975_2_19/1975_2_19.xml");
        
//            $file1 = $this->model_codigo_civil->get_doc_altera("/1977_11_25/1977_11_25.xml");
//            $file2 = $this->model_codigo_civil->get_doc_acrescenta("/1977_11_25/1977_11_25.xml");
//            $file3 = $this->model_codigo_civil->get_doc_revoga("/1977_11_25/1977_11_25.xml");
//            echo $file1;
//            echo $file2;
//            echo $file3;
        
//            $file = $this->model_codigo_civil->get_all_doc_names();
//            echo $file->doc[3];
        
//            $file = $this->model_codigo_civil->get_all_doc_count();
//            echo $file;
        
//            $file = $this->model_codigo_civil->get_all_doc_changed_hierarchy_names();
//            echo $file->doc[3];
//        
//            $file = $this->model_codigo_civil->get_all_doc_changed_hierarchy_count();
//            echo $file;
        
//            echo $this->model_codigo_civil->does_article_exist_in_given_doc("2021", "1977_11_25");
        
//            $array = $this->model_codigo_civil->get_article_evolution_names("1051");
//            for ($i=0;$i<sizeof($array);$i++) {
//                echo $array[$i];
//            }
            
//            $array = $this->model_codigo_civil->get_article_evolution_title("1051");
//            for ($i=0;$i<sizeof($array);$i++) {
//                echo $array[$i][0];
//                echo $array[$i][1];
//            }
            
//            $array = $this->model_codigo_civil->get_article_evolution_text("1051");
//            for ($i=0;$i<sizeof($array);$i++) {
//                for ($j=0;$j<sizeof($array[$i]);$j++) {
//                    echo $array[$i][$j];
//                    echo "<br>";
//                }
//                echo "<br>";
//            }
        
//            echo $this->model_codigo_civil->when_was_article_added("1978-A");
        
//            echo $this->model_codigo_civil->when_was_article_first_altered("56");
        
//            echo $this->model_codigo_civil->was_doc_revoked("1985_9_20");
            
//            echo $this->model_codigo_civil->does_doc_revoke("200_9_11");
            
//            echo $this->model_codigo_civil->how_many_does_doc_revoke("2009_9_11");
        ?>
    </section>