# JeToJASne Studio

Anna Mária Chovancová

5ZYI36
## Stručný opis projektu
  JeToJASne Studio je webová aplikácia určená pre autorov spoločenských detektívnych hier typu murder mystery. Jej hlavným cieľom je zjednodušiť tvorbu herných scenárov a prípravu všetkých potrebných materiálov na jednom mieste. Autor bude môcť vytvárať hry, postavy, ich vzťahy, tajomstvá, úlohy, informácie a dôkazy a následne z týchto údajov pripravovať herné pomôcky, napríklad charakteristiky postáv (character sheets), materiály pre hráčov a organizačné podklady pre moderátora hry.

  Dôležitou funkciou aplikácie bude možnosť rozdeliť hru na jednotlivé fázy a v každej fáze samostatne spravovať dostupné informácie a dôkazy. Autor bude môcť určiť, ktoré informácie alebo dôkazy dostane konkrétna postava, ktoré budú dostupné viacerým hráčom a kedy sa majú sprístupniť, pridať alebo prestať zobrazovať. Na základe vytvoreného scenára bude možné pripraviť a exportovať materiály pre jednotlivých hráčov. Aplikácia tak zníži potrebu manuálneho vytvárania a upravovania viacerých dokumentov a pomôže udržať všetky herné materiály aktuálne a navzájom konzistentné.

## Role v projekte
1. Návštevník
  Používateľ, ktorý ešte nemá účet alebo nie je prihlásený. Môže si prezerať úvodnú stránku aplikácie, oboznámiť sa s jej účelom a zaregistrovať sa alebo prihlásiť. Nemá prístup k súkromným herným projektom.

2. Registrovaný používateľ – autor hry
  Hlavná používateľská rola aplikácie. Môže vytvárať a spravovať vlastné herné projekty, postavy, ich vzťahy, informácie, tajomstvá a dôkazy. Určuje, ktoré informácie a dôkazy sú priradené jednotlivým postavám a v ktorých fázach hry sa sprístupnia. Z vytvorených údajov pripravuje charakteristiky postáv a ďalšie herné pomôcky, ktoré môže exportovať alebo vytlačiť. Má oprávnenie upravovať a odstraňovať vlastné projekty, nie však súkromné projekty iných autorov.

3. Správca aplikácie
  Zodpovedá za správu používateľských účtov a dohľad nad správnym fungovaním aplikácie. Môže prezerať zoznam používateľov a spravovať ich účty v rozsahu pridelených oprávnení. Jeho oprávnenia sú oddelené od bežných oprávnení autorov.

## Prípady použitia podľa rolí
1. Návštevník
   - prezrie si úvodnú stránku aplikácie
   - vytvorí si používateľský účet
   - prihlási sa do používateľského účtu
  
2. Registrovaný používateľ
   - zobrazí a upraví zoznam svojich projektov
   - vytvorí si nový murder mystery projekt
   - vyplní základné informácie murder mystery projektu
   - pridá postavu alebo zoznám postáv hráčov
   - vytvorí si charakteristiky postáv
   - pridá nehrateľné postavy
   - vytvorí vzťahy medzi postavami
   - pridá dôkazy, predmety, úlohy a podozrenia
   - vytvorí jednotlivé fázy hry
   - priradí predmety, dôkazy, úlohy a podozrenia postavám a fázam hry
   - nahrá súbory, napríklad zvukový úvod alebo obrázky postáv
   - exportuje pripravené materiály pre určitú postavy (hráča) alebo organizačné materiály pre celú hru
   - vytlačí alebo uloží priložené materiály ako pdf
   - zmení stav projektu na dokončený alebo spätne na rozpracovaný
   - nahlási chybu, technický problém alebo inú nezrovnalosť v programe správcovi

3. Správca aplikácie
   - zobrazí zoznam používateľských účtov
   - spravuje používateľské účty v rozsahu svojich oprávnení
   - dohliada na bezpečné používanie aplikácie.
  
## Plánované entity
1. Používateľ (User)
   - Uchováva údaje o používateľoch aplikácie.
   - Hlavné atribúty: ID používateľa, meno, e-mail, zahashované heslo, rola, dátum registrácie a stav účtu.
   - Vzťahy: Jeden používateľ môže vlastniť viacero hier.
  
