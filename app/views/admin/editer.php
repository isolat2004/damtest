<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>�dition des projets</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,700,300">
    <link rel="stylesheet" href="/css/style.css">
  </head>
  <body>
    <nav class="navbar navbar-dark bg-success">
      <div class="container">
        <a href="/admin" class="navbar-brand">Steven Sil Administration</a>
        <ul class="nav navbar-nav pull-xs-right">
          <li class="nav-item"><a class="nav-link" href="/" target="_blank">Aller sur le site</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/deconnexion">D�connexion</a></li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <h1 class="text-xs-center">Projets</h1>
      <?php if ( isset( $data['erreur']['title'] ) ) : ?>
        <div class="alert alert-danger"><?= $data['erreur']['title'] ?></div>
      <?php endif; ?>
      <?php if ( isset( $data['erreur']['body'] ) ) : ?>
        <div class="alert alert-danger"><?= $data['erreur']['body'] ?></div>
      <?php endif; ?>
      <form action="" method="post" class="p-y-3 p-x-2" enctype="multipart/form-data" novalidate>
        <input type="text" name="title" class="form-control" placeholder="Nom du projet" value="<?= $data['project']['title'] ?>">
        <textarea name="body" class="form-control" placeholder="Texte du projet"><?= $data['project']['body'] ?></textarea>
        <input type="submit" class="btn btn-success" value="�diter">
      </form>
    </div>
  </body>
</html>
