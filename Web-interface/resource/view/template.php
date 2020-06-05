<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="<?= $path['resource'] ?>styleSheet/normalize.css" rel="stylesheet"/>
    <link href="<?= $path['resource'] ?>styleSheet/template.css" rel="stylesheet"/>
    <link href="<?= $path['resource'] ?>styleSheet/<?= $pageFill['pageName'] ?>.css" rel="stylesheet"/>
    
    <title>AppName - <?= htmlspecialchars(ucfirst($pageFill['pageName'])) ?></title>
</head>

<body>
    <section>
        <?= $pageFill['sectionContent'] ?>
    </section>
</body>