2. Projekt (Project)
   - Predstavuje jeden herný scenár.
   - Hlavné atribúty: ID projektu, ID autora, názov, téma, opis, minimálny a maximálny počet hráčov, predpokladaná dĺžka, stav projektu a dátumy vytvorenia a úpravy.
   - Vzťahy: Jeden projekt obsahuje viacero postáv, fáz, informácií a dôkazov.

3. Postava (Character)
   - Predstavuje postavu, ktorú hrá účastník murder mystery hry.
   - Hlavné atribúty: ID postavy, ID projektu, meno, povolanie alebo rola, charakteristika a pozadie postavy.
   - Účel: Slúži ako základ pre vytvorenie charakteristiky postavy a ďalších materiálov pre konkrétneho hráča.

4. Fáza hry (GamePhase)

   - Predstavuje jednu časť priebehu hry, v ktorej majú hráči prístup k určitému obsahu.
   - Hlavné atribúty: ID_fázy, ID_projektu, názov, opis, poradie a prípadné podmienky sprístupnenia.
   - Účel: Umožňuje rozdeliť hru na jednotlivé fázy a spravovať obsah dostupný v každej z nich. Autor môže napríklad vytvoriť fázu prípravy pred hrou, úvodnú fázu a viacero fáz postupného odhaľovania dôkazov.

5. Informácia (Information)
   - Predstavuje informáciu, tajomstvo, podozrenie, úlohu alebo inú textovú súčasť scenára.
   - Hlavné atribúty: ID_informácie, ID_projektu, názov, obsah, kategória a príznak označujúci tajnú informáciu.
   - Účel: Umožňuje vytvárať a spravovať obsah, ktorý sa následne priraďuje k postavám a fázam hry.

6. Dôkaz (Clue)
   - Predstavuje stopu alebo dôkaz, ktorý pomáha hráčom riešiť záhadu.
   - Hlavné atribúty: ID_dôkazu, ID_projektu, názov, opis a prípadný odkaz na priložený súbor.
   - Účel: Umožňuje vytvárať a spravovať dôkazy a určovať, kedy a ktorým postavám budú dostupné.

7. Vzťah medzi postavami (Relationship)
   - Predstavuje vzťah medzi dvoma postavami.
   - Hlavné atribúty: ID_vzťahu, ID_prvej_postavy, ID_druhej_postavy, typ vzťahu a opis.
   - Účel: Umožňuje evidovať rodinné väzby, priateľstvá, konflikty, rivalitu alebo romantické záujmy.

8. Priradenie obsahu (napríklad InformationAssignment a ClueAssignment)
   - Pomocné databázové tabuľky umožňujúce priraďovať informácie a dôkazy postavám a fázam hry.
   - Hlavné atribúty: ID_priradenia, ID_informácie alebo ID_dôkazu, ID_postavy, ID_fázy a prípadné doplňujúce údaje o sprístupnení.
   - Účel: Umožňujú určiť, ktorá postava dostane konkrétnu informáciu alebo dôkaz a v ktorej fáze hry. Jeden dôkaz alebo jedna informácia môžu byť priradené viacerým postavám. Obsah určený všetkým hráčom môže byť označený osobitne.

9. Súbor (ProjectFile)
   - Predstavuje súbor nahraný k hernému projektu.
   - Hlavné atribúty: ID_súboru, ID_projektu, názov, typ súboru, cesta k súboru a dátum nahrania.
   - Účel: Umožňuje spravovať obrázky dôkazov, zvukové nahrávky a ďalšie súbory potrebné na prípravu hry.

## Vzťahy medzi entitami
   - Používateľ – Projekt (1:N): Jeden používateľ môže vlastniť viacero hier, každá hra má v základnej verzii jedného vlastníka.
   - Projekt – Postava (1:N): Jedna hra obsahuje viacero postáv.
   - Projekt – Fáza hry (1:N): Jedna hra sa skladá z viacerých fáz, ktoré majú určené poradie.
   - Projekt – Informácia (1:N): Jedna hra obsahuje viacero informácií.
   - Projekt – Dôkaz (1:N): Jedna hra obsahuje viacero dôkazov.
   - Postava – Informácia (N:M): Informácia môže byť priradená viacerým postavám a jedna postava môže mať viacero informácií.
   - Postava – Dôkaz (N:M): Dôkaz môže byť dostupný viacerým postavám a jedna postava môže mať prístup k viacerým dôkazom.
   - Fáza hry – Informácia (N:M): Informácia môže byť sprístupnená v jednej alebo viacerých fázach.
   - Fáza hry – Dôkaz (N:M): Dôkaz môže byť sprístupnený v jednej alebo viacerých fázach.
   - Postava – Postava (N:M): Vzťahy medzi postavami sa evidujú prostredníctvom entity Relationship.
   - Projekt – Súbor (1:N): Jedna hra môže obsahovať viacero priradených súborov.
