<?php defined('SYSPATH') or die('No direct script access.');

/**
 * @author Maria I. S. Sinaga
 * @copyright 2010
 */
class Model_Faculty extends ORM
{
    protected $_primary_key = 'faculty_id';
    protected $_table_name = 'faculty';
    protected $_rules = array
        (
        'faculty_code' => array
            (
                'not_empty' => NULL,
                'min_length' => array(2),
                'max_length' => array(10),
                'regex' => array('/^[a-zA-Z]++$/')
            ),
        'faculty_name' => array
            (
            'not_empty' => NULL,
            'min_length' => array(2),
            'max_length' => array(50),
            'regex' => array('/^[\sa-zA-Z,]++$/')
            )
        );

    /**
     *
     * @param Integer $faculty_id 
     */
    public function __construct($faculty_id = FALSE)
    {
        if ( $faculty_id )
        {
            parent::__construct($faculty_id);
        }
        else
        {
            parent::__construct();
        }
    }

    /**
     * This function is used to validate and sanitize all faculty data that will be inserted
     * @param Array $array
     * @return Array
     */
    public function validate_create(&$array)
    {
        $array = Validate::factory($array)
                        ->filter(TRUE, 'trim')
                        ->filter('faculty_name', 'ucwords')
                        ->filter('faculty_code', 'strtoupper')
                        ->rules('faculty_code', $this->_rules['faculty_code'])
                        ->rules('faculty_name', $this->_rules['faculty_name'])
                        ->callback('faculty_name', array($this, 'faculty_name_available'))
                        ->callback('faculty_code', array($this, 'faculty_code_available'));
        return $array;
    }

    /**
     * This function is used to validate and sanitize all faculty data that will be updated
     * @param Array $array
     * @return Array
     */
    public function validate_update(&$array)
    {
        $array = Validate::factory($array)
                        ->filter(TRUE, 'trim')
                        ->filter('faculty_name', 'ucwords')
                        ->filter('faculty_code', 'strtoupper')
                        ->rules('faculty_code', $this->_rules['faculty_code'])
                        ->rules('faculty_name', $this->_rules['faculty_name']);
        return $array;
    }

    /**
     * This function is to check if the faculty_name is available
     * @param Validate $array
     * @param String $field 
     */
    public function faculty_name_available(Validate $array, $field)
    {
        $hasil = (bool) DB::select(array('COUNT("*")', 'total_count'))
                        ->from($this->_table_name)
                        ->where('faculty_name', '=', $array[$field])
                        ->execute($this->_db)
                        ->get('total_count');
        if ( $hasil )
        {
            $array->error($field, 'faculty_name');
        }
    }

    /**
     * This function is to check if the faculty_code is available
     * @param Validate $array
     * @param String $field
     */
    public function faculty_code_available(Validate $array, $field)
    {
        $hasil = (bool) DB::select(array('COUNT("*")', 'total_count'))
                        ->from($this->_table_name)
                        ->where('faculty_code', '=', $array[$field])
                        ->execute($this->_db)
                        ->get('total_count');
        if ( $hasil )
        {
            $array->error($field, 'faculty_code');
        }
    }

    /**
     * This function is used to view faculty
     * @return Array
     */
    public function viewFaculty()
    {
        return $this->find_all();
    }
	
	/**
     * This function is used to view faculty
     * @return Array
     */
    public function getFaculties()
    {
		$sql = "SELECT * FROM faculty";
		$result = DB::query(Database::SELECT, $sql)->execute();
		return $result->as_array();
    }

	
   /**
    * This function is used to view all detail faculty
    * @param Integer $faculty_id
    * @return Array
    */
    public function viewDetailFaculty($faculty_id)
    {
        return $this->where('faculty_id', '=', $faculty_id)->find();
    }

    /**
     * This function is used to delete a faculty
     * @param Integer $faculty_id
     * @return Boolean 
     */
    public function deleteFaculty ($faculty_id)
    {
        return $this->delete($faculty_id);
    }

}
