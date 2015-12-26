<?php
//print_r($_GET);
//test the array way of doing xml
$address=array();
$address['street_number']=$_GET['street_number'];
$address['street_name']=$_GET['street_name'];

$contact=array();
$contact['tel']=$_GET['tel'];
$contact['address']=$address;

$resume=array();
$resume['name']=$_GET['name'];
$resume['contact']=$contact;
$resume['education']=$_GET['education'];


//$out=xml_to_array($resume);
//$out=generate_xml_from_array($resume, "resume");
//echo $out;


//Test the object way of doing xml
class Resume{ 
	private $name;
	private $arr_contact;
	private $education;
	public function __construct(){

	}
	public function set_name($str_name){
		$this->name=$str_name;
	}
	public function get_name(){
		return $this->name;
	}
	public function set_education($str_education){
		$this->education=$str_education;
	}
	public function get_education(){
		return $this->education;
	}

	public function set_contact($arr){
		$this->arr_contact=$arr;
	}

	public function get_resume_attributes(){
		$arr_attributes;
		$arr_attributes=get_object_vars($this);
		return $arr_attributes;
	}
}

$obj_resume=new Resume();
$obj_resume->set_name($_GET['name']);
//print_r($contact);
$obj_resume->set_contact($contact);
$obj_resume->set_education($_GET['education']);
//print_r($obj_resume);
//$out=xml_to_array($obj_resume);
//echo $out;
$arr_resume=$obj_resume->get_resume_attributes();

//print_r($arr_resume);
//loop_array($arr_resume);
//$xml_out=xml_to_array($arr_resume);
$xml_out=capsulate_xml($arr_resume, "resume");
echo $xml_out;

function loop_array($array){
	foreach ($array as $key => $value) {
		# code...
		echo $key;
		echo $value;
		echo "<br>";
	}
}

function capsulate_xml($array,$root_element){
	$xml = '<?xml version="1.0" encoding="UTF-8" ?>' . "\n";

	$xml .= '<' . $root_element . '>' . "\n";
	$xml .= xml_to_array($array);
	$xml .= '</' . $root_element . '>' . "\n";

	return $xml;

}


function xml_to_array($array)
{
	$xml="";
	if(is_array($array) || is_object($array))
	{
		foreach ($array as $key => $value) 
		{
			$xml=$xml."<".$key.">".	"\n"
								.xml_to_array($value)
						."</".$key.">"."\n";
		}
	}
	else
	{
		$xml=$array."\n";
	}
		
		
	return $xml;
}

function generate_xml_from_array($array, $node_name) {
	$xml = '';
	
	if (is_array($array) || is_object($array)) {
		foreach ($array as $key=>$value) {
			if (is_numeric($key)) {
				$key = $node_name;
			}

			$xml .= '<' . $key . '>' . "\n" . generate_xml_from_array($value, $node_name) 
			. '</' . $key . '>' . "\n";
		}
	} else {

		$xml = htmlspecialchars($array, ENT_QUOTES) . "\n";
	}

	return $xml;
}



?>