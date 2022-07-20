<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
// include database and object files
include_once 'connection.php';
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id']) && !isset($data['image_url']) && !isset($data['judul']) &&
!isset($data['konten']) && !isset($data['penulis']) && !isset($data['editor']) && !isset($data['url_berita']))
{
 http_response_code(404);
 
 die(); // receiving the post params
} else {
 $id = $data['id'];
 $image_url = $data['image_url'];
 $judul = $data['judul'];
 $konten = $data['konten'];
 $penulis = $data['penulis'];
 $editor = $data['editor'];
 $url_berita = $data['url_berita'];

 $query = "UPDATE data SET `image_url` = '$image_url', `judul` = '$judul',
`konten`='$konten', `penulis`='$penulis', `editor`='$editor', `url_berita`='$url_berita' WHERE `id` = '$id'";
$result = mysqli_query($conn, $query);
 if ($result){
 $conn->close();
 $response['status'] = 0;
 $response['message'] = "Update berhasil";
 http_response_code(200);
 echo json_encode($response);
 print($response);
 return;
 }
 else {
 $conn->close();
 $response['status'] = 1;
 $response['message'] = "Update gagal";
 http_response_code(404);
 echo json_encode($response);
 print($response);

 }

}
?>