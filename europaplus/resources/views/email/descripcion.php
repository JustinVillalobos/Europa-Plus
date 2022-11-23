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
                    <tr>
                      <td height="40" style="text-align:center; font-family: Arial, 'Trebuchet MS', Verdana, sans-serif; font-size:22px; font-weight:bold; line-height: 18px; color: #000000; border-top: 1px dotted #999;"><?php echo $distressCall['title'];?> </td>
                    </tr>
                    <tr>
                      <td style="text-align:justify; font-family: Arial, 'Trebuchet MS', Verdana, sans-serif; font-size:12px; line-height: 18px; color: #000000; border-top: 1px dotted #999; border-bottom: 1px dotted #999;">
                        <p>Estimado(a) <?php echo $distressCall['operacion']->alu_nombre." ".$distressCall['operacion']->alu_apellidos?>: </p>
                        <p><?php echo $distressCall['subject']?></p>
                    </tr> 
                    <tr>
                    <?php $route2 = route("operacion.index");?>
                    
                        <a id="link" href="<?php echo $route2."/../".$distressCall['path'];?>"><?php echo $distressCall['name'];?></a>
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