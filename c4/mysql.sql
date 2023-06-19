-- Kreirannje na ednostavna funkcija

-- 1.

DELIMITER //
CREATE FUNCTION sobiranje (i1 INT , i2 INT)
RETURNS INT
BEGIN
	DECLARE i3 INT;
	DECLARE i4 INT;
    DECLARE result INT;
    
    SET i3 = 23;
    SET i4 = 33;
    
    SET result = i1 + i2 + i3 + i4;
    
    RETURN result;
END//
DELIMITER ;


select sobiranje(50, 4);

DROP FUNCTION sobiranje;

-- 2.

DELIMITER //
CREATE FUNCTION godina_na_transaqkcija ( id INT )
RETURNS INT
BEGIN
	DECLARE godina INT;
    
    SET godina = ( SELECT YEAR(t.date) FROM transactions t WHERE t.id = id);
    
    RETURN godina;
END//
DELIMITER ;

SELECT DISTINCT godina_na_transaqkcija(5) as godina, s.ime, s.prezime
FROM transactions as t
JOIN studenti as s ON s.id = t.student_id
WHERE t.student_id = 5;


-- Creating Procedures

-- 1.

DELIMITER //
CREATE PROCEDURE sobiranje ( IN i1 INT, IN i2 INT, OUT result INT)
BEGIN
	DECLARE i3 INT;
    DECLARE i4 INT;
    
    SET i3 = 15;
    SET i4 = 23;
    
    SET result = i1 + i2 + i3 + i4;
END//
DELIMITER ;

-- 2.

DELIMITER //
CREATE PROCEDURE moja_in_procedura (IN param1 INT)
BEGIN
	SELECT * FROM studenti WHERE id = param1;
END//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE moja_out_procedura(OUT param1 INT,OUT param2 INT, OUT param3 INT, OUT param4 INT)
BEGIN
	SET param1 = 123;
END//
DELIMITER ;

call moja_out_procedura(@val1,@val2,@val3,@val4);

--- 