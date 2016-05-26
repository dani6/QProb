<!-- Empieza el pie de página -->        
        </section>
        
        <footer>
                <?php
                    if($filename=="login"){
                        ?>
                            <p><?php echo $organization;?>. <a href="http://qprob.github.io/">QProb</a>. Created by Daniel Torres Ruiz. </p>
                        <?php
                    } 
                ?>
        </footer>
    </body>
</html>
<?php
    $db->close();