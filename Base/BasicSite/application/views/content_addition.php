<div id="main_content">
    <section id="main_area">
        <article>
            <div id="doc_name">Documento: <?php echo $_GET['doc']; ?></div>
            <table id="addition_table">
                <tr>
                    <td>
                        Nº do Artigo:
                    </td>
                    <td>
                        <input type="text" name="choose_article_n" id="choose_article_n">
            
                        </input>
                    </td>
                </tr>
                <tr>
                    <td>Título do Artigo:</td>
                    <td>
                        <input type="text" name="choose_article_title" id="choose_article_title">

                        </input>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        Corpo do Artigo:
                    </td>
                    <td>
                        <textarea name="text_area" id="text_area" class="alteration_area" cols="30" rows="15" style="width: 400px; height: 200px;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td><p >Livro:</td>
                    <td>
                        <?php
                            echo form_dropdown('dd_livro', array(), 0, 'id="dd_livro" onChange="fill_titulo()"'); 
                        ?>
                    </td>
                    <td><p style="margin-left: -300px;">Título:</td>
                    <td>
                        <?php echo form_dropdown('dd_titulo', array(), 0, 'id="dd_titulo" onChange="fill_subtitulo()" style="margin-left: -220px;"'); ?>
                    </td>
                </tr>
                <tr>
                    <td><p >Subtítulo:</td>
                    <td>
                        <?php echo form_dropdown('dd_subtitulo', array(), 0, 'id="dd_subtitulo" onChange="fill_capitulo()"'); ?>
                    </td>
                    <td><p style="margin-left: -300px;">Capítulo:</td>
                    <td>
                        <?php echo form_dropdown('dd_capitulo', array(), 0, 'id="dd_capitulo" onChange="fill_seccao()" style="margin-left: -220px;"'); ?>
                    </td>
                </tr>
                <tr>
                    <td><p >Secção:</td>
                    <td>
                        <?php echo form_dropdown('dd_seccao', array(), 0, 'id="dd_seccao" onChange="fill_subseccao()"'); ?>
                    </td>
                    <td><p style="margin-left: -300px;">Subsecção:</td>
                    <td>
                        <?php echo form_dropdown('dd_subseccao', array(), 0, 'id="dd_subseccao" onChange="fill_divisao()" style="margin-left: -220px;"'); ?>
                    </td>
                 </tr>
                <tr>
                    <td><p >Divisão:</td>
                    <td>
                        <?php echo form_dropdown('dd_divisao', array(), 0, 'id="dd_divisao" onChange="fill_subdivisao()"'); ?>
                    </td>
                    <td><p style="margin-left: -300px;">Subdivisão:</p></td>
                    <td>
                        <?php echo form_dropdown('dd_subdivisao', array(), 0, 'id="dd_subdivisao" onChange="fill_artigo()" style="margin-left: -220px;"'); ?>
                    </td>
                 </tr>
                <tr>
                    <td>
                        <button id="addition_submit" type="button" class="button_login" style="margin: 10px 0px 0px 5px; float: left;" onclick="validate_addition();">
                            Submit
                        </button>
                    </td>
                </tr>
            </table>
        </article>
    </section>
    