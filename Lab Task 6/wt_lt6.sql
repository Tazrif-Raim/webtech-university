CREATE TABLE `user`(
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `access` VARCHAR(255) NOT NULL,
    `firstname` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `user` ADD PRIMARY KEY(`username`);
CREATE TABLE `access`(`name` VARCHAR(255) NOT NULL);
ALTER TABLE
    `access` ADD PRIMARY KEY(`name`);
CREATE TABLE `organizationType`(`name` VARCHAR(255) NOT NULL);
ALTER TABLE
    `organizationType` ADD PRIMARY KEY(`name`);
CREATE TABLE `accessType`(`name` VARCHAR(255) NOT NULL);
ALTER TABLE
    `accessType` ADD PRIMARY KEY(`name`);
CREATE TABLE `specialization`(
    `type` VARCHAR(255) NULL,
    `id` VARCHAR(255) NOT NULL,
    `sector` VARCHAR(255) NOT NULL
);
CREATE TABLE `sector`(`name` VARCHAR(255) NOT NULL);
ALTER TABLE
    `sector` ADD PRIMARY KEY(`name`);
CREATE TABLE `solutionProvider`(
    `username` VARCHAR(255) NOT NULL,
    `organizationName` VARCHAR(255) NULL,
    `organizationType` VARCHAR(255) NULL,
    `logo` VARCHAR(255) NULL,
    `aboutMedia` VARCHAR(255) NULL,
    `shortAbout` VARCHAR(255) NULL,
    `founded` VARCHAR(255) NULL,
    `employees` VARCHAR(255) NULL,
    `hq` VARCHAR(255) NULL,
    `story` VARCHAR(255) NULL,
    `website` VARCHAR(255) NULL,
    `address` VARCHAR(255) NULL,
    `mapsLink` VARCHAR(255) NULL,
    `contactName` VARCHAR(255) NULL,
    `contactEmail` VARCHAR(255) NULL
);
ALTER TABLE
    `solutionProvider` ADD PRIMARY KEY(`username`);
ALTER TABLE
    `solutionProvider` ADD UNIQUE `solutionprovider_organizationname_unique`(`organizationName`);
ALTER TABLE
    `solutionProvider` ADD CONSTRAINT `solutionprovider_organizationtype_foreign` FOREIGN KEY(`organizationType`) REFERENCES `organizationType`(`name`);
ALTER TABLE
    `user` ADD CONSTRAINT `user_access_foreign` FOREIGN KEY(`access`) REFERENCES `access`(`name`);
ALTER TABLE
    `specialization` ADD CONSTRAINT `specialization_sector_foreign` FOREIGN KEY(`sector`) REFERENCES `sector`(`name`);
ALTER TABLE
    `accessType` ADD CONSTRAINT `accesstype_name_foreign` FOREIGN KEY(`name`) REFERENCES `access`(`name`);
ALTER TABLE
    `specialization` ADD CONSTRAINT `specialization_id_foreign` FOREIGN KEY(`id`) REFERENCES `solutionProvider`(`username`);
ALTER TABLE
    `solutionProvider` ADD CONSTRAINT `solutionprovider_username_foreign` FOREIGN KEY(`username`) REFERENCES `user`(`username`);
INSERT INTO sector (name) VALUES('Bio Energy');
INSERT INTO sector (name) VALUES('Offshore Wind');
INSERT INTO sector (name) VALUES('Carbon Capture');
INSERT INTO sector (name) VALUES('District Heating');
INSERT INTO sector (name) VALUES('Wastewater Management');
INSERT INTO organizationType (name) VALUES('Company');
INSERT INTO organizationType (name) VALUES('Organization');
INSERT INTO organizationType (name) VALUES('Utility');
INSERT INTO organizationType (name) VALUES('Research Instituition');
INSERT INTO organizationType (name) VALUES('Public Sector');
INSERT INTO organizationType (name) VALUES('Financial Institution');
INSERT INTO access (name) VALUES('Admin');
INSERT INTO access (name) VALUES('Solution Provider');
INSERT INTO access (name) VALUES('Reporter');
INSERT INTO access (name) VALUES('Researcher');
INSERT INTO accessType (name) VALUES('Solution Provider');
INSERT INTO accessType (name) VALUES('Reporter');
INSERT INTO accessType (name) VALUES('Researcher');