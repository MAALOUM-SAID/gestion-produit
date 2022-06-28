<div class="my-container">
       <?php require_once '../website/template/navadmin.php'?>
        <nav>
            <ul>
            <?php foreach ($categories as $categorie):?>
            <li><a href="categorie.php?id=<?= $categorie["id"]?>"><?= $categorie["nom_cat"]?></a></li>
            <?php endforeach ?>
            </ul>
        </nav>
</div>