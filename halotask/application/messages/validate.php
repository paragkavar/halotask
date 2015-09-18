<?php defined('SYSPATH') or die('No direct script access.');

/*
	File Name 		: validate.php
	Type			: Config
	Author		: Samuel Oloan Raja Napitupulu
	Modified		: 22 October 2010
	Description	: contains all errors information.
				  use in form to inform the error description of an inserted data into a form.
*/

return array( 
	'not_empty'    => '<div style= color:red;>:field tidak boleh kosong</div>',
	'matches'      => '<div style= color:red;>:field harus sama dengan :param1</div>',
	'regex'        => '<div style= color:red;>:field tidak sesuai dengan format yang ditentukan</div>',
	'exact_length' => '<div style= color:red;>:field must be exactly :param1 characters long</div>',
	'min_length'   => '<div style= color:red;>:field minimal harus terdiri dari :param1 karakter</div>',
	'max_length'   => '<div style= color:red;>:field harus lebih kecil dari  :param1 karakter</div>',
	'in_array'     => '<div style= color:red;>:field harus merupakan salah satu opsi yang tersedia</div>',
	'digit'        => '<div style= color:red;>:field harus berupa angka</div>',
	'decimal'      => '<div style= color:red;>:field harus bilangan desimal dengan :param1 dibelakang koma</div>',
	'range'        => '<div style= color:red;>:field harus berada pada rentang :param1 sampai :param2</div>',
	'numeric' 	   => '<div style= color:red;>:field harus berupa angka</div>',
	'alpha' 	   => '<div style= color:red;>:field harus karakter</div>',
	'date' 	   => '<div style= color:red;>:field harus format dd/mm/yyyy</div>',
	'not_found' 	   => '<div style= color:red;>:field tidak ditemukan</div>',
	'available' 	   => '<div style= color:red;>:field sudah terdaftar</div>',
	'out' 	   => '<div style= color:red;>arsip untuk :field ini telah dipinjam</div>',
    'username' => '<div style= color:red;>username is already exists</div>',
    'email' => '<div style= color:red;>email is already exists</div>',
    'app_name' => '<div style= color:red;>application name is already exists</div>',
    'menu_name' => '<div style= color:red;>menu name is already exists in this application</div>',
    'role_name' => '<div style= color:red;>role name is already exists</div>',
);