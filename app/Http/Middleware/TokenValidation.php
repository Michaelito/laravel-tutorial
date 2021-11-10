<?php


namespace App\Http\Middleware;

use Closure;

class TokenValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $restriction = null)
    {

        //Get header Authorization
        $headerToken = $request->header('Authorization');

        //Check the header 'authorization' exists
        if ($headerToken) {

            //Internal developer access
            if ($restriction == 'developer') {
                $token = ["c6ef55f3cb89c4f16a6a41836a89667d"];
            }

            //Check if token is valid
            if (in_array($headerToken, $token)) {
                return $next($request);
            }
        }

         //Return error
        return response()->json([
            'status' => false,
            'message' => 'Não foi informado o token de acesso.'
        ], 401);
    }

}


?>
