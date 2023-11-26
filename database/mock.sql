/*Create mock data for usuarios*/
insert into usuario (nome, email, senha, imagem, carro) values
("Leo Salgado", "leosalgado2004@gmail.com", "66d0a2ad782b1c8f6df2ef3f25587e34", 3, 4),
("João Pedro", "pedrin.gameplays@gmail.com", "e8d95a51f3af4a3b134bf6bb680a213a", 2, 3),
("João Vitor", "vitin_reidelas@yahoo.com", "e8d95a51f3af4a3b134bf6bb680a213a", 1, 2),
("Gabriel", "gabriel.silva@gmail.com", "e8d95a51f3af4a3b134bf6bb680a213a", 4, 1),
("Breno", "shaolin.matadordeporco@gmail.com", "e8d95a51f3af4a3b134bf6bb680a213a", 7, 5),
("Lucas", "pancadao.automotivo@gmail.com", "e8d95a51f3af4a3b134bf6bb680a213a", 6, 6),
("Rafael", "rafa_moreira@gmail.com", "e8d95a51f3af4a3b134bf6bb680a213a", 9, 3),
("Amanda", "amanda.louise@gmail.com", "e8d95a51f3af4a3b134bf6bb680a213a", 8, 2),
("Maria", "mari.vitoria@gmail.com", "e8d95a51f3af4a3b134bf6bb680a213a", 5, 1),
("Ana", "aninha123@gmail.com", "e8d95a51f3af4a3b134bf6bb680a213a", 1, 4),
("Julia", "juju_beijocas@gmail.com", "e8d95a51f3af4a3b134bf6bb680a213a", 2, 5),
("Larissa", "lari.orleans@gmail.com", "e8d95a51f3af4a3b134bf6bb680a213a", 3, 6),
("Leticia", "leti.faria@gmail.com", "e8d95a51f3af4a3b134bf6bb680a213a", 4, 1),
("Bernardo", "ber.hacker@gmail.com", "e8d95a51f3af4a3b134bf6bb680a213a", 5, 2);

/*Create mock data for ligas*/
insert into liga (nome, senha, private, imagem, fk_criador) values
("Liga dos Campeões", "e8d95a51f3af4a3b134bf6bb680a213a", 1, 1, 1),
("Liga das Feras", "e8d95a51f3af4a3b134bf6bb680a213a", 1, 2, 2),
("Liga da Amizade", "e8d95a51f3af4a3b134bf6bb680a213a", 1, 3, 3),
("The Ultimate Liga", "e8d95a51f3af4a3b134bf6bb680a213a", 1, 4, 4);

insert into liga (nome, private, imagem, fk_criador) values
("Os Vingadores", 0, 5, 5),
("Invencíveis", 0, 6, 6),
("Word Eaters", 0, 7, 7),
("Pneus Flamejantes", 0, 8, 8);

/*Update all usuarios, add fk_liga (accepts values from 1 to 8)*/
update usuario set fk_liga = 1 where id = 1;
update usuario set fk_liga = 2 where id = 2;
update usuario set fk_liga = 3 where id = 3;
update usuario set fk_liga = 4 where id = 4;
update usuario set fk_liga = 5 where id = 5;
update usuario set fk_liga = 6 where id = 6;
update usuario set fk_liga = 7 where id = 7;
update usuario set fk_liga = 8 where id = 8;
update usuario set fk_liga = 1 where id = 9;
update usuario set fk_liga = 2 where id = 10;
update usuario set fk_liga = 3 where id = 11;
update usuario set fk_liga = 4 where id = 12;
update usuario set fk_liga = 5 where id = 13;
update usuario set fk_liga = 6 where id = 14;

/*Create mock data for pontuacao*/
insert into pontuacao (modo_jogo, tempo, pontuacao, data_reg, fk_usuario) values
(0, "00:00:00", 0, "2023-11-26 11:00:00", 1),
(0, "00:00:00", 0, "2023-11-26 11:00:00", 2),
(0, "00:00:00", 0, "2023-11-26 11:00:00", 3),
(0, "00:00:00", 0, "2023-11-26 11:00:00", 4),
(0, "00:00:00", 0, "2023-11-26 11:00:00", 5),
(0, "00:00:00", 0, "2023-11-26 11:00:00", 6),
(0, "00:00:00", 0, "2023-11-26 11:00:00", 7),
(0, "00:00:00", 0, "2023-11-26 11:00:00", 8),
(0, "00:00:00", 0, "2023-11-26 11:00:00", 9),
(0, "00:00:00", 0, "2023-11-26 11:00:00", 10),
(0, "00:00:00", 0, "2023-11-26 11:00:00", 11),
(0, "00:00:00", 0, "2023-11-26 11:00:00", 12),
(0, "00:00:00", 0, "2023-11-26 11:00:00", 13),
(0, "00:00:00", 0, "2023-11-26 11:00:00", 14);
