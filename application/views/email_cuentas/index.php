

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Cuentas SMTP</h3>
        <a href="<?= site_url('email_cuentas/crear') ?>" class="btn btn-success">
            Nueva cuenta
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            <table id="tablaSMTP" class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Empresa</th>
                        <th>Nombre</th>
                        <th>Host</th>
                        <th>Usuario</th>
                        <th>Puerto</th>
                        <th>Activo</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($cuentas as $c): ?>
                    <tr>
                        <td><?= $c->id ?></td>
                        <td><?= $c->razon_soc ?></td>
                        <td><?= $c->nombre ?></td>
                        <td><?= $c->smtp_host ?></td>
                        <td><?= $c->smtp_user ?></td>
                        <td><?= $c->smtp_port ?></td>
                        <td><?= $c->activo ? 'Sí' : 'No' ?></td>

                        <td class="text-right">
                            <a href="<?= site_url('email_cuentas/editar/'.$c->id) ?>"
                               class="btn btn-sm btn-primary">
                                Editar
                            </a>

                            <a href="<?= site_url('email_cuentas/eliminar/'.$c->id) ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('¿Eliminar cuenta?')">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

<script>
$(document).ready(function() {
    $('#tablaSMTP').DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        }
    });
});
</script>
