Linux + Nginx + MariaDB + PHP 

## โครงสร้างไฟล์ของ docker
```sh
.
|__ docker-compose.yml
|__ html                    <--- พื้นที่จัดเก็บไฟล์สำหรับแสดงผลบนเว็บไซต์
    |__ index.php 
|__ mariadb
    |__ initdb              <--- เก็บไฟล์ sql สำหรับกำหนดโครงสร้างฐานข้อมูล 
    |__ backup              <--- เก็บไฟล์ sql ที่ทำการ backup
    |__ data                <--- พื้นที่เก็บข้อมูลของฐานข้อมูล
|__ nginx
    |__ conf.d
        |__ nginx.conf      <--- ไฟล์ configuration ของ nginx
    |__ conf
        |__ default.conf    <--- ไฟล์ configuration ของ nginx
|__ php
    |__ Dockerfile
```


## รายละเอียด container

| container name | Description |
| ------ | ------ |
| lemp_nginx | nginx web server |
| lemp_php | php 7.4 |
| lemp_mariadb | mariadb |
| lemp_phpmyadmin | phpmyadmin |

## การเรียกใช้งาน
| Name | URL |
| ------ | ------ |
|  Web Server | http://localhost |
| PhpMyAdmin | http://localhost:8080 |


## คำสั่งพื้นฐาน (Basic command for docker)
รัน Container 
```sh
docker-compose up
```
ผู้ใช้จะเห็น log ที่เกิดขึ้นทั้งหมดผ่าน console 
ผู้ใช้สามารถหยุด Container ด้วยการกดปุ่ม Ctrl C


รัน Container เป็น backgroud
```sh
docker-compose up -d
```

ดู Container ที่กำลังรันทั้งหมด
```sh
docker-compose ps
```

Remote ไปยัง bash shell ของ Apache Container คำสั่ง docker exec -it ชื่อของ container sh
```sh
docker exec -it lemp_nginx sh
```

Stop/Delete Container
```sh
docker-compose down --rmi all
```



## Maria DB 

เมื่อรัน Container แล้ว Mariadb จะ Import ไฟล์ ".sql" จากโฟลเดอร์ mariadb/initdb ไปยังโฟลเดอร์ /docker-entrypoint-initdb.dให้อัตโนมัติ
ถ้าภายใน /var/lib/mysql/ ของ lemp_mariadb Container ยังไม่มีข้อมูล
volumes:
  - ./mariadb/initdb/:/docker-entrypoint-initdb.d
  - ./mariadb/data/:/var/lib/mysql/

สร้างตารางข้อมูลอัตโนมัติ
```sh
ให้เขียนคำสั่ง sql ในไฟล์ ./mariadb/initdb/create-tables.sql
```

# Backup
## ไฟล์ที่สำรองข้อมูลจะเก็บอยู่ที่ ./mariadb/backup/db.sql 
# คำสั่งสำรองข้อมูล
```sh
docker exec lemp_mariadb sh -c 'exec mysqldump "$MYSQL_DATABASE" -uroot -p"$MYSQL_ROOT_PASSWORD"' > ./mariadb/backup/db.sql
```

## For Windows using Powershell with a large database you should use
```sh
docker exec CONTAINER /usr/bin/mysqldump -u root --password=root -r DATABASE | Set-Content backup.sql
```

## Restore
Windows, Linux and Mac OS X 
```sh
cat ./mariadb/backup/db.sql | docker exec -i lemp_mariadb /usr/bin/mysql -u root --password=secret db_cluster_demo
```

Linux or Mac OS X
```sh
docker exec -i lemp_mariadb mysql -uroot -psecret db_cluster_demo < ./mariadb/backup/db.sql
```

Windows : use WindowsPowerShell

Linux and Mac OS X : use terminal
> Note:
> `Please change db_cluster_demo to your database name`



# อ้างอิงจาก
https://blog.pjjop.org/how-to-set-lemp-stack-with-docker-containers/

https://www.itsolutionstuff.com/post/codeigniter-3-basic-crud-application-with-mysql-example-with-demoexample.html
