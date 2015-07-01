CREATE TABLE IF NOT EXISTS `goal` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `comment` TEXT NOT NULL,
  `ts` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into goal values ('36c86f8e-49b5-11e4-ba08-005056b23993', 'Kevin', '20~30', 'Tomorrow is another day.', CURRENT_TIMESTAMP);
insert into goal values ('4610fcdd-8b7c-11e4-8c7d-080027be8b7c', 'Lucas', '30~40', 'Be tough, be good.', CURRENT_TIMESTAMP);
insert into goal values ('5156610c-8219-11e4-8c7d-080027be8b7c', 'Nanda', '20~30', '“Help other means love yourself!”', CURRENT_TIMESTAMP);
insert into goal values ('c317b3f3-8ac9-11e4-8c7d-080027be8b7c', 'Stephanie', '40+', 'I have no words to express at this moment, because no amout of words can describe the Sparkle and Genius of Jobs. I feel i am all alone in this world without Jobs.', CURRENT_TIMESTAMP);
insert into goal values ('55d7e4e7-8b7c-11e4-8c7d-080027be8b7c', 'Jane', '10~20', 'Méq un club', CURRENT_TIMESTAMP);


