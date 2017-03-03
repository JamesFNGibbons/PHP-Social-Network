create table if not exists Users (
    ID INT PRIMARY KEY,
    Username TEXT,
    Email TEXT,
    Password TEXT,
    Lastlogin DATE
);

create table if not exists Schools (
    ID int primary key,
    Name TEXT,
    Contact_Name TEXT,
    Contact_Email TEXT,
    Contact_Phone TEXT,
    Contact_Website TEXT,
    Student_Email_Url TEXT
);

create table if not exists Posts (
    ID int primary key,
    Post_Type text not null,
    Post_Text text,
    Post_Image text,
    Post_From int,
    Post_To int
);