-- auto-generated definition
create table banks
(
    id             int unsigned auto_increment
        primary key,
    bank_name      varchar(100) not null,
    account_name   varchar(100) not null,
    account_number varchar(100) not null,
    created_at     timestamp    null,
    updated_at     timestamp    null,
    user_id        int unsigned null,
    constraint banks_ibfk_1
        foreign key (user_id) references users (id)
            on update cascade on delete cascade
)
    collate = utf8mb4_unicode_ci;

create index banks_user_id_foreign
    on banks (user_id);



-- auto-generated definition
create table `groups`
(
    id         int unsigned auto_increment
        primary key,
    name       varchar(191) not null,
    slug       varchar(191) not null,
    type       char(30)     null,
    created_by varchar(191) not null,
    updated_by varchar(191) null,
    created_at timestamp    not null,
    updated_at timestamp    not null
);

-- auto-generated definition
create table products
(
    id          int unsigned auto_increment
        primary key,
    type        varchar(191) collate utf8mb4_unicode_ci               null,
    name        varchar(191) collate utf8mb4_unicode_ci               not null,
    slug        varchar(191) collate utf8mb4_unicode_ci               not null,
    short_desc  text collate utf8mb4_unicode_ci                       not null,
    description text collate utf8mb4_unicode_ci                       not null,
    time_period varchar(45) collate utf8mb4_unicode_ci                null,
    start_at    date                                                  null,
    end_at      date                                                  null,
    price       decimal(12, 2)                                        not null,
    visibility  char(10) collate utf8mb4_unicode_ci default 'publish' not null,
    created_at  timestamp                                             not null,
    updated_at  timestamp                                             not null,
    created_by  varchar(191) collate utf8mb4_unicode_ci               not null,
    updated_by  varchar(191) collate utf8mb4_unicode_ci               not null
);

create index products_visibility_index
    on products (visibility);

-- auto-generated definition
create table product_groups
(
    product_id int unsigned null,
    group_id   int unsigned null,
    created_at timestamp    null,
    updated_at timestamp    null,
    constraint product_groups_group_id_foreign
        foreign key (group_id) references `groups` (id)
            on update cascade on delete cascade,
    constraint product_groups_product_id_foreign
        foreign key (product_id) references products (id)
            on update cascade on delete cascade
);

-- auto-generated definition
create table orders
(
    id             int unsigned auto_increment
        primary key,
    order_date     date                                               not null,
    customer_id    int unsigned                                       not null,
    type           enum ('wa', 'web')                                 not null,
    total_price    decimal(12, 2)                                     not null,
    payment_status enum ('paid', 'unpaid', 'cancel') default 'unpaid' not null,
    paid_at        datetime                                           null,
    bank_id        int unsigned                                       null,
    due_date       datetime                                           null,
    agent_id       int unsigned                                       not null,
    created_at     timestamp                                          null,
    updated_at     timestamp                                          null,
    transaction_id varchar(191)                                       null,
    payment_type   varchar(191)                                       null,
    order_code     varchar(191)                                       null,
    step           int                               default 0        not null,
    constraint orders_ibfk_1
        foreign key (bank_id) references banks (id)
            on update cascade on delete set null,
    constraint orders_ibfk_2
        foreign key (agent_id) references users (id)
            on update cascade on delete cascade,
    constraint orders_ibfk_3
        foreign key (customer_id) references users (id)
            on update cascade on delete cascade
)
    collate = utf8mb4_unicode_ci;

create index banks_bank_id_foreign
    on orders (bank_id);

create index orders_agent_id_foreign
    on orders (agent_id);

create index orders_customer_id_foreign
    on orders (customer_id);


-- auto-generated definition
create table order_details
(
    id                  int unsigned auto_increment
        primary key,
    order_id            int unsigned                      not null,
    product_id          int unsigned                      null,
    product_group       varchar(191) default 'membership' not null,
    product_name        varchar(191)                      not null,
    product_price       decimal(12, 2)                    not null,
    product_unit_price  decimal(12, 2)                    not null,
    product_time_period varchar(45)                       null,
    qty                 int          default 1            not null,
    created_at          timestamp                         null,
    updated_at          timestamp                         null,
    constraint order_details_ibfk_1
        foreign key (order_id) references orders (id)
            on update cascade on delete cascade,
    constraint order_details_ibfk_2
        foreign key (product_id) references products (id)
            on update cascade on delete set null
)
    collate = utf8mb4_unicode_ci;

create index order_details_order_id_foreign
    on order_details (order_id);

create index order_details_product_id_foreign
    on order_details (product_id);

create index order_details_product_type_index
    on order_details (product_group);

-- auto-generated definition
create table media
(
    id         int unsigned auto_increment
        primary key,
    item_id    int unsigned                                        null,
    type       char(20) collate utf8mb4_unicode_ci default 'image' not null,
    model      varchar(191) collate utf8mb4_unicode_ci             null,
    url        varchar(191) collate utf8mb4_unicode_ci             not null,
    path       varchar(191) collate utf8mb4_unicode_ci             not null,
    file_name  varchar(191)                                        null,
    created_by varchar(191)                                        null,
    updated_by varchar(191)                                        null,
    created_at timestamp                                           null,
    updated_at timestamp                                           null
);

create index media_item_id_index
    on media (item_id);

create index media_model_index
    on media (model);


-- auto-generated definition
create table user_products
(
    id                int unsigned auto_increment
        primary key,
    user_id           int unsigned not null,
    product_id        int unsigned null,
    pre_trading       tinyint      null,
    membership_status varchar(45)  null,
    follow_up_by      varchar(191) null,
    start_at          date         null,
    expired_at        date         null,
    created_at        timestamp    null,
    updated_at        timestamp    null,
    constraint user_products_ibfk_1
        foreign key (product_id) references products (id)
            on update cascade on delete set null,
    constraint user_products_ibfk_2
        foreign key (user_id) references users (id)
            on update cascade on delete cascade
)
    collate = utf8mb4_unicode_ci;

create index user_products_product_id_foreign
    on user_products (product_id);

create index user_products_user_id_foreign
    on user_products (user_id);



-- auto-generated definition
create table shipping
(
    id            int unsigned auto_increment
        primary key,
    tracking_code varchar(191)   null,
    user_id       int unsigned   not null,
    product_id    int unsigned   not null,
    order_id      int unsigned   not null,
    charge        decimal(12, 2) not null,
    provider      varchar(191)   not null,
    created_at    timestamp      null,
    updated_at    timestamp      null,
    constraint shipping_ibfk_1
        foreign key (order_id) references orders (id)
            on update cascade on delete cascade,
    constraint shipping_ibfk_2
        foreign key (product_id) references products (id)
            on update cascade on delete cascade,
    constraint shipping_ibfk_3
        foreign key (user_id) references users (id)
            on update cascade on delete cascade
)
    collate = utf8mb4_unicode_ci;

create index shipping_order_id_foreign
    on shipping (order_id);

create index shipping_product_id_foreign
    on shipping (product_id);

create index shipping_user_id_foreign
    on shipping (user_id);






