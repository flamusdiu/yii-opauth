<?php

class OpauthModule extends CWebModule {

	public $opauthParams = array();
	
	private $_opauth;
	private $_assetsUrl;

	public function init() {
		$this->setImport(array(
			'opauth.vendors.Opauth.Opauth',
		));
		$path = Yii::app()->createUrl($this->id) . '/';
		
		if ($_SERVER['REQUEST_URI'] != $path . 'callback') {
			if (stripos($_SERVER['REQUEST_URI'],'opauth')===false){
				$this->_opauth = new Opauth($this->getConfig(),false);
			} else {
				$this->opauthParams['path'] = $path;
				$this->opauthParams['Callback.uri'] = '{path}callback';
				$this->_opauth = new Opauth($this->getConfig());
			}
		}
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			return true;
		}
		else
			return false;
	}
	
	/**
	 * Returns configuration
	 */
	public function getConfig () {
		return $this->opauthParams;
	}
	
	/**
	 * Returns assets url
	 */
	public function getAssetsUrl() {
        if ($this->_assetsUrl === null) {
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                Yii::getPathOfAlias('application.modules.opauth.assets') 
			);
		}
		return $this->_assetsUrl;
    }
    
    public function getOpauth () {
    	return $this->_opauth;
    }
    
    public function setOpauth (Opauth $opauth) {
    	$this->_opauth = $opauth;
    }
}
