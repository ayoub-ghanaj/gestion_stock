# cargo create
DELIMITER $$
CREATE TRIGGER make_gain_create
AFTER INSERT
ON cargo FOR EACH ROW
BEGIN
    IF new.cargo_count > 0 THEN
        INSERT INTO gains(cargo_id, counter, gain_status) VALUES(new.id, new.cargo_count, '1');
    END IF;
END$$
DELIMITER ;
# alter check
ALTER TABLE cargo ADD CHECK (cargo_count >= 0);
# bills insert
DELIMITER $$
CREATE TRIGGER make_bills_insert
BEFORE INSERT
ON bills FOR EACH ROW
BEGIN
SET @val = 0;
SELECT cargo_count INTO @val FROM cargo WHERE id = new.cargo_id LIMIT 1;
    IF @val >= new.counter THEN
     update cargo set cargo_count = cargo_count - new.counter  where id = new.cargo_id ;
     ELSE
     SIGNAL SQLSTATE '66420' SET MESSAGE_TEXT = 'Warning: the cargo selected don\'t have enough stock ';
    END IF;
END$$
DELIMITER ;
# gains insert
DELIMITER $$
CREATE TRIGGER make_gains_insert
BEFORE INSERT
ON gains FOR EACH ROW
BEGIN
   update cargo set cargo_count = cargo_count + new.counter  where id = new.cargo_id ;
END$$
DELIMITER ;


drop TRIGGER make_Link_insert;
DELIMITER $$
CREATE TRIGGER make_Link_insert
AFTER INSERT
ON garage FOR EACH ROW
BEGIN
   insert into links(garage_id,user_id,rank,role,title) VALUES(new.id,new.creator_id,1,'Creator','Owner');
END$$
DELIMITER ;




































# alter check
ALTER TABLE cargo ADD CHECK (cargo_count >= 0);
# bills insert
DELIMITER $$
CREATE TRIGGER make_Link_insert
AFTER INSERT
ON garage FOR EACH ROW
BEGIN
   insert into links(garage_id,user_id,rank,role,title) VALUES(new.id,new.creator_id,1,'Creator','Owner');
END$$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER make_operation_insert
BEFORE INSERT
ON operation FOR EACH ROW
BEGIN
IF new.type = 'take' THEN
	SET @val = 0;
	SELECT cargo_count INTO @val FROM cargo WHERE id = new.cargo_id LIMIT 1;
	IF @val >= new.ammount THEN
		UPDATE cargo set cargo_count = cargo_count - new.ammount  WHERE id = new.cargo_id ;
    ELSE
		SIGNAL SQLSTATE '66420' SET MESSAGE_TEXT = 'Warning: the cargo selected don\'t have enough stock ';
	END IF;
ELSEIF new.type = 'add' THEN
	UPDATE cargo set cargo_count = cargo_count + new.ammount  WHERE id = new.cargo_id ;
ELSE
	SIGNAL SQLSTATE '66425' SET MESSAGE_TEXT = 'Warning: the operation type is not valid ';
END IF;
END$$
DELIMITER ;







#DROP TRIGGER make_operation_insert;
DELIMITER $$
CREATE TRIGGER make_operation_insert
BEFORE INSERT
ON operation FOR EACH ROW
BEGIN
IF new.type = 'take' THEN
	SET @val = 0;
	SELECT cargo_count INTO @val FROM cargo WHERE id = new.cargo_id LIMIT 1;
	IF @val >= new.ammount THEN
		UPDATE cargo set cargo_count = cargo_count - new.ammount  WHERE id = new.cargo_id ;
    ELSE
		SIGNAL SQLSTATE '66420' SET MESSAGE_TEXT = 'Warning: the cargo selected don\'t have enough stock ';
	END IF;
ELSEIF new.type = 'add' THEN
	UPDATE cargo set cargo_count = cargo_count + new.ammount  WHERE id = new.cargo_id ;
ELSEIF new.type = 'creation' THEN
	SET @a='';
ELSE
	SIGNAL SQLSTATE '66425' SET MESSAGE_TEXT = 'Warning: the operation type is not valid ';
END IF;
END$$
DELIMITER ;
