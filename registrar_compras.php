<?php include("header.php") ?>

    <!-- TITLE -->
    <div class="row text-center">
        <h3>Compras</h3>
    </div>
    
    <main class="container-fluid p-2">
        <div class="row">
            <div class="col-md-4">
                <!-- FORM -->
                <div class="card card-body">
                    <form action="" name="frm_materias_primas" id="frm_materias_primas" method="POST">
                        <input type="hidden" name="id_compra" id="id_compra" value="">
                        <input type="hidden" name="id_anteriorMP" id="id_anteriorMP" value="">
                        <input type="hidden" name="cantidadResta" id="cantidadResta" value="">
                        <div class="cols">
                            <div class="col1">
                                <div class="form-group ">
                                    <label for="nombre_materia_prima" class="form-label">Proveedor:</label>
                                    <div id="div_Proveedores" class="divSelect">
                                    <select class="form-control select2 required" name="proveedores" id="proveedores">
                                       </select>
                                   </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="form-group">
                                    <label for="nombre_materia_prima" class="form-label">fecha:</label>
                                    <div id="" class="divSelect">
                                        <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo date('Y-m-d') ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        

                        <p>
                             <hr >
                          <p>

                        <div class="form-group">
                            <label for="nombre_materia_prima" class="form-label">Nombre materia prima:</label>
                            <div id="div_MP" class="divSelect">
                               <select class="form-control select2 selectCSS required" name="materiasPrimas" id="materiasPrimas" >
                               </select>
                               
                           </div>
                        </div>
                        <div class="form-group">
                            <label for="stock_actual" class="form-label">Cantidad:</label>
                            <div id="" class="divSelect">
                                <input type="number" name="cantidad" id="cantidad" class="form-control required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="costo" class="form-label">Costo:</label>
                            <div id="" class="divSelect">
                                <input type="number" name="costo" id="costo" class="form-control required" >
                            </div>
                        </div>
                        
                        <div class="col-auto mt-2 text-center">
                            <button type="button" id="limpiar" class="btn btn-info btn-block">Limpiar</button>
                            <button type="submit" class="btn btn-success btn-block">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- TABLE -->
            <div class="col-md-8">
                <table class="table table-bordered table-striped" id="tbCompras" name="tbCompras">
                    <thead>
                        <tr>
                            <th class="text-center">Proveedor</th>
                            <th class="text-center">Materia Prima</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Costo</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                       
                           
                    </tbody>
                </table>
            </div>
        </div>
    </main>
<?php include("footer.php") ?>
    <script type="text/javascript">
        var fechaAux="<?php echo date('Y-m-d') ?>";
        $(document).ready(function() {

            

            $.post("crud_compras.php?op=listarMaterias",
                function(data,status)
                {  
                    $('#materiasPrimas').html(data);
                });
//
             $.post("crud_compras.php?op=listarProveedores",
                function(data,status)
                { 
                    $('#proveedores').html(data);
                });

            $('#materiasPrimas').focus();
            $(".select2").select2();


            $('#frm_materias_primas').on("submit",function(e){
                e.preventDefault();
                validar();//guardaryeditar();
               });

            $('#limpiar').on("click",function(e){
               limpiar();//guardaryeditar();
               });
            
            listar();

        });
        

        function guardaryeditar(){
            var formData=new FormData($("#frm_materias_primas")[0]);
             $.ajax({
                url: "crud_compras.php?op=guardaryeditar",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function(datos){  
                    if(parseInt(datos)==1){
                        alert("Compra Almacenada");
                        
                        limpiar();
                        listar();
                    }
                    else{
                       alert("Compra No Almacenada");
                    }
                }
             });
        }
function limpiar(){
  $('#cantidad').val('');
  $('#costo').val('');
  $('#id_compra').val('');
  $('#id_anteriorMP').val('');
  $('#cantidadResta').val('');
  $("#materiasPrimas").val('-1').trigger('change');
}
function listar(){ 
    $.post("crud_compras.php?op=listar",
        function(data,status)
        { 
                data=JSON.parse(data); 

                $('#tbCompras tbody').html('');
                $('#tbCompras tbody').html(data['filas']);
                
            });
}
function editar(id_compra,id_mp){
   
    $('#id_compra').val(id_compra);
    $('#id_anteriorMP').val(id_mp); // id de materia prima
    idtr=id_compra+'_'+id_mp; 
   // $('#proveedores').val();
   // $("#proveedores").select2("val", $('#pro_'+idtr).val());
    //$('#materiasPrimas').val();
    $("#materiasPrimas").select2("val", $('#mp_'+idtr).val());
    $('#cantidad').val($('#c_'+idtr+' td')[2].innerHTML);
    $('#cantidadResta').val($('#c_'+idtr+' td')[2].innerHTML);
    $('#costo').val($('#c_'+idtr+' td')[3].innerHTML);
   // $('#fecha').val($('#fecha_'+idtr).val());

    
}
function eliminar(id_compra,id_mp){ 
    
    cantidadResta=$('#c_'+id_compra+'_'+id_mp+' td')[2].innerHTML;
    console.log(cantidadResta);
    $.post("crud_compras.php?op=eliminar",{id_compra:id_compra,id_mp:id_mp,cantidadResta:cantidadResta},
        function(data,status)
        {       console.log(data);
               if(parseInt(data)==1){
                 listar();
               }else{
                alert("Compra No Eliminado");
               }
            });
}
function validar(){

    b=true;
    if($("#materiasPrimas").val()=="-1"){ 
        $("#div_MP").find(".select2-selection--single").addClass('borderError');
        b=false;
        }else{
             $("#div_MP").find(".select2-selection--single").removeClass('borderError');
        }
    if($("#proveedores").val()=="-1"){  
        $("#div_Proveedores").find(".select2-selection--single").addClass('borderError');
        b=false;
        }else{
             $("#div_Proveedores").find(".select2-selection--single").removeClass('borderError');
        }
    if($("#cantidad").val()==""){  
        $("#cantidad").addClass('borderError');
        b=false;
        }else{
             $("#cantidad").removeClass('borderError');
        }
    if($("#costo").val()==""){ 
        $("#costo").addClass('borderError');
        b=false;
        }else{
             $("#costo").removeClass('borderError');
        }

    if(b){
        guardaryeditar();
    }    
    
}
    </script>

