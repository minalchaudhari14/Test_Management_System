<?php 
class StudInfoController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
			$this->load->model('AddStudInfoModel');
			$this->load->library('form_validation','upload','session');
	}

    public function StudInfo()
    {
    	$data['assessment_year_id']=$this->AddStudInfoModel->get_Records();
        $this->load->view('StudInfoView',$data);
    }

    public function EditStudent($id){
       $data['StudentInformation'] = $this->AddStudInfoModel->EditStudent($id);
       $data['assessment_year_id']=$this->AddStudInfoModel->get_Records();
       $this->load->view('StudInfoView',$data);
    }

    private function imageUploadConfig()
	{   
	    $config = array();
	    // $config['upload_path'] = UPLOAD_FILE_BASE_LOCATION;
	    $config['upload_path']=dirname($_SERVER["SCRIPT_FILENAME"]).PROFILE_FILE_BASE_LOCATION;
	    $config['allowed_types']=ALLOWED_TYPES;
	    $config['max_size']=IMAGE_MAX_SIZE;
	    $config['encrypt_name']=TRUE;
		$config['remove_spaces']=TRUE;

	    return $config;
	}

	public function Validstudent()
	{
		$postdata = $this->input->post();
		$StudentExistData = $this->AddStudInfoModel->EditStudent($postdata['student_id']);

		$this->form_validation->set_rules('student_first_name', 'First Name', 'required');
		$this->form_validation->set_rules('student_last_name', 'Last Name', 'required');
		if (empty($postdata['student_id'])) {
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[student_info.email]',
				array(
					'required'=>'email is not validate.',
					'is_unique'=>'email is already exists.')
				);
			$this->form_validation->set_rules('mobile_no', 'Mobile Number.', 'required|regex_match[/^[0-9]{10}$/]|is_unique[student_info.mobile_no]');
			$this->form_validation->set_rules('aadhar_card_no', 'AadharCard', 'required|regex_match[/^\d{4}\d{4}\d{4}$/]|is_unique[student_info.aadhar_card_no]');	
		} else {
			if ($StudentExistData->email != $postdata['email']){
				$this->form_validation->set_rules('email', 'Email', 'required|is_unique[student_info.email]',
				array(
					'required'=>'email is not validate.',
					'is_unique'=>'email is already exists.')
				);		
			}
			if($StudentExistData->mobile_no != $postdata['mobile_no'] ){
			$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'required|regex_match[/^[0-9]{10}$/]|is_unique[student_info.mobile_no]');
			}
			if($StudentExistData->aadhar_card_no != $postdata['aadhar_card_no']){
				$this->form_validation->set_rules('aadhar_card_no', 'Aadhar Card Number', 'required|regex_match[/^\d{4}\d{4}\d{4}$/]|is_unique[student_info.aadhar_card_no]');	
			}
		}
		if (empty($postdata['student_id'])) {
			$this->form_validation->set_rules('password', 'password', 'required|min_length[8]');
		}

		if ($this->form_validation->run() == FALSE) {
			$result = array (
                'success'=> false,
                'statusMsg'=>validation_errors()
            );
		} else {
			$data = array(
				'student_first_name'=>strtoupper($postdata['student_first_name']),
				'student_middle_name'=>strtoupper($postdata['student_middle_name']),
				'student_last_name'=>strtoupper($postdata['student_last_name']),
				'password'=>md5($postdata['password']),
				'email'=>strtoupper($postdata['email']),
				'gender'=>strtoupper($postdata['gender']),
				'mobile_no'=>$postdata['mobile_no'],
				'alternate_mobile_no'=>$postdata['alternate_mobile_no'],
				'dob'=>$postdata['dob'],
				'address'=>strtoupper($postdata['address']),	
				'state'=>strtoupper($postdata['state']),	
				'city'=>strtoupper($postdata['city']),	
				'country'=>strtoupper($postdata['country']),
				'assessment_year_id'=>$postdata['assessment_year_id'],
				'date_of_reg'=>$postdata['date_of_reg'],
				'aadhar_card_no'=>$postdata['aadhar_card_no']
			);
			$this->load->library('upload', $this->imageUploadConfig());
            $this->upload->initialize($this->imageUploadConfig());
            if($this->upload->do_upload('image'))
            {
                $fileData=$this->upload->data();
                $actual_filename=PROFILE_FILE_BASE_LOCATION . $fileData['file_name'];
            } else {
            	if (!empty($postdata['student_id'])) {
            		$actual_filename = $StudentExistData->student_photo;
            	} else {
            		$actual_filename = "";
            	}
            }

            $data['student_photo'] = $actual_filename;

    		if(empty($postdata['student_id'])) {
            	$data['password']=md5($postdata['password']);

				$this->AddStudInfoModel->Validstudent($data);
					$insertId=$this->db->insert_id();
				    $regNumberFormat='REG';
				    $formatCount=strlen($regNumberFormat);
				    $formatCount=$formatCount + 6;
				    $totalCount=$formatCount - strlen($insertId);
				    $formatted_str=str_pad($regNumberFormat,$totalCount,0,STR_PAD_RIGHT).$insertId;

				    $updateData = array(
				    	'reg_id'=>$formatted_str
				    );	
				    if ($this->AddStudInfoModel->updateStudentInfo($insertId, $updateData)) {
				    	$result = array (
			                'success'=>true,
			                'statusMsg'=>"Student Added Successfully"
		            	);
				    } else {
				    	$result = array (
			                'success'=>true,
			                'statusMsg'=>"Student Added Successfully"
		            	);
				    }
			} else {
				$data['modify_timestamp'] = date('y-m-d H:i');
				if ($this->AddStudInfoModel->updateStudentInfo($postdata['student_id'], $data)) {
					$result=array(
				        'success'=>False,
				       	'statusMsg'=>"Student Update  Successfully."
		            );
				} else {
					$result=array(
				        'success'=>False,
				       	'statusMsg'=>"Student Not Updated."
		            );
				}	    
			}
	    }
	    echo json_encode($result);
	}

    public function changeStudentStatus() {
      $postdata = $this->input->post();
        $data = array(
            'active' => $postdata['status'],
            'student_id'=> $postdata['id']
        );
        if ($this->AddStudInfoModel->updateStudentInfo($postdata['id'], $data)) {
            $result = array(
                'success' => true
            );
        } else {
            $result = array(
                'success' => false,
                'statusMsg' => "Something went wrong."
            );
        }
         echo json_encode($result);
    }

	public function mapStudentBatch() {
	    $postdata = $this->input->post();
	    $subjectIdsArr = explode(',', $postdata['batchselect']);
	    	foreach ($subjectIdsArr as $row) {
		        $data[] = array(
		            'batch_id' => $row,
		            'student_id' => $postdata['cid'],
		        );
	        }
	        if ($this->AddStudInfoModel->insertStudentBatchMap($data)) {
	            $result = array(
	                'success' => true,
	                'statusMsg' => "Map Successfully..!"
	            );
	        } else {
	            $result = array(
	                'success' => false,
	                'statusMsg' => "Something went wrong."
	            );
	        }
	        echo json_encode($result);
	    }
	}
?>


	