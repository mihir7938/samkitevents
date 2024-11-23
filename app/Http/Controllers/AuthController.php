<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\AuthenticateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthenticateService $authService) {
        $this->authService = $authService;
    }
    public function getLogin(Request $request)
    {
        if (!Auth::check()) {
            return view('auth.login');
        }
        if (Auth::check() && Auth::user()->role_id == Role::USER_ROLE_ID) {
            $url = url('/users/profile');
        } elseif (Auth::check() && Auth::user()->role_id == Role::ADMIN_ROLE_ID) {
            $url = url('/admin/dashboard');
        }
        return redirect($url);
    }

    /**
     * Loigin user.
     *
     * @param  LoginRequest
     *
     * @return redirect
     */
    public function login(LoginRequest $request)
    {
        try {
            $input = [
                'email' => $request->email,
                'password' => $request->password,
                'status' => true,
            ];
            $is_auth = Auth::attempt($input, $request->has('remember_me') ? true : false);
            if ($is_auth) {
                $user = User::find(Auth::user()->id);
                if ($request->ajax()) {
                    return response()->json(['status' => true]);
                } else {
                    if ($user->role_id == Role::ADMIN_ROLE_ID) {
                        $url = url('/admin/dashboard');
                    } elseif ($user->role_id == Role::USER_ROLE_ID) {
                        $url = url('/users/profile');
                    }
                }
                return redirect($url);
            } else {
                throw new \Exception('Invalid email or password, please try again.');
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => $e->getMessage()]);
            } else {
                $request->session()->put('message', $e->getMessage());
                $request->session()->put('alert-type', 'alert-danger');
                return redirect('/');
            }
        }
    }

    public function logout(Request $request)
    {
        $user = User::find(Auth::user()->id);
        Auth::logout();
        $request->session()->flush();
        $request->session()->put('message', 'Logged out successfully!');
        $request->session()->put('alert-type', 'alert-success');
        return redirect()->route('login');
    }

    public function forgetPassword(Request $request)
    {
        return view('auth.forget-password');
    }

    /**
     * Loads forgot password view.
     *
     * @param  NULL
     *
     * @return redirect to forgot password view
     */
    public function resetPassword(ForgotPasswordRequest $request)
    {
        try {
            $email = $request->email;
            $this->authService->sendResetPasswordEmail($email);
            $request->session()->put('message', 'A link to reset your password has been sent to your email.');
            $request->session()->put('alert-type', 'alert-success');
            return redirect()->route('forget_password');
        } catch (\Exception $e) {
            $request->session()->put('message', $e->getMessage());
            $request->session()->put('alert-type', 'alert-danger');

            return redirect()->route('forget_password');
        }
    }

    /**
     * Page for resetting password.
     *
     * @param type $token
     *
     * @return type view
     */
    public function getChangePassword(Request $request, $token)
    {
        $user = $this->authService->getUserByToken($token);
        if ($user) {
            return view('auth.new-password', ['user' => $user]);
        } else {
            $request->session()->put('message', 'Incorrect password reset link. Please try again.');
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('forget_password');
        }
    }

    /**
     * Process change password.
     *
     * @param type $token
     */
    public function postChangePassword(ResetPasswordRequest $request, $token)
    {
        $user = $this->authService->getUserByToken($token);
        if ($user) {
            $user->remember_token = '';
            $this->authService->changeUserPassword($user, $request->password);
            $request->session()->put('message', 'You have successfully changed your password. Please log in with new password.');
            $request->session()->put('alert-type', 'alert-success');
            return redirect()->route('login');
        } else {
            $request->session()->put('message', 'Incorrect password reset link. Please try again.');
            $request->session()->put('alert-type', 'alert-warning');
            return redirect()->route('forget_password');
        }
    }
}
