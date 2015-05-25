CREATE TABLE IF NOT EXISTS `goal` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `comment` TEXT NOT NULL,
  `ts` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into goal values ('36c86f8e-49b5-11e4-ba08-005056b23993', 'Kevin', '20~30', '找到志同道合的团队，创建自己的公司。', CURRENT_TIMESTAMP);
insert into goal values ('4610fcdd-8b7c-11e4-8c7d-080027be8b7c', 'Lucas', '30~40', '当人们开始人肉搜索女司机，舆论审判的后果大大超越“罚当其罪”的限度。当事人再怎么声称“拿起法律武器”，都显得无力之极，因为跟他对抗不是有身份有名字的个人，而是无影无形的一群人。', CURRENT_TIMESTAMP);
insert into goal values ('5156610c-8219-11e4-8c7d-080027be8b7c', 'Nanda', '20~30', '“没有很好地跟大姐吃几顿饭，聊几次天，大姐就退休了，敬大姐是我们心中最好的大姐！”白岩松动情地说，“因为我家庭中没有亲姐姐，但是20年前遇到大姐时，我觉得很幸福，感觉她这样的大姐才是真正的大姐！”随后，白岩松用八个字形容敬大姐，“利而不害，为而不争”。“利而不害，就是做人方面，敬大姐给人以好处。”白岩松解释，“为而不争，就是做事方面，相互之间没有竞争是假的，但我们的竞争方式是互相之间提合理化建议，让对方的节目做得更好。”', CURRENT_TIMESTAMP);
insert into goal values ('c317b3f3-8ac9-11e4-8c7d-080027be8b7c', 'Stephanie', '40+', 'I have no words to express at this moment, because no amout of words can describe the Sparkle and Genius of Jobs. I feel i am all alone in this world without Jobs.', CURRENT_TIMESTAMP);
insert into goal values ('55d7e4e7-8b7c-11e4-8c7d-080027be8b7c', 'Jane', '10~20', '我们面对的，是过去15年里欧洲最好的球队。听起来，在瓜帅心中，巴萨的高度是其他球队难以超越的，对此，瓜迪奥拉执教巴萨期间也曾有过自己的巨大贡献。', CURRENT_TIMESTAMP);


