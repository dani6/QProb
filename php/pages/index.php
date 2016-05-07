<?php 
    require('../layouts/header.php');
?>
<!-- <section> -->
    <style type="text/css" scoped>
        @import url("../css/pages/index.css");
    </style>  
    
    <a href="plantilla.html">Plantilla -></a>
<!-- </section> -->    
<?php
    echo $_SESSION['user'];
    require('../layouts/footer.php');
?>