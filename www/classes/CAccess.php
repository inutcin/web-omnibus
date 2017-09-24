<?php
require_once 'CAccessParam.php';


/**
 * class CAccess
 * 
 */
class CAccess
{

    /** Aggregations: */

    /** Compositions: */

     /*** Attributes: ***/

    /**
     * Параметры доступа
     * @access private
     */
    private $arParams = array();


    /**
     * Проверка корректности доступов
     *
     * @return bool
     * @access public
     */
    public function Check() {
    } // end of member function Check

    /**
     * Установка атрибутов доступа
     *
     * @param string arParams Имя атрибута

     * @return void
     * @access public
     */
    public function SetParams( $arParams) {
    } // end of member function SetParams

    /**
     * 
     *
     * @param int nResouseId ID ресурса от которого этот доступ

     * @return void
     * @access public
     */
    public function __construct( $nResouseId) {
    } // end of member function __construct

    /**
     * 
     *
     * @return void
     * @access public
     */
    public function __desctruct_() {
    } // end of member function __desctruct_

    /**
     * 
     *
     * @param string sName Возвращает значение параметра доступа

     * @return void
     * @access public
     */
    public function getParam( $sName) {
    } // end of member function getParam





} // end of CAccess
?>
