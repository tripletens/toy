<?php

	require('control.php');

	$post=json_decode(file_get_contents("php://input"),true);
	
	if($post['p_o'] ==''){
	exit;//// call wrong operation method
	}

	////// LOAD BOOK STORE FRONT.
	//to get allbooks , 
	if($post['p_o'] =='g_bk'){
		$allbooks=''; $featured='';
		$allbooks = $bookobj->get_category();
		$featured = $bookobj->get_category(FALSE,TRUE,FALSE);
			$result= array('code'=>'00','message'=>$allbooks,'message1'=>$featured);
	}

	////  get books in a category 
	if($post['p_o'] =='g46'){ 
		$category = $post['cat'];
		$featured = $bookobj->get_category($category,FALSE,FALSE,FALSE,FALSE);
		if($featured){
			$status = '1';
			$result = array('code'=>'00','category' => $category , 'status'=> $status, 'message'=>$featured );
		}
		if($featured == array(FALSE)){
			$result = array('code'=>'01','message' => 'No Book Found In CATEGORY');
		}
	}
	// get featured books 
	//$category=FALSE,$featured=FALSE,$all=TRUE, $ismenu = FALSE
	if($post['p_o'] == 'g47'){
		$featured = $post['feat'];
		$featured_bk = $bookobj->get_category(FALSE,$featured,FALSE,FALSE,FALSE);
		if($featured){
		$status = '1';
			$result = array('code'=>'00','featured' => $featured ,'status' => $status, 'message'=> $featured_bk );
		}
		if($featured == array(FALSE)){
			$result= array('code'=>'01','message' => 'No Featured Book Found In CATEGORY');
		}
	}
	//$category=FALSE,$featured=FALSE,$all=TRUE, $ismenu = FALSE,$bookid = FALSE
	//get books by book_id 
	if($post['p_o'] == 'g_48'){
		$bookid = $post['bk'];
		$featured = $bookobj->get_category(FALSE,FALSE,FALSE,FALSE,$bookid);
		if($featured){
			$status = '1';
			$result = array('code'=>'00','Book Id' => $bookid , 'status'=> $status, 'message'=>$featured );
		}
		if($featured == array(FALSE)){
			$result = array('code'=>'01','message' => 'No Book Found In CATEGORY');
		}
	}
	//category   && ismenu
	if($post['p_o'] == 'g_49'){
		 
		$category = $post['cat'];
		$featured = $bookobj->get_category($category,FALSE,FALSE, TRUE,FALSE);
		if($featured){
			$status = '1';
			$result = array('code'=>'00','category' =>  $category, 'status'=> $status, 'message'=>$featured );
		}
		if($featured == array(FALSE)){
			$result = array('code'=>'01','message' => 'No Book Found In CATEGORY with such book title');
		}
	}
	//featured ++ ismenu
	if($post['p_o'] == 'g_50'){
		 
		$featured = $post['cat'];
		$featured_id = $bookobj->get_category(FALSE,$featured,FALSE, TRUE,FALSE);
		if($featured_id){
			$status = '1';
			$result = array('code'=>'00','category' =>  $featured, 'status'=> $status, 'message'=>$featured_id );
		}
		if($featured_id == array(FALSE)){
			$result = array('code'=>'01','message' => 'No Book Found In CATEGORY with such book title');
		}
	}
	//uploadng files here
	if($post['p_o'] == 'g_51'){
		 
		$name = $post['up'];
		$response = $post['res'];
		$max_size = 100000000;
		$upload = $bookobj->upload_books($max_size,$response);
		if($upload){
			$status = '1';
			$result = array('code'=>'00','upload' =>  $name, 'status'=> $status, 'message'=>$upload );
		}
		if($upload == array(FALSE,$response)){
			$status = '0'; 
			$result = array('code'=>'01','message' => 'Not Uploaded','status'=>$status);
		}
	}
	//orders 
	// $category=FALSE,$featured=FALSE,$all=TRUE, $ismenu=FALSE,$bookid = FALSE,$orders = FALSE
	if($post['p_o'] == 'g_52'){
		 
		$orders = $post['ord'];
		$order_id = $bookobj->get_category(FALSE,FALSE,FALSE, FALSE,FALSE,$orders);
		if($order_id){
			$status = '1';
			$result = array('code'=>'00','category' =>  $orders, 'status'=> $status, 'message'=> $order_id );
		}
		if($order_id == array(FALSE)){
			$result = array('code'=>'01','message' => 'No Book Found In CATEGORY with such order id');
		}
	}
	//orders ++ ismenu
	if($post['p_o'] == 'g_53'){
		 
		$orders = $post['ord'];
		$orders_id = $bookobj->get_category(FALSE,FALSE,FALSE, TRUE,FALSE,$orders);
		if($orders_id){
			$status = '1';
			$result = array('code'=>'00','orders' =>  $orders, 'status'=> $status, 'message'=>$orders_id );
		}
		if($orders_id == array(FALSE)){
			$result = array('code'=>'01','message' => 'No Book Found In CATEGORY with such book title');
		}
	}
	//issold 
	// $category=FALSE,$featured=FALSE,$all=TRUE, $ismenu=FALSE,$bookid = FALSE,$orders=FALSE,$issold=FALSE
	if($post['p_o'] == 'g_54'){
		 
		$issold = $post['iso'];
		$issold_id = $bookobj->get_category(FALSE,FALSE,FALSE,FALSE,FALSE,FALSE,TRUE);
		if($issold_id){
			$status = '1';
			$result = array('code'=>'00','orders' =>  $issold, 'status'=> $status, 'message'=>$issold_id );
		}
		if($issold_id == array(FALSE)){
			$result = array('code'=>'01','message' => 'No Book Found In CATEGORY with such book title');
		}
	}
	//issold ++ menu
	if($post['p_o'] == 'g_55'){
		 
		// $issold = $post['iso'];
		$issold = 2;
		$issold_id = $bookobj->get_category(FALSE,FALSE,FALSE,TRUE,FALSE,FALSE,TRUE);
		if($issold_id){
			$status = '1';
			$result = array('code'=>'00','sold' =>  $issold, 'status'=> $status, 'message'=>$issold_id );
		}
		if($issold_id == array(FALSE)){
			$result = array('code'=>'01','message' => 'No Book Found In CATEGORY with such book title');
		}
	}
	//in_order
	if($post['p_o'] == 'g_56'){
		 
		$inorder = 1;
		$inorder_id = $bookobj->get_category(FALSE,FALSE,FALSE,FALSE,FALSE,FALSE,FALSE,TRUE);
		if($inorder_id){
			$status = '1';
			$result = array('code'=>'00','orders' =>  $inorder, 'status'=> $status, 'message'=>$inorder_id );
		}
		if($inorder_id == array(FALSE)){
			$result = array('code'=>'01','message' => 'No Book Found In CATEGORY with such book title');
		}
	}
	//update category
	if($post['p_o'] == 'g_57'){

		$bookid = $post['bk'];

		$booktitle = $post['booktitle'];
		
		$featured = $post['featured'];
		$price = $post['price'];
		$banner = $post['banner'];
		$abstract = $post['abstract'];
		$long_desc = $post['lngdesc'];
		$attachment = $post['attch'];
		$tags = $post['tg'];
		$sellernote = $post['selnote'];
		$sellerid = $post['selid'];
		$views = $post['vws'];
		$downloads = $post['dwnld'];
		$status = $post['st'];

		

		$update_id = $bookobj->modify_category($bookid,$booktitle,$featured,$price,$banner,$abstract,$long_desc,$attachment,$tags,$sellernote,$sellerid,$views,$downloads,$status);
							// print_r($update_id); exit;

		if($update_id){
			$result = array('code'=>'00','bookid' =>  $bookid, 'status'=> $status, 'message'=> $update_id );
		}
		if($update_id == array(FALSE)){
			
			$result = array('code'=>'01','message' => 'No Book Found In CATEGORY with such Book Id', 'status'=> $update_id);
		}
	}

	if ($post['p_o'] == 'g_58') {
	
		$bookid = $post['bk'];
		$delete_id = $bookobj->delete_category($bookid);
		if ($delete_id == array(true)) {
			$status = '1';
			$result = array('code' => '00', 'book id' => $bookid, 'status' => $status, 'message' => $delete_id);
		}
		if ($delete_id == array(false)) {
			$result = array('code' => '01', 'message' => 'No Book Found In CATEGORY with such book id');
		}
	}

	//exams for getting exams 
	if ($post['p_o'] == 'g_59') {
	//for getting all exams 
		$exam_run = $bookobj->get_exam();
		// print_r($exam_run); exit();
		if ($exam_run) {
			$status = '1';

			$result = array('code' => '00','status' => $status, 'message' => $exam_run);
		}
		if ($exam_run == array(false)) {
			$result = array('code' => '01', 'message' => 'No Exam Found In Exams ');
		}
	}

	if ($post['p_o'] == 'g_60') {
	//for getting all by exam id 
		$examid = $post['ex'];
		$exam_id_run = $bookobj->get_exam(FALSE,$examid);
		// print_r($exam_run); exit();
		if ($exam_id_run) {
			$status = '1';

			$result = array('code' => '00','Exam id'=>$examid, 'status' => $status, 'message' =>$exam_id_run );
		}
		if ($exam_id_run == array(false)) {
			$result = array('code' => '01', 'message' => 'No Exam Found In Exams with such exam id');
		}
	}
	//inserting exams 
	if ($post['p_o'] == 'g_61') {
	//for getting all by exam id 
		$exam_name = $post['na'];
		$exam_id = $post['in'];
		$exam_in_run = $bookobj->insert_exam(TRUE,FALSE,$exam_name,$exam_id,
				FALSE,FALSE,FALSE,FALSE,FALSE,FALSE,FALSE,FALSE);
		
		if ($exam_in_run) {
			$status = '1';
			// print_r($exam_in_run); exit();
			$result = array('code' => '00','Exam id'=>$exam_id, 'status' => $status, 'message' =>$exam_in_run );
		}
		if ($exam_in_run == array(false)) {
			$result = array('code' => '01', 'message' => ' Exam_ID Already Exists');
		}
	}
	//for getting random numbers without any check 
	if ($post['p_o'] == 'g_62') {
		// $questionid = $post['qs'];
		$conn = mysqli_connect('localhost','root','','xtraclass');
		$se = "SELECT MAX(question_id) from questions";
		$se_query = mysqli_query($conn,$se);
		//trying to fetch numbers
		$user_data = mysqli_fetch_assoc($se_query);
			foreach ($user_data  as $key => $value) {
				# code...
				$value;
			}		
		$questionid = rand(1,$value);
		//for getting random numbers 
		$question_id_run = $bookobj->get_exam(FALSE,FALSE,$questionid);
		// print_r($question_id_run); exit();
		if ($question_id_run) {
			$status = '1';

			$result = array('code' => '00','question id'=>$questionid, 'status' => $status, 'message' =>$question_id_run );
		}
		if ($question_id_run == array(false)) {
			$result = array('code' => '01', 'message' => 'No question Found In questions with such question id');
		}
	}

	//inserting questions 
	if ($post['p_o'] == 'g_63') {
	//for getting all by exam id 
		$question_name = $post['na'];
		$exam_id = $post['ex'];
		$question_id = $post['in'];
		$question = $post['qn'];
		$optiona = $post['oa'];
		$optionb = $post['ob'];
		$optionc = $post['oc'];
		$optiond = $post['od'];
		$answer = $post['aw'];

		$question_in_run = $bookobj->insert_exam(FALSE,TRUE,FALSE,$exam_id,
				$question_name,$question_id,$question,$optiona,$optionb,$optionc,$optiond,$answer);
		
		if ($question_in_run) {
			$status = '1';
			// print_r($question_in_run); exit();
			$result = array('code' => '00','question id'=>$question_id, 'status' => $status, 'message' =>$question_in_run );
		}
		if ($question_in_run == array(false)) {
			$result = array('code' => '01', 'message' => ' Question_ID Already Exists');
		}
	}
	//inserting Answers where user id = that specific user and question id = $question id 
	if ($post['p_o'] == 'g_64') {
	
		
		$exam_id = $post['ex'];
		$question_id = $post['in'];
		$answer = $post['aw'];
		$user_id = $post['ui'];

		$question_in_run = $bookobj->insert_exam(FALSE,FALSE,FALSE,$exam_id,
				FALSE,$question_id,FALSE,FALSE,FALSE,FALSE,$answer,TRUE,$user_id);
	
		if ($question_in_run) {
			$status = '1';
			// print_r($question_in_run); exit();
			$result = array('code' => '00','question id'=>$question_id, 'status' => $status, 'message' =>$question_in_run );
		}
		if ($question_in_run == array(false)) {
			$result = array('code' => '01', 'message' => ' Question with Question_ID ' . $question_id .' Already Answered by user ' . $user_id);
		}
	}
	// --- i just want to insert answers to db where user_id = user_id and 
		// question_id  = $question_id and `exam_status` = '$exam_status';
		if ($post['p_o'] == 'g_65') {
	
		
		$exam_id = $post['ex'];
		$question_id = $post['in'];
		$answer = $post['aw'];
		$user_id = $post['ui'];
		$exam_status = '1';
		

		// public function insert_exam(
		// 		$examid=FALSE,
		// 		$questionid=FALSE,$exam_name=FALSE,$exam_id=FALSE,
		// 		$question=FALSE,$question_id=FALSE,
		// 		$optiona = FALSE,$optionb = FALSE,$optionc = FALSE,
		// 		$optiond = FALSE ,$answer = FALSE,
		// 		$answerid = FALSE,$user_id = FALSE,$ans_status=FALSE,
		// 		$time_id = false, $exam_status = FALSE){
		$time_id = $bookobj->gen_no($exam_id,$exam_status);
		// print_r($time_id);exit();
		$question_in_run = $bookobj->insert_exam(FALSE,FALSE,FALSE,$exam_id,
				FALSE,$question_id,FALSE,FALSE,FALSE,FALSE,$answer,FALSE,$user_id,TRUE,
				$time_id , $exam_status );
	
		if ($question_in_run) {
			$status = '1';
			// print_r($question_in_run); exit();
			$result = array('code' => '00','question id'=>$question_id, 'status' => $status, 'message' =>$question_in_run );
		}
		if ($question_in_run == array(false)) {
			$result = array('code' => '01', 'message' => ' Question with Question_ID ' . $question_id .' Already Answered by user ' . $user_id);
		}
	}
	//---- 
	//get questions with respect to the 
		// userid 
		// exam id and 
		// question id 
	if ($post['p_o'] == 'g_66') {
		// $questionid = $post['qs'];
		// $conn = mysqli_connect('localhost','root','','xtraclass');
		// $se = "SELECT MAX(question_id) from questions";
		// $se_query = mysqli_query($conn,$se);
		// //trying to fetch numbers
		// $user_data = mysqli_fetch_assoc($se_query);
		// 	foreach ($user_data  as $key => $value) {
		// 		# code...
		// 		$value;
		// 	}		
		// $questionid = rand(1,$value);
		//for getting random numbers
		// i have to loop through all the values in the selected items 
		// and check if the values match the 
		$question_id_run = $bookobj->get_exam(FALSE,FALSE,FALSE,TRUE,FALSE);
		// print_r($question_id_run); exit();
		if ($question_id_run) {
			$status = '1';

			$result = array('code' => '00', 'status' => $status, 'message' =>$question_id_run );
			// print_r($result);
		}
		if ($question_id_run == array(false)) {
			$result = array('code' => '01', 'message' => 'No question Found In questions with such question id');
		}
	}
	// this for updating the exam status at the beginning if the exam 
	// i.e from 0 which means question has been answerd to 1 
	//for starting or stopping prep test prep test 
	if($post['p_o'] == 'g_67'){
		// for starting prep test 
		// exam status changes to 1
		//to end prep test 
		//exam status cheanges to 0 
		$user_id = $post['ui'];
		$exam_status = $post['es'];
		$exam_id = $post['ex'];
		$time_id = $bookobj->gen_no($exam_id,$exam_status) + 1;//increases the time_id by one each time prep test is started
		

		$update_id = $bookobj->modify_category(false,false,false,false,false,false,false,false,false,false,false,false,false,false,TRUE,$time_id,$user_id,$exam_status,$exam_id);
							// print_r($update_id); exit;

		

		if($update_id){
			$result = array('code'=>'00','User Id' =>  $user_id, 'Exam status'=> $exam_status, 'message'=> $update_id );
		}
		if($update_id == array(FALSE)){
			
			$result = array('code'=>'01','message' => ' User cannot write exams ', 'status'=> $update_id);
		}
	}
 	
if($result){echo json_encode($result);}else{
	die();
}


?>