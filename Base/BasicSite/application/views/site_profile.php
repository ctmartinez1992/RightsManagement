<h1 style="margin: 20px">Perfil</h1>

    <table class="signup_form">
        <?php
            $optionsCountry = array(
                'Portugal'  => 'Portugal',
                'England'    => 'England'
            );
            
            $optionsDay = array();
            for ($d=1; $d<=31; $d++) {
                $optionsDay[$d] = $d;
            }
            
            $optionsMonth = array();
            for ($m=1; $m<=12; $m++) {
                $optionsMonth[$m] = $m;
            }
            
            $optionsYear = array();
            for ($y=1850; $y<=date('Y'); $y++) {
                $optionsYear[$y] = $y;
            }
            
            $date = explode('/', $user->nascimento);
        
            echo form_open('site/profile_validation');
            
            echo validation_errors();
            
            echo "<tr>";
            echo "<td>Nome: ";
            echo "</td><td>" . form_input('nome', $user->nome) . "</td>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<td>Data de Nascimento: ";
            if ($date[0] == 0) {
                echo "</td><td>" . form_dropdown('dia', $optionsDay, 0) . " - </td>" . "<td>" . 
                                   form_dropdown('mes', $optionsMonth, 0) . " - </td>" . "<td>" . 
                                   form_dropdown('ano', $optionsYear, 0) . "</td>";
            } else {
                echo "</td><td>" . form_dropdown('dia', $optionsDay, $date[0]) . " - </td>" . "<td>" . 
                                   form_dropdown('mes', $optionsMonth, $date[1]) . " - </td>" . "<td>" . 
                                   form_dropdown('ano', $optionsYear, $date[2]) . "</td>";
            }

            echo "<tr>";
            echo "<td>País: ";
            echo "</td><td>" . form_dropdown('pais', $optionsCountry, $user->pais) . "</td>";
            echo "</tr>";
        ?>
        <tr><td>
            <div id="signup_button">
                <p>
                    <input type="submit" name="profile_submit" value="Update" class="button_login"/>
                </p>
            </div>
        </td></tr>
        <?php
            echo form_close();
        ?>
    </table>
