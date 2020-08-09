<?php

namespace App\Http\Controllers;

use Validator, DB, Hash, Mail;
use Auth;
use JWTAuth;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Illuminate\Support\Str;

use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    //

    /**
     * API Register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){
        $credentials = $request->only('name','email','password');
        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users'
        ];

        $messages = [
            'email.unique' => 'El usuario con el correo que intenta registrar ya existe'
        ];


        $validator = Validator::make($credentials, $rules, $messages);

        if($validator->fails()){
            //return response()->json(['success'=>false, 'error'=> $validator->message()]);
            return response()->json(['success'=>false, 'error'=> $validator]);
        }

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $user = User::create(['name'=> $name,
                              'email' => $email,
                              'password' => Hash::make($password)]);

        //Generate verification code for new user
        $verification_code = Str::random(30); 

        //Create record for verification user
        DB::table('user_verifications')->insert(['user_id'=>$user->id,
                                                 'token'=>$verification_code]);

        // Get names         
        $names = explode(' ', $name);
        $firstName = $names[0];
        $surname = ' ';
        
        //Just if have two names, store surname
        if (count($names) > 1)            
            $surname = $names[1];       


        // create new person
        DB::insert('insert into personas(Nombre, Apellidos, Correo_Electronico, Estado, tipoPersona)
                    values(?,?,?,?,?)',
                    [$firstName, $surname, $email, 'ACTIVO', 'OM']);

       
        $subject = "Por favor valide su dirección de correo.";
        Mail::send('emails.verify', ['name' => $name, 'verification_code' => $verification_code],
        function($mail) use ($email, $name, $subject){
            $mail->from(getenv('MAIL_USERNAME'), "Rental Maquinaria y Equipo");
            $mail->to($email, $name);
            $mail->subject($subject);
        });                      
        
        return response()->json(['success'=> true, 
                                 'message'=> 'Thanks for signing up! Please check your email to complete your registration.']);

    }


    /* API Verify User
    *
    * @param Request $request
    * @return \Illuminate\Http\JsonResponse
    */
   public function verifyUser($verification_code)
   {
       $check = DB::table('user_verifications')->where('token',$verification_code)->first();

       if(!is_null($check)){
           $user = User::find($check->user_id);

           if($user->is_verified == 1){
               return response()->json([
                   'success'=> true,
                   'message'=> 'Account already verified..'
               ]);
           }

           $user->update(['is_verified' => 1]);
           DB::table('user_verifications')->where('token',$verification_code)->delete();

           return response()->json([
               'success'=> true,
               'message'=> 'You have successfully verified your email address.'
           ]);
       }

       return response()->json(['success'=> false, 'error'=> "Verification code is invalid."]);

   }

   /* API Login, on success return JWT Auth token
   *
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function login(Request $request)
  {
      $credentials = $request->only('email', 'password');      
      $rules = [
          //'email' => 'required|email|exists:App\User,email',
          'email' => 'required|email',
          'password' => 'required'
      ];                  
      $validator = Validator::make($credentials, $rules);

      if($validator->fails()) {      
          return response()->json(['success' => false, 
                                   'error' => $validator->messages()],401);          
      }
      
      $credentials['is_verified'] = 1;
      
      try {
          // attempt to verify the credentials and create a token for the user          
        if (! $token = $this->guard()->attempt($credentials)) {        
              return response()->json(['success' => false, 
                                       'error' => 'We cant find an account with this credentials. Please make sure you entered the right information and you have verified your email address.'],
                                       404);
        }
      } catch (JWTException $e) {
          // something went wrong whilst attempting to encode the token
          return response()->json(['success' => false, 'error' => 'Failed to login, please try again.'], 500);
      }

        return response()->json(['status' => 'success'], 200)
                         ->header('Authorization', $token);
  }
  
  
   /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request) 
    {
        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);

    }

    public function user(Request $request){
        $user = User::find(Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

        /**
     * Refresh JWT token
     */
    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    /**
     * Return auth guard    
     */
    private function guard(){
        return Auth::guard();
    }


}
