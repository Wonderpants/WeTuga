Create database WeTuga;
use WeTuga;
DROP DATABASE WeTuga;

CREATE DATABASE teste;
use teste;
DROP DATABASE teste;

Create table Pacotes(
nome varchar(10) PRIMARY KEY,
preco float NOT NULL,
duracao int NOT NULL,
qualidade int NOT NULL,
);

Insert into Pacotes Values ('Basico','5','3','480');
Insert into Pacotes Values ('Premium','10','9','1080');

select * from Pacotes;
drop table Pacotes;

Create table Utilizador(
id int PRIMARY KEY NOT NULL,
nome varchar(50) NOT NULL,
password varchar(50) NOT NULL,
genero varchar(15) NOT NULL,
idade int NOT NULL,
dataCriacao date NOT NULL,
mail varchar(60) NOT NULL,
estadoSubscricao bit DEFAULT 'False',
nomePacote varchar(10) FOREIGN KEY REFERENCES Pacotes(nome),
);

Insert Into Utilizador Values ('1','José','123','Masculino','26','2020-01-26','jose123@hotmail.com','True','Premium');
Insert Into Utilizador Values ('2','Maria','321','Feminino','18','2019-07-10','maria321@gmail.com','False','Basico');
INSERT INTO Utilizador (id, nome, password, genero, idade, dataCriacao, mail, estadoSubscricao,nomePacote)
VALUES ('3', 'João', '456', 'Masculino', '44', '2020-01-27', 'mariaj@gmail.com', 'True', 'Premium'),
       ('4', 'Maria João', '789', 'Feminino', '22', '2020-10-01', 'mariaj@gmail.com', 'False', 'Basico');

select * from Utilizador;
drop table Utilizador;
delete from Utilizador where id ='3'OR id ='4';

Create table Anuncios(
id int PRIMARY KEY NOT NULL,
anunciante varchar(100) NOT NULL,
link varchar(200) NOT NULL,
caminho varchar(300) NOT NULL,
);

Insert Into Anuncios Values ('1','BMW','www.bmw.com','file/anuncios/bmw');
Insert Into Anuncios Values ('2','Apple','www.apple.com','file/anuncios/apple');
Insert Into Anuncios Values ('3','Apple','www.apple.com','file/anuncios/apple');

select * from Anuncios;
DROP TABLE Anuncios;
delete from Anuncios where id = '3';

Create table Pagamento(
numeroCartao int PRIMARY KEY NOT NULL,
nomeTitular varchar(40) NOT NULL,
dataValidade date NOT NULL,
cvv int NOT NULL,
idUtilizador int FOREIGN KEY REFERENCES Utilizador(id),
);

Insert Into Pagamento Values ('12345','José Alves','2021-12-12','3244','1');
Insert Into Pagamento Values ('54321','Maria Sá','2023-02-11','1121','2');
INSERT INTO Pagamento (numeroCartao,nomeTitular, dataValidade, cvv, idUtilizador)
VALUES ('56789', 'João Mota', '2022-11-06', '4444', '3'),
       ('16789', 'Maria João Rosa', '2020-10-29', '4334', '4');

select * from Pagamento;
DROP TABLE Pagamento;

Create table Conteudo(
id int PRIMARY KEY,
nome varchar(50) NOT NULL,
data date NOT NULL,
tipo varchar(20) NOT NULL,
temporada int,
episodio int,
minutos int NOT NULL,
descricao varchar(300) NOT NULL,
rating float NOT NULL, --IMDB
estrelas float DEFAULT '0', --Avaliado pelo Utilizador
genero varchar(30) NOT NULL,
estudio varchar(40),
imagem varchar(255) NOT NULL,
caminho varchar(255) NOT NULL
);

