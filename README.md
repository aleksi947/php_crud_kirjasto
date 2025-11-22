# PHP CRUD Kirjasto

Tämä on pieni PHP CRUD -sovellus, jossa voi lisätä, muokata ja poistaa kirjoja.
Tehty koulutehtävää varten.

## Git-haaroitusmalli

Tässä projektissa käytän yksinkertaista haaroitusmallia (Git branching model).

### Haarat

- **main** – päähaara, jossa on aina toimiva versio projektista.  
- **develop** – kehityshaara, johon kaikki uudet ominaisuudet yhdistetään ensin.  
- **feature/** – ominaisuushaarat, joissa kehitetään uusia toimintoja  
  esim. `feature/add-book-form`.

### Työskentely

1. Uusi ominaisuus aloitetaan luomalla feature-haara develop-haarasta.  
   `git checkout -b feature/uusi-ominaisuus develop`
2. Tehdään muutokset ja commitoidaan ne.
3. Kun ominaisuus on valmis, yhdistetään se pull requestilla develop-haaraan.
4. Kun develop on testattu ja toimii, se yhdistetään main-haaraan (julkaisu).

Tällä tavalla koodi pysyy selkeänä ja main-haara on aina vakaa.
