<?php
    $result = $db->query("SELECT * FROM CATEGORIA;");
    
    $categorias="";
    while($row = mysqli_fetch_array($result)){
        $categorias.="<option value=\"".$row['ID']."\">".$row['NOMBRE'];
    }
    
    $result = $db->query("SELECT * FROM EDIFICIO;");
    
    $edificios="";
    while($row = mysqli_fetch_array($result)){
        $edificios.='<option value="'.$row['id'].'">'.$row['NOMBRE'];
    }
?>
<center><table class="formIncidence"><tr><td><?php echo $title;?></td><td colspan="3"><input tabindex="1" style="width: 600px"; placeHolder="<?php echo $title;?>" value="" class="input-field" maxlength="60" id="titulo3"></td></tr><tr><td colspan="4"><textarea tabindex="2" style="width: 700px; height: 200px; max-width:700px;max-height:200px;"; value="" class="input-field" id="descripcion3" placeholder="<?php echo $INCIDENCIES_description;?>"></textarea></td></tr><tr><td colspan="3"><select tabindex="3" style="width: 300px;" class="input-field" id="tipo3"><option value=""><?php echo $INCIDENCIES_select_type;?><option value="GENERAL">GENERAL<option value="TIC">TIC<?php if($_SESSION['type']!="NORMAL"){?><option value="URGENTE">URGENTE<?php }?></select></td><td colspan="4"><select style="width: 340px;" tabindex="4" class="input-field" id="categoria3"><option value="">-- <?php echo $CATEGORIES_select;?><?php echo $categorias;?></select></td></tr></table></center><center><table  class="formIncidence"><tr><td><select style="width: 200px;" class="input-field" id="edificio3" tabindex="5" onchange="updateFloor($(\'#edificio3\').val());"><option value="0"> <?php echo $DEPENDENCIES_select_build;?><?php echo $edificios;?></select></td><td id="plantatd"><select tabindex="6" style="width: 100px;" class="input-field" id="planta3" onchange="updateClass($(\'#planta3\').val());"><option value="0"><?php echo $INCIDENCIES_floor;?></select></td><td id="aulatd"><select tabindex="7" style="width: 400px;"class="input-field" id="aula3"><option value="0"> <?php echo $INCIDENCIES_select_classroom;?></select></td></tr></table></center> 