<?php
class DB extends PDO {
  const DSN = 'mysql:host=localhost;dbname=tuto';
  const USER = 'root';
  const PASSWORD = '';

  public function __construct() {
    try {
      parent::__construct( self::DSN, self::USER, self::PASSWORD );
    }
    catch ( PDOException $e ) {
      die( 'Erreur : ' . $e->getMessage() );
    }
  }

  static public function select ( string $query, array $params = [] ) : array {
    $bdd = new DB;

    if ( $params ) {
      $req = $bdd->prepare( $query );
      $req->execute( $params );
    }
    else {
      $req = $bdd->query( $query );
    }

    $data = $req->fetchAll();

    return $data;
  }

  static public function update ( string $query, array $params = [] ) : int {
    $bdd = new DB;

    if ( $params ) {
      $req = $bdd->prepare( $query );
      $req->execute( $params );
    }
    else {
      $req = $bdd->query( $query );
    }

    $updated = $req->rowCount();

    return $updated;
  }

  static public function insert ( string $query, array $params = [] ) : int {
    $bdd = new DB;

    if ( $params ) {
      $req = $bdd->prepare( $query );
      $req->execute( $params );
    }
    else {
      $req = $bdd->query( $query );
    }

    $inserted = $req->rowCount();

    return $inserted;
  }

  static public function delete ( string $query, array $params = [] ) : int {
    $bdd = new DB;

    if ( $params ) {
      $req = $bdd->prepare( $query );
      $req->execute( $params );
    }
    else {
      $req = $bdd->query( $query );
    }

    $deleted = $req->rowCount();

    return $deleted;
  }
}
