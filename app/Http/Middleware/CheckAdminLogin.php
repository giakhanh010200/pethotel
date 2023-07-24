<?php
namespace App\Http\Middleware;
use Closure;
class CheckAdminLogin
{
public function handle($request, Closure $next)
{
if  ($request->session()->has('admin_id')) {
return $next($request);
}
return redirect()->route('admin/admin_login');
}
}
