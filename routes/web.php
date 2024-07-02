<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    
    Route::get('/home', function () {
        return view('home');
    })->middleware(['verified'])->name('home');

    Route::name('profile.')->prefix('profile')->group(callback: function () {
        Route::name('edit'   ) ->get   ('edit'    , [ProfileController::class, 'edit'   ]);
        Route::name('update' ) ->patch ('update'  , [ProfileController::class, 'update' ]);
        Route::name('destroy') ->delete('destroy' , [ProfileController::class, 'destroy']);
    });

    //  Route::name('project.')->prefix('project')->group(callback: function () {
    //     Route::name('index' ) ->get  ('index' ,   [ProjectController::class, 'index' ]);
    //     Route::name('create') ->get  ('create',   [ProjectController::class, 'create']);
    //     Route::name('store' ) ->post ('store' ,   [ProjectController::class, 'store' ]);
    //     Route::name('show'  ) ->get  ('show'  ,   [ProjectController::class, 'show'  ]);
    //     Route::name('edit'  ) ->get  ('edit'  ,   [ProjectController::class, 'edit'  ]);
    //     Route::name('update') ->patch('update',   [ProjectController::class, 'update']);
    //     Route::name('delete') ->get  ('delete',   [ProjectController::class, 'delete']);
    //  });

    Route::name('user.')->prefix('user')->group(callback: function() {
        Route::name('students') ->get ('students', [UserController::class, 'showStudents']);
        Route::name('teachers') ->get ('teachers', [UserController::class, 'showTeachers']);
    });

    Route::name('messages.')->prefix('messages')->group(callback: function() {
        Route::name('index'             ) ->get ('index'                , [MessageController::class, 'index'             ]);
        Route::name('createWithReceiver') ->get ('create/{receiver_id}' , [MessageController::class, 'createWithReceiver']);
        Route::name('create'            ) ->get ('create'               , [MessageController::class, 'create'            ]);
        Route::name('show'              ) ->get ('show/{topic}'         , [MessageController::class, 'show'              ]);
        Route::name('store'             ) ->post('store'                , [MessageController::class, 'store'             ]);
        Route::name('storeInTopic'      ) ->post('storeInTopic'         , [MessageController::class, 'storeInTopic'      ]);
    });
});

require __DIR__.'/auth.php';
