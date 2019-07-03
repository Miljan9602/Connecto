<?php

namespace App\Http\Middleware;

use Closure;

class ValidateSignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $signature = $request->header('Security-Token');

        $currentTime = time();
        $url = strtok($request->fullUrl(), '?');
        $content = json_encode($request->all(), JSON_UNESCAPED_SLASHES);

        $key = env('SIGNATURE_KEY');

        // Request can be made +- 2 minutes from current time.
        for ($time = $currentTime-120; $time<$currentTime+120; $time++) {

            $hash = hash('sha256', base64_encode($url.$key.$content.$time));

            if (strcmp($hash, $signature) === 0) {
                return $next($request);
            }
        }

        return response()->json(['status'=>'fail', 'message' => 'The request is not valid.',
            'error_type' => 'bad_request'], 400);
    }
}
