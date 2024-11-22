<? 
try{
    $baglanti = new PDO("mysql:host=localhost:3306;dbname=admin_cuzdan", "hasan_cuzdan", "Malldia@44");
    $baglanti->exec("SET NAMES utf8");
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $hata){
    echo 'Hata:rrr '.$hata->getMessage();
    die;
} 
?>