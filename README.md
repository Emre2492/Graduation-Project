# Graduation-Project
 UZ-EM+
 
Projenin Amacı ve Kapsamı:

Bizim bitirme projesi olarak UZEM+’i seçmemizin sebebi, okulumuzun Uzem/Öbs sisteminin yeterli verimlilikte ve görsellikte olmamasındandır. Bu yüzden biz de hem Uzem hem de Öbs sisteminin beraber olduğu bir sistem geliştirmek istedik. Böylece, öğrencileri ve öğretim görevlilerin başka ortamlarda daha uzun sürede ve daha zor bir şekilde yapacağı işlerini tek bir sitede daha hızlı ve kolay yapmasını sağlamak istedik.
Ders ekleme/çıkarma, ödev yükleme, anket yapma, kütüphane, randevu alma gibi birçok ekstra özelliğiyle aslında bir Uzem’den çok daha fazlasını içinde barındırdığı için sitemize UZ-EM+ adını verdik.
Veri Tabanı İçeriği:
Veri tabanımızda kullanıcı olarak öğrenci ve öğretim görevlilerinin bilgileri ve bunların yapabildikleri tablolar halinde tutulmaktadır. Öğretim görevlileri arasında da bir hiyerarşik bir sistem oluşturduk ve en yetkili olarak rektörü belirledik. Rektörün altındaki rütbeler ise sırasıyla dekan, bölüm başkanı ve akademisyen şeklinde oldu. Öğrenciler numara, akademisyenler ise mail adresi ile giriş yapacak şekilde ayarladık.
Ayrıca, eklenmesi için dersler, duyurular, ödevler, anketler; randevu için çalışma odaları, kiralanması için kitaplar için tablolar tutulmaktadır.

Görev Dağılımları:

Hiyerarşik yapımızın en önemli özelliği tabiki her özelliği her akademisyenin yapamamasıdır. Bu yüzden Rektörü sistemin en yetkilisi seçtik. Yani fakülte, bölüm, kitap, duyuru, anket, ödev ekleme gibi sitemizin genel özelliklerini kullanabiliyor. Ayrıca bölüm başkanını atama, dekan atama, yeni öğrenci ve çalışan ekleme, çalışanların unvanlarını değiştirebilme ve tüm kullanıcıların loglarını listeleyip inceleme gibi yetkilere de sahiptir.
Dekan, Rektörden farklı olarak fakülte, yeni öğrenci/çalışan ekleme, ders ekleme yapamıyor, ancak bölüm ekleme yapabiliyor ve bölüm listesine erişebiliyor bu listeden bölüm düzenleme silme işlemlerini gerçekleştirebiliyor. Duyuru ve anket açabiliyor, diğer özellikleri de aynı şekilde kullanabiliyor. Eğer dekan ders veriyor ise dersle ilgili ödevi ve sadece hangi dersi veriyor ise o derse özel duyuru yapabiliyor. Derse kaydolmak isteyen öğrencileri onaylıyor. Dersin notlarını, slaytlarını ekliyor. Derse özel anket yapabiliyor ve öğrenciler bunu sadece dersin profil sayfasındaki anket kısmından görebiliyor. Ders programını belirliyor.
Bölüm Başkanı, dersi açan kişi oluyor. Dersi kimin vereceğini belirliyor. Dekandan farklı olarak kitap ekleme yapamıyor. Bölümle ilgili duyuru ve anket açabiliyor. Eğer bölüm başkanı ders veriyor ise dersle ilgili ödevi ve sadece hangi dersi veriyor ise o derse özel duyuru yapabiliyor. Derse kaydolmak isteyen öğrencileri onaylıyor. 
Dersin notlarını, slaytlarını ekliyor. Derse özel anket yapabiliyor ve öğrenciler bunu sadece dersin profil sayfasındaki anket kısmından görebiliyor. Ders programını belirliyor.

