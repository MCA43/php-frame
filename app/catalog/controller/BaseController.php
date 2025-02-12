<?php

namespace App\Catalog\Controller;

use System\Engine\Controller;

class BaseController extends Controller {

    public function index(): void {
        $this->data["title"] = "PHP FRAME";

        $this->data["about"] = [
            'title' => 'PHP Frame Hakkında',
            'description' => [
                '<a href="http://github.com/elfesyaesen/php-frame/" target="_blank"> http://github.com/elfesyaesen/php-frame/ </a> Adresindeki temel yapı üzerine geliştirilmiş başlangıç kiti.',
                'Hızlı bir şekilde proje geliştirmek için başlangıç kiti olarak hazırlandı.',
                'Kurulum yapıldıktan sonra hızlı bir şekilde proje geliştirmek için gerekli temel yapı hazırlandı.',
                'Başlangıç İçin <a href="'.base_url('kurulum').'">Yapmanız Gerekenler</a>'
            ]
        ];

        $this->data["feature"] = [
            'title' => 'Eklenen Özellikler',
            'list' => [
                '<a href="https://github.com/EFTEC/BladeOne" target="_blank">Blade motoru</a> entegre edildi.',
                'Auth temel işlemleri eklendi. Tasarım için <a href="https://github.com/MCA43/custom-auth-html" target="_blank">teması</a>  (kayit, giris ve oturum açma formu ve işlemleri)',
                'Hızlı Kullanım İçin Bazı Mzellikler Eklendi (profil, profil resmi düzenleme, kullanıcı listesi, kullanıcı ekleme, kullanıcı düzenleme, kullanıcı silme ve log kaydı)',
                'Log işlemleri için hazır function yazıldı.',
                'Resim işlemleri için <a href="https://github.com/claviska/SimpleImage" target="_blank">claviska/SimpleImage</a> kütüphanesi entegre edildi.',
                'Temel veritabanı işlemleri için <a href="https://github.com/etxahun/php_oop_crud_pdo_mysql/blob/master/dbclass.php">pdo class</a> örnek alınarak projeye uyarlandı.',
                'Dizin ve Dosya Yapısı Değiştirildi.',
            ]
        ];

        echo $this->view("catalog.index", $this->data);
    }

    public function start(): void {
        $this->data["title"] = "PHP FRAME";

        $this->data["about"] = [
            'title' => 'Başlamak İçin Yapmanız Gerekenler',
            'description' => [
                'Ana Dizinde Bulunan config.php dosyasında veritabanı (database) işlemleri için gerekli alanları doldurun.',
                'Ana Dizinde Bulunan config.php dosyasında define alanlarını düzeltin.',
                'Veritabanı oluşturun.',
                'Veritabanına users ve logs adında iki tablo ekleyin',
                '<b>users:</b>
                    <br>[id => int] 
                    <br>[role_id => int] 
                    <br>[image => varchar 100 default=default-user.png] 
                    <br>[firstName => varchar 100] 
                    <br>[lastName => varchar 100] 
                    <br>[fullName => varchar 200] 
                    <br>[userName => varchar 50] 
                    <br>[email => varchar 250] 
                    <br>[gender => varchar 50, default=man] 
                    <br>[password => varchar 255] 
                    <br>[status => varchar 50, default=PENDING] 
                    <br>[ip_address => varchar 50, nullable] 
                    <br>[uniq_code => text 50] 
                    <br>[user_code => text 50, nullable] 
                    <br>[last_login_date => datetime, nullable] 
                    <br>[created_at => datetime] 
                    <br>[updated_at => datetime]
                    <br>[deleted_at => datetime]',
                '<b>logs:</b>  
                    <br>[id => int] 
                    <br>[user_id => int] 
                    <br>[ip_address => varchar 50] 
                    <br>[module => varchar 150] 
                    <br>[action => varchar 150] 
                    <br>[description => longtext] 
                    <br>[created_at => datetime] 
                    <br>[updated_at => datetime, nullable]',
            ]
        ];

        echo $this->view("catalog.start", $this->data);
    }

    public function pageNotFound(): void {
        $this->data["title"] = "404 - Sayfa Bulunamadı";

        echo $this->view("page-notfound", $this->data);
    }

}
