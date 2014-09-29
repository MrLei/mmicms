<?php

/**
 * Mmi
 *
 * LICENSE
 *
 * Ten plik źródłowy objęty jest licencją BSD bez klauzuli ogłoszeniowej.
 * Licencja jest dostępna pod adresem: http://milejko.com/new-bsd.txt
 * W przypadku problemów, prosimy o kontakt na adres mariusz@milejko.pl
 *
 * Mmi/Json/Rpc/Server.php
 * @category   Mmi
 * @package    Mmi_Json_Rpc_Server
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Serwer JSON-RPC w standardzie 2.0
 * @category   Mmi
 * @package    Mmi_Json_Rpc_Server
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Json_Rpc_Server_Reflection {
	
	protected $_reflectionClass;

	public function __construct($className) {
		$class = new $className();
		$this->_reflectionClass = new ReflectionClass($className);
		
	}
	
	public function getMethodList() {
		$methods = array();
		foreach ($this->_reflectionClass->getMethods(ReflectionMethod::IS_PUBLIC) as $methodRow) {
			if (!preg_match('/^(get|put|post|delete)/', substr($methodRow->name, 0, 6), $httpMethod)) {
				continue;
			}
			$methodReflection = new ReflectionMethod($methodRow->class, $methodRow->name);
			$comment = $methodReflection->getDocComment();
			$params = array();
			foreach ($methodReflection->getParameters() as $param) {
				if (preg_match('/\@param\s([a-zA-Z]+)\s\$' . $param->name . '/', $comment, $type)) {
					$params[$param->name] = $type[1];
					if ($type[1] == 'array') {
						if (preg_match('/\@see\s([a-zA-Z\_]+)/', $comment, $dtoClass)) {
							$dtoClassName = $dtoClass[1];
							$dtoReflection = new ReflectionClass($dtoClassName);
							$props = array();
							foreach ($dtoReflection->getProperties(ReflectionProperty::IS_PUBLIC) as $prop) {
								$props[] = $prop->name . ' => ?';
							}
							$params[$param->name] = 'array(' . implode(', ', $props) . ')';
						}
						
					}
					
					continue;
				}
				$params[$param->name] = 'string';
			}
			if (preg_match('/\@return\s([a-zA-Z\|]+)/', $comment, $return)) {
				$return = $return[1];
			} else {
				$return = 'string';
			}
			$paramStr = '';
			foreach ($params as $param => $type) {
				$paramStr .= $type . ' $' . $param . ', ';
			}
			$comment = explode("\n", $comment);
			$methods[] = array(
				'HTTP method' => strtoupper($httpMethod[1]),
				'RPC method' => lcfirst(substr($methodRow->name, strlen($httpMethod[1]))),
				'Parameters' => $params,
				'Return' => $return,
				'Method comment' => isset($comment[1]) ? trim($comment[1], '*	 ') : '',
				'Formatted line' => $methodRow->name . '(' . trim($paramStr, ', ') . ');',
			);
			
		}
		return $methods;
	}
	
}
