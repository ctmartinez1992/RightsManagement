<div id="main_content">
    <div id="alteration_nav">
        <ul>
            <li><a href="<?php echo base_url(); ?>site/home">Home</a></li>
            <li><a href="<?php echo base_url(); ?>site/codigo_civil">Código Civil</a></li>
            <?php if($tipo->tipo == 2) { ?><li><a href="<?php echo base_url(); ?>backend/main_alteration">Alterações</a></li><?php } ?>
            <li><a href="<?php echo base_url(); ?>site/about">About</a></li>
            <li><a href="<?php echo base_url(); ?>site/contact_no">Contact</a></li>
        </ul>
    </div>
    <section id="main_area">
        <article>
            <table id="id_table_options_alteration" class="table_options_alteration">
                <tr>
                    <td>Selecionar um documento já criado</td>
                    <td>
                        <select id="dd_doc_alteration" onchange="display_table_alteration();">
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
                    <td rowspan="2">Criar um novo documento</td>
                    <td><input type="text" id="new_doc_name" placeholder="Nome..."></input></td>
                    <td rowspan="2"><a href="#" id="create_document" class="button black" onclick="create_table_alteration();">Criar</a></td>
                </tr>
                <tr>
                    <td><input type="text" id="new_doc_data" placeholder="Data..."></input></td>
                </tr>
            </table>
            
            <table id="id_table_alteration" class="table_alteration">
                <tr>
                    <td rowspan="5">
                        <h2>Área de Alterações</h2>
                        <select id="mdd_article_alteration" size="10" multiple>
                            <option selected>Apples</option>
                            <option>Bananas</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="#" id="add_article_alteration" class="button black" onclick="add_article_alt();" style="margin-top: 25px;">Adicionar</a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="#" id="edit_article_alteration" class="button black" onclick="alt_article_alt();">Alterar</a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="#" id="delete_article_alteration" class="button black" onclick="rem_article_alt();">Remover</a>
                    </td>
                </tr>
                <tr>
                    <td rowspan="5">
                        <h2>Área de Adições</h2>
                        <select id="mdd_article_addition" size="10" multiple>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="center"></td>
                </tr>
                <tr>                    
                    <td align="center">
                        <a href="#" id="add_article_addition" class="button black" onclick="add_article_add();" style="margin-top: 25px;">Adicionar</a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="#" id="edit_article_addition" class="button black" onclick="alt_article_add();">Alterar</a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="#" id="delete_article_addition" class="button black" onclick="rem_article_add();">Remover</a>
                    </td>
                </tr>
                <tr>
                    <td rowspan="5">
                        <h2>Área de Revogações</h2>
                        <select id="mdd_article_revoke" size="10" multiple>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="center"></td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="#" id="add_article_revoke" class="button black" onclick="add_article_rem();" style="margin-top: 25px;">Adicionar</a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="#" id="delete_article_revoke" class="button black" onclick="rem_article_rem();">Remover</a>
                    </td>
                </tr>
            </table>
            <a href="#" id="done_editing" class="button black" onclick="done_doc();">Gravar</a>
            <a href="#" id="finish_editing" class="button black" onclick="finish_doc();">Gravar e Fechar</a>
            <a href="#" id="send_doc" class="button black" onclick="send_doc();">Gravar e Enviar</a>
        </article>
    </section>
    