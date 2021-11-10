<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     *
     * Set variable
     *
     */

    private $apiToken;

    /**
     *
     * Constructor
     *
     */

    public function __construct()
    {
        // Unique Token
        $this->apiToken = uniqid(base64_encode(substr(bin2hex(random_bytes(60)), 1)));

    }

    /**
     *
     * Client Login
     *
     */

    public function login(Request $request)
    {

        try {
            //code...
            // Validations
            $rules = [
                'login' => 'required',
                'password' => 'required|min:6',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                // Validation failed
                return response()->json([
                    'message' => $validator->messages(),
                ]);

            } else {

                // Fetch User
                $user = Tutorial::where(['email' => $request->login, 'status' => 1])->first();

                //dd('tete');
                if ($user) {
                    // Verify the password
                    if (\Hash::check($request->password, $user->password)) {

                        // Update Token
                        $postArray = ['api_token' => $this->apiToken, 'online_date' => date("Y-m-d H:i:s")];
                        $login = Tutorial::where('email', $request->login)->update($postArray);

                        if ($login) {

                            //array user
                            $user = [
                                'uuid' => $user->uuid,
                                'name' => $user->name,
                                'email' => $user->email,
                                'access_token' => $this->apiToken
                            ];

                            //Return json
                            return response()->json([
                                'status' => true,
                                'message' => "The request has succeeded.",
                                'data' => compact('user'),
                            ], 200);
                        }
                    } else {
                        //Return json
                        return response()->json([
                            'status' => true,
                            'message' => "Senha inválida.",
                            'data' => null,
                        ], 401);
                    }
                } else {
                    //Return json
                    return response()->json([
                        'status' => false,
                        'message' => "Dados de Login ou Senha Iválidos",
                    ], 401);
                }
            }
        } catch (\Throwable $th) {
            Log::info($th);
            dd($th);
        }
    }
}