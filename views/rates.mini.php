<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exchange Rates</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex flex-col">
        <div class="flex flex-row justify-around">
            <div class="flex flex-col-6 mx-16 my-4">
                <form action="<?= url('/rates/update') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <button type="submit" class="inline-block rounded bg-violet-500 text-white text-bold px-6 pb-2 pt-2.5">
                        Refresh rates
                    </button>
                </form>
            </div>
            <div class="flex flex-col-6 mx-16 my-4">
                <a href="<?= url('/rates-converter') ?>" class="button bg-red-400 text-white px-6 pb-2 pt-2.5 rounded">
                    Convert currencies
                </a>
            </div>
            <div class="flex flex-col-6 mx-16 my-4">
                <a href="<?= url('/latest-conversions') ?>" class="inline-block rounded bg-green-400 text-white text-bold px-6 pb-2 pt-2.5"> Show Latest Conversions</a>
            </div>
        </div>
        <div class="flex flex-col-6 w-50 mx-auto">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-center text-sm font-light">
                            <thead class="border-b font-medium dark:border-neutral-500">
                                <tr>
                                    <th scope="col" class="px-6 py-4">#</th>
                                    <th scope="col" class="px-6 py-4">Currency</th>
                                    <th scope="col" class="px-6 py-4">Code</th>
                                    <th scope="col" class="px-6 py-4">Rate</th>
                                    <th scope="col" class="px-6 py-4">Last updated</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $index => $row) {
                                ?>
                                    <tr class="border-b dark:border-neutral-500">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">
                                            <?= $index + 1 ?>
                                        </td>
                                        <td class="whitespace-nowrap px-6 py-4"><?= $row->currency ?></td>
                                        <td class="whitespace-nowrap px-6 py-4"><?= $row->code ?></td>
                                        <td class="whitespace-nowrap px-6 py-4"><?= $row->mid ?></td>
                                        <td class="whitespace-nowrap px-6 py-4"><?= $row->last_updated ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col-6 justify-center mt-2">
        <?php require_file('views/_partials/pagination.mini.php') ?>
    </div>
</body>

</html>