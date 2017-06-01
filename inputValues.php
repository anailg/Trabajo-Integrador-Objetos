<?php

function set_inputValues($input)
{
	$arr_cliente['id']=null;
	$arr_cliente['email']= trim($input['email']);
	$arr_cliente['password'] = $input['password'] ;
	$arr_cliente['nombre'] = trim($input['nombre']) ;
	$arr_cliente['apellido']= trim($input['apellido']) ;
	$arr_cliente['sexo']= trim($input['sexo']) ;
	$arr_cliente['fechanac']=$input['fechanac'];
	$arr_cliente['direccion']= trim($input['direccion']) ;
	$arr_cliente['codPostal']= trim($input['codPostal']) ;
	$arr_cliente['localidad']= trim($input['localidad']) ;
	$arr_cliente['provincia']= trim($input['provincia']) ;
	$arr_cliente['avatar']=$_FILES['avatar']['name'];

	return $arr_cliente;

}

function clear_inputValues()
{
	$arr_cliente['id']='';
	$arr_cliente['email']= '';
	$arr_cliente['password'] = '' ;
	$arr_cliente['nombre'] = '' ;
	$arr_cliente['apellido']= '' ;
	$arr_cliente['sexo']= '' ;
	$arr_cliente['fechanac']='';
	$arr_cliente['direccion']= '' ;
	$arr_cliente['codPostal']= '' ;
	$arr_cliente['localidad']= '' ;
	$arr_cliente['provincia']= '' ;
	$arr_cliente['avatar']='';

	return $arr_cliente;

}

?>





