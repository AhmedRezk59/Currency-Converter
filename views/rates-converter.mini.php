<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rates Converter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex flex-row justify-around mt-6">
        <div>
            <form action="<?= url('/rates/update') ?>" method="post" class="text-center">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="inline-block rounded bg-red-400 text-white text-bold px-6 py-2">
                    Refresh rates
                </button>
            </form>
        </div>
        <div>
            <a href="<?= url('/latest-conversions') ?>" class="inline-block rounded bg-green-400 text-white text-bold px-6 py-2"> Show Latest Conversions</a>
        </div>
        <div>
            <a href="<?= url('/') ?>" class="button py-2 px-6 bg-violet-400 rounded text-white">Main page</a>
        </div>

    </div>
    <?php if (session('msg') != false) { ?>
        <div style="width:500px;margin:auto;margin-top:50px;" class="bg-green-400 px-6 py-4 text-white">
            <?= session_flash('msg') ?>
        </div>
    <?php } ?>
    <?php if (isset(session('errors')[0])) { ?>
        <div style="width:500px;margin:auto;margin-top:50px;" class="bg-red-300 px-6 py-4 text-white">
            <ul>
                <?php
                foreach (session_flash('errors') as $err) {
                ?>
                    <li><?= $err ?></li>
                <?php
                } ?>
            </ul>
        </div>
    <?php } ?>
    <div style="width:600px;margin:auto;margin-top:50px;">
        <form action="<?= url('/convert') ?>" method="post" id="form">
            <?= csrf_field() ?>
            <div class="flex flex-col">
                <div class=" mb-4 flex flex-row justify-between items-center">
                    <label for="from_amount" class="mx-6">From amount</label>
                    <input type="number" class="relative m-0 block w-[1px] min-w-0 flex-auto rounded rounded-r border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="From amount" name="from_amount" id="from_amount" />
                </div>
                <div class="flex flex-row justify-between items-center mb-4">
                    <label for="from_currency" class="mr-10 ml-6">From currency</label>
                    <select id="from_currency" name="from_currency" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 col-8 w-full">
                        <option selected value="" disabled>Please Select the currency</option>
                        <?php foreach ($currencies as $currency) {
                        ?>
                            <option value="<?= $currency->code ?>"><?= $currency->currency ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="flex flex-row justify-between items-center mb-4">
                    <label for="to_currency" class="ml-6 mr-10 ">To currency</label>
                    <select id="to_currency" name="to_currency" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 col-8 w-full ">
                        <option selected value="" disabled>Please Select the currency</option>
                        <?php foreach ($currencies as $currency) {
                        ?>
                            <option value="<?= $currency->code ?>"><?= $currency->currency ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="text-center">
                    <button class="button bg-violet-500 rounded text-white px-6 py-2" id="button" type="submit">Convert</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>