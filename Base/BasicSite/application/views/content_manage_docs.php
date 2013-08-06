<div id="main_content">
    <section id="main_area">
        <article>
            <ul id="alteration_nav" class="alteration_nav">
                <li><a href="<?php echo base_url(); ?>backend/main_alteration">Novo/Editar Documento</a></li>
            <li><a href="<?php echo base_url(); ?>backend/hierarchy_alteration">Editar Hierarquia</a></li>
                <?php if($tipo->tipo == 2) { ?><li><a href="<?php echo base_url(); ?>backend/manage_docs">Gerir Documentos</a></li><?php } ?>
            </ul>
            <table id="id_table_manage_docs" class="table_manage_docs">
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Data de Criação</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                    <?php
                        for ($i=0; $i<sizeof($docs); $i++) {
                            if ($docs[$i]->estado != 3) {
                    ?>
                        <tr>
                            <td><?php echo $docs[$i]->nome; ?></td>
                            <td><?php echo $docs[$i]->data; ?></td>
                            <td><?php echo $docs[$i]->estado; ?></td>
                        </tr>
                    <?php
                            }
                        }
                    ?>
            </table>
            <select id="select_doc_manage" style="margin-top: 15px;">
                <?php
                    echo '<option selected></option>';
                    for ($i=0; $i<sizeof($docs); $i++) {
                        if ($docs[$i]->estado != 3) {
                            echo '<option value="' . $docs[$i]->data . '">' . $docs[$i]->nome . ' (' . $docs[$i]->estado . ')' . '</option>';
                        }
                    }
                ?>
            </select>
            <a href="#" class="backend_tooltip" style="margin-left: 10px;" onclick="approve_temp_doc();"><img src="<?php echo base_url(); ?>images/aproved.png" /><span>Aprovar Documento</span></a>
            <a href="#" class="backend_tooltip" style="margin-left: 10px;" onclick="disapprove_temp_doc();"><img src="<?php echo base_url(); ?>images/disapprove.png" /><span>Reprovar Documento</span></a>
            <a href="#" class="backend_tooltip" style="margin-left: 10px;" onclick="delete_temp_doc();"><img src="<?php echo base_url(); ?>images/delete.png" /><span>Apagar Documento</span></a>
        </article>
    </section>
    