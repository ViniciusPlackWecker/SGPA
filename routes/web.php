<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\InstitutionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    
    Route::get('/home', function () {
        return view('home');
    })->middleware(['verified'])->name('home');

    Route::name('profile.')->prefix('profile')->group(callback: function () {
        Route::name('edit'      ) ->get   ('edit'           , [ProfileController::class, 'edit'      ]);
        Route::name('update'    ) ->patch ('update'         , [ProfileController::class, 'update'    ]);
        Route::name('destroy'   ) ->delete('destroy'        , [ProfileController::class, 'destroy'   ]);
        Route::name('updateRole') ->patch ('updateRole/{id}', [ProfileController::class, 'updateRole']);
    });

     Route::name('project.')->prefix('project')->group(callback: function () {
        Route::name('index'       ) ->get   ('index'               , [FileController::class, 'index'       ]);
        Route::name('show'        ) ->get   ('show/{userId}'       , [FileController::class, 'show'        ]);
        Route::name('download'    ) ->get   ('download/{id}'       , [FileController::class, 'download'    ]);
        Route::name('create'      ) ->get   ('create'              , [FileController::class, 'create'      ]);
        Route::name('store'       ) ->post  ('store'               , [FileController::class, 'store'       ]);
        Route::name('advisor'     ) ->get   ('showAdvisor/{userId}', [FileController::class, 'showAdvisor' ]);
        Route::name('statusUpdate') ->patch ('statusUpdate/{id}'   , [FileController::class, 'statusUpdate']);
        Route::name('edit'        ) ->get   ('edit/{id}'           , [FileController::class, 'edit'        ]);
        Route::name('update'      ) ->patch ('update/{id}'         , [FileController::class, 'update'      ]);
        Route::name('destroy'     ) ->get   ('destroy/{id}'        , [FileController::class, 'destroy'     ]);
     });

    Route::name('user.')->prefix('user')->group(callback: function() {
        Route::name('students') ->get ('students', [UserController::class, 'showStudents']);
        Route::name('teachers') ->get ('teachers', [UserController::class, 'showTeachers']);
    });

    Route::name('messages.')->prefix('messages')->group(callback: function() {
        Route::name('index'             ) ->get  ('index'               , [MessageController::class, 'index'             ]);
        Route::name('createWithReceiver') ->get  ('create/{receiver_id}', [MessageController::class, 'createWithReceiver']);
        Route::name('create'            ) ->get  ('create'              , [MessageController::class, 'create'            ]);
        Route::name('show'              ) ->get  ('show/{topic}'        , [MessageController::class, 'show'              ]);
        Route::name('store'             ) ->post ('store'               , [MessageController::class, 'store'             ]);
        Route::name('storeInTopic'      ) ->post ('storeInTopic'        , [MessageController::class, 'storeInTopic'      ]);
    });

    Route::name('tag.')->prefix('tag')->group(callback: function() {
        Route::name('index'  ) ->get   ('index'       , [TagController::class, 'index'  ]);
        Route::name('destroy') ->get   ('destroy/{id}', [TagController::class, 'destroy']);
        Route::name('update' ) ->patch ('update/{id}' , [TagController::class, 'update' ]);
        Route::name('store'  ) ->post  ('index'       , [TagController::class, 'store'  ]);
    });

    Route::name('institution.')->prefix('institution')->group(callback: function() {
        Route::name('index'  ) ->get   ('index'       , [InstitutionController::class, 'index'  ]);
        Route::name('destroy') ->get   ('destroy/{id}', [InstitutionController::class, 'destroy']);
        Route::name('update' ) ->patch ('update/{id}' , [InstitutionController::class, 'update' ]);
        Route::name('store'  ) ->post  ('index'       , [InstitutionController::class, 'store'  ]);
    });
});

require __DIR__.'/auth.php';
