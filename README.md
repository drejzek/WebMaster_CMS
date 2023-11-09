# WebMaster_CMS
## Základní filozofie systému

Systém je především určen uživatelům, kteří jím budou spravovat své webové stránky, a řídit další uživatele jenž mají do tohoto systému přístup. Systém je navržen tak aby uživatelům umožnil co nejpřehlednější rozhraní, a je hostován na internetu, aby byl přístupný odkudkoliv. Dále systém umožňuje propojení některých modulů (viz tabulka propojení modulů), a tím umožňuje vytvořit komplexní webové stránky.

## Název systému
Název systému není momentálně jasný. Jako pracovní název byl zvolen WebMaster CMS, který se ale v budoucnu změní.

## Přehled funkcí
Systém nabízí implementaci obsahových, technických, a uživatelských modulů, které umožňují snadnou správu obsahu webu. Dále systém nabízí správu řízení uživatelských účtů, a uživatelských skupin, pokročilé nastavení webu, a nastavení vzhledu webu, i samotného systému.

## Moduly systému
Nabízí možnost spravovat webové stránky. Dělí se na obsahové, technické, a uživatelské. Obsahové moduly slouží ke správě obsahu webu. Patří mezi ně například modul stránek, modul článků, nebo formulářů. Technické moduly slouží ke správě různých funkcí webu. Patří mezi mě např.: modul relací, newsletter, RSS kanály, databáze, skripty, a hledání. Uživatelské moduly slouží ke správě uživatelů na stránce. Patří mezi ně např

## Modul: Stránky
Modul stránek nabízí správu stránek, a sekcí webu, jejich úpravu, přidávání, i mazání. Přehled stránek je v podobě tabulky, přehled sekcí je k dispozici po otevření dialogového okna. Modul dále nabízí úpravu titulku stránky obsahu, URL identifikátoru, datum úpravy, a publikace, zveřejnění od a do, nastavení metadat, a uzamčení stránky. K úpravě obsahu je možné využít Live Editor, který nabízí úpravu stránek, přesně tak, jak budou vypadat.

## Modul: Články
Modul článků umožňuje vytvářet a spravovat články, které lze zařadit do rubrik. Správa rubrik je k dispozici v menu v modulu. Přehled článků je v podobě tabulky. Modul nabízí úpravu titulku článku, obsah článku, URL identifikátoru, datum úpravy, a publikace, zveřejnění od a do, nastavení metadat, uzamčení článku, a nastavení autora.

## Modul: Lokace
Modul lokací umožňuje přidávání, úpravu, mazání lokací. Modul využívá knihovnu map LeafLet. Lokace je možné zařazovat do rubrik. U lokace je možné spravovat název lokace, souřadnice, popis bodu ma mapě, popis lokace, datum úpravy, a datum zveřejnění. Souřadnice je možné zvolit kliknutím na mapu, a také ručím zadáním.

## Modul: Formuláře
Modul formulářů nabízí tvorbu formulářů. Formuláře lze vytvořit v editoru polí, který ke součástí modulu. Editor nabízí možnost úpravy titulku pole, názvu pole, typu pole, a placeholder. Každý řádek v editoru je jedno pole formuláře.

### Přehled typů polí
- Text
- E-mail
- Heslo
- Telefonní číslo
- Číslo
- Barva
- Soubor
- Rozsah
- Zaškrtávací pole (checkbox)
- Pole výběru (radio)
- Select

## Propojení modulů
Některé moduly je možné propojit pomocí databáze, a tím vytvořit komplexní systém. Propojení je možné uskutečnit pouze u modulů které to podporují. Možnost propojení modulů se zobrazí v daném modulu pouze pro moduly, které jsou aktuálně dostupné, a které propojení s daným modulem podporují. Moduly je možné propojit pouze jednostranně. Například modul stránek může být propojen s modulem relací, ale modul relací nejde propojit s modulem stránek.
