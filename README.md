NAPOMENA: Ukoliko dobijete error "maximum execution time of 120 seconds exceeded".
Potrebno je u datoteci php.ini (putanja: c/wamp/bin/php/phpX_verzija/php.ini) promijeniti max_execution_time sa 120 na 500 (može i 999).
Dodatno, budući da je program dosta velik ali i dosta spor, u index.php je zakomentiran jedan if, koji vrti samo kroz određen broj
pjesama. Svakako preporučam kada budete testirali, slobodno maknite komentare jer bez njih se zna vrtjeti po 5 minuta dok ne dobijete
rezultat, a kada sam radio program, svaki puta čekati po 5-6 minuta da dobijem error nije bilo zabavno.

Datoteka NRC-Emotion-Lexicon-Wordlevel-v0.92.txt sadrži oko 14000 riječi koje mogu imati nula ili više osjećaja
(8 je mogućih osjećaja: anger, anticipation, joy, trust, fear, surprise, sadness, disgust) 
te jednu polarnost (positive | negative).  
Tamo gdje je uz riječ i osjećaj stoji vrijednost 1, to znači da ta riječ ima tu emociju/polarnost. 
Tamo gdje je 0, znači da riječ nema tu emociju/polarnost.

Podatke iz datoteke izravno (bez korištenja PHP-a)  prenijeti u mySQL bazu podataka, 
u tablicu dictionary sa stupcima word, emotion, value. 

Datoteka songs.csv sadrži pjesme Metallice i Nirvane 
(prvo slovo u retku govori čija je pjesma => M znači Metallica, N znači Nirvana). 
Učitati ovu datoteku u PHP te za svaku pjesmu pronaći koliko se puta u kojoj pjesmi pojavljuje koji osjećaj 
(rječnik učitati iz baze), a tražite u stihovima (lyrics). 
Također za svaku pjesmu izračunati je li pretežno pozitivna ili negativna 
(prebrojiti pozitivne i negativne riječi, oduzeti ih i ako je razlika pozitivna, pjesmu proglasiti pozitivnom (i obrnuto)).
Nakon toga prikazati za svaki bend postotak pojavljivanja pojedinog osjećaja u pjesmama 
(recimo ako se fear nalazi u 25 pjesama od 80 Nirvaninih pjesama, onda je postotak 31%). 
U ovom izvještaju bitno je samo da li ima ili nema osjećaja u pjesmi, a ne koliko se puta u toj pjesmi pojavljuje). 
Analogno tome, prikazati postotak pozitivnih i negativnih pjesama za oba benda.

Izvještaje prikazati na ekranu, te u PDF-u.

