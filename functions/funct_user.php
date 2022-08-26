<?php
function register_user($nama,$pw) {
    global $koneksi;
    $nama  = mysqli_real_escape_string($koneksi,$nama);
    $pw = mysqli_real_escape_string($koneksi,$pw);
    $pw = password_hash($pw,PASSWORD_DEFAULT);
    $query = "INSERT INTO daftar_user (username, password) VALUES ('$nama', '$pw')";
    if(mysqli_query($koneksi,$query)) {
        return true;
    } else {
        return false;

    }

}

function register_cek_nama($nama) {
    global $koneksi;
    $nama  = mysqli_real_escape_string($koneksi,$nama);
    $query = "SELECT username FROM daftar_user WHERE username='$nama' ";
    if($result = mysqli_query($koneksi,$query)) {
        if(mysqli_num_rows($result) == 0) {
            return true;
        } else {
            return false;
        }
    }


}

function cek_data($nama,$pw) {
    global $koneksi;
    $nama  = mysqli_real_escape_string($koneksi,$nama);
    $pw = mysqli_real_escape_string($koneksi,$pw);
    $query = "SELECT password FROM daftar_user WHERE username='$nama'";
    $result = mysqli_query($koneksi,$query);
    $get_pw = mysqli_fetch_assoc($result);
    if(password_verify($pw,$get_pw['password'])) {
        return true;
    } else {
        return false;
    }
}

function login_cek_nama($nama) {
    global $koneksi;
    $nama  = mysqli_real_escape_string($koneksi,$nama);
    $query = "SELECT username FROM daftar_user WHERE username='$nama' ";
    if($result = mysqli_query($koneksi,$query)) {
        if(mysqli_num_rows($result) != 0) {
            return true;
        } else {
            return false;
        }
    }
}

function cek_tingkat($nama) {
    global $koneksi;
    $query = "SELECT tingkat FROM daftar_user WHERE username='$nama'";
    $result = mysqli_query($koneksi,$query);
    $get = mysqli_fetch_assoc($result)['tingkat'];
    return $get;
    
}

function cek_role() {
    global $koneksi;
    $query = "SELECT * FROM daftar_user WHERE tingkat=1 ";
    $result = mysqli_query($koneksi,$query);
    return $result;
}

function get_info_per_user($id) {
    global $koneksi;
    $query = "SELECT * FROM daftar_user WHERE id=$id ";
    $result = mysqli_query($koneksi,$query);
    $get = mysqli_fetch_assoc($result);
    return $get;
}

?>