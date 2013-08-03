<div id="main_content">
    <section id="main_area">
        <article>
            <div id="doc_name">Documento: <?php echo $_GET['doc'] ?></div>
            <div id="art_name">Artigo: <?php echo $_GET['artigo'] ?></div>
            
            <?php if ($main[0][0] == "revogado") { echo "O documento <b>" . $main[0][2] . "</b> da data <b>" . $main[0][1] . "</b> foi revogado integralmente.";} ?>
            <div id="compare_area">
                <table id="alteration_table">
                    <tr>
                        <td style="padding-left: 10px">Artigo <?php echo $_GET['artigo'] ?></td>
                        <td style="padding-left: 20px">Faça as alterações aqui</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="same_scroll_area">
                                <?php if ($main[0][0] == "revogado") { ?>
                                <textarea name="right_area" id="right_area" class="alteration_area" cols="30" rows="15" disabled><?php echo $main[0][0]; ?></textarea><?php } else { ?>
                                <textarea name="left_area" id="left_area" class="alteration_area" cols="30" rows="15" disabled><?php
                                    for ($i=0; $i<sizeof($main); $i++) {
                                        if (is_array($main[$i])) {
                                            for ($j=0; $j<sizeof($main[$i]); $j++) {
                                                echo trim($main[$i][$j], " ");
                                            }
                                        } else {
                                            echo trim($main[$i], " ");
                                        }
                                    }
                                ?></textarea><?php } ?>
                            </div>
                        </td>
                        <td>
                            <div class="same_scroll_area">
                                <?php if ($main[0][0] == "revogado") { ?>
                                <textarea name="right_area" id="right_area" class="alteration_area" cols="30" rows="15" disabled><?php echo $main[0][0]; ?></textarea><?php } else { ?>
                                <textarea name="right_area" id="right_area" class="alteration_area" cols="30" rows="15"><?php
                                    for ($i=0; $i<sizeof($main); $i++) {
                                        if (is_array($main[$i])) {
                                            for ($j=0; $j<sizeof($main[$i]); $j++) {
                                                echo trim($main[$i][$j], " ");
                                            }
                                        } else {
                                            echo trim($main[$i], " ");
                                        }
                                    }
                                ?></textarea><?php } ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button id="alt_alteration_submit" type="button" class="button_login" style="margin: 10px 0px 0px 5px; float: left;" onclick="validate_alt_addition();">Submit</button>
                        </td>
                    </tr>
                </table>
            </div>
            <script>
            $(function(){
                $('.same_scroll_area').scroll(function(){
                    $('.same_scroll_area').scrollTop($(this).scrollTop());    
                });
            });
            </script>
        </article>
    </section>
    