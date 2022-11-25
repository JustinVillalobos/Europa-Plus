<?php include(__DIR__."/header.php");?>

<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color:#FFF;">
  <tr>
    <td>
    <table width="670" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>

            <table width="670" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="20"></td>
              </tr>
            </table>

            <table width="670" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="15"></td>
              </tr>
            </table>

            <table width="650" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
              <tr>
                <td>

                  <table width="628" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td height="20"></td>
                    </tr>
                  </table>

                  <table width="628" border="0" cellspacing="0" cellpadding="0" align="center">
                  <?php $route2 = route("operacion.index");?>
                  <tr>
                      <td height="40" style="text-align:center; font-family: Arial, 'Trebuchet MS', Verdana, sans-serif; font-size:22px; font-weight:bold; line-height: 18px; color: #000000; border-top: 1px dotted #999;">
                            <img src="<?php echo "http://aplicaciones.europaplus.net/gestion/admin/images/logo.jpg";//https://lh5.googleusercontent.com/348Noz5cH0JLE0XMRjKjxzpAhyCQg3_vNGyeWmAsn2SU0BGsmPowK1i0RZefraojFNU=w2400;URL::asset('assets/log.jpg'); ?>" style="width:300px" />
                        </td>
                    </tr>
                    <tr>
                      <td height="40" style="text-align:center; font-family: Arial, 'Trebuchet MS', Verdana, sans-serif; font-size:22px; font-weight:bold; line-height: 18px; color: #000000; border-top: 1px dotted #999;"><?php echo $distressCall['title'];?> </td>
                    </tr>
                    <tr>
                      <td style="text-align:justify; font-family: Arial, 'Trebuchet MS', Verdana, sans-serif; font-size:12px; line-height: 18px; color: #000000; border-top: 1px dotted #999; border-bottom: 1px dotted #999;">
                        <p>Estimado(a) <?php echo $distressCall['alumno']->alu_nombre." ".$distressCall['alumno']->alu_apellidos?>: </p>
                        <p><?php echo $distressCall['subject']?></p>
                    </tr> 
                    <tr>
                        <p style="font-size:9px;margin-top:15px">
                            EUROPA PLUS SPAIN - ESCUELAS DE IDIOMAS EN EL MUNDO <br> 
                            <?php echo $_SESSION["empresa"]->direccion;?><br>
                            Tel. <?php echo $_SESSION["empresa"]->telefono;?>  Whatsapp  <?php echo $_SESSION["empresa"]->whatsapp;?> <br>
                            <?php echo $_SESSION["empresa"]->sitio_web;?><br>
                            <?php echo $_SESSION["empresa"]->correo;?><br>
                            <p style="font-size:9px">
                                De conformidad con lo dispuesto en la Ley Orgánica 15/1999 de Protección de Datos de carácter 
                                Personal EUROPA PLUS SL domiciliado en la Calle <?php echo $_SESSION["empresa"]->direccion;?>D, le informa que los datos 
                                que nos ha proporcionado formarán parte de un fichero de datos de carácter personal, responsabilidad de dicha entidad, 
                                con la finalidad de gestionar las comunicaciones que pudiera mantener con el personal de la misma. En el supuesto de 
                                que desee ejercitar los derechos que le asisten de acceso, rectificación, cancelación y oposición dirija una comunicación 
                                por escrito a EUROPA PLUS SL a la dirección <?php echo $_SESSION["empresa"]->direccion;?> incluyendo copia del Documento Nacional 
                                de Identidad o documento identificativo equivalente, o a través de un mensaje de correo electrónico a la dirección 
                                <?php echo $_SESSION["empresa"]->correo;?>. La información contenida en el presente mensaje de correo electrónico es confidencial y 
                                su acceso únicamente está autorizado al destinatario original del mismo, quedando prohibida cualquier comunicación, divulgación, o reenvío, 
                                tanto del mensaje como de su contenido. En el supuesto de que usted no sea el destinatario autorizado, le rogamos borre el contenido 
                                del mensaje y nos comunique dicha circunstancia a través de un mensaje de correo electrónico a la dirección <?php echo $_SESSION["empresa"]->correo;?> 
                                o al teléfono <?php echo $_SESSION["empresa"]->telefono;?> 
                            </p>
                        </p>
                    </tr>
                    <tr>
                   
                    </tr>
                  </table></td>
              </tr>
            </table>

            <table width="628" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td height="20"></td>
              </tr>
            </table>

            <table width="628" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td height="12"></td>
              </tr>
            </table>
          </td>
        </tr>
      </table></td>
  </tr>
</table>

</td>
</tr>
</table>
<script>
    
</script>
</body>
</html>