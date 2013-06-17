<div id="main_content">
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
                        <a href="#" id="edit_article_alteration" class="button black" onclick="blass();">Alterar</a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="#" id="delete_article_alteration" class="button black" onclick="blass();">Remover</a>
                    </td>
                </tr>
                <tr>
                    <td rowspan="5">
                        <h2>Área de Adições</h2>
                        <select id="mdd_article_addition" size="10" multiple>
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
                        <a href="#" id="add_article_addition" class="button black" onclick="blass();" style="margin-top: 25px;">Adicionar</a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="#" id="edit_article_addition" class="button black" onclick="blass();">Alterar</a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="#" id="delete_article_addition" class="button black" onclick="blass();">Remover</a>
                    </td>
                </tr>
                <tr>
                    <td rowspan="5">
                        <h2>Área de Revogações</h2>
                        <select id="mdd_article_revoke" size="10" multiple>
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
                        <a href="#" id="add_article_revoke" class="button black" onclick="blass();" style="margin-top: 25px;">Adicionar</a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="#" id="edit_article_revoke" class="button black" onclick="blass();">Alterar</a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="#" id="delete_article_revoke" class="button black" onclick="blass();">Remover</a>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                        <a href="#" id="done_editing" class="button black" onclick="blass();">Terminar</a>
                    </td>
                </tr>
            </table>
        </article>
    </section>
    