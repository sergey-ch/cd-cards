<?php
/**
 * @var \App\models\Cd $card;
 */

$id = $card->getId();
?>

<div class="card" style="width: 16rem;">
    <img src="/assets/<?= $card->img ?>" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title"><?= $card->name ?></h5>
        <p class="card-text">Artist: <?= $card->artist ?></p>
        <p class="card-text">Duration: <?= $card->duration ?></p>
        <p class="card-text">Year: <?= $card->year ?></p>
        <p class="card-text">Buy date: <?= $card->getFormattedBuyDate() ?></p>
        <p class="card-text">Price: <?= $card->price ?></p>
        <p class="card-text">Code: <?= $card->code ?></p>
        <a href="/?action=edit&id=<?= $id ?>" class="btn btn-primary" id="edit" data-id="<?= $id ?>"
           data-toggle="modal" data-target="#editModal-<?= $id ?>">Edit</a>
        <a href="/?action=delete&id=<?= $id ?>" class="btn btn-danger" id="delete" data-id="<?= $id ?>">Delete</a>
    </div>

    <div class="modal fade" id="editModal-<?= $id ?>" tabindex="-1" role="dialog"
         aria-labelledby="editModalLabel-<?= $id ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $id ?>">Edit card</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                        $formData = $card;
                        include __DIR__ .'/form.php';
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>