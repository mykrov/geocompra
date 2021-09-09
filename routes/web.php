<?php

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

Route::get('/','HomeController@Index')->name('index');
Route::any('login','AuthController@Login')->name('login');
Route::get('logout','AuthController@Logout')->name('logout');
Route::get('recuperar','AuthController@Resetpass')->name('recuperar');
Route::post('recuperarpass','AuthController@ConsultaRucRecuperacion')->name('recuperarpass');
Route::get('resetear/{id}','AuthController@ResetearProcedimiento')->name('resetear');
Route::post('cambiopass','AuthController@CambioContrasena')->name('cambiopass');
//Route::get('ingresarpass','AuthController@ResetearProcedimiento')->name('ingresarpass');
Route::get('registro','AuthController@Registro')->name('registro');
Route::get('activacion/{ruc}','AuthController@activate')->name('activar');
Route::post('datosempresa','FormsController@EmpresaForm')->name('datosempresa');
Route::get('validaruc/{ruc}','ValidacionRucController@ValidaRuc')->name('validaruc');
Route::get('loginp','AuthController@LoginPrincipal')->name('loginp');
Route::get('documentos','DocumentosController@IndexDocumento')->name('documentos');
Route::post('obtenerfacturas','DocumentosController@ConsultarFacturas')->name('obtenerfacturas');

//Permisos
Route::get('permisosindex','PermisosController@index')->name('permisosindex');


//Productos
Route::get('producto','ProductoController@Index')->name('productoindex');
Route::get('crearproducto','ProductoController@CrearProducto')->name('productocrear');
Route::post('guardarproducto','ProductoController@GuardaProducto')->name('productoguardar');
Route::get('editarproducto/{id}','ProductoController@EditarProducto')->name('productoeditar');
Route::post('updateproducto','ProductoController@UpdateProducto')->name('productoupdate');
Route::post('deleteproducto','ProductoController@DeleteProducto')->name('productodelete');

//Cantones

Route::get('canton','CatonController@Index')->name('cantonindex');
Route::get('crearcanton','CatonController@CrearCanton')->name('cantoncrear');
Route::post('guardarcanton','CatonController@GuardaCanton')->name('cantonguardar');
Route::get('editarcanton/{id}','CatonController@EditarCanton')->name('cantoneditar');
Route::post('updatecanton','CatonController@UpdateCanton')->name('cantonupdate');
Route::post('deletecanton','CatonController@DeleteCanton')->name('cantondelete');

//Usuarios
Route::get('usuario','UsuarioController@Index')->name('usuarioindex');
Route::get('crearusuario','UsuarioController@CrearUsuario')->name('usuariocrear');
Route::post('guardarusuario','UsuarioController@GuardaUsuario')->name('usuarioguardar');
Route::get('editarusuario/{id}','UsuarioController@EditarUsuario')->name('usuarioeditar');
Route::post('updateusuario','UsuarioController@UpdateUsuario')->name('usuarioupdate');
Route::post('deleteusuario','UsuarioController@DeleteUsuario')->name('usuariodelete');



Route::post('authlogin','AuthController@Login')->name('authlogin');
Route::get('createuser','AuthController@Createuser');
