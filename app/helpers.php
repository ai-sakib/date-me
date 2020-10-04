<?php

function getAge($birthDate){
  //date in yyyy-mm-dd format; or it can be in other formats as well
  $birthDate = explode("-", $birthDate);
  //get age from date or birthdate
  return $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
    ? ((date("Y") - $birthDate[0]) - 1)
    : (date("Y") - $birthDate[0]));
}

function fileInfo($file)
{
    if(isset($file)){
        return $image = array(
            'name' => $file->getClientOriginalName(), 
            'type' => $file->getClientMimeType(), 
            'width' => getimagesize($file)[0], 
            'height' => getimagesize($file)[1], 
            'extension' => $file->getClientOriginalExtension(), 
        );
    }else{
        return $image = array(
            'name' => '0', 
            'type' => '0', 
            'width' => '0', 
            'height' => '0', 
            'extension' => '0', 
        );
    }
}
function fileUpload($file,$destination,$name)
{
    $upload=$file->move(public_path('/'.$destination), $name);
    return $upload;
}

function getfileSize($size)
{
	if($size<1024){
		$size=$size.' KB';
	}elseif($size>=1024){
		$size=number_format((float)($size/1024), 2, '.', '').' MB';
	}else{
		$size='Unknown Size';
	}
	return $size;
}