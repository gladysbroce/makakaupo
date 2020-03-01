<?phpclass System {	private $_base_url = NULL;	private $_assets_url = NULL;	public function __construct() {		/**		 * SET ENV CONFIG		 */        if (IS_LIVE) {            $this->setBaseURL("https://".$_SERVER['SERVER_NAME']."/front");            $this->setAssetsURL("https://".$_SERVER['SERVER_NAME']."/front/assets");        } else {            $this->setBaseURL("https://".$_SERVER['SERVER_NAME']."/is295b/front");            $this->setAssetsURL("https://".$_SERVER['SERVER_NAME']."/is295b/front/assets");           }        $this->meta_title = 'Makakaupo';        $this->meta_desc = 'A Visual Seat Finder for Restaurants';	}	public function setTemplate($template, $masterEnabled = true) {		if (true == $masterEnabled){			ob_start();			include_once( $template );			$this->contents = ob_get_clean();			include_once( 'View/Master.phtml' );		} else {			include_once( $template );		}	}		public function redirect($controller)	{		header('Location: '. $this->getBaseURL() . '/' . $controller);        return false;	}	public function setBaseURL($url) {		$this->_base_url = $url;    }    public function getBaseURL() {    	return $this->_base_url;    }	public function setAssetsURL($url) {		$this->_assets_url = $url;    }    public function getAssetsURL() {    	return $this->_assets_url;    }    public function getControllerURL( $controller = '', $action = ''){    	$app = Application::GetInstance();    	if (!empty($controller) && !empty($action)) {    		$str = $this->_base_url ."/".strtolower($controller).'/'.$action;    	} elseif(!empty($controller)) {    		$str = $this->_base_url ."/".strtolower($controller);    	} else {    		$str = $this->_base_url ."/".strtolower($app->getController()); //.'/'.$app->getAction();    	}    	return $str;    }    public function getRequestURL() {    	$request = htmlspecialchars($_GET['request']);    	$str = $this->_base_url."/".$request;    	return $str;    }    public function getFullURL($controller = false, $action = false) {		$request = '';    	$temp = isset($_GET['request']) ? explode('/', $_GET['request']) : array();    	if ($controller) {    		$temp[0] = strtolower($controller);    		if ( $action ) {    			$temp[1] = strtolower($action);    		} else {    			$temp[1] = '/index';    		}    	}    	$request = implode('/', $temp);		$sort = isset($_GET['sort']) ? htmlspecialchars($_GET['sort']) : '';		$order = isset($_GET['order']) ? htmlspecialchars($_GET['order']) : '';		$str = $this->_base_url."/".$request;//."&sort=".$sort."&order=".$order;		return $str;    }}