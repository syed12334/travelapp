<?php
namespace App\Http\Controllers\Backed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Admin\AdminloginService;
class AdminLoginController extends Controller
{
    protected $admin;
    public function __construct(AdminloginService $admin) {
        $this->admin = $admin;
    }
    /* Login page */
    public function index() {
        if( Auth::guard('admin')->check()) {
            return redirect()->route('admindashboard');
        }
        return view('backed.login');
    }
    /* Authentication */
    public function login(Request $request) {
        return $this->admin->getLogin($request->all());
    }
    /* Login admin */
    public function logout() {
        return $this->admin->logout();
    }
}