Akademisyen, dersle ilgili ödevi ve sadece hangi dersi veriyor ise o derse özel duyuru yapabiliyor. Derse kaydolmak isteyen öğrencileri onaylıyor. Dersin notlarını, slaytlarını ekliyor. Derse özel anket yapabiliyor ve öğrenciler bunu sadece dersin profil sayfasındaki anket kısmından görebiliyor. Ders programını belirliyor.
Öğrenci ise bölümündeki dersleri seçebiliyor, verilen ödevi sisteme yükleyebiliyor, derse özel anket yapabiliyor. Ayrıca dersi alan diğer öğrencilerle mesajlaşabiliyor.
Bazı Önemli Bilgiler:
- Çalışma odası için özel bir trigger yazdık ve her yeni haftada pazartesi günü bu sistem sıfırlanıyor. Ayrıca her unvanın ayrı çalışma odası sistemi vardır.
- Arama çubuğunda kitap no/adı ve ders adı aratılabiliyor(ders koduna göre değil, adına göre).
-Kütüphanede kitap kiralama kısmında bulunan bir arama çubuğumuz daha bulunmaktadır, bu çubuk ise kitap kiralama kısmında kitap aramak için kullanılmaktadır, bu şekilde hem normal arama çubuğu hem de kitap aramak için özel bir arama çubuğu yaptık. Bu şekilde kullanıcıya hangisi daha kolay geliyorsa onu tercih edebilmektedir.
- Mesajlaşma sadece öğrenciler arasında yapılabilmektedir. Ortak ders alanların listesinden istenen öğrenci seçilip oradan mesaj gönderilebilir.
-Öğrenciler arasında gerçekleştirilen mesajlaşmalar getTimestamp kullanımı yöntemi ile 60 günde bir silinmektedir.
-Ödevi akademisyen ekliyor ancak ödev ile ilgili dosya ekleyemiyor, ödevin açıklamasını veriyor. Buna karşın öğrenci ödevi bitirmek için istediği dosyayı sisteme yükleyebiliyor ve dersi veren hoca(akademisyen, rektör, dekan, bölüm başkanı) sistemden öğrencinin ödev notunu girebiliyor.
-Sistemimiz de Zoho mail server kullandık.
-Mail Server Nedir ?	
Mail Server (Mail Sunucusu), kullanıcılar için tüm elektronik postaları bir ağ üzerinde tutan uzaktaki veya merkezi sunucudur. İki farklı kategori altında incelenir. Bunlar; gönderi sunucuları ve alıcı sunucularıdır. Gönderi sunucuları olarak en çok bilinen e-mail sunucusu SMTP veya Simple Mail Transfer Protocol olarak bilinen sunuculardır. 
Alıcı sunucu olarak ise POP3 veya Post Office Protocol 3 ya da IMAP yani İnternet Message Access Protocol sunucuları kullanılmaktadır. IMAP veya POP3 sunucu protokolleri mesajlara dair bir kopyayı her zaman sunucu üzerinde de saklayabilme özelliğine sahiptir.


SMTP Sunucu

SMTP veya Simple Mail Transfer Protocol, 25 numaralı port çıkışını kullanarak elektronik postalar göndermeye yardımcı olan internet standardıdır. Bu sunucu yardımıyla elektronik postalar tıpkı normal mektuplar gibi benzer bir aşamayı takip ederek hedef adresine ulaştırılırlar;
•	Mesajınızı hazırlayıp e-postayı göndermek istediğiniz e-posta programınız SMTP sunucusuna bağlanır.
•	SMTP sunucusu, mail istemci yazılımınızla irtibata geçerek sizin e-posta adresinizi, mailin ulaştırılacağı adresi, mailin mesajını ve ek dosyalarını alır.
•	Bu bilgileri işledikten sonra SMTP sunucusu eğer mail adresi aynı alan adına sahipse hemen (Gmail’den Gmail’e gibi) farklı bir alan adına sahipse de POP3 veya IMAP sunucusu yardımıyla postayı  karşıya göndermeye başlar.
•	Karşıdaki kullanıcının SMTP sunucusuyla ve DNS’i ile kurulan irtibat sonrasında DNS verisi IP adresine dönüştürülür 
•	Son aşamada da karşı sunucuya tekrardan irtibata geçilip elektronik postanın hedef adrese iletilmesi sağlanır.
 Örnek >> Rektör yeni öğrenci kaydı yaptığında kayıt edilen öğrencinin sisteme giriş yapabilmesi için öğrenci no ve şifresi mail ile gelmektedir.
Kullanıcı Tiplerimiz:
$userType = array(1 => "Rektor", 2 => "Akademisyen", 3 => "Ogrenci", 4=> "Dekan", 5=> "Bolum Baskani");

