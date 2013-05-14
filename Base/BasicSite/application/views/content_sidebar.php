    <aside id="main_sidebar">
        <div id="sidebar">
            <table class="search_form">
                <?php
                    echo form_open('main_program/search_validation');
                    echo validation_errors();
                ?>
                <tr>
                    <td>Livro:</td>
                    <td>
                        <?php 
                            echo form_dropdown('dd_livro', $livro, 0, 'id="dd_livro" onChange="fill_titulo()"'); 
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
                        <select name="dd_subtitulo" id="dd_subtitulo" onchange="fill_capitulo"/>
                    </td>
                 </tr>
                <tr>
                    <td>Capítulo:</td>
                    <td>
                        <select name="dd_capitulo" id="dd_capitulo" onchange="fill_seccao"/>
                    </td>
                 </tr>
                <tr>
                    <td>Secção:</td>
                    <td>
                        <select name="dd_seccao" id="dd_seccao" onchange="fill_subseccao"/>
                    </td>
                 </tr>
                <tr>
                    <td>Subsecção:</td>
                    <td>
                        <select name="dd_subseccao" id="dd_subseccao" onchange="fill_divisao"/>
                    </td>
                 </tr>
                <tr>
                    <td>Divisão:</td>
                    <td>
                        <select name="dd_divisao" id="dd_divisao" onchange="fill_subdivisao"/>
                    </td>
                 </tr>
                <tr>
                    <td>Subdivisão:</td>
                    <td>
                        <select name="dd_subdivisao" id="dd_subdivisao" onchange="fill_artigos"/>
                    </td>
                 </tr>
                <tr>
                    <td>Artigo:</td>
                    <td>
                        <select name="dd_artigo" id="dd_artigo"/>
                    </td>
                 </tr>
                 <tr>
                     <td colspan="2">
                        <div id="signup_button">
                            <p>
                                <input type="submit" name="contactSubmit" value="Submit" class="button_login" />
                            </p>
                        </div>
                    </td>
                 </tr>
                 <?php
                    echo form_close();
                 ?>
            </table>
        </div>
    </aside>
</div>