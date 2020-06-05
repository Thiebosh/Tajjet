<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="view/styleSheets/normalize.css" rel="stylesheet"/>
    
    <link href="view/styleSheets/template.css" rel="stylesheet"/>
    <link href="view/styleSheets/section.css" rel="stylesheet"/>
    <title>Dream little dreamer - <?= htmlspecialchars(ucfirst($variablePage['page'])) ?></title>
</head>

<body>
    <section>
        <?= $pageFill['sectionContent'] ?>
    </section>
</body>