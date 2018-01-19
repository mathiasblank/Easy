<?php

class EasyExceptions extends Exception
{

	private $msg;

	public function __construct($message, $code = 0, Exception $previous = null) {
		$this->msg = $message;
		if (is_array($message)) {
			$message = $message[0];
		}
		parent::__construct($message, $code, $previous);
	}

	public function missingController() {
        $msg = "Erreur: Auriez-vous oublié de créer le controleur \"{$this->msg}\"?";
        $this->_setMessage($msg);
    }

	public function missingModel() {
        $msg = "Erreur: Auriez-vous oublié de créer le modèle \"{$this->msg}\"?";
        $this->_setMessage($msg);
    }

	public function missingMethod() {
        $msg = "Erreur: Auriez-vous oublié de créer la méthode \"{$this->msg[1]}\" dans le controleur \"{$this->msg[0]}\"?";
        $this->_setMessage($msg);
    }

   	public function missingViewFolder() {
        $msg = "Erreur: Auriez-vous oublié de créer le dossier \"{$this->msg}\" dans le dossier views\"?";
        $this->_setMessage($msg);
    }

   	public function missingView() {
        $msg = "Erreur: Auriez-vous oublié de créer la vue \"{$this->msg[1]}\" dans le dossier \"{$this->msg[0]}\"?";
        $this->_setMessage($msg);
    }

    public function missingLayout() {
        $msg = "Erreur: Auriez-vous oublié de créer le layout \"{$this->msg[1]}\" dans le dossier \"{$this->msg[0]}\"?";
        $this->_setMessage($msg);
    }

    private function _afterMessage() {
    	die();
    }

    private function _setMessage($message, $type = 'error') {
    	echo "<span style=\"color:red\">$message</span>";
    	$this->_afterMessage();

    }

}