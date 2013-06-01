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
                    <td><input type="text" id="novo_doc_nome" placeholder="Nome..."></input></td>
                    <td rowspan="2"><a href="#" id="create_document" class="button black" onclick="create_table_alteration();">Criar</a></td>
                </tr>
                <tr>
                    <td><input type="text" id="novo_doc_data" placeholder="Data..."></input></td>
                </tr>
            </table>
            
            <table id="id_table_alteration" class="table_alteration">
                <tr>
                    <td rowspan="5">
                        <select id="mdd_article_alteration" size="10" multiple>
                            <option selected>Apples</option>
                            <option>Bananas</option>
                            <option>Oranges</option>
                            <option>Watermelon</option>
                            <option>Kiwi</option>
                            <option>Cantaloupe</option>
                            <option>Strawberries</option>
                        </select>
                    </td>
                    <td align="center">
                        <a href="#" id="add_article" class="button black" onclick="blass();">Adicionar</a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="#" id="edit_article" class="button black" onclick="blass();">Alterar</a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="#" id="delete_article" class="button black" onclick="blass();">Remover</a>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <a href="#" id="done_article" class="button black" onclick="blass();">Terminar</a>
                    </td>
                </tr> 
            </table>
        </article>
    </section>
    