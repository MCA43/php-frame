# **PHP FRAME**

http://github.com/elfesyaesen/php-frame/ Adresindeki temel yapı üzerine geliştirilmiş başlangıç kiti.

Hızlı bir şekilde proje geliştirmek için başlangıç kiti olarak hazırlandı.

Kurulum yapıldıktan sonra hızlı bir şekilde proje geliştirmek için gerekli temel yapı hazırlandı.

---

## **Özellikler**

- **Hafif ve Hızlı:** Minimal yapısıyla yüksek performans sunar.
- **Esnek Routing:** Gelişmiş routing sistemi ile kolayca route tanımlayabilirsiniz.
- **Middleware Desteği:** Middleware'ler ile istekleri filtreleyebilir ve özelleştirebilirsiniz.
- **Controller Yapısı:** MVC mimarisi ile düzenli ve modüler kod yazımını destekler.

## **Eklenen Özellikler**

- Blade (https://github.com/EFTEC/BladeOne) motoru entegre edildi.
- Auth temel işlemleri eklendi. Tasarım için teması (https://github.com/MCA43/custom-auth-html) (kayit, giris ve oturum açma formu ve işlemleri)
- Hızlı Kullanım İçin Bazı Mzellikler Eklendi (profil, profil resmi düzenleme, kullanıcı listesi, kullanıcı ekleme, kullanıcı düzenleme, kullanıcı silme ve log kaydı)
- Log işlemleri için hazır function yazıldı. 
- Resim işlemleri için claviska/SimpleImage (https://github.com/claviska/SimpleImage) kütüphanesi entegre edildi. 
- Temel veritabanı işlemleri için pdo class (https://github.com/etxahun/php_oop_crud_pdo_mysql) örnek alınarak projeye uyarlandı. 
- Dizin ve Dosya Yapısı Değiştirildi.

---

## **Başlangıç İçin Yapmanız Gerekenler** ##
- Ana Dizinde Bulunan config.php dosyasında veritabanı (database) işlemleri için gerekli alanları doldurun.
- Ana Dizinde Bulunan config.php dosyasında define alanlarını düzeltin.
- Veritabanı oluşturun.
- Veritabanına users ve logs adında iki tablo ekleyin
---
**users:**
- [id => int]
- [role_id => int]
- [image => varchar 100 default=default-user.png]
- [firstName => varchar 100]
- [lastName => varchar 100]
- [fullName => varchar 200]
- [userName => varchar 50]
- [email => varchar 250]
- [gender => varchar 50, default=man]
- [password => varchar 255]
- [status => varchar 50, default=PENDING]
- [ip_address => varchar 50, nullable]
- [uniq_code => text 50]
- [user_code => text 50, nullable]
- [last_login_date => datetime, nullable]
- [created_at => datetime]
- [updated_at => datetime]
- [deleted_at => datetime]
---
**logs:**
- [id => int]
- [user_id => int]
- [ip_address => varchar 50]
- [module => varchar 150]
- [action => varchar 150]
- [description => longtext]
- [created_at => datetime]
- [updated_at => datetime, nullable]

---

## **Lisans**

Bu proje [MIT Lisansı](LICENSE) altında lisanslanmıştır. 

---

## **İletişim**

- **GitHub:** [elfesyaesen](https://github.com/elfesyaesen)
- **YouTube:** [Elfesya Esen](https://www.youtube.com/@elfesyaesen)
- **E-posta:** elfesyaesen@gmail.com
---

## **Teşekkürler**

PHP Frame kullandığınız için teşekkür ederiz! Daha fazla bilgi ve eğitim videoları için YouTube kanalımıza göz atmayı unutmayın: [Elfesya Esen](https://www.youtube.com/@elfesyaesen).

---
