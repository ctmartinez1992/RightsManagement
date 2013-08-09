<div id="main_content">
    <section id="main_area">
        <article>
        <ul id="alteration_nav" class="alteration_nav">
            <li><a href="<?php echo base_url(); ?>backend/main_alteration">Novo/Editar Documento</a></li>
            <li><a href="<?php echo base_url(); ?>backend/hierarchy_alteration">Editar Hierarquia</a></li>
            <?php if($tipo->tipo == 2) { ?><li><a href="<?php echo base_url(); ?>backend/manage_docs">Gerir Documentos</a></li><?php } ?>
        </ul>
                        
            <table class="search_form">
                <tr colspan="2">
                    <td>Escolha a hierarquia:</td><td></td>
                    <td><p style="margin-left: 100px;">Visualização:</p></td></td><td></td>
                </tr>
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
                    <td><p style="margin-left: 100px;">Hierarquia:</p></td>
                    <td>
                         <input type="text" name="tb_hierarquia" id="tb_hierarquia" style="margin-bottom: 10px;" disabled></input>
                    </td>
                </tr>
                <tr>
                    <td>Livro:</td>
                    <td>
                        <?php
                            echo form_dropdown('dd_livro', array(), 0, 'id="dd_livro" onChange="fill_titulo()"'); 
                        ?>
                    </td>
                    <td><p style="margin-left: 100px;">Número:</p></td>
                    <td>
                         <input type="text" name="tb_numero" id="tb_numero" style="margin-bottom: 10px;"></input>
                    </td>
                </tr>
                <tr>
                    <td>Título:</td>
                    <td>
                        <?php echo form_dropdown('dd_titulo', array(), 0, 'id="dd_titulo" onChange="fill_subtitulo()"'); ?>
                    </td>
                    <td><p style="margin-left: 100px;">Nome:</p></td>
                    <td>
                         <input type="text" name="tb_nome" id="tb_nome" style="margin-bottom: 10px; width: 250px;"></input>
                    </td>
                 </tr>
                <tr>
                    <td>Subtítulo:</td>
                    <td>
                        <?php echo form_dropdown('dd_subtitulo', array(), 0, 'id="dd_subtitulo" onChange="fill_capitulo()"'); ?>
                    </td>
                    <td>
                        <a href="#" id="save_hierarchy_alteration" class="button black" onclick="save_hierarchy_alteration();" style="margin-top: 25px;">Gravar Alterações</a>
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
                     <td>
                        <select id="dd_data_doc" style="visibility:hidden;">
                            <?php
                                echo '<option value="' . $doc . '" selected>' . $doc . '</option>';
                            ?>
                        </select>
                    </td>
                     <td>
                        <select id="dd_data_hierarchy_doc" style="visibility:hidden;">
                            <?php
                                echo '<option value="' . $hdoc . '" selected>' . $hdoc . '</option>';
                            ?>
                        </select>
                    </td>
                 </tr>
                 <tr>
                     <td>
                        <a href="#" id="done_editing" class="button black" onclick="save_hierarchy();">Gravar</a>
                    </td>
                 </tr>
                 <?php
                    echo form_close();
                 ?>
            </table>
        </article>
        <select id="dd_artigo" style="visibility:hidden;"></select>
        <select id="is_backend" style="visibility:hidden;"><option value="true" selected>stupid way to know that i am in backend</option></select>
    </section>
    