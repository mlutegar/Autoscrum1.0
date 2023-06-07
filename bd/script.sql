create database if not exists autoscrum;
use autoscrum;

create or replace table login(
    id int primary key auto_increment,
    user varchar(240) not null,
    foto longtext not null,
    email varchar(250) not null unique,
    senha varchar(255) not null,
    cargo varchar(255) not null,
    created_at TIMESTAMP not null default CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

create or replace table projetos(
	id int primary key auto_increment,
	lider_id int not null,
	nome varchar(250) not null,
  objetivo varchar(250) not null,
  tamanho int not null,
	FOREIGN KEY (lider_id) REFERENCES login(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


create or replace table competencias(
	id int primary key auto_increment,
	nome varchar(250) not null unique,
	descricao varchar(250) not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

create or replace table areas(
	id int primary key auto_increment,
	nome varchar(250) not null unique,
	descricao varchar(250) not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

create or replace table projeto_competencia (
  projeto_id int not null,
  competencia_id int not null,
  FOREIGN KEY (projeto_id) REFERENCES projetos(id),
  FOREIGN KEY (competencia_id) REFERENCES competencias(id)
);

create or replace table projeto_areas (
  projeto_id int not null,
  competencia_id int not null,
  FOREIGN KEY (projeto_id) REFERENCES projetos(id),
  FOREIGN KEY (competencia_id) REFERENCES areas(id)
);

create or replace table colaborador_competencia (
  colaborador_id int not null,
  competencia_id int not null,
  FOREIGN KEY (colaborador_id) REFERENCES login(id),
  FOREIGN KEY (competencia_id) REFERENCES competencias(id)
);

create or replace table colaborador_areas (
  colaborador_id int not null,
  area_id int not null,
  FOREIGN KEY (colaborador_id) REFERENCES login(id),
  FOREIGN KEY (area_id) REFERENCES areas(id)
);

create or replace table colaborador_area_principal (
  colaborador_id int not null unique,
  area_id int not null,
  FOREIGN KEY (colaborador_id) REFERENCES login(id),
  FOREIGN KEY (area_id) REFERENCES areas(id)
);

create or replace table projeto_colaboradores (
  colaborador_id int not null,
  projeto_id int not null,
  cargo int not null,
  FOREIGN KEY (colaborador_id) REFERENCES login(id),
  FOREIGN KEY (projeto_id) REFERENCES projetos(id)
);

insert into competencias(nome) values ('Disponibilidade');
insert into competencias(nome) values ('Trabalho em equipe');
insert into competencias(nome) values ('Lideranca');
insert into competencias(nome) values ('Flexibilidade');
insert into competencias(nome) values ('Agilidade');
insert into areas(nome) values ('PHP');
insert into areas(nome) values ('Java');
insert into areas(nome) values ('Javascript');
insert into areas(nome) values ('HTML');
insert into areas(nome) values ('CSS');
insert into competencias(nome) values ('Oratoria');
insert into competencias(nome) values ('Honra');
insert into competencias(nome) values ('Relacionamento');
insert into competencias(nome) values ('Paciencia');
insert into competencias(nome) values ('Pensamento Critico');
insert into competencias(nome) values ('Tomada de decisao');
insert into areas(nome) values ('C');
insert into areas(nome) values ('Python');
insert into areas(nome) values ('C++');
insert into areas(nome) values ('Angular');
insert into areas(nome) values ('Portugol');
insert into areas(nome) values ('SQL');