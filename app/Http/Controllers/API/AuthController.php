<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use Validator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Models\User;

use App\Mail\VerifyEmail;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\API\BaseController as BaseController;

use Guzzle\Http\Message\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator as ValidationValidator;
use JsonException;
use PhpParser\Node\Expr\New_;

class AuthController extends BaseController
{



    public $successStatus = 200;

    public function register(Request $request)
    {
         $user = new User();
        $validator = Validator::make($request->all(), [
            //   'role' => 'required',
           

            'first_name' => 'required',
            'last_name' => 'required',
            
            'email' => 'required|email|unique:users',
           

            'password' =>  ['required', 'string', 'min:6', 'confirmed'],

        ]);
         

        if ($validator->fails()) {
            return response(['error' => $validator->errors()]);
        }

        $user = User::create([
         
            'first_name'         => $request->first_name,
            'last_name'         => $request->last_name,
         

         
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->createToken('authToken')->accessToken;
     //   $token = $user->createToken('Token Name')->accessToken;

        return response(['user' => $user,
    ]);
    }


    //////////// login ////////////////////

    public function login(Request $request)
    {
        $data = $request->all([]);

        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|min:6',

        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors()]);
        }

        if (!auth()->attempt($data)) {
            return response(['message' => 'Login credentials are invaild']);
        }
        $user = Auth::user();
      //  $token = $user->createToken('Token Name')->accessToken;
      $token = $user->createToken('Token Name')->plainTextToken;
        // $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response([
            // 'data' => $data,
            'data' => $user,
            'token' => $token
            


         //   'token' => $token



        ]);
    }




    /////////////// forgot password ///////////////

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required', 'string', 'email', 'max:255'
            ],
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
        }

        $verify = User::where('email', $request->email)->exists();




        if ($verify) {
            $verify2 =  DB::table('password_resets')->where([
                ['email', $request->all()['email']]
            ]);

            if ($verify2->exists()) {
                $verify2->delete();
            }

            $token = random_int(100000, 999999);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' =>  $token,
                'created_at' => Carbon::now()
            ]);
            Mail::to($request->email)->send(new ResetPassword($token));

            return new JsonResponse(
                [
                    'success' => true,
                    'message' => "Please check your email for a 6 digit pin"
                ],
                200
            );
        } else {
            return new JsonResponse(
                [
                    'success' => false,
                    'message' => "This email does not exist"
                ],
                400
            );
        }
    }



    //////////////////Reset password//////////////////////

    public function resetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => ['required'],
            'password'         => 'required|min:8|max:30',
            'confirm_password' => 'required|same:password'

        ]);

        $passwordReset =     DB::table('password_resets')
            ->where('token', $request->input('token'))
            ->first();
        if (!$passwordReset) {
            return response()->json(['message' => 'Invalid token'], 404);
        }
        $email = DB::table('password_resets')
            ->where('token', $request->input('token'))
            ->value('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->update(['password' => Hash::make($request->input('password'))]);
        DB::table('password_resets')
            ->where('token', $request->input('token'))
            ->delete();



        return new JsonResponse(
            [
                'success' => true,
                'message' => "Password reset",
            ],
            200
        );;
    }






    ////////////////logout ////////////////////
    public function logout()
    {
        $token = auth()->user()->token();

        /* --------------------------- revoke access token -------------------------- */
        $token->revoke();
        $token->delete();

        /* -------------------------- revoke refresh token -------------------------- */
        $refreshTokenRepository = app(RefreshTokenRepository::class);
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($token->id);

        return response()->json(['message' => 'Logged out successfully']);
    }

    ////// get information about user/////////////
    public function getUser()
    {
        return response()->json(auth()->user());
    }



    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password'        => 'required',
            'new_password'         => 'required|min:8|max:30',
            'confirm_password' => 'required|same:new_password'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'validations fails',
                'errors' => $validator->errors()
            ], 422);
        }
        $user = $request->user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);


            return response()->json([
                'message' => ' password successfully updated',
                'errors' => $validator->errors()
            ], 200);
        } else {
            return response()->json([
                'message' => 'old password does not match',
                'errors' => $validator->errors()
            ], 422);
        }
    }
}
