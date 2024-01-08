<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class RedirectIfNotApprovedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->isApproved()) {
            Auth::logout();
            return redirect(route('login'))->with( 'message'  ,  'شكراً لتسجيلك ، الحساب قيد التفعيل من قبل الإدارة ، في حال لم يتم تفعيل حسابك خلال 48 ساعة يرجى التواصل على البريد الالكتروني info@tanami.org.sa');
        }
        return $next($request);
    }
}
