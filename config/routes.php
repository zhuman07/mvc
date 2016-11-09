<?php

	return array(
		'blog/([0-9]+)' => 'blog/view/$1',
		'blog/category/([0-9]+)' => 'blog/category/$1',
    'blog' => 'blog/index',



		'product/([0-9]+)' => 'product/view/$1', // actionView в ProductController
		'catalog' => 'catalog/index',            // actionIndex в CatalogtController
		'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory в CatalogController
		'category/([0-9]+)' => 'catalog/category/$1', // actionCategory в CatalogController
		'cart/add/([0-9]+)' => 'cart/add/$1',    // actionAdd в CartController
		'cart/del/([0-9]+)' => 'cart/del/$1',    // actionAdd в CartController
		'cart/delete/([0-9]+)' => 'cart/delete/$1',    // actionAdd в CartController
		'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',    // actionAdd в CartController
		'cart/checkout' => 'cart/checkout',			 // actionCheckout в CartController
		'cart' => 'cart/index',                  // actionIndex в CartController
		'user/registr' => 'user/registr',
		'user/login' => 'user/login',
		'user/logout' => 'user/logout',

		'cabinet/edit' => 'cabinet/edit',
		'cabinet' => 'cabinet/index',
		
		// Управление блогом
		'admin/blog/update/([0-9]+)' => 'adminBlog/update/$1',
    'admin/blog/delete/([0-9]+)' => 'adminBlog/delete/$1',
    'admin/blog/create' => 'adminBlog/create',
    'admin/blog' => 'adminBlog/index',
		// Управление товарами:    
    'admin/product/create' => 'adminProduct/create',
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',
    // Управление категориями:    
    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',
    // Управление заказами:    
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order' => 'adminOrder/index',
    // Админпанель:
    'admin' => 'admin/index',
		
		'contacts' => 'site/contact',

		'' => 'site/index',
		)

?>