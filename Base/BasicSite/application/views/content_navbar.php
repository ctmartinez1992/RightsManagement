    <nav id="main_navbar">
        <table>
            <tr>
                <td width ="600px">
                    <ul>
                        <li>tmp1</li>
                        <li>></li>
                        <li>tmp2</li>
                    </ul>
                </td>
                <td width ="580px" align="right">                    
                    <select id="dd_data_doc" data-placeholder="Documento" class="chzn-select" style="width: 200px" onChange="change_hierarchy()">
                        <?php
                            for ($i=sizeof($docs)-1; $i>=0; $i--) {
                                echo '<option value="' . $docs[$i] . '">' . $docs[$i] . '</option>';
                            }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
    </nav>