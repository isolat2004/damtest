<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Steven Sil</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,700,300">
    <link rel="stylesheet" href="/css/style.css">
  </head>
  <body>
    <nav class="navbar navbar-dark bg-success">
      <div class="container">
        <a href="" class="navbar-brand">Franck dbsff ++++ en modiffffff</a>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <?php
        foreach( $data['projects'] as $key => $project ) :
        ?>
        <div class="col-md-6">
          <article>
            <h1 class="h3"><?= $project['title'] ?> <span class="text-muted lead"> <time><?= $project['created_at'] ?></time></span></h1>
            <a href="<?= $project['url'] ?>" target="_blank">
              <img class="img-fluid" src="/img/<?= $project['picture'] ?>" alt="<?= $project['picture'] ?>">
            </a>
            <p class="lead text-justify"><?= $project['body'] ?></p>
          </article>
        </div>
        <?php
        if( $key % 2 == 1 ) {
          echo '<div class="hidden-sm-down clearfix"></div>';
        }
        endforeach;
        ?>
      </div>
    </div>
  </body>
</html>
