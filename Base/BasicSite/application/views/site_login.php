        <div id="login">
            <?php
            echo form_open("site/login_validation");

            echo "<p id=\"login_text\">Username: ";
            echo form_input('email');
            echo "</p>";

            echo "<p id=\"password_text\">Password: ";
            echo form_password('password');
            echo "</p>";
            ?>
            <div id="login_button">
                <p>
                    <input type="submit" name="login_submit" value="Login" class="button_login"/>
                </p>
            </div>
            <?php
            echo form_close();
            ?>
            <div id="signup_button">
                <a href='<?php echo base_url() . "site/signup"; ?>'>
                    <button type="button" class="button_login">Signup</button>
                </a>
            </div>
        </div>