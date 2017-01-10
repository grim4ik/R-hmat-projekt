•	Suurelt projekti nime: Rentable
•	Suurelt projekti veebirakenduse pilt
•	Ruhma liikmete nimed: Kirill Kotkas, Aleksander Minakov
•	Eesmark: Kui te ei tahate mida osta, vaid tahate ainult rentida midagi.
•	Kirjeldus: Ebay, aliexpress, okidoki. Vaid meil on asja rentimine
•	Funktsionaalsus:
o	Saab lisada kuulutus
o	Saab teha kasutaja ja sisselogida
•	Andmebaasi skeem loetava pildina + tabelite loomise SQL laused:
CREATE TABLE `rt_ad` (
  `id` int(11) NOT NULL,
  `ad_price` text NOT NULL,
  `ad_text` text NOT NULL,
  `ad_name` text NOT NULL,
  `ad_picture` varchar(200) NOT NULL,
  `deleted` date DEFAULT NULL,
  `ad_tuup` text NOT NULL,
  `ad_people` text NOT NULL,
  `ad_phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;	CREATE TABLE `rt_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `login` varchar(255) NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

•	Kokkuvote: Keeruline oli see, et minikord ei saanud aru kuidas midagi tootab, ja parast seda oli vaja ise seda arusaada. Ebaonnestus oli selles, et olid problemid githab’iga.
