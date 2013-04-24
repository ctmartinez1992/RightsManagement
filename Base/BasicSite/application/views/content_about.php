<div id="content">
    <section id="main_section">
        <?php
            foreach ($result as $row) {
                $title = $row->title;
                $text1 = $row->text1;
                $text2 = $row->text2;
            }
        ?>
        
        <h1><?php echo heading($title, 1, ""); ?></h1>
        <article>
            <h2><?php echo $text1; ?></h2>
            <p><?php echo $text2; ?></p>
            <h2><?php echo $text1; ?></h2>
            <p><?php echo $text2; ?></p>
        </article>
    </section>
</div>