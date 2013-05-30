<div id="main_content">
    <section id="main_area">
        <article>
            <div id="compare_area">
                <table id="alteration_table">
                    <tr>
                        <td style="padding-left: 10px">Artigo <?php echo $_GET['artigo'] ?></td>
                        <td style="padding-left: 20px">Faça as alterações aqui</td>
                    </tr>
                    <tr>
                        <td>
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
                                ?></textarea>
                        </td>
                        <td>
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
                                ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="button" class="button_login" style="margin: 10px 0px 0px 5px; float: left;" onclick="validate_alteration();">Submit</button>
                        </td>
                    </tr>
                </table>
            </div>
        </article>
    </section>
    