<h1>
Es una pena que te vayas <?= $customer["name"]?>!
</h1>
<h2>Estás seguro de querer darte de baja en el newsletter de Hidrolavadoras MAR?</h2>

<form action="<?= $_ENV["SITE_URL"] ?>/notification/unsuscribe/jcespitia1@gmail.com" method="post">
<input type="hidden" value="<?= $customer["id"] ?>" name="id" />
    <select type="text" name="confirm"  >
        <option value="no">No, no deseo darme de baja</option>
        <option value="si">Si, deseo darme de baja inmediatamente</option>
    </select>
    <input type="submit" value="confirmar" />
</form>