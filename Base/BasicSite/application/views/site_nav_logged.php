    <nav id="nav">
        <ul>
            <li><a href="<?php echo base_url(); ?>site/home">Home</a></li>
            <li><a href="<?php echo base_url(); ?>site/codigo_civil">Código Civil</a></li>
            <?php if($tipo->tipo == 2) { ?><li><a href="<?php echo base_url(); ?>backend/main_alteration">Alterações</a></li><?php } ?>
            <li><a href="<?php echo base_url(); ?>site/about">About</a></li>
            <li><a href="<?php echo base_url(); ?>site/contact_no">Contact</a></li>
        </ul>
    </nav>