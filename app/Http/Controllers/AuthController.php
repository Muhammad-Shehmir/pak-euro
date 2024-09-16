<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Logs;
use App\Models\Passwordreset as ModelsPasswordreset;
use App\Models\User;
use App\Models\UserVerify;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\LogsController;

class AuthController extends Controller
{
    public function login(Request $request, LogsController $logController)
    {
        try {

        if (Auth::check()) {

            return redirect('/dashboard');
        } else {
            $logController->createLog(__METHOD__, 'success', 'Login attempt', auth()->user(), '');

            return view('auth.login')->with('info', 'Login Session Expired!');
        } }catch (\Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->route('login')->with('error', 'An unexpected error occurred.');
        }
    }


    public function create(Request $request)
    {
        try {
            //Validate Inputs
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' =>
                'required',
                'min:5',
                'max:30',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                'cpassword' => 'required',
                'min:5',
                'max:30',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/|same:password',
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = \Hash::make($request->password);
            $save = $user->save();
            $last_id = $user->id;

            $token = $last_id . hash('sha256', \Str::random(120));
            $verifyURL = route('verify', ['token' => $token, 'service' => 'Email_verification']);

            UserVerify::create([
                'user_id' => $last_id,
                'token' => $token,
            ]);

            $message = 'Dear <b>' . $request->name . '</b>';
            $message .= 'Thanks for signing up, we just need you to verify your email address to complete setting up your account.';

            $mail_data = [
                'recipient' => $request->email,
                'fromEmail' => $request->email,
                'fromName' => $request->name,
                'subject' => 'Email Verification',
                'body' => $message,
                'actionLink' => $verifyURL,
            ];

            \Mail::send('auth.email-template', $mail_data, function ($message) use ($mail_data) {
                $message->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'], $mail_data['fromName'])
                    ->subject($mail_data['subject']);
            });

            if ($save) {
                return redirect()->route('login')->with('success', 'Verification Email Sent Successfully!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function verify(Request $request)
    {
        try {
            $token = $request->token;
            $UserVerify = UserVerify::where('token', $token)->first();
            if (!is_null($UserVerify)) {
                $user = $UserVerify->user;

                if (!$user->email_verified) {
                    $UserVerify->user->email_verified = 1;
                    $UserVerify->user->save();

                    return redirect()->route('login')->with('success', 'Your email is verified successfully. You can now login')->with('verifiedEmail', $user->email);
                } else {
                    return redirect()->route('login')->with('info', 'Your email is already verified. You can now login')->with('verifiedEmail', $user->email);
                }
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function check(Request $request)
    {
        try {
            // Validate inputs
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:5|max:30',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->with('error', 'Incorrect Email or Password!');
            }

            $data = $request->all();

            $creds = $request->only('email', 'password');
            $user = User::where('email', $data['email'])->first();

            // Check if user exists and has status 1
            if ($user && $user->status == 1 && Auth::guard('web')->attempt($creds)) {

                // Remember me email or password
                if (isset($data['remember-me']) && !empty($data['remember-me'])) {
                    setcookie("email", $data['email'], time() + 3600);
                    setcookie("password", $data['password'], time() + 3600);
                } else {
                    setcookie("email", "");
                    setcookie("password", "");
                }

                return redirect('/dashboard')->with('success', 'Login Successfully');
            } else {

                return redirect()->route('login')->with('error', 'Incorrect Email or Password or User is inactive!');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function logout(Request $request, LogsController $logController)
    {
        try {
        Auth::guard('web')->logout();
        $logController->createLog(__METHOD__, 'success', 'User logout',  auth()->user(), '');
        return redirect('/')->with('success', 'Logout Successfully!');
    } catch (\Exception $e) {
        $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

        return redirect('/')->with('error', 'An error occurred during logout.');
    }
    }

    public function showForgotForm( LogsController $logController)
    {
        try{
        $logController->createLog(__METHOD__, 'success', 'User logout',  auth()->user(), '');

        return view('auth.forgot');
    }catch (\Exception $e) {
        $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');
        return redirect()->back()->with('error', 'Something Wenr Wrong.');

    }
    }

    public function sendResetLink(Request $request, LogsController $logController)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

            $token = \Str::random(64);
            ModelsPasswordreset::insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);

            $action_link = route('reset.password.form', ['token' => $token, 'email' => $request->email]);
            $body = "We have received a request to reset the password for <b>Patel Dental Clinic </b> account associated with " . $request->email . ". You can reset your password by clicking the link below";

            \Mail::send('auth.email-forgot', ['action_link' => $action_link, 'body' => $body], function ($message) use ($request) {
                $message->from('noreply@example.com', 'Patel Dental Clinic');
                $message->to($request->email, 'Your name')
                    ->subject('Reset Password');
            });
            $logController->createLog(__METHOD__, 'success', 'Email Sent Successully',  auth()->user(), '');

            return back()->with('success', 'Email Sent Successully!');
        } catch (Exception $e) {
        $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function showResetForm( LogsController $logController, Request $request, $token = null)
    {
        try {
            $logController->createLog(__METHOD__, 'success', 'Navigated to Reset Form',  auth()->user(), '');

        return view('auth.reset')->with(['token' => $token, 'email' => $request->email]);
        }catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

                return redirect()->back()->with('error', $e->getMessage());
            }
    }

    public function resetPassword(Request $request,LogsController $logController)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' =>
                'required',
                'min:5',
                'max:30',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/|confirmed',
                'password_confirmation' => 'required',
            ]);

            $check_token = ModelsPasswordreset::where([
                'email' => $request->email,
                'token' => $request->token,
            ])->first();

            if (!$check_token) {
                return back()->withInput()->with('fail', 'Invalid token');
            } else {

                User::where('email', $request->email)->update([
                    'password' => \Hash::make($request->password),
                ]);

                ModelsPasswordreset::where([
                    'email' => $request->email,
                ])->delete();
                $logController->createLog(__METHOD__, 'success', 'Password Changed Successfully',  auth()->user(), '');

                return redirect()->route('login')->with('success', 'Password Changed Successfully!')->with('verifiedEmail', $request->email);
            }
        } catch (Exception $e) {
            $logController->createLog(__METHOD__, 'error', $e, auth()->user(), '');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
