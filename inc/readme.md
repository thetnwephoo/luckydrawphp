1. to create view table
with all_customer_count and all_customer_prizes

2. all_customer_count has customer_count and customer_id columns
comand for table create
create view `all_customer_count` as select count(`aungpyae_lucky_draw`.`lucky_numbers`.`customer_id`) AS `customer_count`,`aungpyae_lucky_draw`.`lucky_numbers`.`customer_id` AS `customer_id` from `aungpyae_lucky_draw`.`lucky_numbers` group by `aungpyae_lucky_draw`.`lucky_numbers`.`customer_id`

3. all_customer_prizes has prize_type, lucky_number and name
command for table create
create view `all_customer_prizes` as (select `aungpyae_lucky_draw`.`prizes`.`prize_type` AS `prize_type`,`aungpyae_lucky_draw`.`lucky_numbers`.`lucky_number` AS `lucky_number`,`aungpyae_lucky_draw`.`customers`.`name` AS `name` from (((`aungpyae_lucky_draw`.`customer_prizes` join `aungpyae_lucky_draw`.`prizes` on(`aungpyae_lucky_draw`.`customer_prizes`.`prize_id` = `aungpyae_lucky_draw`.`prizes`.`id`)) join `aungpyae_lucky_draw`.`lucky_numbers` on(`aungpyae_lucky_draw`.`lucky_numbers`.`id` = `aungpyae_lucky_draw`.`customer_prizes`.`lucky_number_id`)) join `aungpyae_lucky_draw`.`customers` on(`aungpyae_lucky_draw`.`lucky_numbers`.`customer_id` = `aungpyae_lucky_draw`.`customers`.`id`)))



