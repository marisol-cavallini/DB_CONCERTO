create database if not exists organizzazione_concerto;
create table if not exists organizzazione_concerto.concerti(
id int not null auto_increment,
codice_concerto varchar(20),
titolo_concerto varchar(20),
descrizione_concerto varchar (100),
data_concerto varchar(20),
primary key (id)
);