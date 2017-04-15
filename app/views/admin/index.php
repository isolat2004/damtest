<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Gestion des projets</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,700,300">
    <link rel="stylesheet" href="/css/style.css">
  </head>
  <body>
    <nav class="navbar navbar-dark bg-success">
      <div class="container">
        <a href="/admin" class="navbar-brand">Steven Sil Administration</a>
        <ul class="nav navbar-nav pull-xs-right">
          <li class="nav-item"><a class="nav-link" href="/"  target="_blank">Aller sur le site</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/deconnexion">D�connexion</a></li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <h1 class="text-xs-center">Projets</h1>
      <div class="row">
        <div class="col-md-6">
          <?php if ( isset( $data['erreur']['title'] ) ) : ?>
            <div class="alert alert-danger"><?= $data['erreur']['title'] ?></div>
          <?php endif; ?>
          <?php if ( isset( $data['erreur']['url'] ) ) : ?>
            <div class="alert alert-danger"><?= $data['erreur']['url'] ?></div>
          <?php endif; ?>
          <?php if ( isset( $data['erreur']['body'] ) ) : ?>
            <div class="alert alert-danger"><?= $data['erreur']['body'] ?></div>
          <?php endif; ?>
          <?php if ( isset( $data['erreur']['picture'] ) ) : ?>
            <div class="alert alert-danger"><?= $data['erreur']['picture'] ?></div>
          <?php endif; ?>
          <form action="/admin" method="post" class="p-y-3 p-x-2" enctype="multipart/form-data" novalidate>
            <input type="text" name="title" class="form-control" placeholder="Nom du projet" value="<?php if ( isset( $_POST['title'] ) ) echo $_POST['title'] ?>">
            <input type="url" name="url" class="form-control" placeholder="Lien vers le projet" value="<?php if ( isset( $_POST['url'] ) ) echo $_POST['url'] ?>">
            <textarea name="body" class="form-control" placeholder="Texte du projet"><?php if ( isset( $_POST['body'] ) ) echo $_POST['body'] ?></textarea>
            <input type="file" name="picture" class="form-control-file">
            <input type="submit" class="btn btn-success" value="Publier">
          </form>
        </div>
        <div class="col-md-6">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Titre</th>
                <th>�diter</th>
                <th>Supprimer</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($data['projects'] as $project) :
              ?>
              <tr>
                <th><?= $project['id'] ?></th>
                <td><?= $project['title'] ?></td>
                <td><a href="/admin/editer/<?= $project['id'] ?>" class="text-success">�diter</a></td>
                <td><a href="/admin/supprimer/<?= $project['id'] ?>" class="text-success">Supprimer</a></td>
              </tr>
              <?php
              endforeach;
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
