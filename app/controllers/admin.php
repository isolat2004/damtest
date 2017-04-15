<?php
class Admin extends Controller {
	//etape2
  public function index() {
    if ( !isset( $_SESSION['id'] ) ) {
      header( 'Location: /admin/connexion' );
    }

   ////// 
	 $projects = DB::select( 'select * from project order by id desc' );

    if ( !empty( $_POST ) ) {
      extract( $_POST );
      $erreur = [];

      if ( empty( $title ) ) {
        $erreur['title'] = 'Titre obligatoire ajout++++++';
      }

     // if ( empty( $url ) ) {
       // $erreur['url'] = 'Lien obligatoire';
      //}/
      //elseif ( !filter_var( $url, FILTER_VALIDATE_URL ) ) {
       // $erreur['url'] = 'Lien erroné';
     // }

      if ( empty( $body ) ) {
        $erreur['body'] = 'Texte obligatoire';
      }

      if ( isset( $_FILES['picture'] ) && $_FILES['picture']['error'] == 0 ) {
        if ( !in_array( $_FILES['picture']['type'], ['image/jpeg', 'image/png'] ) ) {
          $erreur['picture'] = 'Format incorrect (PNG et JPEG acceptés)';
        }
        elseif ( $_FILES['picture']['size'] > 102400 ) {
          $erreur['picture'] = 'Image trop volumineuse (supérieure à 100Ko)';
        }
      }
      else {
        $erreur['picture'] = 'Image obligatoire';
      }

      if ( !$erreur ) {
        $extension = str_replace( 'image/', '', $_FILES['picture']['type'] );
        $name = bin2hex( random_bytes( 8 ) ) . '.' . $extension;

        if ( move_uploaded_file( $_FILES['picture']['tmp_name'], ROOT . 'public/img/' . $name ) ) {
          DB::insert( 'insert into project (title, url, body, picture) values (:title, :url, :body, :picture)', [
            'title' => htmlspecialchars( $title ),
            'url' => htmlspecialchars( $url ),
            'body' => htmlspecialchars( $body ),
            'picture' => $name
          ] );

          header( 'Location: /admin' );
        }
        else {
          $erreur['picture'] = 'Erreur lors de l\'envoi du fichier';
        }
      }

      $this->view( 'admin/index', ['erreur' => $erreur, 'projects' => $projects] );
    }

    $this->view( 'admin/index', ['projects' => $projects] );
	
		
  }  //fin fonction index
  
  
  public function editer( int $id ) {
    if ( !isset( $_SESSION['id'] ) ) {
      header( 'Location: /admin/connexion' );
    }

    $project = DB::select( 'select * from project where id = ?', [$id] );

    if ( !$project ) {
      header( 'Location: /admin' );
    }

    if ( !empty( $_POST ) ) {
      extract( $_POST );
      $erreur = [];

      if ( empty( $title ) ) {
        $erreur['title'] = 'Titre obligatoire';
      }

      if ( empty( $body ) ) {
        $erreur['body'] = 'Texte obligatoire';
      }

      if ( !$erreur ) {
        DB::update( 'update project set title = :title, body = :body where id = :id', [
          'title' => htmlspecialchars( $title ),
          'body' => htmlspecialchars( $body ),
          'id' => $id
        ] );

        header( 'Location: /admin/editer/' . $id );
      }
      else {
        $this->view( 'admin/editer', ['erreur' => $erreur, 'project' => $project[0]] );
      }
    }

    $this->view( 'admin/editer', ['project' => $project[0]] );
  }/////
	
	
   public function supprimer( int $id ) {
    if ( !isset( $_SESSION['id'] ) ) {
      header( 'Location: /admin/connexion' );
    }

    $project = DB::select( 'select picture from project where id = ?', [$id] );

    unlink( ROOT . 'public/img/' . $project[0]['picture'] );

    DB::delete( 'delete from project where id = ?', [$id]);

    header( 'Location: /admin' );
  }////	
  
   public function deconnexion() {
    if ( !isset( $_SESSION['id'] ) ) {
      header( 'Location: /admin/connexion' );
    }

    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]
      );
    }

    session_destroy();

    header( 'Location: /admin/connexion' );
  }//
  
  
  
  //etape1 
  public function connexion() {
    if ( isset( $_SESSION['id'] ) ) {
      header( 'Location: /admin' );
    }
      //etape 3je connecte l admin
    if ( !empty( $_POST ) ) {
      extract( $_POST );
     //etape 5 on appelle la fc pour cree une session 
      $admin = $this->accountExists();
       //etape 6
      if ( $admin ) {
        $_SESSION['id'] = $admin['id'];

        header( 'Location: /admin' );
      }
      else {
        $erreur = 'Identifiants erronés';
      }
        //etape 7 on affiche le form.etle message d erreure  
      $this->view( 'admin/connexion', ['erreur' => $erreur] );
    }

    $this->view( 'admin/connexion' );
  } //fin de la fonction connection
  
  //fonction accountExists pour verifier si l admin existe dans la BD.s il existe on cree une session et on le connecte
  private function accountExists() : array {
    $admin = DB::select( 'select id, password from admin where login = ?', [$_POST['login']] );

    if ( $admin && password_verify( $_POST['password'], $admin[0]['password'] ) ) {
      return $admin[0];
    }
    else {
      return [];
    }
  }
  
 
 
}
