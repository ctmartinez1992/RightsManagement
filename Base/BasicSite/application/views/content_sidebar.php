    <aside id="main_sidebar">
        <div id="sidebar">
            <table class="macro_form">
                <?php
                    echo form_open('main_program/macro_validation');
                    echo validation_errors();
                ?>
                <tr>
                    <td>Macro:</td>
                    <td>
                        <?php
                            echo form_input('input_macro', array(), 0, 'id="input_macro"'); 
                        ?>
                    </td>
                    <td>
                        <a class="help_tooltip" href="" style="margin-left: -10px;"><img src="<?php echo base_url(); ?>images/macro_tooltip.png" />
                            <span>
                                As macros permitem fazer uma pesquisa mais flexível usando simples comandos. Exemplos:<br>
                                "Artigo: 1,2,3,4,6,12,456" - Vais buscar os artigos enumerados;<br>
                                "Livro: 1; Título: 2" - Vai buscar o Título 2 do Livro 1;<br>
                            </span>
                        </a>
                    </td>
                 </tr>
                 <tr>
                     <td colspan="2">
                        <div id="main_macro_button">
                            <p>
                                <input type="submit" name="macroSubmit" value="Pesquisar" class="button_search" />
                            </p>
                        </div>
                    </td>
                 </tr>
                 <?php
                    echo form_close();
                 ?>
            </table>
            <hr>
            <table class="search_form">
                <?php
                    echo form_open('main_program/search_validation');
                    echo validation_errors();
                ?>
                <tr>
                    <td>Livro:</td>
                    <td>
                        <select id="dd_livro" onChange="fill_titulo();">
                            <?php
                                echo '<option value="' . $livro[0] . '" selected>' . $livro[0] . '</option>';
                                for ($i=1; $i<sizeof($livro); $i++) {
                                    echo '<option value="' . $livro[$i] . '">' . $livro[$i] . '</option>';
                                }
                            ?>
                        </select>
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
            <select id="is_backend" style="visibility:hidden;"><option value="false">stupid way to know that i am in backend</option></select>
        </div>
    </aside>
</div>