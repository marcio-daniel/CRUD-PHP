create table if not exists public.users(
	id SERIAL CONSTRAINT pk_id_users PRIMARY KEY,
	name varchar(60) NOT NULL,
	email varchar(50) NOT NULL UNIQUE,
	password varchar(260) NOT NULL,
	height float,
	current_weight float,
	imc float
);

create table if not exists public.weights(
	id SERIAL CONSTRAINT pk_id_weights PRIMARY KEY,
	weight_value float NOT NULL,
	user_id int NOT NULL,
	weight_date date,
	FOREIGN KEY (user_id) references users(id)
);

CREATE OR REPLACE FUNCTION public.fn_update_weight() 
RETURNS trigger LANGUAGE plpgsql
AS
$$ 
DECLARE 
	new_imc float;
	alt float;
BEGIN
	alt := (SELECT height from public.users where id = new.user_id);
	new_imc := new.weight_value / (alt * alt);
	UPDATE public.users SET current_weight = new.weight_value , imc = new_imc where id = new.user_id;
	RETURN NULL;
END;
$$;
	
CREATE TRIGGER tg_update_current_weight AFTER INSERT
ON public.weights FOR EACH ROW EXECUTE PROCEDURE public.fn_update_weight();

CREATE OR REPLACE FUNCTION public.fn_insert_weight() 
RETURNS trigger LANGUAGE plpgsql
AS
$$ 
BEGIN
	insert into public.weights(weight_value,weight_date,user_id) values(new.current_weight,CURRENT_DATE,new.id);
	RETURN NULL;
END;
$$;
	
CREATE TRIGGER tg_inser_new_weight AFTER INSERT
ON public.users FOR EACH ROW EXECUTE PROCEDURE public.fn_insert_weight();


insert into public.users(email,password,height,current_weight,imc) values(?);
insert into public.weights(weight_value,weight_date,user_id) values (?);


select * from public.weights where user_id = ? ORDER BY weight_date asc;
select * from public.users where email = ?;
select * from public.users where id = ?;
select * from public.weights where user_id=? AND weight_date between '?' AND '?' ORDER BY weight_date asc;