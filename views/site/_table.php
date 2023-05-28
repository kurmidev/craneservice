
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> <?= $title ?></h3>
        </div>
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <?php foreach ($header as $head) { ?>
                            <th><?= $head ?> </th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($response as $resp) { ?>
                        <tr>
                            <?php foreach ($resp as $r) { ?>
                                <td><?= $r ?></td>
                            <?php  } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>