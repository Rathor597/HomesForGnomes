--  Ramandeep Rathor
--  Nathan Morris
-- Date: 2018/10/29

DROP TABLE IF EXISTS property_interior_type;

CREATE TABLE property_interior_type(
value INT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE property_interior_type OWNER TO astillak;-- Author: Group 24


INSERT INTO property_interior_type (value, property) VALUES (1, 'Modern');

INSERT INTO property_interior_type (value, property) VALUES (2, 'Rustic');

INSERT INTO property_interior_type (value, property) VALUES (4, 'Contemporary');

INSERT INTO property_interior_type (value, property) VALUES (8, 'Industrial');

INSERT INTO property_interior_type (value, property) VALUES (16, 'Victorian');