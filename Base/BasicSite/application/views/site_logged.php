<div id="login">
    <p style="margin: 5px 0px 0px 0px; font: bold 12px Tahoma; text-align: center;">Olá</p>
    <p style="margin: 20px 0px 0px 0px; font: bold 16px Tahoma; text-align: center;"><?php echo $logged_user; ?></p>
    <div id="login_button" style="margin-top: 20px">
        <a href='<?php echo base_url() . "site/profile"; ?>'>
            <button type="button" class="button_login">Perfil</button>
        </a>
    </div>
    <div id="signup_button" style="margin-top: 20px">
        <a href='<?php echo base_url() . "site/logout"; ?>'>
            <button type="button" class="button_login">Logout</button>
        </a>
    </div>
</div>