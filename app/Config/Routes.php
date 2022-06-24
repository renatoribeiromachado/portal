<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

/* Home é o Controller e index,about etc são as paginas e methods no controller*/ 
/* tb chamo as paginas pelo mesmo nome do methods para não ter problema */
/* principal é como sera vista na url, aqui podemos escrever o que quiser*/
/* e la no menu sera add como foi descrita url amigavel exe: nossa-localizacao*/

/*Admin*/

$routes->get('pt-BR/boards/tasks', 'Admin/Home::index');
$routes->get('pt-BR/boards/company/cadastro-empresa', 'Admin/Company::create');
$routes->get('pt-BR/boards/company/listar-empresa', 'Admin/Company::index');
$routes->get('pt-BR/boards/company/editar-empresa/(:num)', 'Admin\Company::edit/$1');
$routes->post('pt-BR/boards/company/pesquisa-empresa', 'Admin/Company::search');
$routes->get('pt-BR/boards/company/exportar-excel', 'Admin/Company::exportar');
$routes->get('pt-BR/boards/company/enviar-email', 'Admin/Company::sendEmail');

/*Projetos*/
$routes->get('pt-BR/boards/project/cadastro-projeto', 'Admin/Project::create');

$routes->get('admin/cadastro-usuario', 'Admin/Usuarios::index');
$routes->get('admin/cadastro-servico', 'Admin/Services::index');
$routes->get('admin/cadastro-cliente', 'Admin/Clientes::index');
$routes->get('admin/cadastro-configuracao', 'Admin/Config::index');
$routes->get('admin/cadastro-banner', 'Admin/Banners::index');
$routes->get('admin/cadastro-estrategia', 'Admin/Estrategia::index');
$routes->get('admin/listar-contatos', 'Admin/Contato::index');
$routes->get('admin/cadastro-blog', 'Admin/Blog::index');
$routes->get('admin/inserir-blog', 'Admin/Blog::create');
$routes->get('admin/editar-blog/(:num)', 'Admin/Blog::create/$1');
$routes->get('admin/inserir-servico', 'Admin/Services::create');
$routes->post('admin/busca-servico', 'Admin/Services::search');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
