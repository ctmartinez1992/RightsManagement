<h1 style="margin: 20px">Sign up</h1>

    <table class="signup_form">
        <?php
            echo form_open('site/signup_validation');

//            echo validation_errors();
            
            echo "<tr>";
            echo "<td>Nome: ";
            echo "</td><td>" . form_input('nome') . "</td>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<td>Email: ";
            echo "</td><td>" . form_input('email') . "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Password: ";
            echo "</td><td>" . form_password('password') . "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Confirm Password: ";
            echo "</td><td>" . form_password('cpassword') . "</td>";
            echo "</tr>";
        ?>
        <tr><td>
            <div id="signup_button">
                <p>
                    <input type="submit" name="signup_submit" value="Sign up" class="button_login"/>
                </p>
            </div>
        </td></tr>
        <?php
            echo form_close();
        ?>
    </table>
