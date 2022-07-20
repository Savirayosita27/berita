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
if (!isset($data['image_url']) && !isset($data['judul']) &&
!isset($data['konten']) && !isset($data['penulis']) && !isset($data['editor']) && !isset($data['url_berita']))
 die(); // receiving the post params
else
{
 $image_url = $data['image_url'];
 $judul = $data['judul'];
 $konten = $data['konten'];
 $penulis = $data['penulis'];
 $editor = $data['editor'];
 $url_berita = $data['url_berita'];
 

 $query = "Select data FROM db_berita WHERE `image_url` = '$image_url' or `judul` =
'$judul'";
 $result = mysqli_query($conn, $query);

 $row = mysqli_fetch_assoc($result);
 if ($row != null){
 $response['status'] = 0;
 $response['message'] = "Nama sudah terdaftar, silahkan login
menggunakan email " . $row["email"];
 http_response_code(201);
 echo json_encode($response);
 return;
 }
 else {
 $query = "INSERT INTO data(image_url, judul, konten, penulis, editor, url_berita) VALUES (
'$image_url', '$judul', '$konten', '$penulis', '$editor', '$url_berita')";
 if ($conn->query($query) === TRUE){
 $conn->close();
 $response['status'] = 0;
 $response['message'] = "Register Data baru telah berhasil
didaftarkan";
 http_response_code(200);
 echo json_encode($response);
 }
 else {
 $conn->close();
 $response['status'] = 1;
 $response['message'] = "Register Data baru gagal";
 http_response_code(404);
 echo json_encode($response);
 }
 }

}
?>