SpreadOut Project
-----------------

SpreadOut este o aplicatie in categoria SmartCity care vine in ajutorul cetatenilor unui oras sa raporteze nereguli sau sa inainteze o propunere atat Autoriatatilor Locale cat si catre Compani, prin intermediul unei interfete Elegante dar si Usoare de folosit. Serviciul este disponibil atat printr-un Portal Web cat si pe Mobile in format Cross-Platform.
Noi credem in initiativa Datelor Deschise: SpreadOut ofera si un API Public, facilitand crearea de aplicatii care sa foloseasca unui Oras Inteligent!

Acest proiect a fost dezvoltat la HackTM in Timisoara (17-19 Octombrie) unde a fost bine acceptat.


Server Solution
---------------

Orice aplicatie SmartCity trebuie sa fie capabila _sa reziste_!
SpreadOut Server este gandit in acest scop, fiind capabil sa serveasca un numar mare de requesturi. Baza de Date este special planificata spre a executa query-uri rapide, atat pentru Frontend cat si pentru API-ul Public.

Server-ul este scris in PHP folosind popularul Framework Laravel versiunea 5. Baza de Date foloseste MySQL.


Frontend Solution
-----------------

Acest serviciu poate fi accesat de utilizatori (cetateni) prin intermediul unei aplicatii web.

Portalul Web permite inrolarea fiecarui utilizator in sistem, ulterior permitandu-i sa participe la construirea imaginii unei firme prin sugestii si reclamatii.

Aplicatia are un aspect foarte prietenos si intuitiv, utilizatorul fiind nevoit sa urmeze un numar mic de click-uri pentru a ajunge la informatia pe care o doreste. Mentionam faptul ca sunt folosite fisiere de limba, astfel ca oricand se pot adauga traduceri multiple pentru ca website-ul sa fie utilizat oriunde in lume.

Pentru realizarea aplicatiei web s-a folosit HTML, CSS, si JavaScript, utilizand cateva librarii cunoscute: Twitter Bootstrap, AngularJS, Bower.


Utilizare
---------------
Sa ne imaginam urmatorul scenariu:

Intr-o zi ma aflu in incinta unui punct de lucru al companiei X pentru a-mi rezolva o problema referitoare la serviciile oferite de ei, servicii la care sunt abonat, servicii pentru care platesc. Mersul unei companie implica multi factori precum: igiena, personalul / angajatii, calitate servicii sau produse, timp, conditii… lucruri de care, la un moment dat, poate ma nemultumesc, iar conditiile din prezent nu ne permit sa ne manifestam aceste nemultumiri prea usor. De multe ori e necesar sa apelezi la serviciul de reclamatii, unde probabil personalul lipseste (e intr-o lunga pauza de masa), de multe ori probleme se rezolva prin simpla inregistrare a unei cereri/plangeri, urmata de “Vom citi si ne vom stradui”.

Aici intervine aplicatia noastra!

Cat de simplu ar fi, ca utilizatorii sa poata sa publice aceste probleme online?! Ar fi foarte interesant sa vedem cum probabil si alti cetateni se gasesc in aceeasi situatie, si vor sa-si exprime nemultumirea, dar nu au timp si nervi pentru a incepe demersul unei plangeri. In ziua de astazi, online e mai simplu!
Totodata, aceste reclamatii si sugestii, vor crea o “imagine virtuala” a companiei, astfel ca, cei aflati in cauza vor fi motivati sa-si corecteze partile negative.

Utilizatorii obisnuiti vor putea accesa portalul nostru, vor putea selecta compania dorita, iar apoi pot sa-si exprime o nemultumire, o sugestie sau chiar sa poarte scurte discutii (chiar si de apreciere).

Cererile, plangerile si reclamatiile sunt organizate intr-un sistem de “ticketing”, asadar vor ajunge in atentia companiei. Compania poate gestiona toate acestea si le poate prezenta foarte frumos printr-o reprezentare de tipul Agile Board (planuri de viitor, lucruri care trebuiesc facute, lucrurile la care lucram in momentul de fata si lucruri care au fost finalizate). In acest fel speram sa avem un oras mai organizat, sa devenim o tara mai buna.


Mobile Solution
---------------

Toti suntem din ce in ce mai mobili. SpreadOut Mobile este gandit pentru cei care sunt tot timpul in miscare.
Aceasta eleganta aplicatie Cross-Platform (Android, iOS, Windows Phone, etc.) permite utilizatorului sa Vizualizeze si sa Posteze plangeri dar si propuneri direct de oe Telefon sau Tableta!

SpreadOut Mobile utilizeaza ca baza PhoneGap 3.5 impreuna cu Framework-urile Angular JS si Ionic 1.0.


Public API
----------

Noi credem in initiativa Datelor Deschise, in acest scop, SpreadOut include un RESTful API Public care permite accesarea Datelor noastre de catre developeri dornici de a crea aplicatii pentru un oras al viitorului.

Pentru dezvoltatori este mult mai simplu insa sa foloseasca o Librarie. Din acest motiv API-ul Publkic este disponibil si in format _Microsoft Portable Library_ pentru libajele C# si VB.NET compatibila cu:
<ul>
  <li>.NET 4+</li>
  <li>Windows 8+</li>
  <li>Windows Phone 8+</li>
  <li>Silverlight 5</li>
  <li>etc.</li>
</ul>
Aceasta este doar in inceput insa, noi dorim sa oferim o astfel de Librarie pentru cat mai multe limbaje de programare!
