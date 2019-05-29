<?php

	include("./connection.php");
 	$db = new dbObj();
 	$connection =  $db->getConnstring();

	class  book_store extends dbObj{

		public $conn;

		function __construct(){
			$this->conn = $this->getConnstring();
		}
	// 	CREATE TABLE `tbl_book` (
	//   `id` int(11) NOT NULL,
	//   `book_title` varchar(200) NOT NULL,
	//   `category` varchar(100) NOT NULL,
	//   `price` double NOT NULL,
	//   `banner` varchar(100) NOT NULL,
	//   `abstract` longtext NOT NULL,
	//   `long_description` longtext NOT NULL,
	//   `attachment` text NOT NULL,
	//   `tags` text NOT NULL,
	//   `sellers_note` text NOT NULL,
	//   `sellers_id` varchar(16) NOT NULL,
	//   `views` int(11) DEFAULT NULL,
	//   `downloads` int(11) DEFAULT NULL,
	//   `status` varchar(10) DEFAULT NULL
	// ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	// 	--
	// -- Dumping data for table `tbl_book`
	// --

	// INSERT INTO `tbl_book` (`id`, `book_title`, `category`, `price`, `banner`, `abstract`, `long_description`, `attachment`, `tags`, `sellers_note`, `sellers_id`, `views`, `downloads`, `status`) VALUES
	// (1, 'text', 'Web', 0, 'Front End', 'beginners', 'design an webpage', 'rey57ehhdd', 'hydra', 'pending', 'not featured', 2, NULL, NULL);

		public function get_category($category=FALSE,$featured=FALSE,$all=TRUE, $ismenu=FALSE,$bookid = FALSE,$orders=FALSE,$issold=FALSE
									,$inorder=FALSE){
			$col = '*';
			// `tbl_book`;
			if($all){
				$where ='';
			}elseif($category){
				$table = 'tbl_book';
				if($ismenu){$col='book_title,book_id';}else{$col ='*';}
				$where = "where category = '$category'";
			}elseif($featured){
				$table = 'tbl_book';
				if($ismenu){$col='book_title,book_id';}else{$col ='*';}
				$where ="where featured = '1'";
			}elseif($bookid) {
				$table = 'tbl_book';
				$where = "where book_id = '$bookid'";
			}elseif($orders) {
				$table = 'order_book';
				if($ismenu){$col='book_title,book_id';}else{$col ='*';}
				$where = "where order_id = '$orders'";
			}elseif($issold) {
				$table = 'order_book';
				if($ismenu){$col='book_title,book_id';}else{$col ='*';}
				$where = "where sold = '2'";
			}elseif($inorder) {
				$table = 'order_book';
				if($ismenu){$col='book_title,book_id';}else{$col ='*';}
				$where = "where in_order = '1'";
			}

			$query = "SELECT $col FROM `$table` $where";
		 	
		 	$run_query = $this->conn->query($query);

		 	
		 	if($run_query->num_rows > 0){

		        while ($user_data = $run_query->fetch_assoc()){
		           	$response[] = $user_data;
		        }
		        	
		        return array(TRUE,$response);
		    }else{
		        return array(FALSE); 
		    }

		}

		public function upload_books($max_size,$response){

			$target_dir = "uploads/";
            
                // $target_file = $target_dir . basename($_FILES["upload"]["name"]);
			$target_file = 'hellllo';
			$temp_name= "frog";//$_FILES["upload"]["tmp_name"]
              /*  // think i have issues here /// */
                $check = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // $size = $_FILES["upload"]["size"];
                $size = 45500;
                $response = array();
                
                if ( $imageFileType == 'pdf' ) {
                    if( $size <= $max_size ){
                        if(file_exists($target_file)){
                            //for all the form stuff
                            $response[] = "File Already Exists";

                            return array(FALSE,$response);
                        }else{
                            if(move_uploaded_file($temp_name, $target_file)){
                            	$response[] = "File upload successful";
                            	return array(TRUE,$response);
                            }else{
                            	$response[] = "Error uploading file";
                            	 return array(FALSE,$response);
                            }
                        }
                        
                    }else{
                        $response[] = " File size limit is 10000kb";
                        return array(FALSE,$response);
                    }
                }else{
                    
                    $response[] = " Only PDF file formats are supported";
                    return array(FALSE,$response);
                }




		}


		//modify
		//am having issues here. 
		public function modify_category(
		$bookid = false,
		$booktitle  = false,
		$featured  = false,
		$price  = false,
		$banner  = false,
		$abstract  = false,
		$long_desc = false,
		$attachment  = false,
		$tags = false,
		$sellernote  = false,
		$sellerid  = false,
		$views  = false,
		$downloads  = false,
		$status  = false,
		$start = FALSE,
		$time_id = FALSE,
		$user_id = FALSE,
		$exam_status = FALSE,
		$exam_id = FALSE
	) {
			if($bookid){
				$table = 'tbl_book';
				$where = "book_id = '$bookid'";
				$set = "`book_title`='$booktitle',
							`featured`='$featured',`price`='$price',`banner`='$banner',`abstract`='$abstract',
							`long_description`='$long_desc',`attachment`='$attachment',`tags`='$tags',
							`sellers_note`='$sellernote',`sellers_id`='$sellerid',`views`='$views',
							`downloads`='$downloads',`status`='$status'";
			}elseif($start) {
				//for updating the exam status by exam id at the beginning of the prep test
				$table = 'answers';
				$set = "`exam_status`='$exam_status',`time_id`='$time_id'";
				
				$where = "`user_id`='$user_id' and `exam_id`='$exam_id'";
			}
			

			$query = "UPDATE `$table` SET $set WHERE $where";
		 	
		 	$run_query = $this->conn->query($query);
		 	// print_r($query); exit();
		 	
			$qs = "SELECT * FROM `$table`  WHERE $where";
			// print_r($query); exit();
	 

			if ($run_qs = $this->conn->query($qs)) {
				if($run_qs->num_rows > 0){

					if($run_query = $this->conn->query($query)){

						return array(true);
					}
				}else{
					return array(false);
				}
				
			} else {
				return array(false);
			}

		}
		//deleting by bookid
	public function delete_category($bookid) {
		
		if($bookid) {
			$table = 'tbl_book';
			$where = "book_id = '$bookid'";
			$set  = "`status` = '0'";
			$and = "status = '1'";
		}
		
		$query = "UPDATE $table SET $set WHERE $where";

		$qs = "SELECT * FROM $table WHERE $where And $and";
 

		if ($run_qs = $this->conn->query($qs)) {
			if($run_qs->num_rows > 0){
				if($run_query = $this->conn->query($query)){
					return array(true);
				}else{
					return array('error');
				}
			}else{
				return array(false);
			}
			
		} else {
			return array(false);
		}

	}
	//get_exams	

		public function get_exam($all=TRUE ,$examid=FALSE,$questionid=FALSE,$unique = FALSE){
			$col = '*';
			
			if($all){
				$table = 'exams';
				$where ='';
			}elseif($examid){
				$table = 'exams';
				$where = "where exam_id = '$examid'";
			}elseif($questionid){
				$table = 'questions';
				$where = "where question_id = '$questionid'";
				//i want to get questions 
				//if userid is available and 
				//if examid is evailable and 
				//if questionid is available and 
				//if that user has not inserted 
					// a answer for that questionid
					// i.e there is no record of that questionid in the answer table 
				// SELECT questions.exam_id,answers.user_id,answers.answer,questions.question_id FROM answers
				// 	LEFT JOIN questions ON questions.id = answers.id ORDER BY `questions`.`question_id` ASC

			}elseif($unique){

			   $col="questions.question,questions.exam_id,questions.question,questions.answer,questions.question_id";
				// SELECT * FROM questions LEFT JOIN answers ON questions.question_id = answers.question_id WHERE answers.question_id IS NULL ORDER BY RAND() LIMIT 1
				// $col = '*';
				$table = "questions LEFT JOIN answers ON questions.question_id = answers.question_id WHERE answers.question_id IS NULL ORDER BY RAND() LIMIT 1";
				$where = '';
				// $col = "";

				// checks if an answer exists for a user on a particualar question
				

			}
			
			$query = "SELECT $col FROM $table $where";
		 	
		 	$run_query = $this->conn->query($query);
		 	// print_r($query);exit();
		 	
		 	if($run_query->num_rows > 0){

		        while ($user_data = $run_query->fetch_assoc()){

		           	$response[] = $user_data;

		        }
		        	
		        return array(TRUE,$response);
		    }else{
		        return array(FALSE); 
		    }

		}
		public function insert_exam(
				$examid=FALSE,
				$questionid=FALSE,$exam_name=FALSE,$exam_id,
				$question=FALSE,$question_id=FALSE,
				$optiona = FALSE,$optionb = FALSE,$optionc = FALSE,
				$optiond = FALSE ,$answer = FALSE,
				$answerid = FALSE,$user_id = FALSE,$ans_status=FALSE,
				$time_id = false, $exam_status){
			
			$cols= '*';
			
			

			if($examid){
				$table = 'exams';
				$cols = '`exam_name`, `exam_id`';
				$vals = "'$exam_name','$exam_id'";
				$where = " where `exam_id` = '$exam_id'";
			}elseif($questionid){
				$table = 'questions';
				$cols = ' `question`, `exam_id`, `question_id`, `optiona`, `optionb`, `optionc`, `optiond`, `answer`';
				$vals = "'$question','$exam_id','$question_id','$optiona','$optionb','$optionc','$optiond',
					'$answer'";
				$where = "where `question_id` = '$question_id'";
			}elseif($answerid){
				$table = 'answers';
				
				$cols = '`user_id`,`time_id`, `exam_id`, `question_id`, `answer`';
				$vals = "'$user_id','$time_id','$exam_id','$question_id','$answer'";
				$where = " where `question_id` = '$question_id' and `user_id` = '$user_id'";
			}elseif($ans_status){
				$table = 'answers';
				
				$cols = '`user_id`,`time_id`, `exam_id`, `question_id`, `answer`';
				$vals = "'$user_id','$time_id','$exam_id','$question_id','$answer'";
				$where = " where `question_id` = '$question_id' and `user_id` = '$user_id' and `exam_status` = '$exam_status'";
			}
			
			$query = "INSERT INTO `$table`($cols) VALUES ($vals)";
			// print_r($query);exit();
			$s = "SELECT $cols FROM `$table` $where";
			
			$s_r =  $this->conn->query($s);
		 	
		 	
		 	if($s_r->num_rows == 0){
		 		
		 		$run_query = $this->conn->query($query);
		 		// print_r($run_query); exit();
		 		if($run_query){
		 			return array(TRUE);
		 		}
		       else{
		       	 return array(FALSE);
		       }
		    }elseif($s_r->num_rows > 0){
		        return array(FALSE); 
		    }

		}
		// public function (){

		// }

		//users can perform their prep test more than once 
		// but each time they take the test they have an id 
		//lemme get the id 

		//i just have to get an id that will be used each time 
		//exam id and a exam_status (1 = finished) (0 = in progress )
		public function gen_no($exam_id,$exam_status){

			$query = "SELECT max(`time_id`) FROM `answers` WHERE `exam_id` = '$exam_id' and `exam_status` = '$exam_status'";
			
			$run_query = $this->conn->query($query);
			// print_r($run_query);exit();
			$user_data = $run_query->fetch_assoc();
			foreach ($user_data  as $key => $value) {
				# code...
				return $value;
			}		
		}


		// av finally gotten the no_of_times or time_id
		// now time to insert the time_id into the question and answer table  
		// that id is also inserted into the dbs question and answers 
		// the answer in answer table is now compared with the answer in question table that has the same 

}

$bookobj = new book_store();
// echo $bookobj->gen_no($exam_id,$exam_status);






?>