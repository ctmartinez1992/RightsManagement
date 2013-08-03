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
                    <td>
                        Título do Artigo:
                    </td>
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
                    <td>
                        <button id="addition_submit" type="button" class="button_login" style="margin: 10px 0px 0px 5px; float: left;" onclick="validate_addition();">
                            Submit
                        </button>
                    </td>
                </tr>
            </table>
        </article>
    </section>
    