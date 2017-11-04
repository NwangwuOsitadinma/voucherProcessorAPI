<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use($router){
    $router->get('/office_entity_types', function (){
       $ent = \App\Models\OfficeEntityType::all();
       return $ent;
    });
    $router->post('/office_entity_type/create', function (\Illuminate\Http\Request $request){
        if($c = \App\Models\OfficeEntityType::create([
            'name' => $request->name
        ])){
            return response()->json(['message' => 'you just created an entity type', $c]);
        }
    });
});


