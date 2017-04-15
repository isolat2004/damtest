<?php
//role du controller parent c est d envoyer les donnee a la vue en fonction de ce qu il a recu de ou des controllers enfant
class Controller {
  protected function view( string $view, array $data = [] ) {
    require_once ROOT . 'app/views/' . $view . '.php';
  }
}
