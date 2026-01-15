<div class="modal fade" id="modalEnviarMail" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">
          Enviar factura por correo
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>

      <form method="post" action="<?= site_url('ventas/enviar_mail') ?>">

        <div class="modal-body">

          <input type="hidden" name="id_empresa" value="<?= $empresa->id_empresa ?>">
          <input type="hidden" name="id_factura" value="<?= $factura->id_factura ?>">

          <!-- Empresa -->
          <div class="form-group">
            <label>Nombre de empresa</label>
            <input type="text" class="form-control" value="<?= $empresa->razon_soc ?>" readonly>
          </div>

          <!-- Cuenta SMTP -->
          <div class="form-group">
            <label>Desde cuenta de correo</label>
            <select name="id_cuenta" class="form-control" required>
              <option value="">Seleccione...</option>
              <?php foreach ($cuentas as $c): ?>
                <option value="<?= $c->id ?>"><?= $c->nombre ?> (<?= $c->smtp_user ?>)</option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Para -->
          <div class="form-group">
            <label>Para</label>
            <input type="email" name="para" class="form-control"
                   value="<?= $cliente->email ?>" required>
          </div>

          <!-- Asunto -->
          <div class="form-group">
            <label>Asunto</label>
            <input type="text" name="asunto" class="form-control"
                   value="Factura por servicios <?= date('m/Y') ?>" required>
          </div>

          <!-- Mensaje -->
          <div class="form-group">
            <label>Mensaje</label>
            <textarea name="mensaje" class="form-control" rows="6">
Estimado <?= $cliente->cliente ?>,
Adjuntamos la factura correspondiente al periodo <?= date('m/Y') ?>.
Muchas gracias.
<?php echo( $empresa->razon_soc ."\r\n" . $empresa->direccion ."\r\n" . $empresa->telefono
."\r\n" . $empresa->telefono);
?>

Datos para Transferencia : 
<?php foreach ($cbu as $c): ?>
Banco:<?= $c->banco ?> Nro cuenta:<?= $c->cuenta ?> CBU:<?= $c->cbu ?> Alias:<?= $c->alias ?>
<?php endforeach; ?>
Saludos cordiales.
            </textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>

      </form>

    </div>
  </div>
</div>
