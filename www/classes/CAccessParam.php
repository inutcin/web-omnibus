<?php


/**
 * class CAccessParam
 * 
 */
class CAccessParam
{

    /** Aggregations: */

    /** Compositions: */

     /*** Attributes: ***/

    /**
     * Имя параметра доступа
     * @access private
     */
    private $sName;

    /**
     * Значение параметра
     * @access private
     */
    private $sValue;

    /**
     * ID доступа к ресурсу, к которому относится этот параметр
     * @access private
     */
    private $nAccessId;


    /**
     * 
     *
     * @param int nAccessId ID доступа к ресурсу, к которому относится параметр доступа

     * @return void
     * @access public
     */
    public function __construct( $nAccessId) {
    } // end of member function __construct

    /**
     * Получение значения параметра доступа
     *
     * @param string sName Имя параметра

     * @return void
     * @access public
     */
    public function GetParam( $sName) {
    } // end of member function GetParam

    /**
     * Установка значения параметра
     *
     * @param string sName Имя параметра

     * @param string sValue Значение параметра

     * @param string sDescription Описание параметра

     * @return void
     * @access public
     */
    public function SetParam( $sName,  $sValue,  $sDescription = '') {
    } // end of member function SetParam





} // end of CAccessParam
?>
