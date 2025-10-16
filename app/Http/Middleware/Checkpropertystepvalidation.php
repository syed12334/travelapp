<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Checkpropertystepvalidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
      public function handle(Request $request, Closure $next, string $requiredStep): Response
    {
        $session = $request->session();
        // If requiredStep is step1, always allow access
        if ($requiredStep === 'step1') {
            return $next($request);
        }
        // For step2, check if step1 data exists
        if ($requiredStep === 'step2' && !$session->has('step1')) {
            return redirect()->route('steponeview');
        }
        // For step3, check if step2 data exists
        if ($requiredStep === 'step3' && !$session->has('step2')) {
            return redirect()->route('steptwoview');
        }
           // For step4, check if step3 data exists
        if ($requiredStep === 'step4' && !$session->has('step3')) {
            return redirect()->route('stepthreeview');
        }
            // For step5, check if step4 data exists
        if ($requiredStep === 'step5' && !$session->has('step4')) {
            return redirect()->route('stepfourview');
        }
             // For step6, check if step5 data exists
        if ($requiredStep === 'step6' && !$session->has('step5')) {
            return redirect()->route('stepfiveview');
        }
             // For step7, check if step6 data exists
        if ($requiredStep === 'step7' && !$session->has('step5')) {
            return redirect()->route('stepsixview');
        }
        return $next($request);
    }   
}
