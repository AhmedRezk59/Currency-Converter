<?php

$url = url(Core\Http\Request::url());
$paginated_data = session('paginated_data');
$limit = $paginated_data['limit'] -1 ?: 10 -1;
$page = filter_var(Core\Http\Request::get('page'), FILTER_SANITIZE_NUMBER_INT) ?: $paginated_data['page'] ?: 1;

if (ceil($paginated_data['total_rows'] / $limit) > 0) : ?>
    <ul class="pagination mb-8">
        <li class="prev inline-block rounded button bg-violet-400 px-6 py-3"><a href="<?= $url ?>?page=<?= $page - 1 ?>" class="<?= $page == 1 ? 'disabled' : '' ?>">Prev</a></li>

        <li class=" inline-block rounded button bg-red-400 px-6 py-3"><span><?= $page ?></span></li>

        <li class="next inline-block rounded button bg-green-400 px-6 py-3"><a href="<?= $url ?>?page=<?= $page + 1 ?>" class="<?= $paginated_data['total_rows'] <= $limit ? 'disabled' : '' ?>">Next</a></li>
    </ul>
<?php endif; ?>
<style>
    .disabled {
        pointer-events: none;
        cursor: none;
    }
</style>