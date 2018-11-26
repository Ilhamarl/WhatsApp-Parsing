<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parsing_model extends CI_Model {

	public $title;
	public $content;
	public $date;

	public function get_last_ten_entries()
	{
		$query = $this->db->get('entries', 10);
		return $query->result();
	}

	public function insert_entry()
	{
                $this->title    = $_POST['title']; // please read the below note
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->insert('entries', $this);
            }

            public function update_entry()
            {
            	$this->title    = $_POST['title'];
            	$this->content  = $_POST['content'];
            	$this->date     = time();

            	$this->db->update('entries', $this, array('id' => $_POST['id']));
            }

            public function parser()
            {
            	$data = array();
            		
            	if(isset($data['chat']))
            	{
            		$text	= $data['chat'];
            		$rows	= explode("\n", $text);
            		array_shift($rows);

            		foreach($rows as $row => $data)
            		{
            			$row_data = explode(' - ', $data);
            			if (!isset($row_data[1])) 
            			{
            				$row_data[1] = NULL;
            			}
            			$info[$row]['datetime']     = $row_data[0];
            			$info[$row]['name_chat']    = $row_data[1];

            			$data['datetime']	= $info[$row]['datetime'];	
            			$data['namechat']	= $info[$row]['name_chat'];
            		}
            	}
            	return $data;
            }

        }