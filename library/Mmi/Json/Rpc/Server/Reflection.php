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
 * Mmi/Json/Rpc/Server/Reflection.php
 * @category   Mmi
 * @package    Mmi_Json_Rpc_Server
 * @copyright  Copyright (c) 2010-2014 Mariusz Miłejko (http://milejko.com)
 * @author     Mariusz Miłejko <mariusz@milejko.pl>
 * @version    1.0.0
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */

/**
 * Parser komentarzy w klasach API
 * @category   Mmi
 * @package    Mmi_Json_Rpc_Server
 * @license    http://milejko.com/new-bsd.txt     New BSD License
 */
class Mmi_Json_Rpc_Server_Reflection {

	/**
	 * Refleksja klasy głównej
	 * @var ReflectionClass
	 */
	protected $_reflectionClass;

	public function __construct($className) {
		$class = new $className();
		$this->_reflectionClass = new ReflectionClass($className);
	}
	
	/**
	 * Pobiera listę metod
	 * @return array
	 */
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
				if (!preg_match('/\@param\s([a-zA-Z]+)\s\$' . $param->name . '/', $comment, $type)) {
					$params[$param->name] = 'string';
					continue;
				}
				$params[$param->name]['type'] = $type[1];
				if ($type[1] == 'array') {
					if (preg_match('/\@see\s([a-zA-Z\_]+)/', $comment, $dtoClass)) {
						$dtoClassName = $dtoClass[1];
						$dtoReflection = new ReflectionClass($dtoClassName);
						$props = array();
						foreach ($dtoReflection->getProperties(ReflectionProperty::IS_PUBLIC) as $prop) {
							$props[] = $prop->name . ' => ?';
						}
						$params[$param->name]['type'] = 'array(' . implode(', ', $props) . ')';
					}
				}
				if (preg_match('/\@param\s([a-zA-Z]+)\s\$' . $param->name . '\ (.[^\n]+)/', $comment, $comm)) {
					$params[$param->name]['comment'] = trim($comm[2]);
				}
			}
			//typ prosty
			if (preg_match('/\@return\s([a-zA-Z\|_]+)/', $comment, $return)) {
				$return = $return[1];
				if (strpos($return, '_') !== false && class_exists($return)) {
					$return = $this->_classFieldsArrayString($return);
				}
			} else {
				$return = 'string';
			}
			$paramStr = '';
			foreach ($params as $param => $data) {
				if (!isset($data['type'])) {
					$paramStr .= ' $' . $param . ', ';
					continue;
				}
				if (substr($data['type'], 0, 5) == 'array') {
					$data['type'] = 'array';
				}
				$paramStr .= $data['type'] . ' $' . $param . ', ';
			}
			$comment = explode("\n", $comment);
			$methods[] = array(
				'definition' => $methodRow->name . '(' . trim($paramStr, ', ') . ');',
				'comment' => isset($comment[1]) ? trim($comment[1], '*	 ') : '',
				'HTTP method' => strtoupper($httpMethod[1]),
				'RPC method' => lcfirst(substr($methodRow->name, strlen($httpMethod[1]))),
				'parameter count' => count($params),
				'parameter details' => $params,
				'return' => $return,
			);
		}
		return $methods;
	}
	
	protected function _classFieldsArrayString($className) {
		$class = new $className;
		$classStr = 'array(';
		//iterator klasy
		foreach ($class as $field => $value) {
			$classStr .= $field . ' => ?, ';
		}
		return rtrim($classStr, ', ') . ')';
	}

}
