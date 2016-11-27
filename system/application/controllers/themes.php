<?php
class Themes extends Controller{

	function Themes() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('date');	
		$this->load->library('email');	
		
		error_reporting(E_ALL);
		ini_set('display_errors', '1');		
	}
	
	function index() {
		$this->popular();
	}

//	function featured() {
//		$this->db->order_by('last_edited DESC, name ASC');
//		$data['themes'] = $this->db->get('themes');
//		$this->load->view('header', $data);
//		$this->load->view('themes', $data);
//		$this->load->view('footer', $data);
//	}
	
	function popular() {
		$this->db->order_by('score DESC, name ASC');
		$data['mode'] = 'popular';
		$data['themes'] = $this->db->get('themes');

		$this->load->view('header');
		$this->load->view('themes', $data);
		$this->load->view('footer');
	}

//	function all() {
//		$this->db->order_by('last_edited DESC, name ASC');
//		$data['themes'] = $this->db->get('themes');
//		$this->load->view('header', $data);
//		$this->load->view('themes', $data);
//		$this->load->view('footer', $data);
//	}
	
	function latest()
	{
		$this->db->order_by('last_edited DESC, name ASC');
		$data['mode'] = 'latest';
		$data['themes'] = $this->db->get('themes');

		$this->load->view('header', $data);
		$this->load->view('themes', $data);
		$this->load->view('footer', $data);
	}
	
	function view($id) {
		$id = intval($id);
		$this->db->select('themes.*, users.id as user_id, users.username, users.signature, users.biography');		
		$this->db->where('themes.id', $id);		
		$this->db->join('users', 'users.id = themes.user');
		$records = $this->db->get('themes');
		if ($records->num_rows() > 0) {
			$data = $records->row_array();
			
			$this->db->select('themes_comments.*, users.username');
			$this->db->where('themes_comments.theme', $id);
			$this->db->join('users', 'users.id = themes_comments.user');
			$this->db->order_by('timestamp DESC');
			$data['comments'] = $this->db->get('themes_comments');
			
			$data['rating'] = 0;
			if ($this->dx_auth->is_logged_in()) {
				$this->db->where('user', $this->dx_auth->get_user_id());
				$this->db->where('theme', $id);
				$records = $this->db->get('themes_ratings');
				if ($records->num_rows > 0) {
					$data['rating'] = $records->row()->rating;
				}
			}
									
			$this->load->view('header');
			$this->load->view('theme', $data);
			$this->load->view('footer');
		}
		else {
			$data["error"] = "Not found";
			$data["details"] = "This theme does not exist.";
			$this->load->view("header");	
			$this->load->view('error', $data);
			$this->load->view("footer");
		}
	}
	
	function generatethumbs() {
		$this->createThumbs(FCPATH.'uploads/themes/',FCPATH.'uploads/themes/thumbs/',100);
	}
	
	function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth )
	{
	  // open the directory
	  $dir = opendir( $pathToImages );

	  // loop through it, looking for any/all JPG files:
	  while (false !== ($fname = readdir( $dir ))) {
	  	try {
			// parse path for the extension
			$info = pathinfo($pathToImages . $fname);
			// continue only if this is a PNG image
			if ( array_key_exists('extension', $info) && ((strtolower($info['extension']) == 'png')||(strtolower($info['extension']) == 'jpg')) )
			{
			  // load image and get image size
			  if (strtolower($info['extension']) == 'png') {
			  	$img = imagecreatefrompng( "{$pathToImages}{$fname}" );
			  	if (!$img) {
			  		$img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
				}
			  }
			  elseif (strtolower($info['extension']) == 'jpg') {
				$img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
			  	if (!$img) {
			  		$img = imagecreatefrompng( "{$pathToImages}{$fname}" );
				}
			  }
			  $width = imagesx( $img );
			  $height = imagesy( $img );

			  // calculate thumbnail size
			  $new_width = $thumbWidth;
			  $new_height = floor( $height * ( $thumbWidth / $width ) );

			  // create a new temporary image
			  $tmp_img = imagecreatetruecolor( $new_width, $new_height );

			  // copy and resize old image into new image
			  imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

			  // save thumbnail into a file
			  $thumb_filename = $info['filename'];
			  imagepng( $tmp_img, "{$pathToThumbs}{$thumb_filename}.png" );
			}
		}
		catch (Exception $e) {
			echo 'Exception : ',  $e->getMessage(), "\n<br/>";
		}
	  }
	  // close the directory
	  closedir( $dir );
	}

	function _json() {
		$this->db->select('themes.*, users.id as user_id, users.username, users.signature, users.biography');
		$this->db->join('users', 'users.id = themes.user');
		$spices = $this->db->get('themes');
		foreach ($spices->result() as $spice) {
            $json[$spice->id] = array(
	            'spices-id' => $spice->id,
        	    'name' => $spice->name,
                'description' => $spice->description,
	            'score' => $spice->score,
        	    'created' => $spice->created,
                'last_edited' => $spice->last_edited,
	            'file' => $spice->file,
                'screenshot' => $spice->screenshot,
	            'author_id' => $spice->user,
        	    'author_user' => $spice->username
            );
    	}
		$fp = fopen('/var/www/cinnamon-spices.linuxmint.com/json/themes.json', 'w');
		fwrite($fp, json_encode($json));
		fclose($fp);
	}
	
	function rate($id, $rating) {
		$id = intval($id);
		$rating = intval($rating);
		if ($this->dx_auth->is_logged_in() && $rating >= 1 && $rating <= 5) {    			
			$this->db->where('user', $this->dx_auth->get_user_id());
			$this->db->where('theme', $id);
			$this->db->delete('themes_ratings');						
			$this->db->set('user', $this->dx_auth->get_user_id());
			$this->db->set('theme', $id);
			$this->db->set('rating', $rating);
			$this->db->insert('themes_ratings');			
			$this->db->query("UPDATE themes SET score = (SELECT SUM(rating-3) FROM themes_ratings WHERE theme = $id) WHERE id = $id");
			$this->_json();
		}
		redirect("/themes/view/$id", "location");
	}
	
	function certify($id, $certification) {
		$id = intval($id);
		$certification = intval($certification);
		if ($this->dx_auth->is_logged_in() && $this->dx_auth->is_admin()) {    														
			$this->db->where('id', $id);
			$this->db->set('certification', $certification);
			$this->db->update('themes');	
			$this->_json();		
		}
		redirect("/themes/view/$id", "location");
	}
	
	function edit($id, $error="") {
		$id = intval($id);
		if ($this->dx_auth->is_logged_in()) {			
			$this->db->where('id', $id);					
			$this->db->where('user', $this->dx_auth->get_user_id());
			$records = $this->db->get('themes');
			if ($records->num_rows() > 0) {	
				$data = $records->row_array();
				$data['error'] = $error;
				$this->load->view('header');
				$this->load->view('theme_edit', $data);
				$this->load->view('footer');
			}			
		}		
	}
	
	function edit_save($id) {
		$id = intval($id);
        if ($this->dx_auth->is_logged_in()) {    
			$this->db->where('id', $id);					
			$this->db->where('user', $this->dx_auth->get_user_id());
			$records = $this->db->get('themes');
			if ($records->num_rows() > 0) {	
				$data = $records->row_array();
			
				$this->db->where('id', $id);					
				$this->db->where('user', $this->dx_auth->get_user_id());
				$this->db->set('name', $_POST['name']);
				$this->db->set('version', $_POST['version']);
				$this->db->set('website', $_POST['website']);
				$this->db->set('description', $_POST['description']);				
				$this->db->set('last_edited', now());
				$this->db->update('themes');	
				
				$this->load->library('upload');
				if ($_FILES['file']['error'] != 4) {	
					#Upoad the new file										
					$filename = $this->genRandomString();
					$config['upload_path'] = FCPATH.'uploads/themes/';
					$config['file_name'] = $filename;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = 'zip';				
					$config['max_size']	= '10240';

					$this->upload->initialize($config);
					if (!$this->upload->do_upload('file')) {
						$this->edit($id, $this->upload->display_errors());
						return;
					}
					else {
						$upload_data = $this->upload->data();
						$filename = $upload_data['file_name'];
						chmod( FCPATH.'uploads/themes/'.$filename , 0644 );
						#Delete the old file
						if(!empty($data['file'])) {
							if(file_exists(FCPATH.$data['file']) &&  is_file(FCPATH.$data['file'])) {
								unlink(FCPATH.$data['file']);
							}
						}
						#Update entry in DB
						$this->db->where('id', $id);
						$this->db->where('user', $this->dx_auth->get_user_id());
						$this->db->set('file', "/uploads/themes/".$filename);
						$this->db->update('themes');
					}
				}
				
				if ($_FILES['screenshot']['error'] != 4){
					#Upoad the new file										
					$filename = $this->genRandomString();
					$config['upload_path'] = FCPATH.'uploads/themes/';
					$config['file_name'] = $filename;
					$config['overwrite'] = TRUE;
					$config['allowed_types'] = 'png';				
					$config['max_size']	= '1024';

					$this->upload->initialize($config);
					if (!$this->upload->do_upload('screenshot')) {
						$this->edit($id, $this->upload->display_errors());
						return;
					}
					else {
						$upload_data = $this->upload->data();
						$filename = $upload_data['file_name'];
						chmod( FCPATH.'uploads/themes/'.$filename , 0644 );
						#Delete the old file
						if(!empty($data['screenshot'])) {
							if(file_exists(FCPATH.$data['screenshot']) &&  is_file(FCPATH.$data['screenshot'])) {
								unlink(FCPATH.$data['screenshot']);
							}
						}
						#Update entry in DB
						$this->db->where('id', $id);
						$this->db->where('user', $this->dx_auth->get_user_id());
						$this->db->set('screenshot', "/uploads/themes/".$filename);
						$this->db->update('themes');
						$this->generatethumbs();
					}
				}

				die;
				$this->_json();					
			}	                                            					                                                
        }
        redirect("/themes/view/$id", "location");
    }
	
	function delete($id) {
		$id = intval($id);
		if ($this->dx_auth->is_logged_in()) {			
			$this->db->where('id', $id);					
			$this->db->where('user', $this->dx_auth->get_user_id());
			$records = $this->db->get('themes');
			if ($records->num_rows() > 0) {	
				$data = $records->row_array();
				
				#Delete the files
				unlink(FCPATH.$data['screenshot']);						
				unlink(FCPATH.$data['file']);						
				
				$this->db->where('theme', $id);
				$this->db->delete('themes_comments');
											
				$this->db->where('id', $id);
				$this->db->where('user', $this->dx_auth->get_user_id());
				$this->db->delete('themes');

				$this->_json();
			}		
		}
		redirect("/themes", "location");
	}
	
	function comment($id) {
		$id = intval($id);
		if ($this->dx_auth->is_logged_in()) {
			$this->db->set('user', $this->dx_auth->get_user_id());
			$this->db->set('theme', $id);
			$this->db->set('timestamp', now());
			$this->db->set('body', $_POST['body']);	
			$this->db->insert('themes_comments');
		}
		redirect("/themes/view/$id", "location");
	}
			
	function create_new($error="") {
		if ($this->dx_auth->is_logged_in()) {	
			$data["error"] = $error;		
			$this->load->view('header');			
			$this->load->view('themes_new', $data);
			$this->load->view('footer');
		}
	}
		    
    function create_new_save() {
        if ($this->dx_auth->is_logged_in()) {    
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('version', 'Version', 'required');						
			$this->form_validation->set_rules('website', 'Website', 'required');
			                                                   
            if ($this->form_validation->run() == FALSE) {
				$this->create_new();
				return;
			}
			
			if ($_FILES['file']['error'] == 4) {
				$this->create_new("A file is required");
				return;
			}
			
			if ($_FILES['screenshot']['error'] == 4){
				$this->create_new("A screenshot is required");
				return;
			}			
			
			$this->load->library('upload');
			
			// Upload the file
			$filename = $this->genRandomString();
			$config['upload_path'] = FCPATH.'uploads/themes/';
			$config['file_name'] = $filename;
			$config['overwrite'] = TRUE;
			$config['allowed_types'] = 'zip';				
			$config['max_size']	= '10240';				
			$this->upload->initialize($config);
										
			if (!$this->upload->do_upload('file')) {					
				$this->create_new($this->upload->display_errors());
				return;
			}
			else {										
				$upload_data = $this->upload->data();
				$file_file_name = $upload_data['file_name'];
				chmod( FCPATH.'uploads/themes/'.$file_file_name , 0644 );  					
				
				$config['upload_path'] = FCPATH.'uploads/themes/';
				$config['file_name'] = $filename;
				$config['overwrite'] = TRUE;
				$config['allowed_types'] = 'png';				
				$config['max_size']	= '1024';				
				$this->upload->initialize($config);
				
				if (!$this->upload->do_upload('screenshot')) {			
					//Delete theme file
					if (file_exists(FCPATH.'uploads/themes/'.$file_file_name)) {			 
						unlink(FCPATH.'uploads/themes/'.$file_file_name);
					}
								       
					//Reload form
					$this->create_new($this->upload->display_errors());
					return;
				}
				else {
					$upload_data = $this->upload->data();
					$screenshot_file_name = $upload_data['file_name'];
					chmod( FCPATH.'uploads/themes/'.$screenshot_file_name , 0644 );  	
					
					$this->db->set("user", $this->dx_auth->get_user_id());
					$this->db->set("name", $_POST["name"]);
					$this->db->set("version", $_POST["version"]);
					$this->db->set("website", $_POST["website"]);
					$this->db->set("description", $_POST["description"]);
					$this->db->set("file", "/uploads/themes/".$file_file_name);
					$this->db->set("screenshot", "/uploads/themes/".$screenshot_file_name);
					$this->db->set("created", now());
					$this->db->set("last_edited", now());
					$this->db->insert("themes");				
					$id = $this->db->insert_id();		
					
					$this->generatethumbs();

					$this->_json();
											
					redirect("/themes/view/$id", "location");
				}										
			}                                            					                                                  
        }
    }
    
    function genRandomString() {
        $length = 10;
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for ($p = 0; $p < 4; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters) -1)];
        }
        $string .= '-';
        for ($p = 0; $p < 4; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters) -1)];
        }
        $string .= '-';
        for ($p = 0; $p < 4; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters) -1)];
        }        
        return $string;
    }
		
}
?>