Insert Into Conteudo Values ('1','Morangos Com Açucar','2000-10-05','Série','1','1','30','EXAMPLE','3.7',NULL,'Drama','TVI','file://MorangosComAçucarIMG','file://MorangosComAçucarVIDEO');
Insert Into Conteudo Values ('2','Matrix','1998-12-10','Filme',NULL,NULL,'260','EXAMPLE','4.5',NULL,'Ação','Matrix Pictures','file://MatrixIMG','file://MatrixVIDEO');
INSERT INTO Conteudo (id, nome, data, tipo, temporada, episodio, minutos, descricao, rating, genero, estudio, imagem, caminho)
VALUES ('3', 'Inspector Max', '2004-04-14', 'Série', '1', '1', '45', 'Cão Apanha Ladrão', '5', 'Ação', 'TVI', 'file://MorangosComAçucarIMG', 'file://MorangosComAçucarVideo'),
       ('4', 'Uma Aventura', '2000-10-14', 'Série', '1', '1', '45', 'Um grupo de amigos', '3.5', 'Ação', 'SIC', 'file://MorangosComAçucarIMG', 'file://MorangosComAçucarVideo'),
       ('5', 'Conta-me como foi', '2007-04-22', 'Série', '1', '1', '45', 'Anos 80', '3.6', 'História', 'RTP', 'file://MorangosComAçucarIMG', 'file://MorangosComAçucarVideo'),
       ('6', 'Bem Vindos a Beirais', '2013-05-13', 'Série', '1', '1', '45', 'Uma Vila', '2.5', 'Drama', 'RTP', 'file://MorangosComAçucarIMG', 'file://MorangosComAçucarVideo'),
       ('7', 'A Minha Familia É Uma Animação', '2001-03-29', 'Série', '1', '1', '45', 'Tinha um boneco chamado Neco', '5', 'Comédia', 'SIC', 'file://MorangosComAçucarIMG', 'file://MorangosComAçucarVideo'),
       ('8', 'Pedro e Inês', '2018-10-18', 'Filme', NULL, NULL, '105', 'Romance proibido', '3.5', 'Ação', 'Persona Non Grata Pictures', 'file://MorangosComAçucarIMG', 'file://MorangosComAçucarVideo'),
       ('9', 'Variações', '2019-12-07', 'Filme', NULL, NULL, '145', 'A história do António', '4.5', 'Drama', 'David e Golias', 'file://MorangosComAçucarIMG', 'file://MorangosComAçucarVideo'),
       ('10', 'O Pátio das Cantigas', '2015-07-30', 'Filme', NULL, NULL, '111', ' A vivencias de um Bairro de Lisboa', '5', 'Comédia', 'Sky Dreams Entertainment', 'file://MorangosComAçucarIMG', 'file://MorangosComAçucarVideo'),
       ('11', 'Terra Franca', '2019-01-10', 'Filme', NULL, NULL, '80', 'A vida de Albertino Lobo e sua família', '1.5', 'Documentário', 'Uma Pedra no Sapato', 'file://MorangosComAçucarIMG', 'file://MorangosComAçucarVideo'),
       ('12', 'Perdidos', '2017-05-18', 'Filme', NULL, NULL, '45', 'Perdidos em Alto Mar', '0.5', 'Aventura', 'Master Dream Digital', 'file://MorangosComAçucarIMG','file://MorangosComAçucarVideo');

select* from Conteudo;
drop table Conteudo;
delete from Conteudo where id = '2';


Create table Lista(
id int PRIMARY KEY NOT NULL,
idUtilizador int FOREIGN KEY REFERENCES Utilizador(id),
);

select * from Lista;
drop table Lista;
delete from Lista where idUtilizador = 3 OR idUtilizador=4;

Create table ConteudoLista(
id int PRIMARY KEY,
idConteudo int FOREIGN KEY REFERENCES Conteudo(id),
idLista int FOREIGN KEY REFERENCES Lista(id),
);

INSERT INTO ConteudoLista VALUES ('1','1','1');
INSERT INTO ConteudoLista VALUES (2,2,2);

select * from ConteudoLista;
DROP TABLE ConteudoLista;

Create table Crew(
id int PRIMARY KEY,
nome varchar(40) NOT NULL,
cargo varchar(25) NOT NULL,
idade int,
idConteudo int FOREIGN KEY REFERENCES Conteudo(id),
);

INSERT INTO Crew (id, nome, cargo, idade, idConteudo)
VALUES ('1','Joana Duarte','Atriz','25','1'),
	   ('2', 'Max', 'Ator', '10', '3'),
       ('3', 'Dânia Neto', 'Ator', '36', '12'),
       ('4', 'Afonso Pimentel ', 'Ator', '37', '12'),
       ('5', 'Dalila Carmo', 'Ator', '45', '12'),
       ('6', 'Ana Bustorff', 'Ator', '60', '7'),
       ('7', 'Cristóvão Campos', 'Ator', '35', '4'),
       ('8', 'Joana de Verona', 'Ator', '30', '6'),
       ('9', 'João Maia', 'Realizador', '42', '9'),
       ('10', 'João Madail', 'Guionista', '21', '5'),
       ('11', 'Pedro Varela', 'Guionista', '20', '5'),
       ('12', 'Leonel Vieira', 'Diretor', '50', '10');


select * from Crew;
DROP TABLE Crew;

