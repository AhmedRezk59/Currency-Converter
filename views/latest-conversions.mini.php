<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest conversions</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex flex-row justify-around" style="width:60%;margin:auto;padding-top:30px">
        <a href="<?= url('/') ?>" class="button py-2 px-6 bg-green-400 rounded text-white">Main page</a>
        <a href="<?= url('/rates-converter') ?>" class="button py-2 px-6 bg-blue-400 rounded text-white">Converter page</a>
    </div>
    <div class="flex flex-col" style="width:80%;margin:auto;padding-top:30px">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-center text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                            <tr>
                                <th scope="col" class="px-6 py-4">#</th>
                                <th scope="col" class="px-6 py-4">From currency</th>
                                <th scope="col" class="px-6 py-4">From rate</th>
                                <th scope="col" class="px-6 py-4">From amount</th>
                                <th scope="col" class="px-6 py-4">To Currency</th>
                                <th scope="col" class="px-6 py-4">To rate</th>
                                <th scope="col" class="px-6 py-4">To amount</th>
                                <th scope="col" class="px-6 py-4">Converted at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($latest_conversions as $index => $row) {
                            ?>
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                                        <?= $index + 1 ?>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4"><?= $row->from_currency ?></td>
                                    <td class="whitespace-nowrap px-6 py-4"><?= $row->from_rate ?></td>
                                    <td class="whitespace-nowrap px-6 py-4"><?= $row->from_amount ?></td>
                                    <td class="whitespace-nowrap px-6 py-4"><?= $row->to_currency ?></td>
                                    <td class="whitespace-nowrap px-6 py-4"><?= $row->to_rate ?></td>
                                    <td class="whitespace-nowrap px-6 py-4"><?= $row->to_amount ?></td>
                                    <td class="whitespace-nowrap px-6 py-4"><?= $row->converted_at ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="flex flex-col-6 justify-center mt-10">
                        <?php require_file('views/_partials/pagination.mini.php') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>