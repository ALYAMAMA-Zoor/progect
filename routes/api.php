<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Auth\ResendVerificationController;
use App\Http\Controllers\Auth\RefreshTokenController;
use App\Http\Controllers\Auth\verifyCodeController;
use App\Http\Controllers\Password\ForgotController;
use App\Http\Controllers\Password\ResetPasswordController;
use App\Http\Controllers\Password\TwoFAController;
use App\Http\Controllers\Podcast\PodcastController;
use App\Http\Controllers\Podcast\getComment;
use App\Http\Controllers\Podcast\likeController;
use App\Http\Controllers\Podcast\addCommentPodcast;
use App\Http\Controllers\Podcast\categoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register',[RegisterController::class,'register']);
Route::post('login',[LoginController::class,'login']);
Route::post('resendVerification',[ResendVerificationController::class,'resendVerification']);
Route::post('verifyCode',[verifyCodeController::class,'verifyCode']);
Route::get('refreshToken',[RefreshTokenController::class,'refreshToken']);
//send email
Route::post('password/reset',[ForgotController::class,'sendResetLinkEmail'])->name('password.reset');
//submit new password
Route::post('password/email',[ResetPasswordController::class,'resetpassword']);


Route::post('two-factor-verify',[TwoFAController::class,'enableTwoFactorAuthentication']);

Route::post('Media/{userId}',[MediaController::class,'Media']);

Route::post('podcast',[PodcastController::class,'store']);
Route::post('podcast/random',[PodcastController::class,'randomPodcast']);
Route::post('sort={sort} category={categoryId} page={page} limit={limit}',[PodcastController::class,'filterPodcast']);

Route::post('comment',[addCommentPodcast::class,'addComment']);
Route::post('getcomment/{id}',[addCommentPodcast::class,'index']);

Route::post('like/{userId}',[likeController::class,'likePodcast']);
Route::post('deletelike/{userId}',[likeController::class,'deletelike']);

Route::get('category',[categoryController::class,'category']);
Route::get('podcast/{podcast_id}/category',[categoryController::class,'category']);
Route::post('category/{id}',[categoryController::class,'cat']);



