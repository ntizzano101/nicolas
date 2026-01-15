<div class="container mt-4">

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <?= isset($cuenta) ? 'Editar cuenta SMTP' : 'Nueva cuenta SMTP' ?>
            </h4>
        </div>

        <div class="card-body">

            <form method="post">

                <div class="form-group">
                    <label>Empresa</label>
                    <select name="id_empresa" class="form-control" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($empresas as $e): ?>
                            <option value="<?= $e->id_empresa ?>"
                                <?= isset($cuenta) && $cuenta->id_empresa == $e->id_empresa ? 'selected' : '' ?>>
                                <?= $e->razon_soc ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nombre identificador</label>
                    <input type="text" name="nombre" class="form-control"
                           value="<?= $cuenta->nombre ?? '' ?>" required>
                </div>

                <div class="form-group">
                    <label>SMTP Host</label>
                    <input type="text" name="smtp_host" class="form-control"
                           value="<?= $cuenta->smtp_host ?? '' ?>" required>
                </div>

                <div class="form-group">
                    <label>Usuario SMTP</label>
                    <input type="text" name="smtp_user" class="form-control"
                           value="<?= $cuenta->smtp_user ?? '' ?>" required>
                </div>

                <div class="form-group">
                    <label>Contraseña SMTP</label>
                    <input type="password" name="smtp_pass" class="form-control"
                           value="<?= $cuenta->smtp_pass ?? '' ?>" required>
                </div>

                <div class="form-group">
                    <label>Puerto</label>
                    <input type="number" name="smtp_port" class="form-control"
                           value="<?= $cuenta->smtp_port ?? '' ?>" required>
                </div>

                <div class="form-group">
                    <label>Criptografía</label>
                    <select name="smtp_crypto" class="form-control">
                        <option value="">Sin cifrado</option>
                        <option value="tls" <?= isset($cuenta) && $cuenta->smtp_crypto == 'tls' ? 'selected' : '' ?>>TLS</option>
                        <option value="ssl" <?= isset($cuenta) && $cuenta->smtp_crypto == 'ssl' ? 'selected' : '' ?>>SSL</option>
                    </select>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="activo" value="1"
                        <?= isset($cuenta) && $cuenta->activo ? 'checked' : '' ?>>
                    <label class="form-check-label">Cuenta activa</label>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= site_url('email_cuentas') ?>" class="btn btn-secondary">
                        Volver
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
