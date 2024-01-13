<?php

$conn = pg_connect("host=postgres dbname=postgres user=root password=1234");

pg_query($conn, "create sequence public.click_new_id_seq;
create table public.click
(
id bigserial primary key,
ip inet,
created_at timestamp(0) default now() not null,
referer text,
user_agent text
);

create table public.actions
(
id bigserial primary key,
event_date timestamp(0) not null,
click_id bigint not null,
created_at timestamp(0),
updated_at timestamp(0)
);
create index actions_click_id_index
on public.actions (click_id);
");

pg_query($conn, "
INSERT INTO public.actions (id, event_date, click_id, created_at, updated_at) VALUES (DEFAULT, '2024-01-12 23:54:00', 1, '2024-01-12 23:54:06', '2024-01-12 23:54:07');
INSERT INTO public.actions (id, event_date, click_id, created_at, updated_at) VALUES (DEFAULT, '2024-01-12 23:54:00', 2, '2024-01-12 23:54:06', '2024-01-12 23:54:07');
INSERT INTO public.actions (id, event_date, click_id, created_at, updated_at) VALUES (DEFAULT, '2024-01-12 23:54:00', 3, '2024-01-12 23:54:06', '2024-01-12 23:54:07');
INSERT INTO public.click (id, ip, created_at, referer, user_agent) VALUES (DEFAULT, '192.168.1.0.'::INET, '2024-01-12 23:55:49', 'ref', 'bust');
INSERT INTO public.click (id, ip, created_at, referer, user_agent) VALUES (DEFAULT, '192.168.1.0.'::INET, '2024-01-12 23:55:49', 'ref', 'bust');
INSERT INTO public.click (id, ip, created_at, referer, user_agent) VALUES (DEFAULT, '192.168.1.0.'::INET, '2024-01-12 23:55:49', 'ref', 'bust');
INSERT INTO public.click (id, ip, created_at, referer, user_agent) VALUES (DEFAULT, '192.168.1.0.'::INET, '2024-01-12 23:55:49', 'ref', 'bust');
INSERT INTO public.click (id, ip, created_at, referer, user_agent) VALUES (DEFAULT, '192.168.1.0.'::INET, '2024-01-12 23:55:49', 'ref', 'bust');
INSERT INTO public.click (id, ip, created_at, referer, user_agent) VALUES (DEFAULT, '192.168.1.0.'::INET, '2024-01-12 23:55:49', 'ref', 'bust');
");

$resultWithActions = pg_query($conn, "select click.* from click left join actions on click.id = actions.click_id where actions.id is not null;");
$resultWithoutActions = pg_query($conn, "select click.* from click left join actions on click.id = actions.click_id where actions.id is null;");

echo "Clicks with actions: \n";
echo "ID IP CREATED_AT REFERER USER_AGENT \n";
while ($row = pg_fetch_assoc($resultWithActions)) {
    echo($row['id'] . " " . $row['ip'] . " " . $row['created_at'] . " " . $row['referer'] . " " . $row['user_agent'] . "\n" );
}

echo "Clicks without actions: \n";
while ($row = pg_fetch_assoc($resultWithoutActions)) {
    echo($row['id'] . " " . $row['ip'] . " " . $row['created_at'] . " " . $row['referer'] . " " . $row['user_agent'] . "\n" );
}

pg_close($conn);