<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\frontend\GithubService;

class SocialloginController extends Controller
{
    public $github; 
    public function __construct(GithubService $git) {
        $this->github = $git;
    }
    /* Github redirect */
    public function github() {
        return $this->github->redirect();
    }
    /* Github callback */
    public function githubcallback() {
        return $this->github->callback();
    }
}
