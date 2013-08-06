<div id="main_content">
    <section id="main_area">
        <article>
        <ul id="alteration_nav" class="alteration_nav">
            <li><a href="<?php echo base_url(); ?>backend/main_alteration">Novo/Editar Documento</a></li>
            <li><a href="<?php echo base_url(); ?>backend/hierarchy_alteration">Editar Hierarquia</a></li>
            <?php if($tipo->tipo == 2) { ?><li><a href="<?php echo base_url(); ?>backend/manage_docs">Gerir Documentos</a></li><?php } ?>
        </ul>
            
            <select id="dd_data_doc" style="visibility:hidden;">
                <?php
                    echo '<option value="' . $doc . '" selected>' . $doc . '</option>';
                ?>
            </select>
            
            <table class="search_form">
                <tr>
                    <td>Documento:</td>
                    <td>
                        <select id="dd_doc_alteration" onchange="change_doc_alteration();">
                            <?php
                                echo '<option selected></option>';
                                for ($i=0; $i<sizeof($docs); $i++) {
                                    echo '<option>' . $docs[$i]->nome . ' (' . $docs[$i]->data . ')' . '</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Livro:</td>
                    <td>
                        <?php
                            echo form_dropdown('dd_livro', array(), 0, 'id="dd_livro" onChange="fill_titulo()"'); 
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Título:</td>
                    <td>
                        <?php echo form_dropdown('dd_titulo', array(), 0, 'id="dd_titulo" onChange="fill_subtitulo()"'); ?>
                    </td>
                 </tr>
                <tr>
                    <td>Subtítulo:</td>
                    <td>
                        <?php echo form_dropdown('dd_subtitulo', array(), 0, 'id="dd_subtitulo" onChange="fill_capitulo()"'); ?>
                    </td>
                 </tr>
                <tr>
                    <td>Capítulo:</td>
                    <td>
                        <?php echo form_dropdown('dd_capitulo', array(), 0, 'id="dd_capitulo" onChange="fill_seccao()"'); ?>
                    </td>
                 </tr>
                <tr>
                    <td>Secção:</td>
                    <td>
                        <?php echo form_dropdown('dd_seccao', array(), 0, 'id="dd_seccao" onChange="fill_subseccao()"'); ?>
                    </td>
                 </tr>
                <tr>
                    <td>Subsecção:</td>
                    <td>
                        <?php echo form_dropdown('dd_subseccao', array(), 0, 'id="dd_subseccao" onChange="fill_divisao()"'); ?>
                    </td>
                 </tr>
                <tr>
                    <td>Divisão:</td>
                    <td>
                        <?php echo form_dropdown('dd_divisao', array(), 0, 'id="dd_divisao" onChange="fill_subdivisao()"'); ?>
                    </td>
                 </tr>
                <tr>
                    <td>Subdivisão:</td>
                    <td>
                        <?php echo form_dropdown('dd_subdivisao', array(), 0, 'id="dd_subdivisao" onChange="fill_artigo()"'); ?>
                    </td>
                 </tr>
                <tr>
                    <td>Artigo:</td>
                    <td>
                        <?php echo form_dropdown('dd_artigo', array(), 0, 'id="dd_artigo"'); ?>
                    </td>
                 </tr>
                 <tr>
                     <td colspan="2">
                        <div id="main_search_button">
                            <p>
                                <input type="submit" name="searchSubmit" value="Pesquisar" class="button_search" />
                            </p>
                        </div>
                    </td>
                 </tr>
                 <?php
                    echo form_close();
                 ?>
            </table>
            <a href="#" id="done_editing" class="button black" onclick="done_doc();">Gravar</a>
<!--            <a href="#" id="finish_editing" class="button black" onclick="finish_doc();">Gravar e Fechar</a>-->
            <a href="#" id="send_doc" class="button black" onclick="send_doc();">Gravar e Enviar</a>
        </article>
    </section>
    