drop table if exists t_product_stock;

/*==============================================================*/
/* Table: t_product_stock                                       */
/*==============================================================*/
create table t_product_stock
(
   ID                   int not null,
   skuID                int,
   optType              varchar(3) comment 'ADD：增加库存
            DEL：删除库存',
   uid                  int,
   count                int,
   createTime           datetime,
   primary key (ID)
);

alter table t_product_stock comment '保存商品库存操作记录';
