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
                    <?php
                        echo form_dropdown('dd_data_doc', $docs, $default_doc, 'id="dd_data_doc"'); 
                    ?>
                </td>
            </tr>
        </table>
    </nav>