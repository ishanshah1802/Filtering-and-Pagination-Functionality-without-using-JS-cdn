<?php

include 'connection.php';

$start = 0;
$end = 5;
if(isset($_POST["page_number"])){
    $page_number = $_POST["page_number"];
    $page_number_less = $page_number - 1;
    $start = $page_number_less * $end;
}

$search_string = " ";

if(isset($_POST["search"])){
    $search = $_POST["search"];
    if($search != ""){
        $search_string .= " AND (emp_id LIKE '%$search%' OR emp_name LIKE '%$search%' OR start_date LIKE '%$search%' OR end_date LIKE '%$search%' OR emp_category LIKE '%$search%') ";
    }
}

$search_start_date = $_POST['search_start_date'];
$search_end_date = $_POST['search_end_date'];
$employee_category = $_POST['employee_category'];
$financial_year = $_POST['financial_year'];

if($search_start_date != ""){
    $search_string .= " AND `start_date` >= '$search_start_date' ";
}
if($search_end_date != ""){
    $search_string .= " AND end_date <= '$search_end_date' ";
}
if($employee_category != ""){
    $search_string .= " AND emp_category='$employee_category' ";
}

if($financial_year != ""){
    if($financial_year == "TY"){
        $financial_year_start = date('Y') . '-04-01';
        $financial_year_end = (date('Y') + 1) . '-03-31';
        $search_string .= " AND `start_date`='$financial_year_start' AND `end_date`='$financial_year_end' ";
    } elseif($financial_year == "LY"){
        $financial_year_start = (date('Y') -1) . '-04-01';
        $financial_year_end = date('Y') . '-03-31';
        $search_string .= " AND `start_date`='$financial_year_start' AND `end_date`='$financial_year_end' ";
    }
}

$fetch_num_rows = "SELECT * FROM employee_details WHERE is_active='Y' " . $search_string;
// echo $fetch_num_rows;
$query = mysqli_query($conn, $fetch_num_rows);
$no_rows = $query->num_rows;

$pages = ceil($no_rows / $end);

$fetch_data = "SELECT * FROM employee_details WHERE is_active='Y' " . $search_string . " LIMIT $start, $end ";
// echo $fetch_data;
$query_result = mysqli_query($conn, $fetch_data);

if($query_result->num_rows > 0){
    $fetch_data_result = array();
    while ($row =  mysqli_fetch_assoc($query_result)) {
        $data_array['emp_id'] = $row['emp_id'];
        $data_array['emp_name'] = $row['emp_name'];
        $data_array['start_date'] = $row['start_date'];
        $data_array['end_date'] = $row['end_date'];
        $data_array['emp_category'] = $row['emp_category'];
        array_push($fetch_data_result, $data_array);
    }
    // print_r($fetch_data_result);
    print(json_encode(array('status' => true, 'message' => 'Data has been fetched', 'start' => $start, 'num_rows' => $no_rows, 'pages' => $pages, 'response' => $fetch_data_result)));
} else {
    die(json_encode(array('status' => false, 'message' => 'No Record Found')));
}

?>