Create table Avaliacao(
id int PRIMARY KEY,
estrelas float NOT NULL,
idUtilizador int FOREIGN KEY REFERENCES Utilizador(id),
idConteudo int FOREIGN KEY REFERENCES Conteudo(id),
);

INSERT INTO Avaliacao VALUES ('1','5','2','2');
INSERT INTO Avaliacao VALUES ('2','2','1','2');

select * from Avaliacao;
DROP TABLE Avaliacao;

Create table Historico(
id int PRIMARY KEY,
idUtilizador int FOREIGN KEY REFERENCES(Utilizador) NOT NULL,
);

Create table HistoricoConteudo(
id int PRIMARY KEY,
idConteudo int FOREIGN KEY REFERENCES(Conteudo) NOT NULL
);

select* from Anuncios;
select* from Avaliacao;
select* from Conteudo;
select* from ConteudoLista;
select* from Crew;
select* from Lista;
select* from Pacotes;
select* from Pagamento;
select* from Utilizador;

--Próximos passos:

--Triggers:
--Trigger da avaliacao, nao deixar um utilizador avaliar mais do que uma vez cada conteudo
--Quando é criado um utilizador encriptar palavra-passe antes de inserir na base de dados

--Inserir mais dados
--Queries

--Triggers
create trigger CriaLista -- Quando e criado um utilizador este trigger cria automaticamente uma lista para esse utilizador
on Utilizador
after insert
as
	set NOCOUNT ON;
	INSERT INTO Lista
		(id,idUtilizador)
	Select
		id , id
		FROM inserted
go

create trigger AtualizaAvaliacao -- Quando uma nova avaliacao e inserida este trigger atualiza automaticamente a avaliacao que cada conteudo tem
on Avaliacao
after insert
as
	set NOCOUNT ON;
	declare
	@idConteudo_inserted int,
	@classificacao float;

	Set @idConteudo_inserted = (select idConteudo from inserted)
	Set @classificacao = (select AVG(estrelas) from Avaliacao where idConteudo= @idConteudo_inserted)

	IF (@classificacao>=0 AND @classificacao<0.5)
	Begin
		Set @classificacao = 0;
	END

	IF (@classificacao>=0.5 AND @classificacao<1)
	Begin
		Set @classificacao =0.5;
	END

	IF (@classificacao>=1 AND @classificacao<1.5)
	Begin
		Set @classificacao =1;
	END

	IF (@classificacao>=1.5 AND @classificacao<2)
	Begin
		Set @classificacao =1.5;
	END

	IF (@classificacao>=2 AND @classificacao<2.5)
	Begin
		Set @classificacao =2;
	END

	IF (@classificacao>=2.5 AND @classificacao<3)
	Begin
		Set @classificacao =2.5;
	END

	IF (@classificacao>=3 AND @classificacao<3.5)
	Begin
		Set @classificacao =3;
	END

	IF (@classificacao>=3.5 AND @classificacao<4)
	Begin
		Set @classificacao =3.5;
	END

	IF (@classificacao>=4 AND @classificacao<4.5)
	Begin
		Set @classificacao =4;
	END

	IF (@classificacao>=4.5 AND @classificacao<5)
	Begin
		Set @classificacao =4.5;
	END

	IF (@classificacao=5)
	Begin
		Set @classificacao =5;
	END

	UPDATE Conteudo
	SET estrelas = @classificacao
	where id = @idConteudo_inserted;
go

--create trigger VerificaAvaliacao -- Quando uma nova avaliacao e inserida este trigger atualiza automaticamente a avaliacao que cada conteudo tem
--on Avaliacao
--before insert
--as
	--set NOCOUNT ON;
	---declare
	----@idConteudo_inserted int,
	--@idUtilizador_inserted int;

	--Set @idConteudo_inserted = (select idConteudo from inserted)
	--Set @idUtilizador_inserted = (select idUtilizador from inserted)

	--IF (@classificacao>=0 AND @classificacao<0.5)
	--Begin
	--	Set @classificacao = 0;
	--END
--
	--UPDATE Conteudo
	--SET estrelas = @classificacao
	--where id = @idConteudo_inserted;
--go

--Queries
SELECT nome
FROM Utilizador
WHERE nomePacote = 'Premium';

SELECT nome
FROM Conteudo
WHERE genero = 'Ação'
ORDER BY rating DESC;

SELECT nome
FROM Crew
WHERE NOT cargo = 'Ator'
ORDER BY idade;

SELECT *
FROM Conteudo
WHERE NOT tipo = 'Filme' AND NOT estudio = 'RTP'

SELECT nome
FROM Crew
WHERE idConteudo IN ( SELECT idConteudo FROM Conteudo WHERE tipo = 'Filme');

