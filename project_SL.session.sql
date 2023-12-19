SELECT
    SUM(
        IF(
            passed_signal.end_date IS NULL OR has_signal.end_date IS NULL,
            1,
            0
        )
    ) AS signalCount,
    man.id,
    man.birth_day,
    man.birth_month,
    man.birth_year,
    man.start_year,
    man.end_year,
    man.attention,
    man.occupation,
    man.start_wanted,
    man.entry_date,
    man.exit_date,
    man.opened_dou
    -- GROUP_CONCAT(
    --     last_name.last_name SEPARATOR ','
    -- ) last_name,
    -- GROUP_CONCAT(
    --     first_name.first_name SEPARATOR ','
    -- ) first_name,
    -- GROUP_CONCAT(
    --     middle_name.middle_name SEPARATOR ','
    -- ) middle_name,
    -- country_ate.name,
    -- region.name,
    -- locality.name,
    -- GROUP_CONCAT(passport.number SEPARATOR ',') passport_number,
    -- gender.name,
    -- nation.name,
    -- GROUP_CONCAT(c.name SEPARATOR ',') country_name,
    -- GROUP_CONCAT(LANGUAGE.name SEPARATOR ',') language_name,
    -- GROUP_CONCAT(more_data_man.text SEPARATOR ',') more_data_text,
    -- religion.name,
    -- GROUP_CONCAT(
    --     country_search.name SEPARATOR ','
    -- ) search_country_name,
    -- GROUP_CONCAT(
    --     operation_category.name SEPARATOR ','
    -- ) operation_category_name,
    -- GROUP_CONCAT(education.name SEPARATOR ',') education_name,
    -- GROUP_CONCAT(party.name SEPARATOR ',') party_name,
    -- GROUP_CONCAT(nickname.name SEPARATOR ',') nickname_name,
    -- resource.name
FROM
    `man`
CROSS JOIN `man_passed_by_signal` ON `man`.`id` = `man_passed_by_signal`.`man_id`
CROSS JOIN `signal` AS `passed_signal`
ON
    `man_passed_by_signal`.`signal_id` = `passed_signal`.`id`
CROSS JOIN `signal_has_man` ON `man`.`id` = `signal_has_man`.`man_id`
CROSS JOIN `signal` AS `has_signal`
ON
    `signal_has_man`.`signal_id` = `has_signal`.`id`
-- LEFT JOIN `address` ON `man`.`born_address_id` = `address`.`id`
-- LEFT JOIN `country_ate` ON `address`.`country_ate_id` = `country_ate`.`id`
-- LEFT JOIN `region` ON `address`.`region_id` = `region`.`id`
-- LEFT JOIN `locality` ON `address`.`locality_id` = `locality`.`id`
-- LEFT JOIN `man_has_first_name` ON `man`.`id` = `man_has_first_name`.`man_id`
-- INNER JOIN `first_name` ON `man_has_first_name`.`first_name_id` = `first_name`.`id`
-- LEFT JOIN `man_has_last_name` ON `man`.`id` = `man_has_last_name`.`man_id`
-- INNER JOIN `last_name` ON `man_has_last_name`.`last_name_id` = `last_name`.`id`
-- LEFT JOIN `man_has_middle_name` ON `man`.`id` = `man_has_middle_name`.`man_id`
-- INNER JOIN `middle_name` ON `man_has_middle_name`.`middle_name_id` = `middle_name`.`id`
-- LEFT JOIN `man_has_passport` ON `man`.`id` = `man_has_passport`.`man_id`
-- INNER JOIN `passport` ON `man_has_passport`.`passport_id` = `passport`.`id`
-- LEFT JOIN `gender` ON `man`.`gender_id` = `gender`.`id`
-- LEFT JOIN `nation` ON `man`.`nation_id` = `nation`.`id`
-- LEFT JOIN `man_belongs_country` ON `man`.`id` = `man_belongs_country`.`man_id`
-- INNER JOIN `country` AS `c`
-- ON
--     `man_belongs_country`.`country_id` = `c`.`id`
-- LEFT JOIN `man_knows_language` ON `man`.`id` = `man_knows_language`.`man_id`
-- INNER JOIN `language` ON `man_knows_language`.`language_id` = `language`.`id`
-- LEFT JOIN `more_data_man` ON `man`.`id` = `more_data_man`.`man_id`
-- LEFT JOIN `religion` ON `man`.`religion_id` = `religion`.`id`
-- LEFT JOIN `country_search_man` ON `man`.`id` = `country_search_man`.`man_id`
-- INNER JOIN `country` AS `country_search`
-- ON
--     `country_search_man`.`country_id` = `country_search`.`id`
-- LEFT JOIN `man_has_operation_category` ON `man`.`id` = `man_has_operation_category`.`man_id`
-- INNER JOIN `operation_category` ON `man_has_operation_category`.`operation_category_id` = `operation_category`.`id`
-- LEFT JOIN `man_has_education` ON `man`.`id` = `man_has_education`.`man_id`
-- INNER JOIN `education` ON `man_has_education`.`education_id` = `education`.`id`
-- LEFT JOIN `man_has_party` ON `man`.`id` = `man_has_party`.`man_id`
-- INNER JOIN `party` ON `man_has_party`.`party_id` = `party`.`id`
-- LEFT JOIN `man_has_nickname` ON `man`.`id` = `man_has_nickname`.`man_id`
-- INNER JOIN `nickname` ON `man_has_nickname`.`nickname_id` = `nickname`.`id`
-- LEFT JOIN `resource` ON `man`.`resource_id` = `resource`.`id`
GROUP BY
    `man`.`id`





