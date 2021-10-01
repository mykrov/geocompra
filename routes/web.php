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
Route::post('updatepermiso','PermisosController@EditarPermiso')->name('updatepermiso');
Route::get('buscarpermisos/{iduser}','PermisosController@BuscarPermisos');
Route::get('crearpermisos/{user}/{tipo}','PermisosController@AddPermisoUser');


//Productos
Route::get('producto','ProductoController@Index')->name('productoindex');
Route::get('crearproducto','ProductoController@CrearProducto')->name('productocrear');
Route::post('guardarproducto','ProductoController@GuardaProducto')->name('productoguardar');
Route::get('editarproducto/{id}','ProductoController@EditarProducto')->name('productoeditar');
Route::post('updateproducto','ProductoController@UpdateProducto')->name('productoupdate');
Route::post('deleteproducto','ProductoController@DeleteProducto')->name('productodelete');
Route::get('productslist','ProductoController@getProductos');

Route::get('creaprocompu','ProductoCompuesto@CreaProductoCompuesto')->name('creaprocompu');
Route::post('subproductos','ProductoCompuesto@CrearSubProductos')->name('subproductos');
Route::post('guardaprocompu','ProductoCompuesto@GuardaProductoCompuesto')->name('guardaprocompu');


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

//Bodegas
Route::get('bodega','BodegaController@Index')->name('bodegaindex');
Route::get('crearbodega','BodegaController@CrearBodega')->name('bodegacrear');
Route::post('guardarbodega','BodegaController@GuardaBodega')->name('bodegaguardar');
Route::get('editarbodega/{id}','BodegaController@EditarBodega')->name('bodegaeditar');
Route::post('updatebodega','BodegaController@UpdateBodega')->name('bodegaupdate');
Route::post('deletebodega','BodegaController@DeleteBodega')->name('bodegadelete');

//categorias
Route::get('categoria','CategoriaController@Index')->name('categoriaindex');
Route::get('crearcategoria','CategoriaController@CrearCategoria')->name('categoriacrear');
Route::post('guardarcategoria','CategoriaController@GuardaCategoria')->name('categoriaguardar');
Route::get('editarcategoria/{id}','CategoriaController@EditarCategoria')->name('categoriaeditar');
Route::post('updatecategoria','CategoriaController@UpdateCategoria')->name('categoriaupdate');
Route::post('deletecategoria','CategoriaController@DeleteCategoria')->name('categoriadelete');

//marcas
Route::get('marca','MarcaController@Index')->name('marcaindex');
Route::get('crearmarca','MarcaController@CrearMarca')->name('marcacrear');
Route::post('guardarmarca','MarcaController@GuardaMarca')->name('marcaguardar');
Route::get('editarmarca/{id}','MarcaController@EditarMarca')->name('marcaeditar');
Route::post('updatemarca','MarcaController@UpdateMarca')->name('marcaupdate');
Route::post('deletemarca','MarcaController@DeleteMarca')->name('marcadelete');

//repartidor
Route::get('repartidor','RepartidorController@Index')->name('repartidorindex');
Route::get('crearrepartidor','RepartidorController@CrearRepartidor')->name('repartidorcrear');
Route::post('guardarrepartidor','RepartidorController@GuardaRepartidor')->name('repartidorguardar');
Route::get('editarrepartidor/{id}','RepartidorController@EditarRepartidor')->name('repartidoreditar');
Route::post('updaterepartidor','RepartidorController@UpdateRepartidor')->name('repartidorupdate');
Route::post('deleterepartidor','RepartidorController@DeleteRepartidor')->name('repartidordelete');

//empresas
Route::get('empresa','EmpresaController@Index')->name('empresaindex');
Route::get('crearempresa','EmpresaController@CrearEmpresa')->name('empresacrear');
Route::post('guardarempresa','EmpresaController@GuardaEmpresa')->name('empresaguardar');
Route::get('editarempresa/{id}','EmpresaController@EditarEmpresa')->name('empresaeditar');
Route::post('updateempresa','EmpresaController@UpdateEmpresa')->name('empresaupdate');
Route::post('deleteempresa','EmpresaController@DeleteEmpresa')->name('empresadelete');


//items bodega
Route::get('itembod','ItembodController@Index')->name('itembodindex');
Route::get('crearitembod','ItembodController@CrearItembod')->name('itembodcrear');
Route::post('guardaritembod','ItembodController@GuardaItembod')->name('itembodguardar');
Route::get('editaritembod/{id}','ItembodController@EditarItembod')->name('itembodeditar');
Route::post('updateitembod','ItembodController@UpdateItembod')->name('itembodupdate');
Route::post('deleteitembod','ItembodController@DeleteItembod')->name('itemboddelete');

//compras
Route::get('compra','CompraController@Index')->name('compraindex');
Route::get('crearcompra','CompraController@CrearCompra')->name('compracrear');
Route::post('guardarcompra','CompraController@GuardaCompra')->name('compraguardar');
Route::get('editaritembod/{id}','ItembodController@EditarItembod')->name('itembodeditar');
Route::post('updateitembod','ItembodController@UpdateItembod')->name('itembodupdate');
Route::post('deleteitembod','ItembodController@DeleteItembod')->name('itemboddelete');

//proveedor
Route::get('proveedor','ProveedorController@Index')->name('proveedorindex');
Route::get('crearproveedor','ProveedorController@CrearProveedor')->name('proveedorcrear');
Route::post('guardarproveedor','ProveedorController@GuardaProveedor')->name('proveedorguardar');
Route::get('editarproveedor/{id}','ProveedorController@EditarProveedor')->name('proveedoreditar');
Route::post('updateproveedor','ProveedorController@UpdateProveedor')->name('proveedorupdate');
Route::post('deleteproveedor','ProveedorController@DeleteProveedor')->name('proveedordelete');



//forma de pago
Route::get('creaformapago','FormaPagoController@CrearFormaPago')->name('creaformapago');
Route::post('guardaformapago','FormaPagoController@GuardaFormaPago')->name('guardaformapago');

//NCR
Route::get('ncr','NotaCreditoController@Index')->name('ncrindex');
Route::get('crearncr','NotaCreditoController@CrearNotaCredito')->name('ncrcrear');
Route::get('facturalist','NotaCreditoController@getFacturas')->name('getfacturas');
Route::post('guardancr','NotaCreditoController@GuardaNcr')->name('ncrguardar');


Route::post('authlogin','AuthController@Login')->name('authlogin');
Route::get('createuser','AuthController@Createuser');

