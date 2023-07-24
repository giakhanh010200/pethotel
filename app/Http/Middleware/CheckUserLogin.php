<?php
namespace App\Http\Middleware;
use Closure;
class CheckUserLogin
{
public function handle($request, Closure $next)
{
if ($request->session()->has('user_id')) {
return $next($request);
}
return redirect()->route('users.user_login');
}
}
