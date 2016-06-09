<?php 
    require('../layouts/header.php');
    
    if($_SESSION['type']=='TECHNICAL' || $_SESSION['type']=='ADMIN'){
?>
<!-- <section> -->
     <style type="text/css" scoped>
        @import url("../css/pages/categories.css");
    </style>  
    
    <div id="wrapper">
        <h1> <?php echo $CATEGORIES_categories;?> </h1>
        <hr size="2px"/>
        <br>
        <br>
        
        <select id="categories">
            <option value="0"> <?php echo $CATEGORIES_select;?>
            <?php
                $result = $db->query("select c.id CATEGORIA_ID, c.NOMBRE CATEGORIA_NOMBRE FROM CATEGORIA c;");
                while($row = mysqli_fetch_array($result)){
                    ?>
                        <option value="<?php echo $row['CATEGORIA_ID'];?>"><?php echo $row['CATEGORIA_NOMBRE'];?>
                    <?php
                }
            ?>
        </select>
        <script>
            function deleteCategory2(){
                var parametros = {
                        "CATEGORIA": $("#categories").val()
                };
                
                $.ajax({
                        data:  parametros, //Datos que mandamos
                        url:   '../php/scripts/deleteCategory.php', //Direccion a donde lo mandamos
                        type:  'post', 
                        
                        //Antes del envío se produce...:
                        beforeSend: function () {
                                // No hacemos nada
                        },
                        
                        //Despues del envio se produce...:
                        success:  function (response) {
                            swal(
                                '<?php echo $DEPENDENCIES_delete;?>',
                                '<?php echo $CATEGORIES_verify_deleted;?>',
                                'success'
                            ).then(function(){
                                //window.location="categories.html";
                                location.reload(true);
                            });
                        }
                });
            }
            
            function deleteCategory(){
                if($("#categories").val()==0){
                    swal(
                        '<?php echo $DEPENDENCIES_error;?>',
                        '<?php echo $CATEGORIES_intro_category;?>',
                        'error'
                    );
                }else{
                    swal({
                        title: '<?php echo $DEPENDENCIES_confirm;?>',
                        text: "<?php echo $DEPENDENCIES_warning;?>",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '<?php echo $CATEGORIES_cancel_accept;?>',
                        cancelButtonText: '<?php echo $DEPENDENCIES_cancel;?>'
                    }).then(function(isConfirm) {
                        if (isConfirm) {
                            deleteCategory2();
                        }
                    });
                    
                }
            }
            
            function addCategory2(category){
                var parametros = {
                    "CATEGORIA": category
                };
                
                $.ajax({
                        data:  parametros, //Datos que mandamos
                        url:   '../php/scripts/addCategory.php', //Direccion a donde lo mandamos
                        type:  'post', 
                        
                        //Antes del envío se produce...:
                        beforeSend: function () {
                                // No hacemos nada
                        },
                        
                        //Despues del envio se produce...:
                        success:  function (response) {
                            if(response=='1'){
                                    swal({
                                        type: 'success',
                                        text: '<?php echo $CATEGORIES_added;?>'
                                    }).then(function(){
                                        //window.location="categories.html";
                                        location.reload(true);
                                    });
                                }else{
                                    swal(
                                        '<?php echo $DEPENDENCIES_error;?>',
                                        '<?php echo $CATEGORIES_error_message;?>',
                                        'error'
                                    ).then(function(){
                                        addCategory();
                                    });
                                }
                        }
                });
            }
            // Función para hacer la llamada a check.
            function loading_check2(){
                swal.enableLoading();
                setTimeout(function() {
                    addCategory2($('#category2').val());
                }, 200);
            }
                    
            // Funcion para el evento de presionar enter.
            function showSweetCheck2(e){
                if (e.keyCode==13){
                    loading_check2($('#category2').val());
                }     
            }
            
             function addCategory(){	
                swal({
                    title: '<?php echo $CATEGORIES_intro_category;?>',
                    html: '<input id="category2" class="input-field" max="20">',
                    showCancelButton: true    
                }).then(function(isConfirm) {
                    if(isConfirm){
                            addCategory2($('#category2').val());
                        }
                });
                
                $("input").bind("keydown",showSweetCheck2);
            }
        </script>
        <div class="X" onclick="deleteCategory()">X</div>
        <div class="button" onclick="addCategory();"> <?php echo $DEPENDENCIES_add;?> </div>
    </div>
<!-- </section> -->    
<?php
    }else{
        ?>
        <script> window.location="index.html"; </script>
        <?php
    }
    require('../layouts/footer.php');
?>