CREATE TABLE `sector`(`name` VARCHAR(255) NOT NULL);
ALTER TABLE
    `sector` ADD PRIMARY KEY(`name`);
CREATE TABLE `solutionProvider`(
    `username` VARCHAR(255) NOT NULL,
    `organizationName` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `solutionProvider` ADD PRIMARY KEY(`username`);
ALTER TABLE
    `solutionProvider` ADD UNIQUE `solutionprovider_organizationname_unique`(`organizationName`);
CREATE TABLE `type`(`name` VARCHAR(255) NOT NULL);
ALTER TABLE
    `type` ADD PRIMARY KEY(`name`);
CREATE TABLE `solutionType`(`name` VARCHAR(255) NOT NULL);
ALTER TABLE
    `solutionType` ADD PRIMARY KEY(`name`);
CREATE TABLE `specialization`(
    `type` VARCHAR(255) NOT NULL,
    `id` VARCHAR(255) NOT NULL,
    `sector` VARCHAR(255) NOT NULL
);
CREATE TABLE `solution`(
    `solutionID` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `solutionType` VARCHAR(255) NOT NULL,
    `region` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `submissionDate` DATE NOT NULL,
    `publicationDate` DATE NULL,
    `media` VARCHAR(255) NULL,
    `challenge` VARCHAR(255) NOT NULL,
    `solutionBody` VARCHAR(255) NOT NULL,
    `result` VARCHAR(255) NOT NULL,
    `comment` VARCHAR(255) NULL,
    `status` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `solution` ADD PRIMARY KEY(`solutionID`);
ALTER TABLE
    `solution` ADD CONSTRAINT `solution_type_foreign` FOREIGN KEY(`type`) REFERENCES `type`(`name`);
ALTER TABLE
    `specialization` ADD CONSTRAINT `specialization_id_foreign` FOREIGN KEY(`id`) REFERENCES `solution`(`solutionID`);
ALTER TABLE
    `solution` ADD CONSTRAINT `solution_solutiontype_foreign` FOREIGN KEY(`solutionType`) REFERENCES `solutionType`(`name`);
ALTER TABLE
    `solution` ADD CONSTRAINT `solution_username_foreign` FOREIGN KEY(`username`) REFERENCES `solutionProvider`(`username`);
ALTER TABLE
    `specialization` ADD CONSTRAINT `specialization_sector_foreign` FOREIGN KEY(`sector`) REFERENCES `sector`(`name`);
ALTER TABLE
    `specialization` ADD CONSTRAINT `specialization_type_foreign` FOREIGN KEY(`type`) REFERENCES `type`(`name`);
INSERT INTO type (name) VALUES ('solution'); 
INSERT INTO solutiontype (name) VALUES ('Case');
INSERT INTO solutiontype (name) VALUES ('Policy');
INSERT INTO solutiontype (name) VALUES ('R&D project');
INSERT INTO sector (name) VALUES('Bio Energy');
INSERT INTO sector (name) VALUES('Offshore Wind');
INSERT INTO sector (name) VALUES('Carbon Capture');
INSERT INTO sector (name) VALUES('District Heating');
INSERT INTO sector (name) VALUES('Wastewater Management');
INSERT INTO solutionProvider (username, organizationName) VALUES ('placeHolderUserNameFromSession', 'placeHolderOrgName');