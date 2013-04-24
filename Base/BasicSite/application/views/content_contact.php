<div id="contact">
    <h1 style="margin: 20px; padding-top:20px;">Contact</h1>
    <table class="signup_form">
        <?php
            $this->load->helper("form");

            echo validation_errors();

            echo form_open("site/send_email");

            echo "<tr><td>";
            echo form_label("Name: ", "fullName");
            $data = array(
                "name" => "fullName",
                "id" => "fullName",
                "value" => set_value("fullName")
            );
            echo "</td><td>";
            echo form_input($data);
            echo "</td></tr>";

            echo "<tr><td>";
            echo form_label("Email: ", "email");
            $data = array(
                "name" => "email",
                "id" => "email",
                "value" => set_value("email")
            );
            echo "</td><td>";
            echo form_input($data);
            echo "</td></tr>";

            echo "<tr><td>";
            echo form_label("Message: ", "message");
            $data = array(
                "name" => "message",
                "id" => "message",
                "value" => set_value("message")
            );
            echo "</td><td>";
            echo form_textarea($data);
            echo "</td></tr>";
        ?>
        
        <tr><td colspan="2">
            <div id="signup_button">
                <p>
                    <input type="submit" name="contactSubmit" value="Submit" class="button_login" />
                </p>
            </div>
        </td></tr>

        <?php
            echo form_close();
        ?>
</div>
