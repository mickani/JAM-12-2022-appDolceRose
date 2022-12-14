create database dolcerose_bd;
use dolcerose_bd;

create table materias_primas(
	id_materia_prima int auto_increment,
    nombre_materia_prima varchar(120) unique not null,
    stock_actual double not null,
    stock_minimo double not null,
    costo double not null,
    primary key(id_materia_prima)
);

create table proveedores(
	id_proveedor int auto_increment,
    nombre_proveedor varchar(120) unique not null,
    primary key(id_proveedor)
);

create table productos(
	id_producto int auto_increment,
    nombre_producto varchar(120) unique not null,
    primary key(id_producto)
);

create table materias_primas_x_productos(
	id_producto int not null,
    id_materia_prima int not null,
    cantidad double not null,
    primary key(id_producto, id_materia_prima),
    foreign key(id_producto) references productos(id_producto),
    foreign key(id_materia_prima) references materias_primas(id_materia_prima)
);

create table compras(
	id_compra int auto_increment,
    id_proveedor int not null,
    fecha_compra date not null,
    primary key(id_compra),
    foreign key(id_proveedor) references proveedores(id_proveedor)
);

create table detalles_compras(
	id_compra int not null,
    id_materia_prima int not null,
    cantidad double not null,
    costo double not null,
    primary key(id_compra, id_materia_prima),
    foreign key(id_compra) references compras(id_compra),
    foreign key(id_materia_prima) references materias_primas(id_materia_prima)
);

create table elaboraciones(
	id_elaboracion int auto_increment,
    fecha_elaboracion date not null,
    id_producto int not null,
    costo_unitario_producto double not null,
    cantidad_elaborada int not null,
    primary key(id_elaboracion),
    foreign key(id_producto) references productos(id_producto)
);



