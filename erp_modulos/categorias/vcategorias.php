<?php
class ERPCats {
    // Aquí pon textos de manera dinámica si gustas
    public $moduleName = "Categorías";
    public $moduleDescription = "Aquí va la descripción.";
}
$cats = new ERPCats();
?>
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <!-- <i class="pe-7s-users icon-gradient bg-mean-fruit"></i> -->
                <?php
                $iconoCategorias = $db->get('modulos', 'icono_modulo', ['nombre_modulo' => 'categorias']);
                ?>
                <i class="<?php echo $iconoCategorias; ?> icon-gradient bg-mean-fruit"></i>
            </div>
            <!-- Para llamarlos así -->
            <div><?php echo $cats->moduleName; ?></div>
        </div>
        <div class="page-title-actions">
            <?php
            //Si el id del modulo está en el array de permisos insertar muestra el boton
            if (in_array($idModuloCategorias[0], $_SESSION["insertar"])) :
            ?>
                <button class="btn btn-outline-success" data-toggle="modal" data-target="#insertarCategoria">
                    Nueva categoría
                </button>
            <?php
            endif;
            ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <table class="mb-0 table table-bordered text-center" id="tableCategorias">
                    <thead>
                        <tr>
                            <!-- <th class="text-center">#</th> -->
                            <th class="text-left">Nombre</th>
                            <?php
                                //Si el id del modulo se encuentra en el array de permisos editar o eliminar muestra el th
                            if (in_array($idModuloCategorias[0], $_SESSION["editar"]) || in_array($idModuloCategorias[0], $_SESSION["eliminar"])) :
                            ?>
                            <th class="text-center" data-width="180">Acciones</th>
                            <?php
                            endif;
                            ?>
                        </tr>
                    </thead>
                    <!-- <tbody id="catstbody"></tbody> -->
                    <tbody id="catstbody">
                    <?php
                    $categorias = $db->select("categorias", ["id_cat", "nombre_cat"]);
                        foreach ($categorias as $categoria) {
                    ?>
                    <tr>
                        <td class="text-left"><?php echo $categoria['nombre_cat']; ?></td>
                        <?php
                        //Si el id del modulo se encuentra en el array de permisos editar o eliminar muestra el td
                        if (in_array($idModuloCategorias[0], $_SESSION["editar"]) || in_array($idModuloCategorias[0], $_SESSION["eliminar"])) :
                        ?>
                        <td class="text-center">
                            <?php
                            //Si el id del modulo está en el array de permisos editar muestra el boton
                            if (in_array($idModuloCategorias[0], $_SESSION["editar"])) :
                            ?>
                            <button type="button" class="mr-2 btn btn-outline-primary get-cats-data" data-cat="<?php echo $categoria['id_cat']; ?>" data-toggle="modal" data-target="#detallesCategorias">
                                Editar
                            </button>
                            <?php
                            endif;

                            //Si el id del modulo está en el array de permisos eliminar muestra el boton
                            if (in_array($idModuloCategorias[0], $_SESSION["eliminar"])) :
                            ?>
                            <button class="mr-2 btn btn-outline-danger delete-cats-data" data-cat="<?php echo $categoria['id_cat']; ?>" data-toggle="modal" data-target="#eliminarCategoria">
                                Eliminar
                            </button>
                            <?php
                            endif;
                            ?>
                        </td>
                        <?php
                        endif;
                        ?>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <!-- Esto igual y podría removerse -->
            <!-- <div class="d-block text-center card-footer">
                <button class="btn-wide btn btn-success">Save</button>
            </div> -->
        </div>
    </div>
</div>