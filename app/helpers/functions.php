<?php

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


function fileupload($Image,$path,$width='',$height='',$customname='')
{
 // same file server
 if (!file_exists(env('FILE_PATH').$path)) {
    File::makeDirectory(env('FILE_PATH').$path, 0777, true, true);
}

 $position = strpos($Image, ';');
$sub = substr($Image, 0, $position);
$ext = explode('/', $sub)[1];
$random = rand(10000,99999);
if($customname!=''){
$name = time().'____'.$customname.'.'.$ext;
}else{
$name = time().'____'.$random.'.'.$ext;
}
$upload_path = $path;
$image_url = $upload_path.$name;

if($width=='' && $height==''){

    $img = Image::make($Image);
}else{

    $img = Image::make($Image)->resize($width, $height);
}



 $img->save(env('FILE_PATH').$image_url);
 return $image_url;

    // separate file server
// $url = env('FILE_SERVER');
// $curl = curl_init($url);
// curl_setopt($curl, CURLOPT_URL, $url);
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// // $headers = array(
// //    "Content-Type: application/json",
// // );
// // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
// $data = ["files"=> $Image,'customname'=>$customname,'path'=>$path,'width'=>$width,'height'=>$height];
// curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
// $resp = curl_exec($curl);
// curl_close($curl);
// return json_decode($resp);











}





  function tmpToBase64($temp,$path='',$width='',$height='',$customname='')
 {
    // return $temp->getClientOriginalExtension();



$errors=array();
$allowed_ext= array('jpg','jpeg','png','gif');
$file_name =$temp->getClientOriginalName();
//   $file_name =$_FILES['image']['tmp_name'];
$file_ext = $temp->getClientOriginalExtension();


 $file_size=$temp->getSize();
$file_tmp= $temp;
// echo $file_tmp;echo "<br>";

 $type = pathinfo($file_ext, PATHINFO_EXTENSION);
$data = file_get_contents($file_tmp );
$base64 = 'data:image/' .$file_ext . ';base64,' . base64_encode($data);


return  fileupload($base64,$path,$width,$height,$customname);



 }


