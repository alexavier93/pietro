<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BodyController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\FuelController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\TransmissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\VersionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/admin', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin');
Route::post('/admin/do_login', [App\Http\Controllers\Admin\AuthController::class, 'do_login'])->name('admin.do_login');
Route::get('/admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/password', [App\Http\Controllers\Admin\AuthController::class, 'password'])->name('admin.password');

Route::group(['middleware' => 'auth'], function () {

    Route::prefix('admin')->name('admin.')->group(function(){

        Route::prefix('dashboard')->name('dashboard.')->group(function(){
            Route::get('', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('index');
        });

        Route::resources([
            'users'         => UserController::class,
            'banners'       => BannerController::class,
            'brands'        => BrandController::class,
            'models'        => ModelController::class,
            'versions'      => VersionController::class,
            'transmissions' => TransmissionController::class,
            'colors'        => ColorController::class,
            'fuels'         => FuelController::class,
            'bodies'        => BodyController::class,
            'options'       => OptionController::class,
            'vehicles'      => VehicleController::class
        ]);

        // IMOVEIS
        Route::prefix('vehicles')->name('vehicles.')->group(function(){
            Route::get('/{vehicle}/edit', [VehicleController::class, 'edit'])->name('edit');
            Route::put('/update/{vehicle}', [VehicleController::class, 'update'])->name('update');
            Route::post('/delete', [VehicleController::class, 'delete'])->name('delete');

            Route::post('/getModel', [VehicleController::class, 'getModel'])->name('getModel');
            Route::post('/getVersion', [VehicleController::class, 'getVersion'])->name('getVersion');
            
            Route::post('/getGaleria', [VehicleController::class, 'getGaleria'])->name('getGaleria');
            Route::post('/uploadGaleria', [VehicleController::class, 'uploadGaleria'])->name('uploadGaleria');
            Route::post('/deleteImagem', [VehicleController::class, 'deleteImagem'])->name('deleteImagem');
            Route::post('/makeCover', [VehicleController::class, 'makeCover'])->name('makeCover');
            
        });

        
        // BRANDS
        Route::prefix('brands')->name('brands.')->group(function(){
            Route::post('/delete', [BrandController::class, 'delete'])->name('delete');
        });

        // MODELS
        Route::prefix('models')->name('models.')->group(function(){
            Route::post('/delete', [ModelController::class, 'delete'])->name('delete');
        });

        // VERSIONS
        Route::prefix('versions')->name('versions.')->group(function(){
            Route::post('/delete', [VersionController::class, 'delete'])->name('delete');
        });

        // TRANSMISSIONS
        Route::prefix('transmissions')->name('transmissions.')->group(function(){
            Route::post('/delete', [TransmissionController::class, 'delete'])->name('delete');
        });

        // COLORS
        Route::prefix('colors')->name('colors.')->group(function(){
            Route::post('/delete', [ColorController::class, 'delete'])->name('delete');
        });

        // FUELS
        Route::prefix('fuels')->name('fuels.')->group(function(){
            Route::post('/delete', [FuelController::class, 'delete'])->name('delete');
        });

        // BODIES
        Route::prefix('bodies')->name('bodies.')->group(function(){
            Route::post('/delete', [BodyController::class, 'delete'])->name('delete');
        });

        // OPTIONS
        Route::prefix('options')->name('options.')->group(function(){
            Route::post('/delete', [OptionController::class, 'delete'])->name('delete');
        });


        // BANNERS
        Route::prefix('banners')->name('banners.')->group(function(){
            Route::post('/delete', [BannerController::class, 'delete'])->name('delete');
        });

        // USUÁRIOS
        Route::prefix('users')->name('users.')->group(function(){
            Route::post('/delete', [UserController::class, 'delete'])->name('delete');
        });

        // MESSAGES
        Route::prefix('messages')->name('messages.')->group(function(){
            Route::get('', [MessageController::class, 'index'])->name('index');
            Route::get('/{message}', [MessageController::class, 'show'])->name('show');
            Route::post('/delete', [MessageController::class, 'delete'])->name('delete');
        });

    });
    
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('quem-somos')->name('quemsomos.')->group(function(){
    Route::get('/', [App\Http\Controllers\QuemSomosController::class, 'index'])->name('index');
});

Route::prefix('servicos')->name('servicos.')->group(function(){
    Route::get('/', [App\Http\Controllers\ServicoController::class, 'index'])->name('index');
});

Route::prefix('veiculos')->name('veiculos.')->group(function(){
    Route::get('/', [App\Http\Controllers\VeiculoController::class, 'index'])->name('index');
    Route::get('/busca', [App\Http\Controllers\VeiculoController::class, 'busca'])->name('busca');
    Route::get('/anuncio/{marca}/{modelo}/{ano}/{id}', [App\Http\Controllers\VeiculoController::class, 'anuncio'])->name('anuncio');

    Route::post('/getModel', [App\Http\Controllers\VeiculoController::class, 'getModel'])->name('getModel');
});

Route::prefix('contato')->name('contato.')->group(function(){
    Route::get('/', [App\Http\Controllers\ContatoController::class, 'index'])->name('index');
    Route::post('/enviaEmail', [App\Http\Controllers\ContatoController::class, 'enviaEmail'])->name('enviaEmail');
});