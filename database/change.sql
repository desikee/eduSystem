ALTER TABLE `user`
ADD COLUMN `status`  tinyint(4) NULL DEFAULT 1 COMMENT '用户状态' AFTER `team`,
ADD COLUMN `parent_id`  int(10) UNSIGNED NULL COMMENT '该用户的创建者id' AFTER `status`;

ALTER TABLE `link_backend`
MODIFY COLUMN `mi_link_id`  int(10) UNSIGNED NOT NULL COMMENT 'MagicInstall中的link_id' AFTER `id`,
CHANGE COLUMN `user_id` `create_id`  int(10) UNSIGNED NULL DEFAULT NULL COMMENT '创建链接的用户id' AFTER `link_name`,
CHANGE COLUMN `person_name` `user_id`  int(10) UNSIGNED NULL DEFAULT NULL COMMENT '链接所属个人id' AFTER `action_name`,
ADD UNIQUE INDEX `link_backend_mi_link_id` (`mi_link_id`) ;