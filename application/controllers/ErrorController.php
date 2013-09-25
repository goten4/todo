<?php

class ErrorController extends Zend_Controller_Action
{
    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        
        if (Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER == $errors->type) {
            $httpResponseCode = 404;
        } else {
            $httpResponseCode = $this->getResponse()->getHttpResponseCode();
            if ($httpResponseCode < 400) {
                $httpResponseCode = 500;
            }
            if ($httpResponseCode != 404 && $httpResponseCode != 400) {
				Zend_Registry::get("logger")->err($errors->exception->getMessage());
                $trace = explode(PHP_EOL, $errors->exception->getTraceAsString());
				foreach ($trace as $line) {
				    Zend_Registry::get("logger")->debug($line);
				}
            }
            $this->view->exception = $errors->exception;
        }
        $this->getResponse()->setHttpResponseCode($httpResponseCode);

        switch ($httpResponseCode) {
            case 400:
                $this->view->message = 'Requête invalide';
                break;
            case 404:
                $this->view->message = 'Page non trouvée';
                break;
            case 500:
                $this->view->message = 'Erreur interne';
                break;
            default:
                $this->view->message = Zend_Http_Response::responseCodeAsText($httpResponseCode);
        }
        $this->view->request = $errors->request;
    }
}

