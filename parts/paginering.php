<nav aria-label="navigation pagination">
    <ul class="pagination justify-content-end">
        <li class="page-item<?= ($vorige < 1) ? ' disabled' : '' ?>">
            <a class="page-link"
               href="<?= getBaseUrl() . (!empty($getVariabelenVoorUrl)) ? $getVariabelenVoorUrl . '&' : '?' ?>pagina=<?= $vorige ?>"
               tabindex="-1"
               aria-disabled="true">Vorige</a>
        </li>
        <?php foreach ($paginaNummering as $key => $paginaNummer): ?>
            <li class="page-item<?= ($key === 'selected') ? ' active' : '' ?>">
                <a class="page-link"
                   href="<?= getBaseUrl() . (!empty($getVariabelenVoorUrl)) ? $getVariabelenVoorUrl . '&' : '?' ?>pagina=<?= $paginaNummer ?>">
                    <?= $paginaNummer ?>
                </a>
            </li>
        <?php endforeach; ?>
        <li class="page-item<?= ($volgende > $aantalPaginas) ? ' disabled' : '' ?>">
            <a class="page-link"
               href="<?= getBaseUrl() . (!empty($getVariabelenVoorUrl)) ? $getVariabelenVoorUrl . '&' : '?' ?>pagina=<?= $volgende ?>">Volgende</a>
        </li>
    </ul>
</nav>