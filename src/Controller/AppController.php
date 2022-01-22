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
 * @link https://book.cakephp.org/3/en/controllers.html#the-app-controller
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

        $this->loadComponent('Paginator');
        //check prefix
        
        // $loginAction = array();
        // $authenticateForm = array();
        // $logoutRedirect = array();
        // dd('seller' == $this->request->params['prefix']);\

        $controller = 'Customers';
        $layout = 'default';
        if(isset($this->request->params['prefix']) && 'admin' == $this->request->params['prefix'])
        {
            $controller = 'Admins';
            $layout = 'default';
            if($this->request->session()->read('Auth.Admins'))
            {
                $layout = 'admin';
            }
        }
        // elseif(isset($this->request->params['prefix']) && 'seller' == $this->request->params['prefix']){
        //     $controller = 'Sellers';
        //     $layout = 'default';
        //     if($this->request->session()->read('Auth.Sellers')){
        //         $layout = 'default';
        //     }
        // }
         else 
         {
            $layout = 'default';
            if($this->request->session()->read('Auth.Customers'))
            {
                $layout = 'default';
            }
        }
        // dd($this->request->params['prefix'],$controller,$layout);
        $this->loadComponent('Auth', [
            'loginAction' => ['controller' => $controller, 'action' => 'login'],
            'authError' => 'Did you really think you are allowed to see that?',
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email', 'password' => 'password'], 
                    'userModel' => $controller,
                    //'scope' => [$controller.'.status' => 'active']
                ]
            ],
            'logoutRedirect' => ['controller' => $controller, 'action' => 'logout'],
            'storage' => ['className' => 'Session', 'key' => 'Auth.'.$controller]
        ]);
        $this->loadComponent('Flash');

        $this->viewBuilder()->setLayout($layout);
        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    public function getCurrencyFormated($amount)
    {
        return '₹'.number_format((float)$amount, 2, '.', '');
    }
}