Pomocné tabuľky budú uchovávať priradenia medzi obsahom, postavami a fázami hry. Takto bude možné spravovať informácie a dôkazy bez vytvárania ich zbytočných kópií.

## Hlavné stránky aplikácie
1. Hlavná stránka = predstaví aplikáciu a možnosť prihlásenia alebo registrácie
2. Registrácia a prihlásenie = umožní užívateľovi vytvoriť si účet a bezpečne sa prihlásiť
3. Prehľad projektov = zobrazí vlastné hry, ich stav a základné údaje. Umožní vytvoriť novú hru alebo pokračovať v existujúcom projekte.
4. Vytvorenie a úprava hry = umožní zadať názov, tému, opis, počet hráčov a ďalšie základné údaje o hre.
5. Správa postáv = umožní vytvárať a upravovať postavy, ich charakteristiky a vzťahy. Z týchto údajov sa budú pripravovať podklady pre jednotlivých hráčov.
6. Správa fáz hry = umožní rozdeliť hru na fázy, upravovať ich poradie a spravovať informácie a dôkazy dostupné v jednotlivých fázach.
7. Správa informácií a tajomstiev = umožní vytvárať informácie, tajomstvá, podozrenia a úlohy a priraďovať ich ku konkrétnym postavám a fázam hry.
8. Správa dôkazov = umožní vytvárať a upravovať dôkazy, pridávať k nim súbory a určovať, kedy a ktorým postavám sa sprístupnia.
9. Príprava a export materiálov = spracuje informácie do materiálov ktoré bude možné exportovať ako PDF a tlačiť.

## Rozdelenie funkcionality
Základné funkcie:
   - registrácia, prihlásenie a odhlásenie používateľa
   - rozlišovanie používateľských rolí a kontrola oprávnení
   - vytváranie, zobrazovanie, upravovanie a odstraňovanie herných projektov
   - správa postáv a ich vzťahov
   - vytváranie a správa fáz hry
   - vytváranie informácií, tajomstiev, úloh a dôkazov
   - priraďovanie informácií a dôkazov jednotlivým postavám alebo skupinám postáv
   - určovanie fázy, v ktorej sa konkrétna informácia alebo dôkaz sprístupní
   - možnosť pridať alebo odstrániť informácie a dôkazy z konkrétnej fázy
   - tvorba materiálov pre jednotlivé postavy a organizačných podkladov pre autora
   - tlač a jednoduchý export pripravených materiálov prostredníctvom prehliadača
   - nahrávanie a správa súborov
   - aspoň dve významné AJAX operácie, napríklad asynchrónne priradenie informácie k postave a filtrovanie obsahu podľa fázy hry
   - validácia údajov na strane klienta aj servera, bezpečné databázové dopyty a ochrana prístupu k súkromným projektom
   - responzívne používateľské rozhranie a príprava demo údajov pre spustenie aplikácie v Dockeri.

Rozširujúce funkcie:
   - vlastné typy entít a polí: Autor si môže vytvoriť vlastné kategórie údajov, napríklad predmety, jedlo alebo podozrivé objekty, a určiť ich atribúty
   - pokročilý export: Automatické generovanie samostatných PDF dokumentov pre jednotlivé postavy, jednotlivé fázy a organizátora hry.
   - verejné projekty: Možnosť zverejniť vybrané hry, aby si ich mohli prezerať ostatní používatelia
   - katalóg hier: Vyhľadávanie a prehliadanie verejne dostupných scenárov
   - spolupráca viacerých autorov: Pozývanie ďalších používateľov k projektu s oprávnením na úpravu alebo iba prezeranie obsahu.
   - komentáre a história zmien: Zaznamenávanie poznámok a zmien v hernom scenári.
