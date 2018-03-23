# TestDB
This application can connect to **MySQL** database and **Microsoft SQL Server**

To connect to a **SQL Server** database, we need a PHP image with extensions to support that database. Such an image is provided here [https://github.com/VeerMuchandi/mssql-openshift-tools/tree/master/php7-mssql](https://github.com/VeerMuchandi/mssql-openshift-tools/tree/master/php7-mssql).  Refer the documentation at the link to understand how to build this extended custom S2I image and push it to a project.


To deploy this application in the mstest project using the customized S2I builder image as follows:

```
$ oc new-app mstest/php7~https://github.com/VeerMuchandi/testdb
```