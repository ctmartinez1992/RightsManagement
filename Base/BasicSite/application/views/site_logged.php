<div id="login">
    <p style="margin: 5px 5px 5px 10px; font: bold 14px Tahoma">Olá, <?php echo $logged_user; ?></p>
    <p style="margin: 20px 5px 5px 46px"><a href="<?php echo base_url(); ?>site/profile">perfil</a> | <a href="#">mensagens</a> | <a href="#">opções</a></p>
    <div id="logout_button">
        <a href='<?php echo base_url() . "site/logout"; ?>'>
            <button type="button" class="button_login">Logout</button>
        </a>
    </div>
</div>