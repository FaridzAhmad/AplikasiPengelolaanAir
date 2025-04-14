<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\AdminModel;
use App\Models\PetugasModel;
use App\Models\UserModel;
use App\Models\PengumumanModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */

    protected $admins;
    protected $petugass;
    protected $users;


    protected $data = [];
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        
        $userRole = session('role');

        $roleMapping = [
            2 => 'petugas',
            3 => 'pengguna',
            4 => 'teknisi',
        ];

        $userRoleString = isset($roleMapping[$userRole]) ? $roleMapping[$userRole] : null;

        if ($userRoleString) {
            $pengumumanModel = new PengumumanModel();
            $threeDaysAgo = date('Y-m-d H:i:s', strtotime('-25 days'));

            $this->data['recentAnnouncements'] = $pengumumanModel
                ->groupStart()
                    ->where('target', $userRoleString)  
                    ->orLike('target', $userRoleString . ',')   
                    ->orLike('target', ',' . $userRoleString)  
                    ->orLike('target', ',' . $userRoleString . ',') 
                ->groupEnd()
                ->where('created_at >=', $threeDaysAgo)
                ->countAllResults();

            service('renderer')->setData($this->data);
        }

    }

}
