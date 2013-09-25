<?php
namespace Todo\Presentation;

class BaseController extends \Zend_Controller_Action
{
    protected function notFound()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->getResponse()->setHttpResponseCode(404);
		throw new \Exception("Page non trouvée");
    }
    
    protected function badRequest()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->getResponse()->setHttpResponseCode(400);
		throw new \Exception("Au moins un paramètre est invalide ou manquant");
    }
    
    protected function notImplemented()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->getResponse()->setHttpResponseCode(501);
        throw new \Exception("Méthode non implémentée");
    }
    
    protected function getParamAsBoolean($paramName, $defaultValue = null)
    {
        if (!$this->hasParam($paramName)) {
            return $defaultValue;
        }
        
        $value = $this->_getParam($paramName);
        return (strcasecmp($value, 'true') == 0 || strcasecmp($value, 'oui') == 0 || $value == 1 ? true : false);
    }
}