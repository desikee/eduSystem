
select count(*) from device;
select count(*) from link;
select avg(count_link) from (select count(link_id) as count_link from browser where used>0 group by link_id) as b;
select count(*) from device where device_id != '';
select max(count_player) from (select count(*) as count_player from link group by player_id) as b;
select * from (select count(*) as count_player from link group by player_id) as b order by count_player desc limit 10;
select * from device where id > 1000 limit 20;
select sum(count_d) from (select count(*) as count_d from device where player_id != '' group by player_id)as d
select count(*) from relation where player_id != '' and invite_player_id != '' and channel_id = 'YY0S0N00006'
select date(created),count(*) from link where created > '2017-12-26 00:00:00' group by date(created)
select sum(visited) from browser
select count(*) from browser where used>0 and created > '2017-12-26 00:00:00'
select date(created),count(*) from browser where used>0 and created > '2017-12-27 00:00:00' group by date(created)

select player_id from device where player_id != '' group by player_id  706
select sum(count_d) from (select count(*) as count_d from device where player_id != '' group by player_id)as d


select player_id from browser where used > 0 group by player_id
select sum(count_d) from (select count(*) as count_d from browser where used > 0 group by player_id)as d  2593