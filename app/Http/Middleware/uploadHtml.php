<?php

namespace App\Http\Middleware;

use Closure;

class uploadHtml
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

        if (!($request->exists('type'))&&($request->exists('content')))
            return redirect('response/fail');

        $type = $request->input('type');
        if (!preg_match('/^((report)|(repairSkill)|(share))$/',$type))
            return redirect('response/fail');


        //视情况也要对content做参数过滤，这里留个空吧

        return $next($request);
    }
}
