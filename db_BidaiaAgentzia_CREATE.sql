#drop database if exists db_BidaiAgentzia;
CREATE DATABASE IF NOT EXISTS db_BidaiaAgentzia;
USE db_BidaiaAgentzia;

create table if not exists IATA (
AIREPORTUA varchar (3) primary key,
HIRIA varchar (50)
);

create table if not exists HERRIALDEAK (
KOD_HERRIALDEAK varchar (3) primary key,
HERRIALDEAK varchar (50)
);

create table if not exists LANG_KOPURUA (
KODEA varchar (2) primary key,
DESKRIBAPENA varchar (35)
);

create table if not exists BIDAIA_MOTAK (
KODEA varchar (2) primary key,
DESKRIBAPENA varchar (55)
);

create table if not exists AIRELINEAK (
KODEA varchar (5) primary key,
IZENA varchar (60),
KOD_HERRIALDEAK varchar (3)
);

create table if not exists AGENTZIA_MOTAK (
KODEA varchar (2) primary key,
DESKRIBAPENA varchar (20)
);

create table if not exists LOGELA_MOTAK (
KODEA varchar (3) primary key,
DESKRIBAPENA varchar (35)
);

create table if not exists AGENTZIA (
ID_AGENTZIA int auto_increment primary key,
IZENA varchar(50),
LOGOA varchar(400),
MARKAREN_KOLOREA varchar(25),
ERABILTZAILEA varchar(25) unique,
PASAHITZA varchar(8),
AGENTZIA_MOTA_KODEA varchar (2), #(FK)
LANGILE_KOPURUA_KODEA varchar (2) #(FK)
);

ALTER TABLE agentzia ADD FOREIGN KEY (AGENTZIA_MOTA_KODEA) REFERENCES AGENTZIA_MOTAK(KODEA);
ALTER TABLE agentzia ADD FOREIGN KEY (langile_kopurua_kodea) REFERENCES lang_kopurua(KODEA);

create table if not exists BIDAIAK (
ID_BIDAIA int auto_increment primary key,
IZENA varchar(25),
DESKRIBAPENA mediumtext,
HASIERA_DATA date null,
AMAIERA_DATA date null,
EZ_BARNE_ZERBITZUAK mediumtext, 
BIDAIA_MOTA_KODEA varchar(2), #(FK)
AGENTZIA_KODEA int, #(FK)
HERRIALDEAK_KODEA varchar (3) #(FK)
);

ALTER TABLE bidaiak ADD FOREIGN KEY (bidaia_mota_kodea) REFERENCES bidaia_motak(KODEA);
ALTER TABLE bidaiak ADD FOREIGN KEY (agentzia_kodea) REFERENCES agentzia(ID_AGENTZIA) on delete cascade;
ALTER TABLE bidaiak ADD FOREIGN KEY (herrialdeak_kodea) REFERENCES herrialdeak(KOD_HERRIALDEAK);

create table if not exists EKITALDIAK (
ID_EKITALDIA int auto_increment primary key,
IZENA varchar (25),
ID_BIDAIA int #(FK)
);

ALTER TABLE ekitaldiak ADD FOREIGN KEY (id_bidaia) REFERENCES bidaiak(ID_BIDAIA) on delete cascade;

create table if not exists OSTATUA (
ID_OSTATUA int primary key,
HOTELAREN_IZENA varchar(25),
HIRIA varchar(35),
PREZIOA double,
SARRERA_EGUNA date,
IRTEERA_EGUNA date,
LOGELA_MOTA_KODEA varchar(3) #(FK)
);

ALTER TABLE ostatua ADD FOREIGN KEY (id_ostatua) REFERENCES ekitaldiak(ID_EKITALDIA) on delete cascade;
ALTER TABLE ostatua ADD FOREIGN KEY (logela_mota_kodea) REFERENCES logela_motak(KODEA);

create table if not exists JARDUERAK (
ID_JARDUERA int primary key,
IZENA varchar(30),
DESKRIBAPENA mediumtext,
DATA date,
PREZIOA double
);

ALTER TABLE jarduerak ADD FOREIGN KEY (ID_JARDUERA) REFERENCES ekitaldiak(ID_EKITALDIA) on delete cascade;

create table if not exists JOANEKO_HEGALDIA (
ID_HEGALDIA int primary key,
KODEA varchar(10),
IRTEERA_DATA date,
IRTEERA_ORDUA time,
IRAUPENA time,
PREZIOA double,
JATORRIZKO_AIREPORTUA varchar(3), #(FK)
HELMUGAKO_AIREPORTUA varchar(3), #(FK)
AIRELINEA_KODEA varchar(5) #(FK)
);

ALTER TABLE joaneko_hegaldia ADD FOREIGN KEY (ID_HEGALDIA) REFERENCES ekitaldiak(ID_EKITALDIA) on delete cascade;
ALTER TABLE joaneko_hegaldia ADD FOREIGN KEY (jatorrizko_aireportua) REFERENCES iata(AIREPORTUA);
ALTER TABLE joaneko_hegaldia ADD FOREIGN KEY (helmugako_aireportua) REFERENCES iata(AIREPORTUA);
ALTER TABLE joaneko_hegaldia ADD FOREIGN KEY (airelinea_kodea) REFERENCES airelineak(KODEA);

create table if not exists JOAN_ETORRIKO_HEGALDIA (
ID_HEGALDIA int primary key,
KODEA varchar(10),
ITZULERA_DATA date,
ITZULERA_ORDUA time,
BUELTAKO_IRAUPENA time,
BUELTAKO_AIRELINEA_KODEA varchar(5) #(FK)
);

ALTER TABLE joan_etorriko_hegaldia ADD FOREIGN KEY (ID_HEGALDIA) REFERENCES joaneko_hegaldia(ID_HEGALDIA) on delete cascade;
ALTER TABLE joan_etorriko_hegaldia ADD FOREIGN KEY (bueltako_airelinea_kodea) REFERENCES airelineak(KODEA); 
