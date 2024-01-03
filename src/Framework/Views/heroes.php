<?php
include $this->resolvePath("partials/_header.php");
?>

<html>

<body>
    <div>
        <?php foreach ($heroes as $hero) : ?>
            <pre>
                <strong>
                    <?php echo "#{$hero->id} | $hero->name" ?>
                </strong>
            </pre>
            <pre>
                <div>
                    <?php echo $hero->description ?>
                </div>
            </pre>
            <?php $pathImage = "{$hero->thumbnail->path}.{$hero->thumbnail->extension}"; ?>
            <img src=<?php echo $pathImage?> alt={<?php echo $hero->name?>} height="200px">
        <?php endforeach; ?>
    </div>
</body>

</html>
