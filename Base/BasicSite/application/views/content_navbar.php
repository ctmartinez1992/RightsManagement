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
                    <div>
                        <script type="text/javascript">
                            $(".chzn-select").chosen();
                        </script>
                        <select id="dd_data_doc" data-placeholder="Documento" class="chzn-select" style="width: 200px" onChange="change_hierarchy()">
                            <?php
                                for ($i=sizeof($docs)-1; $i>=0; $i--) {
                                    if ($current_doc == $docs[$i]) {
                                        echo '<option value="' . $docs[$i] . '" selected>' . $docs[$i] . '</option>';
                                    } else {
                                        echo '<option value="' . $docs[$i] . '">' . $docs[$i] . '</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
        </table>
    </nav>