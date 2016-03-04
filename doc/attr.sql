/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2016/2/25 19:13:21                           */
/*==============================================================*/


drop table if exists t_cart_product_sku;

drop table if exists t_product_attr;

drop table if exists t_product_attr_value;

drop table if exists t_product_sku;

drop table if exists t_product_sku_attr;

drop table if exists t_product_stock;

/*==============================================================*/
/* Table: t_cart_product_sku                                    */
/*==============================================================*/
create table t_cart_product_sku
(
   ID                   int not null auto_increment,
   shopCarID            varchar(20),
   productID            int,
   count                int,
   skuID                int,
   status               varchar(3) comment 'OK#：正常，可用
            DEL：已删除',
   delTime              datetime,
   createTime           datetime,
   primary key (ID)
);

alter table t_cart_product_sku comment '购物车商品关系表';

/*==============================================================*/
/* Table: t_product_attr                                        */
/*==============================================================*/
create table t_product_attr
(
   ID                   int not null auto_increment,
   productID            int,
   attrName             varchar(30),
   sortOrder            int,
   uid                  int,
   createTime           datetime,
   primary key (ID)
);

alter table t_product_attr comment '存储产品的属性：
颜色：红色/白色/蓝色
尺码：37/38/39
鞋子颜色红色存为一';

/*==============================================================*/
/* Table: t_product_attr_value                                  */
/*==============================================================*/
create table t_product_attr_value
(
   ID                   int not null auto_increment,
   attrID               int,
   attrValue            varchar(50) comment ' 属性值：红色
            ',
   attrValueImg         varchar(500) comment '图片的http访问路径
            ',
   uid                  int,
   sortOrder            int,
   createTime           datetime,
   primary key (ID)
);

alter table t_product_attr_value comment '例如：
颜色：红色/白色/蓝色
红色就是颜色的可选值，保存为一条记录';

/*==============================================================*/
/* Table: t_product_sku                                         */
/*==============================================================*/
create table t_product_sku
(
   ID                   int not null auto_increment,
   productID            int,
   skuPrice             bigint,
   skuImg               varchar(200),
   skuStock             int,
   createTime           datetime,
   uid                  int,
   primary key (ID)
);

alter table t_product_sku comment '产品的属性，例如颜色，尺码等
鞋子的属性：红色43码，红色44码
使用单一属性管理产品';

/*==============================================================*/
/* Table: t_product_sku_attr                                    */
/*==============================================================*/
create table t_product_sku_attr
(
   ID                   int not null auto_increment,
   skuID                int,
   attrID               varchar(30),
   attrValueID          varchar(30),
   sortOrder            int,
   createTime           datetime,
   uid                  int,
   primary key (ID)
);

alter table t_product_sku_attr comment '存储sku的属性记录。
关联关系：
商品SKU表：商品属性表=1：N
商品属性表：商';

/*==============================================================*/
/* Table: t_product_stock                                       */
/*==============================================================*/
create table t_product_stock
(
   ID                   int not null,
   skuID                int,
   optType              varchar(3) comment 'ADD：增加库存
            DEL：删除库存',
   createTime           datetime,
   uid                  int,
   primary key (ID)
);

alter table t_product_stock comment '保存商品库存操作记录';
