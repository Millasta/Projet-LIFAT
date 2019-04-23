<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        //charge le composant flash de cake php
        $this->loadComponent('Flash');

        //charge le composant d'authentification de cakephp
        $this->loadComponent('Auth', [
			'authorize' => 'Controller',
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email','password' => 'passwd'],
                    'userModel' => 'Membres'
                ]
            ],
            'loginAction' => [
                'controller' => 'Membres',
                'action' => 'login'
            ],
            // Si pas autorisé, on renvoit sur la page précédente
            'unauthorizedRedirect' => $this->referer()
        ]);

        //	la page de garde est accessible publiquement (mais que cette page)
		$this->Auth->allow(array('controller' => 'pages', 'action' => 'display'));
        //	cf. fonctions "isAuthorized" pour les autres permissions

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

	/**
	 * Before filter : makes some user data accessible in the views
	 * (example : $user['nom'])
	 * @param Event $event
	 * @return \Cake\Http\Response|null
	 */
    public function beforeFilter(Event $event)
	{
		$session = $this->request->getSession();
		$user = $session->read('Auth.User');
		$this->set('user', $user);
		return parent::beforeFilter($event);
	}

	public function isAuthorized($user)
	{
		//	Par défaut : l'admin a tous les droits, mais les autres utilisateurs n'ont rien
		//	Il faudra, pour les utilisateurs authentifiés (chefs d'équipe, membres permanents, autres utilisateurs...) remettre les droits manuellement dans le controlleur

		if (isset($user['role']) && $user['role'] === 'admin') {
			return true;
		}

		return false;
	}
}
