<!-- Empieza el pie de página -->        
        </section>
        
        
                <?php
                    if($filename=="login"){
                        ?>
                        <footer style="z-index: 2000">
                            <p> <?php echo $organization;?>. <a href="http://qprob.github.io/">QProb</a>. Created by Daniel Torres Ruiz. </p>
                        <?php
                    } else{
                        ?>
                        <footer>
                        <?php
                    }
                ?>
        </footer>
    </body>
</html>
<?php
    $db->close();